<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-05-18
 * Time: 下午2:04
 */

/*
 * 联系人模块
 * 企业管理
 * 连接表名：t_sender_other
 */

class M_news_other extends CI_Model
{
	var $table_name = 't_sender_other';
	
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
   
   /*
    * 获取当天信息列表
    */
   public function  get_nowlist(){
     $time=date("Y-m-d",time());
     $starttime=strtotime($time." 00:00:00");
     $endtime=strtotime($time." 23:59:59");
     $where="(addtime>=".$starttime.") AND (addtime<".$endtime.")";
     $this->db->select('id, title,author,show_cover_pic,digest,addtime'); 
     $this->db->from($this->table_name); 
     $this->db->where($where);   
     $query = $this->db->get();
      return $query->result_array();
      
   }
   /*
    * 删除数据
    */
     public function del($id,$where = FALSE)
    {
        if ($where) {
            return $this->db->where($where)->delete($this->table_name);
        } else {
            return $this->db->where('id', $id)->delete($this->table_name);
        }

    }
    /*
     * 修改数据
     */
      public function edit($id,$data)
    {
        return $this->db->where('id', $id)->update($this->table_name, $data);
    }
    /*
     * 添加数据
     */
      public function add($data)
    {
        $res = $this->db->insert($this->table_name, $data);
        return $id = $this->db->insert_id($res);
    }
    
    /*
     * 搜索数据
     */
     public function get_field($id = FALSE,$where = FALSE, $like = FALSE)
    {
        if ($where) {
            if ($like) {
                $this->db->like($like['key'], $like['match'], 'both');
            }
            $query = $this->db->get_where($this->table_name, $where);
            return $query->result_array();
        }
        if (!$where && $like) {
            $this->db->like($like['key'], $like['match'], 'both');
            $query = $this->db->get_where($this->table_name);
            return $query->result_array();
        }

        if ($id === FALSE) {
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        }

        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row_array();
    }
  
}
