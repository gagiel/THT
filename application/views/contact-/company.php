<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>单位管理</p>
	<div class="sst_sm"><?=$select?></div>
  </div>

  <div class="con_detail">
	<form id="list_form" action="/index.php/company/index" method="post">
	  <input type="hidden" name="order" id="order" value="<?=$where['order']?>" />
	  <input type="hidden" name="otype" id="otype" value="<?=$where['otype']?>" />
	  <div class="ser_b">
		<label class="liangzi">分组：</label>
		<select name="ctype" class="bzsr2"> 
		  <option value="0">请选择</option>
		  <?=$type_opt?>
		</select> 
		<label class="sizi">单位名称：</label>
		<input type="text" class="bzsr" name="name" value="<?=$where['name']?>"/>
		<input type="submit" class="b_bnt01" value="查 询"/>
	  </div>
	</form>
	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tr class="tab_tit">
		<td width="15%">分 类
		</td>
		<td width="50%">单位名称
		  <div class="pxan_bnt">
			<a class="pxan_up" onclick="order('name','asc');">正序</a>
			<a class="pxan_down" onclick="order('name','desc');">倒序</a>
		  </div>
		</td>
		<td width="5%">落户</td>
		<td width="30%"><input type="button" value="新增" class="s_bnt01" onClick="addInfo()" /></td>
	  </tr>
	<? if(is_array($list))foreach($list as $v) {?>
	  <tr>
		<td id="tname_<?=$v->id?>"><?=$tname[$v->ctype]?></td>
		<td class="zhongdian" id="name_<?=$v->id?>" onclick="window.location.href='/index.php/company/check_index/<?=$v->id?>'"><?=$v->name?></td>
		<td><?=$settle[$v->settle]?></td>
		<td>
		  <a onClick="stopInfo(<?=$v->id?>)"><input name="" type="button" value="删除" class="s_bnt01 red"/></a>
		  <a onClick="editInfo(<?=$v->id?>)"><input name="" type="button" value="修改" class="s_bnt01 green"/></a>
		  <a onClick="recommendInfo(<?=$v->id?>)"><input name="" type="button" value="推荐" class="s_bnt01 green"/></a>
		  <a onClick="settleInfo(<?=$v->ctype?>,<?=$v->id?>)"><input name="" type="button" value="批示" class="s_bnt01 green"/></a>
		</td>
	  </tr>
	<? }?>
	</table>
  </div>
  <div class="sabrosus" style="position: fixed; bottom:2px;"><?=$pages?></div>
</div>

<script>
$(function(){
	var h = 195;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
});
function order(order,otype)
{
	$("#order").val(order);
	$("#otype").val(otype);
	$("#list_form").submit();
}
</script>

