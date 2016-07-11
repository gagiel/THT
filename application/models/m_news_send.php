<?php
class M_news_send extends CI_Model {

	var $table_name = 't_news_send';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * news_send_insert	新增推送记录
	 * @param 	$data	array
	 * @return	int
	 */
	function news_send_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * news_send_delete	删除推送记录
	 * @param $id int 推送记录ID
	 * @return float
	 */
	function news_send_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * news_send_list	推送记录列表
	 */
	function news_send_list()
	{
		$this->db->select('*');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
}
?>