<?php
/**
 * Created by yuz.
 * User: 于政
 * Date: 2016/7/7
 * Time: 16:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class register extends CI_Controller{
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_user');

    }
    /**
     * 获取post信息验证并保存
     **/
    public function save(){
        $data = array(
            'account'		=> $this->input->post('account'),
            'password'		=> md5($this->input->post('password')),
            'name'			=> $this->input->post('name'),
            'department'	=> $this->input->post('department'),
            'phone'			=> $this->input->post('phone'),
            'def_send'		=> 0,
            'reviewed'      => 0,
            'register_type' => 1,
        );
        $i=$this->checkAccount($this->input->post('account'));
        if($i){
            if($this->m_user->user_insert($data))
            {
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo 3;
        }

    }
    /**
     * 检查账号是否已经存在
     */
    public function checkAccount($account){
        $result = $this->m_user->user_get(array('account'=>$account));
        if($result){
            return false;
        }else{
            return true;
        }

    }

    /**
     * 自行注册人员列表
     *
     **/
    public function register_list($page='1',$pageSize='20'){
        $this->load->library('session');
        $this->load->library('login');
        $this->login->check_login($this->session->userdata('user_id'));
        $this->load->helper('url');
        $this->load->helper('tree');
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
    
}
