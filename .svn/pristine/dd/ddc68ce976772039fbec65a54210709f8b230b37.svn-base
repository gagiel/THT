<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<!-- 配置文件 -->
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>新闻发布</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
<div class="ser_b">
<form id='down_form' action="/index.php/news/publish" method="post" onsubmit="return check();">
  <div class="nl_det">
	<label class="sizi">发布日期：</label>
	<input type="text" class="Wdate" name="date" value="<?=$date?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" onchange="retime(this)"/>
	<input type="hidden" value="<?=date('Y-m-d')?>" id="d4322" />
	<p class="szts"><span></span></p>
    <!-- 加载编辑器的容器 top -->
    <script id="tinfo" name="tinfo" type="text/plain"><?=$top?></script>
    <!-- 实例化编辑器 top -->
    <script>
    var teditor = UE.getEditor('tinfo',{
    	toolbars:[['undo', 'redo', '|',  
                'simpleupload', 'date', 'time'  ,'test']],
    	initialHeight:100,
    	initialFrameHeight:100,
    	scaleEnabled:true
    });
    </script>
    <div class="cla_list CNLTreeMenu" id="CNLTreeMenu1" >
    <div>
    	[<a href="javascript:;" onclick="checkall(true)">全选</a>]
    	[<a href="javascript:;" onclick="checkall(false)">取消</a>]
    	[<a href="javascript:;" onclick="recheck()">反选</a>]
    </div>
    <div id="tree_div"></div>
    </div>
	<div style="height:100px;">
	<div style="float:right;">
    <!-- 加载编辑器的容器 footer -->
    <script id="finfo" name="finfo" type="text/plain"><?=$foot?></script>
    <!-- 实例化编辑器 footer -->
    <script>
    var feditor = UE.getEditor('finfo',{
    	toolbars:[],
    	initialHeight:90,
    	initialFrameHeight:90,
    	initialWidth:280,
    	initialFrameWidth:280,
    	scaleEnabled:true
    });
    </script>
    </div>
    <div style="float:right;">署名：</div>
    </div>
  </div>
  <div class="caozuo" style="width: 90%; position: relative; ">
	  <input type="button" class="b_bnt01" value="预 览" onclick="view()"/>
	  <input type="submit" class="b_bnt01" value="发 布" style=" position: absolute; right: 100px;"/>
	  <input type="button" class="b_bnt01" value=" 取 消" style=" position: absolute; right: 0;" onclick="location.href='/index.php/news'"/>
  </div>
</form>
  </div>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister" style="width:700px; height:450px;">
<h3 id="div_title" style="width:700px;">NewsLetter--发布预览</h3>
  <div class="nl_det" style="width:600px;">
    <!-- 加载编辑器的容器 -->
    <script id="einfo" name="einfo" type="text/plain"><font color="red">暂无内容</font></script>
    <!-- 实例化编辑器 -->
    <script>
    var editor = new UE.ui.Editor({
    	toolbars:[],
    	readonly:true,
    	initialHeight:300,
    	initialFrameHeight:300,
    	scaleEnabled:true
    });
    editor.render("einfo");
    </script>
  </div>
  <div class="caozuo" style="width:100px;">
	  <input type="reset" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
</div>

<script src="/js/tree.js" type="text/javascript" ></script>
<script>
var date = '<?=$date?>';
$(function() {
	var h = 155;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
	
	getData();
});
function check()
{
	var ids = '';
	$("input[name='tree[]']").each(function(){
		if(this.checked)
		{
			if(ids!='')ids += ",";
			ids += this.value;
		}
	});
	if(ids=='')
	{
		alert("请选择发布内容");
		return false;
	}
	return true;
}
function retime(obj)
{
	if(obj.value==date)
	{
		alert(4);
		return false;
	}
	getData(date);
}
//获取类型树
function getData()
{
	$.getJSON(
		"/index.php/news/down_data",
		{
			date: $("#d4321").val()
		},
		function (data) //回传函数
		{
			if($("#d4321").val()!=date)
			{
				teditor.setContent(data.top);
				feditor.setContent(data.foot);
				
				date = $("#d4321").val();	
			}
			$("#tree_div").html(data.tree);
		}
	);
}
function checkone(obj)
{
	var checked = obj.checked;
	var a = obj.parentNode;
	var li=a.parentNode;
	if(checked)//勾选时，如果存在上级目录，一并勾选
	{
		var ul=li.parentNode;
		if(ul.parentNode.id=='tree_div')//最上级目录
		{
			return;
		}
		
		var pli = ul.parentNode;
		for(var i=0;i<pli.childNodes.length;i++)
		{
			if(pli.childNodes[i].className=="check_a")
			{
				var p_checkbox = pli.childNodes[i].childNodes[0];
				p_checkbox.checked = checked;
				checkone(p_checkbox);
			}
		}
	}
	else//勾去时，下级目录都要勾去
	{
		for(var i=0;i<li.childNodes.length;i++)
		{
			if(li.childNodes[i].className=="tree_ul")
			{
				cul = li.childNodes[i];
				for(var j=0;j<cul.childNodes.length;j++)
				{
					cli = cul.childNodes[j];
					for(var k=0;k<cli.childNodes.length;k++)
					{
						if(cli.childNodes[k].className=="check_a")
						{
							var c_checkbox = cli.childNodes[k].childNodes[0];
							c_checkbox.checked = checked;
							checkone(c_checkbox);
						}
					}
				}
			}
		}
	}
}
function view()
{
	var ids = '';
	$("input[name='tree[]']").each(function(){
		if(this.checked)
		{
			if(ids!='')ids += ",";
			ids += this.value;
		}
	});
	$.post(
		"/index.php/news/publish_view",
		{
			date:date,
			ids:ids
		},
		function (data) //回传函数
		{
			editor.setContent(teditor.getContent() + data + feditor.getContent());
			
			$('#wincover').show();
			$('#winregister').center();
		}
	);
}
function checkall(check)
{
	$("input[name='tree[]']").each(function(){
		this.checked=check;
	});
}
function recheck()
{
	$("input[name='tree[]']").each(function(){
		this.checked=!this.checked;
	});
}
function markUp(obj)
{
	var li=obj.parentNode;
	var ul=li.parentNode;
	var rowIdx=0;
	for(var i=0;i<ul.childNodes.length;i++){
		if(ul.childNodes[i]==li){
			rowIdx=i;
			break;
		}
	}
	if(rowIdx==0)return;
	var preLi=ul.childNodes[rowIdx-1];
	ul.insertBefore(li,preLi);
}
function markDown(obj)
{
	var li=obj.parentNode;
	var ul=li.parentNode;
	var rowIdx=0;
	for(var i=0;i<ul.childNodes.length;i++){
		if(ul.childNodes[i]==li){
			rowIdx=i;
			break;
		}
	}
	if(rowIdx==ul.childNodes.length-1)return;
	var nextLi=ul.childNodes[rowIdx+1];
	ul.insertBefore(nextLi,li);
}
</script>
