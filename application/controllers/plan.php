<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

require_once("templat_bulid.php");
class plan extends CI_Controller {

	//方案性质
	private static $plan_nature=array(
		1=>'内事',
		2=>'外事',
	);
	
	//方案类型
	private static $plan_type=array(
		1=>'会议',
		2=>'调研',
		3=>'商务接待',
		4=>'公务接待',
		5=>'其他',
	);

    function __construct()
    {
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		
		$this->load->model('m_plan');
		$this->load->model('m_plan_templet');
		$this->load->model('m_plan_ready');
                $this->load->model('m_plan_annex');
                $this->load->model('m_plan_division');
                $this->load->model('m_plan_done');
                $this->load->model('m_user');
		$this->load->model('m_department');
                $this->load->model('m_sms_report');
		$this->load->helper('url');
		$this->load->helper('tree');
                $this->load->library('sensitivestr');
               
	}
	
	public static function get_type()
	{
		return self::$plan_type;
	}
	
	public static function get_nature()
	{
		return self::$plan_nature;
	}
	
	/**
	 * 方案列表页
	 * @param unknown_type $page
	 * @param unknown_type $pageSize
	 */
	public function index($page='1',$pageSize='20')
	{
//		$_error =& load_class('Exceptions', 'core');
//		exit($_error->show_error('测试标题', '测试错误标题内容', 'error_to_index'));
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where = $this->session->userdata('plan_select');
		}
		else
		{
			$where['start'] = $this->input->post('start');
			$where['end'] 	= $this->input->post('end');
			$where['title'] = $this->input->post('title');
			$this->session->set_userdata(array('plan_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
		//---------分页------------
		$num = $this->m_plan->plan_num($where);
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/plan/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		//---------分页------------
		
		//-----根据条件获取列表------
		$list = $this->m_plan->plan_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		
		//右上角查询
		$this->load->helper('select');
		$data['select']	= type_select();
		
		$this->load->view('plan/index',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 方案内容页
	 */
	public function plan_info($id='0')
	{
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		$data = array('id'=>$id);
		if($id>0)
		{
			$data = $this->m_plan->plan_get(array('id'=>$id),'arr');
		}
		var_dump($data);
		//右上角查询
		$this->load->helper('select');
		$data['select']	= type_select();
		
		$this->load->view('plan/info',$data);
		$this->load->view('main_footer');
	}
	
	
	public function view()
	{
		$id = $this->input->post('id');
		//方案内容
		$info = $this->m_plan->plan_get(array('id'=>$id));

		echo $info->info;
	}
	
	public function add1()
	{
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		//模板
		$templet = $this->m_plan_templet->plan_templet_list();
		$data['templet'] =$templet;
		
		//当前最大编号
		$data['num'] = $this->m_plan->max_num();
		
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
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
                //类型和性质
               // print_r($this->plan_type);
                $data['type']=$this->get_type();
                $data['nature']=$this->get_nature();
		
		$this->load->view('plan/add_1',$data);
		//$this->load->view('plan/add_3',$data);
		$this->load->view('main_footer');
	}
	
	public function add()
	{
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		//模板
		$templet = $this->m_plan_templet->plan_templet_list();
		$data['templet'] =$templet;
		
		//当前最大编号
		$data['num'] = $this->m_plan->max_num();
		
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
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
                //类型和性质
               // print_r($this->plan_type);
                $data['type']=$this->get_type();
                $data['nature']=$this->get_nature();
                //$data['re_time']=date('Y-m-d',time());
		
		//$this->load->view('plan/add_1',$data);
		$this->load->view('plan/add_3',$data);
		$this->load->view('main_footer');
	}

	//添加多日方案
	public function add_more(){
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));

		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));

		//模板
		$templet = $this->m_plan_templet->plan_templet_list();
		$data['templet'] =$templet;

		//当前最大编号
		$data['num'] = $this->m_plan->max_num();

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

		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		//类型和性质
		// print_r($this->plan_type);
		$data['type']=$this->get_type();
		$data['nature']=$this->get_nature();
		//$data['re_time']=date('Y-m-d',time());

		//$this->load->view('plan/add_1',$data);
		$this->load->view('plan/add_more',$data);
		$this->load->view('main_footer');
	}
	//短信群发列表页
	public function mass_qun_index($page = '1', $pageSize = '20'){
		session_start();
		if(!empty($_SESSION['id_array'])){
			unset($_SESSION['id_array']);
		}
		$this->load->model('m_send_massage');
		//---------分页------------
//		$num = $this->m_send_massage->massage_num();
//		$data['num']	= $num;
//
//		$pages = ceil($num/$pageSize);
//		if($page>$pages)$page = $pages;
//		if($page<1)$page = 1;
//
//		$this->load->library('pagination');
//
//		$config['base_url'] = '/index.php/plan/mass_qun_index/';
//		$config['total_rows'] = $num ;
//		$config['per_page'] = $pageSize;
//
//		$this->pagination->initialize($config);
//
//		$pages = $this->pagination->create_links();
//		$data['pages']	= $pages;
//		$data['page']	= $page;
		//---------分页------------
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		$this->load->helper('select');
		$data['select'] = type_select();

		$data['info']=$this->m_send_massage->massage_list();


		foreach($data['info'] as $key=>$val){

			$where=array(
				'id' => $val['callid'],
			);
			$this->load->model('m_user');
			$user_list=$this->m_user->user_get($where);
			$data['info'][$key]['name']=$user_list->name;
		}
		$this->load->view('plan/mass_qun_index',$data);
		$this->load->view('main_footer');
	}
	//富文本编辑器
	public function area_text(){
		if(!empty($_GET['plan_id'])){
			$plan_id=$_GET['plan_id'];
			//内容
			$data['info'] = $this->m_plan->plan_get(array('id'=>$plan_id));
			$num = $data['info']->num;
			$numArray = explode('-', $num);
			$data['info']->year = $numArray[0];
			$data['info']->users = explode(',',$data['info']->users);
			$data['info']->infos = $data['info']->info;
			preg_match_all('/<[^<]*>/',$data['info']->infos,$match); //去掉html标签
			foreach($match[0] as $value){
				$data['info']->infos = str_replace($value, '', $data['info']->infos);
			}
			$data['info']->message=$this->getPlanInfo($plan_id);
			$data['info']->message=  str_replace("<br/>","\n" , $data['info']->message);


			//$this->load->view('plan/add_1',$data);
			$this->load->view('plan/area_text',$data);
		}else{
			$this->load->view('plan/area_text');
		}

		$this->load->view('main_footer');
	}
	//富文本编辑器内容存入session
	public function area_session(){
		session_start();
		if(!empty($_POST['editorValue'])){
			$_SESSION['plan_area']=$_POST['editorValue'];
		}

	}
	//短信群发页
	public function mass_qun()
	{
		//每次刷新页面的时候将session中存放的id删掉
		session_start();
		if(!empty($_SESSION['id_array'])){
			unset($_SESSION['id_array']);
		}
		//头部文件
		$this->load->view('main_header');
		//底部文件
		$this->load->view('main_footer');
		//模板顶部的全局搜索
		$this->load->helper('select');
		$data['select'] = type_select();


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

		//输出模板,变量
		$this->load->view('plan/mass_qun_show',$data);
		//左侧菜单引用
		$this->load->view('main_menu',array('menu'=>'plan'));
	}


	//短信重发
	public function mass_qun_chong($id){
		session_start();
		if(!empty($_SESSION['id_array'])){
			unset($_SESSION['id_array']);
		}
		if(!empty($_SESSION['mp_id_array'])){
			unset($_SESSION['mp_id_array']);
		}


		//获取id
		if(!empty($id)){
			//send_massage表中查到内部id nbid 和名片id mpid的值
			$data['is_id']=$id;
			$id_array=array(
				'id' => $id,
				'is_del' => '0',

			);

			$this->load->model('m_send_massage');
			$data['list_one']=$this->m_send_massage->massage_get($id_array);

			//分别判断mpid和nbid 如果为0说明没有选中则返回空数组
			if($data['list_one']['nbid']!=0){
				$where=array(
					'u_id'=>substr($data['list_one']['nbid'],0,-1),

				);

				$userList = $this->m_user->user_get_r($where);
				$this->load->model('m_department');
				$d_list = $this->m_department->department_list();

				$d_list_new=array();
				foreach($d_list as $key=>$val){
					$d_list_new[$val->id]=$val->name;
				}

				if(!empty($userList)){
					foreach($userList as $key=>$val){
						$userList[$key]['d_name']=$d_list_new[$val['department']];
						//工作人员的标识
						$userList[$key]['ry_type']='工作人员';
					}
					$data['nb_list']=$userList;
				}
			}

			//名片人员list
			if($data['list_one']['mpid']!=0){
				$this->load->model('m_contact_select');
				$nbid_string['u_id']=substr($data['list_one']['mpid'],0,-1);
				//$nbid_array=explode(",",$nbid_string);
				$where=explode(',',$nbid_string['u_id']);
				//将mp的id继续存放的session中 以便查询单条时候添加使用

				foreach($where as $key=>$val){
					$_SESSION['mp_id_array'][$val]=$val;
				}
				$userList_mp = $this->m_contact_select->contact_list_r($where);
				foreach($userList_mp as $key=>$val){
					//联系人信息
					$this->load->model('m_contact_total');
					$relArr = $this->m_contact_total->join_contact($val['u_id']);
					$array = $relArr[$val['u_id']];

					//电话和地址的数组
					$mobile = isset($array) ? explode(',', $array) : array();
					$userList_mp[$key]['mobile']=$mobile;
					$userList_mp[$key]['ry_type']='名片人员';
				}
				$data['mp_list']=$userList_mp;
			}


		}

		//头部文件
		$this->load->view('main_header');
		//底部文件
		$this->load->view('main_footer');
		//模板顶部的全局搜索
		$this->load->helper('select');
		$data['select'] = type_select();
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
		if(!empty($data['list_one']['otherphone'])){
			$data['list_one']['otherphone']=substr($data['list_one']['otherphone'],0,-1);
			//$nbid_array=explode(",",$nbid_string);
			$data['list_one']['otherphone']=explode(',',$data['list_one']['otherphone']);
		}
		//输出模板,变量
		$this->load->view('plan/mass_qun_show',$data);
		//左侧菜单引用
		$this->load->view('main_menu',array('menu'=>'plan'));
	}



