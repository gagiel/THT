<?php 
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
?>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>查看内部名片</p>
    <div class="sst_sm">
      	<?=$select?>
    </div>
  </div>
  <div style="width: 80%; margin: 120px auto; padding-left: 50px; left:auto;position:fixed;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<? if(in_array('23',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	    <? } ?>
		
	</div>
	<div class="caozuo8">
		<? if(in_array('23',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/contact/edit1/<?=$id?>/<?=$thispage?>'" />
	    <? } ?>
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/contact/contact_manage/<?=$thispage?>'" value="back"/>
	</div>
  </div>
  <div class="con_detail" style="top:155px;">	
    <table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tr class="tab_tit">
		<td colspan="3">联系人信息</td>
	  </tr>
	  <tr> 
		<td width="8%" class="cklt">姓 名：</td>
		<td width="42%" class="cknr2"><?=$name?></td>
	  </tr>
	  <tr> 
	    <td colspan="4">
		  <table cellspacing="0" cellpadding="0" class="biaozhun2">
			<tr>
				<td width="7%" class="cklt">单位名称：</td>
				<td width="28%" class="cknr2"><?=$cname?></td>
				<td width="7%" class="cklt">单位地址：</td>
				<td width="15%" class="cknr2"><?=$address?></td>
                <td width="7%" class="cklt">邮编：</td>
				<td width="10%" class="cknr2"><?=$postcode?></td>
            </tr>
          </table>
		</td>
	  </tr>
	   <tr id="sjxx"> 
	    <td width="8%" class="cklt">职 务：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?=$position?>
  		</td>
	  </tr>
	  <tr id="sjxx"> 
	    <td width="8%" class="cklt">手 机：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?=$mobile?>
        </td>
	  </tr>
	  <tr>
	    <td width="8%" class="cklt">办公电话：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?=$tel?>
		</td>
	  </tr>
	   <tr>
	    <td width="8%" class="cklt">保密机：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?=$secret_code?>
		</td>
	  </tr>
	   <tr>
	    <td width="8%" class="cklt">宅 电：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?=$home_tel?>
		</td>
	  </tr>
	</table>
  </div>
  <div class="caozuo5" style="width: 80%; margin: 10px auto; padding-left: 50px; left:auto;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<? if(in_array('23',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	    <? } ?>
	</div>
	<div class="caozuo8">
		<? if(in_array('23',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/contact/edit1/<?=$id?>/<?=$thispage?>'" />
	    <? } ?>
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/contact/contact_manage/<?=$thispage?>'" value="back"/>
	</div>
  </div>
  
</div>
<script>

function delInfo(id)
{
	if(confirm("确认删除该联系人吗？"))
	{
		$.post(
			"/index.php/contact/del",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('删除成功');
					window.location.href='/index.php/contact/contact_manage';
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}
</script>

<script type="text/javascript">
$(function(){
	var h = 235;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
});
</script>