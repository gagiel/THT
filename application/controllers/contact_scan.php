<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");

/*
 * 联系人模块
 * 联系人管理
 * 数据库连接：t_contact
 */
class contact_scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_contact_total');
        $this->load->model('m_contact');
        $this->load->model('m_company');
        
        $this->load->helper(array('form', 'url'));
    }

	/**
	 * 上传图片
	 */
	public function pic()
	{
		$picName = $this->input->post('pic_id');
    	//上传
    	$config['upload_path'] = './uploads/contact/';
    	$config['allowed_types'] = 'png|gif|jpg';
    	$config['max_size'] = '15000';
    	$config['max_width'] = '2048';
    	$config['max_height'] = '1024';

    	$this->load->library('upload', $config);
    	
    	$load = $this->upload->do_upload('i_file');

    	if (!$load) 
    	{
    		echo "<script>parent.pic_back('**上传失败**');</script>";
    	} 
    	else
    	{
    		$data = $this->upload->data();
    		$logo = $data['full_path'];
    		$picArr = explode('/uploads/', $logo);
    		$logo = '/uploads/' . $picArr[1];
    		
	    	$pic = isset($logo) ? $logo : '';
	    	echo "<script>parent.document.sub_form.".$picName.".value='".$pic."';alert(1);</script>";
    	}
	}
	/**
	 * 根据输入文字获取单位名称列表，10个
	 */
	public function get_company_by_code()
	{		
		$list = $this->m_company->company_list(array('code'=>$this->input->post('name')),0,10);

		$arr = array();
		if(is_array($list))
		{
			foreach($list as $v)
			{
				$arr[] = $v->name;
			}
			echo implode(',',$arr);
		}
		else
		{
			echo '';
		}
	}
	
}