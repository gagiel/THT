<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>短信推送</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  
    <div class="ser_b">
	<label class="sizi">标 题：</label>
	<input type="text" class="bzsr" id="title" name="title" value="NewsLetter(<?=$date?>)" />
	<form id='sub_form' method="post">
	<label class="sizi">日 期：</label>
	<input type="text" class="Wdate" name="date" value="<?=$date?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" onchange="retime(this)"/>
	<input type="hidden" value="<?=date('Y-m-d')?>" id="d4322" />
	
	<label class="sizi">上期回顾</label>
	<input type="checkbox" class="bzsr" id="yesterday" name="yesterday" value="1" <?=$yesterday=='1'?'checked="checked"':''?> style="width:30px;" onclick="$('#sub_form').submit();" />
	</form>
	<input type="button" class="b_bnt01" value="返 回" onclick="location.href='/index.php/news/down'" style="float:right;"/>
    </div>
    
    <div class="ser_b">
	<label class="sizi">彩信推送：</label>
	<label class="sizi">测试号码：</label>
	<input type="text" class="bzsr" id="tel" name="tel" style="width:130px;" />
	<input type="button" class="b_bnt01" value="推送测试" <?=$info==''?' style="color:#aaa" disabled="true"':'onclick="send(true);"'?> />
	<label class="sizi">&nbsp;</label>
    <label class="sizi">推送分组：</label>
      <select class="bzsr2" id="group">
        <option value="">请选择</option>
<?
if(is_array($groups))
{
	foreach($groups as $v)
	{
?>
        <option value="<?=$v->id?>"><?=$v->name?></option>
<?
	}
}
?>
        <option value="-1">全部</option>
      </select>
	<input type="button" class="b_bnt01" value="推 送" <?=$info==''?' style="color:#aaa" disabled="true"':'onclick="send(false);"'?>/>	
    </div>

    <div style=" width: 90%; margin: 0 auto; position: relative; top: 0px;">
    <!-- 加载编辑器的容器 -->
    <script id="info" name="info" type="text/plain"><?=$info==''?'<font color="red">暂无推送内容</font>':$info?></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
    </script>
    </div>
  </div>
</div>
<script>
function retime(obj)
{
	if(obj.value=='<?=$date?>')
	{
		return false;
	}
	$("#sub_form").submit();
}
function send(test)
{
	var title = $("#title").val();
	if(title=='')
	{
		alert("请填写标题");
		return false;
	}
	var msg = "确认推送吗？";
	var tel = "";
	var group="";
	if(test)
	{
		msg = "确认测试推送吗？";
		tel = $("#tel").val();
		if(tel=='')
		{
			alert("请填写彩信推送测试号码");
			return false;
		}
	}
	else
	{
		group = $("#group").val();
	}
	var yesterday = 0;
	if($("#yesterday").attr("checked")=='checked')
	{
		yesterday = 1;
	}
	if(confirm(msg))
	{
		$.post(
			"/index.php/news/send",
			{
				test:test,
				title:title,
				tel:tel,
				group:group,
				sdate:$("#d4321").val(),
				yesterday:yesterday
			},
			function (data) //回传函数
			{
				alert(data);
			}
		);
	}
}

$(function(){
    var editor = new UE.ui.Editor({
    	toolbars:[],
    	readonly:true,
    	initialHeight:$('.con_detail').height()-150,
    	initialFrameHeight:$('.con_detail').height()-150,
    	scaleEnabled:true
    });
    editor.render("info");
});
</script>