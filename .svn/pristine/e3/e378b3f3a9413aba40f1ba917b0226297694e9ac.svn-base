<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 联系人模块
 * 往来活动管理
 * 数据库连接：t_activity
 */
class activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //权限判断
        $this->load->library('session');
        $this->load->library('login');
        $this->login->check_login($this->session->userdata('user_id'));
        $this->login->check_jurisdict('2', $this->session->userdata('user_jurisdict'));

        $this->load->model('m_contact_total');
        $this->load->helper(array('form', 'url'));
    }

    //1.20改
    public function index($page = '1', $pageSize = '20')
    {
        $like = array();
        $where = array();
        //首页模糊查询
        if (!empty($_POST)) {
            //模糊查询
            if (!empty($_POST['companyname'])) {
                $like['key'] = 't_company.name';
                $like['match'] = $_POST['companyname'];
                //WHERE key LIKE '%match%' both
            }
            if (!empty($_POST['contactname'])) {
                $like['key'] = 't_contact.name';
                $like['match'] = $_POST['contactname'];
                //WHERE key LIKE '%match%' both
            }

            if ($_POST['ctype'] != '0') {
                $where['t_activity.ctype'] = $_POST['ctype'];
            }
            if ($_POST['date'] != '') {
                $where['t_activity.cdate'] = $_POST['date'];
                //WHERE key LIKE '%match%' both
            }
        }

        $date = $this->input->post('date');
        if ($date == '') {
            $date = date('Y-m-d');
        }
        $data['date'] = $date;

        //---------分页------------
        $num = $this->m_contact_total->get_num($where, $like, 't_activity');
        $pages = ceil($num / $pageSize);
        if ($page > $pages) $page = $pages;
        if ($page < 1) $page = 1;

        $this->load->library('pagination');

        $config['base_url'] = '/index.php/activity/index/';
        $config['total_rows'] = $num;
        $config['per_page'] = $pageSize;

        $this->pagination->initialize($config);

        $pages = $this->pagination->create_links();

        //---------分页------------

        $data['pages'] = $pages;

        //分页
        if ($pageSize > 0) {
            $this->db->limit($pageSize, ($page - 1) * $pageSize);
        }

        $activityArr = $this->m_contact_total->join_activity(FALSE, $where, $like);

        //接待人员名称
        foreach ($activityArr as $k => $v) {
            $userArr = $this->m_contact_total->get_field($v['user'], 't_user');
            if(!empty($userArr)){
            	 $activityArr[$k]['username'] = $userArr['name'];
            }else{
            	 $activityArr[$k]['username'] = '';
            }
        }
        /*
        //礼品
        foreach ($activityArr as $k => $v) {
            $activityArr[$k]['stock'] = $this->m_contact_total->join_stock($k);
        }
        */
		//var_dump($activityArr);
        $data['name'] = $activityArr;

        $data['user'] = $this->m_contact_total->get_field(FALSE, 't_user');
        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('activity/index', $data);
        $this->load->view('main_footer');
    }

    //企业和联系人的联动  暂时没用
