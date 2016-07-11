<?php
class M_user extends CI_Model {

	var $table_name = 't_user';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * user_insert	新增人员
	 * @param 	$data	array
	 * @return	int
	 */
	function user_insert($data)
	{
		return $this->db->insert($this->table_name,$data);
	}
	
	/**
	 * user_update	修改人员
	 * @param $id int 人员ID
	 * @param $data array
	 * @return float
	 */
	function user_update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,$data);	
	}
	
	/**
	 * user_delete	删除人员
	 * @param $id int 人员ID
	 * @return float
	 */
	function user_delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->update($this->table_name,array('del'=>'1'));	
	}
	
	/**
	 * user_num		人员数量
	 */
	function user_num($where) {
		$this->db->select('*');
		$this->db->where('del','0');

		if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
		{
			$this->db->where('department',$where['department']);
		}
		if(isset($where['keyword']) && $where['keyword']!='')
		{
			$this->db->like('name',$where['keyword']) ;
			$this->db->or_like('phone',$where['keyword']);
		}
		$re = $this->db->get($this->table_name);
		return $re->num_rows();
	}
	/**
	 * 注册人员数量
	 **/
	function register_num($where){
		$this->db->select('*');
		$this->db->where('del','0');
		$this->db->where('register_type','1');
		if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
		{
			$this->db->where('department',$where['department']);
		}
		if(isset($where['keyword']) && $where['keyword']!='')
		{
			$this->db->like('name',$where['keyword']) ;
			$this->db->or_like('phone',$where['keyword']);
		}
		$re = $this->db->get($this->table_name);
		return $re->num_rows();
	}
	
	/**
	 * user_list	人员列表
	 */
	function user_list($where=array(),$start='0',$pageSize='0')
	{
		$this->db->select('*');
		$this->db->where('del','0');

		if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
		{
			$this->db->where('department',$where['department']);
		}
		if(isset($where['keyword']) && $where['keyword']!='')
		{
			$this->db->like('name',$where['keyword']);
			$this->db->or_like('phone',$where['keyword']);
		}

		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		$this->db->order_by1('mark','asc');
		$re = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $re->result();
	}
	/**
	 *  注册人员列表
	 **/
	function register_list($where=array(),$start='0',$pageSize='0'){
		$this->db->select('*');
		$this->db->where('del','0');
		$this->db->where('register_type','1');

		if(isset($where['department']) && $where['department']!='' && $where['department']!='0')
		{
			$this->db->where('department',$where['department']);
		}
		if(isset($where['keyword']) && $where['keyword']!='')
		{
			$this->db->like('name',$where['keyword']);
			$this->db->or_like('phone',$where['keyword']);
		}

		if($pageSize>0)
		{
			$this->db->limit($pageSize,$start);
		}
		$this->db->order_by1('mark','asc');
		$re = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $re->result();
	}
	
	/**
	 * user_get	获取指定人员信息
	 */
	function user_get($where)
	{
		$this->db->select('*');
		if(is_array($where))
		{
			foreach($where as $key => $val)
			{
				$this->db->where($key,$val);
			}
		}
		$re = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		
		if($re->num_rows=='0')
		{
			return false;
		}
		else
		{
			$data = $re->result();
			return $data[0];
		}
	}
	/**
	 * user_get_r	获取指定人员信息
	 */
	function user_get_r($where_in){
		$this->db->select('*');
		$this->db->where('del','0');
		$where_id=explode(",",$where_in['u_id']);
		if(is_array($where_in))
		{
			$this->db->where_in('id',$where_id);
		}
		$re = $this->db->get($this->table_name);
		if($re->num_rows=='0')
		{
			return false;
		}
		else
		{
			$data = $re->result_array();
			return $data;
		}

	}
	function user_get_r_2($where_in){
		$this->db->select('*');
		$this->db->where('del','0');
		$this->db->where_in('id',explode(",",$where_in));

		$re = $this->db->get($this->table_name);

		if($re->num_rows=='0')
		{
			return false;
		}
		else
		{
			$data = $re->result_array();
			return $data;
		}

	}

}
?>