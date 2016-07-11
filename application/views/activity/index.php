<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
    <div class="sst_bg">
		<p>当前位置：首页>联系人>往来活动</p>
		<div class="sst_sm">
		    <?=$select?>
		</div>
    </div>
	
	<div class="con_detail">
		<form method="post" action="/index.php/activity/index">
			<div class="ser_b">
				<label class="liangzi">类型：</label>
				<select class="bzsr3" name="ctype">
					<option value="0">请选择</option>
					<option value="1">来</option>
					<option value="2">往</option>
				</select>
				<label class="liangzi">时 间：</label>
				<input type="text" class="Wdate" name="date" value="<?=$date?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" onchange="retime(this)" />
				<input type="hidden" value="<?=date('Y-m-d')?>" id="d4322" />
				<label class="sizi">单位名称：</label><input type="text" class="bzsr" name="companyname"/>
				<label class="liangzi">姓 名：</label>
				<?php if(isset($contactname)):?>
					<input type="text" class="bzsr1" value="<?php echo $contactname ?>" name="contactname"/>
				<?php else:?>
					<input type="text" class="bzsr1" name="contactname"/>
				<?php endif;?>
				<!--<label class="liangzi">姓 名：</label><input type="text" class="bzsr" />-->
				<input type="submit" class="b_bnt01" value="查 询"/>
			</div>
		</form>
		<table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td width="5%">类 型</td>
				<td width="10%">时 间</td>
				<td width="15%">接待人员</td>
				<td width="30%">相关单位</td>
				<td width="15%">相关联系人</td>
				<td width="25%"><input name="" type="button" value="新增" class="s_bnt01" onClick="window.location.href='/index.php/activity/index_add'" /></td>
			</tr>
			
			<?php foreach ($name as $name_item): ?>
				<tr>
				<td id="mark_<?php echo $name_item['id'] ?>">
					<?php if($name_item['ctype']=='2'):?>往
					<?php else : ?>来
					<?php endif; ?>
				</td>
				<td id="name_<?php echo $name_item['id'] ?>"><?php echo $name_item['cdate'] ?></td>
				<td><?php echo $name_item['username']?></td>
				<td id="name_<?php echo $name_item['id'] ?>"><?php if(isset($name_item['company_name'][1])){echo $name_item['company_name'][0].'..';}else{echo $name_item['company_name']['0'];}?></td>
				<td class="zhongdian"><?php if(isset($name_item['contact_name'][1])){echo $name_item['contact_name'][0].'..';}else{echo $name_item['contact_name']['0'];}?></td>
				<td>
					<a onClick="delInfo(<?php echo $name_item['id'] ?>)"><input name="" type="button" value="删除" class="s_bnt01 red"/></a>
			    	<a onClick="window.location.href='/index.php/activity/index_edit/<?php echo $name_item['id']?>'"><input name="" type="button" value="修改" class="s_bnt01 green"/></a>
					<a onclick="checkInfo(<?php echo $name_item['id'] ?>)"><input name="" type="button" value="查看" class="s_bnt01 green"/></a>
				</td>
			</tr>
			<!--<tr>
					<td id="mark_<?php echo $name_item['id'] ?>"><?php echo $name_item['typename'] ?></td>
					<td id="name_<?php echo $name_item['id'] ?>"><?php echo $name_item['cdate'] ?></td>
					<td id="name_<?php echo $name_item['id'] ?>"><?php echo $name_item['companyname'] ?></td>
					<td class="zhongdian"><?php echo $name_item['contactname'] ?></td>
					<td><?php echo $name_item['contactposition'] ?></td>
					<td class="blue"><?php echo $name_item['contactmobile'] ?></td>
					<td class="yellwo"><?php echo $name_item['contactemail'] ?></td>
					<td>
						<a onClick="delInfo(<?php echo $name_item['id'] ?>)"><input name="" type="button" value="删除" class="s_bnt01 red"/></a>
						<a onClick="editInfo(<?php echo $name_item['id']?>)"><input name="" type="button" value="修改" class="s_bnt01 green"/></a>
						<a onclick="checkInfo(<?php echo $name_item['id'] ?>)"><input name="" type="button" value="查看" class="s_bnt01 green"/></a>
					</td>
				</tr>-->
			<?php endforeach ?>
		</table>
		<div class="sabrosus"><?=$pages?></div>
    </div>
</div>

