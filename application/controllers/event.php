<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 大事记管理模块
 * 数据库连接：t_event
 */
class event extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//权限判断
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('20', $this->session->userdata('user_jurisdict'));

		$this->load->model('m_event');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index($page = '1', $pageSize = '20')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'event'));
		
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where		= $this->session->userdata('event_select');
		}
		else
		{
			$where['start'] = $this->input->post('start');
			$where['end'] 	= $this->input->post('end');
			$where['title'] = $this->input->post('title');
			
			$this->session->set_userdata(array('event_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
		//var_dump($where);
		//---------分页------------
		$num = $this->m_event->event_num($where);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/event/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------
		
		//-----获取数据-----
		$list = $this->m_event->event_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('event/index',$data);
		$this->load->view('main_footer');
	}

	public function add()
	{
		$this->login->check_jurisdict('20',$this->session->userdata('user_jurisdict'));
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'event'));
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('event/add',$data);
		$this->load->view('main_footer');
	}
	
	public function save()
	{
		//权限判断
		$this->login->check_jurisdict('20',$this->session->userdata('user_jurisdict'));
		$id				= $this->input->post('id');
		$time			= $this->input->post('time');
		$data['date_type']		= $this->input->post('date_type');
		$data['time']		= strtotime($time);
		$data['title']			= $this->input->post('title');
		$data['is_link']		= $this->input->post('is_link');
		$data['url']			= $this->input->post('url');
		$data['content']			= $this->input->post('info');
		if($id == 0){
			$status = $this->m_event->event_add($data);
		}else{
			$status = $this->m_event->event_edit($id,$data);
		}
		if($status){
			exit('操作成功');
		}else{
			exit('操作失败');
		}
	}
	

	function edit($id)
	{
		$data = $this->m_event->event_get($id);
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'event'));
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('event/edit',$data);
		$this->load->view('main_footer');
		
	}
	
	function get_content(){
		$id = $this->input->post('id');
		$data = $this->m_event->event_get($id);
		if($data){
			exit($data['content']);
		}else{
			exit();
		}
		
	}

	function delete()
	{
		$id = $this->input->post('id');
		$idArray = explode(',',$id);
		if($this->m_event->event_delete($idArray))
		{
			exit('删除成功');
		}
		else
		{
			exit('删除失败');
		}
	}
	
	function view(){
		$this->db->order_by('time','desc');
    	$re = $this->db->get('t_event');
    	$res = $re->result_array();
    	//var_dump($data);
    	foreach($res as $key=>$value){
    		$year = date('Y',$value['time']);
    		$month = date('m',$value['time']);
    		$day = date('d',$value['time']);
    		if($value['date_type'] == 1){
    			$value['time'] = $month.'月';
    		}else{
    			$value['time'] = $month.'月'.$day.'日';
    		}
    		$data['list'][$year][] = $value;
    	}
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'event'));
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		$this->load->view('event/view',$data);
		$this->load->view('main_footer');
	}
}