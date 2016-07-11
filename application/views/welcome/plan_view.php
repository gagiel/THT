<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div id="content">
	<div class="ser_b">
		<form id='data_form' method="post">
			<input type="button" class="button_one" name="back" value="返回" onclick="history.back()" />
		</form>
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
    var editor = new UE.ui.Editor({
    	toolbars:[],
    	initialFrameHeight:$(window).height()-300,
    	readonly:true
    });
    editor.render("info");
    </script>
    </div>
</div>
<script>
function retime(obj)
{
	if(obj.value=='<?=$date?>')
	{
		return false;
	}
	$("#data_form").submit();
}
</script>
