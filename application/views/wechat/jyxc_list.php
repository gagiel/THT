<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>微信管理>建言献策</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tbody>
	    <tr class="tab_tit alt">
	      <td width="45%">建 议</td>
	      <td width="45%">回 复</td>
	      <td></td>
	    </tr>
<?
if(is_array($list))
{
	foreach($list as $k => $v)
	{
		$i = $k+1;
?>
	    <tr>
	      <td colspan="4" style="height:1px; background-color:#333"></td>
	    </tr>
	    <tr class="alt">
	      <td valign="top" style="text-align:left; padding:5px; border-right: 1px #000 solid;"><strong><?=$v['nikename']?></strong> [<?=date('Y-m-d H:i:s',$v['from_time'])?>]<br><spen id="info_<?=$i?>"><?=$v['from_info']?></spen><br>查询代码：<font color="blue"><?=$v['recode']?></font></td>
	      <td valign="top" style="text-align:left; padding:5px; border-right: 1px #000 solid;" id="retd_<?=$i?>"><?php if($v['re_user']!=''){?><strong><?=$v['re_uname']?></strong> [<?=date('Y-m-d H:i:s',$v['re_time'])?>]<br><spen id="reinfo_<?=$i?>"><?=$v['re_info']?></spen><?php }else{?><spen id="reinfo_<?=$i?>"></spen><?php }?></td>
	      <td>
	        <input type="hidden" id="id_<?=$i?>" value="<?=$v['id']?>" />
	        <input type="button" class="s_bnt01 green" value="回复" onclick="reInfo(<?=$i?>)" style="float:none; margin:0 auto; ">
	      </td>
	    </tr>
<?
	}
}
?>
	  </tbody>
	</table>
  </div>
</div>
<div id="wincover"></div>
<div class="newli" id="winregister" style="width:700px;">
  <h3 id='div_title'>建言献策--回复</h3>
  <div class="nl_det">
  	  <input type="hidden" id="m_id" value="" />
      <label class="sizi">内容：</label>
      <textarea id="m_info" rows="3" cols="60" disabled="true"></textarea>
      <p class="szts" style="height:5px"></p>
      <label class="sizi">回复：</label>
      <textarea id="m_reinfo" rows="3" cols="60"></textarea>
      <p class="szts"></p>
  </div>
  <div class="caozuo">
	<input type="button" class="b_bnt01" style="margin:5px" value="提 交" onclick="re_submit()" />
	<input type="reset" class="b_bnt01" style="margin:5px 0px;" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
</div>
<script>
var edit_i = 0;
function reInfo(i)
{
	$("#m_id").val($("#id_"+i).val());
	$("#m_info").val($("#info_"+i).html());
	$("#m_reinfo").val($("#reinfo_"+i).html());
	
	edit_i = i;
		
	$('#wincover').show();
	$('#winregister').center();
}
function re_submit()
{
	var re_info	= $('#m_reinfo').val();
	if(re_info=='')
	{
		alert('请填写回复内容');
		return false;
	}
	$.post(
		"/index.php/wechat/jyxc_re",
		{
			id		: $("#m_id").val(),
			info	: re_info
		},
		function (data) //回传函数
		{
			if(data.indexOf('|')>0)
			{
				var tmp = data.split("|"); 
				alert('回复成功');
				var rehtml = '<strong>' + tmp[1] + '</strong> ['+ tmp[2] +']<br><spen id="reinfo_' + edit_i + '">' + $("#m_reinfo").val() + '</spen>';
				$("#retd_"+edit_i).html(rehtml);
				$('#winregister').hide();
				$('#wincover').hide();
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>