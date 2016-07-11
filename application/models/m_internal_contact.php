<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-12-10
 * Time: 下午2:04
 */

/*
 * 内部联系人模块
 * 内部联系人管理
 */

class M_internal_contact extends CI_Model
{
	var $table_name		= 't_internal_contact';
	var $table_comp		= 't_internal_company';
	
    function __construct()
    {
        $this->load->database();
    }
    
    /**
     * 新增联系人
     */
    function insert($data,$company)
    {
		$this->db->trans_start();
		
		//新增联系人表，获取ID
		if($company['companyid']==''){
			unset($company['companyid']);
			$this->db->insert($this->table_comp,$company);
			$company_id = $this->db->insert_id();
			$data['companyid'] = $company_id;
		}else{
			$company_id = $company['companyid'];
			$cdata = array(
				'address'=>$company['address'],
				'postcode'=>$company['postcode'],
			);
			$this->db->where('id', $company_id);
			$this->db->update($this->table_comp,$cdata);
			$data['companyid'] = $company_id;
		}
		$this->db->insert($this->table_name,$data);
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
     * 更新联系人
     */
    function update($id,$data,$company)
    {
		$this->db->trans_start();
		
		//修改联系人信息
    	if($company['companyid']==''){
			unset($company['companyid']);
			$this->db->insert($this->table_comp,$company);
			$company_id = $this->db->insert_id();
			$data['companyid'] = $company_id;
		}else{
			$company_id = $company['companyid'];
			$cdata = array(
				'address'=>$company['address'],
				'postcode'=>$company['postcode'],
			);
			$this->db->where('id', $company_id);
			$this->db->update($this->table_comp,$cdata);
			$data['companyid'] = $company_id;
		}
		$this->db->where('id', $id);
		$this->db->update($this->table_name, $data);
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
     * 
     * 删除内部名片(多个假删除)
     */
      public function del($id)
     {
        return $this->db->where_in('id', explode(',',$id))->update('t_internal_contact', array('del' => 1));
     }
     
 	/**
     * 
     * 删除内部名片(单个假删除)
     */
      public function del1($id)
     {
        return $this->db->where('id', $id)->update('t_internal_contact', array('del' => 1));
     }
    
    
    /**
     * 
     * 获取联系人信息(左连接单位表)
     */
    public function view($id){
    	//获取数据
		$this->db->select('
			t_internal_contact.*,
			t_internal_company.name as cname,
			t_internal_company.address,
			t_internal_company.postcode
		');
		$this->db->from('t_internal_contact');
		$this->db->join('t_internal_company','t_internal_contact.companyid = t_internal_company.id','left');
		$this->db->where('del','0');
		$this->db->where('t_internal_contact.id',$id);
		$re = $this->db->get();
		$result = $re->result_array();
		return $result[0];
    	
    }
    
    /**
     * 获取内部联系人列表
     */
    public function contact_list($value,$start,$pageSize){
		//获取数据
		$this->db->select('
			t_internal_contact.id,
			t_internal_contact.name,
			t_internal_contact.position,
			t_internal_company.name as cname,
			t_internal_company.address as address');
		$this->db->from('t_internal_contact');
		$this->db->join('t_internal_company','t_internal_contact.companyid = t_internal_company.id','left');
		$this->db->like('t_internal_contact.name',$value);//name:联系人姓名
		$this->db->where('del','0');
		//$this->db->order_by1($order,$ud);
		$this->db->limit($pageSize,$start);
		$re = $this->db->get();
		return $re->result();
    	
    }

    
    /**
	 * 获取满足查询条件的联系人数量
	 */
	function contact_list_num($value)
	{
		//获取数据
		$this->db->select('
			t_internal_contact.id,
			t_internal_contact.name,
			t_internal_contact.position,
			t_internal_company.name as cname,
			t_internal_company.address as address');
		$this->db->from('t_internal_contact');
		$this->db->join('t_internal_company','t_internal_contact.companyid = t_internal_company.id','left');
		$this->db->like('t_internal_contact.name',$value);//name:联系人姓名
		$this->db->where('del','0');
		$re = $this->db->get();
		return $re->num_rows();
	}
	

}