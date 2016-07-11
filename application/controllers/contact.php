<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 联系人模块
 * 联系人管理
 * 数据库连接：t_contact
 */
class contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //权限判断
        $this->load->library('session');
        $this->load->library('login');
        $this->login->check_login($this->session->userdata('user_id'));

        $this->load->model('m_contact_total');
        $this->load->model('m_contact');
        $this->load->model('m_company');
        $this->load->model('m_internal_contact');
        $this->load->model('m_internal_company');
        $this->load->model('m_contact_select');
        $this->load->helper(array('form', 'url'));
    }
	/**
	 * 短信群发 名片列表
	 */
	public function index_mass($page = '1', $pageSize = '20')
	{
		//$this->load->view('main_header');
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where = $this->session->userdata('contact_select');
		}
		else
		{
			$where['value']			= $this->input->post('value');
			$where['type']			= $this->input->post('type');
			$where['order_field']	= $this->input->post('order_field');
			$where['order_type']	= $this->input->post('order_type');
			$where["owner"]			= $this->input->post('owner');

			$this->session->set_userdata(array('contact_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------

		$this->load->model('m_contact_select');

		//---------分页------------
		$num = $this->m_contact_select->contact_list_num($where['value'],$where['type'],$where['owner']);
		$data['num']	= $num;

		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;

		$this->load->library('pagination');

		$config['base_url'] = '/index.php/contact/index_mass/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize;

		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------

		//-----获取数据-----
		if($where['order_field']=='')
		{	//默认排序
			$where['order_field']	= 'u_id';
			$where['order_type']	= 'desc';
		}
		if(!isset($where['value']))
		{
			$where['value'] = '';
		}
		if(!isset($where['type']))
		{
			$where['type'] = '0';
		}
		if(!isset($where['owner']))
		{
			$where['owner'] = '0';
		}
		$list = $this->m_contact_select->contact_list($where['value'],$where['type'],$where['owner'],$where['order_field'],$where['order_type'],($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----

		//------分类下拉------
		$this->db->order_by('detail', 'asc');
		$data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
		//------分类下拉------

		//名片主人查询条件
		$arr_tmp = explode(',',$this->session->userdata('user_jurisdict'));
		$data['sel_owner'] = in_array('19',$arr_tmp);

		//------名片主人下拉------
		$data['ownerlist'] = $this->m_contact_select->owner_hash();
		//------名片主人下拉------

		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
		//获取session
		session_start();
		if(!empty($_SESSION['id_array'])){
			$data['id_array']=$_SESSION['id_array'];
		}
		$this->load->view('contact/index_mass', $data);
		$this->load->view('main_footer');
	}
    /**
     * 联系人 列表 
     */
    public function index($page = '1', $pageSize = '20')
    {
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where = $this->session->userdata('contact_select');
		}
		else
		{
			$where['value']			= $this->input->post('value');
			$where['type']			= $this->input->post('type');
			$where['order_field']	= $this->input->post('order_field');
			$where['order_type']	= $this->input->post('order_type');
			$where["owner"]			= $this->input->post('owner');
			
			$this->session->set_userdata(array('contact_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
		
        $this->load->model('m_contact_select');
        
		//---------分页------------
		$num = $this->m_contact_select->contact_list_num($where['value'],$where['type'],$where['owner']);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/contact/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------

		//-----获取数据-----
		if($where['order_field']=='')
		{	//默认排序
			$where['order_field']	= 'u_id';
			$where['order_type']	= 'desc';
		}
		if(!isset($where['value']))
		{
			$where['value'] = '';
		}
		if(!isset($where['type']))
		{
			$where['type'] = '0';
		}
		if(!isset($where['owner']))
		{
			$where['owner'] = '0';
		}
        $list = $this->m_contact_select->contact_list($where['value'],$where['type'],$where['owner'],$where['order_field'],$where['order_type'],($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		
        //------分类下拉------
        $this->db->order_by('detail', 'asc');
        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
        //------分类下拉------
        
        //名片主人查询条件
        $arr_tmp = explode(',',$this->session->userdata('user_jurisdict'));
		$data['sel_owner'] = in_array('19',$arr_tmp);
        
        //------名片主人下拉------
        $data['ownerlist'] = $this->m_contact_select->owner_hash();
        //------名片主人下拉------

		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

        $this->load->view('contact/index', $data);
        $this->load->view('main_footer');
    }

    /**
     * 联系人 点开之后的详情  1.19改
     */
    public function view($id, $thispage)
    {

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        //联系人信息
        $relArr = $this->m_contact_total->join_contact($id);
		//var_dump($relArr);
        $data = $relArr[$id];
        //电话和地址的数组
        $data['mobile'] = isset($data['mobile']) ? explode(',', $data['mobile']) : array();
        $data['address'] = isset($data['address_contact']) ? explode(',', $data['address_contact']) : array();
        $data['tel'] = isset($data['tel']) ? explode(',', $data['tel']) : array();
        $data['fax'] = isset($data['fax']) ? explode(',', $data['fax']) : array();
        $data['email'] = isset($data['email']) ? explode(',', $data['email']) : array();
        //名片主人
        $ownArr = explode(',', $data['owner']);
        if ($data['owner'] != '0') {
        	foreach($ownArr as $key=>$ownid){
            	$user = $this->m_contact_total->get_field($ownid, 't_user');
            	if(empty($data['username'])){
            		$data['username'] = $user['name'];
            	}else{
            		$data['username'] .= ','.$user['name'];
            	}
        	}
        } else {
            $data['username'] = '';
        }
        
        //未公开且不是名片主人，判断是否有联系人查看权限
        if($data['public']==0 && !in_array($this->session->userdata('user_id'),$ownArr))
        {
	        //权限判断
	        $this->login->check_contact('4', $this->session->userdata('user_jurisdict'));
        }


        //分类name和企业name和职务
        foreach ($data['company_name'] as $k => $v) {
             if($data['settle'][$k]==0){
             $data['settlename'][$k]="未落户";    
            }else if($data['settle'][$k]==1){
              $data['settlename'][$k]="已落户";   
            }else if($data['settle'][$k]==2){
              $data['settlename'][$k]="接洽中";     
            }  
            $data['type_company_position'][$k] = array(
                'company_name' => $v,
                'type_name' => $data['type_name'][$k],
                'position' => $data['position'][$k],
                'settle'=>$data['settle'][$k],
                'settlename'=>$data['settlename'][$k],
				'url'=>$data['url'][$k],
				'postcode'=>$data['postcode'][$k]

            );
        }
        $data['thispage'] = $thispage ? $thispage : 1;
		//var_dump($data);
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
        $this->load->view('contact/view', $data);
        $this->load->view('main_footer');
    }

  	/**
     * 点击内部名片姓名就进入详情页面
     */
    public function view1($id, $thispage)
    {

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        //联系人信息
        $data = $this->m_internal_contact->view($id);
        $data['thispage'] = $thispage ? $thispage : 1;
        
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
        $this->load->view('contact/view1', $data);
        $this->load->view('main_footer');
    }
    
	/**
	 * 名片录入页
	 */
	public function add()
	{
		//权限判断
		$this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'concact'));
                $settle=array(0=>"未落户",1=>"已落户",2=>"接洽中");
		
		$data['type'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
                $data['settle']=$settle;
		
		//是否使用IE浏览器，名片扫描控件只能使用IE
		$userAgent = $_SERVER['HTTP_USER_AGENT']; 
		if ( preg_match( '/MSIE/i', $userAgent ) || preg_match( '/Trident/i', $userAgent ) ) { 
			$data['usingie'] = true; 
		} else { 
			$data['usingie'] = false; 
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
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('contact/add', $data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 内部名片录入页
	 */
	public function add1(){
		//权限判断
		$this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu', array('menu' => 'concact'));
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

		$this->load->view('contact/add1', $data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 修改名片信息
	 */
	public function edit($id, $thispage=1)
	{
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        
		$data['type'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
		
		//是否使用IE浏览器，名片扫描控件只能使用IE
		$userAgent = $_SERVER['HTTP_USER_AGENT']; 
		if ( preg_match( '/MSIE/i', $userAgent ) || preg_match( '/Trident/i', $userAgent ) ) { 
			$data['usingie'] = true; 
		} else { 
			$data['usingie'] = false; 
		}
	$settle=array(0=>"未落户",1=>"已落户",2=>"接洽中");	
        //联系人信息
        $relArr = $this->m_contact_total->join_contact($id);
        $udata = $relArr[$id];
        $data['info']		= $udata;
        $arr=array();
        foreach($data['info']['settle'] as $val){
        if($val==0){
             $arr[]="未落户";    
            }else if($val==1){
              $arr[]="已落户";   
            }else if($val==2){
              $arr[]="接洽中";     
            }    
        }
      $data['info']['settlename']=$arr;
        //电话和地址的数组
        $data['mobile']	= isset($udata['mobile']) ? explode(',', $udata['mobile']) : array();
        $data['address']= isset($udata['address_contact']) ? explode(',', $udata['address_contact']) : array();
        $data['email']	= isset($udata['email']) ? explode(',', $udata['email']) : array();
        $data['tel']	= isset($udata['tel']) ? explode(',', $udata['tel']) : array();
        $data['fax']	= isset($udata['fax']) ? explode(',', $udata['fax']) : array();
        $data['thispage'] = $thispage;
        $data['settle'] = $settle;
		//******** 部门-人员 **********
		$this->load->model('m_department');
		$data['d_list'] = $this->m_department->department_list();
		
		$this->load->model('m_user');
		$userList = $this->m_user->user_list();
		$ownArr = explode(',',$udata['owner']);
		if(is_array($userList))
		{
			foreach($userList as $v)
			{
				$data['u_list'][$v->department][] = $v;
				$data['u_name'][$v->id] = $v->name;
				if(in_array($v->id,$ownArr))
				{
					if(empty($data['owner_name'])){
						$data['owner_name'] = $v->name;
					}else{
						$data['owner_name'] .= ','.$v->name;
					}
				}
			}
		}
		//******** 部门-人员 **********
		
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//var_dump($data);
		//-----右上角查询-----
        $this->load->view('contact/edit', $data);
        $this->load->view('main_footer');
	}
	
	/**
	 * 修改名片信息
	 */
	public function edit1($id, $thispage=1)
	{
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
		
        $data = $this->m_internal_contact->view($id);
        //电话和地址的数组
        $data['position']	= isset($data['position']) ? explode(',', $data['position']) : array();
        $data['mobile']	= isset($data['mobile']) ? explode(',', $data['mobile']) : array();
        $data['tel']= isset($data['tel']) ? explode(',', $data['tel']) : array();
        $data['home_tel']	= isset($data['home_tel']) ? explode(',', $data['home_tel']) : array();
        $data['thispage'] = $thispage;
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----

        $this->load->view('contact/edit1', $data);
        $this->load->view('main_footer');
	}
	
	/**
	 * 判断新增名片是否重复----------暂时搁置；改为后期可合并
	 */
	public function check_re()
	{
		$name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
	}
	
	/**
	 * 新增/修改名片
	 */
	public function save($action)
	{
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));
        
        $data = array(
        	'name'				=> trim($this->input->post('name')),
        	'star'				=> trim($this->input->post('star')),
        	'mobile'			=> trim(implode(',',$this->input->post('mobile'))),
        	'tel'				=> trim(implode(',',$this->input->post('tel'))),
        	'fax'				=> trim(implode(',',$this->input->post('fax'))),
        	'email'				=> trim(implode(',', $this->input->post('email'))),
        	'address_contact'	        => trim(implode(',',$this->input->post('address'))),
        	'owner'				=> trim($this->input->post('owner')),
        	'public'			=> trim($this->input->post('public')),
        	'pic_front'			=> trim($this->input->post('front')),
        	'pic_reverse'		        => trim($this->input->post('reverse')),
        	'remark'			=> trim($this->input->post('remark')),
        	'affairs_contact'	        => trim($this->input->post('affairs')),
        );
        if($data['name']=='')
        {
        	exit('<script>alert("请填写姓名");history.go(-1);</script>');
        }
        $arr_type	= $this->input->post('typeid');
        $arr_comp	= $this->input->post('companyname');
		$arr_url	= $this->input->post('url');
		$arr_code	= $this->input->post('postcode');
        $arr_posn	= $this->input->post('position');
        $arr_cpid	= $this->input->post('companyid');
        $arr_settle     =$this->input->post('settle');
        $arr_relax	= $this->input->post('relax');
        //拼合单位信息数组
        $arr_company = array();
        if(is_array($arr_type))
        {
        	foreach($arr_type as $k => $v)
        	{
        		$arr_company[$k] = array(
        			'type'	=> trim($v),
        			'cpid'	=> trim($arr_cpid[$k]),
        			'posn'	=> trim($arr_posn[$k]),
        			'comp'	=> trim($arr_comp[$k]),
					'url'	=> trim($arr_url[$k]),
					'postcode'=>trim($arr_code[$k]),
                    'settle'=>trim($arr_settle[$k])
        		);
        		if($action=='edit')
        		{
        			$arr_company[$k]['id']	= trim($arr_relax[$k]);
        		}
        		if($arr_company[$k]['type']==0)
        		{
        			exit('<script>alert("请选择单位分组");history.go(-1);</script>');
        		}
        		if($arr_company[$k]['comp']=='')
        		{
        			exit('<script>alert("请填写单位名称");history.go(-1);</script>');
        		}
        		if($arr_company[$k]['posn']=='')
        		{
        			exit('<script>alert("请填写职务信息");history.go(-1);</script>');
        		}
        	}
        }
        if($action=='add')
        {
			$companyExist=array();
			$companyExistIn=array();
			$status=true;
			//得到单位库里面存在的的单位的信息
			foreach($arr_company as $k=>$v)
			{
				if($v["cpid"]!="")
				{
					$companyExist[]=$v;
				}

			}

			if($companyExist=="")
			{
				if($this->m_contact->contact_insert($data,$arr_company))
				{
					echo "<script>alert('名片录入成功');location.href='/index.php/contact/add';</script>";
				}
				else
				{
					exit('<script>alert("名片录入失败");history.go(-1);</script>');
				}
			}
			else
			{
				//逐一判断单位里是否存在名片的名字
				foreach($companyExist as $value)
				{
					$result=$this->db->where(array('c_id'=>$value['cpid'],'u_name'=>$data['name']))->get('t_contact_app')->result_array();
					if($result)
					{
						$companyExistIn[]=$value['comp'];
						$status=FALSE;
					}
				}
				if($status)
				{
					if($this->m_contact->contact_insert($data,$arr_company))
					{
						echo "<script>alert('名片录入成功');location.href='/index.php/contact/add';</script>";
					}
					else
					{
						exit('<script>alert("名片录入失败");history.go(-1);</script>');
					}
				}
				else
				{
					$companyExistIn=implode(',',$companyExistIn);
					//echo "<script>alert('对不起".$companyExistIn."已经有该名称的员工');history.go(-1);</script>";
					exit("<script>alert('对不起".$companyExistIn."已经有该名称的员工');history.go(-1);</script>");
				}
			}

        }
        elseif($action=='edit')
        {
        	$id = trim($this->input->post('id'));
			//$contactCpid=$this->db->select('')
        	$page = trim($this->input->post('thispage'));
        	//删除的关系
        	$del_relax = explode(',',trim($this->input->post('del_relax')));
			$cpidArr=array();
			//编辑过程中未发生变化的名片的公司信息
			$noChangeArr=array();
			$result=$this->db->select('c_id')->where(array('u_id'=>$id))->get('t_contact_app')->result_array();
			//var_dump($result);
			if($result)
			{
				foreach($result as $k=>$v)
				{
					$cpidArr[]=$v['c_id'];
				}
				foreach($arr_company as $key=>$value)
				{
					if(!empty($value['id'])&& in_array($value['cpid'],$cpidArr))
					{
						$noChangeArr[]=$value['cpid'];
					}
				}
			}
			//需要判断名字重复性的的单位id
			$companyExist=array();
			//已经有该名称的员工的公司名称数组
			$companyExistIn=array();
			$status=true;
			//得到单位库里面存在的的单位的信息
			foreach($arr_company as $k=>$v)
			{
				if($v["cpid"]!="")
				{
					$companyExist[]=$v['cpid'];
				}
			}

			$companyExist=array_diff($companyExist,$noChangeArr);
				//逐一判断单位里是否存在名片的名字
				foreach($companyExist as $value)
				{
					$result=$this->db->where(array('c_id'=>$value,'u_name'=>$data['name']))->get('t_contact_app')->result_array();
					if($result)
					{
						$companyExistIn[]=$result[0]['c_name'];
						$status=FALSE;
					}
				}
				if($status)
				{
					if($this->m_contact->contact_update($id,$data,$arr_company,$del_relax))
	                {
	        	        echo '<script>alert("名片编辑成功");location.href="/index.php/contact/view/'.$id.'/'.$page.'";</script>';
					}
					else
					{
						exit('<script>alert("名片编辑失败");history.go(-1);</script>');
					}
				}
				else
				{
					$companyExistIn=implode(',',$companyExistIn);
					exit("<script>alert('对不起".$companyExistIn."已经有该名称的员工');history.go(-1);</script>");
				}

        }
	}
	
	/**
	 * 新增/修改内部名片
	 */
	public function save1($action)
	{
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));
        
        $data = array(
        	'name'				=> trim($this->input->post('name')),
        	'position'          => trim(implode(',',$this->input->post('position'))),
        	'mobile'			=> trim(implode(',',$this->input->post('mobile'))),
        	'tel'				=> trim(implode(',',$this->input->post('tel'))),
        	'secret_code'	    => trim($this->input->post('secret_code')),
        	'home_tel'			=> trim(implode(',',$this->input->post('home_tel'))),
        );
        $companyname	= $this->input->post('companyname');
        $address	= $this->input->post('address');
        $postcode	= $this->input->post('postcode');
        $companyid	= $this->input->post('companyid');
        //拼合单位信息数组
        $arr_company = array(
        	'companyid'=>$companyid,
        	'name'	=> $companyname,
        	'address'=> $address,
        	'postcode'	=> $postcode,
        	'addtime'	=> date('Y-m-d H:i:s',time()),
        );
        if($action=='add')
        {
	        $data['addtime'] = date('Y-m-d H:i:s',time());
        	if($this->m_internal_contact->insert($data,$arr_company))
	        {
	        	echo '<script>alert("名片录入成功");location.href="/index.php/contact/add1";</script>';
	        }
	        else
	        {
	        	exit('<script>alert("名片录入失败");history.go(-1);</script>');
	        } 
        }
        elseif($action=='edit')
        {
        	$id = trim($this->input->post('id'));
        	$page = trim($this->input->post('thispage'));
        	if($this->m_internal_contact->update($id,$data,$arr_company))
	        {
	        	echo '<script>alert("名片编辑成功");location.href="/index.php/contact/view1/'.$id.'/'.$page.'";</script>';
	        }
	        else
	        {
	        	exit('<script>alert("名片编辑失败");history.go(-1);</script>');
	        } 
        } 
	}
	
    //修改联系人页面 1.19改
    public function check_edit($id, $thispage)
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));

        $relArr = $this->m_contact_total->join_contact($id);
        $data = $relArr[$id];
        //电话和地址的数组
        $data['mobile'] = isset($data['mobile']) ? explode(',', $data['mobile']) : array();
        $data['address'] = isset($data['address_contact']) ? explode(',', $data['address_contact']) : array();

        //名片主人以及全部联系人
        //名片主人
        if ($data['owner'] != '0') {
            $user = $this->m_contact_total->get_field($data['owner'], 't_user');
            $data['username'] = $user['name'];
        } else {
            $data['username'] = '';
        }

        $data['usertotal'] = $this->m_contact_total->get_field(FALSE, 't_user');
        //分类name和企业name和职务
        foreach ($data['company_name'] as $k => $v) {
            $data['type_company_position'][$k] = array(
                'company_name' => $v,
                'company_id' => $data['company_id'][$k],
                'type_name' => $data['type_name'][$k],
                'type_id' => $data['type_id'][$k],
                'position' => $data['position'][$k],
            );
        }
        //分类下拉
        $this->db->order_by('detail', 'asc');
        $data['type_option'] = $this->m_contact_total->get_field(FALSE, 't_company_type');

        $this->load->helper('select');
        $data['select'] = type_select();
        
        $data['thispage'] = $thispage ? $thispage : 1;

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('contact/check_edit', $data);
        $this->load->view('main_footer');
    }

    //通过扫描新增联系人页 1.20 改
    public function IDcard_index()
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));

        $data['owner'] = $this->m_contact_total->get_field(FALSE, 't_user');
        $this->db->order_by('detail', 'asc');
        $data['type'] = $this->m_contact_total->get_field(FALSE, 't_company_type');

        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('contact/add', $data);
        $this->load->view('main_footer');
    }

    //通过企业名称得到企业详情 1.19改
    public function get_company_name()
    {
        $company_name = $_POST['name'];
        $rel = $this->m_contact_total->get_field(FALSE, 't_company', array('name' => $company_name));
        if ($rel) {
            $data = $rel[0];
            $relArr = $this->m_contact_total->get_field($rel[0]['ctype'], 't_company_type');
            $data['typename'] = $relArr['name'];
            $data['typeid'] = $relArr['id'];
            if($data['settle']==0){
            $data['settlename']="未落户";    
            }else if($data['settle']==1){
              $data['settlename']="已落户";   
            }else if($data['settle']==2){
              $data['settlename']="接洽中";     
            }
        } else {
            $data = 0;
        }
        echo json_encode($data);
    }

    //名片录入+手动添加  1.20改
    public function add_total()
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'));
        //上传图片
        $pic_front = $this->upload_picture('photo');
        if($pic_front['succ'])
        {
        	$pic_front = $pic_front['pic'];
        }
        else
        {
        	echo "<script>alert('".$pic_front['msg']."');</script>";
        	$pic_front = '';
        }

        $pic_reverse = $this->upload_picture('photo_reverse');
        if($pic_reverse['succ'])
        {
        	$pic_reverse = $pic_reverse['pic'];
        }
        else
        {
        	echo "<script>alert('".$pic_reverse['msg']."');</script>";
        	$pic_reverse = '';
        }
        //添加联系人信息
        $mobile = isset($_POST['mobile']) ? implode(',', $_POST['mobile']) : '';
        $address = isset($_POST['address']) ? implode(',', $_POST['address']) : '';
        $data_contact = array(
            'name' => $_POST['name'],
            'tel' => $_POST['tel'],
            'mobile' => $mobile,
            'address_contact' => $address,
            'star' => $_POST['star'],
            'fax' => $_POST['fax'],
            'email' => $_POST['email'],
            'owner' => $_POST['owner'],
            'public' => isset($_POST['public']) ? 1 : 0,
            'remark' => $_POST['remark'],
            'affairs_contact' => $_POST['affairs'],
            'pic_front' => $pic_front,
            'pic_reverse' => $pic_reverse,
            'addtime' => date('y-m-d h:i:s', time())
        );

        $contactid_new = $this->m_contact_total->add($data_contact, 't_contact');

        //判断是否有该企业  如果有 只添加关系；如果没有  添加企业和关系
        if (isset($_POST['typeid']['0']) && isset($_POST['companyname']['0'])) {
            foreach ($_POST['companyid'] as $k => $v) {
                if (empty($v)) {
                    $comArrInsert['name'] = $_POST['companyname'][$k];
                    $comArrInsert['ctype'] = $_POST['typeid'][$k];

                    $comInsertid = $this->m_contact_total->add($comArrInsert, 't_company');

                    $relArrInsert['type_id'] = $_POST['typeid'][$k];
                    $relArrInsert['company_id'] = $comInsertid;
                    $relArrInsert['contact_id'] = $contactid_new;
                    $relArrInsert['position'] = $_POST['position'][$k];

                    $resInsert = $this->m_contact_total->add($relArrInsert, 't_company_contact');

                } else {
                    $relArrInsert['type_id'] = $_POST['typeid'][$k];
                    $relArrInsert['company_id'] = $_POST['companyid'][$k];
                    $relArrInsert['contact_id'] = $contactid_new;
                    $relArrInsert['position'] = $_POST['position'][$k];

                    $resInsert = $this->m_contact_total->add($relArrInsert, 't_company_contact');
                }
            }

            if ($resInsert) {
                redirect('contact');
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        }
    }

    //修改联系人页面：联系人+企业+企业联系人相关表 1.20 改
    public function edit_total()
    {
        $this->login->check_jurisdict('2', $this->session->userdata('user_jurisdict'));

        //-----上传图片-----
        $pic_front = $this->upload_picture('photo');
        if($pic_front['succ'])
        {
        	$pic_front = $pic_front['pic'];
        }
        else
        {
//        	echo "<script>alert('".$pic_front['msg']."');</script>";
        	$pic_front = '';
        }

        $pic_reverse = $this->upload_picture('photo_reverse');
        if($pic_reverse['succ'])
        {
        	$pic_reverse = $pic_reverse['pic'];
        }
        else
        {
//        	echo "<script>alert('".$pic_reverse['msg']."');</script>";
        	$pic_reverse = '';
        }
        //-----上传图片-----
       
        //修改联系人表 t_contact
        $mobile = implode(',', $this->input->post('mobile'));
        $address = implode(',', $this->input->post('address'));
        $data_contact = array(
            'name' => $_POST['name'],
            'tel' => $_POST['tel'],
            'mobile' => $mobile,
            'address_contact' => $address,
            'star' => $_POST['star'],
            'fax' => $_POST['fax'],
            'email' => $_POST['email'],
            'owner' => $_POST['owner'],
            'public' => isset($_POST['public']) ? 1 : 0,
            'remark' => $_POST['remark'],
            'affairs_contact' => $_POST['affairs'],
            'pic_front' => $pic_front,
            'pic_reverse' => $pic_reverse,
        );
        
        //企业联系人关系表
        //删除该联系人关联的企业ID
        $del_company = $this->input->post('del_company');
        //添加的关联企业信息
		$companyid = $this->input->post('companyid');//企业ID
		$companyid = $this->input->post('companyid');//企业ID
		$companyid = $this->input->post('companyid');//企业ID
		$companyid = $this->input->post('companyid');//企业ID
        
        print_r($_POST);print_r($data_contact);exit();

        $rel_1 = $this->m_contact_total->edit($_POST['contactid'], 't_contact', $data_contact);

        //删除所有关系
        $reldel = $this->m_contact_total->del(FALSE, 't_company_contact', array('contact_id' => $_POST['contactid']));

        //判断是否有该企业  如果有 只添加关系；如果没有  添加企业和关系
        if (isset($_POST['typeid']['0']) && isset($_POST['companyname']['0'])) {
            foreach ($_POST['companyid'] as $k => $v) {
                if (empty($v)) {
                    $comArrInsert['name'] = $_POST['companyname'][$k];
                    $comArrInsert['ctype'] = $_POST['typeid'][$k];

                    $comInsertid = $this->m_contact_total->add($comArrInsert, 't_company');

                    $relArrInsert['type_id'] = $_POST['typeid'][$k];
                    $relArrInsert['company_id'] = $comInsertid;
                    $relArrInsert['contact_id'] = $_POST['contactid'];
                    $relArrInsert['position'] = $_POST['position'][$k];

                    $resInsert = $this->m_contact_total->add($relArrInsert, 't_company_contact');

                } else {
                    $relArrInsert['type_id'] = $_POST['typeid'][$k];
                    $relArrInsert['company_id'] = $_POST['companyid'][$k];
                    $relArrInsert['contact_id'] = $_POST['contactid'];
                    $relArrInsert['position'] = $_POST['position'][$k];

                    $resInsert = $this->m_contact_total->add($relArrInsert, 't_company_contact');
                }
            }

            if ($resInsert) {
                redirect('/contact/check_index/' . $_POST['contactid'] . '/' . $_POST['thispage']);
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        }
    }

    //删除联系人中 企业的联系 1.20
    public function del_company()
    {
        $this->login->check_jurisdict('2', $this->session->userdata('user_jurisdict'));
        
        $companyid = $_POST['companyid'];
        $contactid = $_POST['contactid'];

        $companyArr = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('contact_id' => $contactid));
        if (isset($companyArr['1'])) {
            $rel = $this->m_contact_total->del(FALSE, 't_company_contact', array('contact_id' => $contactid, 'company_id' => $companyid));
            if ($rel) {
                echo 'success';
            } else {
                echo 'false';
            }
        } else {
            echo 'last';
        }

    }

    //假删除 ok
    public function delete()
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'), true);

        $ids = $this->input->post('ids');
        $res = $this->m_contact->stop_field($ids);

        if ($res) {
            echo 'success';
        } else {
            echo '删除失败';
        }
    }
    
 	// 内部名片假删除 
    public function delete1()
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'), true);

        $ids = $this->input->post('ids');
        $res = $this->m_internal_contact->del($ids);

        if ($res) {
            echo 'success';
        } else {
            echo '删除失败';
        }
    }
    
	// 内部名片假删除 
    public function del()
    {
        //权限判断
        $this->login->check_jurisdict('4', $this->session->userdata('user_jurisdict'), true);

        $id = $this->input->post('id');
        $res = $this->m_internal_contact->del1($id);

        if ($res) {
            echo 'success';
        } else {
            echo '删除失败';
        }
    }


    /*
     * 上传图片功能
     * @param string $field_name 图片名称
     * return string 图片的路径
     */
    function upload_picture($field_name)
    {
    	//上传
    	$config['upload_path'] = './uploads/contact/';
    	$config['allowed_types'] = 'png|gif|jpg';
    	$config['max_size'] = '5120';
    	$config['max_width'] = '2048';
    	$config['max_height'] = '1024';
    	
    	$this->load->library('upload', $config);
    	$load = $this->upload->do_upload($field_name);

    	if (!$load) 
    	{
    		return array('succ'=>false,'msg'=>'图片上传失败');
    	} 
    	else
    	{
    		$data = $this->upload->data();
    		$logo = $data['full_path'];
    		$picArr = explode('/uploads/', $logo);
    		$logo = '/uploads/' . $picArr[1];
    		
	    	$pic = isset($logo) ? $logo : '';
	    	return array('succ'=>true,'pic'=>$pic);
    	}
    }

	/**
	 * 上传图片
	 */
	public function pic()
	{
		//上传
    	$config['upload_path'] = './uploads/contact/';
    	$config['allowed_types'] = 'png|gif|jpg';
    	$config['max_size'] = '5120';
    	$config['max_width'] = '2048';
    	$config['max_height'] = '1024';

    	$this->load->library('upload', $config);
    	
    	$load = $this->upload->do_upload('i_file');

    	if (!$load) 
    	{
    		echo "<script>parent.pic_back('**上传失败**');</script>";
    	} 
    	else
    	{
    		$data = $this->upload->data();
    		$logo = $data['full_path'];
    		$picArr = explode('/uploads/', $logo);
    		$logo = '/uploads/' . $picArr[1];
    		
	    	$pic = isset($logo) ? $logo : '';
			//echo "<script>alert('".$pic."')</script>";
	    	echo "<script>parent.pic_back('".$pic."');</script>";
    	}
	}
	
	/**
	 * 根据输入文字获取单位名称列表，10个
	 */
	public function get_company_by_code()
	{		
		$list = $this->m_company->company_list(array('code'=>$this->input->post('name'),'del'=>0),0,10);

		$arr = array();
		if(is_array($list))
		{
			foreach($list as $v)
			{
				$arr[] = $v->name;
			}
			echo implode(',',$arr);
		}
		else
		{
			echo '';
		}
	}
	
	/**
	 * 新增根据文字获取内部单位名称列表，10个
	 */
	public function get_internal_company_by_code()
	{		
		$list = $this->m_internal_company->company_list(array('code'=>$this->input->post('name')),0,10);

		$arr = array();
		if(is_array($list))
		{
			foreach($list as $v)
			{
				$arr[] = array(
					'id'=>$v->id,
					'name'=>$v->name,
					'address'=>$v->address,
					'postcode'=>$v->postcode
				);
			}
			echo json_encode($arr);
		}
		else
		{
			echo '';
		}
	}
	
	/**
	 * 内部名片管理
	 */
	public function contact_manage($page = '1', $pageSize = '20'){
		$this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
		//-----获取查询条件------
		if(empty($_POST))
		{
			$where = $this->session->userdata('internal_contact_select');
		}
		else
		{
			$where['value']			= $this->input->post('value');
			$this->session->set_userdata(array('internal_contact_select'=>$where));
		}
		$data = array('where' => $where);
		//-----获取查询条件------
        $this->load->model('m_internal_contact');
        
		//---------分页------------
		$num = $this->m_internal_contact->contact_list_num($where['value']);
		$data['num']	= $num;
		
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/contact/contact_manage/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		$data['pages']	= $pages;
		$data['page']	= $page;
		//---------分页------------

		//-----获取数据-----
		if(!isset($where['value']))
		{
			$where['value'] = '';
		}
        $list = $this->m_internal_contact->contact_list($where['value'],($page-1)*$pageSize,$pageSize);
		$data['list']	= $list;
		//-----获取数据-----
		//-----右上角查询-----
		$this->load->helper('select');
		$data['select']	= type_select();
		//-----右上角查询-----
        $this->load->view('contact/contact_manage', $data);
        $this->load->view('main_footer');
	}
	
}