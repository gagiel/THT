<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-29
 * Time: 下午12:52
 */

class M_event extends CI_Model
{
	var $table_name		= 't_event';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * event_num 获取事记数量
	 */
	function event_num($where)
	{
		$this->db->select('*');
		
		if(isset($where['title']) && $where['title']!='')
		{
			$this->db->like('title',$where['title']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			
			$this->db->where('time >=',strtotime($where['start']));
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('time <=',strtotime($where['end']));
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * event_list 事记列表
	 */
	function event_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['title']) && $where['title']!='')
		{
			$this->db->like('title',$where['title']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			
			$this->db->where('time >=',strtotime($where['start']));
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('time <=',strtotime($where['end']));
		}
		$this->db->order_by('time','desc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}
	
	/**
	 * 新增大事记
	 */
    function event_add($data)
    {
    	$this->db->trans_start();
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
     * 修改大事记信息
     */
    function event_edit($id,$data)
    {
    	$this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }
    /**
     * 删除大事记
     */
    function event_delete($idArr)
    {
    	$this->db->where_in('id',$idArr);
        return $this->db->delete($this->table_name);
    }
    /**
     * 获取大事记信息
     */
    function event_get($id)
    {
    	$this->db->where('id',$id);
    	$re = $this->db->get($this->table_name);
    	$info = array();
    	if($re->num_rows()>0)
    	{
    		$info = $re->result_array();
    		$info = $info[0];
    	}
    	return $info;
    }
  
}