<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>推送分组管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  
<table cellpadding="0" cellspacing="0" class="biaozhun">
  <tr class="tab_tit">
    <td width="10%">分组名称</td>
    <td width="15%"><input name="" type="button" value="新增" class="s_bnt01" onClick="addInfo()"/></td>
  </tr>
<? 
if(is_array($list))
{
	$i = 0;
	foreach($list as $v)
	{
		$i++;
?>
  <tr>
	<td id="name_<?=$i?>"><?=$v->name?></td>
    <td>
		<input type="hidden" id="id_<?=$i?>" value="<?=$v->id?>" />
	    <input type="button" value="删除" class="s_bnt01 red" onClick='delInfo(<?=$v->id?>)' />
	    <input type="button" value="修改" class="s_bnt01 green" onClick="editInfo(<?=$i?>)" />
    </td>
  </tr>
<?
	}
}
?>
</table>


  </div>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister">
<h3 id="div_title">NewsLetter--</h3>
<form id='sub_form' action="/index.php/news/type_add" method="post">
<input type="hidden" id="u_id" name="id" />
  <div class="nl_det">
    <label class="sizi">分组名称：</label>
    <input type="text" class="bzsr" name="name" id="u_name" />
    <p class="szts"><span></span></p>
    <label class="sizi">组内号码：</label>
    <p class="szts"><span></span></p>
	<ul style="height:200px; max-height:200px; overflow:auto;">
<? 
if(is_array($sender)){
	foreach($sender as $v){
?>

	<li><input name="tels[]" id="tels_<?=$v->id?>" type="checkbox" value="<?=$v->id?>" /> <?=$v->name?> <?=$v->mobile?></li>
<?
	}
}
?>
	</ul>
  </div>
  <div class="caozuo">
	  <input type="submit" class="b_bnt01" value="保 存"/>
	  <input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
</form>
</div>
<script>
function addInfo()
{
	$('#div_title').html('NewsLetter--新建推送分组');
	$('#sub_form').attr('action', '/index.php/news/group_add');
	$('#u_id').val('');
	$('#u_name').val('');
	$("input[name='tels[]']").attr("checked",false);
	
	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(i)
{
	$('#div_title').html('NewsLetter--修改推送分组');
	$('#sub_form').attr('action', '/index.php/news/group_update');
	$('#u_id').val($("#id_"+i).val());
	$('#u_name').val($("#name_"+i).text());
	$.post(
		"/index.php/news/group_sender",
		{
			id:$("#id_"+i).val()
		},
		function (data) //回传函数
		{
			var arr = data.split(",");
			$("input[name='tels[]']").each(function(){
				var checked = false;
				for(var j=0; j<arr.length; j++)
				{
					if(arr[j]==$(this).val())
					{
						checked = true;
					}
				}
				this.checked=checked;
			});
			
		}
	);
	
	$('#wincover').show();
	$('#winregister').center();
}
function delInfo(id)
{
	if(confirm("确认删除该推送分组吗？"))
	{
		$.post(
			"/index.php/news/group_delete",
			{ 
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('删除成功');
					location.reload();
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