<!-- 新增/修改DIV -->
<div id="wincover"></div>
<div class="newli_b" id="winregister">
  <h3 id="div_title">单位管理--</h3>
  <div style="width:100%; height:500px;">
	<div class="nl_det">
	  <label class="sizi">分 组：</label>
	  <select id="i_ctype" name="ctype" class="bzsr2"><option value="0">请选择</option><?=$type_opt?></select>
	  <label class="sizi">名 称：</label>
	  <input id="i_name" name="name" type="input" class="bzsr" />
	  <p class="szts"></p>
		
	  <label class="sizi">简 介：</label>
	  <textarea type="textarea" name="brief" class="bzsr4" id="i_brief"></textarea>
	  <p class="szts"></p>
		
	  <div>
		<div style="float:left">
		  <label class="sizi">LOGO：</label>
		  <iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
		  <form action="/index.php/company/pic" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame" onsubmit="if($('#i_file').val()=='')return false;">
		    <input type='text' class='bzsr' id='i_pic' style="width:110px;" /> 
		    <input type='button' class='btn' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file').click();" />
		    <input type="file" class="file" name="i_file" id="i_file" onchange="$('#i_pic').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" /> 
		    <input type="submit" name="submit" class="btn" value="上传" style="margin:5px 5px 5px 0;" />
		  </form>
		  <p class="szts"></p>
		    
		  <label class="sizi">落户高新区：</label>
		  <label class="sizi" style="text-align:left;width:65px;"><input type="radio" name="settle" id="settle_0" class="" checked="checked" value="0" /> 未落户</label>
		  <label class="sizi" style="text-align:left;width:65px;"><input type="radio" name="settle" id="settle_1" class="" value="1" /> 已落户</label>
		  <label class="sizi" style="text-align:left;width:65px;"><input type="radio" name="settle" id="settle_2" class="" value="2" /> 接洽中</label>
		  <p class="szts"></p>
			
		  <label class="sizi">参观路线：</label>
		  <input type="input" id="i_way" name="way" class="bzsr" />
		</div>
		
		<div id="i_pic_show" style="float:left">
		  <img id="i_img" border="0" src="/images/logo_03.jpg" width="100" height="100" >
		</div>
	  </div>
	  <p class="szts"></p>
	  
	  <div>
		<div style="float:left"><label class="sizi">产品图片：</label></div>
		<div style="float:left">
		  <!-- 加载编辑器的容器 -->
		  <script id="info" name="info" type="text/plain" style="height:190px; width:500px;"></script>
		  <!-- 配置文件 -->
		  <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
		  <!-- 编辑器源码文件 -->
		  <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
		  <!-- 实例化编辑器 -->
		  <script type="text/javascript">
			var ue = UE.getEditor('info',{
				toolbars:[
					['undo', 'redo', '|',
					'bold', 'italic', 'underline', 'fontborder', '|', 
					'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 
					'removeformat', 'formatmatch', '|', 
					'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|', 
					'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|', 
					'link', 'unlink', 'anchor', '|', 
					'simpleupload', 'snapscreen']
				],
				scaleEnabled:true
			});
		  </script>
		</div>
	  </div>
	</div>
	<div class="caozuo">
		<input type="hidden" id="i_id" name="i_id" value=""/>
		<input type="botton" class="b_bnt01" value="保 存" id="save" onclick="save()"/>
		<input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
	</div>
  </div>
