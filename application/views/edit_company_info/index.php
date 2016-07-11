<div class="maincon">
	<div class="sst_bg">
		<p>当前位置：首页&gt;联系人&gt;单位信息变更</p>
		<div class="sst_sm"><?=$select?></div>
	</div>
	<div class="con_detail">
		<form action="/index.php/edit_company_info/index" method="post">
			<div class="ser_b">
				<label class="liangzi">状 态：</label> 
				<select class="bzsr3" name="state">
					<option value="0">待审核</option>
					<option value="1">已通过</option>
					<option value="2">未通过</option>
				</select> 
				<label class="sizi">单位名称：</label> 
				<input type="text" class="bzsr com_name"/>
				<input type="hidden" name="companyid" value="" class="companyid">
				<input type="submit" class="b_bnt01" value="查 询" />
                <div class="gjzlx" style=" top: 41px; left: 311px; "></div>
			</div>
		</form>
		<table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td width="10%">分 组</td>
				<td width="25%">单位名称</td>
				<td width="20%">单位网站</td>
				<td width="5%">单位邮编</td>
				<td width="10%">申请人</td>
				<td width="20%">申请时间</td>
				<td width="10%">状态</td>
			</tr>
			<?php foreach($data as $name_item):?>
				<tr onclick="window.location.href='/index.php/edit_company_info/admin_review/<?php echo $name_item['id'] ?>'" style=" cursor: pointer;">
					<td>
						<?php echo $name_item['typename'] ?>
					</td>
					<td>
						<?php echo $name_item['companyname'] ?>
					</td>
					<td>
						<?php echo $name_item['url'] ?>
					</td>
					<td>
						<?php echo $name_item['postcode'] ?>
					</td>
					<td>
						<?php echo $name_item['Applyname'] ?>
					</td>
					<td>
						<?php echo $name_item['apply_time'] ?>
					</td>
					<?php if($name_item['state'] == 0):?>
						<td>待审核</td>
					<?php elseif($name_item['state'] == 1):?>
						<td>通过</td>
					<?php else:?>
						<td>没通过</td>
					<?php endif;?>
				</tr>
			<?php endforeach;?>
		</table>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".com_name").change(function(){
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
						$(".gjzlx").show();
						for(x in obj){
							str += "<p class=''><span onclick='aaa(this)'>"+obj[x]['name']+"</span><input name='' type='hidden' value='"+obj[x]['id']+"' /></p>";
							$(".gjzlx").html(str);
						}
					}
				);
			}
		});
	});	
	function aaa(obj){
		var text1 = obj.innerHTML;
		$(".com_name").val(text1)
		$(".companyid").val($(obj).next().val())
		$(".gjzlx").hide();
	} 
</script>