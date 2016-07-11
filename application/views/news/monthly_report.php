<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<style>
.tree_name_a{width:120px;}
.b_bnt01{float:right;}
</style>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>月刊管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  <form id="get_form" action="" method="post" enctype="multipart/form-data">
    <div class="ser_b">
    <label class="sizi">月份：</label>
    <input type="text" class="Wdate" name="month" value="<?=$month?>" id="month" onFocus="WdatePicker({dateFmt:'yyyy-MM'})" style="width:80px;" onchange="$('#get_form').submit();" />
      <input type="file" class="b_bnt03" style="margin-left:30px;" name="file" id="fileToUpload" />
      <input type="hidden" name="fileToUpload" value="" />
      <input type="button"  class="b_bnt02" style="float:left" class="b_bnt01"  value="上传"  onclick="return ajaxFileUpload();" />
  
    <input type="button" class="b_bnt02" style="float:left" value="发 布" onclick="publish();" />
     <?php 
	 	if($info){
	 		?>
	      <input type="button" class="b_bnt01"  value="下载pdf文件" onclick="download('<?=$info?>')" />
	      <?php 
	 	}
	 	?>
    </div>
      <input type="hidden" id="id" name="id" value="<?=$id?>" />
      
  </form>
  <br/>
 	<!-- <object  width="1400" height="1000" border="0"> <param name="SRC" value="<?=$info?>"> </object>  -->
 	<div style="margin: 10px auto;min-width:900px;width: 90%; ">
 	<?php 
 	if($info){
 		?>
 	
 		<span style="color:red">温馨提示：如果不能正常显示月刊,下载Adobe Reader XI阅读器,然后设置浏览器,以ie为例:设置->Internet选项->程序->管理加载项->开启Adobe PDF Reader</span>
 		    <embed src="<?=$info?>" width="100%" height="650"></embed>
 		  
 		  <?php 
 	} else{
 		  ?>
 		 <span style="margin-left:85px;padding-top:60px">没有月刊</span> 
 		  <?php 
 	}
 		  ?>
 	</div>	  
 	
   
 	
  </div>
</div>
<script src="/js/tree.js" type="text/javascript"></script>
<script src="/js/ajaxfileupload.js" type="text/javascript"></script>

<script>
$(function(){
	var h = 155;
	$('.con_detail').height($(window).height()-h);
	$('.ycrsrq').width($(window).width()-$(".submenu").width()-470);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
		$('.ycrsrq').width($(window).width()-$(".submenu").width()-470);
	});

	 
});
 function download(url){
	 window.location.href = '/index.php/monthly_report/downloadPdf?wordname=.'+url;
 }
	 

$.extend({
    handleError: function (s, xhr, status, e) {
        if (s.error) {
            s.error.call(s.context || s, xhr, status, e);
        }
        if (s.global) {
            (s.context ? jQuery(s.context) : jQuery.event).trigger("ajaxError", [xhr, s, e]);
        }
    },
    httpData: function (xhr, type, s) {
        var ct = xhr.getResponseHeader("content-type"),
xml = type == "xml" || !type && ct && ct.indexOf("xml") >= 0,
data = xml ? xhr.responseXML : xhr.responseText;
        if (xml && data.documentElement.tagName == "parsererror")
            throw "parsererror";
        if (s && s.dataFilter)
            data = s.dataFilter(data, type);
        if (typeof data === "string") {
            if (type == "script")
                jQuery.globalEval(data);
            if (type == "json")
                data = window["eval"]("(" + data + ")");
        }
        return data;
    }
});
function ajaxFileUpload()
{
    $.ajaxFileUpload({
        url:'/index.php/news/test',
        secureuri:false,
        fileElementId: 'fileToUpload',
        dataType: 'json',
        success: function (data, status)
        {
        	// var obj = jQuery.parseJSON(data); 
        	alert(data.msg);  
        	if(data.code == 100){
            	$("[name='fileToUpload']").val(data.data);
        	}
                
        },
        error: function (data, status, e)
        {
            alert(e);
        }
    });
    return false;
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
		"/index.php/news/monthly_data",
		{
			month:$("#month").val(),
			ids:ids
		},
		function (data) //回传函数
		{
			editor.setContent(data);
			if(data=="<font color='red'>暂无新闻</font>")
			{
				$(".b_bnt01").css('color',"#aaa");
				$(".b_bnt01").attr('onclick','return false;');
			}else{
				$(".b_bnt01").css('color',"#000");
				$(".b_bnt01").attr('onclick','publish()');
			}
		}
	);
}
function publish()
{
	var name = $("[name='fileToUpload']").val();
	if(name == '' || name == 'undefined'){
		alert('未上传文件,不能发布');
		return false;
	}
	$.post(
		"/index.php/news/monthly_publish",$('#get_form').serialize(),
		function (data) //回传函数
		{
			alert(data);
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