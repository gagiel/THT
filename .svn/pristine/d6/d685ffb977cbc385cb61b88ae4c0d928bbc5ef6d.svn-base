<?php 
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
?>
<div class="maincon">
	<div class="sst_bg">
		<p>当前位置：首页&gt;名片系统&gt;内部名片管理</p>
		<div class="sst_sm"><?=$select?></div>
	</div>
	<div class="con_detail">
		<div class="ser_b" style=" position: relative;">
				<? if(in_array('23',$arr_jurisdict)){ ?>
				<input type="button" class="b_bnt01" value="新 增" onClick="addInfo()" />
				<input type="button" class="b_bnt01" value="删除" onclick="delInfo()" />
				<form  method="post" id="index_option" style="float: right;">
				<? }else{  ?>
				<form  method="post" id="index_option" >
				<?php 
				}
				?>
			    <label class="sizi">关键字：</label> 
				<input type="text" class="bzsr" name="value" value="<?=$where['value']?>" style="width:100px;" /> 
				<input type="submit" class="b_bnt01" value="查 询" />
				<p style=" float: left; color: #217bb1; line-height: 37px; margin-left: 10px; ">
					共搜索到<span style="margin: 0 5px; "><?=$num?></span>条名片系统信息
                </p>
			</div>
		</form>
		<table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td width="6%">
				<? if(in_array('23',$arr_jurisdict)){ ?>
					<input onclick="selectAll()" type="checkbox" name="controlAll" style="controlAll" id="controlAll" />
				<? } ?>
				</td>
				<td width="10%">姓 名</td>
				<td width="32%">单位名称</td>
				<td width="32%">单位地址</td>
				<td width="32%">职 务</td>
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
					<? if(in_array('23',$arr_jurisdict)){ ?>
						<input type="checkbox" name="selected" value="1" id="<?=$v->id?>" />
					<? } ?>
				</td>
				<td width="10%" class="zhongdian" style="cursor: pointer;" onclick="window.location.href='/index.php/contact/view1/<?=$v->id?>/<?=$page?>'"><?=$v->name?></td>
				<td width="35%" class="tip" style="position: relative;"><?=$v->cname?></td>
				<td width="35%" class="tip" style="position: relative;"><?=$v->address?></td>
				<td width="20%" class="tip" style="position: relative;"><?
					$str =  explode(',',$v->position);
					echo $str['0'].(isset($str[1])?'...':'');
					?>
					<div class="dygfd_tit"><?=$v->position?></div>
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
$("#typename_option").change(function(){
	$("#index_option").submit();
})
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

function order(field,type)
{
	$('#order_field').val(field);
	$('#order_type').val(type);
	$('#index_option').submit();
}

function delInfo()
{
	var ids = '0';
	$("input[name='selected']:checked").each(function(){
		ids += ','+$(this).attr("id");
	});
	if(ids!=0)
	{
		if(confirm("确认删除这些名片吗？"))
		{
			$.post(
				"/index.php/contact/delete1",
				{
					ids:ids
				},
				function (data) //回传函数
				{
					if(data=='success')
					{
						$("#index_option").submit();
					}
					else
					{
						alert(data);
					}
				}
			);
		}
	}
}

function addInfo(){
	window.location.href = '/index.php/contact/add1';
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

