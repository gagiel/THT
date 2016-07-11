<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>工作提醒>提醒管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  
	<div class="ser_b">
	  <form id="get_form" action="/index.php/remind/manage" method="post">
	    <label class="sizi">时 间：</label>
	    <input class="Wdate" name="start" value="<?=$where['start']?>" id="d4321" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" type="text">
	    <label class="sizi" style="width:10px;">~</label>
	    <input class="Wdate" name="end" value="<?=$where['end']?>" id="d4322" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;" type="text">
	        
	    <label class="sizi">提醒内容：</label>
	    <input class="bzsr" name="info" value="<?=$where['info']?>" style="width:130px;" type="text">
	
	    <input class="b_bnt01" value="查 询" type="submit">
	  </form>
	</div>
	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tbody>
	    <tr class="tab_tit alt">
	      <td width="30%">提醒时间</td>
	      <td width="45%">提醒内容</td>
	      <td width="8%">操作人</td>
	      <td width="18%"><input name="name" value="新增" class="s_bnt01" onclick="addInfo()" type="button">
	        </td>
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
	    <tr class="alt" <? if($v->t_end<date('Y-m-d H:i:s'))echo 'style="text-decoration:line-through; color:#aaa;"';?>>
	      <td onclick="reader(<?=$i?>);"><label id="start_<?=$i?>"><?=substr($v->t_start,0,-3)?></label> ~ <label id="end_<?=$i?>"><?=substr($v->t_end,0,-3)?></label></td>
	      <td onclick="reader(<?=$i?>);" id="info_<?=$i?>" style="text-align:left;"><?=$v->info?></td>
	      <td onclick="reader(<?=$i?>);"><?=empty($u_name[$v->userid])?'':$u_name[$v->userid]?></td>
	      <td>
	        <input type="hidden" id="id_<?=$i?>" value="<?=$v->id?>" />
	        <input type="hidden" id="rt_<?=$i?>" value="<?=$v->range_type?>" />
	        <input type="hidden" id="ru_<?=$i?>" value="<?=$v->range_user?>" />
	        <input type="button" class="s_bnt01 red" value="删除" onclick="delInfo(<?=$i?>)">
	        <input type="button" class="s_bnt01 green" value="修改" onclick="editInfo(<?=$i?>)">
	        <input type="button" class="s_bnt01" id="state_<?=$i?>" value="<?=$v->state==1?'撤销':'发布'?>" class="s_bnt01" onclick="stateInfo(<?=$i?>,<?=$v->state==1?'2':'1'?>)">
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
<div class="newli" id="winregister">
  <h3 id='div_title'>提醒管理--</h3>
  <form id="reader_form">
  	<div style="height:300px; overflow:auto;">
  	<table cellpadding="0" cellspacing="0" class="biaozhun" style="min-width:400px;" id="reader_table">
	  <tbody>
	    <tr class="tab_tit alt">
	      <td width="30%">人员</td>
	      <td width="50%">阅读时间</td>
	      <td width="20%">状态</td>
	    </tr>
	  </tbody>
	</table>
	</div>
	<div class="caozuo" style="width:100px;">
	  <input type="reset" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();"/>
	</div>
  </form>
  <form id='edit_form'>
  <div class="nl_det">
  	<input type="hidden" id="remind_id" value="" />
  	<!-- 新增窗口内容区  -->
      <label class="sizi">提 醒 时 间：</label>
      <input class="Wdate" style="width:130px;" name="start" value="" id="d_start" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d_end\',{d:0});}'})" style="width:100px;" type="text">
      <label class="sizi" style="width:10px;">~</label>
      <input class="Wdate" style="width:130px;" name="end" value="" id="d_end" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d_start\',{d:0});}'})" style="width:100px;" type="text">
    <p class="szts"></p>
      <label class="sizi">提 醒 内 容：</label>
      <textarea class="textarea" id="info" name="info"></textarea>
    <p class="szts"></p>
      <div id="srdbox">
        <label class="sizi">提 醒 范 围：</label>
        <input type="radio" class="radio" id="range1" name="range" value="1" onclick="sboxshow(1)" checked="checked" />部分人员
        <input type="radio" class="radio" id="range2" name="range" value="2" onclick="sboxshow(2)" />全部人员
        <input type="radio" class="radio" id="range3" name="range" value="3" onclick="sboxshow(3)" />对外 
      </div>
    <p class="szts"></p>
      <div id="range_div">
        <input type="button" class="onclick_btn" value="全选" onclick="checkall(true)" />
        <input type="button" class="onclick_btn" value="反选" onclick="recheck()" />
        <input type="button" class="onclick_btn" value="取消" onclick="checkall(false)" />
        <ul class="ul_department" style="height:200px; overflow: auto;">
          <? 
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li>
            <input type="checkbox" name="range_department" id="d_<?=$i?>" value="<?=$d->id?>" onclick="change(<?=$i?>,this.checked);"/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
            <ul class="ul_user">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <input type="checkbox" name="range_user" id="u_<?=$j?>" value="<?=$u->id?>" class="check_<?=$i?>" />
              <span onClick="$('#u_<?=$j?>').click();"><?=$u->name?></span>
            </li>
            <?
            		}
            ?>
            </ul>
          </li>
            <?
            	}
          	}
        }
          ?>
    </div>
  </div>
  <div class="caozuo">
	<input type="button" class="b_bnt01" value="保 存" onclick="info_form_submit()" />
	<input type="reset" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
  </form>
