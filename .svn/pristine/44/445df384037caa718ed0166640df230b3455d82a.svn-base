<?php
class M_news_comment extends CI_Model {

	var $table_name = 't_news_comment';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * news_comment_insert	新增领导点评
	 * @param 	$data	array
	 * @return	float
	 */
	function news_comment_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * news_comment_update	修改领导点评
	 * @param $date
	 * @param $user
	 * @param $data array
	 * @return float
	 */
	function news_comment_update($date,$user,$data)
	{
		$this->db->where('ndate',$date);
		$this->db->where('userid',$user);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * news_comment_delete	删除领导点评
	 * @param $date str 点评日期
	 * @param $userid int 点评人ID
	 * @return float
	 */
	function news_comment_delete($date,$userid)
	{
		$this->db->where('ndate',$date);
		$this->db->where('userid',$userid);
		return $this->db->delete($this->table_name);
	}
	/**
	 * news_comment_del	删除领导点评
	 * @param $id int 点评ID
	 * @return float
	 */
	function news_comment_del($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * news_comment_list	获取指定日期的领导点评记录
	 */
	function news_comment_list($date)
	{
		$this->db->select('t_news_comment.id,t_news_comment.userid,t_user.name,t_news_comment.info,t_news_comment.addtime');
		$this->db->where('t_news_comment.ndate',$date);
		$this->db->join('t_user','t_user.id='.$this->table_name.'.userid','LEFT');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
	
	function news_comment_get($date,$userid=0)
	{
		$this->db->select('*');
		$this->db->where('ndate',$date);
		if($userid>0)
		{
			$this->db->where('userid',$userid);
		}
		$re = $this->db->get($this->table_name);
		return $re->result_array();
	}
}
?>