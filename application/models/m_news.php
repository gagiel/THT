<?php
class M_news extends CI_Model {

	var $table_name = 't_news';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * news_insert	新增新闻
	 * @param 	$data	array
	 * @return	int
	 */
	function news_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * news_update	修改新闻
	 * @param $id int 新闻ID
	 * @param $data array
	 * @return float
	 */
	function news_update($id,$data)
	{
		if($id>0)
		{
			$this->db->where('id',$id);
		}
		else
		{
			$this->db->where('state','0');
		}
		
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * news_delete	删除新闻
	 * @param $id int 新闻ID
	 * @return float
	 */
	function news_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * news_num	获取新闻数量
	 */
	function news_num($where)
	{
		$this->db->select('*');
		
		if(isset($where['info']) && $where['info']!='')
		{
			$this->db->like('info',$where['info']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('ndate >=',$where['start'].' 00:00:00');
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('ndate <=',$where['end'].' 23:59:59');
		}
		if(isset($where['ids']) && $where['ids']!='')
		{
			$this->db->where_in('ntype',$where['ids']);
		}
		if(isset($where['state']) && $where['state']!='')
		{
			$this->db->where_in('state',$where['state']);
		}
		$re = $this->db->get($this->table_name);
		
		return $re->num_rows();
	}
	
	/**
	 * news_list	新闻列表
	 */
	function news_list($where,$start='0',$pageSize='0')
	{
		$this->db->select('*');
		
		if(isset($where['info']) && $where['info']!='')
		{
			$this->db->like('info',$where['info']);
		}
		if(isset($where['start']) && $where['start']!='')
		{
			$this->db->where('ndate >=',$where['start'].' 00:00:00');
		}
		if(isset($where['end']) && $where['end']!='')
		{
			$this->db->where('ndate <=',$where['end'].' 23:59:59');
		}
		if(isset($where['ids']) && $where['ids']!='')
		{
			$this->db->where_in('ntype',$where['ids']);
		}
		if(isset($where['ntype']) && $where['ntype']!='')
		{
			$this->db->where('ntype',$where['ntype']);
		}
		if(isset($where['state']) && $where['state']!='')
		{
			$this->db->where('state',$where['state']);
		}
		$this->db->order_by('ndate','desc');
		
		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		
		$re = $this->db->get($this->table_name);
		
		return $re->result();
	}

	function mark($id,$isup)
	{
		$this->db->trans_start();
		//获取当前新闻
		$this->db->where('id',$id);
		$re1 = $this->db->get($this->table_name);
		if($re1->num_rows!='1')//无数据
		{
			$this->db->trans_rollback();
		    return false;
		}
		$news1 = $re1->result_array();
		$news1 = $news1[0];
		
		if($isup)
		{//上移
			if(substr($news1['ndate'],11)=='00:00:00')
			{//其他相同时间的+1s
				$this->db->where('ntype',$news1['ntype']);
				$this->db->where('ndate',$news1['ndate']);
				$this->db->where('id <>',$news1['id']);
				$this->db->update($this->table_name,array('ndate'=>substr($news1['ndate'],-1).'1'));
			}	
			else
			{//自身-1s
				$this->db->where('id',$news1['id']);
				$this->db->update($this->table_name,array('ndate'=>date('Y-m-d H:i:s',strtotime($news1['ndate'])-1)));
			}
		}
		else
		{//下移
			if(substr($news1['ndate'],11)=='23:59:59')
			{//其他相同时间的-1s
				$this->db->where('ntype',$news1['ntype']);
				$this->db->where('ndate',$news1['ndate']);
				$this->db->where('id <>',$news1['id']);
				$this->db->update($this->table_name,array('ndate'=>substr($news1['ndate'],-1).'8'));
			}	
			else
			{//自身+1s
				$this->db->where('id',$news1['id']);
				$this->db->update($this->table_name,array('ndate'=>date('Y-m-d H:i:s',strtotime($news1['ndate'])+1)));
			}
		}
		
		//交换的新闻
		$this->db->where('ntype',$news1['ntype']);
		$this->db->where('id <>',$news1['id']);
		$this->db->like('ndate',substr($news1['ndate'],0,10),'left');
		if($isup)
		{
			$this->db->where('ndate <',$news1['ndate']);
			$this->db->order_by('ndate','desc');
		}
		else
		{
			$this->db->where('ndate >',$news1['ndate']);
			$this->db->order_by('ndate','asc');
		}
		$this->db->limit(1);
		$re2 = $this->db->get($this->table_name);
		
		if($re2->num_rows>0)
		{
			$news2 = $re2->result_array();
			$news2 = $news2[0];
			//交换新闻时间
			$this->db->where('id',$news1['id']);
			$this->db->update($this->table_name,array('ndate'=>$news2['ndate']));
			
			$this->db->where('id',$news2['id']);
			$this->db->update($this->table_name,array('ndate'=>$news1['ndate']));
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
	 * calendar_info 获取日历所需数据
	 */
	function calendar_info($start,$end)
	{
		$this->db->select(array('ntype','SUBSTRING(ndate,1,10) AS tdate','COUNT(id) AS num'));
		
		$this->db->where('ndate >=',$start.' 00:00:00');
		$this->db->where('ndate <=',$end.' 23:59:59');
		$this->db->where('state','1');
		
		$this->db->group_by(array('tdate','ntype'));
		
		$this->db->order_by1('num','desc');
		
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
	
	/**
	 * publish 发布新闻
	 */
	function publish($date,$types,$top,$footer)
	{
		
		$this->db->trans_start();
		
		
		$this->db->where('ndate like', date("Y-m-d",strtotime($date)).'%');
		$this->db->where_in('ntype',explode(',',$types));
		
		$this->db->update($this->table_name,array('state'=>'1'));	
		
		$data = array(
			'p_date'		=> $date,
			'info_top'		=> $top,
			'info_footer'	=> $footer,
			'info'			=> $types
		);
		
		$pinfo = $this->get_publish($date);
		if(count($pinfo)>0)
		{
			$this->db->where('p_date',$date);
			$this->db->update('t_news_publish',$data);	
		} 
		else
		{
			$this->db->insert('t_news_publish',$data);
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
	 * get_type_used 获取使用了的类型
	 */
	function get_type_used($start,$end)
	{
		
		$this->db->select('detail');
		
		$this->db->where("ndate >='".$start." 00:00:00'");
		$this->db->where("ndate <='".$end." 23:59:59'");
		$this->db->join('t_news_type as t','t.id=ntype','left');
		
		$this->db->group_by('ntype');
		
		$re = $this->db->get($this->table_name);
		
		$types = array();
		foreach($re->result() as $v)
		{
			$arr = explode('.',$v->detail);
			if(is_array($arr))
			{
				foreach($arr as $k)
				{
					if(!in_array($k,$types))
					{
						$types[] = $k;
					}
				}
			}
		}

		return $types;
	}
	
	/**
	 * get_publish 获取指定日期的发布信息
	 */
	function get_publish($date)
	{
		$this->db->select('*');
		
		$this->db->where('p_date',$date);
		
		$re = $this->db->get('t_news_publish');
		
		return $re->result();
	}
	
	/**
	 * get_publish_prev 获取指定日期上一期的发布信息
	 */
	function get_publish_prev($date)
	{
		
		$this->db->select('*');
		
		$this->db->where('p_date <',$date);
		
		$this->db->order_by('p_date','desc');
		$this->db->limit(1);
		
		$re = $this->db->get('t_news_publish');
		
		return $re->result();
	}
}
?>