	/*ajax查询名片*/
	public function ajax_mp(){
		session_start();
		//unset($_SESSION['id_array']);

		if(!empty($_POST)){
			$ids_array=explode(",",$_POST['ids']);

			//$_SESSION['id_array']=$ids_array;
			//$count=count($_SESSION['id_array']);
			foreach($ids_array as $key=>$val){
				$_SESSION['id_array'][$val]=$val;

			}

		}
		print_r($_SESSION['id_array']);

	}
	/*ajax其他号码*/
	public function ajax_qita(){
		$moblie_q=str_ireplace("；",',',$_POST['tel']);
		$moblie_q_r=str_ireplace("；",',',$moblie_q);
		$moblie_q_r=substr($moblie_q_r,0,-1);
		//$nbid_array=explode(",",$nbid_string);
		$moblie_q_r=explode(',',$moblie_q_r);

		$html="";
		foreach($moblie_q_r as $key=>$val){
		if(!empty($val)){
		$html .= "<tr id='qt_rr_$key'>"
        ."<input type='hidden' name='phone' value='$val'>"
        ."<input type='hidden' name='qt_phone' value='$val'>"
        ."<td>其他号码</td>"
        ."<td>"
        ."$val"
        ."</td>"
        ."<td><a href='javascript:void(0)' onclick='del_qt_rr($key)'>删除</a></td>"
        ."</tr>";
		}
		}
		echo $html;
	}
	/*ajax查询session中的名片*/
	public function ajax_session(){
		session_start();
		if(isset($_SESSION['id_array'])){
			unset($_SESSION['id_array'][0]);
			$this->load->model('m_contact_select');
			$id_array['u_id']=implode(',',$_SESSION['id_array']);
			$where=explode(',',$id_array['u_id']);
			$userList = $this->m_contact_select->contact_list_r($where);
			foreach($userList as $key=>$val){
			//联系人信息
			$this->load->model('m_contact_total');
			$relArr = $this->m_contact_total->join_contact($val['u_id']);
			$data = $relArr[$val['u_id']];

			//电话和地址的数组
			//$data['mobile'] = isset($data['mobile']) ? explode(',', $data['mobile']) : array();
			$mobile=$data['mobile'];
//			$data['address'] = isset($data['address_contact']) ? explode(',', $data['address_contact']) : array();
//			$data['tel'] = isset($data['tel']) ? explode(',', $data['tel']) : array();
//			$data['fax'] = isset($data['fax']) ? explode(',', $data['fax']) : array();
//			$data['email'] = isset($data['email']) ? explode(',', $data['email']) : array();
			echo "<tr id='mp_".$val['u_id']."'>
				<input type='hidden' name='phone' value='".$mobile."'>
				<input type='hidden' name='mp_id' value='".$val['u_id']."'>
				<td>名片人员</td>
				<td>
				".$val['c_name']."/".$val['position']."/".$val['u_name']."/".$mobile."</div>
				</td>
				<td><a href='javascript:void(0)' onclick='del_mp(".$val['u_id'].")'>删除</a></td>
			</tr>";
			}
		}


	}
	/*ajax名片复选框取消*/
	public function ajax_mp_quxiao(){
		session_start();
		if(!empty($_POST['id'])){
			$id=$_POST['id'];
			unset($_SESSION['id_array'][$id]);
			print_r($_SESSION['id_array']);
		}

	}
	/*ajax名片复选框取消全部*/
	public function ajax_mp_quxiao_r(){
		session_start();
		if(!empty($_POST['ids'])){
			$ids=explode(",",$_POST['ids']);
		}
		foreach($ids as $key=>$val){
			unset($_SESSION['id_array'][$val]);
		}
		print_r($_SESSION['id_array']);
	}

	/*ajax查询use表中的数据*/
	public function ajax_user(){
		if(!empty($_POST)){
			$userList = $this->m_user->user_get_r($_POST);
			$this->load->model('m_department');
			$d_list = $this->m_department->department_list();
//			foreach($userList as $key=>$val){
//				$userList[$key]['d_name']=
//			}
			$d_list_new=array();
			foreach($d_list as $key=>$val){
				$d_list_new[$val->id]=$val->name;
			}

			if(!empty($userList)){
				foreach($userList as $key=>$val){
					$userList[$key]['d_name']=$d_list_new[$val['department']];
					//工作人员的标识
					$userList[$key]['ry_type']='工作人员';
				}
				foreach($userList as $key2=>$val2){
					echo "<tr id='nb_".$val2['id']."'>
							<input type='hidden' name='phone' value='".$val2['phone']."'>
							<input type='hidden' name='nb_id' value='".$val2['id']."'>
							<td>".$val2['ry_type']."</td>
							<td><span class='part'>".$val2['d_name']."</span>/<span class='part'>".$val2['name']."/".$val2['phone']."</span></td>
							<td><a href='javascript:void(0)' onclick='del_nb(".$val2['id'].")'>删除</a></td>
						</tr>";
				}
			}else{
				echo "";
			}
		}


	}
	public function edit($id)
	{
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		//内容
		$data['info'] = $this->m_plan->plan_get(array('id'=>$id));
		
		//准备事项
		//$this->load->model('m_plan_ready');
		$ready=$this->m_plan_ready->plan_ready_list(array('plan_id'=>$id));
		if(is_array($ready))
		{
		    foreach($ready as $v)
		    {
			$data['ready'][$v->id]=$v->info;		
		    }
		}
		//附件信息
		$file=$this->m_plan_annex->plan_annex_list(array('plan_id'=>$id));
		if(is_array($file))
		{
			$data['file']=$file;
		}
		
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
		
		$join_user=explode(',',$data['info']->join_user);
		if(!empty($join_user)){
			$u=array();
			foreach($join_user as $val)
			{
			    foreach($userList as $v)
			    {
			    	if($val==$v->id)
			    	{
			    		$u[]=$v->name;
			    	}
			    }
			}
			$user=  implode(',', $u);
			$data['info']->join_user=$user;
		}
		
		//参加范围
		$join_dept=explode(',',$data['info']->join_dept);
		if(!empty($join_dept))
		{
			$d=array();
			foreach($join_dept as $val)
			{
			    foreach($data['d_list'] as $v)
			    {
			    	if($val==$v->id)
			    	{
						$d[]=$v->name;
					}
			    }
			}
			$dept = implode(',', $d);
			$data['info']->join_dept=$dept;
		}
		
		//类型和性质
		$data['plan_nature']=$this->get_nature();
		$data['plan_type']=$this->get_type();
		
		//print_r($data['info']->join_user);
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		
		$this->load->view('plan/edit',$data);
		$this->load->view('main_footer');
	}	
	/*
	 * 方案管理单条
	 * */
	public function edit_2($id)
	{
		//内容
		$data['info'] = $this->m_plan->plan_get(array('id'=>$id));
		$num = $data['info']->num;
		$numArray = explode('-', $num);
		$data['info']->year = $numArray[0];
		$data['info']->users = explode(',',$data['info']->users);
		$data['info']->infos = $data['info']->info;
		preg_match_all('/<[^<]*>/',$data['info']->infos,$match); //去掉html标签
		foreach($match[0] as $value){
			$data['info']->infos = str_replace($value, '', $data['info']->infos);
		}
		$data['info']->message=$this->getPlanInfo($id);
		$data['info']->message=  str_replace("<br/>","\n" , $data['info']->message);


		//准备事项
		//$this->load->model('m_plan_ready');
		$ready=$this->m_plan_ready->plan_ready_list(array('plan_id'=>$id));
		if(is_array($ready))
		{
			foreach($ready as $v)
			{
				$data['ready'][$v->id]=$v->info;
			}
		}
		//附件信息
		$file=$this->m_plan_annex->plan_annex_list(array('plan_id'=>$id));
		if(is_array($file))
		{
			$data['file']=$file;
		}
		//具体安排
		$done=$this->m_plan_done->plan_done_list(array('plan_id'=>$id));
		if(is_array($done))
		{
			$data['done']=$done;
		}

		//分工内容
		$division=$this->m_plan_division->plan_division_list(array('plan_id'=>$id));
		if(is_array($division))
		{
			$data['division']=$division;
		}

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
		//出席领导

		$join_user=explode(',',$data['info']->join_user);
		if(!empty($join_user)){
			$u=array();
			foreach($join_user as $val)
			{
				foreach($userList as $v)
				{
					if($val==$v->id)
					{
						$u[]=$v->name;
					}
				}
			}
			$user=  implode(',', $u);
			$data['info']->join_user=$user;
		}

		//参加范围
		$join_dept=explode(',',$data['info']->join_dept);
		if(!empty($join_dept))
		{
			$d=array();
			foreach($join_dept as $val)
			{
				foreach($data['d_list'] as $v)
				{
					if($val==$v->id)
					{
						$d[]=$v->name;
					}
				}
			}
			$dept = implode(',', $d);
			$data['info']->join_dept=$dept;
		}

		//类型和性质
		$data['plan_nature']=$this->get_nature();
		$data['plan_type']=$this->get_type();

		//print_r($data['info']->join_user);
		return $data;

	}
	public function edit_1($id)
	{
		$data['plan_id']=$id;
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		//内容
		$data['info'] = $this->m_plan->plan_get(array('id'=>$id));
		$data['point_lng'] = explode(';',$data['info']->c_point_lng);
		$data['point_lat'] = explode(';',$data['info']->c_point_lat);
		$num = $data['info']->num;
		$numArray = explode('-', $num);
		$data['info']->year = $numArray[0];
		$data['info']->users = explode(',',$data['info']->users);
		$data['info']->infos = $data['info']->info;
		preg_match_all('/<[^<]*>/',$data['info']->infos,$match); //去掉html标签
		foreach($match[0] as $value){
			$data['info']->infos = str_replace($value, '', $data['info']->infos);
		}
                $data['info']->message=$this->getPlanInfo($id);
                $data['info']->message=  str_replace("<br/>","\n" , $data['info']->message);
                
		
		//准备事项
		//$this->load->model('m_plan_ready');
		$ready=$this->m_plan_ready->plan_ready_list(array('plan_id'=>$id));
		if(is_array($ready))
		{
		    foreach($ready as $v)
		    {
			$data['ready'][$v->id]=$v->info;		
		    }
		}
		//附件信息
		$file=$this->m_plan_annex->plan_annex_list(array('plan_id'=>$id));
		if(is_array($file))
		{
			$data['file']=$file;
		}

		//具体安排
		$done=$this->m_plan_done->plan_done_list(array('plan_id'=>$id));
		if(is_array($done))
		{
			$data['done']=$done;
		}

	    //分工内容
		$division=$this->m_plan_division->plan_division_list(array('plan_id'=>$id));
		if(is_array($division))
		{
			$data['division']=$division;
		}
		
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
		//出席领导
		
		$join_user=explode(',',$data['info']->join_user);
		if(!empty($join_user)){
			$u=array();
			foreach($join_user as $val)
			{
			    foreach($userList as $v)
			    {
			    	if($val==$v->id)
			    	{
			    		$u[]=$v->name;
			    	}
			    }
			}
			$user=  implode(',', $u);
			$data['info']->join_user=$user;
		}
		
		//参加范围
		$join_dept=explode(',',$data['info']->join_dept);
		if(!empty($join_dept))
		{
			$d=array();
			foreach($join_dept as $val)
			{
			    foreach($data['d_list'] as $v)
			    {
			    	if($val==$v->id)
			    	{
						$d[]=$v->name;
					}
			    }
			}
			$dept = implode(',', $d);
			$data['info']->join_dept=$dept;
		}
		
		//类型和性质
		$data['plan_nature']=$this->get_nature();
		$data['plan_type']=$this->get_type();
		
		//print_r($data['info']->join_user);
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		//显示出席领导和范围
		$data['cxld']="";
		if(!empty($data['info']->names_show_shi)){
			$data['cxld'].=$data['info']->names_show_shi;
		}
		if(!empty($data['info']->department_show_shi)){
			$data['cxld'].=",".$data['info']->department_show_shi;
		}
		if(!empty($data['info']->names_show_qu)){
			$data['cxld'].=",".$data['info']->names_show_qu;
		}
		if(!empty($data['info']->department_show_qu)){
			$data['cxld'].=",".$data['info']->department_show_qu;
		}
		if(!empty($data['info']->join_user)){
			$data['cxld'].=",".$data['info']->join_user;
		}
		if(!empty($data['info']->names_show_qita)){
			$data['cxld'].=",".$data['info']->names_show_qita;
		}
		$data['cxld']=preg_replace('/^,+/','',$data['cxld']);
		//显示参加范围
		$data['cjfw']="";
		if(!empty($data['info']->join_dept)){
			$data['cjfw'].=$data['info']->join_dept;
		}
		if(!empty($data['info']->department_show_qita)){
			$data['cjfw'].=",".$data['info']->department_show_qita;
		}
		$data['cjfw']=preg_replace('/^,+/','',$data['cjfw']);
		$data['info_title']=explode("|",$data['info']->info_title);
		$data['people_name']=unserialize($data['info']->people_name);
		$data['people_phone']=unserialize($data['info']->people_phone);
		$this->load->view('plan/edit_1',$data);
		$this->load->view('main_footer');
	}
	
