<?php
class M_plan_ready extends CI_Model {

	var $table_name = 't_plan_ready';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * plan_ready_insert	新增准备
	 * @param 	$data	array
	 * @return	int
	 */
	function plan_ready_insert($data)
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
	 * plan_ready_update	修改准备
	 * @param $id int 准备ID
	 * @param $data array
	 * @param $mark int	修改前的排序
	 * @return float
	 */
	function plan_ready_update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * plan_ready_delete	删除准备
	 * @param $id int 准备ID
	 * @return float
	 */
	function plan_ready_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * plan_ready_delete_by_planid	删除准备
	 * @param $plan_id int  方案ID
	 * @return float
	 */
	function plan_ready_delete_by_planid($idArray)
	{
		$this->db->where_in('plan_id',$idArray);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * plan_ready_list	准备列表
	 */
	function plan_ready_list($where)
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
	 * plan_ready_get	获取指定准备信息
	 */
	function plan_ready_get($where)
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
	 * plan_ready_hash	准备hash表
	 */
	function plan_ready_hash()
	{
		$data = $this->plan_ready_list();
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