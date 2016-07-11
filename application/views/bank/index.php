<?php 
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
?>
<div class="maincon">
	<div class="sst_bg">
		<p>当前位置：首页&gt;易融资&gt;信贷业务管理</p>
		<div class="sst_sm"><?=$select?></div>
	</div>
	<div class="con_detail">
		<div class="ser_b" style=" position: relative;">
				<? if(in_array('26',$arr_jurisdict)){ ?>
				<input type="button" class="b_bnt01" value="新 增" onClick="addInfo()" />
				<input type="button" class="b_bnt01" value="删除" onclick="delInfo()" />
				<form  method="post" id="index_option" style="float: right;">
				<? }else{  ?>
				<form  method="post" id="index_option" >
				<?php 
				}
				?>
			    <label class="sizi">银行名称：</label> 
				<input type="text" class="bzsr" name="name" value="<?=$where['name']?>" style="width:100px;" /> 
				<input type="submit" class="b_bnt01" value="查 询" />
				<p style=" float: left; color: #217bb1; line-height: 37px; margin-left: 10px; ">
					共搜索到<span style="margin: 0 5px; "><?=$num?></span>条信息
                </p>
			</div>
		</form>
		<table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td width="6%">
				<? if(in_array('26',$arr_jurisdict)){ ?>
					<input onclick="selectAll()" type="checkbox" name="controlAll" style="controlAll" id="controlAll" />
				<? } ?>
				</td>
				<td width="10%">银行名称</td>
				<td width="32%">联系人</td>
				<td width="32%">联系人手机</td>
				<td width="32%">联系人电话</td>
			</tr>
			<?php 
			foreach ($list as $v)
			{
			?>
			<tr>
			  <td colspan="5" style="height:1px; background-color:#333" />
			</tr>
			<tr>
				<td width="6%">
					<? if(in_array('26',$arr_jurisdict)){ ?>
						<input type="checkbox" name="selected" value="1" id="<?=$v->id?>" />
					<? } ?>
				</td>
				<td width="10%" class="zhongdian" style="cursor: pointer;" onclick="window.location.href='/index.php/bank/view/<?=$v->id?>/<?=$page?>'"><?=$v->name?></td>
				<td width="20%" class="tip" style="position: relative;"><?=$v->contact?></td>
				<td width="20%" class="tip" style="position: relative;"><?
					$str =  explode(';',$v->mobile);
					echo $str['0'].(isset($str[1])?'...':'');
					?>
					<div class="dygfd_tit"><?=$v->mobile?></div>
				</td>
				<td width="20%" class="tip" style="position: relative;"><?
					$str =  explode(';',$v->tel);
					echo $str['0'].(isset($str[1])?'...':'');
					?>
					<div class="dygfd_tit"><?=$v->tel?></div>
				</td>
			</tr>
			<? }?>
			<!--
			<tr>
				<td colspan="5">
					<input name="" type="button" value="删除" class="s_bnt03 red" onclick="delInfo()" />
				</td>
			</tr>
			  -->
		</table>
		<div class="sabrosus"><?=$pages?></div>
	</div>
</div>
<script>

//每一行分别显示隐藏框
$(".tip").mouseenter(function(){
        var $thistd = $(this);
        if($thistd.find('.dygfd_tit').text().indexOf(',')>0){
                $thistd.find('.dygfd_tit').show();
        }
}).mouseleave(function(){
        var $thistd = $(this);
        $thistd.find('.dygfd_tit').hide();
});

function delInfo()
{
	var ids = '0';
	$("input[name='selected']:checked").each(function(){
		ids += ','+$(this).attr("id");
	});
	if(ids!=0)
	{
		if(confirm("确认删除这些数据吗？"))
		{
			$.post(
				"/index.php/bank/delete",
				{
					ids:ids
				},
				function (data) //回传函数
				{
					alert(data);
					if(data=='删除成功')
					{
						$("#index_option").submit();
					}
				}
			);
		}
	}
}

function addInfo(){
	window.location.href = '/index.php/bank/add';
}
/* 实现全选 */
function selectAll(){
	var checklist = document.getElementsByName ("selected");
	if(document.getElementById("controlAll").checked)
	{
		for(var i=0;i<checklist.length;i++)
		{
			checklist[i].checked = 1;
		}
	}else{
		for(var j=0;j<checklist.length;j++)
		{
			checklist[j].checked = 0;
		}
	}
}
</script>

