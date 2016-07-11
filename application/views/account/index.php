<div class="maincon">
	<div class="sst_bg">
		<p>当前位置：首页&gt;联系人&gt;企业账号管理</p>
		<div class="sst_sm">
			<?=$select?>
		</div>
	</div>
	<div class="con_detail">
	<!--企业账号搜索-->
	<div class="ser_b" style=" position: relative; ">
		<form action="/index.php/account/index" method="post">
        <input type="hidden" id="c_value" value="" />
			<label class="liangzi">账 号：</label> 
			<input type="text" class="bzsr" name="like_account" /> 
			<label class="sizi">单位名称：</label> 
			<input type="text" class="bzsr" id="company_name_1" onkeyup="company_input(event,this.value,1);"/> 
			<input type="hidden" name="companyid" value="" class="companyid" id="company_id_1"/>
			<input type="hidden" name="typeid" value="" class="typeid" />
			<input type="submit" class="b_bnt01" value="查 询" />
		    <div id="company_sel_1" style ="  position: absolute; top: 32px; left: 354px; width:250px; background: #fff; border:solid 1px #aaa; display:none; text-align:left; "></div>
		</form>
	</div>
    <!--企业账号列表-->
	<table cellpadding="0" cellspacing="0" class="biaozhun">
		<tr class="tab_tit">
			<td width="10%">账 号</td>
			<td width="50%">单位名称</td>
			<td width="25%">分 组</td>
			<td width="15%">
				<input name="" type="button" value="新增" class="s_bnt01" id="qyzh_add" />
			</td>
		</tr>
		<?php foreach($name as $v) : ?>
			<tr>
				<td class="zhongdian">
					<?php echo $v['account']?>
				</td>
				<td>
					<?php echo $v['company_name']?>
				</td>
				<td>
					<?php echo $v['type_name']?>
				</td>
				<td>
					<input name="" type="button" value="删除" class="s_bnt01 red" id="qyzh_del" onclick="min_qyzh(<?php echo $v['id']?>)" /> 
					<input name="" type="button" value="修改" class="s_bnt01 green" id="qyzh_edi" onclick="editInfo(<?php echo $v['id']?>)"/>
				</td>
			</tr>
		<?php endforeach;?>
	</table>
	<div class="sabrosus"><?=$pages?></div>
	</div>
