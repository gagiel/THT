<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>修改名片</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <form method="post" action="/index.php/contact/edit_total/" id="sub_form" enctype="multipart/form-data" accept-charset="utf-8" >
  
  	<input type="hidden" name="del_company" value="0" />
  	<input type="hidden" value="<?=$thispage?>" name="thispage"/>
  	<input type="hidden" value="<?=$id?>" name="id"/>
  	
    <div style="width: 80%; margin: 120px auto; padding-left: 50px; left:auto;position:fixed;">
      <input type="button" class="b_bnt01" value="保 存" onclick="checksubmit()" />
      <input type="button" class="b_bnt01" value="返 回" onclick="location.href='/index.php/contact/view/<?=$id?>/<?=$thispage?>'" style="float:right;"/>
    </div>
    
    <div class="con_detail" style="top:155px;">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">姓 名：</td>
          <td width="42%" class="cknr2">
		  <input type="text" class="bzsr" name="name" value="<?=$name?>" />
		  <input type="hidden" name="contactid" value="<?=$id?>" />
		  </td>
          <td width="8%" class="cklt">星 级：</td>
          <td width="42%" class="cknr2">
            <input type="hidden" id="stars2-input" name="star" value="<?=$star?>" size="2" />
            <div class="shop-rating">
              <ul class="rating-level" id="stars2">
                <li><a href="javascript:void(0);" class="one-star" star:value="20"></a></li>
                <li><a href="javascript:void(0);" class="two-stars" star:value="40"></a></li>
                <li><a href="javascript:void(0);" class="three-stars" star:value="60"></a></li>
                <li><a href="javascript:void(0);" class="four-stars" star:value="80"></a></li>
                <li><a href="javascript:void(0);" class="five-stars" star:value="100"></a></li>
              </ul>
              <span id="stars2-tips" class="result"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <table cellspacing="0" cellpadding="0" class="biaozhun2" id="company_table">
              <tr class="tab_tit">
                <td width="25%">分 组</td>
                <td width="30%">单位名称</td>
                <td width="30%">职 务</td>
                <td width="15%"><input name="" type="button" value="新增" class="s_bnt01" id="add_njl"/></td>
              </tr>
			  <?php foreach($type_company_position as $val){?>
              <tr>
				<td width="20%"><?=$val['type_name']?><input type="hidden" name="typeid[]" value="<?=$val['type_id']?>"/></td>
                <td><?=$val['company_name']?><input type="hidden" value="<?=$val['company_id']?>" name="companyid[]"></td>
                <td><input type="text" class="bzsr" name="position[]" value="<?=$val['position']?>"/></td>
                <td><input name="" type="button" value="删除" class="s_bnt01 red" onclick="delcompany('<?=$val['company_id']?>',this)"/></td>
              </tr>
			  <?php } ?>
			  <tr id="xjlnr"><td colspan="4" style="height:0px;"></td></tr>
            </table>
          </td>
        </tr>
		<tr id="sjxx">
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2">
			<?php if(is_array($mobile)){?>
				<?php foreach($mobile as $v) {?>
					<input type="text" class="bzsr" name="mobile[]" id="mobile" value="<?=$v?>"/>
				<?php }?>
			<?php }else{?>
				<input type="text" class="bzsr8" name="mobile[]" id="" value="<?=$mobile?>"/>1
			<?php }?>
            <input type="button" value="+" class="tj_bnt" id="add_mob"/>
          </td>
        </tr>
        <tr>
          <td width="8%" class="cklt">电 话：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr" name="tel" value="<?=$tel?>"/></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">传  真：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="fax" value="<?=$fax?>"/></td>
          <td width="8%" class="cklt">E-mail：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="email" value="<?=$email?>"/></td>
        </tr>
        <tr id="dzxx">
          <td width="8%" class="cklt">地 址：</td>
          <td width="92%" colspan="3" class="cknr2">
			<?php if(is_array($address)){?>
				<?php foreach($address as $v){?>
					<input type="text" class="bzsr8" name="address[]" id="" value="<?=$v?>"/>
				<?php }?>
			<?php }else{?>
				<input type="text" class="bzsr8" name="address[]" id="" value="<?=$address ?>"/>
			<?php }?>
            <input name="" type="button" value="+" class="tj_bnt" id="add_add"/>
          </td>
        </tr>
		<tr>
          <td width="8%" class="cklt">名 片：</td>
		  <td colspan="3" class="cknr2">
		    <table width="100%" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="300">
		          <p><input name="photo" type="file" class="bzsr" style="margin-left:10px;" /></p>
		          <p class="hmyjjh" ><img src="<?=$pic_front==''?'/images/logo_03.jpg':$pic_front?>" id="photo"/></p>
		        </td>
		        <td width="300" class="mor_pic">
		          <p><input name="photo_reverse" type="file" class="bzsr" style="margin-left:10px;" /></p>
		          <p class="hmyjjh" ><img src="<?=$pic_reverse==''?'/images/logo_03.jpg':$pic_reverse?>" id="photo_reverse"/></p>
		        </td>
		        <td align="left" valign="top" style="text-align:left;">
		          <span>*图片尺寸：300*200PX</span>
		          <br /><br />
		          <input type="button" value="+" class="tj_bnt tabn" id="add_pic" style=" position: relative; top: 10px; "/>
		          <input type="button" value="-" class="tj_bnt tabn" id="min_pic" style=" display: none; position: relative; top: 10px; "/>
		        </td>
		      </tr>
		    </table>
		  </td>
		</tr>
		<tr>
          <td width="8%" class="cklt">名片主人：</td>
          <td width="42%" class="cknr2">
		    <select class="bzsr2" name="owner" id="owner_option">
              <?php foreach($usertotal as $v) {?>
              	<option value ="<?=$v['id']?>"<?=$v['id'] == $owner?' selected="selected"':''?>><?=$v['name']?></option>
              <?php }?>
            </select>
          </td>
          <td width="8%" class="cklt">公开：</td>
          <td width="42%" class="cknr2"><input name="public" type="checkbox" value="1" <?=$public == 1?'checked':''?> /></td>
        </tr>
        
        <tr>
          <td width="8%" class="cklt"><input type="button" class="b_bnt01" style=" margin-left: 22px;" id="bnt_more"value="更多选项"/></td>
          <td width="92%" colspan="3" class="cknr2"></td>
        </tr>
        <tr id="mplr_more" style=" display: none; ">
          <td width="92%" colspan="4" class="cknr2">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%" class="cklt">个人信息：</td>
                <td width="92%" colspan="3" class="cknr2">
                  <textarea name="remark" cols="" rows="" class="bzsr4"><?=$remark?></textarea>
                </td>
              </tr>
              <tr>
                <td width="8%" class="cklt">区内事务：</td>
                <td width="92%" colspan="3" class="cknr2">
                  <textarea name="affairs" cols="" rows="" class="bzsr4" id="affairs" ><?=$affairs_contact?></textarea>
                </td>
              </tr>
            </table></td>
        </tr>
        
      </table>
    </div>
    
    <div class="caozuo5" style="width: 80%; margin: 10px auto; padding-left: 50px; left:auto;">
      <input type="button" class="b_bnt01" value="保 存" onclick="checksubmit()" />
      <input type="button" class="b_bnt01" value="返 回" onclick="location.href='/index.php/contact/view/<?=$id?>/<?=$thispage?>'" style="float:right;"/>
    </div>
    
  </form>
