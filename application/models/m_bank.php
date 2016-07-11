<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-29
 * Time: 下午12:52
 */

class M_bank extends CI_Model
{
	var $table_name		= 't_bank';
	var $table_credit   = 't_bank_credit';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * bank_num 获取银行数量
	 */
	function bank_num($where)
	{
		$this->db->select('*');
		
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * bank_list 银行列表
	 */
	function bank_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
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
	 * 新增银行
	 */
    function bank_add($data,$creditData)
    {
    	$this->db->trans_start();
    	$this->db->insert($this->table_name,$data);
    	$id = $this->db->insert_id();
    	if(!empty($creditData)){
    		foreach($creditData as $key=>$value){
    			$creditData[$key]['bank_id'] = $id;
    		}
    		$this->db->insert_batch($this->table_credit,$creditData);
    	}
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
     * 修改银行
     */
    function bank_edit($id,$data,$creditData)
    {
    	$this->db->trans_start();
    	$this->db->where('id', $id);
        $status = $this->db->update($this->table_name, $data);
        $this->db->where('bank_id',$id);
        $this->db->delete($this->table_credit);
        if(!empty($creditData)){
        	$in_status = $this->db->insert_batch($this->table_credit,$creditData);
        }
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
     * 删除银行
     */
    function bank_delete($idArr)
    {
        $this->db->where_in('bank_id',$idArr);
        $this->db->delete($this->table_credit);
        $this->db->where_in('id',$idArr);
        return $this->db->delete($this->table_name);
    }
    /**
     * 获取银行
     */
    function bank_get($id)
    {
    	$this->db->where('id',$id);
    	$re = $this->db->get($this->table_name);
    	$this->db->where('bank_id',$id);
    	$this->db->order_by1('mark,id','asc');
    	$credit = $this->db->get($this->table_credit);
    	$extData = $credit->result_array();
    	$info = array();
    	if($re->num_rows()>0)
    	{
    		$info = $re->result_array();
    		$info = $info[0];
    		$info['credit'] = $extData;
    	}
    	//var_dump($info);
    	return $info;
    }
  
}