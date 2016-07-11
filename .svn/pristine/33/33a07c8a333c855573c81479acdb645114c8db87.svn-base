<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>物品管理>库存管理</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <!-- 物品列表 -->
  <div class="con_detail">
    <div class="ser_b">
      <form id="list_form" method="post" action="/index.php/stock/index">
      <label class="sizi">物品名称：</label>
      <input type="text" class="bzsr" name="name" value="<?=$name?>" />
      <input type="submit" class="b_bnt01" value="查 询"/>
      </form>
    </div>
    <table cellpadding="0" cellspacing="0" class="biaozhun">
      <tr class="tab_tit">
        <td width="45%">物品名称</td>
        <td width="10%">库存数量</td>
        <td width="10%">规格</td>
        <td width="35%"><input type="button" value="新增" class="s_bnt01" onclick="add()"/></td>
      </tr>
    <? 
	if(is_array($list))
	{
		foreach($list as $k => $v)
		{
	?>
      <tr>
        <td class="zhongdian" style=" cursor: pointer; "onclick="view(<?=$k?>)" id="name_<?=$k?>"><?=$v->name?></td>
        <td id="num_<?=$k?>"><?=$v->num?></td>
        <td id="standard_<?=$k?>"><?=$v->standard?></td>
        <td>
          <input type="hidden" id="id_<?=$k?>" value="<?=$v->id?>" />
          <input type="hidden" id="remark_<?=$k?>" value="<?=$v->remark?>" />
          <input type="hidden" id="pic_<?=$k?>" value="<?=$v->pic?>" />
          <input type="button" value="删除" class="s_bnt01 red" onclick="del(<?=$k?>)" />
          <input type="button" value="修改" class="s_bnt01 green" onclick="edit(<?=$k?>)" />
          <input type="button" value="领用" class="s_bnt01" onclick="storage(<?=$k?>,'out')" />
          <input type="button" value="入库" class="s_bnt01 yellwo" onclick="storage(<?=$k?>,'in')" />
        </td>
      </tr>
	<?
		}
	}
	?>
    </table>
    <div class="sabrosus"><?=$pages?></div>
  </div>
</div>
<div id="wincover"></div>
<!-- 新增 -->
<div class="newli" id="winregister">
  <h3>库存管理--新增物品入库</h3>
  <div class="nl_det">
  	<input type="hidden" id="i_id" />
  	
  	<div style="float:left;">
	    <label class="sizi">物品名称：</label>
	    <input type="text" class="bzsr" id="i_name" />
	    <p class="szts"><span></span></p>
	    
	    <div id='div_pic'>
		<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
	    <form action="/index.php/stock/pic" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame">
	    <label class="sizi">图 片：</label>
	    <input type='text' class='bzsr' id='i_pic' style="width:110px;" /> 
	    <input type='button' class='btn' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file').click();" />
	    <input type="file" class="file" name="i_file" id="i_file" onchange="$('#i_pic').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" /> 
	    <input type="submit" name="submit" class="btn" value="上传" style="margin:5px 5px 5px 0;" />
	    </form>
	    <p class="szts"><span></span></p>
	    </div>
	    
	    <label class="sizi">规 格：</label>
	    <input type="text" class="bzsr" id="i_standard" />
	    <p class="szts"><span></span></p>
	    
	    <div id='div_num'>
	    <label class="sizi">数 量：</label>
	    <input type="text" class="bzsr" id="i_num" />
	    <p class="szts"><span></span></p>
	    </div>
	    
	    <div id="div_time">
		<label class="sizi" id="l_time">入库时间：</label>
		<input type="text" class="Wdate" id="i_time" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"/>
	    </div>
    </div>
    <div id="i_pic_show" style="float:right"><img id="i_img" src="/images/logo_03.jpg" width="100"></div>
    <p class="szts"><span></span></p>
    <label class="sizi">备 注：</label>
    <textarea id="i_remark" class="bzsr3" style="font-size:14px;"></textarea>
    <p class="szts"><span></span></p>
    
    <div class="caozuo">
      <input type="button" class="b_bnt01" value="保 存" onclick="save()"/>
      <input type="button" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
    </div>
  </div>