</div>


<script>
$(document).ready(function(){
	/* DIV高度随窗口变化 */
	var h = 235;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
	
	/* 添加电话 */
	$("#add_mob").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='mobile[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#sjxx").after(tr);
	});
	/* 添加地址 */
	$("#add_add").click(function(){
		var tr = "<tr class='mdz'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr8' name='address[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_add(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dzxx").after(tr);
	});
	
	/* 添加名片图片2 */
	$("#add_pic").click(function(){
		$(".mor_pic").show();
		$("#min_pic").show();
		$(this).hide();
	});
	/* 删除名片图片2 */
	$("#min_pic").click(function(){
		$(".mor_pic").hide();
		$("#add_pic").show();
		$(this).hide(); 
	});
	
	/* 更多选项 */
	$("#bnt_more").click(function(){
		$("#mplr_more").fadeToggle("fast");
	});
});
/* 删除电话 */
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除地址 */
function min_add(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 获取单位分组信息 */
function enabletest1(){
	$('.companyname').bind('blur',function(){
		var objj = $(this);
		var name = $(this).val();
		$.post(
		"/index.php/contact/get_company_name",
		{
			name:name,
		},
		function (data) //回传函数
		{
			if(data == 0){
				var sel_html = "<select class='bzsr2' name='typeid[]' id=''>"
						 +   "<option value='28'>未分组</option>"
						 +   "<?
						 foreach($type_option as $v){
						 	$arr = explode('.',$v['detail']);
						 	$len = count($arr);$sp='';
						 	for($i=0;$i<$len-1;$i++){
						 		$sp .= "&nbsp;&nbsp;";
						 	}
						 	echo "<option value='".$v['id']."'>".$sp.$v['name']."</option>";
						 }
						 ?>"
						 + "</select>"
				objj.parent().prev().html(sel_html);
				objj.next().val('');
			}else{
				var obj = eval('('+data+')');
				var show_html = '<p class="type_name">'+obj.typename+'</p>'
							  + '<input type="hidden" name="typeid[]" value="'+obj.typeid+'" />';
				objj.parent().prev().html(show_html);
				objj.next().val(obj.id);
			}
			
		}
		);
	});
}

/* 添加单位信息 */
$("#add_njl").click(function(){
	var tr = "<tr>"
		   +   "<td></td>"
		   +   "<td><input type='text' class='bzsr companyname' /><input type='hidden' value='' name='companyid[]'/></td>"
		   +   "<td><input type='text' class='bzsr' name='position[]' /></td>"
		   +   "<td><input type='button' value='删除' class='s_bnt01 red' onclick='min_njl(this)'/></td>"
		   + "</tr>";
    $("#xjlnr").before(tr);
	enabletest1();
});
/* 删除新增的单位信息 */
function min_njl(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除原有单位信息 */
function delcompany(companyid,obj){
	$('#del_company').val($('#del_company').val()+','+companyid);

	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 提交表单 */
function checksubmit()
{
	if($("input[name='name']").val()==''){
		alert("联系人姓名不能为空！");
		return false;
	}
	if($("#company_table").find("tr").length==1)
	{
		alert("请填写联系人单位信息！");
		return false;
	}
	if($("#ctype").val()==0){
		alert("分组不能为空！");
		return false;
	}
	if($("input[name='companyid[]']").val()==''){
		alert("单位名称不能为空！");
		return false;
	}
	if($("input[name='position[]']").val()==''){
		alert("职务不能为空！");
		return false;
	}
	$("#sub_form").submit();
}

</script>
<script> 
/* 星级评定 */
var TB = function() { 
var T$ = function(id) { return document.getElementById(id) } 
var T$$ = function(r, t) { return (r || document).getElementsByTagName(t) } 
var Stars = function(cid, rid, hid, config) { 
var lis = T$$(T$(cid), 'li'), curA; 
for (var i = 0, len = lis.length; i < len; i++) { 
lis[i]._val = i; 
//通过库中star的值显示星等级
window.onload=function(){
	var starvalue =  document.getElementById('stars2-input').value;
	if(starvalue == 0){
		var level = 0;
	}else{
		var level = starvalue*0.05-1
	}
	T$(rid).innerHTML = '<em>' + starvalue + '</em>' ;
	curA = T$$(T$(cid), 'a')[starvalue*0.05-1]; 
	curA && (curA.className += config.curcss);
}
lis[i].onclick = function() { 
T$(rid).innerHTML = '<em>' + (T$(hid).value = T$$(this, 'a')[0].getAttribute('star:value')) + '</em>' ; 
curA = T$$(T$(cid), 'a')[T$(hid).value / config.step - 1]; 
}; 
lis[i].onmouseout = function() { 
curA && (curA.className += config.curcss); 
} 
lis[i].onmouseover = function() { 
curA && (curA.className = curA.className.replace(config.curcss, '')); 
} 
} 
}; 
return {Stars: Stars} 
}().Stars('stars2', 'stars2-tips', 'stars2-input', { 
'info' : ['一般联系人', '一般联系人', '重要联系人', '重要联系人', '重要联系人'], 
'curcss': ' current-rating', 
'step': 20 
}); 
</script>
