<?php
class M_jurisdict extends CI_Model {

	var $table_name = 't_jurisdict';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * jurisdict_tree	权限树
	 */
	function jurisdict_tree()
	{
		$this->db->select('*');
		$re = $this->db->get($this->table_name);
		$data = $re->result();
		
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
}
?>