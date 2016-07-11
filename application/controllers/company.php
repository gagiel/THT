<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 联系人模块
 * 分类管理
 * 数据库连接：t_company_type
 */
class Company extends CI_Controller
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

    public function index($page = '1', $pageSize = '20')
    {
        //首页查询
        $like = array();
        if(empty($_POST)){
        	$like = $this->session->userdata('company_like_select');
        	$where = $this->session->userdata('company_where_select');
        }else{
          //模糊查询
            if (isset($_POST['company_index'])) {
                $like['key'] = 't_company.name';
                $like['match'] = $_POST['company_index'];
                //WHERE key LIKE '%match%' both
            }
         	if ($_POST['ctype_index'] != '0') {
                $where['ctype'] = $_POST['ctype_index'];
            }
            //首页排序
            if ($_POST['company_option'] != '0') {
                $this->db->order_by('name', 'ASC');
            }
            if ($_POST['order_option'] != '0') {
                $order = $_POST['order_option'];
                $this->db->order_by('id', $order);
            }

            $this->session->set_userdata(array('company_like_select'=>$like));
            if(isset($where))
            {
                $this->session->set_userdata(array('company_where_select'=>$where));
            }

        }
        $where['del'] = 0;
        //把like模糊查询条件传到页面
        $data['like'] = $like;
        //---------分页------------
        $num = $this->m_contact_total->get_num($where, $like, 't_company');
        $pages = ceil($num / $pageSize);
        if ($page > $pages) $page = $pages;
        if ($page < 1) $page = 1;

        $this->load->library('pagination');

        $config['base_url'] = '/index.php/company/index/';
        $config['total_rows'] = $num;
        $config['per_page'] = $pageSize;

        $this->pagination->initialize($config);

        $pages = $this->pagination->create_links();

        //---------分页------------

        $data['pages'] = $pages;

        /*
         * company,company_contact,contact,company_type 四个表联表
         * company为主表
         */

        //分页
        if ($pageSize > 0) {
            $this->db->limit($pageSize, ($page - 1) * $pageSize);
        }

        $companyArr = $this->m_contact_total->get_field(FALSE, 't_company', $where, $like);

        foreach ($companyArr as $k => $v) {
            $relationArr = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('company_id' => $v['id']));
            if (!empty($relationArr)) {
                foreach ($relationArr as $key => $val) {
                    $contactArr = $this->m_contact_total->get_field($val['contact_id'], 't_contact');
                    $companyArr[$k]['contact'][$key] = $contactArr;
                }
            } else {
                $companyArr[$k]['contact'] = '';
            }

            //分类的名称
            $typeArr = $this->m_contact_total->get_field($v['ctype'], 't_company_type');
            $companyArr[$k]['tid'] = $typeArr['id'];
            $companyArr[$k]['tname'] = $typeArr['name'];
        }

        //分类的循环
        $this->db->order_by('detail', 'asc');
        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
        //传递到前端信息
        $data['name'] = $companyArr;


        $this->load->helper('select');
        $data['select'] = type_select();
        //var_dump($data);
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'company'));
        $this->load->view('company/index', $data);
        $this->load->view('main_footer');
    }
    //新增展示页
    public function check_add(){
        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');

        $this->load->helper('select');

        $data['select'] = type_select();
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('company/add_show',$data);
        $this->load->view('main_footer');
    }
    //修改展示页
    public function check_update($id){
        //该主表id的全部信息
        $data = $this->m_contact_total->get_field($id, 't_company');

        $relation_array = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('company_id' => $id));

        if (isset($relation_array['0'])) {
            foreach ($relation_array as $k => $v) {
                $contactArr = $this->m_contact_total->get_field($v['contact_id'], 't_contact');
                $data['contact'][$k]['name'] = $contactArr['name'];
                $data['contact'][$k]['position'] = $v['position'];
            }
        }else{
            $data['contact'] = '';
        }

        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
        //单位落户数组
        $data['settle_array']=array(
            '0'=>'未落户',
            '1'=>'已落户',
            '2'=>'接洽中',
        );
        $settleArr = $this->m_contact_total->get_field(FALSE, 't_company_settle', array('company_id' => $id));
        if (isset($settleArr['0'])) {
            foreach ($settleArr as $val) {
                $settle[] = array(
                    'id' => $val['id'],
                    'username' => $val['user_name'],
                    'info' => $val['info']
                );
            }
            $data['settleinfo'] = $settle;
        } else {
            $data['settleinfo'] = '';
        }
