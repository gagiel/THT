<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>新增往来活动</p>
    <div class="sst_sm"> 
      <!--<?=$select?>--> 
    </div>
  </div>
  <div class="con_detail">
    <div id="wincover"></div>
    <div class="newli_sb" id="">
      <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/activity/add" id="sub_form">
        <h3>往来活动--新建往来记录</h3>
        <div class="nl_det">
          <label class="sizi">往来类型：</label>
          <select class="bzsr2" name="ctype" id="ctype_option" >
            <option value="0">请选择</option>
            <option value="1">来</option>
            <option value="2">往</option>
          </select>
          <p class="cknr"><span id="ctype_input"></span></p>
          <label class="sizi" style=" margin-left: 20%; ">接待人员：</label>
          <span id="owner_show" style="float:left;line-height: 35px;"></span>
            <input type="button"  class="b_bnt01" value="选 择" onclick="$('#wincover').show();$('#winregister').center();" />
            <input type="hidden" name="user" id="owner" value="0" />
          <!--<select class="bzsr2" name="user" id="user_option">
            <option value="0">请选择</option>
            <?php foreach($user as $v) :?>
            <option value ="<?php echo $v['id'] ?>"  ><?php echo $v['name'] ?></option>
            <?php endforeach ?>
          </select>-->
          <p class="cknr"><span id="user_input"></span></p>
          <p class="szts"><span></span></p>
          <label class="sizi">内 容：</label>
          <textarea name="info" cols="" rows="" class="bzsr4" style=" width: 85%; " id="info"></textarea>
          <p class="szts"><span></span></p>
           <!-- 添加礼品 -->
          <!-- 
           <label class="sizi">礼 品：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="stock_list" >
            <tr class="tab_tit">
              <td width="50%">名 称</td>
              <td width="20%">数 量</td>
              <td width="30%"><input name="" type="button" value="新增" class="s_bnt01" onclick="stock_add()" id="add_pre"/></td>
            </tr>
            <tr id="n_pre" class="stock_add">
              <td><input type="text" class="bzsr6" id="stock_name" name="stock_name[]"/></td>
              <td><input type="text" class="bzsr7" id="stock_num" name="stock_num[]"/></td>
              <td></td>
            </tr>
          </table>
           -->
           <!-- 添加礼品完毕 -->
          
          <label class="sizi">备 注：</label>
          <textarea name="remark1" cols="" rows="" class="bzsr4" style=" width: 85%; " id="remark1"></textarea>
          <p class="szts"><span></span></p>
          <label class="sizi">相关联系人：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="table_mem" >
            <tr class="tab_tit" >
              <td width="70%">联系人姓名</td>
              <td width="30%"><input  type="button" value="新增" class="s_bnt01" onclick="" id="add_nam" /></td>
            </tr>
            <tr class="stock_add" id="n_nam" style="display:none">
              <td>
				<input type="hidden" class="bzsr6" id="lxrxm_inp_1" name="" onblur="nam_focus(this)" name="contactname[]" value="<?php if(isset($contact)):?><?php echo $contact?><?php endif;?>"/>
				<input type="hidden" name="contactid[]" />
			  </td>
            </tr>
          </table>
		  <br/>
          <label class="sizi">相关单位：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="table_com">
            <tr class="tab_tit" >
              <td width="70%">单位名称</td>
              <td width="30%"><input  type="button" value="新增" class="s_bnt01" onclick="" id="add_com"/></td>
              
            </tr>
				<?php if(is_array($company))foreach($company as $v){?>
				<tr class="stock_add" id="n_com" style="display:none">
				  <td>
				  <input type="hidden" class="bzsr6" id="xgqymc_inp_1" name="" onblur ="com_focus(this)" name="companyname[]" value="<?php echo $v["companyname"]?>"/>
				  <input type="hidden" name="companyid[]" value="<?php echo $v["companyid"]?>"/>
				  </td>
				</tr>
				<?php } ?>
          </table>
		  <br/>
          <div class="clear"></div>
        </div>
        <div class="caozuo" >
          <input type="hidden" id="mid" name="mid"/>
          <input type="button" class="b_bnt01" value="保 存" id="save" onclick="checksubmit()"/>
          <input type="button" class="b_bnt01" value="取 消" onclick="history.go(-1)" id="close"/>
        </div>
      </form>
    </div>
  </div>
</div>
<!---->
<div id="wincover"></div>
<div class="newli" id="winregister">
  <h3 id="div_title">往来活动--选择接待人员</h3>
  <div class="nl_det">
        <div id="CNLTreeMenu1" style="height:200px;">
        <ul>
        <? 
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <span  onClick="return false;"><?=$d->name?></span>
            <ul class="Child" id="d_u_<?=$i?>">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <img class="s" src="/images/s.gif" alt="展开/折叠">
              <span  onClick="$('#owner_show').html('<?=$u->name?>');$('#owner').val('<?=$u->id?>');$('#winregister').hide();$('#wincover').hide();"><?=$u->name?></span>
            </li>
            <?
            		}
            ?>
            </ul>
          </li>
          
            <?
            	}
          	}
        }
        ?>
        </ul>
        </div>
  </div>
  <div class="caozuo" id='create_div'>
	  <input type="button" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();" />
  </div>
</div>
<!---->
<script>
function checksubmit()
{
	if($("#ctype_option").val()==0){
		alert("往来类型不能为空！");
		return false;
	}
	if($("#user_option").val()==0){
		alert("接待人员不能为空！");
		return false;
	}
	if($("#info").val()==""){
		alert("内容不能为空！");
		return false;
	}
	if($("#lxrxm_inp_1").val()==""){
		alert("相关联系人不能为空！");
		return false;
	}
	if($("#xgqymc_inp_1").val()==""){
		alert("相关单位不能为空！");
		return false;
	}

	$("#sub_form").submit();
}

