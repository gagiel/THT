<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 企业账号管理
 * 数据库连接：t_account
 */
class account extends CI_Controller
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
            if (!empty($_POST['like_account'])) {
                $this->db->like('account', $_POST['like_account'], 'both');
            }
            if ($_POST['companyid'] != '') {
                $where['company_id'] = $_POST['companyid'];
            }
        }

        //---------分页------------
        $num = $this->m_contact_total->get_num($where, $like, 't_company_account');
        $pages = ceil($num / $pageSize);
        if ($page > $pages) $page = $pages;
        if ($page < 1) $page = 1;

        $this->load->library('pagination');

        $config['base_url'] = '/index.php/account/index/';
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

        $account = $this->m_contact_total->get_field(FALSE, 't_company_account', $where, $like);
        //var_dump($account);
        foreach ($account as $k => $v) {
            $companyArr = $this->m_contact_total->get_field($v['company_id'], 't_company');
            $account[$k]['company_name'] = $companyArr['name'];
            $typeArr = $this->m_contact_total->get_field($v['type_id'], 't_company_type');
            $account[$k]['type_name'] = $typeArr['name'];
        }

        $data['name'] = $account;

        $company = $this->m_contact_total->get_field(FALSE, 't_company');
        $data['company'] = $company;

        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'company'));
        $this->load->view('account/index', $data);
        $this->load->view('main_footer');
    }

    public function add()
    {
        if (isset($_POST)) {
            $data = array(
                'account' => $_POST['account'],
                //如果没有填  就是111111
                'password' => isset($_POST['password']) ? md5($_POST['password']) : '96e79218965eb72c92a549dd5a330112',
                'company_id' => $_POST['companyid'],
                'type_id' => $_POST['typeid'],
                'add_time' => date('Y-m-d', time())
            );
            $res = $this->m_contact_total->add($data, 't_company_account');
            if ($res) {
                redirect('account');
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        }
    }

    /*
     * ajax回调企业名称
     */
    public function get_companyname()
    {
        $name = $_POST['name'];
        $where = array();
        if (isset($name)) {
            $like = array(
                'key' => 'name',
                'match' => $name
            );
            $companyArr = $this->m_contact_total->get_field(FALSE, 't_company', $where, $like);

            foreach ($companyArr as $k => $v) {
                $data[$k]['id'] = $v['id'];
                $data[$k]['name'] = $v['name'];
                $data[$k]['type'] = $v['ctype'];
            }
        }

        echo json_encode($data);
    }


    public function del()
    {
        $id = $_POST['id'];
        $res = $this->m_contact_total->del($id, 't_company_account');
        if ($res) {
            echo "success";
        } else {
            echo "false";
        }
    }

    public function editInfo()
    {
        $id = $_POST['id'];
        $data = $this->m_contact_total->get_field($id, 't_company_account');
        $companyArr = $this->m_contact_total->get_field($data['company_id'], 't_company');
        $data['company_name'] = $companyArr['name'];
        echo json_encode($data);
    }


    public function edit()
    {
        if (isset($_POST['mid'])) {
            $data = array(
                'account' => $_POST['account'],
                'company_id' => $_POST['companyid'],
                'type_id' => $_POST['typeid']
            );

            $res = $this->m_contact_total->edit($_POST['mid'], 't_company_account', $data);

            if ($res) {
                redirect('account');
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        }
    }


}