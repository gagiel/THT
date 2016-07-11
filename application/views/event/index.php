<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>大事记>大事记管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">

	<div class="ser_b">
	<input type="button" class="b_bnt01" value="新 增" onClick="addInfo()" />
	<input type="button" class="b_bnt01" value="删 除" onClick="delInfo()" />
	<form id="get_form" action="/index.php/event/index" method="post" style="float: right;">
	  <label class="sizi">标 题：</label>
	  <input type="text" class="bzsr" name="title" value="<?=isset($where['title'])?$where['title']:''?>" style="width:130px;" onchange="$('#get_form').submit();" />
	  <label class="sizi">时 间：</label>
	  <input type="text" class="Wdate" name="start" value="<?=isset($where['start'])?$where['start']:''?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" onchange="$('#get_form').submit();"/>
	  <label class="sizi" style="width:10px;">~</label>
	  <input type="text" class="Wdate" name="end" value="<?=isset($where['end'])?$where['end']:''?>" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;" onchange="$('#get_form').submit();"/>
	</form>
	</div>

	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tr class="tab_tit">
	    <td width="5%"><input type="checkbox" id="all" onclick="checkall()" /></td>
	    <td width="5%">时 间</td>
	    <td width="35%">标 题</td>
	  </tr>
	<? 
	if(is_array($list))
	{
		foreach($list as $v)
		{
	?>
	  <tr>
	    <td colspan="5" style="height:1px; background-color:#333" />
	  </tr>
	  <tr>
	    <td colspan="5" style="height:0px;" />
	  </tr>
	  <tr>
	    <td width="5%"><input name="ids[]" value="<?=$v->id?>" type="checkbox"/></td>
		<td><? echo ($v->date_type==1)?date('Y-m',$v->time):date('Y-m-d',$v->time)?></td>
		<td onclick="editInfo(<?=$v->id?>);" class="zhongdian" style="text-align:left;cursor:pointer;"><?=$v->title?></td>
	  </tr>
	<?
		}
	}
	?>
	</table>
	<div class="sabrosus"><?=$pages?></div>
  </div>
</div>

<script>
function addInfo()
{
	location.href="/index.php/event/add";
}
function editInfo(id)
{
	location.href="/index.php/event/edit/"+id;
}
function delInfo()
{
	var id = '';
	$('[name="ids[]"]').each(function(){
		if(this.checked)
		{
			if(id!='')id += ',';
			id += $(this).val(); 
		}
	});
	//alert(id);
	if(id==''){
		alert('请选择事记进行删除');
		return false;
	}else{
		$.post(
			"/index.php/event/delete",
			{
				id:id
			},
			function (data) //回传函数
			{
				alert(data);
				if(data=='删除成功')
				{
					$("#get_form").submit();
				}
			}
		);
	}
}


//全选、取消全部
function checkall()
{
	if($('#all').is(':checked')){
		$("input[type=checkbox]").each(function(){
			this.checked=true;
		});
	}else{
		$("input[type=checkbox]").each(function(){
			this.checked=false;
		});
	}
	
}





</script>