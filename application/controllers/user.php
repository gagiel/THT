<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class user extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));

		$this->load->model('m_user');
		$this->load->helper('url');
		$this->load->helper('tree');
	}

	/**
	 * 获取人员列表
	 */
	public function index($page='1',$pageSize='20')
	{
		$this->login->check_jurisdict('1',$this->session->userdata('user_jurisdict'));

		$this->load->model('m_jurisdict');
		$tree = $this->m_jurisdict->jurisdict_tree();

		$this->load->model('m_department');
		$department = $this->m_department->department_hash();

		$where = array();
		//$where['name'] = $this->input->post('name');
		$where['department'] = $this->input->post('department');
		//$where['phone'] = $this->input->post('phone');
		$where['keyword']= $this->input->post('keyword');
		//if($where['name'].$where['department'].$where['phone']=='')
		if($where['keyword'].$where['department']=='')
		{
			$where = $this->session->userdata('user_select');
		}
		$this->session->set_userdata(array('user_select'=>$where));

		//---------分页------------
		$num = $this->m_user->user_num($where);

		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$this->load->library('pagination');

		$config['base_url'] = '/index.php/user/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize;

		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();
		//---------分页------------

		$re = $this->m_user->user_list($where,($page-1)*$pageSize,$pageSize);

		$this->load->helper('select');

		$data = array(
			'where'		=> $where,
			'list'		=> $re,
			'department'=> $department,
			'tree'		=> tree_check($tree),
			'select'	=> type_select(),
			'pages'	=> $pages,
		);
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'user'));
		$this->load->view('user/index',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 自行注册人员列表
	 *
	 **/
	public function register_list($page='1',$pageSize='20'){
		$this->login->check_jurisdict('1',$this->session->userdata('user_jurisdict'));

		$this->load->model('m_jurisdict');
		$tree = $this->m_jurisdict->jurisdict_tree();

		$this->load->model('m_department');
		$department = $this->m_department->department_hash();

		$where = array();
		//$where['name'] = $this->input->post('name');
		$where['department'] = $this->input->post('department');
		//$where['phone'] = $this->input->post('phone');
		$where['keyword']= $this->input->post('keyword');
		//if($where['name'].$where['department'].$where['phone']=='')
		if($where['keyword'].$where['department']=='')
		{
			$where = $this->session->userdata('user_select');
		}
		$this->session->set_userdata(array('user_select'=>$where));

		//---------分页------------
		$num = $this->m_user->register_num($where);

		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$this->load->library('pagination');

		$config['base_url'] = '/index.php/user/register_list/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize;

		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();
		//---------分页------------

		$re = $this->m_user->register_list($where,($page-1)*$pageSize,$pageSize);

		$this->load->helper('select');

		$data = array(
			'where'		=> $where,
			'list'		=> $re,
			'department'=> $department,
			'tree'		=> tree_check($tree),
			'select'	=> type_select(),
			'pages'	=> $pages,
		);
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'user'));
		$this->load->view('user/register_list',$data);
		$this->load->view('main_footer');
	}

	/**
	 * 新增人员
	 */
	public function add()
	{
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'));

		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
					'account'		=> $this->input->post('account'),
					'password'		=> md5('111111'),
					'name'			=> $this->input->post('name'),
					'department'	=> $this->input->post('department'),
					'phone'			=> $this->input->post('phone'),
					'def_send'		=> ($this->input->post('def_send')?'1':'0'),
				);
		if($this->m_user->user_insert($data))
		{
			redirect($this->config->base_url().'index.php/user');
		}
	}

	/**
	 * 检查账号是否已经存在
	 */
	public function checkAccount(){
		$account = $_POST['account'];
		if($_POST['id']){ //编辑人员
			$result = $this->m_user->user_get(array('account'=>$account,'del'=>0));
			if($result != false){
				if($result->id == $_POST['id']){
					echo '不存在';
				}else{
					echo '已存在';
				}
			}else{
				echo '不存在';
			}
		}else{
			$result = $this->m_user->user_get(array('account'=>$account,'del'=>0));
			if($result == false){
				echo '不存在';
			}else{
				echo '已存在';
			}
		}

	}
	/**
	 * 修改人员
	 */
	public function update()
	{

		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'));

		$id = $this->input->post('id');
		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
			'account'		=> $this->input->post('account'),
			'name'			=> $this->input->post('name'),
			'department'	=> $this->input->post('department'),
			'phone'			=> $this->input->post('phone'),
			'def_send'		=> ($this->input->post('def_send')?'1':'0'),
		);
		if($this->m_user->user_update($id,$data))
		{
			redirect($this->config->base_url().'index.php/user');
		}


	}

	/**
	 *注册人员修改
	 **/
	public function update_register(){
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'));

		$id = $this->input->post('id');
		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
			'account'		=> $this->input->post('account'),
			'name'			=> $this->input->post('name'),
			'department'	=> $this->input->post('department'),
			'phone'			=> $this->input->post('phone'),
			'def_send'		=> ($this->input->post('def_send')?'1':'0'),
		);
		if($this->m_user->user_update($id,$data))
		{
			redirect($this->config->base_url().'index.php/user/register_list');
		}
	}

	/**
	 * 删除人员
	 */
	public function delete()
	{
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'),true);

		$id = $this->input->post('id');
		if($this->m_user->user_update($id,array('del'=>'1')))
		{
			echo 'success';
		}
	}
	/**
	 * 审核注册人员
	 **/
	public function reviewed(){
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'),true);

		$id = $this->input->post('id');
		if($this->m_user->user_update($id,array('reviewed'=>'1')))
		{
			echo 'success';
		}
	}
	/**
	 * 撤销审核
	 **/
	public function reviewed_cancel(){
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'),true);

		$id = $this->input->post('id');
		if($this->m_user->user_update($id,array('reviewed'=>'2')))
		{
			echo 'success';
		}
	}

	/**
	 * 修改权限
	 */
	public function jurisdict()
	{

		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'));

		$id = $this->input->post('t_uid');
		$jurisdict = $this->input->post('tree');

		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
			'jurisdict' => $jurisdict,
		);
		if($this->m_user->user_update($id,$data))
		{
			redirect($this->config->base_url().'index.php/user');
		}


	}
	/**
	 * 注册人员权限修改
	 **/
	public function jurisdict_register(){
		$this->login->check_jurisdict('3',$this->session->userdata('user_jurisdict'));

		$id = $this->input->post('t_uid');
		$jurisdict = $this->input->post('tree');

		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		$data = array(
			'jurisdict' => $jurisdict,
		);
		if($this->m_user->user_update($id,$data))
		{
			redirect($this->config->base_url().'index.php/user/register_list');
		}
	}
	/**
	 * 获取部门、个人权限
	 */
	public function get_jurisdict()
	{
		$id = $this->input->post('id');
		$department = $this->input->post('department');
		$this->load->model('m_department');
		$jurisdict_d = $this->m_department->department_get(array('id'=>$department));

		$jurisdict_u = $this->m_user->user_get(array('id'=>$id));
		$data = array(
					'success'	=> true,
					'jurisdict_d'	=> $jurisdict_d->jurisdict,
					'jurisdict_u'	=> $jurisdict_u->jurisdict,
				);
		echo json_encode($data);
	}

	/**
	 * 修改密码
	 */
	public function pass()
	{
		$name = $this->input->post('name');
		$pass_old = $this->input->post('opass');
		$pass = $this->input->post('npass');

		$this->load->helper('select');

		$data = array(
			'select'	=> type_select(),
		);
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'user'));

		//提交表单
		if($name!='')
		{
			//判断原密码
			$user = $this->m_user->user_get(array('account'=>$name));
			if($user->password!=md5($pass_old))
			{
				$data['errorMsg'] = "原密码有误";
			}
			else
			{
				if($this->m_user->user_update($user->id,array('password'=>md5($pass))))
				{
					$this->session->sess_destroy();
					$_error =& load_class('Exceptions', 'core');
					exit($_error->show_error('重新登录', '密码修改成功，请重新登录系统', 'error_to_index'));
				}
				else
				{
					$data['errorMsg'] = "密码修改失败";
				}
			}
		}
		$this->load->view('user/pass',$data);
		$this->load->view('main_footer');
	}

	public function sort(){
		$obj_id = $this->input->post('obj_id');
		$obj_sort = $this->input->post('obj_sort');
		$link_id = $this->input->post('link_id');
		$link_sort = $this->input->post('link_sort');
		$status = $this->m_user->user_update($obj_id,array('mark'=>$link_sort));
		$status1 = $this->m_user->user_update($link_id,array('mark'=>$obj_sort));
		if($status && $status1){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
}
?>