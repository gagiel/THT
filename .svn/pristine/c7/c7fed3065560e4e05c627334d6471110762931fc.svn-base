<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-29
 * Time: 下午12:52
 */

class M_stock extends CI_Model
{
	var $table_name		= 't_stock';
	var $table_storage	= 't_storage';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * stock_num	获取物品数量
	 */
	function stock_num($where)
	{
		$this->db->select('*');
		
		$this->db->where('del','0');
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * stock_list	物品列表
	 */
	function stock_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		$this->db->where('del','0');
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
		}
		$this->db->order_by('id','asc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}
	
	/**
	 * 新增物品入库
	 */
    function stock_add($data)
    {
    	$this->db->trans_start();
    	
    	$time = $data['time'];
    	unset($data['time']);
    	
    	if($this->db->insert($this->table_name,$data))
    	{
    		//物品ID
    		$id = $this->db->insert_id();
    		
    		$s_data = array(
    			'stype'		=> '1',
    			'stock'		=> $id,
    			'stock_num'	=> $data['num'],
    			's_time'	=> $time,
    		);
    		
    		$this->db->insert($this->table_storage,$s_data);
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
     * 修改物品信息
     */
    function stock_edit($id,$data)
    {
    	$this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }
    /**
     * 删除物品
     */
    function stock_delete($id)
    {
    	$this->db->where('id', $id);
        return $this->db->update($this->table_name, array('del'=>'1'));
    }
    /**
     * 获取物品信息
     */
    function stock_get($id)
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
    /**
     * 物品出入库
     */
    function stock_storage($data,$num)
    {
    	$this->db->trans_start();
    	
        $this->db->insert($this->table_storage, $data);
        
        $this->db->where('id',$data['stock']);
        $this->db->update($this->table_name, array('num'=>$num));
        
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
    function storage_num($id)
    {
    	
		$this->db->select('*');
		
		$this->db->where('stock',$id);
		
		$re = $this->db->get($this->table_storage);
		
		return $re->num_rows();
    }
    function storage_list($id,$type,$starttime,$endtime,$start='0',$pageSize='0')
    {
    	
		$this->db->select('*');
		
		$this->db->where('stock',$id);
		if($type){
			$this->db->where('stype',$type);
		}
		if($starttime)
		{
			$this->db->where('s_time >=',$starttime);
		}
    	if($endtime)
		{
			$this->db->where('s_time <=',$endtime.' 23:59:59');
		}
		$this->db->order_by('s_time','desc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_storage);
		
		return $re->result();
    }
}