</div>
<script>
var act = "add";
var edit_i = 0;
function reader(i)
{
	$.post(
		"/index.php/remind_r/reader",
		{
			id:$("#id_"+i).val()
		},
		function (data) //回传函数
		{
			if($("#reader_table tr").length>1){
				for(var t=1;t<$("#reader_table tr").length;t++){
					$("#reader_table").find("tr").eq(t).remove();
				}
			}
			
			var jsonarray= $.parseJSON(data);
			if(jsonarray.state=='true')
			{
				$('#div_title').html('提醒管理--阅读人员');
				for(var k=0;k<jsonarray.data.length;k++){
					var t_data = jsonarray.data[k];
					var str = "<tr>";
					str += "<td>"+t_data.name+"</td>";
					str += "<td>"+t_data.addtime+"</td>";
					if(t_data.state=='1'){
						str += "<td>已阅读</td>";
					}
					else if(t_data.state=='2'){
						str += "<td>不再提醒</td>";
					}
					else
					{
						str += "<td></td>";
					}
					str += "</tr>";
					$("#reader_table").append(str);
				}
				
				$('#edit_form').hide();
				$('#reader_form').show();
				$('#wincover').show();
				$('#winregister').center();
			}
			else
			{
				alert(jsonarray.msg);
			}
		}
	);
}
function addInfo()
{
	$('#div_title').html('提醒管理--新建提醒');
	$("#id").val('');
	$("#d_start").val('');
	$("#d_end").val('');
	$("#info").val('');
	$("#range1").click();
	checkall(false);
	act = "add";
	
	$('#reader_form').hide();
	$('#edit_form').show();
	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(i)
{
	$('#div_title').html('提醒管理--新建提醒');
	$("#remind_id").val($("#id_"+i).val());
	$("#d_start").val($("#start_"+i).html());
	$("#d_end").val($("#end_"+i).html());
	$("#info").val($("#info_"+i).html());
	var rt = $("#rt_"+i).val();
	$("#range"+rt).click();
	checkall(false);
	act = "update";
	edit_i = i;
	
	if(rt=='1')
	{
		var ru = $("#ru_"+i).val();
		var arr = ru.split(",");
		$('input[name="range_user"]').each(function(){
			for(var i in arr){
				if(this.value==arr[i])
				{
					this.checked=true;
				}
			}
		});
	}
	
	$('#reader_form').hide();
	$('#edit_form').show();
	$('#wincover').show();
	$('#winregister').center();
}
function info_form_submit()
{
	var info	= $('#info').val();
	var start	= $('#d_start').val();
	var end		= $('#d_end').val();
	var range	= $('input[name="range"]:checked').val();
	var user	= '';
	if(start=='' || end=='')
	{
		alert('请填写提醒时间');
		return false;
	}
	if(info=='')
	{
		alert('请填写提醒内容');
		return false;
	}
	if(range=='1')
	{
		$('input[name="range_user"]').each(function(){
			if(this.checked)
			{
				if(user!='')user += ',';
				user += $(this).val(); 
			}
		});
		if(user=='')
		{
			alert('请选择提醒人员');
			return false;
		}
	}
	$.post(
		"/index.php/remind_r/"+act,
		{
			id		: $("#remind_id").val(),
			start	: start,
			end		: end,
			info	: info,
			range	: range,
			user	: user
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				if(act=='add')
				{
					alert('提醒添加成功');
					
				}
				else
				{
					alert('提醒修改成功');
				}
				$("#get_form").submit();
			}
			else
			{
				alert(data);
			}
		}
	);
}
function delInfo(i)
{
	if(confirm("确认删除该提醒吗？"))
	{
		$.post(
			"/index.php/remind_r/delete",
			{
				id:$("#id_"+i).val()
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
function stateInfo(i,state)
{
	var msg = "该提醒吗？";
	if(state==1)
	{
		msg = "确认发布"+msg;
	}
	else
	{
		msg = "确认撤销"+msg;
	}
	if(confirm(msg))
	{
		$.post(
			"/index.php/remind_r/state",
			{
				id:$("#id_"+i).val(),
				state:state
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('操作成功');
					if(state==1)
					{
						$("#state_"+i).val('撤销');
						$("#state_"+i).attr('onclick','stateInfo('+i+',2)');
					}
					else
					{
						$("#state_"+i).val('发布');
						$("#state_"+i).attr('onclick','stateInfo('+i+',1)');
					}
					
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}
//单选钮控制选择区显隐
function sboxshow(range){
	if(range==1)
	{
		$('#range_div').show();
	}
	else
	{
		$('#range_div').hide();
	}
}
//全选、取消全部
function checkall(check)
{
	$("input[type='checkbox']").each(function(){
		this.checked=check;
	});
}
//反选
function recheck()
{
	$("input[type='checkbox']").each(function(){
		this.checked=!this.checked;
	});
}

function change(i,checked) {
	$("input[type='checkbox']").each(function(){
		if(this.className=='check_'+i)
		this.checked=checked;
	});
}
</script>