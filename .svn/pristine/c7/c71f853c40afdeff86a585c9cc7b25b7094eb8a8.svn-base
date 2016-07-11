<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>微信推送</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>   
    <div class="con_detail" >
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
	<label class="sizi">微信推送：</label>
	<!--  <label class="sizi">测试账号：</label>
	<input type="text" class="bzsr" id="wechatid" name="wechatid" style="width:130px;" />-->
	<input type="button" class="b_bnt01" value="推送测试" <?=$info==''?' style="color:#aaa" disabled="true"':'onclick="wechat(true);"'?> />
	<label class="sizi">&nbsp;</label>
	<label class="sizi">正式推送：</label>
	<input type="button" class="b_bnt01" value="推 送" <?=$info==''?' style="color:#aaa" disabled="true"':'onclick="wechat(false);"'?>/>
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
        <div style="height: 700px">
         <div class="ser_b">   
	<label class="sizi">其他推送信息</label>
        <p id="show_id"></p>
        <input name="" type="button" value="新增" class="b_bnt01" onClick="addInfo()"  style="float:right;"/>
         </div>
       <table cellpadding="0" cellspacing="0" class="biaozhun">
            <tr class="tab_tit" id="other">
              <td width="10%">信息ID</td>
              <td width="25%">标题</td>
              <td width="10%">缩略图</td>
              <td width="30%">摘要</td>
               <td width="15%">创建时间</td>
              <td width="10%">操作</td>
            </tr> 
        </table>
        </div>
  </div>
       
    <!--其他信息添加页面-->
    <div id="wincover"></div>
<div class="newli_b" id="winregister">
<h3 id="div_title">其他推送信息--添加信息</h3>
    <div style=" width: 100%; height: 500px; overflow-x: hidden; overflow-y:scroll; ">
	<form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/news/other_add" id="sub_form1">
	<div class="nl_det">
		<p class="cknr"><span></span></p>
		<label class="sizi">标    题：</label>
                <input type="input" name="othertitle" class="bzsr"/>
		<p class="szts"><span></span></p>
		<label class="sizi">作    者：</label>
                <input type="input" name="author" class="bzsr"/>
		<p class="szts"><span></span></p>	
		<div style="float:left;">
			<label class="sizi">封 面 图：</label>
                        <input type='text' class='bzsr' id='imgfile1' name="imgfile1" style="width:150px;"  value=""/>
			<input type="button" value="浏览" class="s_bnt01" style="margin:5px 2px; height:25px;" onclick="$('#i_file').click();" />
                        <br>
                        <span style="margin: 2px; height: 20px; float: left; font-size: 12px; color: red; ">只允许上传.JPG格式的图片，图片大小不允许超过64K！</span>
		</div>  
		<div style="float:left; margin: 0 0 5px 84px; ">
			<img id="img_show" border="0" src="/images/logo_03.jpg" style="width:100px; height:100px;">
		</div>
                 <p class="szts"><span></span></p>
		<label class="sizi">摘     要：</label>
		<textarea type="textarea" name="digest" class="bzsr4" id="digest"></textarea>
		<p class="szts"><span></span></p>
		<label class="sizi">原文链接：</label>
                <input type="input" name="content_source_url" class="bzsr" value=""/>
		<p class="szts"><span></span></p>
		<label class="sizi">正    文：</label><br /><br />
		<!-- 加载编辑器的容器 -->
		<script id="content" name="content" type="text/plain" style="height:180px;"></script>
		<!-- 配置文件 -->
		<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
		<!-- 编辑器源码文件 -->
		<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
		<!-- 实例化编辑器 -->
		<script type="text/javascript">
			var ue = UE.getEditor('content',{
				initialHeight:300,
				initialFrameHeight:200,
				scaleEnabled:true
			});
		</script>
	</div>
	<div class="caozuo">
		<input type="hidden" id="mid" name="mid"/>
		<input type="botton" class="b_bnt01" value="保 存" id="save" onclick="checksubmit()"/>
		<input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();" id="close"/>
	</div>
</form>
</div>
</div> 
    <iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
<form id="pic_form" name="pic_form" action="/index.php/news/other_pic" encType="multipart/form-data"  method="post" target="pic_frame">
<input type="file" class="file" id="i_file" name="i_file" onchange="this.form.submit();" style="position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
</form>
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

function wechat(test)
{
	var title = $("#title").val();
	if(title=='')
	{
		alert("请填写标题");
		return false;
	}
	
	var msg = "确认推送吗？";
	if(test)
	{
		msg = "确认测试推送吗？";
		
	}
         var idstr=''
        $('.other_id').each(function(){
            idstr+=this.innerHTML+",";
        });

	if(confirm(msg))
	{
		$.post(
			"/index.php/wechat/sendNewsLetter",
			{
				test:test,
				title:title,
                                idstr:idstr,
				sdate:$("#d4321").val(),
				
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
    	initialHeight:$('.con_detail').height()*0.4,
    	initialFrameHeight:$('.con_detail').height()*0.4,
    	scaleEnabled:true
    });
    editor.render("info");
    otherlist();
});