//      var_dump($data);exit();
        $this->load->helper('select');
        $data['select'] = type_select();
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('company/update_show', $data);
        $this->load->view('main_footer');
    }
    //推荐展示页
    public function check_recommend($id){
        //该主表id的全部信息
        $data = $this->m_contact_total->get_field($id, 't_company');

        $relation_array = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('company_id' => $id));

        if (isset($relation_array['0'])) {
            foreach ($relation_array as $k => $v) {
                $contactArr = $this->m_contact_total->get_field($v['contact_id'], 't_contact');
                $data['contact'][$k]['name'] = $contactArr['name'];
                $data['contact'][$k]['position'] = $v['position'];
            }
        }else{
            $data['contact'] = '';
        }

        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');
        //单位落户数组
        $data['settle_array']=array(
            '0'=>'未落户',
            '1'=>'已落户',
            '2'=>'接洽中',
        );
        $settleArr = $this->m_contact_total->get_field(FALSE, 't_company_settle', array('company_id' => $id));
        if (isset($settleArr['0'])) {
            foreach ($settleArr as $val) {
                $settle[] = array(
                    'id' => $val['id'],
                    'username' => $val['user_name'],
                    'info' => $val['info']
                );
            }
            $data['settleinfo'] = $settle;
        } else {
            $data['settleinfo'] = '';
        }
//      var_dump($data);exit();
        $this->load->helper('select');
        $data['select'] = type_select();
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('company/recommend_show', $data);
        $this->load->view('main_footer');
    }

    //第二期 查看企业页面 弹窗变页面 1.28
    public function check_index($id)
    {
        //该主表id的全部信息
        $data = $this->m_contact_total->get_field($id, 't_company');
        $relation_array = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('company_id' => $id));

        if (isset($relation_array['0'])) {
            foreach ($relation_array as $k => $v) {
                $contactArr = $this->m_contact_total->get_field($v['contact_id'], 't_contact');
                $data['contact'][$k]['name'] = $contactArr['name'];
                $data['contact'][$k]['position'] = $v['position'];
            }
        }else{
            $data['contact'] = '';
        }

        $typeArr = $this->m_contact_total->get_field($data['ctype'], 't_company_type');
        $data['tname'] = $typeArr['name'];

        $settleArr = $this->m_contact_total->get_field(FALSE, 't_company_settle', array('company_id' => $id));
        if (isset($settleArr['0'])) {
            foreach ($settleArr as $val) {
                $settle[] = array(
                    'id' => $val['id'],
                    'username' => $val['user_name'],
                    'info' => $val['info']
                );
            }
            $data['settleinfo'] = $settle;
        } else {
            $data['settleinfo'] = '';
        }
