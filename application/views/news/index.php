<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>新闻管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">

<div class="ser_b">
	<form id="get_form" action="/index.php/news" method="post">
	  <label class="sizi">类 型：</label>
	  <select class="bzsr2" name="type" style="width:90px;" onchange="$('#get_form').submit();" >
		<option value="0">全部</option>
		<?=$type_opt?>
	  </select>
	  <label class="sizi">内 容：</label>
	  <input type="text" class="bzsr" name="info" value="<?=$where['info']?>" style="width:130px;" />
	  <label class="sizi">时 间：</label>
	  <input type="text" class="Wdate" name="start" value="<?=$where['start']?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;"/>
	  <label class="sizi" style="width:10px;">~</label>
	  <input type="text" class="Wdate" name="end" value="<?=$where['end']?>" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;"/>
	  <input type="submit" class="b_bnt01" value="查 询"/>
	  
	  <input type="button" class="b_bnt01" value="返 回" onclick="back()" style="float:right;"/>
	</form>
<form id="publish_form" action="/index.php/news/down" method="post">
	<input type="hidden" id="pdate" name="date" value="" />
</form>
</div>

<table cellpadding="0" cellspacing="0" class="biaozhun">
  <tr class="tab_tit">
    <td width="15%">新闻日期</td>
    <td width="10%">类 型</td>
    <td width="60%">新闻内容</td>
    <td width="15%">
    	<input name="" type="button" value="新增" class="s_bnt01" onClick="addInfo()"/>
    	<input name="" type="button" value="发布" class="s_bnt01" onClick="publish()"/>
    </td>
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
    <td colspan="4" style="height:1px; background-color:#333" />
  </tr>
  <tr>
    <td colspan="4" style="height:0px;" />
  </tr>
  <tr>
	<td><?=substr($v->ndate,0,10)?><input type="hidden" id="date_<?=$i?>" value="<?=$v->ndate?>"></td>
	<td><?=$types[$v->ntype]?></td>
	<td id="info_<?=$i?>" class="zhongdian" style="text-align:left"><?=$v->info?></td>
    <td>
		<input type="hidden" id="id_<?=$i?>" value="<?=$v->id?>" />
		<input type="hidden" id="type_<?=$i?>" value="<?=$v->ntype?>" />
		<input type="hidden" id="id_<?=$i?>" value="<?=$v->id?>" />
		<input name="" type="button" value="上移" class="s_bnt04_u" style="float:right;" onClick="mark(<?=$v->id?>,'up')">
		<input name="" type="button" value="下移" class="s_bnt04_d" style="float:right;" onClick="mark(<?=$v->id?>,'down')">
	    <input type="button" value="删除" class="s_bnt01 red" onClick='delInfo(<?=$v->id?>)' />
	    <input type="button" value="修改" class="s_bnt01 green" onClick="editInfo(<?=$i?>)" />
    </td>
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
<div class="newli" id="winregister" style="width:800px;">
<h3 id="div_title" style="width:800px;">NewsLetter--</h3>
<form id='sub_form' action="/index.php/news/add" method="post" onSubmit="return check();">
<input type="hidden" id="u_id" name="id" />
  <div class="nl_det" style="width:700px;">
    <label class="sizi">类 型：</label>
    <select class="bzsr2" id="u_type" name="type" >
		<option value="0">请选择</option>
		<?=$type_opt?>
	</select>
    <label class="sizi">时 间：</label>
    <input type="text" class="Wdate" name="ndate" width="120" value="<?=$where['start']?>" id="u_date" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"/>
    <p class="szts"><span></span></p>
    <!-- 加载编辑器的容器 -->
    <script id="info" name="info" type="text/plain" style="height:280px;"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('info',{
	    	initialHeight:300,
	    	initialFrameHeight:300,
	    	scaleEnabled:true
        });
    </script>
  </div>
  <div class="caozuo">
	  <input type="button" class="b_bnt01" value="保 存" onclick="subform();"/>
	  <input type="reset" class="b_bnt01" value="关 闭" onclick="hideDiv();"/>
  </div>
</form>

