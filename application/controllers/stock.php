<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 库存管理模块
 * 数据库连接：t_company_stock
 */
class stock extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//权限判断
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('14', $this->session->userdata('user_jurisdict'));

		$this->load->model('m_stock');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index($page = '1', $pageSize = '20')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'stock'));
		
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where		= $this->session->userdata('stock_select');
			$page		= $where['page']>0?$where['page']:$page;
			$pageSize	= $where['pageSize']>0?$where['pageSize']:$pageSize;
		}
		else
		{
			$where['name']		= $this->input->post('name');
			$where['page']		= $page;
			$where['pageSize']	= $pageSize;
			
			$this->session->set_userdata(array('stock_select'=>$where));
		}
		$data = array('name' => $where['name']);
		//-----获取查询条件------
		
		//---------分页------------
		$num = $this->m_stock->stock_num($where);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/stock/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------
		
		//-----获取数据-----
		$list = $this->m_stock->stock_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('stock/index',$data);
		$this->load->view('main_footer');
	}

	public function view($id,$type,$start,$end,$page = '1', $pageSize = '20')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'stock'));
		
		//物品信息
		$data['info'] = $this->m_stock->stock_get($id);
		
		//---------分页 出入库记录------------
		$num = $this->m_stock->storage_num($id);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/stock/view/'.$id.'/'.$type.'/'.$start."/".$end;
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页 出入库记录------------
		
		//-----获取出入库记录-----
		$list = $this->m_stock->storage_list($id,$type,$start,$end,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取出入库记录-----
		
		//-------获取入库和领用数量-------//
		if($type == 0){
			$instorageList = $this->m_stock->storage_list($id,1,$start,$end); //入库数量
			$outstorageList = $this->m_stock->storage_list($id,2,$start,$end); //出库数量
			$instorage = count($instorageList);
			$outstorage = count($outstorageList);
		}else if($type == 1){
			$instorageList = $this->m_stock->storage_list($id,1,$start,$end); //入库数量
			$instorage = count($instorageList);
			$outstorage= '';
		}else if($type == 2){
			$outstorageList = $this->m_stock->storage_list($id,2,$start,$end); //出库数量
			$instorage='';
			$outstorage= count($outstorageList);
		}
		$data['instorage'] = $instorage;
		$data['outstorage'] = $outstorage;
		//-------获取入库和领用数量------//
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
		
		$data['start'] = $start?$start:'';
		$data['end'] = $end?$end:'';
		$data['type'] = $type;
		$this->load->view('stock/view',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 上传图片
	 */
	public function pic()
	{		
    	//上传
    	$config['upload_path'] = './uploads/stock/';
    	$config['allowed_types'] = 'png|gif|jpg';
    	$config['max_size'] = '1500';
    	$config['max_width'] = '1024';
    	$config['max_height'] = '768';
    	
    	$this->load->library('upload', $config);
    	
    	$load = $this->upload->do_upload('i_file');
 

    	if (!$load) 
    	{
    		echo "<script>parent.pic_back('false**";
    		print_r($load);
			echo "');</script>";
    	} 
    	else
    	{
    		$data = $this->upload->data();
    		$logo = $data['full_path'];
    		$picArr = explode('/uploads/', $logo);
    		$logo = '/uploads/' . $picArr[1];
    		
	    	$pic = isset($logo) ? $logo : '';
	    	echo "<script>parent.pic_back('".$pic."');</script>";
    	}
	}
	
	public function save()
	{
		//权限判断
		$this->login->check_jurisdict('14',$this->session->userdata('user_jurisdict'));
		
		$action				= $this->input->post('action');
		$data['id']			= $this->input->post('id');
		$data['name']		= $this->input->post('name');
		$data['num']		= $this->input->post('num');
		$data['remark']		= $this->input->post('remark');
		$data['pic']		= $this->input->post('pic');
		$data['standard']	= $this->input->post('standard');
		$data['time']		= $this->input->post('time');
		
		if($data['id']	=='' && in_array($action,array('edit','in','out')))
		{
			exit(json_encode(array('succ'=>false,'msg'=>'您的操作有误')));
		}
		if($data['name']=='' && in_array($action,array('add','edit')))
		{
			exit(json_encode(array('succ'=>false,'msg'=>'请填写物品名称')));
		}
		if($data['standard']=='' && in_array($action,array('add','edit')))
		{
			exit(json_encode(array('succ'=>false,'msg'=>'请填写物品规格')));
		}
		if($data['num']=='' && in_array($action,array('add','in','out')))
		{
			exit(json_encode(array('succ'=>false,'msg'=>'请填写物品数量')));
		}
		if($data['time']=='' && in_array($action,array('add','in','out')))
		{
			exit(json_encode(array('succ'=>false,'msg'=>'请填写时间')));
		}
		
		$this->$action($data);
	}
	//新增入库
	function add($data)
	{
		if(isset($data['id']))
		{
			unset($data['id']);
		}
		if($this->m_stock->stock_add($data))
		{
			exit(json_encode(array('succ'=>true,'msg'=>'新增入库成功')));
		}
		else
		{
			exit(json_encode(array('succ'=>false,'msg'=>'新增入库失败')));
		}
	}
	//修改物品
	function edit($data)
	{
		$arr = array(
			'name'		=> $data['name'],
			'standard'	=> $data['standard'],
			'remark'	=> $data['remark'],
			'pic'		=> $data['pic'],
		);
		if($this->m_stock->stock_edit($data['id'],$arr))
		{
			exit(json_encode(array('succ'=>true,'msg'=>'物品修改成功')));
		}
		else
		{
			exit(json_encode(array('succ'=>false,'msg'=>'物品修改失败')));
		}
	}
	//物品入库
	function in($data)
	{
		$info = $this->m_stock->stock_get($data['id']);
		if(!isset($info['id']) || $info['id']=='')
		{
			exit(json_encode(array('succ'=>false,'msg'=>'物品不存在')));
		}
		
		$arr = array(
			'stype'		=> '1',
			'stock'		=> $data['id'],
			'stock_num'	=> $data['num'],
			's_time'	=> $data['time'],
			'remark'	=> $data['remark'],
		);
		$num = $info['num'] + $data['num'];
		
		if($this->m_stock->stock_storage($arr,$num))
		{
			exit(json_encode(array('succ'=>true,'msg'=>'物品入库成功')));
		}
		else
		{
			exit(json_encode(array('succ'=>false,'msg'=>'物品入库失败')));
		}
	}
	//物品领用
	function out($data)
	{
		$info = $this->m_stock->stock_get($data['id']);
		if(!isset($info['id']) || $info['id']=='')
		{
			exit(json_encode(array('succ'=>false,'msg'=>'物品不存在')));
		}
		
    	if($info['num']<$data['num'])
    	{
    		exit(json_encode(array('succ'=>false,'msg'=>'物品库存不足')));
    	}
    	
		$arr = array(
			'stype'		=> '2',
			'stock'		=> $data['id'],
			'stock_num'	=> $data['num'],
			's_time'	=> $data['time'],
			'remark'	=> $data['remark'],
		);
		$num = $info['num'] - $data['num'];
		
		if($this->m_stock->stock_storage($arr,$num))
		{
			exit(json_encode(array('succ'=>true,'msg'=>'物品领用成功')));
		}
		else
		{
			exit(json_encode(array('succ'=>false,'msg'=>'物品领用失败')));
		}
	}
	//删除物品，假删除
	function delete()
	{
		$id	= $this->input->post('id');
		if($this->m_stock->stock_delete($id))
		{
			exit('success');
		}
		else
		{
			exit('物品删除失败');
		}
	}
}