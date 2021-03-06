<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 企业信息变更管理
 */
class edit_company_info extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //权限判断
        $this->load->library('session');
        $this->load->library('login');
        $this->login->check_login($this->session->userdata('user_id'));


        $this->load->model('m_contact_total');
        $this->load->helper(array('form', 'url'));
    }


    public function index($page = '1', $pageSize = '20')
    {
        $this->login->check_jurisdict('13', $this->session->userdata('user_jurisdict'));
        $where = array();
        //首页模糊查询
        if (!empty($_POST)) {
            //模糊查询
            $where['state'] = $_POST['state'];
            if ($_POST['companyid'] != '') {
                $where['company_id'] = $_POST['companyid'];
            }
        }

        //---------分页------------
        $num = $this->m_contact_total->get_num($where, FALSE, 't_apply_company_info');
        $pages = ceil($num / $pageSize);
        if ($page > $pages) $page = $pages;
        if ($page < 1) $page = 1;

        $this->load->library('pagination');

        $config['base_url'] = '/index.php/edit_company_info/index/';
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

        $data['data'] = $this->m_contact_total->get_field(FALSE, 't_apply_company_info', $where);
        foreach ($data['data'] as $k => $v) {
            $typeArr = $this->m_contact_total->get_field($v['type_id'], 't_company_type');
            $companyArr = $this->m_contact_total->get_field($v['company_id'], 't_company');
            $companyUserArr = $this->m_contact_total->get_field($v['proposer_id'], 't_company_account');

            $data['data'][$k]['typename'] = $typeArr['name'];
            $data['data'][$k]['companyname'] = $companyArr['name'];
            $data['data'][$k]['Applyname'] = $companyUserArr['account'];
        }


        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'company'));
        $this->load->view('edit_company_info/index', $data);
        $this->load->view('main_footer');
    }

    public function admin_review($id)
    {
        $this->login->check_jurisdict('13', $this->session->userdata('user_jurisdict'));
        $data['mid'] = $id;

        $infoArr = $this->m_contact_total->get_field($id, 't_apply_company_info');
        $data['state'] = $infoArr['state'];

        $Old = $this->m_contact_total->get_field($infoArr['company_id'], 't_company');
        $OldType = $this->m_contact_total->get_field($Old['ctype'], 't_company_type');
        $Old['typename'] = $OldType['name'];

        $New = $this->m_contact_total->get_field($infoArr['company_id'], 't_company_temporary');
        $NewType = $this->m_contact_total->get_field($New['ctype'], 't_company_type');
        $New['typename'] = $NewType['name'];

        $Total = array(
            'old' => $Old,
            'new' => $New
        );

        $data['data'] = $Total;

        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('edit_company_info/admin_review', $data);
        $this->load->view('main_footer');
    }

    public function user_submit($companyid)
    {
        $data = $this->m_contact_total->get_field($companyid, 't_company');
        //分类的循环
        $this->db->order_by('detail', 'asc');
        $data['typename'] = $this->m_contact_total->get_field(FALSE, 't_company_type');

        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('edit_company_info/user_submit', $data);
        $this->load->view('main_footer');
    }

    public function editInfo()
    {
        $logo = $this->m_contact_total->upload_picture('logo');
        $logo = isset($logo) ? $logo : $_POST['oldlogo'];
        $comData = array(
            'name' => $_POST['name'],
            'ctype' => $_POST['type'],
            'brief' => $_POST['brief'],
            'address' => $_POST['address'],
            'logo' => $logo,
            'pic' => $_POST['info'],
            'way' => $_POST['way']
        );
        $rel = $this->m_contact_total->get_field($_POST['mid'], 't_company_temporary');
        if (empty($rel)) {
            $comData['id'] = $_POST['mid'];
            $res = $this->m_contact_total->add($comData, 't_company_temporary');
        } else {
            $res = $this->m_contact_total->edit($_POST['mid'], 't_company_temporary', $comData);
        }

        $infoData = array(
            'type_id' => $_POST['type'],
            'company_id' => $_POST['mid'],
            'proposer_id' => $this->session->userdata('user_id'),
            'apply_time' => date('Y-m-d', time()),
            'state' => '0'
        );
        $infoId = $this->m_contact_total->add($infoData, 't_apply_company_info');

        if ($infoId) {
            redirect('contact');
        } else {
            echo "<script>alert('操作失败')</script>";
        }
    }

    public function check($state, $id)
    {
        $this->login->check_jurisdict('13', $this->session->userdata('user_jurisdict'));
        $info = $this->m_contact_total->get_field($id, 't_apply_company_info');
        $realState = $info['state'];

        if ($realState == '0') {
            if ($state == '1') {
                $data = array('state' => 1);
                $rel = $this->m_contact_total->edit($id, 't_apply_company_info', $data);

                $newInfo = $this->m_contact_total->get_field($id, 't_company_temporary');
                $res = $this->m_contact_total->edit($id, 't_company', $newInfo);

                if ($res) {
                    redirect('edit_company_info');
                } else {
                    echo "<script>alert('操作失败')</script>";
                }
            } else {
                $data = array('state' => 2);
                $rel = $this->m_contact_total->edit($id, 't_apply_company_info', $data);
                if ($rel) {
                    redirect('edit_company_info');
                } else {
                    echo "<script>alert('操作失败')</script>";
                }
            }
        } else {
            echo "<script>alert('该条信息已经经过审核！操作失败！');location.href='/index.php/edit_company_info'</script>";
        }
    }
}