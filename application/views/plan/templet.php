<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>活动方案>模板管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tbody>
	    <tr class="tab_tit alt">
	      <td width="30%">模板名称</td>
	      <td width="18%"><input name="name" value="新增" class="s_bnt01" onclick="addInfo()" type="button">
	        </td>
	    </tr>
<?
if(is_array($list))
{
	foreach($list as $k => $v)
	{
		$i = $k+1;
?>
	    <tr>
	      <td colspan="4" style="height:1px; background-color:#333"></td>
	    </tr>
	    <tr class="alt">
	      <td id="name_<?=$i?>"><?=$v->name?></td>
	      <td>
	        <input type="hidden" id="id_<?=$i?>" value="<?=$v->id?>" />
	      	<? if($v->id == 1){ ?>
	      	<input type="button" class="s_bnt01" value="复制" onclick="copyInfo(<?=$i?>)">
	      	<? }else{?>
	      	<? /*<input type="button" class="s_bnt01" value="复制" onclick="copyInfo(<?=$i?>)">*/?>
	        <input type="button" class="s_bnt01 red" value="删除" onclick="delInfo(<?=$i?>)">
	        <input type="button" class="s_bnt01 green" value="修改" onclick="editInfo(<?=$i?>)">
	        <? }?>
	      </td>
	    </tr>
<?
	}
}
?>
	  </tbody>
	</table>
  </div>
</div>
<div id="wincover"></div>
<div class="newli" id="winregister" style="width:700px;">
  <h3 id='div_title'>模板管理--</h3>
  <div class="nl_det">
  	<input type="hidden" id="m_id" value="" />
  	<!-- 新增窗口内容区  -->
      <label class="sizi">模 板 名 称：</label>
      <input type="text" class="bzsr" name="name" id="m_name" />
      <p class="szts"></p>
      <label class="sizi">模 板 内 容：</label>
      <font color="red" style="line-height:35px;font-size:12px;">$***$ 在新增方案使用该模板时，如填写相关内容可自动带入方案中</font>
      <p class="szts"></p>
	    <!-- 加载编辑器的容器 -->
	    <script id="info" name="info" type="text/plain" style="height:280px;"></script>
	    <!-- 配置文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
	    <!-- 实例化编辑器 -->
	    <script type="text/javascript">
	        var ue = UE.getEditor('info',{
		    	initialHeight:200,
		    	initialFrameHeight:200,
		    	scaleEnabled:true
	        });
	    </script>
  </div>
  <div class="caozuo">
	<input type="button" class="b_bnt01" value="保 存" onclick="info_form_submit()" />
	<input type="reset" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
</div>
<script>
var act = "add";
var edit_i = 0;
function addInfo()
{
	$('#div_title').html('模板管理--新建模板');
	$("#m_id").val('');
	$("#m_name").val('');
	ue.execCommand('cleardoc');

	act = "add";
	edit_i = 0;
	
	$('#wincover').show();
	$('#winregister').center();
}
function copyInfo(i)
{
	$('#div_title').html('模板管理--新建模板');
	$("#m_id").val('');	
	$("#m_name").val('');
	$.post(
		"/index.php/plan/get_templet_info",
		{
			id		: $("#id_"+i).val()
		},
		function (data) //回传函数
		{
			var json = eval("("+ data+")"); 
			ue.setContent(json.info);
		}
	);

	act = "add";
	edit_i = 0;
	
	$('#wincover').show();
	$('#winregister').center();
}
function editInfo(i)
{
	$('#div_title').html('模板管理--修改模板');
	$("#m_id").val($("#id_"+i).val());
	
	$.post(
		"/index.php/plan/get_templet_info",
		{
			id		: $("#id_"+i).val()
		},
		function (data) //回传函数
		{
			var json = eval("("+ data+")"); 
			$("#m_name").val(json.name);
			ue.setContent(json.info);
		}
	);
	act = "update";
	edit_i = i;
		
	$('#wincover').show();
	$('#winregister').center();
}
function info_form_submit()
{
	var name	= $('#m_name').val();
	var info	= ue.getContent();
	if(name=='')
	{
		alert('请填写模板名称');
		return false;
	}
	if(info=='')
	{
		alert('请填写模板内容');
		return false;
	}
	$.post(
		"/index.php/plan/templet_"+act,
		{
			id		: $("#m_id").val(),
			name	: name,
			info	: info
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				if(act=='add')
				{
					alert('模板添加成功');
					location.reload();
				}
				else
				{
					alert('模板修改成功');
					$("#name_"+edit_i).html(name);
					$('#winregister').hide();
					$('#wincover').hide();
				}
			}
			else
			{
				alert(data);
			}
		}
	);
}
function delInfo(i)
{
	if(confirm("确认删除该模板吗？"))
	{
		$.post(
			"/index.php/plan/templet_delete",
			{
				id:$("#id_"+i).val()
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('删除成功');
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
//单选钮控制选择区显隐
function sboxshow(range){
	if(range==1)
	{
		$('#range_div').show();
	}
	else
	{
		$('#range_div').hide();
	}
}
//全选、取消全部
function checkall(check)
{
	$("input[type='checkbox']").each(function(){
		this.checked=check;
	});
}
//反选
function recheck()
{
	$("input[type='checkbox']").each(function(){
		this.checked=!this.checked;
	});
}

function change(i,checked) {
	$("input[type='checkbox']").each(function(){
		if(this.className=='check_'+i)
		this.checked=checked;
	});
}
</script>