</div>
<script>
//上传图片后，返回显示
function pic_back(re)
{
	if(re=='false')
	{
		alert('图片上传失败');
	}
	else
	{
		$("#i_pic").val(re);
		$("#i_img").attr("src",re);
	}
}
var action = '';
function addInfo()
{
	action = 'add';
	$('#div_title').html('名片系统--新建单位');
	
 	$("#i_ctype").val('0');
 	$("#i_name").val('');
 	$("#i_brief").val('');
 	$("#i_pic").val('');
 	$("#i_file").val('');
 	$("#i_img").attr('src','/images/logo_03.jpg');
 	$("#settle_0").attr('checked','checked');
 	$("#i_way").val('');
 	ue.setContent('');

	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(id)
{
	$.post(
		"/index.php/company/get",
		{
			id:id
		},
		function (data) //回传函数
		{
			var obj = eval('('+data+')');
			
			if(obj.succ)
			{
				action = 'edit';
				$('#div_title').html('名片系统--修改单位');
				
				$("#i_id").val(id);
			 	$("#i_ctype").val(obj.data.ctype);
			 	$("#i_name").val(obj.data.name);
			 	$("#i_brief").val(obj.data.brief);
			 	$("#i_pic").val(obj.data.logo);
			 	$("#i_file").val('');
			 	$("#i_img").attr('src',obj.data.logo);
			 	$("#settle_"+obj.data.settle).attr('checked','checked');
			 	$("#i_way").val(obj.data.way);
			 	if(obj.data.pic==null)
			 	{
			 		ue.setContent('');
			 	}
			 	else
			 	{
			 		ue.setContent(obj.data.pic);
			 	}
			
				$('#wincover').show();
				$('#winregister').center();
			}
			else
			{
				alert('单位信息获取失败');
			}
		}
	);
}
function save()
{
	var id		= $("#i_id").val();
	var ctype	= $("#i_ctype").val();
	var name	= $("#i_name").val();
	var brief	= $("#i_brief").val();
	var logo	= $("#i_pic").val();
	var settle	= 0;
	$("input[name='settle']").each(function(){
		if(this.checked)
		{
			settle = this.value;
		}
	});
	var way		= $("#i_way").val();
	var pic		= ue.getContent();
	
	if(ctype=='0')
	{
		alert("请选择单位分组");
		return false;
	}
	if(name=='')
	{
		alert("请填写单位名称");
		return false;
	}
	$.post(
		"/index.php/company/save",
		{
			action	: action,
			id		: id,
			ctype	: ctype,
			name	: name,
			brief	: brief,
			logo	: logo,
			pic		: pic,
			settle	: settle,
			way		: way
		},
		function (data) //回传函数
		{
			if(data=='succ')
			{
				$("#list_form").submit();
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>
<!-- 新增/修改DIV -->

<!-- 批示 -->
<div id="settlecover"></div>
<div class="newli_b" id="settleregister">
	<h3>单位管理--单位批示</h3>
	<div style=" width: 100%; height: 220px; overflow-x: hidden; overflow-y:scroll; ">
		<form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/company/settleadd" id="settle_form">
			<label class="sizi">分组：</label>
			<p id="settypename" style=" line-height: 34px; "></p>
            
			<label class="sizi">单位名称：</label>
			<input type="hidden" id="company_id" name="company_id" value=""/>
			<p id="setcompanyname" style=" line-height: 34px; "></p>
			
			<label class="sizi">单位批示：</label>
			<textarea type="textarea" name="info" class="bzsr4" id="settleinfo"></textarea>
			
		</form>
	</div>
	<div class="caozuo">
		
		<input type="botton" class="b_bnt01" value="保 存" id="save" onclick="settlesubmit()"/>
		<input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#settleregister').hide();$('#settlecover').hide();" id="close"/>
	</div>
</div>


<script>
function settlesubmit(){
	if($("#settleinfo").val() == ''){
		alert ("批示内容不能为空，请填写批示！");
		return false;
	}else{
		$("#settle_form").submit();
	}
}

function checksubmit()
{
	if($("#typename_option_1").val()==0){
		$("#typename_option_1").val()
		alert("分组不能为空！");
		return false;
	}
	if($("input[name='name']").val()==''){
		alert("单位名称不能为空！");
		return false;
	}

	$("#sub_form").submit();
}

//ok
function recommendInfo(id)
{
	$('#sub_form').attr('action', '/index.php/company/edit');
	$.post(
			"/index.php/company/check",
			{
				id:id
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				
				$('#div_title').html('联系人--推荐单位');
				$('#sub_form').attr('action', '/index.php/company/edit');
				document.getElementById("sub_form").reset();
				//分组
				$("#typename_option_1").hide();
				$(".cknr").show();
				$("#tname").html(obj.tname);
				//logo
				$("#upimg1").hide();
				$("#preview1").hide();
				if(obj.logo){
					var logo = obj.logo
					$("#logo").show();
					$("#logo").attr("src",logo);
				}else{
					$("#upimg1").show();
				}
				//传到后台id以及name
				$("#mid").val(obj.id);
				$("input[name='name']").val(obj.name);
				$("input[name='name']").attr('readonly','readonly');
				//简介
				$("#brief").val(obj.brief);
				//参观路线
				$("input[name='way']").val(obj.way);
				//产品图片
				if(obj.pic){
					ue.setContent(obj.pic);
				}else{
					ue.setContent('');
				}
				$("#edittype").val("1");
				$("#contact_arr").hide();
				$("#save").show();
				$("#save").removeAttr("onclick");
				$("#save").attr("onclick","$('#sub_form').submit()")
				$("#close").val("取消");
				$('#wincover').show();
				$('#winregister').center();
			}
	);
}


//ok
function stopInfo(id)
{
	if(confirm("确认删除该单位吗？"))
	{
		$.post(
			"/index.php/company/stop",
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
				else if(data=='contact')
				{
					alert('单位下含有联系人，删除失败！');
				}
				else
				{
					alert('操作失败！');
				}
			}
		);
	}
} 
/* 删除单位批示 
   第二期  1.28 */
function delsettle(id){
	if(confirm("确认删除该批示吗？"))
	{
		$.post(
			"/index.php/company/delsettle",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success'){
					alert('删除成功');
					location.reload();
				}else if(data == 'no_power') {
					alert('对不起，您没有权限删除！');
				}else{
					alert('操作失败！');
				}
			}
		);
	}
}


function checkInfo(id)
{	
	$('#div_title').html('联系人--查看单位');
	$.post(
			"/index.php/company/check",
			{
				id:id
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				
				$("#typename_option_1").hide();
				$(".cknr").show();
				$("#tname").html(obj.tname);
				$("input[name='name']").val(obj.name);
				$("#brief").val(obj.brief);
				$("input[name='address']").val(obj.address);
				$("input[name='affairs']").val(obj.affairs);
				$("input[name='way']").val(obj.way);
				$("input[name='logo']").hide();	
				$("input[name='pic']").hide();	
				//联系人
				$("#contact_arr").show();
				var str = '';
				var arr = obj.contact;
				for(x in arr){
					str += '<li><span>'+arr[x]['name']+'</span><span>'+arr[x]['position']+'</span></li>';
				}
				$(".lxr_con").html(str);
				//领导批示
				$("#settle_arr").show();
				var settlestr = '';
				var settleArr = obj.settle;
				for(x in settleArr){
					settlestr += '<li><span>'+settleArr[x]['username']+'</span><span>'+settleArr[x]['info']+'</span></li><input type="botton" class="b_bnt01" value="删除" onClick="delsettle('+settleArr[x]['id']+')"  />';
				}
				$(".lxr_settle").html(settlestr);
				//logo
				$("#upimg1").hide();
				$("#preview1").hide();
				if(obj.logo){
					var logo = obj.logo
					$("#logo").show();
					$("#logo").attr("src",logo);
				}else{
					$("#upimg1").show();
				}
				//产品图片
				if(obj.pic){
					ue.setContent(obj.pic);
				}else{
					ue.setContent('');
				}
				
				$("#logo").show();
				$("#pic").show();
				$("#save").hide();
				$("#close").val("关闭");
				$('#wincover').show();
				$('#winregister').center();
			}
	);
}

/* 添加单位批示的弹窗 
   第二期  1.27 */
function settleInfo(tid,id){
	$.post(
		"/index.php/company/settleindex",
		{
			tid:tid,
			id:id
		},
		function (data) //回传函数
		{
			var obj = eval('('+data+')');
			$('#settypename').html(obj.typename);
			$('#setcompanyname').html(obj.companyname);
			$('#company_id').val(obj.companyid);
			$('#settlecover').show();
			$('#settleregister').center();
		}
	);
}
</script>












<style type="text/css">
	#preview{width:160px;height:25px; solid #000;overflow:hidden;}
	#imghead {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);}
	.fileInput{width:160px; height:25px;overflow:hidden;position:relative;}
	.upfile{position:absolute;top:-100px;}
	.upFileBtn{width:160px; height:20px;opacity:0;filter:alpha(opacity=0);cursor:pointer;}
</style>
	
<script type="text/javascript">
	//图片上传预览，IE用了滤镜
	function previewImage(file,i)
	{
		var MAXWIDTH  = 120;
	    var MAXHEIGHT = 140;
		var div = document.getElementById('preview'+i);
		var uploaddiv = document.getElementById('upimg'+i);
	  if (file.files && file.files[0])
	  {
	      div.innerHTML ='<img id=imghead'+i+'>';
	      var img = document.getElementById('imghead'+i);
		  img.onload = function(){
	        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
	        img.width  =  rect.width;
	        img.height =  rect.height;
			img.style.marginTop = rect.top+'px';
	      }
	      var reader = new FileReader();
		  div.style.display="";
		  uploaddiv.style.display="none";
	      reader.onload = function(evt){img.src = evt.target.result;}
	      reader.readAsDataURL(file.files[0]);
	  }
	  else //兼容IE
	  {
	    var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
	    file.select();
	    var src = document.selection.createRange().text;
	    div.innerHTML = '<img id=imghead>';
	    var img = document.getElementById('imghead');
	    img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
	    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
	    status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
	    div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
	  }
	}
	function clacImgZoomParam( maxWidth, maxHeight, width, height ){
	    var param = {top:0, left:0, width:width, height:height};
	    if( width>maxWidth || height>maxHeight )
	    {
	        rateWidth = width / maxWidth;
	        rateHeight = height / maxHeight;
	        if( rateWidth > rateHeight )
       {
	            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
	        }else
	        {
	            param.width = Math.round(width / rateHeight);
	            param.height = maxHeight;
        }
	    }
	    param.left = Math.round((maxWidth - param.width) / 2);
	    param.top = Math.round((maxHeight - param.height) / 2);
	    return param;
}
</script>

