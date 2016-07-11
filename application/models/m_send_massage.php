<?php
class M_send_massage extends CI_Model {

    var $table_name = 't_send_massage';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * massage_insert	新增群发短信记录
     * @param 	$data	array
     * @return	int
     */
    function massage_insert($data)
    {
        $data['is_web']='1';
        return $this->db->insert($this->table_name,$data);
    }

    /**
     * user_update	修改多条信息
     * @param $id int 人员ID
     * @param $data array
     * @return float
     */
    function massage_update($id,$data)
    {
        $data['is_web']='1';
        $this->db->where_in('id',$id);
        return $this->db->update($this->table_name,$data);
    }
    /**
     * 按时间导出	活动方案列表
     */
    function massage_list_dao($where)
    {
        $this->db->select('*');
        if(isset($where['start']) && $where['start']!='')
        {
            $this->db->where('start >=',$where['start'].' 00:00:00');
        }
        if(isset($where['end']) && $where['end']!='')
        {
            $this->db->where('start <=',$where['end'].' 23:59:59');
        }
        $this->db->where('is_del',0);
        $re = $this->db->get($this->table_name);
        return $re->result();
    }

    /**
     * user_delete	删除人员
     * @param $id int 人员ID
     * @return float
     */
    function user_delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table_name,array('del'=>'1'));
    }

    /**
     * massage_num		短信数量
     */
    function massage_num($where) {
        $this->db->select('*');
        $this->db->where('is_del','0');
//        if(isset($where['name']) && $where['name']!='')
//        {
//            $this->db->like('name',$where['name']);
//        }
//        if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
//        {
//            $this->db->where('department',$where['department']);
//        }
        $re = $this->db->get($this->table_name);

        return $re->num_rows();
    }

    /**
     * massage_list	信息列表
     */
    function massage_list($where=array(),$start='0',$pageSize='0')
    {
        $this->db->select('*');
        $this->db->where('is_del','0');
//        if(isset($where['name']) && $where['name']!='')
//        {
//            $this->db->like('name',$where['name']);
//        }
//        if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
//        {
//            $this->db->where('department',$where['department']);
//        }

//        if($pageSize>0)
//        {
//            $this->db->limit($pageSize,$start);
//        }
        $this->db->order_by1('id','asc');
        $re = $this->db->get($this->table_name);
        //echo $this->db->last_query();
        return $re->result_array();
    }

    /**
     * massage_get	获取单条群发信息
     */
    function massage_get($where)
    {
        $this->db->select('*');
        if(is_array($where))
        {
            foreach($where as $key => $val)
            {
                $this->db->where($key,$val);
            }
        }
        $re = $this->db->get($this->table_name);
        //echo $this->db->last_query();

        if($re->num_rows=='0')
        {
            return false;
        }
        else
        {
            $data = $re->result_array();
            return $data[0];
        }
    }
    /**
     * user_get_r	获取指定人员信息
     */
    function user_get_r($where_in){
        $this->db->select('*');
        $where_id=explode(",",$where_in['u_id']);

        if(is_array($where_in))
        {
            $this->db->where_in('id',$where_id);
        }
        $re = $this->db->get($this->table_name);
        if($re->num_rows=='0')
        {
            return false;
        }
        else
        {
            $data = $re->result_array();
            return $data;
        }

    }

}
?>