	public function sendmessage($id){
		//内容
		$data['info'] = $this->m_plan->plan_get(array('id'=>$id));
		preg_match_all('/<[^<]*>/',$data['info']->info,$match); //去掉html标签
		foreach($match[0] as $value){
			$data['info']->info = str_replace($value, '', $data['info']->info);
		}
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
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
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		
		$this->load->view('plan/sendmessage',$data);
		$this->load->view('main_footer');
	}
	/**
	 *
	 * 活动方案短信群发
	 */
	public function pushmessage_r(){
		//刷新页面初始化session id_array mp_id_array
		session_start();
		if(!empty($_SESSION['id_array'])){
			unset($_SESSION['id_array']);
		}
		if(!empty($_SESSION['mp_id_array'])){
			unset($_SESSION['mp_id_array']);
		}
		//发送人的id
		$callid=$this->session->userdata('user_id');
		//发送内容
		if(!empty($_POST['mass_area'])){
			$msg=$_POST['mass_area'];
		}
		//内部人员id集合以 "," 隔开
		if(!empty($_POST['nb_id'])){
			$nbid=$_POST['nb_id'];
		}else{
			$nbid=0;
		}
		//名片人员id集合以 "," 隔开
		if(!empty($_POST['mp_id'])){
			$mpid=$_POST['mp_id'];
		}else{
			$mpid=0;
		}
		//当前插入表时间
		$time=date('y-m-d h:i:s',time());

		if(!empty($_POST['str']) || !empty($_POST['qt_phone'])){
			$moblie=str_ireplace("；",',',$_POST['str']);
			$moblie_r=str_ireplace("；",',',$moblie);
			$moblie_q=str_ireplace("；",',',$_POST['qt_phone']);
			$moblie_q_r=str_ireplace("；",',',$moblie_q);

			$subject = $_POST['mass_area'];
			$senstr=$this->sensitivestr->filter_SensitiveStr($subject);
			if($senstr!=""){
				echo '发送失败！短信内容含有敏感字符：“'.$senstr.'”,请修改后重新发送。';
				exit();
			}
			$msg =$subject;
//			$msg=$_POST['mass_area'];
			$result=$this->sendSMS($moblie_r, $msg, 'true');
			$data = explode('\n',$result);
			$data1 = explode(',',$data[0]);

			if($data1[1] == 0){
				$data = array(
					'callid'		=> $callid,
					'msg'			=> $msg,
					'nbid'			=> $nbid,
					'mpid'	        => $mpid,
					'time'			=> $time,
					'otherphone'    => $moblie_q_r,

					'is_del'        => '0',
				);

				$this->load->model('m_send_massage');
				if($this->m_send_massage->massage_insert($data))
				{
					echo '发送成功';
				}


			}elseif($data1[1] == 106){
				echo '消息内容超过限制';
			}else{
				echo '发送失败';
			}
		}else{
			echo "没有选择联系人";
		}
	}
	/**
	 * 
	 * 短信群发功能
	 */
	public function pushmessage(){
		$id = $_POST['id'];
		$user = $_POST['user'];
		$newData['users']		= $user;
		$re = $this->m_plan->plan_update($id,$newData);
		$this->m_plan->plan_state($id,1);  //发布
		$subject = $_POST['text'];
                $senstr=$this->sensitivestr->filter_SensitiveStr($subject);
                if($senstr!=""){
                    echo '发送失败！短信内容含有敏感字符：“'.$senstr.'”,请修改后重新发送。';
                    exit();
                }
                $msg =$subject;
		$userArr = explode(',',$user);
		$this->db->where_in('id',$userArr);
		$row =  $this->db->get('t_user')->result_array();
		foreach($row as $key=>$value){
			if(!empty($value['phone'])){
				$phoneArray[] = $value['phone'];
			}
		}
		if(!empty($phoneArray)){
			$mobile = implode(',',$phoneArray);
		}               
		$result=$this->sendSMS($mobile, $msg, 'true');
		$data = explode('\n',$result);
		$data1 = explode(',',$data[0]);


		if($data1[1] == 0){
			//发送人的id
			$callid=$this->session->userdata('user_id');
			$data = array(
				'callid'		=> $callid,
				'msg'			=> $msg,
				'nbid'			=> $user,
				'mpid'	        => '0',
				'time'			=> date('y-m-d h:i:s',time()),
				'is_del'        => '0',
				'is_web'        => '1',
			);

			$this->load->model('m_send_massage');
			if($this->m_send_massage->massage_insert($data))
			{
				echo '发送成功';
			}
		}elseif($data1[1] == 106){
			echo '消息内容超过限制';
		}else{
			echo '发送失败';
		}
		
	}
	
	/**
	 * 
	 * 推送测试
	 */
	public function testpush(){
		$subject = $_POST['text'];
		$msg = urlencode($subject);
		$mobile= trim($_POST['phone']);
		$url = 'http://222.73.117.158/msg/HttpBatchSendSM?account=Tjsbkj888&pswd=Tjsbkj888&mobile='.$mobile.'&msg='.$msg.'&needstatus=true';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($ch);
		$data = explode('\n',$result);
		$data1 = explode(',',$data[0]);
		curl_close($ch);
		if($data1[1] == 0){
			echo '发送成功';
		}elseif($data1[1] == 106){
			echo '消息内容超过限制';
		}else{
			echo '发送失败';
		}
		
	}
	
