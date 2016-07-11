
<div id="content_c">
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
if(is_array($list))
{
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
			<? }}?>
		</table>
</div>
<div id="page" style="padding-left:176px;"> 
<?=$pages?>
</div>
