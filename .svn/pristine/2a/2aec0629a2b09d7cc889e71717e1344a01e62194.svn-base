<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 联系人模块
 * 分类管理
 * 数据库连接：t_company_type
 */
class Company_type extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //权限判断
        $this->load->library('session');
        $this->load->library('login');
        $this->login->check_login($this->session->userdata('user_id'));
        $this->login->check_jurisdict('2', $this->session->userdata('user_jurisdict'));

        $this->load->model('m_company_type');
        $this->load->model('m_company');
        $this->load->model('m_contact_total');

        $this->load->helper('tree');
    }


    public function index()
    {

        $dataArr = $this->m_company_type->get_field();

        $this->db->order_by('detail', 'asc');
        $fieldArr = $this->m_company_type->get_field();


        //组装分类的上级分类的名称
        foreach ($dataArr as $k => $v) {
            if ($v['parent'] == 0) {
                $dataArr[$k]['parentname'] = '无上级分类';
            } else {
                $parent = $this->m_company_type->get_field($v['parent']);
                $dataArr[$k]['parentname'] = $parent['name'];
            }
        }

        if (is_array($dataArr)) {
            //定义目标数组
            $tree = array();
            //定义索引数组，用于记录节点在目标数组的位置
            $ind = array();

            foreach ($dataArr as $val) {
                $v = array(
                    'self' => $val,
                    'child' => array(), //给每个节点附加一个child项
                );
                if ($val['parent'] == 0) {
                    $i = count($tree);
                    $tree[$i] = $v;
                    $ind[$val['id']] = & $tree[$i];
                } else {
                    $i = count($ind[$val['parent']]['child']);
                    $ind[$val['parent']]['child'][$i] = $v;
                    $ind[$val['id']] = & $ind[$val['parent']]['child'][$i];
                }
            }


            $data['tree'] = type_check($tree);
        }


        $data['name'] = $fieldArr;

        $this->load->helper('select');
        $data['select'] = type_select();

        $this->load->view('main_header');
        $this->load->view('main_menu', array('menu' => 'concact'));
        $this->load->view('company_type/index', $data);
        $this->load->view('main_footer');
    }

    //增加分类
    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');

        $return = $this->m_contact_total->check_name('t_company_type', $_POST['name']);
        if ($return) {
            echo "<script>alert('分类名称不能重复！');location.href='company_type'</script>";
        } else {
            if ($this->form_validation->run() === FALSE) {
                echo "<script>alert('操作失败')</script>";

            } else {
                $rel = $this->m_company_type->add_field();
                redirect('company_type?parent=' . $rel . '');
            }
        }
    }

    public function addname()
    {
        $id = $_POST['id'];
        $rel = $this->m_contact_total->get_field($id, 't_company_type');
        $data['name'] = $rel['name'];
        $data['id'] = $rel['id'];

        echo json_encode($data);
    }

    //修改时显示内容
    public function check()
    {
        $id = $_POST['id'];
        $data = $this->m_company_type->get_field($id);

        if ($data['parent'] == 0) {
            $data['parentname'] = '无上级分类';
        } else {
            $parent = $this->m_company_type->get_field($data['parent']);
            $data['parentname'] = $parent['name'];
        }

        echo json_encode($data);
    }

    //删除分类
    public function del()
    {
        $id = $this->input->post('id');
        //分类下有子分类
        $childdata = $this->m_company_type->get_field('', array('parent' => $id));

        //分类下有企业
        $data = $this->m_company->get_field('', '', array('ctype' => $id));

        if (!empty($data)) {
            echo '该分类下有企业，删除失败！';
        } elseif (!empty($childdata)) {
            echo '该分类下有子分类，删除失败！';
        } else {
            $res = $this->m_company_type->del_field($id);

            if ($res) {
                echo 'success';
            } else {
                echo 'false';
            }
        }
    }

    //修改分类
    public function edit()
    {
        if ($this->m_company_type->edit_field()) {
            redirect('company_type');
        } else {
            echo '操作失败';
        }
    }

    //停用分类
    public function stop()
    {
        $id = $this->input->post('id');
        $data = $this->m_company_type->get_field($id);
        $status = $data['status'];
        $res = $this->m_company_type->stop_field($id, $status);

        if ($res) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    /*
     * 排序-向上
     */
    public function markup()
    {
        $id = $_POST['id'];
        $data = $this->m_contact_total->get_field($id, 't_company_type');
        //找到同级的排序
        $this->db->order_by('mark', 'asc');
        $parentArr = $this->m_contact_total->get_field(FALSE, 't_company_type', array('parent' => $data['parent']));
        foreach ($parentArr as $k => $v) {
            $arr[$k] = array(
                'id' => $v['id'],
                'mark' => $v['mark']
            );
        }
        $key = array_search(array('id' => $id, 'mark' => $data['mark']), $arr);

        if (isset($arr[$key - 1])) {
            $pre = $arr[$key - 1]['mark'];
            $prekey = $arr[$key - 1]['id'];

            $this->m_contact_total->edit($prekey, 't_company_type', array('mark' => $data['mark']));
            $res = $this->m_contact_total->edit($id, 't_company_type', array('mark' => $pre));

            $detail = $data['detail'];
            if ($res) {
                echo 'success' . '/' . $detail;
            } else {
                echo '操作错误';
            }
        } else {
            echo '已经是最上面一个了！';
        }
    }


    /*
     * 排序-向下
     */
    public function markdown()
    {
        $id = $_POST['id'];
        $data = $this->m_contact_total->get_field($id, 't_company_type');
        //找到同级的排序
        $this->db->order_by('mark', 'asc');
        $parentArr = $this->m_contact_total->get_field(FALSE, 't_company_type', array('parent' => $data['parent']));
        foreach ($parentArr as $k => $v) {
            $arr[$k] = array(
                'id' => $v['id'],
                'mark' => $v['mark']
            );
        }
        $key = array_search(array('id' => $id, 'mark' => $data['mark']), $arr);

        if (isset($arr[$key + 1])) {
            $next = $arr[$key + 1]['mark'];
            $nextkey = $arr[$key + 1]['id'];

            $this->m_contact_total->edit($nextkey, 't_company_type', array('mark' => $data['mark']));
            $res = $this->m_contact_total->edit($id, 't_company_type', array('mark' => $next));

            $detail = $data['detail'];
            if ($res) {
                echo 'success' . '/' . $detail;
            } else {
                echo 'false';
            }
        } else {
            echo '已经是最后一个了！';
        }

    }


}