<div id="content">
  <div id="tabs">
    <ul id="tabs_btn">
      <li><a href="javascript:;" <?=$tab=='contact'?' class="current"':' onclick="tab(\'contact\');"'?>>联系人</a></li>
      <li><a href="javascript:;" <?=$tab=='news'?' class="current"':' onclick="tab(\'news\');"'?>>NewsLetter</a></li>
      <li><a>活动方案</a></li>
    </ul>
    <div class="tab_content">
<?
$id = "";
switch($tab)
{
	case 'news':$id = 'content';break;
	default:	$id = 'content2';break;
}
?>
      <div id="<?=$id?>">
        <ul>    
<? 
if(is_array($list))
{
	foreach($list as $val)
	{
		if($tab=='news')
		{
?>
    	<li>
        <strong>【<?=$val->tname?>】</strong><?=$val->info?>
        <p>[<?=$val->ndate?>]</p>
        </li>
<?
		}
		else
		{
?>
    <li> 
    	<div class="logo"><img src="<?=$val->logo==''?'/images/logo_03.jpg':$val->logo?>" height="100px" /></div>
        <? /*<div class="people"><img src="<?=$val->pic_front==''?'/images/logo_05.jpg':$val->pic_front?>" /></div>*/?>
        <div class="info">
        	<p>联系人姓名:  <span><?=$is_login?('<a href="/index.php/contact/view/'.$val->u_id.'/1" target="_blank">'):''?><?=$val->u_name?><?=$is_login?'</a>':''?></span></p>
            <p>单位名称:  <span><?=$is_login?('<a href="/index.php/company/check_index/'.$val->c_id.'" target="_blank">'):''?><?=$val->c_name?><?=$is_login?'</a>':''?></span></p>
            <p>联系人职务:  <span><?=$val->position?></span></p>
            <p>单位分组名称:  <span><?=$val->typename?></span></p>
        </div>
    </li>
<?	
		}
		
	}
}
?>
        </ul>
        <div id="page"><?=$pages?></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<script>
function tab(str)
{
	$("#tab_name").val(str);
	$("#sel_form").submit();
}
</script>

