<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class monthly_report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}
	
	 /** 
	 * 强制浏览器打开页面后立即出现下载保存窗口
	 */
	public function downloadPdf(){
		//$wordname = './plandownload/plan_20150515090919.doc';
		$wordname = $this->input->get('wordname');
		header("Content-Type: application/force-download");
		header('Content-Disposition: attachment; filename="monthlyreport_'.date('YmdHis').'.pdf"');
		$img = file_get_contents($wordname); 
		echo $img;  
	}
}