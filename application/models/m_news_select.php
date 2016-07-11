<?php
class M_news_select extends CI_Model {

	var $table_name = 'v_news_select';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function news_num($value)
	{
		$this->db->select('*');
		$this->db->like('info',$value);
		$this->db->or_like('tname',$value);
		if(strtotime($value)||intval($value))
		{
			$this->db->or_like('ndate',$value);
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * 首页查询
	 */
	function news_select($value,$start,$pageSize)
	{
		$this->db->select('*');
		$this->db->like('info',$value);
		$this->db->or_like('tname',$value);
		if(strtotime($value)||intval($value))
		{
			$this->db->or_like('ndate',$value);
		}
		$this->db->order_by('ndate','desc');
		
		$this->db->limit($pageSize,$start);
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}
}
?>