//      var_dump($data);exit();
        $this->load->helper('select');
		$data['select'] = type_select();
        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('company/check_index', $data);
        $this->load->view('main_footer');
    }

    //增加企业
    public function add()
    {
        $return = $this->m_contact_total->check_name('t_company', $_POST['name']);
        if ($return) {
            echo "<script>alert('企业名称不能重复！');location.href='company'</script>";
        } else {
            //$logo = $this->m_contact_total->upload_picture('imgfile1');
          
            $data = array(
                'name' => $_POST['name'],
                'url'  => $_POST['url'],
                'postcode' =>$_POST['postcode'],
                'ctype' => $_POST['ctype'],
                'brief' => $_POST['brief'],
                'way' => $_POST['way'],
                'logo' => $_POST['imgfile1'],
                'pic' => $_POST['info'],
                'settle' => $_POST['settle'],
                'del' => 0,
                'recommend' => 0
            );
            //添加数据成功
            if ($this->m_contact_total->add($data, 't_company')) {
                redirect('company');
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        }
    }

    //假删除企业 1.22 改
    public function stop()
    {
        $id = $this->input->post('id');

        //判断企业下是否含有联系人
        $res = $this->m_contact_total->get_field(FALSE, 't_company_contact', array('company_id' => $id));

        //企业下假删除的数量
        $total = 0;
        if (!empty($res)) {
            //判断该企业下是否有假删除联系人
            foreach ($res as $k => $v) {
                $contactArr[$k] = $this->m_contact_total->get_field(FALSE, 't_contact', array('id' => $v['contact_id'], 'del' => 0));
                if (!empty($contactArr[$k])) {
                    $total += 0;
                } else {
                    $total += 1;
                }
            }
            //该企业下面联系人的总数
            $num = count($contactArr);
            if ($num != $total) {
                echo 'contact';
            } else {
                $this->m_contact_total->stop($id, 't_company');
                echo 'success';
            }
        } elseif ($this->m_contact_total->stop($id, 't_company')) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

//    //查看
    public function check()
    {
        $id = $_POST['id'];
        //该主表id的全部信息
        $data = $this->m_contact_total->get_field($id, 't_company');
        $contact_array = $this->m_contact_total->get_field(FALSE, 't_contact', array('company' => $id));

        $typeArr = $this->m_contact_total->get_field($data['ctype'], 't_company_type');
        $data['tname'] = $typeArr['name'];

        if ($contact_array) {
            foreach ($contact_array as $v) {
                $contact[] = array(
                    'name' => $v['name'],
                    'position' => $v['position']
                );
            }

            $data['contact'] = $contact;
        } else {
            $data['contact'] = '';
        }
        $settleArr = $this->m_contact_total->get_field(FALSE, 't_company_settle', array('company_id' => $id));
        if (isset($settleArr['0'])) {
            foreach ($settleArr as $val) {
                $settle[] = array(
                    'id' => $val['id'],
                    'username' => $val['user_name'],
                    'info' => $val['info']
                );
            }
            $data['settleinfo'] = $settle;
        } else {
            $data['settleinfo'] = '';
        }
      
        $data = $data ? $data : 0;
        echo json_encode($data);
    }

    //编辑
    public function edit()
    {
        $dataArr = $this->m_contact_total->get_field($_POST['mid'], 't_company');
        
        //echo "<script>alert(".var_dump($dataArr).");</script>";
        
        //edittype:修改类型。1为推荐时到企业的修改
        if ($_POST['edittype'] == 1) {
            $logo = $_POST['imgfile1'];
            //如果没有上传图片或者数据库里没有logo
            $cname = $this->db->select('name')->where(array('id' => $_POST['mid']))->get('t_company')->result_array();
            //var_dump($cname);

            if (empty($logo)) {
                echo "<script>alert('请上传企业logo！');location.href='/index.php/company/'</script>";
                exit();
            }
            if($_POST['name']==$cname[0]['name'])
            {
                $data = array(
                    'brief' => $_POST['brief'],
                    'way' => $_POST['way'],
                    'url'=>$_POST['url'],
                    'postcode'=>$_POST['postcode'],
                    'logo' => $_POST['imgfile1'],
                    'pic' => $_POST['info'],
                    'name'=>$_POST['name'],
                    'ctype'=>$_POST['ctype'],
                    'settle' => $_POST['settle'],
                    'address'=> $_POST['address'],
                    'recommend' => 1
                );
            }
            else
            {
                $return=$this->m_contact_total->check_name('t_company',$_POST['name']);
                if($return)
                {
                    echo "<script>alert('企业名称不能重复！');location.href='/index.php/company/check_update/".$_POST['mid']."'</script>";
                    exit();
                }
                else
                {
                    $data = array(
                        'brief' => $_POST['brief'],
                        'way' => $_POST['way'],
                        'url'=>$_POST['url'],
                        'postcode'=>$_POST['postcode'],
                        'logo' => $_POST['imgfile1'],
                        'pic' => $_POST['info'],
                        'name'=>$_POST['name'],
                        'ctype'=>$_POST['ctype'],
                        'settle' => $_POST['settle'],
                        'address'=> $_POST['address'],
                        'recommend' => 1
                    );
                }

            }

        } else {
            $return = $this->m_contact_total->check_same_name('t_company', $_POST['name'],$_POST['mid']);
         if($return){
              echo "<script>alert('企业名称不能重复！');location.href='/index.php/company/check_update/".$_POST['mid']."'</script>";
              exit();
            }
            $data = array(
                'name' => $_POST['name'],
                'ctype' => $_POST['ctype'],
                'brief' => $_POST['brief'],
                'way' => $_POST['way'],
                'url'=>$_POST['url'],
                'postcode'=>$_POST['postcode'],
                'logo' => $_POST['imgfile1'],
                'settle' => $_POST['settle'],
                'address'=> $_POST['address'],
                'pic' => $_POST['info']
            );
        }
        $contactData=array(
            'type_id'=>$data['ctype'],
        );
        $this->load->database();
        $this->db->trans_start();
        $this->m_contact_total->edit($_POST['mid'],'t_company',$data);

        $this->m_contact_total->editContact($_POST['mid'],'t_company_contact',$contactData);
        if ($this->db->trans_status() ===FALSE )
        {
            $this->db->trans_rollback();
            echo "<script>alert('操作失败')</script>";

        }
        else
        {
            $this->db->trans_commit();
            redirect('company');

        }
//        $rel = $this->m_contact_total->edit($_POST['mid'], 't_company', $data);
//        if ($rel) {
//            redirect('company');
//        } else {
//            echo "<script>alert('操作失败')</script>";
//        }
    }

    //第二期：企业批示弹出框 1.27
    public function settleindex()
    {
        //分类id以及企业id
        $tid = $_POST['tid'];
        $id = $_POST['id'];

        //分类名称和企业名称
        $typename = $this->m_contact_total->get_field($tid, 't_company_type');
        $data['typename'] = $typename['name'];
        $companyname = $this->m_contact_total->get_field($id, 't_company');
        $data['companyname'] = $companyname['name'];
        $data['companyid'] = $id;
        echo json_encode($data);
    }

    //第二期：新增企业批示 1.28
    public function settleadd()
    {
        $userid = $this->session->userdata('user_id');
        $username = $this->session->userdata('user_name');

        $data = array(
            'company_id' => $_POST['company_id'],
            'time' => date('Y-m-d', time()),
            'user_id' => $userid,
            'user_name' => $username,
            'info' => $_POST['info']
        );

        $settleid = $this->m_contact_total->add($data, 't_company_settle');

        if ($settleid) {
            redirect('company');
        } else {
            echo "<script>alert('批示失败！')</script>";
        }
    }

    //第二期：删除企业批示 只能自己删除自己的批示 1.28
    public function delsettle()
    {
        $id = $_POST['id'];
        $setArr = $this->m_contact_total->get_field($id, 't_company_settle');
        if ($setArr['user_id'] === $this->session->userdata('user_id')) {
            $rel = $this->m_contact_total->del($id, 't_company_settle');
            if ($rel) {
                echo "success";
            } else {
                echo "false";
            }
        } else {
            echo "no_power";
        }
    }
}