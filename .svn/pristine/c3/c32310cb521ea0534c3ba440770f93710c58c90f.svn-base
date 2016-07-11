<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>活动方案>方案管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">

	<div class="ser_b">
	<input type="button" class="b_bnt01" value="新 增" onClick="addInfo()" />
	<input type="button" class="b_bnt01" value="导 入" onClick="exportInfo()" />
	<input type="button" class="b_bnt01" value="导 出" onClick="downloadInfo()" />
	<input type="button" class="b_bnt01" value="导 出excel" onClick="exportPlanToExcel()" />
	<input type="button" class="b_bnt01" value="删 除" onClick="delInfo()" />
	<form id="get_form" action="/index.php/plan/index" method="post" style="float: right;">
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
	    <td width="15%">编 号</td>
	    <td width="35%">标 题</td>
	    <td width="15%">时 间</td>
	    <!-- <td width="25%">
	    	<input name="" type="button" value="新增" class="s_bnt01"/>
	    </td> -->
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
		<td><?=$v->num?></td>
		<td onclick="editInfo(<?=$v->id?>);" class="zhongdian" style="text-align:left;cursor:pointer;"><?=$v->title?></td>
		<td><?=$v->start?></td>
	    <!-- <td>
	    	<input type="button" value="发短信" class="s_bnt01 red" onClick='sendmessage(<?=$v->id?>)' />
			<input type="button" value="导出" class="s_bnt01 red" onClick='downloadInfo(<?=$v->id?>)' />
			<input type="button" value="删除" class="s_bnt01 red" onClick='delInfo(<?=$v->id?>)' />
	    	<input id="state_<?=$v->id?>" type="button" value="<?=$v->state=='1'?'撤销':'发布'?>" class="s_bnt01" onClick="publish(<?=$v->id?>,<?=$v->state?>)"/>
		<input type="button" value="准备" class="s_bnt01 green" onClick="editReady(<?=$v->id?>)" />
	    </td> -->
	  </tr>
	<?
		}
	}
	?>
	</table>
	<div class="sabrosus"><?=$pages?></div>
  </div>
</div>


<div id="wincover"></div>
<div class="newli" id="winregister" style="width:600px">
  <h3 id="div_title">新增方案--选择</h3>
  <div class="nl_det">
    <!-- 选择上传附件 -->
      <div id="file_div" class="CNLTreeMenu1" style="height:50px; display: none">
		<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
	    <form action="/index.php/plan/addCsvFile" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame">
	    <label class="sizi">csv文件：</label>
        <input type='text' class='bzsr' id='i_pic' style="width:150px;" value="" />
	    <input type='button' class='bnt01' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file').click();" />
	    <input type="file" class="file" name="i_file" id="i_file" onchange="$('#i_pic').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
	    <input type="submit" name="submit" class="bnt01" value="上传" style="margin:5px 5px 5px 0;" />
	     <a href="/index.php/plan/downloadfile/1" >注：csv文件模板下载</a>
	    <br>
	     <p class="szts"><span></span></p>
	    </form>
	   <form action="/index.php/plan/addZipFile" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame">
	    <label class="sizi">附件：</label>
	     <input type='text' class='bzsr' id='i_pic1' style="width:150px;" value="" />
	    <input type='button' class='bnt01' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file1').click();" />
	    <input type="file" class="file" name="i_file1" id="i_file1" onchange="$('#i_pic1').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
	    <input type="submit" name="submit" class="bnt01" value="上传" style="margin:5px 5px 5px 0;" />
	    <a href="/index.php/plan/downloadfile/2" >注：上传附件说明文档下载</a>
	    <p class="szts"><span></span></p>
	    </form>

       </div>
	   <div id="excel_div" class="CNLTreeMenu1" style="height:50px; display: none">
		   <form id="get_form_ex" action="/index.php/plan/exportPlanToExcel" method="post">
			   <label class="sizi">时 间：</label>
			   <input type="text" class="bzsr" name="start_ex" value="<?=isset($where['start'])?$where['start']:''?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;"/>
			   <label class="sizi" style="width:10px;">~</label>
			   <input type="text" class="bzsr" name="end_ex" value="<?=isset($where['end'])?$where['end']:''?>" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;"/>
		   </form>
	   </div>
	   <div id="plan_div" class="CNLTreeMenu1" style=" display: none">
			<input type="radio" name="plan_type" value="1">单日方案
		    <input type="radio" name="plan_type" value="2">多日方案
	   </div>
  </div>
  <div class="caozuo" id="btn_win_div">
    <input type="button" class="b_bnt01" value="确 定" id="btn_win_save" onclick="save()" />
    <input type="button" class="b_bnt01" value="关 闭" id="btn_win_close" onclick="closeWin()" />
  </div>
