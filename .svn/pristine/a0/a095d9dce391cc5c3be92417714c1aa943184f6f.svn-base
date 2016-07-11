<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 内页分类搜索
 */
if ( ! function_exists('type_select'))
{
	function type_select()
	{
		$html = '<form id="sel_form" action="/index.php/select" method="post">'.
				'	  <select class="issr2" name="seltype" >'.
				'        <option value="all">全 站</option>'.
				'        <option value="contact">联系人</option>'.
				'        <option value="news">NewsLetter</option>'.
				'      </select>'.
				'	  <input type="text" class="issr" name="selvalue" value="请输入关键词" onClick="this.focus();" onfocus="if(this.value==\'请输入关键词\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'请输入关键词\';" />'.
				'	  <input type="submit" class="is_bnt" value="查 询"/>'.
				'	</form>';
		return $html;
	}
}