<?php
class M_plan_templet extends CI_Model {

	var $table_name = 't_plan_templet';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * plan_templet_insert	新增模板
	 * @param 	$data	array
	 * @return	int
	 */
	function plan_templet_insert($data)
	{
		$this->db->trans_start();
		
		$sql = 'update '.$this->table_name.' set mark=mark+1';
		$this->db->query($sql);
		
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
	 * plan_templet_update	修改模板
	 * @param $id int 模板ID
	 * @param $data array
	 * @param $mark int	修改前的排序
	 * @return float
	 */
	function plan_templet_update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * plan_templet_delete	删除模板
	 * @param $id int 模板ID
	 * @return float
	 */
	function plan_templet_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * plan_templet_list	模板列表
	 */
	function plan_templet_list()
	{
		$this->db->select('*');
		$this->db->order_by('id','asc');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
	
	/**
	 * plan_templet_get	获取指定模板信息
	 */
	function plan_templet_get($where)
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
	 * plan_templet_hash	模板hash表
	 */
	function plan_templet_hash()
	{
		$data = $this->plan_templet_list();
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