$(document).ready(function(){
  $("#add_pre").click(function(){
    $("#stock_list tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='' name='stock_name[]'/></td><td><input type='text' class='bzsr7' id='' name='stock_num[]'/></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_pre(this)'/></td></tr>");
  });
  $("#add_nam").click(function(){
  	var rows = $("#table_mem tr").length;
    $("#table_mem tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='lxrxm_inp_"+rows+"' name='comtactname[]' onblur='nam_focus(this)'/><input type='hidden' name='contactid[]' id='lxrid_inp_"+rows+"' /></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_nam(this)'/></td></tr>");
  });
  $("#add_com").click(function(){
  	var rows = $("#table_com tr").length;
    $("#table_com tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='xgqymc_inp_"+rows+"' name='companyname[]' onblur='com_focus(this)'/><input type='hidden' name='companyid[]' /></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_com(this)'/></td></tr>");
  });
});

function min_pre(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
function min_nam(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
function min_com(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
</script> 
<!--姓名筛选-->
<div class="newli_b jzdw" id="qygl_xmxz" >
<table cellpadding="0" cellspacing="0" class="biaozhun3">
    <tr class="tab_tit">
      <td width="10%">姓 名</td>
      <td width="40%">单位名称</td>
      <td width="16%">职 务</td>
      <td width="26%">分 类</td>
      <td width="8%"></td>
    </tr> 
</table>
  <div style=" width: 100%; height: 230px; overflow-y: scroll; overflow-x: hidden; overflow-y: auto; "><table cellpadding="0" cellspacing="0" class="biaozhun3" id="contact_table"></table></div>
  <div class="caozuo3" style=" margin-left: -50px; position: absolute; left: 50%; bottom: 0px; "><input type="button" class="b_bnt01" value="返 回" id="clo_namdiv"/></div>
</div>
<!--单位筛选-->
<div class="newli_b jzdw" id="qygl_qyxz">
<table cellpadding="0" cellspacing="0" class="biaozhun3">
    <tr class="tab_tit">
      <td width="60%">单位名称</td>
      <td width="32%">分 类</td>
      <td width="8%"></td>
    </tr> 
  </table>
  <div style=" width: 100%; height: 230px; overflow-y: scroll; overflow-x: hidden; overflow-y: auto; "><table cellpadding="0" cellspacing="0" class="biaozhun3" id="company_table"></table></div>
  <div class="caozuo3" style=" margin-left: -50px; position: absolute; left: 50%; bottom: 0px; "><input type="button" class="b_bnt01" value="返 回" id="clo_comdiv"/></div>
</div>
<script>
var re_input_id = "";
function nam_focus(obj)
{
	re_input_id = obj.id;
	var name = obj.value;
	if(name != ''){
		$.post(
			"/index.php/activity/get_contact_name",
			{
				name:name
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				var arr = new Array();
				arr = obj;
				var option_arr = "";
				for(x in arr){					
					option_arr += "<tr><td class='xmzcd' width='10%'>"+arr[x]['name']+"</td><td class='contact_id' style='display:none'>"+arr[x]['id']+"</td><td title="+arr[x]['company_name_str']+" class='comzcd' width='40%'>"+arr[x]['company_name'][0]+"</td><td title="+arr[x]['position_str']+" width='16%'>"+arr[x]['position'][0]+"</td><td title="+arr[x]['type_name_str']+" width='26%'>"+arr[x]['type_name'][0]+"</td><td width='8%'><input name='' type='button' value='选择' onclick='nam_click(this)' class='s_bnt01'/></td></tr>";
				}
				$("#contact_table").html(option_arr);
			}
		);

		$("#qygl_xmxz").show();
		//$('#wincover').show();
		//$('#winregister').center();
	}
  
}
function nam_click(obj)
{

	var val1=$(obj).parent().siblings(".xmzcd").text();
	var val2 = $(obj).parent().siblings(".contact_id").text();
	$("#"+re_input_id).val(val1);
	$("#"+re_input_id).next().val(val2);
    $("#qygl_xmxz").hide();
    $('#wincover').hide();
	
}
function com_focus(obj)
{
	re_input_id = obj.id;
	
	var name = obj.value;
	  $.post(
			"/index.php/activity/get_company_name",
			{
				name:name
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				var arr = new Array();
				arr = obj;
				var option_arr = "";
				for(x in arr){					
					option_arr += "<tr><td title="+arr[x]['name']+" class='comzcd' width='60%'>"+arr[x]['name']+"</td><td class='company_id' style='display:none'>"+arr[x]['id']+"</td><td title="+arr[x]['type_name']+" width='32%'>"+arr[x]['type_name']+"</td><td width='8%'><input name='' type='button' value='选择' onclick='com_click(this)' class='s_bnt01'/></td></tr>";
				}
				$("#company_table").html(option_arr);
			}
		);
	  $("#qygl_qyxz").show();
	  //$('#wincover').show();
	  //$('#winregister').center();
}
function com_click(obj)
{
	var val1=$(obj).parent().siblings(".comzcd").text();
	var val2 = $(obj).parent().siblings(".company_id").text();
	$("#"+re_input_id).val(val1);
	$("#"+re_input_id).next().val(val2);
    $("#qygl_qyxz").hide();
    $('#wincover').hide();
	
}
$(document).ready(function() {
    $("#clo_namdiv").click(function() {
		$("#qygl_xmxz").hide()
   		$("#wincover").hide()
	});
	$("#clo_comdiv").click(function() {
		$("#qygl_qyxz").hide();
	    $("#wincover").hide();
	});
});
</script>