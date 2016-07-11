<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<div class="maincon">
  <div class="sst_bg">
	<p>当前位置：首页>名片系统>分组管理</p>
	<div class="sst_sm"><?=$select?></div>
  </div>
  <div class="con_detail">
    <div class="cla_list CNLTreeMenu" id="CNLTreeMenu1" >
      <a onClick="addInfo(0)"><input name="" type="button" value="新增" class="s_bnt01 flxz"/></a>
      <div class="clear"></div>
      <div id="tree_div"></div>
    </div>
  </div>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister">
<h3 id="div_title">信息推送--</h3>
<input type="hidden" id='f_act' value="add">
<input type="hidden" id="u_id" name="id" />
  <div class="nl_det">
  	<label class="sizi">上级分组：</label>
	<select name="parent" id="parent_option" class="bzsr2">
		
	</select>
    <p class="szts"><span></span></p>
    <label class="sizi">类型名称：</label>
    <input type="text" class="bzsr" name="name" id="u_name" />
    <p class="szts"><span></span></p>
  </div>
  <div class="caozuo">
	  <input type="submit" class="b_bnt01" value="保 存" onclick="subform()"/>
	  <input type="reset" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
</div>
<script src="/js/tree.js" type="text/javascript" ></script>
<script>
var open = new Array();
$(function() {
	getTree();
	getOption();
});
//获取类型树
function getTree()
{
	$.post(
		"/index.php/company/type_tree",
		{
			open: open
		},
		function (data) //回传函数
		{
			$("#tree_div").html(data);
		}
	);
}
//获取下拉列表
function getOption()
{
	$.post(
		"/index.php/company/type_option",
		{
			open: open
		},
		function (data) //回传函数
		{
			$("#parent_option").html(data);
		}
	);
}
//类型树非叶子结点点击
function treeClick(obj)
{
	ExCls(obj,'Opened','Closed',1);
	var cname = obj.parentNode.className;
	if(cname=='Opened')
	{
		open.push(obj.id);
	}
	else
	{
		for(var i=0;i<open.length;i++)
		{
			if(open[i]==obj.id)
			{
				open.remove(i);
			}
		}
	}
}


function checksubmit()
{
	if($("#u_name").val()==""){
		alert("分组名称不能为空！");
		return false;
	}else{
		$("#sub_form").submit();
	}
}

function addInfo(pid)
{
	$('#div_title').html('名片系统--新建单位分组');
	$('#f_act').val('add');
	$('#u_id').val('');
	$('#u_name').val('');
	$('#parent_option').val(pid);
	
	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(id)
{
	$('#div_title').html('信息推送--修改单位分组');
	$('#f_act').val('update');
	$('#u_id').val(id);
	$('#u_name').val($("#name_"+id).text());
	$('#parent_option').val($("#parent_"+id).val());
	
	$('#wincover').show();
	$('#winregister').center();
}
//提交表单
function subform()
{
	var act = $('#f_act').val();
	var id = $('#u_id').val();
	var name = $('#u_name').val();
	var parent = $('#parent_option').val();
	if(name=='')
	{
		alert("请填写类型名称");
		return;
	}
	$.post(
		"/index.php/company/type_"+act,
		{
			id: id,
			name: name,
			parent: parent
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				open.push(parent);
				$('#winregister').hide();
				$('#wincover').hide();
				getTree();
				getOption();
			}
			else
			{
				alert(data);
			}
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
function delInfo(id)
{
	if(confirm("确认删除该类型吗？"))
	{
		$.post(
			"/index.php/company/type_delete",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					getTree();
					getOption();
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}
function markUp(id)
{
	$.post(
		"/index.php/company/type_up",
		{
			id:id
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				getTree();
				getOption();
			}
			else
			{
				alert(data);
			}
		}
	);
}
function markDown(id)
{
	$.post(
		"/index.php/company/type_down",
		{
			id:id
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				getTree();
				getOption();
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