</div>
<script>
var form_act = 'add';
var add_num = 0;
function back()
{
	$('#get_form').attr('action', '/index.php/news/view');
	$("#get_form").submit();
}
function subform()
{
	var type = $('#u_type').val();
	var date = $('#u_date').val();
	var info = ue.getContent();
	if(type=='0')
	{
		alert('请选择新闻类型');
		return false;
	}
	if(date=='')
	{
		alert('请填写新闻时间');
		return false;
	}
	if(info=='')
	{
		alert('请填写新闻内容');
		return false;
	}
	if(form_act=='edit')
	{
		$('#sub_form').submit();
	}
	else
	{
		$.post(
			"/index.php/news/add",
			{
				type:type,
				ndate:date,
				info:info
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('新闻添加成功');
					add_num = add_num+1;
					
					var atime = getTime();
					if($('#d4321').val()==$('#d4322').val())
					{
						atime = $('#d4321').val()+atime.substring(10);
					}
					$('#u_date').val(atime);
					ue.execCommand('cleardoc');
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}
function hideDiv()
{
	if(add_num>0)
	{
		$("#get_form").submit();
	}
	else
	{
		$('#winregister').hide();$('#wincover').hide();
	}
}
function addInfo()
{
	form_act = 'add';
	var atime = getTime();
	if($('#d4321').val()==$('#d4322').val())
	{
		atime = $('#d4321').val()+atime.substring(10);
	}
	$('#div_title').html('NewsLetter--新建新闻');
	$('#sub_form').attr('action', '/index.php/news/add');
	$('#u_id').val('');
	$('#u_date').val(atime);
	$('#u_type').val('0');
	ue.execCommand('cleardoc');
	
	$('#down_form').hide();
	$('#sub_form').show();
	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(i)
{
	form_act = 'edit';
	$('#div_title').html('NewsLetter--修改新闻');
	$('#sub_form').attr('action', '/index.php/news/update');
	$('#u_id').val($("#id_"+i).val());
	$('#u_date').val($("#date_"+i).val());
	$('#u_type').val($("#type_"+i).val());
	ue.setContent($("#info_"+i).html());
	
	$('#down_form').hide();
	$('#sub_form').show();
	$('#wincover').show();
	$('#winregister').center();
}
function check()
{
}
function delInfo(id)
{
	if(confirm("确认删除该新闻吗？"))
	{
		$.post(
			"/index.php/news/delete",
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
function publish()
{
	if($("#d4321").val()==$("#d4322").val())
	{
		$("#pdate").val($("#d4321").val());
		$("#publish_form").submit();
	}
}
function getTime()
{
	var day=new Date();
	var Year=0;
	var Month=0;
	var Day=0;
	var Hour = 0;
	var Minute = 0;
	var Second = 0;
	var CurrentDate="";
	//初始化时间
	Year	= day.getFullYear();
	Month	= day.getMonth()+1;
	Day		= day.getDate();
	Hour	= day.getHours();
	Minute	= day.getMinutes();
	Second	= day.getSeconds();
  
	CurrentDate = Year + "-";
	if (Month >= 10 )
	{
		CurrentDate = CurrentDate + Month + "-";
	}
	else
	{
		CurrentDate = CurrentDate + "0" + Month + "-";
	}
	if (Day >= 10 )
	{
		CurrentDate = CurrentDate + Day ;
	}
	else
	{
		CurrentDate = CurrentDate + "0" + Day ;
	}
  
	if(Hour >=10)
	{
		CurrentDate = CurrentDate +" "+ Hour ;
	}
	else
	{
		CurrentDate = "0" + Hour ;
	}
	if(Minute >=10)
	{
		CurrentDate = CurrentDate + ":" + Minute ;
	}
	else
	{
		CurrentDate = CurrentDate + ":0" + Minute ;
	}		 
	if(Second>=10)
	{
		CurrentDate = CurrentDate + ":" + Second;
	}
	else
	{
		CurrentDate = CurrentDate + ":0" + Second;
	}
	return CurrentDate;
}
function mark(id,type)
{
	$.post(
		"/index.php/news/mark",
		{
			id:id,
			type:type
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				$("#get_form").submit();
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>