</div>
<script>
var action = '';
//弹出新增入库DIV
function add()
{
	action = "add";
	$("#i_id").val("0");
	$("#i_name").val("");
	$("#i_pic").val("");
	$("#i_standard").val("");
	$("#i_num").val("");
	$("#i_time").val("");
	$("#i_remark").val("");
	$("#l_time").html("入库时间：");
	
	$("#i_name").attr("disabled",false);
	$("#i_standard").attr("disabled",false);
	
	$("#div_time").show();
	$("#div_num").show();
	$("#div_pic").show();
	
	$("#wincover").show();
	$("#winregister").center();
}
//弹出修改DIV
function edit(i)
{
	action = "edit";
	
	$("#i_id").val($("#id_"+i).val());
	$("#i_name").val($("#name_"+i).html());
	$("#i_pic").val($("#pic_"+i).val());
	$("#i_img").attr('src',$("#pic_"+i).val());
	$("#i_standard").val($("#standard_"+i).html());
	$("#i_num").val($("#num_"+i).html());
	$("#i_time").val("");
	$("#i_remark").val($("#remark_"+i).val());
	
	$("#i_name").attr("disabled",false);
	$("#i_standard").attr("disabled",false);
	
	$("#div_time").hide();
	$("#div_num").hide();
	$("#div_pic").show();
	
	$("#wincover").show();
	$("#winregister").center();
}
//弹出入库、领用DIV
function storage(i,type)
{
	action = type;
	
	$("#i_id").val($("#id_"+i).val());
	$("#i_name").val($("#name_"+i).html());
	$("#i_img").attr('src',$("#pic_"+i).val());
	$("#i_standard").val($("#standard_"+i).html());
	$("#i_num").val("");
	$("#i_time").val("");
	$("#i_remark").val("");
	
	$("#i_name").attr("disabled",true);
	$("#i_standard").attr("disabled",true);
	
	$("#div_pic").hide();
	$("#div_num").show();
	$("#div_time").show();
	
	if(type=='in')
	{
		$("#l_time").html("入库时间：");
	}
	else
	{
		$("#l_time").html("领用时间：");
	}
	
	
	$("#wincover").show();
	$("#winregister").center();
}
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
//提交表单
function save()
{
	var name = $("#i_name").val();
	if(name=='' && (action=='add' || action=="edit"))
	{
		alert("请填写物品名称");
		return false;
	}
	
	var standard = $("#i_standard").val();
	if(standard=='' && (action=='add' || action=="edit"))
	{
		alert("请填写物品规格");
		return false;
	}
	
	var num = $("#i_num").val();
	if(num=='' && (action=='in' || action=="out" || action=="add"))
	{
		alert("请填写物品数量");
		return false;
	}
	
	var time = $("#i_time").val();
	if(time=='' && (action=='in' || action=="out" || action=="add"))
	{
		alert("请填写时间");
		return false;
	}
	
	$.post(
		"/index.php/stock/save",
		{
			action		: action,
			id			: $("#i_id").val(),
			name		: name,
			standard	: standard,
			num			: num,
			time		: time,
			pic			: $("#i_pic").val(),
			remark		: $("#i_remark").val()
		},
		function (data) //回传函数
		{
			var dataObj=eval("("+data+")");//转换为json对象 
			
			alert(dataObj.msg);
			if(dataObj.succ)
			{
				$('#winregister').hide();
				$('#wincover').hide();
				$("#list_form").submit();
			}
		}
	);
}
function del(i)
{
	if(confirm("确认删除该物品吗？")){
		$.post(
			"/index.php/stock/delete",
			{
				id	: $("#id_"+i).val()
			},
			function (data) //回传函数
			{
				if(data=='success')
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
}
//查看物品
function view(i)
{
	location.href="/index.php/stock/view/"+$("#id_"+i).val()+'/0/0/0';
}
</script> 