</div>
	<!-- 新增 -->
	<div id="wincover"></div>
	<div class="newli" id="winregister" style=" height: 300px ">
		<h3>单位账号--编辑账号</h3>
		<form action="/index.php/account/add" method="post" id="account_add">
			<div class="nl_det" style=" position: relative; ">
				<label class="sizi" style=" margin-left: 50px;">单位名称：</label> 
				<input type="text" class="bzsr" id="company_name_2" onkeyup="company_input(event,this.value,2);"/> 
				<input type="hidden" name="companyid" value="" class="companyid" id="company_id_2"/>
				<input type="hidden" name="typeid" value="" class="typeid" />
				<p class="szts"></p>
		        <div id="company_sel_2" style ="  position: absolute; top: 32px; left: 139px; width:250px; background: #fff; border:solid 1px #aaa; display:none; text-align:left; "></div>
				<label class="sizi" style=" margin-left: 50px;">单位账号：</label> 
				<input type="text" class="bzsr" name="account" value="" id="com_username"/>
				<p class="szts"></p>
			</div>
			<div class="caozuo">
			<input type="hidden" name="mid" value="" id="mid">
			<input type="button" class="b_bnt01" value="保 存" id="qyzhzx_saf" /> 
			<input type="button" class="b_bnt01" value="取 消" id="qyzhzx_can" onclick="$('#winregister').hide();$('#wincover').hide();"/></div>
		</form>
	</div>
	<script>
	$(document).ready(function(){
		//新增企业账号
		$("#qyzh_add").click(function(){
			$("#account_add").find(".bzsr").val("");
			$("#account_add").attr("action","/index.php/account/add")
			$('#wincover').show();
			$('#winregister').center();
		});
		$("#qyzh_edi").click(function(){
			
			$('#wincover').show();
			$('#winregister').center();
		});	
		//企业账号名称联想1
		$(".com_name1").change(function(){
			var name = $(this).val();
			if(name != ''){
				$.post(
					"/index.php/account/get_companyname",
					{
						name:name
					},
					function (data) //回传函数
					{
						var obj = eval('('+data+')');
						var str = '';
						$(".gjzlx1").show();
						for(x in obj){
							str += "<p class=''><span onclick='aaa(this)'>"+obj[x]['name']+"</span><input name='' type='hidden' value='"+obj[x]['id']+"' /><input name='' type='hidden' value='"+obj[x]['type']+"' /></p>";
							$(".gjzlx1").html(str);
						}
						html += '<a  class="s_bnt01 red" style=" margin: 5px; position: relative; left: -40%; " onclick="" >关闭</a>';
					}
				);
			}
		});
		//企业账号名称联想2
		$(".com_name2").change(function(){
			var name = $(this).val();
			if(name != ''){
				$.post(
					"/index.php/account/get_companyname",
					{
						name:name
					},
					function (data) //回传函数
					{
						var obj = eval('('+data+')');
						var str = '';
						$(".gjzlx2").show();
						for(x in obj){
							str += "<p class=''><span onclick='bbb(this)'>"+obj[x]['name']+"</span><input name='' type='hidden' value='"+obj[x]['id']+"' /><input name='' type='hidden' value='"+obj[x]['type']+"' /></p>";
							$(".gjzlx2").html(str);
						}
					}
				);
			}
		});
	});	
	function aaa(obj){
		var text1 = obj.innerHTML;
		$(".com_name1").val(text1)
		$(".companyid").val($(obj).next().val())
		$(".typeid").val($(obj).next().next().val())
		$(".gjzlx1").hide();
	} 
	function bbb(obj){
		var text2 = obj.innerHTML;
		$(".com_name2").val(text2)
		$(".companyid").val($(obj).next().val())
		$(".typeid").val($(obj).next().next().val())
		$(".gjzlx2").hide();
	} 
	
	function min_qyzh(id){
		if(confirm("确认删除该企业账号吗？"))
		{
			$.post(
				"/index.php/account/del",
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
	
	function editInfo(id){
		$.ajax({
			type:'POST',
			url:'/index.php/account/editInfo',
			data:{id:id},
			dataType:'html',
			success:function(data){
				var obj = eval('('+data+')');
				$("#com_username").val(obj.account);
				$("#companyid").val(obj.company_id);
				$("#typeid").val(obj.type_id);
				$("#qyzhzx_qymc").val(obj.company_name);
				$("#mid").val(obj.id);
				$("#account_add").attr("action","/index.php/account/edit")
			},
			error:function(){
				alert("对不起，没有这条企业账号！");
			}
		});
	}

	/* 新增和修改时判断   公司名称和账号是否填全 */
	$("#qyzhzx_saf").click(function(){
		if($("#qyzhzx_qymc").val() == '' || $("#com_username").val() == ''){
			alert("请填全公司名称或账号！");
			return;
		}else{
			$("#account_add").submit();
		}
	})
	
/* 单位名称输入 */
function company_input(e,value,i)
{
	if(e.keyCode==13)
	{
		//回车确认单位名称后，直接查询单位分组信息
		get_cinfo(i);
	}
	else
	{
		//判断单位名称是否改变，如改变，重新获取可选名称列表
		if($('#c_value').val()!=value)
		{
			$('#c_value').val(value);
			get_cnames(value,i);
		}
	}
}
/* 根据输入的文本获取单位名称列表 */
function get_cnames(cname,i)
{
	if(cname=='')
	{
		return;
	}
	$.post(
		"/index.php/contact/get_company_by_code",
		{
			name : cname,
		},
		function (data) //回传函数
		{
			if(data=='')
			{
				$("#company_sel_"+i).hide();
				get_cinfo(i)
			}
			else
			{
				var html = '';
				var arr = data.split(",");
				for(var k in arr)
				{
					html += '<a onclick="set_cname(\''+arr[k]+'\','+i+')">'+arr[k]+'</a><br />';
				}
				$("#company_sel_"+i).html(html);
				$("#company_sel_"+i).show();	
			}
		}
	);
}
/* 点击选择下拉列表中的单位 */
function set_cname(name,i)
{
	$("#company_name_"+i).val(name);
	$('#c_value').val(name);
	$("#company_sel_"+i).hide();
	get_cinfo(i);
}
	
	
	
</script>