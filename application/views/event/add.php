<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页 > 大事记管理> 大事记管理 > 新增事记</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
   <div style="margin:10px 0 0 50px; min-width:900px;">
     <form id="create_form" name="create_form" method="post" action="/index.php/event/save" >
	    <label class="sizi">日期格式：</label>
	    <span class="bzsr13" style="line-height:24px">
	    <input type="radio"  name="date_type" value="1" checked/>年-月
	    <input type="radio"  name="date_type" value="2" />年-月-日
	    </span>
	    <p class="szts"><span></span></p>
	    <label class="sizi">日期：</label>
	    <input type="text" class="Wdate" id="time" name="time" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM'})"/>
	    <input type="text" class="Wdate" id="time1" name="time" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" style="display:none" />
	    <p class="szts"><span></span></p>
	    <label class="sizi">标题：</label>
	    <textarea name="title" cols="" rows="" class="bzsr13" id="title"></textarea>
	   	<p class="szts"><span></span></p>
	    <label class="sizi">是否跳转：</label>
	     <span class="bzsr13" style="line-height:24px">
	    <input type="radio"   name="is_link" value="0" checked/>否
        <input type="radio"  name="is_link" value="1"/>是
        </span>
        <p class="szts"><span></span></p>
	    <label class="sizi">url：</label>
	    <input type="text" class="bzsr" style="width:300px" name="url" value="http://"/>
	    <p class="szts"><span></span></p>
	    <label class="sizi">内容：</label>
	   	<div style="margin-left:90px">
			    <!-- 加载编辑器的容器 -->
				<script id="info"></script>
				<!-- 配置文件 -->
				<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
	    </div>
		<p class="szts"><span></span></p>
	</form>
  </div>
  <div class="caozuo5">
    <input type="button" id="btn_save" class="b_bnt01" value="保 存" />
  </div>
</div>
</div>

<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
    var editor = new UE.ui.Editor({
    	initialHeight:$('.con_detail').height()-350,
    	initialFrameHeight:$('.con_detail').height()-350,
    	initialWidth:780,
    	initialFrameWidth:780,
    	scaleEnabled:true
    });
    editor.render("info");  
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
		editor.setHeight($('.con_detail').height()-350);
	});	
		
	$('#btn_save').click(function(){
		var date_type		= $('[name="date_type"]:checked').val();
		var time		= $('#time').val();
		var time1		= $('#time1').val();
		var title       = $('[name="title"]').val();
		var is_link	= $('[name="is_link"]:checked').val();
		var url	= $('[name="url"]').val();
		var info	= editor.getContent();
		if(date_type==1){
			if(time==''){
				alert('请填写日期');
				return false;
			}else{
				date = time;
			}
		}else if(date_type==2){
			if(time1==''){
				alert('请填写日期');
				return false;
			}else{
				date = time1;
			}
		}
		if(title=='')
		{
			alert('请填写标题');
			return false;
		}
		if(is_link==1)
		{
			if(url==''){
				alert('请填写url');
				return false;
			}
		}
		$.post(
			"/index.php/event/save",
			{
				id     :0,
				date_type :date_type,
				time	: date,
				title	: title,
				is_link	: is_link,
				url     : url,
				info	: info,
			},
			function (data) //回传函数
			{
				alert(data);
				if(data=='操作成功')
				{
					
					location.href="/index.php/event/add";
				}
			}
		);
	});

	$('[name="date_type"]').click(function(){
		var value = $('[name="date_type"]:checked').val();
		if(value == 1){
			$('#time').show();
			$('#time1').hide();
		}else if(value == 2){
			$('#time1').show();
			$('#time').hide();
		}
	});

});
        

	

</script>
