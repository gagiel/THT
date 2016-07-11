<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-26
 * Time: 下午2:04
 */

/*
 * 联系人模块
 * 往来记录管理
 * 连接表名：activity
 */

class M_activity extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get_field($id = FALSE, $t_name, $where = FALSE)
    {
        if ($where) {
            $query = $this->db->get_where($t_name, $where);
            return $query->result_array();
        }
        if ($id === FALSE) {
            $query = $this->db->get($t_name);
            return $query->result_array();
        }
        $query = $this->db->get_where($t_name, array('id' => $id));
        return $query->row_array();
    }

    public function add_field($stockStr)
    {
        $data = array(
            'cdate' => date('Y-m-d H:i:s', time()),
            'ctype' => $this->input->post('ctype'),
            'contact' => $this->input->post('contact'),
            'stockname' => $stockStr,
            'user' => $this->input->post('user'),
            'info' => $this->input->post('info'),
            'remark1' => $this->input->post('remark1'),
        );

        $res = $this->db->insert('t_activity', $data);
        return $newid = $this->db->insert_id($res);
    }

    public function del_field($id)
    {
        return $this->db->where('id', $id)->delete('t_activity');
    }

    public function edit_field($id)
    {
        $data = array(
            'ctype' => $this->input->post('ctype'),
            'contact' => $this->input->post('contact'),
            'user' => $this->input->post('user'),
            'info' => $this->input->post('info'),
            'remark1' => $this->input->post('remark1'),
        );

        return $this->db->where('id', $id)->update('t_activity', $data);
    }


    /*
     * 获得名片主人和企业名称
     */

    public function model_list($tablename, $id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get($tablename);
            return $query->result_array();
        }

        $query = $this->db->where('id', $id)->get($tablename);
        return $query->result_array();
    }
}