<!-- 新增 -->
<div id="wincover"></div>
<div class="newli_b" id="winregister">
<form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/contact/add" id="sub_form">
	<h3>往来活动--新建/修改往来记录</h3>
	<div class="nl_det">
		<label class="sizi">往来类型：</label>
		<select class="bzsr2" name="ctype" id="ctype_option" >
			<option value="0">请选择</option>
			<option value="1">来</option>
			<option value="2">往</option>
		</select>
		<p class="cknr"><span id="ctype_input"></span></p>
		<label class="sizi">接待人员：</label>
		<select class="bzsr2" name="user" id="user_option">
			<option value="0">请选择</option>
			<?php foreach($user as $v) :?>
			    <option value ="<?php echo $v['id'] ?>"  ><?php echo $v['name'] ?></option>
			<?php endforeach ?>
		</select>
		<p class="cknr"><span id="user_input"></span></p>
		<p class="szts"><span></span></p>
		<label class="sizi">内 容：</label>
		<textarea name="info" cols="" rows="" class="bzsr4"  id="info"></textarea>
		<p class="szts"><span></span></p>
		<!-- 礼品添加 -->
		<!--  
		<label class="sizi">礼 品：</label>
		<table cellspacing="0" cellpadding="0" class="biaozhun sam" id="stock_list" style=" left:-44px;">
			<tr class="tab_tit" id="stock_add">
				<td width="50%">名 称</td>
				<td width="20%">数 量</td>
				<td width="30%"><input name="" type="button" value="新增" class="s_bnt01" onclick="stock_add()" id="add_botton"/></td>
			</tr>
			<tr class="stock_add">
				<td><input type="text" class="bzsr6" id="stock_name" name="stock_name[]"/></td>
				<td><input type="text" class="bzsr7" id="stock_num" name="stock_num[]"/></td>
				<td></td>
			</tr>
		</table>
		-->
		<!-- 添加礼品完毕 -->
		<label class="sizi">备 注：</label>
		<textarea name="remark1" cols="" rows="" class="bzsr4" id="remark1"></textarea>
		<p class="szts"><span></span></p>
		<label class="sizi">相关联系人：</label>
		<table cellspacing="0" cellpadding="0" class="biaozhun sam"  style=" left:-44px;">
			<tr class="tab_tit">
				<td width="70%">联系人姓名</td>
				<td width="30%"></td>
			</tr>
			<tr class="contact_add">
				<td><input type="text" class="bzsr6" id="" name="" value=""/></td>
				<td></td>
			</tr>
		</table>
		<label class="sizi">相关单位：</label>
		<table cellspacing="0" cellpadding="0" class="biaozhun sam"  style=" left:-44px;">
			<tr class="tab_tit" >
				<td width="70%">单位名称</td>
				<td width="30%"></td>
			</tr>
			<tr class="company_add">
				<td><input type="text" class="bzsr6" id="" name="" value=""/></td>
				<td></td>
			</tr>
		</table>
		<div class="clear"></div>
	</div>
	<div class="caozuo">
		<input type="hidden" id="mid" name="mid"/>
		<input type="button" class="b_bnt01" value="保 存" id="save" onclick="checksubmit()"/>
		<input type="button" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();" id="close"/>
	</div>
	</form>
</div>

