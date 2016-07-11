<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>联系人>修改往来活动</p>
    <div class="sst_sm">
      <!--<?=$select?>-->
    </div>
  </div>
  <div class="con_detail">
    <div id="wincover"></div>
    <div class="newli_sb" id="">
      <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/activity/edit" id="sub_form">
        <h3>往来活动--新建/修改往来记录</h3>
        <div class="nl_det">
          <label class="sizi">往来类型：</label>
			<?php if($ctype=='1'):?>
				<input type="hidden" name="ctype" value="1">
				<p style=" position: relative; top: 7px; width:15px;float:left">来</p>
			<?php else:?>
				<input type="hidden" name="ctype" value="2">
				<p style=" position: relative; top: 7px; width:15px;float:left">去</p>
			<?php endif;?>
			
          <p class="cknr"><span id="ctype_input"></span></p>
          <label class="sizi" style=" margin-left: 20%; ">接待人员：</label>
          <select class="bzsr2" name="user" id="user_option">
            <option value="0">请选择</option>
            <?php foreach($useroption as $v) :?>
				<?php if($v['id'] == $user):?>
					<option value ="<?php echo $v['id'] ?>" selected="selected"><?php echo $v['name'] ?></option>
				<?php else:?>
					<option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
				<?php endif;?>
            <?php endforeach ?>
          </select>
          <p class="cknr"><span id="user_input"></span></p>
          <p class="szts"><span></span></p>
          <label class="sizi">内 容：</label>
          <textarea name="info" cols="" rows="" class="bzsr4" style=" width: 85%; " id="info"><?php echo $info ?></textarea>
          <p class="szts"><span></span></p>
           <!-- 礼品添加 -->
           <!-- 
          <label class="sizi">礼 品：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="stock_list" >
            <tr class="tab_tit">
              <td width="50%">名 称</td>
              <td width="20%">数 量</td>
              <td width="30%"><input name="" type="button" value="新增" class="s_bnt01" onclick="stock_add()" id="add_pre"/></td>
            </tr>
			<?php foreach($stock as $v):?>
            <tr id="n_pre" class="stock_add">
              <td>
				<input type="text" class="bzsr6" id="stock_name" name="stock_name[]" value="<?php echo $v['name']?>"/>
				<input type="hidden" value="<?php echo $v['stock']?>"  name="stock_id[]"/>
			  </td>
              <td><input type="text" class="bzsr7" id="stock_num" name="stock_num[]" value="<?php echo $v['stock_num']?>"/></td>
              <td><input name="" type="button" value="删除" class="s_bnt01 red" id="" onclick='min_pre(this)'/></td>
            </tr>
			<?php endforeach;?>
          </table>
          -->
          <!-- 添加礼品完毕 -->
          <label class="sizi">备 注：</label>
          <textarea name="remark1" cols="" rows="" class="bzsr4" style=" width: 85%; " id="remark1"><?php echo $remark1 ?></textarea>
          <p class="szts"><span></span></p>
          <label class="sizi">相关联系人：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="name_list">
            <tr class="tab_tit" >
              <td width="70%">联系人姓名</td>
			  
				  <td width="30%">
					  <input  type="button" value="新增" class="s_bnt01" onclick="" id="add_nam"/>
					  <input type="hidden" name="contactid[]" />
				  </td>
			  
            </tr>
			<?php $i=1;
			foreach($contact_name as $k=>$v):?>
				<tr class="stock_add" id="n_nam">
				  <td>
					  <input type="text" class="bzsr6" id="lxrxm_inp_<?=$i?>" name="contactname[]" onblur="nam_focus(this)" value="<?php echo $v?>" />
					  <input type="hidden" name="contactid[]" value="<?php echo $contact_id[$k] ?>" />
				  </td>
				  <td><input name="" type="button" value="删除" class="s_bnt01 red" id="" onclick='min_nam(this)'/></td>
				</tr>
			<?php $i++; endforeach ?>
          </table>
          <label class="sizi">相关单位：</label>
          <table cellspacing="0" cellpadding="0" class="biaozhun sam1" id="com_list">
            <tr class="tab_tit" >
              <td width="70%">单位名称</td>
              <td width="30%"><input  type="button" value="新增" class="s_bnt01" onclick="" id="add_com"/></td>
			  
			</tr>
			<?php $i=1; foreach($company_name as $k=>$v):?>
				<tr class="stock_add" id="n_com">
				  <td>
					<input type="text" class="bzsr6" id="xgqymc_inp_<?=$i?>" name="companyname[]" onblur="com_focus(this)" value="<?php echo $v ?>"/>
					<input type="hidden" name="companyid[]" value="<?php echo $company_id[$k] ?>" />
				  </td>
				  <td><input name="" type="button" value="删除" class="s_bnt01 red" id="" onclick='min_com(this)'/></td>
				</tr>
			<?php $i++; endforeach;?>
          </table>
          <div class="clear"></div>
        </div>
        <div class="caozuo" >
          <input type="hidden" id="mid" name="mid" value="<?php echo $id ?>"/>
          <input type="submit" class="b_bnt01" value="保 存" id="save" />
          <input type="button" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();" id="close"/>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#add_pre").click(function(){
    $("#stock_list tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='' name=''/></td><td><input type='text' class='bzsr7' id='' name=''/></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_pre(this)'/></td></tr>");
  });
  $("#add_nam").click(function(){
	var rows = $("#name_list tr").length;
    $("#name_list tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='lxrxm_inp_"+rows+"' name='' onblur='nam_focus(this)'/></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_nam(this)'/></td></tr>");
  });
  $("#add_com").click(function(){
	var rows = $("#com_list tr").length;
    $("#com_list tr:last").after("<tr class='stock_add'><td><input type='text' class='bzsr6' id='xgqymc_inp_"+rows+"' name='' onblur='com_focus(this)'/></td><td><input name='' type='button' value='删除' class='s_bnt01 red' id='' onclick='min_com(this)'/></td></tr>");
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
<div class="newli jzdw" id="qygl_xmxz">
  <table cellpadding="0" cellspacing="0" class="biaozhun3" id="contact_table">
  </table>
  <div class="caozuo3" style=" margin-left: -50px; position: absolute; left: 50%; bottom: 0px; "><input type="button" class="b_bnt01" value="返 回" id="clo_namdiv"/></div>
</div>
<!--单位筛选-->
<div class="newli jzdw" id="qygl_qyxz">
  <table cellpadding="0" cellspacing="0" class="biaozhun3" id="company_table">
  </table>
  <div class="caozuo3" style=" margin-left: -50px; position: absolute; left: 50%; bottom: 0px; "><input type="button" class="b_bnt01" value="返 回" id="clo_comdiv"/></div>
</div>
<script>
var re_input_id = "";
function nam_focus(obj)
{
  re_input_id = obj.id;
  var name = obj.value;
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
			var option_arr = "<tr class='tab_tit'><td>姓 名</td><td>单位名称</td><td>职 务</td><td>分 类</td><td></td></tr>";
			for(x in arr){					
				option_arr += "<tr><td class='xmzcd'>"+arr[x]['name']+"</td><td title="+arr[x]['company_name_str']+" class='comzcd'>"+arr[x]['company_name'][0]+"</td><td title="+arr[x]['position_str']+">"+arr[x]['position'][0]+"</td><td title="+arr[x]['type_name_str']+">"+arr[x]['type_name'][0]+"</td><td><input name='' type='button' value='选择' onclick='nam_click(this)' class='s_bnt01'/></td></tr>";
			}
			$("#contact_table").html(option_arr);
		}
	);
  
  $("#qygl_xmxz").show();
  $('#wincover').show();
  $('#winregister').center();
}
function nam_click(obj)
{
	
   var val1=$(obj).parent().siblings(".xmzcd").text();
   $("#"+re_input_id).val(val1);
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
				var option_arr = "<tr class='tab_tit'><td>单位名称</td><td>分 类</td><td></td></tr>";
				for(x in arr){					
					option_arr += "<tr><td title="+arr[x]['name']+" class='comzcd'>"+arr[x]['name']+"</td><td title="+arr[x]['type_name']+">"+arr[x]['type_name']+"</td><td><input name='' type='button' value='选择' onclick='com_click(this)' class='s_bnt01'/></td></tr>";
				}
				$("#company_table").html(option_arr);
			}
		);
	  $("#qygl_qyxz").show();
	  $('#wincover').show();
	  $('#winregister').center();
}
function com_click(obj)
{
	var val1=$(obj).parent().siblings(".comzcd").text();
	$("#"+re_input_id).val(val1);
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