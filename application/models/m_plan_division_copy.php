<?php
class M_plan_division_copy extends CI_Model {

    var $table_name = 't_plan_division_copy';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * plan_annex_insert	新增准备
     * @param 	$data	array
     * @return	int
     */
    function plan_division_insert($data)
    {
        $this->db->trans_start();

        //$sql = 'update '.$this->table_name.' set mark=mark+1';
        //$this->db->query($sql);

        $this->db->insert($this->table_name,$data);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * plan_annex_update	修改准备
     * @param $id int 准备ID
     * @param $data array
     * @param $mark int	修改前的排序
     * @return float
     */
    function plan_division_update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table_name,$data);
    }

    /**
     * plan_annex_delete	删除准备
     * @param $id int 准备ID
     * @return float
     */
    function plan_division_delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_name);
    }

    /**
     * plan_division_delete_by_planid	删除准备
     * @param $plan_id int  方案ID
     * @return float
     */
    function plan_division_delete_by_planid($plan_id)
    {
        $this->db->where('plan_id',$plan_id);
        return $this->db->delete($this->table_name);
    }
    /**
     * plan_annex_list	准备列表
     */
    function plan_division_list($where)
    {
        $this->db->select('*');
        if(is_array($where))
        {
            foreach($where as $key => $val)
            {
                $this->db->where($key,$val);
            }
        }
        $this->db->order_by('id','asc');
        $re = $this->db->get($this->table_name);
        return $re->result();
    }

    /**
     * plan_annex_get	获取指定准备信息
     */
    function plan_division_get($where)
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
        $data = $re->result();
        return $data[0];
    }

    /**
     * plan_annex_hash	准备hash表
     */
    function plan_division_hash()
    {
        $data = $this->plan_annex_list();
        $arr = array();
        if(is_array($data))
        {
            foreach($data as $v)
            {
                $arr[$v->id] = $v->name;
            }
        }
        return $arr;
    }
}
?>