//    public function contactlinkage()
//    {
//        $id = $_POST['id'];
//        $Comdata = $this->m_activity->get_field(FALSE, 't_contact', array('company' => $id));
//        $contact = array();
//        foreach ($Comdata as $v) {
//            $contact[$v['id']] = $v['name'];
//        }
//        $data['contact'] = $contact;
//        echo json_encode($data);
//    }

    //添加数据页面 1.21改
    public function index_add($id = FALSE)
    {
        $data['user'] = $this->m_contact_total->get_field(FALSE, 't_user');
        $data['contact'] = array();
        $data['company'] = array();
        //$id 为联系人id
        if ($id) {
            $contactArr = $this->m_contact_total->get_field($id, 't_contact');
            $data['contact'] = $contactArr['name'];
            
            //企业信息
            $contactcompanyArr = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('contact_id' => $id));
            foreach ($contactcompanyArr as $k => $v) {
                $companyArr = $this->m_contact_total->get_field($v['company_id'], 't_company');
                $arr_tmp = array(
                	'companyid'	=> $companyArr['id'],
                	'companyname'	=> $companyArr['name'],
                );
                $data['company'][] = $arr_tmp;
            }
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
		
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('activity/index_add', $data);
        $this->load->view('main_footer');
    }

    //添加数据 1.22 改
    public function add()
    {
        //权限判断
        $this->login->check_jurisdict('7', $this->session->userdata('user_jurisdict'));

        /*
        $stock_name = array_filter($_POST['stock_name']);
        //如果类型是往的情况  首先判断是否有库存或者库存不足
        if ($_POST['ctype'] == '2') {
            foreach ($stock_name as $k => $v) {
                $stockArr = $this->m_contact_total->get_field(FALSE, 't_stock', array('name' => $v));
                if (empty($stockArr['0'])) {
                    echo "<script>alert('对不起，库存中没有" . $v . "！');location.href='activity'</script>";
                    exit();
                } elseif ($stockArr['0']['num'] < $_POST['stock_num'][$k]) {

                    echo "<script>alert('对不起，" . $v . "库存不足！');location.href='activity'</script>";
                    exit();
                } else {
                    continue;
                }
            }
        }
        */
        //添加activity表内容
        $activityData = array(
            'cdate' => date('Y-m-d H:i:s', time()),
            'ctype' => $_POST['ctype'],
            'user' => $_POST['user'],
            'info' => $_POST['info'],
            'remark1' => $_POST['remark1'],
        );
        $newActivityID = $this->m_contact_total->add($activityData, 't_activity');

        //添加活动和联系人以及活动和企业关系
        $contactidArr = array_filter($_POST['contactid']);
        foreach ($contactidArr as $k => $v) {
            $contactArr = array(
                'contact_id' => $v,
                'activity_id' => $newActivityID
            );
            $contactActivity = $this->m_contact_total->add($contactArr, 't_contact_activity');
        }

        $companyidArr = array_filter($_POST['companyid']);
        foreach ($companyidArr as $k => $v) {
            $companyArr = array(
                'company_id' => $v,
                'activity_id' => $newActivityID
            );
            $companyActivity = $this->m_contact_total->add($companyArr, 't_company_activity');
        }

        /*隐藏礼品功能
        //添加storage表
        foreach ($stock_name as $k => $v) {
            $stockArr = $this->m_contact_total->get_field(FALSE, 't_stock', array('name' => $v));

            if (empty($stockArr)) {
                $newstockArr = array(
                    'name' => $v,
                    'num' => $_POST['stock_num'][$k]
                );
                $newstockID = $this->m_contact_total->add($newstockArr, 't_stock');
            } else {
                $newstockID = $stockArr['id'];
                if ($_POST['ctype'] == 1) {
                    $num = $stockArr['num'] + $_POST['stock_num'][$k];
                } else {
                    $num = $stockArr['num'] - $_POST['stock_num'][$k];
                }

                $editstockArr = array(
                    'num' => $num
                );
                $this->m_contact_total->edit($newstockID, 't_stock', $editstockArr);
            }

            $storageArr = array(
                'stype' => $_POST['ctype'],
                'stock' => $newstockID,
                'stock_num' => $_POST['stock_num'][$k],
                'activity' => $newActivityID
            );
            $newstorageID = $this->m_contact_total->add($storageArr, 't_storage');
        }
        */
        if ($newActivityID) {
            redirect('activity');
        } else {
            echo "<script>alert('操作失败')</script>";
        }
    }

    //删除数据（连礼品入库信息一起删除） 1.21改
    public function del()
    {
        //权限判断
        $this->login->check_jurisdict('7', $this->session->userdata('user_jurisdict'), true);
        $id = $this->input->post('id');
        //删除往来记录
        $status = $this->m_contact_total->del($id, 't_activity');
        /*
        //修改库存表
        $stockArr = $this->m_contact_total->get_field(FALSE, 't_storage', array('activity' => $id));
        foreach ($stockArr as $v) {
            $stocktotal = $this->m_contact_total->get_field($v['stock'], 't_stock');
            $num_total = $stocktotal['num'];
            $new_num = $num_total - $v['stock_num'];
            $this->m_contact_total->edit($v['stock'], 't_stock', array('num' => $new_num));
        }
        //删除出入库信息
        $res = $this->m_contact_total->del(FALSE, 't_storage', array('activity' => $id));
        */
        if ($status) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    //查看往来活动 1.21 改
    public function check()
    {
        $id = $this->input->post('id');
        $data = $this->m_contact_total->get_field($id, 't_activity');

        if ($data['ctype'] == 1) {
            $data['typename'] = '来';
        } else {
            $data['typename'] = '往';
        }

        //企业
        $companyid = $this->m_contact_total->get_field(FALSE, 't_company_activity', array('activity_id' => $id));
        foreach ($companyid as $v) {
            $companyArr = $this->m_contact_total->get_field($v['company_id'], 't_company');
            $company_name[] = $companyArr['name'];
        }

        //联系人
        $contactid = $this->m_contact_total->get_field(FALSE, 't_contact_activity', array('activity_id' => $id));
        foreach ($contactid as $v) {
            $contactArr = $this->m_contact_total->get_field($v['contact_id'], 't_contact');
            $contact_name[] = $contactArr['name'];
        }
        /*
        //礼品
        $stock = $this->m_contact_total->get_field(FALSE, 't_storage', array('activity' => $id));
        foreach ($stock as $k => $v) {
            $stockArr = $this->m_contact_total->get_field($v['stock'], 't_stock');
            $stock_info[$k]['name'] = $stockArr['name'];
            $stock_info[$k]['num'] = $v['stock_num'];
        }
        $data['stock'] = $stock_info;
        */

        $data['cdate'] = substr($data['cdate'], 0, 10);

        $user = $this->m_contact_total->get_field($data['user'], 't_user');
        $data['user_name'] = $user['name'] ? $user['name'] : '';
        $data['contactname'] = $contact_name;
        $data['companyname'] = $company_name;

        //控制联动公司下联系人
//        $Comdata = $this->m_activity->get_field(FALSE, 't_contact', array('company' => $data['companyid']));
//        $contact = array();
//        foreach ($Comdata as $v) {
//            $contact[$v['id']] = $v['name'];
//        }
//        $data['contactarr'] = $contact;

        echo json_encode($data);
    }


    //通过联系人姓名获取所有数据 1.21
    public function get_contact_name()
    {
        $name = $_POST['name'];
        $like['key'] = 't_contact.name';
        $like['match'] = $name;
        $contactArr = $this->m_contact_total->join_contact(FALSE, $like, FALSE);
        foreach ($contactArr as $k => $v) {
            $contactArr[$k]['position_str'] = implode(',', $v['position']);
            $contactArr[$k]['company_name_str'] = implode(',', $v['company_name']);
            $contactArr[$k]['type_name_str'] = implode(',', $v['type_name']);
        }
        $contactArr = array_values($contactArr);
        echo json_encode($contactArr);
    }

    //通过企业获取企业信息 1.21
    public function get_company_name()
    {
        $name = $_POST['name'];
        $like['key'] = 'name';
        $like['match'] = $name;
        $companyArr = $this->m_contact_total->get_field(FALSE, 't_company', array('del' => 0), $like);
        foreach ($companyArr as $k => $v) {
            $typeArr = $this->m_contact_total->get_field($v['ctype'], 't_company_type');
            $companyArr[$k]['type_name'] = $typeArr['name'];
        }
        echo json_encode($companyArr);
    }

    //添加数据页面 1.21改
    public function index_edit($id)
    {
        $activityArr = $this->m_contact_total->join_activity($id);
        $data = $activityArr[$id];
        $data['useroption'] = $this->m_contact_total->get_field(FALSE, 't_user');

        //礼品
        $data['stock'] = $this->m_contact_total->join_stock($id);

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('activity/index_edit', $data);
        $this->load->view('main_footer');
    }


    //修改往来活动
    public function edit()
    {
        //权限判断
        $this->login->check_jurisdict('7', $this->session->userdata('user_jurisdict'));

        //activity id
        $id = $_POST['mid'];
		/*
        $stock_name = array_filter($_POST['stock_name']);
        //如果类型是往的情况  首先判断是否有库存或者库存不足
        if ($_POST['ctype'] == '2') {
            foreach ($stock_name as $k => $v) {
                $stockArr = $this->m_contact_total->get_field(FALSE, 't_stock', array('name' => $v));
                if (empty($stockArr['0'])) {
                    echo "<script>alert('对不起，库存中没有" . $v . "！');location.href='activity'</script>";
                    exit();
                } elseif ($stockArr['0']['num'] < $_POST['stock_num'][$k]) {

                    echo "<script>alert('对不起，" . $v . "库存不足！');location.href='activity'</script>";
                    exit();
                } else {
                    continue;
                }
            }
        }
        */
        //修改activity表内容
        $activityData = array(
            'ctype' => $_POST['ctype'],
            'user' => $_POST['user'],
            'info' => $_POST['info'],
            'remark1' => $_POST['remark1'],
        );
        $status = $this->m_contact_total->edit($id, 't_activity', $activityData);

        //修改企业和往来活动关系表 先删除后添加

        $this->m_contact_total->del(FALSE, 't_company_activity', array('activity_id' => $id));
        $this->m_contact_total->del(FALSE, 't_contact_activity', array('activity_id' => $id));

        //添加活动和联系人以及活动和企业关系
        $contactidArr = array_filter($_POST['contactid']);
        foreach ($contactidArr as $k => $v) {
            $contactArr = array(
                'contact_id' => $v,
                'activity_id' => $id
            );
            $contactActivity = $this->m_contact_total->add($contactArr, 't_contact_activity');
        }

        $companyidArr = array_filter($_POST['companyid']);
        foreach ($companyidArr as $k => $v) {
            $companyArr = array(
                'company_id' => $v,
                'activity_id' => $id
            );
            $companyActivity = $this->m_contact_total->add($companyArr, 't_company_activity');
        }
		/*
        //修改和添加storage表
        foreach ($stock_name as $k => $v) {
            $stockArr = $this->m_contact_total->get_field(FALSE, 't_stock', array('name' => $v));

            if (empty($stockArr['0'])) {
                $newstockArr = array(
                    'name' => $v,
                    'num' => $_POST['stock_num'][$k]
                );
                $newstockID = $this->m_contact_total->add($newstockArr, 't_stock');
            } else {
                $newstockID = $stockArr['0']['id'];

                //原来的t_storage的信息
                $oldarr = $this->m_contact_total->get_field(FALSE, 't_storage', array('activity' => $id, 'stock' => $stockArr['0']['id']));

                if ($_POST['ctype'] == 1) {
                    $num = $stockArr['0']['num'] - $oldarr['0']['stocknum'] + $_POST['stock_num'][$k];
                } else {
                    $num = $stockArr['0']['num'] + $oldarr['0']['stocknum'] - $_POST['stock_num'][$k];
                }

                $editstockArr = array(
                    'num' => $num
                );
                $this->m_contact_total->edit($newstockID, 't_stock', $editstockArr);

                //先删除  再添加
                $this->m_contact_total->del(FALSE, 't_storage', array('stock' => $stockArr['0']['id']));
            }

            $storageArr = array(
                'stype' => $_POST['ctype'],
                'stock' => $newstockID,
                'stock_num' => $_POST['stock_num'][$k],
                'activity' => $id
            );
            $newstorageID = $this->m_contact_total->add($storageArr, 't_storage');
        }
		*/
        if ($status) {
            redirect('activity');
        } else {
            echo "<script>alert('操作失败')</script>";
        }

    }

    //通过联系人点进往来记录
    public function get_list($id)
    {
        //$id为联系人ID
        $where = array(
            'contact' => $id
        );
        $data = $this->m_activity->get_field(FALSE, 't_activity', $where);

        //组合列表
        foreach ($data as $k => $v) {
            if ($v['ctype'] == 1) {
                $data[$k]['typename'] = '来';
            } else {
                $data[$k]['typename'] = '往';
            }
            $data[$k]['cdate'] = substr($v['cdate'], 0, 10);
            $contact = $this->m_activity->get_field($v['contact'], 't_contact');
            $company = $this->m_activity->get_field($contact['company'], 't_company');
            $data[$k]['contactname'] = $contact['name'];
            $data[$k]['contactposition'] = $contact['position'];
            $data[$k]['contactmobile'] = $contact['mobile'];
            $data[$k]['contactemail'] = $contact['email'];
            $data[$k]['companyname'] = $company['name'];
        }
        $activity['contactname'] = $data[0]['contactname'];

        $activity['name'] = $data;

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('activity/index', $activity);
        $this->load->view('main_footer');
    }

}