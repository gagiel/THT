<div class="maincon">
	<div class="sst_bg">
		<p>当前位置：首页&gt;联系人&gt;单位信息变更查看</p>
		<div class="sst_sm"><?=$select?></div>
	</div>
	<div class="con_detail">
		<table cellpadding="0" cellspacing="0" class="biaozhun">
			<tr class="tab_tit">
				<td colspan="4">单位信息变更查看</td>
			</tr>
			<tr>
				<td width="12%" class="cklt">原属分组：</td>
				<td width="38%" class="cknr2 yyshzt"><?php echo($data['old']['typename'])?></td>
				<td width="12%" class="cklt">现属分组：</td>
				<td width="38%" class="cknr2"><?php echo($data['new']['typename'])?></td>
			</tr>
			<tr>
				<td class="cklt">原单位名称：</td>
				<td class="cknr2 yyshzt"><?php echo($data['old']['name'])?></td>
				<td class="cklt">新单位名称：</td>
				<td class="cknr2"><?php echo($data['new']['name'])?></td>
			</tr>
			<tr>
				<td class="cklt">原单位LOGO：</td>
				<td class="cknr2">
					<img src="<?php echo($data['old']['logo'])?>" id="" class="qyck_gslg yyshtp" />
				</td>
				<td class="cklt">新单位LOGO：</td>
				<td class="cknr2">
					<img src="<?php echo($data['new']['logo'])?>" id="" class="qyck_gslg" />
				</td>
			</tr>
			<tr>
				<td width="12%" class="cklt">原单位简介：</td>
				<td width="88%" class="cknr2 yyshzt" colspan="3"><?php echo($data['old']['brief'])?></td>
			</tr>
			<tr>
				<td class="cklt">新单位简介：</td>
				<td class="cknr2" colspan="3"><?php echo($data['new']['brief'])?></td>
			</tr>
			<tr>
				<td class="cklt">原参观路线：</td>
				<td class="cknr2 yyshzt" colspan="3"><?php echo($data['old']['way'])?></td>
			</tr>
			<tr>
				<td class="cklt">新参观路线：</td>
				<td class="cknr2" colspan="3"><?php echo($data['new']['brief'])?></td>
			</tr>
			<tr>
				<td class="cklt">原有产品图片：</td>
				<td class="cknr2" colspan="3">
					<!-- 加载编辑器的容器 --> 
				    <script id="oldinfo" name="oldinfo" type="text/plain" style=" width: 100%; height:180px;"></script> 
				    <!-- 配置文件 --> 
				    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script> 
				    <!-- 编辑器源码文件 --> 
				    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script> 
				    <!-- 实例化编辑器 --> 
				    <script type="text/javascript">
						var ue = UE.getEditor('oldinfo',{
							toolbars:[],
							initialHeight:200,
							initialFrameHeight:200,
							scaleEnabled:true,
							readonly:true,
						});
				    </script>
				</td>
			</tr>
			<tr>
				<td class="cklt">现有产品图片：</td>
				<td class="cknr2" colspan="3">
					<!-- 加载编辑器的容器 --> 
				    <script id="newinfo" name="newinfo" type="text/plain" style=" width: 100%; height:180px;"></script> 
				    <!-- 实例化编辑器 --> 
				    <script type="text/javascript">
						var ue = UE.getEditor('newinfo',{
							toolbars:[],
							initialHeight:200,
							initialFrameHeight:200,
							scaleEnabled:true,
							readonly:true,
						});
				    </script>
				</td>
			</tr>
		</table>
	</div>
	<div class="caozuo5" style=" width: 300px;">
	<input type="hidden" id="mid" name="mid" /> 
	<?php if($state == '0'):?>
	<input type="botton" class="b_bnt01" value="同 意" onclick="window.location.href='/index.php/edit_company_info/check/1/<?php echo($mid)?>'" /> 
	<input type="botton" class="b_bnt01" value="拒 绝" onclick="window.location.href='/index.php/edit_company_info/check/2/<?php echo($mid)?>'" /> 
	<?php else:?>
	<?php endif;?>
	<input type="botton" class="b_bnt01" value="返 回" onclick="history.go(-1)"/></div>
</div>
<script>
$(function(){
        var h = 190;
        $('.con_detail').height($(window).height()-h);
        $(window).resize(function(){
                $('.con_detail').height($(window).height()-h);
        });
});

</script>
