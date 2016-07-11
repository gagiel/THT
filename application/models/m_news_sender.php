<?php
class M_news_sender extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * news_sender_insert	新增推送号码
	 * @param 	$data	array
	 * @param 	$groups	array
	 * @return	int
	 */
	function news_sender_insert($data,$groups=array())
	{
		$this->db->trans_start();
		
		$sender_id = $this->db->insert('t_news_sender',$data);
		if(is_array($groups))
		{
			foreach($groups as $gid)
			{
				if($gid=='')continue;
				$this->db->insert('t_news_group_sender',array('sender_id'=>$sender_id,'group_id'=>$gid));
			}
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
	 * news_sender_update	修改推送号码
	 * @param $id int 推送号码ID
	 * @param $data array
	 * @return float
	 */
	function news_sender_update($id,$data,$groups)
	{
		$this->db->trans_start();
		
		$this->db->where('id',$id);
		$this->db->update('t_news_sender',$data);
			
		$this->db->where('sender_id',$id);
		$this->db->delete('t_news_group_sender');
		
		if(is_array($groups))
		{
			foreach($groups as $gid)
			{
				if($gid=='')continue;
				$this->db->insert('t_news_group_sender',array('sender_id'=>$id,'group_id'=>$gid));
			}
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
	 * news_sender_delete	删除推送号码
	 * @param $id int 推送号码ID
	 * @return float
	 */
	function news_sender_delete($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id',$id);
		$this->db->delete('t_news_sender');
		
		$this->db->where('sender_id',$id);
		$this->db->delete('t_news_group_sender');
		
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
	
	
	function news_sender_num($where=array())
	{
		$this->db->select('*');
		
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
		}
		if(isset($where['mobile']) && $where['mobile']!='')
		{
			$this->db->like('mobile',$where['mobile']);
		}
		$re = $this->db->get('t_news_sender');
		
		return $re->num_rows();
	}
	
	/**
	 * news_sender_list	推送号码列表
	 */
	function news_sender_list($where=array(),$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['name']) && $where['name']!='')
		{
			$this->db->like('name',$where['name']);
		}
		if(isset($where['mobile']) && $where['mobile']!='')
		{
			$this->db->like('mobile',$where['mobile']);
		}
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get('t_news_sender');
		
		return $re->result();
	}
	
	/**
	 * news_group_insert	新增推送分组
	 * @param 	$data	array
	 * @param 	$tels	array
	 * @return	int
	 */
	function news_group_insert($data,$tels=array())
	{
		$this->db->trans_start();
		
		$group_id = $this->db->insert('t_news_group',$data);
		if(is_array($tels))
		{
			foreach($tels as $sid)
			{
				if($sid=='')continue;
				$this->db->insert('t_news_group_sender',array('sender_id'=>$sid,'group_id'=>$group_id));
			}
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
	 * news_group_update	修改推送号码
	 * @param $id int 推送号码ID
	 * @param $data array
	 * @param $tels array
	 * @return float
	 */
	function news_group_update($id,$data,$tels)
	{
		$this->db->trans_start();
		
		$this->db->where('id',$id);
		$this->db->update('t_news_group',$data);
			
		$this->db->where('group_id',$id);
		$this->db->delete('t_news_group_sender');
		
		if(is_array($tels))
		{
			foreach($tels as $sid)
			{
				if($sid=='')continue;
				$this->db->insert('t_news_group_sender',array('sender_id'=>$sid,'group_id'=>$id));
			}
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
	 * news_group_delete	删除推送分组
	 * @param $id int 推送分组ID
	 * @return float
	 */
	function news_group_delete($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id',$id);
		$this->db->delete('t_news_group');
		
		$this->db->where('group_id',$id);
		$this->db->delete('t_news_group_sender');
		
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
	 * news_group_list	推送分组列表
	 */
	function news_group_list()
	{
		$this->db->select('*');
		$re = $this->db->get('t_news_group');
		return $re->result();
	}
	
	
	/**
	 * news_group_sender	推送分组号码
	 */
	function news_sender_group($type,$id)
	{
		$this->db->select('*');
		$this->db->where($type,$id);
		$re = $this->db->get('t_news_group_sender');
		return $re->result();
	}
	
	/**
	 * get_group_sender	获取分组中的号码
	 */
	function get_group_sender($id)
	{
		$this->db->select('mobile');
		$this->db->where('group_id',$id);
		$this->db->from('t_news_group_sender'); //主表
        $this->db->join('t_news_sender', 't_news_sender.id =t_news_group_sender.sender_id');
		$re = $this->db->get();
		return $re->result();
	}
}
?>