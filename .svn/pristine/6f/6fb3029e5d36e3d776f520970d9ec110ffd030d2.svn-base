<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class remind extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		
		$this->load->model('m_remind');
		$this->load->helper('url');
		$this->load->helper('tree');
	}
	
	/**
	 * 获取提醒列表
	 */
	public function index($page='1',$pageSize='20')
	{		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'remind'));
		
		$data = array();//返回页面的数据
		
		//查询条件
		$where = array();
		$where['start'] = $this->input->post('start');
		$where['end']	= $this->input->post('end');
		$where['info']	= $this->input->post('info');
		
		if($where['start'].$where['end'].$where['info']=='' && empty($_POST))
		{
			$where = $this->session->userdata('remind_select');
		}
		else
		{
			$this->session->set_userdata(array('remind_select'=>$where));
		}
		$data['where']	= $where;
		$where['userid'] = $this->session->userdata('user_id');
		//查询结果
		//---------分页------------
		$num = $this->m_remind->remind_num($where);
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/remind/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		//---------分页------------
		
		$list = $this->m_remind->remind_list($where,($page-1)*$pageSize,$pageSize);
		$data['list'] = $list;
		
		//---------阅读状态-----------
		$read_state = $this->m_remind->get_read_by_userid($where['userid']);
		$data['read_state'] = $read_state;
		//---------阅读状态-----------
		
		$this->load->helper('select');
		$data['select'] = type_select();
		
		$this->load->view('remind/index',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 获取提醒列表
	 */
	public function manage($page='1',$pageSize='20')
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'remind'));
		
		$data = array();//返回页面的数据
		
		//查询条件
		$where = array();
		$where['start'] = $this->input->post('start');
		$where['end']	= $this->input->post('end');
		$where['info']	= $this->input->post('info');
		
		if($where['start'].$where['end'].$where['info']=='' && empty($_POST))
		{
			$where = $this->session->userdata('remind_select');
		}
		else
		{
			$this->session->set_userdata(array('remind_select'=>$where));
		}
		$data['where']	= $where;
		//查询结果
		//---------分页------------
		$num = $this->m_remind->remind_num($where);
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/remind/manage/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		//---------分页------------
		
		$list = $this->m_remind->remind_list($where,($page-1)*$pageSize,$pageSize);
		$data['list'] = $list;
		
		//******** 部门-人员 **********
		$this->load->model('m_department');
		$data['d_list'] = $this->m_department->department_list();
		
		$this->load->model('m_user');
		$userList = $this->m_user->user_list();
		if(is_array($userList))
		{
			foreach($userList as $v)
			{
				$data['u_list'][$v->department][] = $v;
				$data['u_name'][$v->id] = $v->name;
			}
		}
		//******** 部门-人员 **********
		
		$this->load->helper('select');
		$data['select'] = type_select();
		
		$this->load->view('remind/manage',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 新增提醒
	 */
	public function add()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'));
		
		$data = array(
			'info'			=> $this->input->post('info'),
			't_start'		=> $this->input->post('start'),
			't_end'			=> $this->input->post('end'),
			'userid'		=> $this->session->userdata('user_id'),
			'range_type'	=> $this->input->post('range'),
			'addtime'		=> date('Y-m-d H:i:s'),
		);
		if($data['range_type']=='1')
		{
			$data['range_user'] = $this->input->post('user');
		}
		if($this->m_remind->remind_insert($data))
		{
			echo 'success';
		}
		else
		{
			echo '提醒添加失败';
		}
	}
	
	/**
	 * 修改提醒
	 */
	public function update()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		$data = array(
			'info'			=> $this->input->post('info'),
			't_start'		=> $this->input->post('start'),
			't_end'			=> $this->input->post('end'),
			'range_type'	=> $this->input->post('range'),
		);
		if($data['range_type']=='1')
		{
			$data['range_user'] = $this->input->post('user');
		}
		else
		{
			$data['range_user'] = '';
		}
		if($this->m_remind->remind_update($id,$data))
		{
			echo 'success';
		}
		else
		{
			echo '提醒修改失败';
		}
	}
	
	/**
	 * 删除提醒
	 */
	public function delete()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		if($this->m_remind->remind_delete($id,array('del'=>'1')))
		{
			echo 'success';
		}
	}
	
	/**
	 * 发布/撤销提醒
	 */
	public function state()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		$data = array(
			'state'			=> $this->input->post('state'),
		);
		if($this->m_remind->remind_update($id,$data))
		{
			echo 'success';
		}
		else
		{
			echo '提醒'.($data['state']==1?'发布':'撤销').'失败';
		}
	}
	
	/**
	 * 已阅读人员
	 */
	public function reader()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'));
		
		$list = $this->m_remind->remind_reader($this->input->post('id'));
		if(is_array($list) && count($list)>0)
		{
			echo json_encode(array('state'=>'true','data'=>$list));
		}
		else
		{
			echo json_encode(array('state'=>'false','msg'=>'无人阅读'));
		}
	}
	
	/**
	 * 获取我的提醒
	 */
	public function get_my_remind()
	{
		$userid = $this->session->userdata('user_id');
		$list = $this->m_remind->get_remind_by_userid($userid);
		$read = $this->m_remind->get_read_by_userid($userid);
		$html = "";
		if(is_array($list))
		{
			foreach($list as $v)
			{
				if(isset($read[$v->id]) && $read[$v->id]=='2')
				{
					continue;
				}
				$html .="<li value='".$v->id."'>" .
						"<p><span id='remind_".$v->id."'" .
						((isset($read[$v->id]) && $read[$v->id]=='1')?' style="color:gray"':'') .
						">".$v->info."</span></p>" .
						((isset($read[$v->id]) && $read[$v->id]=='1')?'':"<div class='read'><a onclick='read(this,1)'>已阅</a></div>")  .
						"<div class='never'><a onclick='read(this,2)'>不再提示</a></div>" .
						"<br />" .
						"</li>";
			}
		}
		echo $html;
	}
	
	/**
	 * 获取对外的提醒
	 */
	public function get_out_remind()
	{
		$list = $this->m_remind->get_remind_by_userid('-1');
	}
		
	/**
	 * 已读标记
	 */
	public function read()
	{
		$data = array(
			'remind_id'	=> $this->input->post('id'),
			'state'		=> $this->input->post('state'),
			'user_id'		=> $this->session->userdata('user_id'),
		);
		if($this->m_remind->remind_read($data))
		{
			echo 'success';
		}
	}
}
?>