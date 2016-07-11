<?php
class M_wechat_set extends CI_Model {

	var $table_set	= 't_wechat_set';
	var $table_log	= 't_wechat_log';
	var $table_jyxc	= 't_wechat_jyxc';
	var $table_user	= 't_wechat_user';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 根据用户发送的内容获取回复内容
	 */
	function get_re_msg($str)
	{
		$this->db->select('*');
		
		$this->db->where('get_msg',trim($str));
		$this->db->where('del','0');
		
		$re = $this->db->get($this->table_set);
		
		if($re->num_rows()>0)
		{
			$re = $re->result_array();
			return array(
				'succ'	=> true,
				'type'	=> $re[0]['re_type'],
				'info'	=> $re[0]['re_msg'],
				'view'	=> $re[0]['view'],
			);
		}
		else
		{
			return array('succ'=>false);
		}
	}
	
	/**
	 * 判断回复代码是否存在
	 * @param unknown_type $str
	 */
	function check_recode($str)
	{
		$this->db->select('*');
		$this->db->where('recode',trim($str));
		$re = $this->db->get($this->table_jyxc);
		return $re->num_rows()>0;
	}
	
	/**
	 * 根据代码获取建言献策回复信息
	 */
	function get_jyxc_re($str)
	{
		$this->db->select('*');
		$this->db->where('recode',trim($str));
		$re = $this->db->get($this->table_jyxc);
		
		if($re->num_rows()>0)
		{
			$re = $re->result_array();
			return array(
				'succ'	=> true,
				'info'	=> $re[0]['re_info'],
			);
		}
		else
		{
			return array('succ'=>false);
		}
	}
	
	/**
	 * 添加log记录
	 */
	function log_insert($data)
	{
		return $this->db->insert($this->table_log,$data);
	}
	
	/**
	 * 新增建言献策
	 */
	function jyxc_insert($data)
	{
		return $this->db->insert($this->table_jyxc,$data);
	}
	
	/**
	 * 获取系统回复列表
	 */
	function set_list()
	{
		$this->db->select('*');
		$re = $this->db->get($this->table_set);
		
		return $re->result();
	}
	
	function jyxc_list($where)
	{
		$this->db->select('*');
		$re = $this->db->get($this->table_jyxc);
		
		return $re->result_array();
	}
	
	/**
	 * 建言献策回复
	 * @param int $id
	 * @param array $data
	 */
	function re_jyxc($id, $data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_jyxc,$data);	
	}
}
?>