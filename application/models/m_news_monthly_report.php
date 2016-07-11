<?php
class M_news_monthly_report extends CI_Model {

	var $table_name = 't_news_monthly_report';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * report_insert	新增月报
	 * @param 	$data	array
	 * @return	int
	 */
	function report_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * report_update	修改月报
	 * @param $month string 月份
	 * @param $data array
	 * @return float
	 */
	function report_update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * report_delete	删除月报
	 * @param $id int 月报ID
	 * @return float
	 */
	function report_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * report_info	月报内容
	 */
	function report_info($month)
	{
		$this->db->select('*');
		$this->db->where('month',$month);
		$re = $this->db->get($this->table_name);
		$data = $re->result();
		if($re->num_rows>0)
		{
			return $data[0];
		}
		else
		{
			return array();
		}
	}
}
?>