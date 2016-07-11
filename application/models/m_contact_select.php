<?php
class M_contact_select extends CI_Model {

	var $table_name = 'v_contact_select';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function contact_num($value,$types)
	{
		$this->db->select('*');

		$this->db->like('concat(u_name,position,c_name)',$value);//u_name:联系人姓名,position:职务,c_name：企业名称

		if(is_array($types))
		{
			foreach($types as $v)
			{
				$this->db->or_like('detail','.'.$v.'.');
			}
		}
		$this->db->where('u_del','0');
		$this->db->where('c_del','0');

		$re = $this->db->get($this->table_name);

		return $re->num_rows();
	}

	/**
	 * 首页查询
	 */
	function contact_select($value,$types,$start,$pageSize)
	{
		//获取数据
		$this->db->select('*');

		$this->db->like('concat(u_name,position,c_name)',$value);//u_name:联系人姓名,position:职务,c_name：企业名称

		if(is_array($types))
		{
			foreach($types as $v)
			{
				$this->db->or_like('detail','.'.$v.'.');//分类
			}
		}
		$this->db->where('u_del','0');
		$this->db->where('c_del','0');

		$this->db->order_by('u_id','desc');

		$this->db->limit($pageSize,$start);

		$re = $this->db->get($this->table_name);

		return $re->result();
	}

	/**
	 * 列表数量
	 */
	function contact_list_num($value,$types,$owner)
	{
		//获取数据
		$this->db->select(
				'u_id,' .
				'u_name,' .
				'GROUP_CONCAT(`position`) AS `position`,' .
				'GROUP_CONCAT(`t_name`) AS `t_name`,' .
				'GROUP_CONCAT(`c_id`) AS `c_id`,' .
				'GROUP_CONCAT(`c_name`) AS `c_name`,' .
				'GROUP_CONCAT(`detail`) AS detail'
		);

		$this->db->like('concat(u_name,position,c_name)',$value);//u_name:联系人姓名,position:职务,c_name：企业名称

		if($types>0)
		{
			$this->db->like('detail','.'.$types.'.');//分类
		}
		if($owner>0)
		{
			$this->db->like('concat(\',\',owner,\',\')',','.$owner.',');//名片主人
		}
		$this->db->where('u_del','0');
		$this->db->where('c_del','0');

		$this->db->group_by('u_id');

		$re = $this->db->get($this->table_name);

		return $re->num_rows();
	}
	/**
	 * 短信群发的列表查询
	 */
	function contact_list_mass($value,$types,$owner,$order,$ud){
		//获取数据
		$this->db->select(
			'u_id,' .
			'u_name,' .
			'GROUP_CONCAT(`position`) AS `position`,' .
			'GROUP_CONCAT(`t_name`) AS `t_name`,' .
			'GROUP_CONCAT(`c_id`) AS `c_id`,' .
			'GROUP_CONCAT(`c_name`) AS `c_name`,' .
			'GROUP_CONCAT(`detail`) AS detail'
		);

		$this->db->like('concat(u_name,position,c_name)',$value);//u_name:联系人姓名,position:职务,c_name：企业名称

		if($types>0)
		{
			$this->db->like('detail','.'.$types.'.');//分类
		}
		if($owner>0)
		{
			$this->db->like('concat(\',\',owner,\',\')',','.$owner.',');//名片主人
		}
		$this->db->where('u_del','0');
		$this->db->where('c_del','0');

		$this->db->group_by('u_id');

		$this->db->order_by1($order,$ud);

		$re = $this->db->get($this->table_name);

		return $re->result();
	}
	/**
	 * 列表查询
	 */
	function contact_list($value,$types,$owner,$order,$ud,$start,$pageSize)
	{
		//获取数据
		$this->db->select(
				'u_id,' .
				'u_name,' .
				'GROUP_CONCAT(`position`) AS `position`,' .
				'GROUP_CONCAT(`t_name`) AS `t_name`,' .
				'GROUP_CONCAT(`c_id`) AS `c_id`,' .
				'GROUP_CONCAT(`c_name`) AS `c_name`,' .
				'GROUP_CONCAT(`detail`) AS detail'
		);

		$this->db->like('concat(u_name,position,c_name)',$value);//u_name:联系人姓名,position:职务,c_name：企业名称

		if($types>0)
		{
			$this->db->like('detail','.'.$types.'.');//分类
		}
		if($owner>0)
		{
			$this->db->like('concat(\',\',owner,\',\')',','.$owner.',');//名片主人
		}
		$this->db->where('u_del','0');
		$this->db->where('c_del','0');

		$this->db->group_by('u_id');

		$this->db->order_by1($order,$ud);

		$this->db->limit($pageSize,$start);

		$re = $this->db->get($this->table_name);

		return $re->result();
	}
	/**
	 * 获取指定列表信息
	 */
	function contact_list_r($id_array)
	{

		//获取数据
		$this->db->select('*');
		$this->db->where_in('u_id',$id_array);

		$re = $this->db->get($this->table_name);
		return $re->result_array();
	}

	/**
	 * 获取企业信息
	 */
	function get_company_info($cid)
	{
		//获取数据
		$this->db->select('*');
		$this->db->where('c_id',$cid);

		$re = $this->db->get($this->table_name);

		return $re->result();
	}

	function owner_hash(){
		$this->db->select('group_concat(owner) as o');
		$re = $this->db->get('(select owner from t_contact group by owner) as t');
		$owner = $re->result_array();

		$this->db->select('id,name');
		$this->db->where_in('id',explode(',', $owner[0]['o']));
		$this->db->order_by('id');
		$re1 = $this->db->get('t_user');
		return $re1->result();
	}
        /*
         * 
         */
        function ddd(){
            
        }
}
?>