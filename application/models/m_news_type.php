<?php
class M_news_type extends CI_Model {

	var $table_name = 't_news_type';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * news_type_insert	新增新闻类型
	 * @param 	$data	array
	 * @return	int
	 */
	function news_type_insert($data)
	{
		$this->db->trans_start();
		
		$this->db->select('max(mark) as mark');
		$this->db->where('parent',$data['parent']);
		$re = $this->db->get($this->table_name);
		$re = $re->result_array();
		$re = $re[0];
		$data['mark'] = $re['mark']+1;
		
		$this->db->insert($this->table_name,$data);
		$id = $this->db->insert_id();
		
		if($data['parent']=='0')
		{
			$arr = array('detail'=>$id);
		}
		else
		{
			$this->db->select('detail');
			$this->db->where('id',$data['parent']);
			$re = $this->db->get($this->table_name);
			$re = $re->result_array();
			$re = $re[0];
			$arr = array('detail'=>$re['detail'].'.'.$id);
		}
		$this->db->where('id',$id);
		$this->db->update($this->table_name,$arr);	
		
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
	 * news_type_update	修改新闻类型
	 * @param $id int 新闻类型ID
	 * @param $data array
	 * @return float
	 */
	function news_type_update($id,$data)
	{
		$this->db->trans_start();
		
		//原数据
		$this->db->where('id',$id);
		$info = $this->db->get($this->table_name);
		$info = $info->result_array();
		$info = $info[0];
		
		//修改了上级目录
		if($data['parent']!=$info['parent'])
		{
			//修改后的上级目录不能是当前目录，或当前的子目录
			if($data['parent']==$id)
			{
		    	$this->db->trans_rollback();
				return false;
			}			
			
			//获取修改后的detail
			if($data['parent']==0)
			{
				$data['detail'] = $id;
			}
			else
			{
				$this->db->select('detail');
				$this->db->where('id',$data['parent']);
				$re = $this->db->get($this->table_name);
				$re = $re->result_array();
				$re = $re[0];
				$data['detail'] = $re['detail'].'.'.$id;
			}
			
			//当前目录下的子目录detail统一更新
			$this->db->where('parent',$id);
			$re = $this->db->get($this->table_name);
			$re = $re->result_array();
			
			if(is_array($re))
			{
				foreach($re as $v)
				{
					
					//修改后的上级目录不能是当前目录，或当前的子目录
					if($data['parent']==$v['id'])
					{
				    	$this->db->trans_rollback();
						return false;
					}
					
					$arr = array('detail'=>$data['detail'].substr($v['detail'],strlen($info['detail'])));
					$this->db->where('id',$v['id']);
					$this->db->update($this->table_name,$arr);
				}
			}
			
			//获取修改后的上级目录的最后一个子目录的mark
			$this->db->select('max(mark) as mark');
			$this->db->where('parent',$data['parent']);
			$re = $this->db->get($this->table_name);
			$re = $re->result_array();
			$re = $re[0];
			$data['mark'] = $re['mark']+1;
		}
		
		$this->db->where('id',$id);
		$this->db->update($this->table_name,$data);
		
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
	 * news_type_delete	删除新闻类型
	 * @param $id int 新闻类型ID
	 * @return float
	 */
	function news_type_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	
	/**
	 * news_type_mark 类型排序
	 * id	移动类型ID
	 * type	true：上移 false 下移
	 */
	function news_type_mark($id,$type)
	{
		$this->db->trans_start();
		
		//原数据
		$this->db->where('id',$id);
		$info = $this->db->get($this->table_name);
		$info = $info->result_array();
		$info = $info[0];
		
		
		if($type)
		{
			if($info['mark']==1)
			{
				$this->db->trans_rollback();
				return true;
			}
			$this->db->where('parent',$info['parent']);
			$this->db->where('mark',($info['mark']-1));
			$this->db->update($this->table_name,array('mark'=>$info['mark']));	
			
			$this->db->where('id',$id);
			$this->db->update($this->table_name,array('mark'=>($info['mark']-1)));
		}
		else
		{
			//获取上级目录的最后一个子目录的mark
			$this->db->select('max(mark) as mark');
			$this->db->where('parent',$info['parent']);
			$re = $this->db->get($this->table_name);
			$re = $re->result_array();
			$re = $re[0];
			if($re['mark']==$info['mark'])
			{
				$this->db->trans_rollback();
				return true;
			}
			
			$this->db->where('parent',$info['parent']);
			$this->db->where('mark',($info['mark']+1));
			$this->db->update($this->table_name,array('mark'=>$info['mark']));	
			
			$this->db->where('id',$id);
			$this->db->update($this->table_name,array('mark'=>($info['mark']+1)));
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
	 * news_type_list	新闻类型列表
	 */
	function news_type_list($ids = array())
	{
		$this->db->select('*');
		if(is_array($ids) && count($ids)>0)
		{
			$this->db->where_in('id',$ids);
		}
		$this->db->order_by('parent','asc');
		$this->db->order_by('mark','asc');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
	
	/**
	 * news_type_hash	新闻类型hash表
	 */
	function news_type_hash($order = '')
	{
		$data = $this->news_type_list();
		$arr = array();
		if(is_array($data))
		{
			foreach($data as $v)
			{
				$arr[$v->id] = $v->name;
			}
		}
		return $arr;
	}
	
	/**
	 * news_type_tree	新闻类型树
	 */
	function news_type_tree($ids = array())
	{
		$data = $this->news_type_list($ids);
		
		//定义目标数组 
		$tree = array(); 
		//定义索引数组，用于记录节点在目标数组的位置 
		$ind = array(); 
		
		foreach($data as $val) {
			$v = array(
				'self'	=> $val,
				'child'	=> array(),//给每个节点附加一个child项 
			); 
			if($val->parent == 0) { 
				$i = count($tree); 
				$tree[$i] = $v; 
				$ind[$val->id] = &$tree[$i]; 
			}else { 
				$i = count($ind[$val->parent]['child']); 
				$ind[$val->parent]['child'][$i] = $v; 
				$ind[$val->id] = &$ind[$val->parent]['child'][$i]; 
			} 
		} 
		return $tree;
	}

	/**
	 * 获取一个新闻类型的所有下级类型
	 */
	function news_type_by_parent($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$re = $this->db->get($this->table_name);
		$data = $re->result();
		$data = $data[0];
		
		$this->db->select('*');
		$this->db->like('detail',$data->detail,'and ','after');
		$this->db->order_by('parent','asc');
		$this->db->order_by('mark','asc');
		$re = $this->db->get($this->table_name);
		return $re->result();
	}
}
?>