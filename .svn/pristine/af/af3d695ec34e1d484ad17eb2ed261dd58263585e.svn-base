<?php
class M_remind extends CI_Model {

	var $table_name = 't_remind';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * remind_insert	新增提醒
	 * @param 	$data	array
	 * @return	int
	 */
	function remind_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * remind_update	修改提醒
	 * @param $id int 提醒ID
	 * @param $data array
	 * @return float
	 */
	function remind_update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * remind_delete	删除提醒
	 * @param $id int 提醒ID
	 * @return float
	 */
	function remind_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * remind_num	获取提醒数量
	 */
	function remind_num($where)
	{
		$this->db->select('*');
		
		if(isset($where['info']) && $where['info']!='')
		{
			$this->db->like('info',$where['info']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('t_start >=',$where['start'].' 00:00:00');
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('t_end <=',$where['end'].' 23:59:59');
		}
		if(isset($where['state']) && $where['state']!='')
		{
			$this->db->where('state',$where['state']);
		}
		if(isset($where['userid']) && $where['userid']!='')
		{
			$this->db->like("concat(',',range_user,',')",','.$where['userid'].',');
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * remind_list	提醒列表
	 */
	function remind_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['info']) && $where['info']!='')
		{
			$this->db->like('info',$where['info']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('t_start >=',$where['start'].' 00:00:00');
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('t_end <=',$where['end'].' 23:59:59');
		}
		if(isset($where['state']) && $where['state']!='')
		{
			$this->db->where('state',$where['state']);
		}
		if(isset($where['userid']) && $where['userid']!='')
		{
			$this->db->like("concat(',',range_user,',')",','.$where['userid'].',');
		}
		$this->db->order_by('t_start','desc');
		$this->db->order_by('t_end','desc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}

	/**
	 * get_remind_by_userid  根据ID获取我的提醒
	 */
	function get_remind_by_userid($userid)
	{
		if($userid=='-1')
		{
			$this->db->where('state','1');
			$this->db->where('t_end >=',date('Y-m-d H:i:s'));
			$this->db->where('range_type','3');//对外
			$this->db->order_by('t_start','asc');
			$this->db->order_by('t_end','asc');
			
			$re = $this->db->get($this->table_name);
		}
		else
		{
			$sql =  " select * from ".$this->table_name." " .
					" where state=1 " .
					" and t_end >='".date('Y-m-d H:i:s')."' " .
					" and ( " .
					"   range_type=2 " .
					"   or " .
					"   ( " .
					"      range_type=1 " . 
					"      and " .
					"      concat(',',range_user,',') like '%,".$userid.",%' " .
					"   ) " .
					" ) " .
					" order by t_start,t_end";
			$re = $this->db->query($sql);
		}
		return $re->result();
	}
	
	/**
	 * remind_read 阅读提醒
	 */
	function remind_read($data)
	{
		$this->db->where('remind_id',$data['remind_id']);
		$this->db->where('user_id',$data['user_id']);
		$re = $this->db->get($this->table_name.'_read');
		$data['addtime'] = date('Y-m-d H:m:s');
		if($re->num_rows)
		{
			$this->db->where('remind_id',$data['remind_id']);
			$this->db->where('user_id',$data['user_id']);
			return $this->db->update($this->table_name.'_read',$data);
		}
		else
		{
			return $this->db->insert($this->table_name.'_read',$data);
		}
	}
	
	/**
	 * get_read_by_userid 根据ID获取提醒的阅读状态
	 */
	function get_read_by_userid($userid)
	{
		$this->db->where('user_id',$userid);
		$re = $this->db->get($this->table_name.'_read');
		$re = $re->result();
		$arr = array();
		if(is_array($re))
		{
			foreach($re as $v)
			{
				$arr[$v->remind_id] = $v->state;
			}
		}
		return $arr;
	}
	
	function remind_reader($id)
	{
		$this->db->select('t_remind_read.state,t_user.name,t_remind_read.addtime');
		$this->db->where('remind_id',$id);
		$this->db->join('t_user', 't_user.id=t_remind_read.user_id', 'left');
		$re = $this->db->get('t_remind_read');
		return $re->result();
	}
}
?>