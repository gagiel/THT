<?php
class M_department extends CI_Model {

	var $table_name = 't_department';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * department_insert	新增部门
	 * @param 	$data	array
	 * @return	int
	 */
	function department_insert($data)
	{
		$this->db->trans_start();
		
		$sql = 'update '.$this->table_name.' set mark=mark+1 where mark>='.$data['mark'];
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
	 * department_update	修改部门
	 * @param $id int 部门ID
	 * @param $data array
	 * @param $mark int	修改前的排序
	 * @return float
	 */
	function department_update($id,$data,$mark)
	{
		$this->db->trans_start();
		if($mark>$data['mark'])
		{
			$sql = 'update '.$this->table_name.' set mark=mark+1 where mark>='.$data['mark'].' and mark<'.$mark;
			$this->db->query($sql);
		}
		if($mark<$data['mark'])
		{
			$sql = 'update '.$this->table_name.' set mark=mark-1 where mark<='.$data['mark'].' and mark>'.$mark;
			$this->db->query($sql);
		}
		$this->db->where('id',$id);
		$this->db->update($this->table_name,$data);	
		
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
	 * 
	 * 更新部门信息
	 * @param  $id int 
	 * @param  $data array
	 */
	function department_updt($id,$data){
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * department_delete	删除部门
	 * @param $id int 部门ID
	 * @return float
	 */
	function department_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * department_list	部门列表
	 */
	function department_list()
	{
		$this->db->select('*');
		$this->db->order_by1('mark','asc');
		$re = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $re->result();
	}
	
	/**
	 * department_get	获取指定部门信息
	 */
	function department_get($where)
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
		if($data){
			return $data[0];
		}
		return $data;
	}
	
	/**
	 * department_hash	部门hash表
	 */
	function department_hash()
	{
		$data = $this->department_list();
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