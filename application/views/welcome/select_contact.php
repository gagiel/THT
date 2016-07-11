<div id="content_c">
	<ul>
<? 
if(is_array($list))
{
	foreach($list as $val)
	{
		
?>
    <li> 
    	<div class="logo"><img src="<?=$val->logo==''?'/images/logo_03.jpg':$val->logo?>" height="100px" /></div>
        <? /*<div class="people"><img src="<?=$val->pic_front==''?'/images/logo_05.jpg':$val->pic_front?>" /></div>*/?>
        <div class="info">
            <p>联系人姓名:  <span><?=$is_login?('<a href="/index.php/contact/view/'.$val->u_id.'/1" target="_blank">'):''?><?=$val->u_name?><?=$is_login?'</a>':''?></span></p>
            <p>单位名称:  <span><?=$is_login?('<a href="/index.php/company/check_index/'.$val->c_id.'" target="_blank">'):''?><?=$val->c_name?><?=$is_login?'</a>':''?></span></p>
            <p>联系人职务:  <span><?=$val->position?></span></p>
        	<p>单位分组:  <span><?=$val->typename?></span></p>
        </div>
    </li>
<?
	}
}
?>
    </ul>
</div>
<div id="page" style="padding-left:176px;"> 
<?=$pages?>
</div>