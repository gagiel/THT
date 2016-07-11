<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 中小企业信贷业务模块
 * 数据库连接：t_bank
 */
class bank extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//权限判断
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('26', $this->session->userdata('user_jurisdict'));

		$this->load->model('m_bank');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index($page = '1', $pageSize = '20')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'bank'));
		
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where		= $this->session->userdata('bank_select');
		}
		else
		{
			$where['name'] = $this->input->post('name');
			$this->session->set_userdata(array('bank_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
		//var_dump($where);
		//---------分页------------
		$num = $this->m_bank->bank_num($where);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/bank/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------
		
		//-----获取数据-----
		$list = $this->m_bank->bank_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('bank/index',$data);
		$this->load->view('main_footer');
	}

	public function add()
	{
		$this->login->check_jurisdict('26',$this->session->userdata('user_jurisdict'));
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'investment'));
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('bank/add',$data);
		$this->load->view('main_footer');
	}
	
	public function save()
	{
		//权限判断
		$this->login->check_jurisdict('26',$this->session->userdata('user_jurisdict'));
		$id                 = $this->input->post('id');
		$name				= $this->input->post('name');
		$contact            = $this->input->post('contact');
		$tel          		= trim(implode(',',$this->input->post('tel')));
		$mobile          	= trim(implode(',',$this->input->post('mobile')));
		$mark               = $this->input->post('b_mark');
		$data = array(
			'name'=>$name,	
			'contact'=>$contact,
			'tel'=>$tel,
			'mobile'=>$mobile,
			'mark'=>$mark
		);
		$business_name		= $this->input->post('business_name');
		$business_explain	= $this->input->post('business_explain');
		$marks				= $this->input->post('mark');
		$extData = array();
		if(!empty($business_name)){
			foreach($business_name as $k=>$v){
				$extData[$k] = array(
					'bank_id'=>$id,
					'business_name'=>$v,
					'business_explain'=>$business_explain[$k],	
					'mark'=>$marks[$k]
				);
			}
		}
		if($id == ''){
			$status = $this->m_bank->bank_add($data,$extData);
		}else{
			$status = $this->m_bank->bank_edit($id,$data,$extData);
		}
		if($status){
			exit('操作成功');
		}else{
			exit('操作失败');
		}
	}
	

	function edit($id,$thispage)
	{
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'bank'));
		//根据id查询详情
        $data = $this->m_bank->bank_get($id);
        $data['thispage'] = $thispage ? $thispage : 1;
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('bank/edit',$data);
		$this->load->view('main_footer');
		
	}

	function delete()
	{
		$id = $this->input->post('ids');
		$idArray = explode(',',$id);
		if($this->m_bank->bank_delete($idArray))
		{
			exit('删除成功');
		}
		else
		{
			exit('删除失败');
		}
	}
	
	
	/**
     * 详情页面
     */
    public function view($id, $thispage)
    {

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'bank'));
        //根据id查询详情
        $data = $this->m_bank->bank_get($id);
        $data['thispage'] = $thispage ? $thispage : 1;
        
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
        $this->load->view('bank/view', $data);
        $this->load->view('main_footer');
    }
    
}