	public function testpush1(){
		$subject = '分析认为今日沪指在权重股的集体拉升下大涨多点前期表现弱势的券商保险领涨两市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛市基本进入了中期拉升阶段投资者对此要有清醒的认识在牛市中追涨杀跌是兵家大忌趋势向上就需要顺势而为分析认为今日沪指在权重股的集体拉升下大涨多点前期表现弱势的券商保险领涨两市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛市基本进入了中期拉升阶段投资者对此要有清醒的认识在牛市中追涨杀跌是兵家大忌趋势向上就需要顺势而为分析认为今日沪指在权重股的集体拉升下大涨多点前期表现弱势的券商保险领涨两市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛市基本进入了中期拉升阶段投资者对此要有清醒的认识在牛市中追涨杀跌是兵家大忌趋势向上就需要顺势而为分析认为今日沪指在权重股的集体拉升下大涨多点前期表现弱势的券商保险领涨两市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛市基本进入了中期拉升阶段投资者对此要有清醒的认识在牛市中追涨杀跌是兵家大忌趋势向上就需要顺势而为分析认为今日沪指在权重股的集体拉升下大涨多点前期表现弱势的券商保险领涨两市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛市基本进入了中期市目前沪指已经稳稳地站上均线上中期上行走势基本奠定牛';
		$msg = urlencode($subject);
		$mobile = '13662141017';
		$url = 'http://222.73.117.158/msg/HttpBatchSendSM?account=Tjsbkj888&pswd=Tjsbkj888&mobile='.$mobile.'&msg='.$msg.'&needstatus=true';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($ch);
		echo $result;	
		$data = explode('\n',$result);
		$data1 = explode(',',$data[0]);
		curl_close($ch);
		if($data1[1] == 0){
			echo '发送成功';
		}else{
			echo '发送失败';
		}
		
	}
	
			
	public function create_1()
	{
	   	    
		$id		= $this->input->post('c_templet');
		if($id=='0')
		{
			exit('');
		}
		$title		= $this->input->post('c_title');
		$c_num          =$this->input->post('c_num_n');
		$num		= $this->input->post('c_num_y').'-'.$c_num;
		$affairs	= $this->input->post('c_affairs');
		$starttime	= $this->input->post('c_start');
		$remark		= $this->input->post('c_remark');
		$remark     = str_replace("\n","<br>",$remark);  
		$name		= explode(',',$this->input->post('c_names'));
		$department	= explode(',',$this->input->post('c_department'));
		$address	= $this->input->post('c_address');
		$time		= $this->input->post('c_time');
		$plan		= $this->input->post('c_plan');
		$done		= $this->input->post('c_done');
		$ready      =$this->input->post('c_ready');
		$other      =$this->input->post('c_other');
		$nature     =$this->input->post('c_nature');
		$type       =$this->input->post('c_type');
		$file       =$this->input->post('c_file');
		$url          =$this->input->post('c_fileurl');
		
		$start = strtotime($starttime);
		$year = date('Y',$start);
		$month = date('m',$start);
		$day = date('d',$start);
		$week = date('w',$start);
		$arr_week = array('日','一','二','三','四','五','六');
		$hour = date('H',$start);
		$minute = date('i',$start);
		
		//方案模板
		$templet = $this->m_plan_templet->plan_templet_get(array('id'=>$id));
		
		$arr = explode('$',$templet->info);
		$str = '';
		if(is_array($arr))
		{
			for($k=0;$k<count($arr);$k++)
			{
				$v = $arr[$k];
				switch($v)
				{
					case 'title':
					case 'num':
					case 'affairs':
					case 'year':
					case 'month':
					case 'day':
					case 'hour':
					case 'minute':
					case 'remark':
						$str .= $$v;
						break;
					case 'week':
						$str .= $arr_week[$week];
						break;
					case 'for':
						$k++;
						$between = $arr[$k];//中间内容
						$type = '';
						
						for($j=$k;$j<count($arr);$j++)
						{
							if(in_array($arr[$j],array('address','name','department','plan','done')))
							{
								$type = $arr[$j];
								break;
							}
						}
						
						if(in_array($type,array('address','name','department')) && count($$type)>0)
						{
							$n = 0;
							$list = $$type;
							for($i=0;$i<count($list);$i++)
							{
								if($list[$i]=='')
								{
									continue;
								}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]==$type)
									{
										$str .= $list[$i];
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						if($type=='plan' &&  count($plan)>0)
						{
							$n = 0;
							for($i=0;$i<count($plan);$i++)
							{
								if($plan[$i]=='')
								{
									continue;
								}
								//if($time[$i]=='')
								//{
								//	continue;
								//}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]=='plan')
									{
										$str .= $plan[$i];
									}
									elseif($arr[$k1]=='time')
									{
                                                                               $str .= $time[$i]; 	
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						if($type=='done' &&  count($done)>0)
						{
							$n = 0;
							for($i=0;$i<count($done);$i++)
							{
								if($done[$i]=='')
								{
									continue;
								}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]=='done')
									{
										$str .= $done[$i];
									}
									elseif($arr[$k1]=='i')
									{
										$str .= $n;
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						
						do{
							++$k;
						}while($arr[$k]!='endfor');
						break;
					default:
						$str .= $v;
						break;
				}
			}
		}
		$this->login->check_jurisdict('12',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
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
		//类型和性质
		$data['plan_nature']=$this->get_nature();
		$data['plan_type']=$this->get_type();
		//右上角查询
		$this->load->helper('select');
		
		$data['select'] = type_select();
		$data['info']['title']=$title;
		$data['info']['num']=$num;
		$data['info']['users']=$name;
		$data['info']['department']=$department;
		$data['info']['start']=$starttime;
		$data['info']['other']=$other;
		$data['info']['ready']=$ready;
		$data['info']['info']=$str;
		$data['info']['c_num']=$c_num;
		$data['info']['nature']=$nature;
		$data['info']['type']=$type;
		$data['info']['file']=$file;
		$data['info']['fileurl']=$url;
		$this->load->view('plan/add_2',$data);
		$this->load->view('main_footer');
	} 
	
	
	
	public function create()
	{
		$id		= $this->input->post('c_templet');
		if($id=='0')
		{
			exit('');
		}
		$title		= $this->input->post('c_title');
		$num		= $this->input->post('c_num_y').'-'.$this->input->post('c_num_n');
		$affairs	= $this->input->post('c_affairs');
		$start		= $this->input->post('c_start');
		$remark		= $this->input->post('c_remark');                
		$remark 	= str_replace("\n","<br>",$remark);  
		$name		= explode(',',$this->input->post('c_names'));
		$department	= explode(',',$this->input->post('c_department'));
		$address	= $this->input->post('c_address');
		$time		= $this->input->post('c_time');
		$plan		= $this->input->post('c_plan');
		$done		= $this->input->post('c_done');
		$ready		=$this->input->post('c_ready');
		$other		=$this->input->post('c_other');
		$files		=$this->input->post('c_files');
		$re_time        =$this->input->post('re_time');
		$start = strtotime($start);
		$year = date('Y',$start);
		$month = date('m',$start);
		$day = date('d',$start);
		$week = date('w',$start);
		$arr_week = array('日','一','二','三','四','五','六');
		$hour = date('H',$start);
		$minute = date('i',$start);
		
		//方案模板
		$templet = $this->m_plan_templet->plan_templet_get(array('id'=>$id));
		
		$arr = explode('$',$templet->info);
		$str = '';
		if(is_array($arr))
		{
			for($k=0;$k<count($arr);$k++)
			{
				$v = $arr[$k];
				switch($v)
				{
					case 'title':
					case 'num':
					case 'affairs':
					case 'year':
					case 'month':
					case 'day':
					case 'hour':
					case 'minute':
                                        case 're_time':    
					case 'remark':
						$str .= $$v;
						break;
					case 'week':
						$str .= $arr_week[$week];
						break;
					case 'for':
						$k++;
						$between = $arr[$k];//中间内容
						$type = '';
						
						for($j=$k;$j<count($arr);$j++)
						{
							if(in_array($arr[$j],array('address','name','department','plan','done')))
							{
								$type = $arr[$j];
								break;
							}
						}
						
						if(in_array($type,array('address','name','department')) && count($$type)>0)
						{
							$n = 0;
							$list = $$type;
							for($i=0;$i<count($list);$i++)
							{
								if($list[$i]=='')
								{
									continue;
								}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]==$type)
									{
										$str .= $list[$i];
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						if($type=='plan' &&  count($plan)>0)
						{
							$n = 0;
							for($i=0;$i<count($plan);$i++)
							{
								if($plan[$i]=='')
								{
									continue;
								}
								//if($time[$i]=='')
								//{
								//	continue;
								//}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]=='plan')
									{
										$str .= $plan[$i];
									}
									elseif($arr[$k1]=='time')
									{
                                                                               $str .= $time[$i]; 
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						if($type=='done' &&  count($done)>0)
						{
							$n = 0;
							for($i=0;$i<count($done);$i++)
							{
								if($done[$i]=='')
								{
									continue;
								}
								if($n>0)
								{
									$str .= $between;
								}
								$n++;
								$k1 = $k+1;
								do{
									if($arr[$k1]=='done')
									{
										$str .= $done[$i];
									}
									elseif($arr[$k1]=='i')
									{
										$str .= $n;
									}
									else
									{
										$str .= $arr[$k1];
									}
									$k1++;
								}while($arr[$k1]!='endfor');
							}
						}
						
						do{
							++$k;
						}while($arr[$k]!='endfor');
						break;
					default:
						$str .= $v;
						break;
				}
			}
		}
		//echo $ready;
		echo "<div id='ccinfo'>".$str."</div><script>parent.create(document.getElementById('ccinfo').innerHTML);</script>";
	}
	// Greenwich Mean Time
	function timeToSec($time) {
		$p = explode(' ',$time);
		$p[0]=explode('-',$p[0]);
		$p[1]=explode(':',$p[1]);
		$year    = intval($p[0][0]);
        $month   = intval($p[0][1]);
		$day     = intval($p[0][2]);
		$hour    = intval($p[1][0]);
		$minute  = intval($p[1][1]);
		$secs = $year*365*24*60*60+$month*30*24*60*60+$day*24*60*60+$hour*60*60+$minute*60;
		return $secs;
	}
	//端口监听测试
	public function socket(){
		//确保在连接客户端时不会超时
			set_time_limit(0);

			$ip = '127.0.0.1';
			$port = 80;

			/*
			 +-------------------------------
			 *    @socket通信整个过程
			 +-------------------------------
			 *    @socket_create
			 *    @socket_bind
			 *    @socket_listen
			 *    @socket_accept
			 *    @socket_read
			 *    @socket_write
			 *    @socket_close
			 +--------------------------------
			 */

			/*----------------    以下操作都是手册上的    -------------------*/
			if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
				echo "socket_create() fial massage:".socket_strerror($sock)."\n";
			}

			if(($ret = socket_bind($sock,$ip,$port)) < 0) {
				echo "socket_bind() fial massage:".socket_strerror($ret)."\n";
			}

			if(($ret = socket_listen($sock,4)) < 0) {
				echo "socket_listen() fial massage:".socket_strerror($ret)."\n";
			}

			$count = 0;

			do {
				if (($msgsock = socket_accept($sock)) < 0) {
					echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
					break;
				} else {

					//发到客户端

					$msg ="su\n";
					socket_write($msgsock, $msg, strlen($msg));

					echo "sus\n";
					$buf = socket_read($msgsock,8192);


					$talkback = "massage:$buf\n";
					echo $talkback;

					if(++$count >= 5){
						break;
					};


				}
				//echo $buf;
				socket_close($msgsock);

			} while (true);

			socket_close($sock);
	}

	//活动方案word内容生成新方式
	public function moban(){
		$title		= $this->input->post('c_title');
		$c_num      =$this->input->post('c_num_n');
		$num		= $this->input->post('c_num_y').'-'.$c_num;
		$affairs	= $this->input->post('c_affairs');
		$starttime	= $this->input->post('c_start');
		$person     = $this->input->post('person_names_h');
		$remark		= $this->input->post('c_remark');
		$c_re_time        =$this->input->post('c_re_time');
		//附件标题
		$info_title  =$this->input->post('info_title_h');

	}
	//生成模板文件测试
	public function save_1()
	{
		$title		= $this->input->post('c_title');
		$c_num          =$this->input->post('c_num_n');
		$num		= $this->input->post('c_num_y').'-'.$c_num;
		$affairs	= $this->input->post('c_affairs');
		$starttime	= $this->input->post('c_start');
		$person     = $this->input->post('person_names_h');
		$remark		= $this->input->post('c_remark');
		$c_re_time        =$this->input->post('c_re_time');
		//附件标题
		$info_title  =$this->input->post('info_title_h');

		$a=substr($c_re_time,0,4);
		$b=substr($c_re_time,5,2);
		$c=substr($c_re_time,8,2);
		//首位0字符去掉，我真不会用正则
		$b=preg_replace('/^0+/','',$b);
		$c=preg_replace('/^0+/','',$c);
		$re_time=$a."年".$b."月".$c."日";
                
		$remark     = str_replace("\n","<br>",$remark);
		//怪b需求截取名字后两位
		$c_name_r=$this->input->post('c_names');
		$ex_name=explode(",",$c_name_r);
		foreach($ex_name as $key_e=>$val_e){
			if(mb_strlen($ex_name[$key_e])>2){
				$ex_name[$key_e]=mb_substr($ex_name[$key_e],1,3);
			}
		}
		$c_name_r=implode(',',$ex_name);
		//新加入字段区领导和区部门
		$department_show_qu=$this->input->post('department_show_qu');
		$names_show_qu=$this->input->post('names_show_qu');

		$name_r   = explode(',',$this->input->post('c_names'));
		$name	= explode(',',$this->input->post('names_show_shi').",".$this->input->post('department_show_shi').",".$names_show_qu.",".$department_show_qu.",".$c_name_r.",".$this->input->post('names_show_qita'));
		$department_r =explode(',',$this->input->post('c_department'));
		$depart_qita=$this->input->post('department_show_qita');
		if(empty($department_r) && !empty($depart_qita)){
			$department = explode(',',$this->input->post('department_show_qita'));
		}else{
			$department	= explode(',',$this->input->post('c_department').",".$this->input->post('department_show_qita'));
		}
		$address	= $this->input->post('c_address');

		$point_lng      = $this->input->post('c_point_lng');
		$point_lat      = $this->input->post('c_point_lat');

		$time		= $this->input->post('c_time');
		$plan		= $this->input->post('c_plan');

		//添加联系人
		$people_name     = $this->input->post('people_name');
		$people_phone    = $this->input->post('people_phone');


		$done		= $this->input->post('c_done');
		$ready      =$this->input->post('c_ready');
		$other      =$this->input->post('c_other');
		$nature     =$this->input->post('c_nature');
		$c_type       =$this->input->post('c_type');
		$file       =$this->input->post('c_file');
		$url          =$this->input->post('c_fileurl');

		//工作分工
		$c_plan_more=$this->input->post('c_plan_more');
		$c_time_start=$this->input->post('c_time_start');
		$c_time_end=$this->input->post('c_time_end');
		$c_time_xi=$this->input->post('c_time_xi');
		$c_plan_more_xi=$this->input->post('c_plan_more_xi');

		$data_array=array(
			'c_plan_more'=>$c_plan_more,
			'c_time_start'=>$c_time_start,
			'c_time_end'=>$c_time_end,
			'c_time_xi'=>$c_time_xi,
			'c_plan_more_xi'=>$c_plan_more_xi,
		);
		$start = strtotime($starttime);
		$year = date('Y',$start);
		$month = date('m',$start);
		$day = date('d',$start);
		$week = date('w',$start);
		$arr_week = array('日','一','二','三','四','五','六');
		$hour = date('H',$start);
		$minute = date('i',$start);
		$month=preg_replace('/^0+/','',$month);
		$day = preg_replace('/^0+/','',$day);
		$str = '';
		$info_title_moban=explode('|',$info_title);

		//联系人添加到模板逻辑
		$people_name_moban=array();
		if(!empty($people_name[0])){
			foreach($people_name as $key=>$val){
				if($key=="0"){
					$people_name_moban[$key]="联系人: ".$val."　　联系电话: ".$people_phone[$key];
				}else{
					$people_name_moban[$key]="&nbsp;&nbsp;&nbsp;&nbsp;".$val."　　联系电话: ".$people_phone[$key];
				}
			}
		}

		/*****模板生成开始******/
		//具体逻辑自己猜去,没写扩展里已经很不错了
		$str.=templat_bulid::templet_top_bulid($title,$num,$affairs);
		$str.=templat_bulid::templet_botton_bulid($year,$month,$day,$arr_week[$week],$hour,$minute,$address,$name,$department,$plan,$time,$done,$info_title_moban,$data_array);
		$str.=templat_bulid::templet_footer_bulid($remark,$re_time,$people_name_moban);
		/*****模板生成结束******/


		$id = $this->input->post('id');
		$info_add=$this->input->post('add_info');
		if(!empty($info_add)){
			$str.=$this->input->post('add_info');
		}
		$people_name=serialize($people_name);
		$people_phone=serialize($people_phone);
		$c_address = implode(';',$address);
		$c_point_lng = implode(';',$point_lng);
		$c_point_lat = implode(';',$point_lat);
		$data = array(
			'num'		=> $num,
			'title'		=> $title,
			'affairs'	=> $affairs,
			'address'   => $c_address,
			'c_point_lng'=>$c_point_lng,
			'c_point_lat'=>$c_point_lat,
			'start'		=> $starttime,
			'info'		=> $str,
			'users'		=> '',
			'inscribe'  => $remark,
			're_time'=> $c_re_time,
			'remark'	=> $other,
            'type'      =>$c_type,
            'nature'    =>$nature,
			'info_add'  =>$this->input->post('add_info'),
			'c_person'  =>$person,
			'names_show_shi' => $this->input->post('names_show_shi'),
			'names_show_qita' => $this->input->post('names_show_qita'),
			'department_show_shi' => $this->input->post('department_show_shi'),
			'department_show_qita' => $this->input->post('department_show_qita'),
			'info_title' => $info_title,
			//新加入字段区领导和区部门
			'department_show_qu'=>$department_show_qu,
			'names_show_qu'=>$names_show_qu,
			'people_name'=>$people_name,
			'people_phone'=>$people_phone

		);

		if($c_type==0){
			$data['type']=1;
		}
		if($nature==0){
			$data['nature']=1;
		}
		$join_user= $name_r;
		$join_dept=$department_r;
		$user_list=array();
		$this->load->model('m_user');
		$this->load->model('m_department');
		if(!empty($join_user)){
			foreach($join_user as $value){
				$te=$this->m_user->user_get(array('name'=>$value));

				@$user_list[]=$te->id;
			}

		}

		$dept_list=array();
		if(!empty($join_dept)){
		    foreach($join_dept as $value){
			$te=$this->m_department->department_get(array('name'=>$value));
			@$dept_list[]=$te->id;
		    }
                   
		}
		 $data['join_user']=  implode(',', $user_list); 
		 $data['join_dept']=  implode(",", $dept_list);
		if($id==0)
		{
			//百度坐标
                        
			$data['c_num']		= $c_num;
			$data['creater']	= $this->session->userdata('user_id');
			$re = $this->m_plan->plan_insert($data);


			//var_dump($re);
			if($re){
				$list=$this->m_plan->plan_get(array('num'=>$num));
				$planid=$list->id;
				if(!empty($ready)){
					foreach($ready as $key=>$value){
						$temp[$key]['plan_id']=$planid;
						$temp[$key]['info']=$value;
						$temp[$key]['r_state']=0;
					}
					foreach($temp as $v){
						$this->m_plan_ready->plan_ready_insert($v);
					}
				}
				if(!empty($file)){
					$filelist=array();
					foreach($file as $key=>$value){
						$filelist[$key]['name'] = $value;
						$filelist[$key]['url'] = $url[$key];
						$filelist[$key]['plan_id']=$planid;
					}
					foreach($filelist as $v){
						$this->m_plan_annex->plan_annex_insert($v);
					}
				}
				if(!empty($done)){
					$divisionlist=array();
					foreach($done as $key=>$value){
						$divisionlist[$key]['plan_id'] = $planid;
						$divisionlist[$key]['f_info'] = $value;
					}
					foreach($divisionlist as $v){
						$this->m_plan_division->plan_division_insert($v);
					}
				}
				//增加多日活动安排入库
				$c_plan_more=$this->input->post('c_plan_more');
				$c_time_start=$this->input->post('c_time_start');
				$c_time_end=$this->input->post('c_time_end');
				$c_time_xi=$this->input->post('c_time_xi');
				$c_plan_more_xi=$this->input->post('c_plan_more_xi');
				if(!empty($c_plan_more)){

					$done_more=array(
						'plan_id'=>$planid,
						'c_plan_more'=>serialize($c_plan_more),
						'c_time_start'=>serialize($c_time_start),
						'c_time_end'=>serialize($c_time_end),
						'c_time_xi'=>serialize($c_time_xi),
						'c_plan_more_xi'=>serialize($c_plan_more_xi)

					);
					$this->m_plan_done->plan_done_insert($done_more);

				}
				if(!empty($plan)){
					$donelist=array();
					foreach($plan as $key=>$value){
						$donelist[$key]['plan_id'] = $planid;
						$donelist[$key]['d_time'] = $time[$key];
						$donelist[$key]['d_info'] = $value;
					}
					foreach($donelist as $v){
						$this->m_plan_done->plan_done_insert($v);
					}
				}
			}
		}
		else{
			$data['c_num']		= $c_num;
			//百度坐标
			$re = $this->m_plan->plan_update($id,$data);
			if($re){
				//准备相关处理
				$this->m_plan_ready->plan_ready_delete_by_planid($id);
				$this->m_plan_annex->plan_annex_delete_by_planid($id);
				$this->m_plan_division->plan_division_delete_by_planid($id);
				$this->m_plan_done->plan_done_delete_by_planid($id);
				if(!empty($ready)){
					foreach($ready as $key=>$value){
						$temp[$key]['plan_id']=$id;
						$temp[$key]['info']=$value;
						$temp[$key]['r_state']=0;
					}
					foreach($temp as $v){
						$this->m_plan_ready->plan_ready_insert($v);
					}
				}
				if(!empty($file)){
					$filelist=array();
					foreach($file as $key=>$value){
						$filelist[$key]['name'] = $value;
						$filelist[$key]['url'] = $url[$key];
						$filelist[$key]['plan_id']=$id;
					}
					foreach($filelist as $v){
						$this->m_plan_annex->plan_annex_insert($v);
					}
				}
				if(!empty($done)){
					$divisionlist=array();
					foreach($done as $key=>$value){
						$divisionlist[$key]['plan_id'] = $id;
						$divisionlist[$key]['f_info'] = $value;
					}
					foreach($divisionlist as $v){
						$this->m_plan_division->plan_division_insert($v);
					}
				}
				//增加多日活动安排入库
				$c_plan_more=$this->input->post('c_plan_more');
				$c_time_start=$this->input->post('c_time_start');
				$c_time_end=$this->input->post('c_time_end');
				$c_time_xi=$this->input->post('c_time_xi');
				$c_plan_more_xi=$this->input->post('c_plan_more_xi');
				if(!empty($c_plan_more)){

					$done_more=array(
						'plan_id'=>$id,
						'c_plan_more'=>serialize($c_plan_more),
						'c_time_start'=>serialize($c_time_start),
						'c_time_end'=>serialize($c_time_end),
						'c_time_xi'=>serialize($c_time_xi),
						'c_plan_more_xi'=>serialize($c_plan_more_xi)

					);
					$this->m_plan_done->plan_done_insert($done_more);

				}
				if(!empty($plan)){
					$donelist=array();
					foreach($plan as $key=>$value){
						$donelist[$key]['plan_id'] = $id;
						$donelist[$key]['d_time'] = $time[$key];
						$donelist[$key]['d_info'] = $value;
					}
					foreach($donelist as $v){

						$this->m_plan_done->plan_done_insert($v);

					}
				}
			}

		}
		if($re)
		{
			if($id){
				 echo '<script>location.href="/index.php/plan/edit_1/'.$id.'";</script>';
				if(!empty($_SESSION['plan_area'])){
					unset($_SESSION['plan_area']);
				}
			}else{
				 echo '<script>location.href="/index.php/plan/edit_1/'.$planid.'";</script>';
				if(!empty($_SESSION['plan_area'])){
					unset($_SESSION['plan_area']);
				}
			}
		}
		else
		{
			echo $id==0?'新增失败':'修改失败';
			if(!empty($_SESSION['plan_area'])){
				unset($_SESSION['plan_area']);
			}
		}
		
		
	}
	public function save_2(){
		$id = $this->input->post('id');
		$info = $_POST['info'];
		$data = array(

			'info' =>$info,
		);
		$re = $this->m_plan->plan_update($id,$data);
		if($re){
			echo "1";
		}else{
			echo "0";
		}

	}
	
	public function save()
	{
		$id = $this->input->post('id');
		$data = array(
			'num'		=> $this->input->post('num'),
			'title'		=> $this->input->post('title'),
			'start'		=> $this->input->post('time'),
			'info'		=> $this->input->post('info'),
			'users'		=> $this->input->post('user'),
			'remark'	=> $this->input->post('other'),
                        'type'          =>$this->input->post('type'),
                        'nature'        =>$this->input->post('nature'),
                        'inscribe'      =>$this->input->post('remark'),
                        're_time'       =>$this->input->post('re_time')
		);
                //  print_r($data);
                if($data['type']==0){
                    $data['type']=1;
                } 
                if($data['nature']==0){
                    $data['nature']=1;
                }
               // var_dump($data);
		$join_user=explode(",",$this->input->post('name'));
		$join_dept=explode(",",$this->input->post('department'));
		$user_list=array();
		$this->load->model('m_user');
		$this->load->model('m_department');
		if(!empty($join_user)){
		    foreach($join_user as $value){
			$te=$this->m_user->user_get(array('name'=>$value));
			$user_list[]=$te->id;
		    }
                  
		}
		
		$dept_list=array();
		if(!empty($join_dept)){
		    foreach($join_dept as $value){
			$te=$this->m_department->department_get(array('name'=>$value));
			$dept_list[]=$te->id;
		    }
                   
		}
		 $data['join_user']=  implode(',', $user_list); 
		 $data['join_dept']=  implode(",", $dept_list);
		$ready=explode(',',$this->input->post('ready'));
		if($id==0)
		{
                        
			$data['c_num']		= $this->input->post('c_num');
			$data['creater']	= $this->session->userdata('user_id');
                        $file=  explode(',', $this->input->post('file'));
                        $fileurl=  explode(',', $this->input->post('fileurl'));
			$re = $this->m_plan->plan_insert($data);
			if($re){
			    $list=$this->m_plan->plan_get(array('c_num'=>$data['c_num']));
			    $planid=$list->id;
			    if(!empty($ready)){
			       foreach($ready as $value){
				$temp['plan_id']=$planid;
				$temp['info']=$value;
				$temp['r_state']=0;
				$this->m_plan_ready->plan_ready_insert($temp);
			    }
			    } 
                            if(!empty($file)){
                            $filelist=array();
                           foreach($file as $key=>$value){
                               $filelist[$key]['name']=$value;
                               $filelist[$key]['url']=$fileurl[$key];
                               $filelist[$key]['plan_id']=$planid;
                           }
                           foreach($filelist as $v){
                            $this->m_plan_annex->plan_annex_insert($v);   
                           }
                        }
			}
                        
		}
		else{
			$re = $this->m_plan->plan_update($id,$data);
                        //准备相关处理
			$tab=explode(',',$this->input->post('tab'));
			$r=array();
			foreach($tab as $key=>$value){
			    $r[$key]['id']=$value;
			    $r[$key]['info']=$ready[$key];
			}
			$ins=array();
			$upd=array();
			foreach($r as $v){
			    if($v['id']==0){
				$ins[]=$v;
			    }else{
				$upd[]=$v;
			    }
			}
			$del_ready=explode(',',$this->input->post('del_ready'));
			if(!empty($del_ready)){
			    foreach($del_ready as $value){
				$this->m_plan_ready->plan_ready_delete($value);
			    }
			}
			 if(!empty($ins)){
			       foreach($ins as $value){
				$temp['plan_id']=$id;
				$temp['info']=$value['info'];
				$temp['r_state']=0;
				$this->m_plan_ready->plan_ready_insert($temp);
			 }
			       }
			 
			  if(!empty($upd)){
			       foreach($upd as $value){
				$temp['info']=$value['info'];
				$this->m_plan_ready->plan_ready_update($value['id'],$temp);
			  }
			 } 
//                        $del_file=explode(',',$this->input->post('del_file'));      
//                         //附件相关处理
//                        $file=  explode(',', $this->input->post('file'));
//                        $fileurl=  explode(',', $this->input->post('fileurl'));
//                        $fileid=  explode(',', $this->input->post('fileid'));
//                        if(!empty($file)){
//                            $arr=array();
//                          foreach($file as $key=>$value){
//                            $arr[$key]['name']=$value;
//                            $arr[$key]['url']=$fileurl[$key];
//                            $arr[$key]['id']=$fileid[$key];
//                          } 
//                          $update_file=array();
//                          $insert_file=array();
//                          foreach($arr as $value){
//                              if(is_array($value['id'],$del_file)=FALSE){
//                                if($value['id']==0){
//                                  $insert_file[]['name']=$value['name'];  
//                                  $insert_file[]['url']=$value['url'];
//                                }else{
//                                   $update_file[]=$value; 
//                                } 
//                              }
//                          }
//                          if(!empty($update)){
//                              
//                          }
//                          if(!empty()){
//                              
//                          }
//                          if(!empty()){
//                              
//                          }
//                        }else{
//                            
//                        }
    
		}
		if($re)
		{
			echo 'success';
		}
		else
		{
			echo $id==0?'新增失败':'修改失败';
		}
	}
	/**
	 * 发布/取消活动方案
	 */
	public function state()
	{
		$id		= $this->input->post('id');
		$state	= $this->input->post('state');
		
		echo $this->m_plan->plan_state($id,$state);
	}
	
	/**
	 * 删除活动方案
	 */
	public function delete()
	{

		$id = $this->input->post('id');
		$idArray = explode(',',$id);
		$data = array('isdel'=>1);
		//此处为假删除
		$update_status = $this->m_plan->plan_update_by_id($idArray,$data);
		//删除活动方案准备
		//$del_status = $this->m_plan_ready->plan_ready_delete_by_planid($idArray);
		if($update_status){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	/**
	 * 删除群发短信
	 */
	public function delete_mass()
	{

		$id = $this->input->post('id');
		$idArray = explode(',',$id);
		$data = array('is_del'=>1);
		//此处为假删除
		$this->load->model('m_send_massage');
		$update_status = $this->m_send_massage->massage_update($idArray,$data);

		if($update_status){
			echo 'success';
		}else{
			echo 'fail';
		}
	}

	/**
	 * 获取模板列表
	 */
	public function templet()
	{
		$this->login->check_jurisdict('15',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		$re = $this->m_plan_templet->plan_templet_list();
		$data['list'] =$re;
		
		//右上角查询
		$this->load->helper('select');
		$data['select'] = type_select();
		
		$this->load->view('plan/templet',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 新增模板
	 */
	public function templet_add()
	{
		$this->login->check_jurisdict('15',$this->session->userdata('user_jurisdict'),true);
		
		$data = array(
			'info'		=> $this->input->post('info'),
			'name'		=> $this->input->post('name'),
		);
		if($this->m_plan_templet->plan_templet_insert($data))
		{
			echo 'success';
		}
		else
		{
			echo '模板添加失败';
		}
	}
	
	/**
	 * 获取模板内容
	 */
	public function get_templet_info()
	{
		$id = $this->input->post('id');
		$info = $this->m_plan_templet->plan_templet_get(array('id'=>$id));
		
		echo json_encode($info);
	}
	
	/**
	 * 修改模板
	 */
	public function templet_update()
	{
		$this->login->check_jurisdict('15',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		$data = array(
			'info'		=> $this->input->post('info'),
			'name'		=> $this->input->post('name'),
		);
		if($this->m_plan_templet->plan_templet_update($id,$data))
		{
			echo 'success';
		}
		else
		{
			echo '模板修改失败';
		}
	}
	
	/**
	 * 删除模板
	 */
	public function templet_delete()
	{
		$this->login->check_jurisdict('15',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		if($this->m_plan_templet->plan_templet_delete($id))
		{
			echo 'success';
		}
		else
		{
			echo '模板删除失败';
		}
	}
	/**
	 *
	 * 导出方案成excel格式
	 */
	public function exportPlanToExcel(){
		//通过时间筛选
		$where['start']=$this->input->post('start');
		$where['end']= $this->input->post('end');
		$this->db->where('isdel','0');
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('start >=',$where['start'].' 00:00:00');
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('start <=',$where['end'].' 23:59:59');
		}
		$re = $this->db->get('t_plan');
		$data_array = $re->result_array();
		if(empty($data_array)){
			echo "file";
			exit();
		}
		$data=array();
		//根据excel格式把查询获得的数组插入$data中
		foreach($data_array as $key=>$val){
			$re = $this->edit_2($val['id']);
			$data[$key][0] = $val['num'];
			$data[$key][1] = $val['title'];
			switch($val['type']){
				case '1':
					$data[$key][2]='会议';
					break;
				case '2':
					$data[$key][2]='调研';
					break;
				case '3':
					$data[$key][2]='商务接待';
					break;
				case '4':
					$data[$key][2]='公务接待';
					break;
				case '5':
					$data[$key][2]='其他';
					break;
			}
			switch($val['nature']){
				case '1':
					$data[$key][3]='内事';
					break;
				case '2':
					$data[$key][3]='外事';
					break;
			}
			$data[$key][4] = substr($val['start'],0,10);
			$data[$key][5] = substr($val['start'],11,20);
			$data[$key][6] = $val['address'];
			$data[$key][7] = $re['info']->join_user;
			$data[$key][8] = $re['info']->join_dept;
			$gaiyao="";
			foreach($re['done'] as $key2=>$val2){
				$gaiyao.=$val2->d_time.":".$val2->d_info.";";
			}
			$data[$key][9] = $gaiyao;
			$fengong="";
			foreach($re['division'] as $key1=>$val1){
				$fengong.=$val1->f_info.";";
			}
			$data[$key][10] = $fengong;
			$data[$key][11] = "";
			$data[$key][12] = "";
			$data[$key][13] = "";
			$data[$key][14] = "";
			$data[$key][15] = $val['c_person'];

		}
		//将获得的数组序列化存入session中
		session_start();
		$_SESSION['dao_excel']=serialize($data);
		echo serialize($data);

	}
	/*
	 * 强制浏览器下载excel
	 * */
	public function downloadPlan_e(){
		session_start();
		if(!empty($_SESSION['dao_excel'])){
		$data2=$_SESSION['dao_excel'];
		$data=unserialize($data2);

		include './excel/Classes/PHPExcel.php';
		//创建对象
		$excel = new PHPExcel();
		//Excel表格式
		$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P');
		//表头数组
		$tableheader = array('编号','项目','类型','性质','日期','时间','地点','委领导','部门','活动概要','管办分工','礼品','联系人','内宾','外宾','负责人');
		//填充表头信息
		for($i = 0;$i < count($tableheader);$i++) {
			$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
		}
		//填充表格信息
		for ($i = 2;$i <= count($data) + 1;$i++) {
			$j = 0;
			foreach ($data[$i - 2] as $key=>$value) {
				$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
				$j++;
			}
		}
		//设置列名
		$i='A';
		for($n=0;$n<15;$n++){
			$p=$i."1";
			$excel->getActiveSheet()->getStyle("$p")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$excel->getActiveSheet()->getStyle("$p")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//$excel->getActiveSheet()->getColumnDimension("$i")->setAutoSize(true);
			$i++;
		}
		//设置首列的高度、宽度
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(80);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(100);
			$excel->getActiveSheet()->getColumnDimension('P')->setWidth(50);
		//创建Excel输入对象
		$excel_name=time();
		$this->excel_down($excel,$excel_name);

		unset($_SESSION['dao_excel']);
		}
	}
	/**
	 *
	 * 创建Excel输入对象并强制浏览器下载
	 * $excel文本内容
	 * $excel_name文本命名
	 */
	public function excel_down($excel,$excel_name){
		$write = new PHPExcel_Writer_Excel5($excel);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");
		header("Content-Disposition:attachment;filename=".$excel_name.".xls");
		header("Content-Transfer-Encoding:binary");
		$write->save('php://output');
	}
	/**
	 * 
	 * 导出方案成word格式
	 */
	public function exportPlanToWord(){
		$this->load->library('word');
		$id = $this->input->post('id');
		$idArray = explode(',',$id);
		$this->db->where_in('id',$idArray);
		$re = $this->db->get('t_plan');
		$data = $re->result_array();
		$newpath = './uploads/plandownload/'.date('YmdHis').'/';
		mkdir($newpath);
		foreach($data as $key=>$value){
			$word = new word();
		    $word->start();
		    $wordname = $newpath.'('.$value['num'].')'.'.doc';
		    $wordArray[$value['id']] = $wordname;
		    echo $value['info'];
		    $status = $word->save($wordname);
		    ob_flush();//每次执行前刷新缓存
		    flush();
		}
		$result = array('status'=>$status,'filename'=>implode(',',$wordArray),'filedir'=>$newpath);
		echo json_encode($result);
		
	}
	
	/**
	 * 
	 * 强制浏览器打开页面后立即出现下载保存窗口
	 */
	public function downloadPlan(){
		//$wordname = './plandownload/plan_20150515090919.doc';
		$wordname = $this->input->get('wordname');
		$wordArray = explode(',',$wordname);
		if(count($wordArray) == 1) {
			$pos = strripos($wordname,'/');
			$filename = substr($wordname, $pos+1);
			header("Content-Type: application/force-download");
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			$content = file_get_contents($wordname); 
			echo $content;  
		}else{
			$filedir = $this->input->get('filedir');
			$this->load->library('zip');
			$this->zip->read_dir($filedir,FALSE);//开始压缩指定路径的文件夹，清除里面的结构。
			$this->zip->download('my_backup.zip');//下载压缩后的的文件。
		}
	}
	
	public function testexport(){
		$this->load->library('word');
		$id = $this->input->get('id');
		//方案内容
		$info = $this->m_plan->plan_get(array('id'=>$id));
		$word = new word(); 
		$word->start(); 
		$wordname = './plandownload/'.'plan_'.date('YmdHis').'.doc'; 
		echo $info->info;
		$status = $word->save($wordname);
		ob_flush();//每次执行前刷新缓存 
		flush();
		$result = array('status'=>$status,'filename'=>$wordname);
		echo json_encode($result);
	}
	public function selectReady(){
	    $id=$this->input->post('id');
	    $this->load->model('m_plan_ready');
	    $ready=$this->m_plan_ready->plan_ready_list(array('plan_id'=>$id));
		
	    echo json_encode($ready);
	    
	}
	public function saveReady(){
	   $ready_0=$this->input->post('ready0');  
	    $ready_1=$this->input->post('ready1');
	    $this->load->model('m_plan_ready'); 
	   if(!empty($ready_0)){
	       foreach($ready_0 as $v){
		 $temp['r_state']=0;  
		 $temp['r_time']=time();
		 $this->m_plan_ready->plan_ready_update($v,$temp);   
	       }
	   }
	   if(!empty($ready_1)){
	       foreach($ready_1 as $v){
		$temp['r_state']=1;  
		$temp['r_time']=time();
		$this->m_plan_ready->plan_ready_update($v,$temp);    
	       }  
	   }
	   echo  'success';
	}
        
        /**
	 * 上传图片
	 */
	public function update_file()
	{		
    	//上传
    	$config['upload_path'] = './uploads/plan/';
    	$config['allowed_types'] = 'doc|rar|zip|txt|xls|ppt|xlsx|pdf|docx';
    	$config['max_size'] = '5000';
        
    	
    	
    	$this->load->library('upload', $config);
    	
    	$load = $this->upload->do_upload('i_file');
         

    	if (!$load) 
    	{
    		echo "<script>parent.pic_back('false');</script>";
                        //print_r($load);
    	} 
    	else
    	{
    		$data = $this->upload->data();
                $filename=$data['file_name'];
    		$path = $data['full_path'];
    		$pathArr = explode('/uploads/', $path);
    		$full_url = '/uploads/' . $pathArr[1];
    		
	    	$url = isset($full_url) ? $full_url : '';
                $name= isset($filename) ? $filename : '';
                $re=$name.",".$url;     
	    	echo "<script>parent.pic_back('".$re."');</script>";
    	}
	}
	
	//保存提醒范围
	public function saveTxUsers(){
		$id = $_POST['id'];
		$user = $_POST['user'];
		$data['users']		= $user;
		$re = $this->m_plan->plan_update($id,$data);
		$this->m_plan->plan_state($id,1); 
		if($re){
			echo '操作成功';
		}else{
			echo '操作失败';
		}
		
	}
	
	 //上传活动方案csv文件
    public function addCsvFile()
    {
   		 //上传
    	$config['upload_path'] = './uploads/plan/';
    	$config['allowed_types'] = '*';
    	$config['max_size'] = '5000';
    	$this->load->library('upload', $config);
    	$load = $this->upload->do_upload('i_file');
    	if (!$load)
    	{
    		//var_dump($this->load->allowed_types);
    		echo "<script>parent.pic_back('false');</script>";
    		//print_r($load);
    	}
    	else
    	{
    		$data = $this->upload->data();
    		$filename=$data['file_name'];
    		$path = $data['full_path'];
    		$pathArr = explode('/uploads/', $path);
    		$full_url = '/uploads/' . $pathArr[1];

    		$url = isset($full_url) ? $full_url : '';
    		$name= isset($filename) ? $filename : '';
    		$re=$name.",".$url;
    		echo "<script>parent.pic_back('".$re."');</script>";
    	}
    }

    //上传附件(zip包)
    public function addZipFile(){
     	//上传
    	$config['upload_path'] = './uploads/plan/';
    	$config['allowed_types'] = 'csv|zip';
    	$config['max_size'] = '5000';
    	$this->load->library('upload', $config);
    	$load = $this->upload->do_upload('i_file1');
    	if (!$load)
    	{
    		echo "<script>parent.pic_back('false');</script>";
    		//print_r($load);
    	}
    	else
    	{
    		$data = $this->upload->data();
    		$filename=$data['file_name'];
    		$path = $data['full_path'];
    		$pathArr = explode('/uploads/', $path);
    		$full_url = '/uploads/' . $pathArr[1];

    		$url = isset($full_url) ? $full_url : '';
    		$name= isset($filename) ? $filename : '';
    		$re=$name.",".$url;
    		echo "<script>parent.pic_back1('".$re."');</script>";
    	}
    }

    //批量导入方案
    public function exportPlan(){
    	$csv_url = ".".$this->input->post('i_pic');  //csv活动方案文件路径
	    $annex_url = ".".$this->input->post('i_pic1');   //附件路径
    	$handle = fopen($csv_url, 'r');
    	$result = $this->input_csv($handle);
    	$resultPart = array_slice($result,0);
    	if (count($resultPart) == 0) {
    		echo '没有数据';exit;
    	}
    	if($annex_url){
	    	$zip = new ZipArchive;
		    if ($zip->open($annex_url) === true) {
		    	$pos = strripos($annex_url, '.zip');
	    		$annex_url1 = substr($annex_url,0,$pos);
			    for($i = 0; $i < $zip->numFiles; $i++) {
		        	$zip->extractTo($annex_url1, array($zip->getNameIndex($i)));
		    	}               
			    $zip->close();                  
			}else{
				echo '解压失败';exit;
			}
    	}
    	unset($resultPart[0]);
    	foreach ($resultPart as $key => $value) {
    		$data = array(
	    		'num'=>date('Y').'-'.sprintf("%03d", $this->m_plan->max_num()),
			    'title'=>iconv('gb2312', 'utf-8', $value[0]),
			    'affairs'=>iconv('gb2312', 'utf-8', $value[1]),
			    'start'=>$value[2],
			    'address'=>iconv('gb2312', 'utf-8', $value[3]), //多个地址用分号分割
			    'users'=>$this->getUserid(iconv('gb2312', 'utf-8', $value[4])),
	    		'join_dept'=>$this->getDeptid(iconv('gb2312', 'utf-8', $value[5])),
	    		'join_user'=>$this->getUserid(iconv('gb2312', 'utf-8', $value[6])),
	    		'inscribe'=>iconv('gb2312', 'utf-8', $value[7]),
	    		'creater'=>$this->session->userdata('user_id'),
	    		'c_num'=>$this->m_plan->max_num(),
	    		'remark'=>iconv('gb2312', 'utf-8', $value[8]),
	    		'type'=>$value[9],
	    		'nature'=>$value[10]
    		);
    		$dones = iconv('gb2312', 'utf-8', $value[13]);		//具体安排
    		if(!empty($dones)){
    			$doneArr = explode(';',$dones);
    			foreach($doneArr as $k=>$val){
    				$v = explode('/', $val);
    				$time[$k] = $v[0];
    				$plan[$k] = $v[1];
    			}
    		}
    		$division   =iconv('gb2312', 'utf-8', $value[12]);  //工作分工
    		if(!empty($division)){
    			$divisionArr = explode(';',$division);
    		}
    		$title		=iconv('gb2312', 'utf-8', $value[0]);
    		$num		= date('Y').'-'.sprintf("%03d", $this->m_plan->max_num());
    		$affairs	=iconv('gb2312', 'utf-8', $value[1]);
    		$starttime	= $value[2];
    		$remark		=iconv('gb2312', 'utf-8', $value[8]);
    		$name		= explode(';',iconv('gb2312', 'utf-8', $value[6]));
    		$department	= explode(';',iconv('gb2312', 'utf-8', $value[5]));
    		$address	= explode(';',iconv('gb2312', 'utf-8', $value[3]));
    		$done		= $divisionArr;

    		$start = strtotime($starttime);
    		$year = date('Y',$start);
    		$month = date('m',$start);
    		$day = date('d',$start);
    		$week = date('w',$start);
    		$arr_week = array('日','一','二','三','四','五','六');
    		$hour = date('H',$start);
    		$minute = date('i',$start);
    		
    		//方案模板
    		$templet = $this->m_plan_templet->plan_templet_get(array('id'=>1));
    		$arr = explode('$',$templet->info);
    		$str = '';
    		if(is_array($arr))
    		{
    			for($k=0;$k<count($arr);$k++)
    			{
    				$v = $arr[$k];
    				switch($v)
    				{
    					case 'title':
    					case 'num':
    					case 'affairs':
    					case 'year':
    					case 'month':
    					case 'day':
    					case 'hour':
    					case 'minute':
    					case 'remark':
    						$str .= $$v;
    						break;
    					case 'week':
    						$str .= $arr_week[$week];
    						break;
    					case 'for':
    						$k++;
    						$between = $arr[$k];//中间内容
    						$type = '';

    						for($j=$k;$j<count($arr);$j++)
    						{
    							if(in_array($arr[$j],array('address','name','department','plan','done')))
    							{
    								$type = $arr[$j];
    								break;
    							}
    						}

    						if(in_array($type,array('address','name','department')) && count($$type)>0)
    						{
    							$n = 0;
    							$list = $$type;
    							for($i=0;$i<count($list);$i++)
    							{
    								if($list[$i]=='')
    								{
    									continue;
    								}
    								if($n>0)
    								{
    									$str .= $between;
    								}
    								$n++;
    								$k1 = $k+1;
    								do{
    									if($arr[$k1]==$type)
    									{
    										$str .= $list[$i];
    									}
    									else
    									{
    										$str .= $arr[$k1];
    									}
    									$k1++;
    								}while($arr[$k1]!='endfor');
    							}
    						}
    						if($type=='plan' &&  count($plan)>0)
    						{
    							$n = 0;
    							for($i=0;$i<count($plan);$i++)
    							{
    								if($plan[$i]=='')
    								{
    									continue;
    								}
    								if($time[$i]=='')
    								{
    									continue;
    								}
    								if($n>0)
    								{
    									$str .= $between;
    								}
    								$n++;
    								$k1 = $k+1;
    								do{
    									if($arr[$k1]=='plan')
    									{
    										$str .= $plan[$i];
    									}
    									elseif($arr[$k1]=='time')
    									{
    										$str .= $time[$i];
    									}
    									else
    									{
    										$str .= $arr[$k1];
    									}
    									$k1++;
    								}while($arr[$k1]!='endfor');
    							}
    								
    						}

    						if($type=='done' &&  count($done)>0)
    						{
    							$n = 0;
    							for($i=0;$i<count($done);$i++)
    							{
    								if($done[$i]=='')
    								{
    									continue;
    								}
    								if($n>0)
    								{
    									$str .= $between;
    								}
    								$n++;
    								$k1 = $k+1;
    								do{
    									if($arr[$k1]=='done')
    									{
    										$str .= $done[$i];
    									}
    									elseif($arr[$k1]=='i')
    									{
    										$str .= $n;
    									}
    									else
    									{
    										$str .= $arr[$k1];
    									}
    									$k1++;
    								}while($arr[$k1]!='endfor');
    							}
    								
    						}

    						do{
    							++$k;
    						}while($arr[$k]!='endfor');
    						break;
    					default:
    						$str .= $v;
    						break;
    				}
    			}
    		}
    		$data['info'] = $str;
    		$re = $this->m_plan->plan_insert($data);
    		$list=$this->m_plan->plan_get(array('c_num'=>$data['c_num']));
    		$planid=$list->id;
    		$ready = iconv('gb2312', 'utf-8', $value[11]);		//前期准备
    		$division = iconv('gb2312', 'utf-8', $value[12]);  //工作分工
    		$done = iconv('gb2312', 'utf-8', $value[13]);		//具体安排
    		$annex = iconv('gb2312', 'utf-8', $value[14]);     //附件
    		if(!empty($annex)){
    			$annexArr = explode(';',$annex);
    			foreach($annexArr as $key=>$value){
    				$poss = strripos($value, '/');
    				$name = substr($value, $poss+1);
    				$annexList[$key]['plan_id'] = $planid;
    				$annexList[$key]['name'] = $name;
    				$annexList[$key]['url'] = $value;
    			}
    			foreach($annexList as $v){
    				$this->m_plan_annex->plan_annex_insert($v);
    			}
    		}
    		if(!empty($ready)){
    			$readyArr = explode(';',$ready);
    			foreach($readyArr as $key=>$value){
    				$readyList[$key]['plan_id'] = $planid;
    				$readyList[$key]['info'] = $value;
    				$readyList[$key]['r_state'] = 0;
    			}
    			foreach($readyList as $v){
    				$this->m_plan_ready->plan_ready_insert($v);
    			}
    		}
    		if(!empty($division)){
    			$divisionArr = explode(';',$division);
    			foreach($divisionArr as $key=>$value){
    				$divisionList[$key]['plan_id'] = $planid;
    				$divisionList[$key]['f_info'] = $value;
    			}
    			if(!empty($divisionList)){
    				foreach($divisionList as $v){
    					$this->m_plan_division->plan_division_insert($v);
    				}
    			}
    		}
    		if(!empty($done)){
    			$doneArr = explode(';',$done);
    			foreach($doneArr as $key=>$value){
    				$val = explode('/', $value);
    				$doneList[$key]['plan_id'] = $planid;
    				$doneList[$key]['d_time'] = $val[0];
    				$doneList[$key]['d_info'] = $val[1];
    			}
	    		if(!empty($doneList)){
	    			foreach($doneList as $v){
	    				$this->m_plan_done->plan_done_insert($v);
	    			}
	    		}
    		}
    			
    	}
    	if($re){
    		echo '导入成功';
    	}else{
    		echo '导入失败';
    	}

    }

    
    public function getUserid($username){
    	if($username){
    		$user_list = array();
    		$usernameArray = explode(';',$username);
    		if(!empty($usernameArray)){
				foreach($usernameArray as $value){
					$te=$this->m_user->user_get(array('name'=>$value));
					if($te){
						$user_list[]=$te->id;
					}
				}
			}
			$useridStr = implode(',',$user_list);
    	}else{
    		$useridStr = '';
    	}
    	return $useridStr;
    	
    }
    
    public function getDeptid($deptname){
    	if($deptname){
    		$dept_list = array();
    		$deptnameArray = explode(';',$deptname);
	    	if(!empty($deptnameArray)){
			    foreach($deptnameArray as $value){
					$te=$this->m_department->department_get(array('name'=>$value));
					if($te){
						$dept_list[]=$te->id;
					}
					
			    }
			}
			$deptidStr = implode(',',$dept_list);
    	}else{
    		$deptidStr = '';
    	}
    	return $deptidStr;
    }
    
/**
 * 解析CSV文件
 * @param $handle
 * @return array
 */
	public function input_csv($handle)
	{
	    $out = array();
	    $n = 0;
	    while ($data = fgetcsv($handle, 10000)) {
	        $num = count($data);
	
	        for ($i = 0; $i < $num; $i++) {
	            $out[$n][$i] = $data[$i];
	        }
	        $n++;
	    }
	    return $out;
	}
	
	/**
	 * 
	 * 强制浏览器下载csv模板文件
	 */
	public function downloadfile($flag){
		if($flag == 1){
			$wordname = './uploads/plandownload/plancsv.csv';
		}else if($flag == 2){
			$wordname = './uploads/plandownload/instrduction.txt';
		}
		$pos = strripos($wordname,'/');
		$filename = substr($wordname, $pos+1);
		header("Content-Type: application/force-download");
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		$content = file_get_contents($wordname); 
		echo $content;  
	}
    /*
    * getPlanInfo
    * 获取短信提醒内容
    */
  
        public function getPlanInfo($id){
           
       //获取方案基本信息
            $plan=$this->m_plan->plan_get(array('id'=>$id));
            $done=$this->m_plan_done->plan_done_list(array('plan_id'=>$id));
            $division=$this->m_plan_division->plan_division_list(array('plan_id'=>$id));
           
              $str="";
              if(!empty($plan)){
               //处理日期字符串
                $start = strtotime($plan->start);  
		$date=date('Y年m月d日',$start);
		$week = date('w',$start);
		$arr_week = array('日','一','二','三','四','五','六');
		$time = date('H:i',$start);
                $plan->start=$date.'(周'.$arr_week[$week].')'.$time.'开始';
               
                
                //标题
                $str.=$plan->title."<br/>";
                 //发起人
                //$str.='发起人:'.$plan->inscribe.'<br/>';
                //时间
                $str.="时间:".$plan->start."<br/>";
                $str.="地点:".$plan->address."<br/>";
                $str.="具体安排:<br/>";
                if(!empty($done)){
                    foreach($done as $val){
                        $str.=$val->d_time.$val->d_info."<br/>";  
                    }
                }
                //$str.="工作分工：<br/>";
               // if(!empty($division)){
                //    foreach($division as $key=>$value){
                //        $tab=$key+1;
                //        $str.=$tab."、".$value->f_info."<br/>";
               //     }  
              //  }
               $str.="　　　".$plan->inscribe."<br/>";
               $str.="　　　".substr($plan->re_time,0,-8)."<br/>";
               $str.="联系人:<br/>";
               $other="此消息通过天津高新区PRM系统推送，获取地址导航及更多信息请点击下方链接，安装系统APP:";
               $str.=$other;
               //下载链接
               $download="http://prm.tht.gov.cn/appfile/index.html<br/>";
               $str.=$download;
               return $str;          
              }
   }
	 /**
	 * 通过CURL发送HTTP请求
	 * @param string $url  //请求URL
	 * @param array $postFields //请求参数 
	 * @return mixed
	 */
	private function curlPost($url,$postFields){
		$postFields = http_build_query($postFields);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $postFields );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		return $result;
	}
        /**
	 * 发送短信
	 *
	 * @param string $mobile 手机号码
	 * @param string $msg 短信内容
	 * @param string $needstatus 是否需要状态报告
	 * @param string $product 产品id，可选
	 * @param string $extno   扩展码，可选
	 */
	public function sendSMS( $mobile, $msg, $needstatus = 'false',$extno = '') {
		$url='http://222.73.117.158/msg/HttpBatchSendSM';
		//创蓝接口参数
		$postArr = array (
				          'account' =>'Tjsbkj888',
				          'pswd' =>'Tjsbkj888',
				          'msg' => $msg,
				          'mobile' => $mobile,
				          'needstatus' => $needstatus,
				          //'product' => '39207',
				          'extno' => $extno
                     );
		
		$result = $this->curlPost($url , $postArr);
		return $result;
	}
        
        /**
	 * 方案列表页
	 * @param unknown_type $page
	 * @param unknown_type $pageSize
	 */
	public function smsReport($page='1',$pageSize='20')
	{

		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'plan'));
		
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where = $this->session->userdata('plan_select');
		}
		else
		{
			$where['start'] = $this->input->post('start');
			$where['end'] 	= $this->input->post('end');
			$where['mobile'] = $this->input->post('mobile');
			
			$this->session->set_userdata(array('plan_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
		//---------分页------------
		$num = $this->m_sms_report->report_num($where);
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/plan/smsreport/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		//---------分页------------
		
		//-----根据条件获取列表------
		$list = $this->m_sms_report->report_list($where,($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		$data['num']=$num;
		//右上角查询
		$this->load->helper('select');
		$data['select']	= type_select();
		
		$this->load->view('plan/smsreport',$data);
		$this->load->view('main_footer');
	}
}
?>