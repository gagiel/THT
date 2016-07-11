<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class Department extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('1',$this->session->userdata('user_jurisdict'));
		
		$this->load->model('m_department');
		$this->load->helper('url');
		$this->load->helper('tree');
	}
	
	/**
	 * 获取部门列表
	 */
	public function index()
	{
		$this->load->model('m_jurisdict');
		$tree = $this->m_jurisdict->jurisdict_tree();

		$re = $this->m_department->department_list();
		$this->load->helper('select');
		
		$data = array(
			'list'		=> $re,
			'tree'		=> tree_check($tree),
			'select'	=> type_select(),
		);
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'user'));
		$this->load->view('department/index',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 新增部门
	 */
	public function add()
	{
		
		$this->login->check_jurisdict('2',$this->session->userdata('user_jurisdict'));
		
		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
					'name' => $this->input->post('name'),
					'mark' => $this->input->post('mark'),
					'jurisdict' => $jurisdict,
				);
		if($this->m_department->department_insert($data))
		{
			redirect($this->config->base_url().'index.php/department');
		}
	}
	
	/**
	 * 修改部门
	 */
	public function update()
	{
		$this->login->check_jurisdict('2',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
					'name' => $this->input->post('name'),
					'mark' => $this->input->post('mark'),
					'jurisdict' => $jurisdict,
				);
		$mark = $this->input->post('mark1');
		if($this->m_department->department_update($id,$data,$mark))
		{
			redirect($this->config->base_url().'index.php/department');
		}
	}
	
	/**
	 * 删除部门
	 */
	public function delete()
	{
		$this->login->check_jurisdict('2',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		$this->load->model('m_user');
		$user = $this->m_user->user_list(array('department'=>$id));
		if(is_array($user) && count($user)>0)
		{
			echo "部门中存在工作人员";
			exit();
		}
		
		if($this->m_department->department_delete($id))
		{
			echo 'success';
		}
	}
	
	public function sort(){
		$obj_id = $this->input->post('obj_id');
		$obj_sort = $this->input->post('obj_sort');
		$link_id = $this->input->post('link_id');
		$link_sort = $this->input->post('link_sort');
		$status = $this->m_department->department_updt($obj_id,array('mark'=>$link_sort));
		$status1 = $this->m_department->department_updt($link_id,array('mark'=>$obj_sort));
		if($status && $status1){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
}
?>