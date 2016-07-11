<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<div class="maincon">
    <div class="sst_bg">
		<p>当前位置：首页>名片系统>分组管理</p>
		<div class="sst_sm">
		    <?=$select?>
		</div>
    </div>
	<div class="con_detail">
		
				<div class="cla_list CNLTreeMenu" id="CNLTreeMenu1" >
					<a onClick="addInfo()"><input name="" type="button" value="新增" class="s_bnt01 flxz"/></a><div class="clear"></div>
						<?php if(isset($tree)):?>
						<?php echo $tree ?>
						<?php else : ?>
						<?php endif; ?>
					<div class="clear"></div>
				</div>
				
    </div>
</div>



<!-- 新增 -->
<div id="wincover"></div>
<div class="newli" id="winregister">
<h3 id="div_title">名片系统--</h3>
<form id="sub_form" action="/index.php/company_field/add" method="post">
	<div class="nl_det">
		<label class="sizi">上级分组：</label>
		<select name="parent" id="parent_option" class="bzsr2">
			<option value="0">无上级分组</option>
			<?php foreach($name as $v) :?>
			    <?php $arr = explode('.',$v['detail']); $len = count($arr)?>
				<?php if ($len==1): ?>
				<option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
				<?php elseif($len==2): ?>
				<option value ="<?php echo $v['id'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v['name'] ?></option>
				<?php elseif($len==3): ?>
				<option value ="<?php echo $v['id'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v['name'] ?></option>
				<?php endif; ?>
			<?php endforeach ?>
		</select>
		<p class="cknr"><span id="parent"></span></p>
		<p class="szts"><span></span></p>
		<input type="hidden" name="parentid" value="" id="parentid"/>
		<label class="sizi">分组名称：</label>
		<input type="text" class="bzsr" name="name" id="u_name" />
		<p class="szts"><span></span></p>
		
		<input type="hidden" name="id" value="" id="u_id">
	</div>
	<div class="caozuo">
		<input type="hidden" id="mid" name="mid" value=""> 
		<input type="botton" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
		<input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
	</div>
</form>
</div>

<script src="/js/tree.js" type="text/javascript" ></script>
<script>
function checksubmit()
{
	if($("#u_name").val()==""){
		alert("分组名称不能为空！");
		return false;
	}else{
		$("#sub_form").submit();
	}
}


function addInfo(id)
{
	$('#div_title').html('名片系统--新建分组');
	$('#sub_form').attr('action', '/index.php/company_type/add');
	$('#u_name').val('');
	$("#parent").text('');
	$("#parent_option").show();	
	$(".cknr").hide();
	$('#wincover').show();
	$('#winregister').center();
	
	$.post(
			"/index.php/company_type/addname",
			{
				id:id
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				$("#parent_option").hide();
				$("#parent").show();
				$(".cknr").show();
				$("#parent").text(obj.name);
				$("#parentid").val(obj.id);
			}
	);
	
}


function editInfo(id)
{
	$('#div_title').html('名片系统--修改分组');
	$('#sub_form').attr('action', '/index.php/company_type/edit');
	$.post(
			"/index.php/company_type/check",
			{
				id:id
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');

				$("#mid").val(obj.id);
				$("#parent_option").val(obj.parent);
				
				$("#u_name").val(obj.name);
				
				$('#wincover').show();
				$('#winregister').center();
			}
	);
}
function delInfo(id)
{
	if(confirm("确认删除该分组吗？"))
	{
		$.post(
			"/index.php/company_type/del",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					location.reload();
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}

function stopInfo(id)
{
	var val = $('#stop_'+id).text();
	if (val == '启用'){
		var text = "确定要停用该分组吗？";
	}else{
		var text = "确定要启用该分组吗？";
	}
	if(confirm(text))
	{
		$.post(
			"/index.php/company_type/stop",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('操作成功');
					location.reload();
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}

//排序-向上
function markupInfo(id){
	$.post(
		"/index.php/company_type/markup",
		{
			id:id
		},
		function (data) //回传函数
		{
			var info = data.split('/');
			if(info[0]=='success')
			{
				var urltotal = window.location.href;
				var url = urltotal.split('?');
				location.href=url[0]+"?parent="+info[1];
			}
			else
			{
				alert(data);
			}
		}
	);
}



//排序-向下
function markdownInfo(id){
	$.post(
		"/index.php/company_type/markdown",
		{
			id:id
		},
		function (data) //回传函数
		{
			var info = data.split('/');
			if(info[0]=='success')
			{
				var urltotal = window.location.href;
				var url = urltotal.split('?');
				location.href=url[0]+"?parent="+info[1];
			}
			else
			{
				alert(data);
			}
		}
	);
}

</script>


<script type="text/javascript">

<!-- 获取url参数 -->
function request(paras) {
	var url = location.href;
	var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
	var paraObj = {};
	for (i = 0; j = paraString[i]; i++) {
		paraObj[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);  
	}
	var returnValue = paraObj[paras.toLowerCase()];
	if (typeof (returnValue) == "undefined") {
		return "";
	} else {
		return returnValue;
	}
}

window.onload = function(){
	var arr = request('parent').split('.');
	arr.pop();
	for(x in arr){
		$('#id_'+arr[x]).attr('class','Opened');
	}
} 

</script>