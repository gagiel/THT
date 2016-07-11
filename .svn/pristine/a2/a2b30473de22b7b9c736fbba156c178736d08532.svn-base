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
            <?php 
           if(is_array($list))
{
               if($tab=='news'){
                 foreach($list as $val){
                   ?>
            <li>
           <strong>【<?=$val->tname?>】</strong><?=$val->info?>
           <p>[<?=$val->ndate?>]</p>
           </li>
                       <?php  
                 }  
               }else{?>
               <table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td width="10%">联系人姓名
				</td>
				<td width="32%">单位名称	
				</td>
				<td width="32%">联系人职务	
				</td>
				<td width="20%">单位分组	
				</td>
			</tr>
			<? 

	foreach($list as $val)
	{
		
?>
			<tr>
			  <td colspan="4" style="height:1px; background-color:#333" />
			</tr>
			<tr>			
				<td width="15%" class="tip" style="position: relative;">
					<?=$is_login?('<a href="/index.php/contact/view/'.$val->u_id.'/1" target="_blank">'):''?><?=$val->u_name?><?=$is_login?'</a>':''?>
				</td>
				<td width="25%" class="tip" style="position: relative;">
					<?=$is_login?('<a href="/index.php/company/check_index/'.$val->c_id.'" target="_blank">'):''?><?=$val->c_name?><?=$is_login?'</a>':''?>
				</td>
				<td width="25%" class="tip" style="position: relative;">
					<?=$val->position?>
				</td>
                                <td width="35%" class="tip" style="position:relative;">
                                    <?=$val->typename?>
                                </td>
			</tr>
			<? }?>
		</table>
                   <?php 
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

