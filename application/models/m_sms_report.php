<?php
class M_sms_report extends CI_Model {

	var $table_name = 't_sms_report';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * plan_num	获取报告数量
	 */
	function report_num($where)
	{
		$this->db->select('id,msgid,reportTime,mobile,group_concat(status) as status');
		
		if(isset($where['mobile']) && $where['mobile']!='')
		{
			$this->db->like('mobile',$where['mobile']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('reportTime >=',  strtotime($where['start'].' 00:00:00'));
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('reportTime <=',strtotime($where['end'].' 23:59:59'));
		}
		if(isset($where['status']) && $where['status']!='')
		{
			$this->db->where_in('status',$where['status']);
		}
                $this->db->group_by('reportTime,msgid,mobile');
                $this->db->order_by1('id','desc');
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	
	/**
	 * plan_list	活动方案列表
	 */
	function report_list($where,$start,$pageSize)
	{
		$this->db->select('id,msgid,reportTime,mobile,group_concat(status) as status');
		if(isset($where['mobile']) && $where['mobile']!='')
		{
			$this->db->like('mobile',$where['mobile']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('reportTime >=',  strtotime($where['start'].' 00:00:00'));
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('reportTime <=',strtotime($where['end'].' 23:59:59'));
		}
		if(isset($where['status']) && $where['status']!='')
		{
			$this->db->where_in('status',$where['status']);
		}
		$this->db->limit($pageSize,$start);
                $this->db->group_by('reportTime,msgid,mobile');
                $this->db->order_by1('id','desc');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
}
?>