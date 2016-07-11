<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 投资意向管理模块
 * 数据库连接：t_investment
 */
class investment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//权限判断
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('25', $this->session->userdata('user_jurisdict'));

		$this->load->model('m_investment');
		$this->load->helper(array('form', 'url'));
	}
	
	/**
	 * 
	 * 列表页面
	 */
	public function index($page = '1', $pageSize = '20')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'investment'));
		
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where		= $this->session->userdata('investment_select');
		}
		else
		{
			$where['industry'] = $this->input->post('industry');
			$this->session->set_userdata(array('investment_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
		//var_dump($where);
		//---------分页------------
		$num = $this->m_investment->investment_num($where);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/investment/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------
		
		//-----获取数据-----
		$list = $this->m_investment->investment_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('investment/index',$data);
		$this->load->view('main_footer');
	}

	/**
	 * 添加页面
	 */
	public function add()
	{
		$this->login->check_jurisdict('25',$this->session->userdata('user_jurisdict'));
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'investment'));
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('investment/add',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 
	 * 保存
	 */
	public function save()
	{
		//权限判断
		$this->login->check_jurisdict('25',$this->session->userdata('user_jurisdict'));
		$id				= $this->input->post('id');
		$industry		= $this->input->post('industry');
		$department		= $this->input->post('department');
		$telephone		    = $this->input->post('tel');
		$mark           = $this->input->post('mark');
		if(count($department)>1){
			$dpt = implode(';',$department);
		}else{
			$dpt = $department[0];
		}
		if(count($telephone)>1){
			$tel = implode(';',$telephone);
		}else{
			$tel = $telephone[0];
		}
		$data = array(
			'industry'=>$industry,	
			'department'=>$dpt,
			'tel'=>$tel,
			'mark'=>$mark
		);
		if($id == ''){
			$status = $this->m_investment->investment_add($data);
		}else{
			$status = $this->m_investment->investment_edit($id,$data);
		}
		if($status){
			exit('操作成功');
		}else{
			exit('操作失败');
		}
	}
	
	/**
	 * 编辑页面
	 */
	function edit($id,$thispage)
	{
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'investment'));
		//根据id查询详情
        $data = $this->m_investment->investment_get($id);
        $data['thispage'] = $thispage ? $thispage : 1;
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('investment/edit',$data);
		$this->load->view('main_footer');
		
	}
	
	/**
	 * 
	 * 批量删除
	 */
	function delete()
	{
		$id = $this->input->post('ids');
		$idArray = explode(',',$id);
		if($this->m_investment->investment_delete($idArray))
		{
			exit('删除成功');
		}
		else
		{
			exit('删除失败');
		}
	}
	
	/**
     * 点击产业名称就进入详情页面
     */
    public function view($id, $thispage)
    {

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'investment'));
        //根据id查询详情
        $data = $this->m_investment->investment_get($id);
        $data['thispage'] = $thispage ? $thispage : 1;
        
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
        $this->load->view('investment/view', $data);
        $this->load->view('main_footer');
    }
    
}