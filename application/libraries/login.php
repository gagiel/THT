<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login{
	
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		log_message('debug', "Login Class Initialized");
	}
	
	/**
	 * 判断是否登录
	 */
	public function check_login($uid,$json=false)
	{
		if(!$uid)
		{
			if($json)
			{
				exit('您尚未登录系统');
			}
			else
			{
				$_error =& load_class('Exceptions', 'core');
				exit($_error->show_error('登录错误', '您尚未登录系统', 'error_to_index'));
			}
		}
	}
	
	/**
	 * 判断是否有权限
	 */
	public function check_jurisdict($id,$jurisdict,$json=false)
	{
		$arr = explode(',',$jurisdict);
		if(!in_array($id,$arr))
		{
			if($json)
			{
				exit('您没有该操作的权限');
			}
			else
			{
				$_error =& load_class('Exceptions', 'core');
				exit($_error->show_error('权限错误', '您没有该操作的权限', 'error_to_index'));
			}
		}
	}
	
	/**
	 * 判断是否有权限
	 */
	public function check_contact($id,$jurisdict,$json=false)
	{
		$arr = explode(',',$jurisdict);
		if(!in_array($id,$arr))
		{
			if($json)
			{
				exit('该名片主人为公开此名片');
			}
			else
			{
				$_error =& load_class('Exceptions', 'core');
				exit($_error->show_error('权限错误', '该名片主人为公开此名片', 'error_contact'));
			}
		}
	}
	
}
?>