</div>

<script>
function addInfo()
{
	$("#div_title").html("选择方案类型");
	$('#file_div').hide();
	$('#plan_div').show();
	$('#wincover').show();
	$('#btn_win_save').attr('onclick','choose_plan()');
	$('#winregister').center();
//	location.href="/index.php/plan/add";
}
//选择多日与单日方案
function choose_plan(){
	var i=$("input[name='plan_type']:checked").val();
	if(i=='1'){
		location.href="/index.php/plan/add";
	}else if(i=='2'){
		location.href="/index.php/plan/add_more";
	}else{
		alert('没有选择方案类型');
	}
	closeWin();
}
function editInfo(id)
{
	location.href="/index.php/plan/edit_1/"+id;
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
		alert('请选择方案进行删除');
		return false;
	}else{
		$.post(
			"/index.php/plan/delete",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('删除成功');
					$("#get_form").submit();
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}

function exportInfo(){
	$("#div_title").html("导入方案");
	$('#file_div').show();
	$('#excel_div').hide();
	$('#wincover').show();
	$('#btn_win_save').attr('onclick','save()');
	$('#winregister').center();
}
function exportPlanToExcel(){
	$("#div_title").html("导出方案EXCEL");
	$('#file_div').hide();
	$('#excel_div').show();
	$('#wincover').show();
	$('#btn_win_save').attr('onclick','save_ex()');
	$('#winregister').center();
//	var id = '';
//	$('[name="ids[]"]').each(function(){
//		if(this.checked)
//		{
//			if(id!='')id += ',';
//			id += $(this).val();
//		}
//	});
//	if(id==''){
//		alert('请选择方案进行导出');
//		return false;
//	}else{
//		$.post("/index.php/plan/exportPlanToExcel",{id:id},function(response){
//			window.location.href="/index.php/plan/downloadPlan_e";
//			//window.location.href="/index.php/plan/exportPlanToExcel";
//		});
//	}
}
function downloadInfo(){
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
		alert('请选择方案进行导出');
		return false;
	}else{
		$.post("/index.php/plan/exportPlanToWord",{id:id},function(data){
				if(data['status']!= false){ //导出word成功弹出下载保存框
					window.location.href = '/index.php/plan/downloadPlan?wordname='+data['filename']+'&filedir='+data['filedir'];
				}

		},'json');
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

function save(){
	var i_pic = $('#i_pic').val();
	var i_pic1 = $('#i_pic1').val();
	$.post('/index.php/plan/exportPlan',{i_pic:i_pic,i_pic1:i_pic1},function(data){
		alert(data);
		closeWin();
	});

}
function save_ex(){
	var start=$('input[name="start_ex"]').val();
	var end = $('input[name="end_ex"]').val();
	var data ={
		start:start,
		end:end,
	};

	$.post("/index.php/plan/exportPlanToExcel",data,function(response){
		if(response=='file'){
			alert('选择的时间段内无可导出内容');
		}else{
			window.location.href="/index.php/plan/downloadPlan_e";
			alert('导出成功');
			//window.location.href="/index.php/plan/exportPlanToExcel";
		}

		closeWin();
	});

}
function closeWin()
{
	$('#file_div').hide();
	$('#excel_div').hide();
	$('#winregister').hide();
	$('#plan_div').hide();
	$('#wincover').hide();
}

//上传图片后，返回显示
function pic_back(re)
{
	if(re=='false')
	{
		alert('文件上传失败');
	}
	else
	{
        var retu=re.split(",");
		$("#i_pic").val(retu[1]);
		$("#i_pic").attr("filename",retu[0]);
	}
}

function pic_back1(re){
	if(re=='false')
	{
		alert('文件上传失败');
	}
	else
	{
        var retu=re.split(",");
		$("#i_pic1").val(retu[1]);
		$("#i_pic1").attr("filename",retu[0]);
	}
}

</script>