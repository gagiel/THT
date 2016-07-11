<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>内部名片</p>
  </div>

<input type="hidden" id="pic_id" value="" />
<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
<form id="pic_form" name="pic_form" action="/index.php/contact/pic" encType="multipart/form-data"  method="post" target="pic_frame">
<input type="file" class="file" id="i_file" name="i_file" onchange="this.form.submit();" style="position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
</form>
  
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/contact/save1/add" id="sub_form" name="sub_form">
    <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">姓 名：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="name" id="name" /></td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="hidden" id="c_value" value="" />
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="30%">单位名称</td>
                <td width="50%">单位地址</td>
                <td width="20%">邮编</td>
              </tr>
              <tr>
                <td style=" position: relative;">
				  <input type="text" id="company_name" name="companyname" class="bzsr companyname" autocomplete="off"  onkeyup="company_input(event,this.value);"<?/* onblur="get_cinfo(1)"*/?> />
				  <input type="hidden" value="" id="company_id" name="companyid">
				  <div id="company_div" style ="position: absolute; top: 32px; left: 99px; width:250px; background: #fff; border:solid 1px #aaa; display:none; text-align:left; "></div>
                </td>
                <td>
                     <input type="text" class="bzsr" id="address" name="address"/>
                </td>
                <td>
                    <input type="text" class="bzsr" id="postcode" name="postcode"/>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="8%" class="cklt">职 务：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="position[]" id="position"/>
            <input type="button" value="+" class="tj_bnt" id="add_position"/>
          </td>
        </tr>
        <tr id="zwxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
		<tr>
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="mobile[]" id="mobile"/>
            <input type="button" value="+" class="tj_bnt" id="add_mobile"/>
          </td>
        </tr>
        <tr id="sjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">办公电话：</td>
          <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr" name="tel[]" id='tel' />
              <input type="button" value="+" class="tj_bnt" id="add_tel"/>
          </td> 
        </tr>
         <tr id="dhxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">保密机：</td>
          <td width="92%" class="cknr2">
              <input type="text" class="bzsr" name="secret_code" id="secret_code" />
          </td>
        </tr>
        <tr id="czxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">宅 电：</td>
          <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr" name="home_tel[]" id="home_tel"/>
              <input type="button" value="+" class="tj_bnt" id="add_home_tel"/>
          </td>
        </tr>
        <tr id="zdxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
      </table>
    </div>
    <div class="caozuo5">
      <input type="button" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
      <input type="button" class="b_bnt01" value="返 回"  onclick="window.location.href='/index.php/contact/contact_manage'" />
      <input type="reset" class="b_bnt01" value="取 消"/>
   
      
    </div>
  </form>
</div>

<script>
$(document).ready(function(){
	
	/* DIV高度随窗口变化 */
	$(function(){
		//var h = 225;
		var h = 225;
		$('.con_detail').height($(window).height()-h);
		$(window).resize(function(){
			$('.con_detail').height($(window).height()-h);
		});
	});

	/* 添加职务 */
	$("#add_position").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='position[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#zwxx").before(tr);
	});
	/* 添加手机号 */
	$("#add_mobile").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='mobile[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#sjxx").before(tr);
	});
    /*添加电话*/
	$("#add_tel").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='tel[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dhxx").before(tr);
	});
	 /*添加宅电 */
	$("#add_home_tel").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='home_tel[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#zdxx").before(tr);
	});
});

/* 删除电话 */
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

/* 单位名称输入 */
function company_input(e,value)
{
	//alert($('#company_id').val());
	//判断单位名称是否改变，如改变，重新获取可选名称列表
	if($('#c_value').val()!=value)
	{
		$('#company_id').val('');
		$('#c_value').val(value);
		get_cnames(value);
	}
}
/* 根据输入的文本获取单位名称列表 */
function get_cnames(cname)
{
	if(cname=='')
	{
		return;
	}
	$.post(
		"/index.php/contact/get_internal_company_by_code",
		{
			name : cname
		},
		function (data) //回传函数
		{
			if(data=='')
			{
				$("#company_div").hide();
			}
			else
			{
				var html = '';
				for(var k in data)
				{
					html += '<a onclick="set_cname(\''+data[k]['id']+'\',\''+data[k]['name']+'\',\''+data[k]['address']+'\',\''+data[k]['postcode']+'\')">'+data[k]['name']+'</a><br />';
				}
				html += '<a  class="s_bnt01 red" style=" margin: 5px; position: relative; left: -40%; " onclick="closeFrame()" >关闭</a>';
				$("#company_div").html(html);
				$("#company_div").show();	
			}
		},'json'
	);
}
/* 点击选择下拉列表中的单位 */
function set_cname(id,name,address,postcode)
{
	$("#company_name").val(name);
	$('#address').val(address);
	$('#postcode').val(postcode);
	$('#company_id').val(id);
	$('#c_value').val(name);
	$("#company_div").hide();
	//get_cinfo(i);
}

function closeFrame(){
	$("#company_div").hide();
}


/* 提交前判断 */
function checksubmit()
{
	if($("#name").val()==''){
		alert("请填写姓名");
		return false;
	}
	if($("input[name='companyname']").val()==''){
		alert("请填写单位名称");
		return false;
	}
	if($("input[name='address']").val()==''){
		alert("请填写单位地址");
		return false;
	}
	if($("input[name='postcode']").val()==''){
		alert("请填写邮编");
		return false;
	}
	$("input[name='position[]']").each(function(){
		if($(this).val()=='')
		{
			alert("请填写职务");
			return false;
		}
	});
	$("input[name='mobile[]']").each(function(){
		if($(this).val()=='')
		{
			alert("请填写手机号");
			return false;
		}
	});
	$("input[name='tel[]']").each(function(){
		if($(this).val()=='')
		{
			alert("请填写办公电话");
			return false;
		}
	});
	$("#sub_form").submit();
}

</script>