<script>
function checksubmit()
{
	if($("#ctype_option").val()==0){
		alert("往来类型不能为空！");
		return false;
	}
	if($("#company_name").val()=="请选择"){
		alert("单位名称不能为空！");
		return false;
	}
	if($("#contact_name").val()=="请选择"){
		alert("联系人姓名不能为空！");
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

	$("#sub_form").submit();
}

//经过显示内容
$(".tip").mouseenter(function(){
	var $thistd = $(this);
	if($thistd.find('.dygfd_tit').text().indexOf(',')>0){
		$thistd.find('.dygfd_tit').show();
	}
}).mouseleave(function(){
	var $thistd = $(this);
	$thistd.find('.dygfd_tit').hide();
});

//添加联系人
function addInfo()
{
	$('#div_title').html('联系人--新建联系人');
	$('#sub_form').attr('action', '/index.php/activity/add');
	$('.cknr').hide();
	$("#info").val("");
	$("#remark1").val("");
	//往来记录
	$("#ctype_option").show();
	$("#ctype_input").hide();

	//单位名称
	$("#company_name").show();
	$("#company_input").hide();
	//联系人
	$("#contact_name").show();
	$("#contact_input").hide();
	//接待人员
	$("#user_option").show();
	$("#user_input").hide();
	$("#save").show();
	$("#close").val("取消");
	//礼品
	$("#stock_name").val("");
	$("#stock_num").val("");
	$("#stock_add").show();
	
	$("#add_botton").show();
	$('#wincover').show();
	$('#winregister').center();
}

//联动菜单--单位联动联系人
function contactlinkage()
{	
	var name = $('#company_name').val();
	$.post(
		"/index.php/activity/contactlinkage",
		{
			id:name
		},
		function (data) //回传函数
		{
			if(data.length == 14){
				$("#contact_name").html('<option value=0>请选择</option>');
			}else{
				var obj = eval('('+data+')');
				var arr = new Array();
				arr = obj.contact;
				var option_arr = '';
				for(x in arr){					
					option_arr += '<option value='+x+'>'+arr[x]+'</option>';
				}
				$("#contact_name").html(option_arr);
			}
		}
	);
}

//添加、编辑时礼品的增加
function stock_add()
{
	if($("#stock_add").is(":hidden"))
	{
		$("#stock_name").val('');
		$("#stock_num").val('');
		$("#stock_add").show();
	}else{
		$("#stock_add").after($("#stock_add").clone());
	}
	$("#stock_name").val("");
	$("#stock_num").val("");
	
}
function stock_del(){
	var num = $(".stock_add").length;
	if(num != 1){
		$("#stock_add").remove();
	}else{
		$("#stock_name").val("");
		$("#stock_num").val("");
	}
}

function delInfo(id)
{
	if(confirm("确认删除该条往来记录吗？"))
	{
		$.post(
			"/index.php/activity/del",
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
				else
				{
					alert(data);
				}
			}
		);
	}
}

function checkInfo(id)
{
	$.post(
			"/index.php/activity/check",
			{
				id:id
			},
			function (data) //回传函数
			{

				var obj = eval('('+data+')');

				$('#wincover').show();
				$('#winregister').center();
				$(".cknr").show();
				//往来记录
				$("#ctype_option").hide();
				$("#ctype_input").show();
				$("#ctype_input").html(obj.typename);

				//单位名称
				$("#company_name").hide();
				$("#company_input").show();
				var company = obj.companyname;
				if(company == ''){
					$(".company_add").hide();
				}else{
					$(".company_add").show();
					company_arr = ''
					for(x in company){
						company_arr += '<tr><td><input type="text" class="bzsr6" style="margin-left:150px;width:250px;margin-right:50px" value="'+company[x]+'"/></td></tr>'
					}
				}
				
				$(".company_add").html(company_arr);
				
				//联系人
				$("#contact_name").hide();
				$("#contact_input").show();
				var contact = obj.contactname;
				if(contact == ''){
					$(".contact_add").hide();
				}else{
					$(".contact_add").show();
					contact_arr = ''
					for(x in contact){
						contact_arr += '<tr><td><input type="text" class="bzsr6" style="margin-left:150px;width:250px;margin-right:50px" value="'+contact[x]+'"/></td></tr>'
					}
				}
				$(".contact_add").html(contact_arr);
				//接待人员
				$("#user_option").hide();
				$("#user_input").show();
				$("#user_input").html(obj.user_name);
				//礼品
				var arr = obj.stock;
				if(arr == ''){
					$("#stock_add").hide();
				}else{
					$("#stock_add").show();
					var stock_arr = "<tr class='tab_tit' id='stock_add'><td width='50%'>名 称</td><td width='20%'>数 量</td><td width='30%'><input name='' type='button' value='新增' class='s_bnt01' onclick='stock_add()' id='add_botton'/></td></tr>";
					for(x in arr){
						stock_arr += '<tr class="stock_add"><td><input type="text" class="bzsr6" id="stock_name" name="stock_name[]" value="'+arr[x]['name']+'"/></td><td><input type="text" class="bzsr7" id="stock_num" name="stock_num[]" value="'+arr[x]['num']+'"/></td><td></td></tr>';
					} 
				} 
				$("#stock_list").html(stock_arr);
				$("#add_botton").hide();
				
				$("#info").val(obj.info);
				$("#remark1").val(obj.remark1);	
				$("#save").hide();
				$("#close").val("关闭");
			}
	);
}
</script>