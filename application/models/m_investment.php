<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-29
 * Time: 下午12:52
 */

class M_investment extends CI_Model
{
	var $table_name		= 't_investment';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * investment_num 获取投资意向数量
	 */
	function investment_num($where)
	{
		$this->db->select('*');
		
		if(isset($where['industry']) && $where['industry']!='')
		{
			$this->db->like('industry',$where['industry']);
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * investment_list 投资意向列表
	 */
	function investment_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['industry']) && $where['industry']!='')
		{
			$this->db->like('industry',$where['industry']);
		}
		$this->db->order_by1('mark,id','asc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}
	
	/**
	 * 新增投资意向
	 */
    function investment_add($data)
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
     * 修改投资意向
     */
    function investment_edit($id,$data)
    {
    	$this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }
    /**
     * 删除投资意向
     */
    function investment_delete($idArr)
    {
    	$this->db->where_in('id',$idArr);
        return $this->db->delete($this->table_name);
    }
    /**
     * 获取投资意向
     */
    function investment_get($id)
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