/*
 * 修改函数
 */
       
function editInfo(id)
{
	$('#sub_form1').attr('action', '/index.php/news/other_edit');
	$.post(
			"/index.php/news/other_check",
			{
				id:id
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				
				$('#div_title').html('其他信息--修改信息');
				$('#sub_form1').attr('action', '/index.php/news/other_edit');
			/* 	document.getElementById("sub_form").reset(); */
				
				
				
				//传到后台id以及name
				$("#mid").val(obj.id);
				$("input[name='othertitle']").val(obj.title);
                                $("input[name='author']").val(obj.author);
                                $("input[name='content_source_url']").val(obj.content_source_url);
                                $("input[name='imgfile1']").val(obj.show_cover_pic);
				//简介
				$("#digest").val(obj.digest);
				//logo
				$("#preview1").hide();
				$("#upimg1").show();
				if(obj.show_cover_pic){
					var show_cover_pic = obj.show_cover_pic
					$("#img_show").show();
					$("#img_show").attr("src",show_cover_pic);
				}
				
				//产品图片
				if(obj.content){
					ue.setContent(obj.content);
				}else{
					ue.setContent('');
				}
				
				
				$("#save").show();
				$("#save").removeAttr("onclick");
				$("#save").attr("onclick","$('#sub_form1').submit()")
				$("#close").val("取消");
				$('#wincover').show();
				$('#winregister').center();
			}
	);
}

/*
 * 添加函数
 */
function addInfo()
{
	$('#div_title').html('其他信息--新建信息');
	$('#sub_form1').attr('action', '/index.php/news/other_add');
	document.getElementById("sub_form1").reset();
	
	//产品图片
	ue.setContent('');
	$("#preview1").hide();
	$("#upimg1").show();
	$("#img_show").hide();
	$("#save").show();
	$("#close").val("取消");
	$('#wincover').show();
	$('#winregister').center();
}
/*
 * 删除函数
 */
function stopInfo(id)
{
	if(confirm("确认删除该信息吗？"))
	{
		$.post(
			"/index.php/news/other_del",
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
				else if(data=='false')
				{
					alert('删除失败');
				}
				else
				{
					alert('操作失败！');
				}
			}
		);
	}
} 


 function otherlist(){                  
          $.ajax({
			type: "GET",
			async: true,		
			url:"http://prm.tht.gov.cn/index.php/news/other_list",
                        //url:"http://www.bhgxq.com/index.php/news/other_list",
			dataType: "json",
			jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(一般默认为:callback)
			success: function(data){
				 //console.info(data);
                                  var webStr = '';
                                             for( x in data.data ){
                                                Childobj = data.data[x];
                                                
                                                webStr +='<tr>'
                                                            +'<td  class="other_id" width="10%">'+Childobj.id+'</td>'
                                                            +'<td width="25%">'+Childobj.title+'</td>'
                                                            +'<td width="10%"><img src="'+Childobj.show_cover_pic+'" style="width:50px; height:50px;"></td>'
                                                            +'<td width="30%">'+Childobj.digest+'</td>'
                                                            +'<td width="15%">'+Childobj.addtime+'</td>'
                                                            +'<td width="10%">'                    
                                                             +'<input type="button" value="删除" class="s_bnt01 red" onClick="stopInfo('+Childobj.id+')"/>'
                                                             +'<input type="button" value="修改" class="s_bnt01 green" onClick="editInfo('+Childobj.id+')"/> ' 
                                                         +'</td>'
                                                         +'</tr>';
                                        }
                                        $("#other").after(webStr);  
                                        }   
		});	         
        }
/*
 * 表单各输入框判断函数
 */
function checksubmit()
{
        var content = ue.getContent();
         if($("input[name='othertitle']").val()==''){
		alert("标题不能为空！");
		return false;
	}
        if($("input[name='author']").val()==''){
		alert("作者不能为空！");
		return false;
	}
        if($("input[name='imgfile1']").val()==''){
		alert("封面图不能为空！");
		return false;
	}
        if($("#digest").val()==''){
		alert("摘要信息不能为空！");
		return false;
	}
         if(content==''){
		alert("正文内容不能为空！");
		return false;
	}
     
	$("#sub_form1").submit();
       otherlist();  
}
/* 
 * 上传图片后，返回显示 
 */
function pic_back(re)
{
	if(re=="1")
	{
		alert("上传失败，图片尺寸超过限制！");
	}else if(re=="2"){
                 alert("上传失败，图片格式错误！");
        }else if(re=="0"){
                 alert("上传失败！");
        }
	else
	{
		$("#imgfile1").val(re);
		$("#img_show").attr("src",re);
                $("#img_show").show();
	}
}
 

</script>