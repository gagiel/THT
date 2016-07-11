<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页&gt;联系人&gt;单位信息变更查看</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <div class="con_detail">
  <div class="newli_sb">
<h3>单位管理--单位信息修改</h3>
<div class="nl_det">
<form action="/index.php/edit_company_info/editInfo" method="post">
  <label class="sizi">分 组：</label>
  <select class="bzsr2" name="type">
    <?php foreach($typename as $v) :?>
		<?php if($ctype == $v['id']):?>
			<option value ="<?php echo $v['id'] ?>" selected="selected"><?php echo $v['name'] ?></option>
		<?php else:?>
			<?php $arr = explode('.',$v['detail']);$len = count($arr);$sp='';for($i=0;$i<$len-1;$i++){$sp .= "&nbsp;&nbsp;";}?>
			<option value ="<?php echo $v['id'] ?>"><?php echo $sp ?><?php echo $v['name'] ?></option>
		<?php endif;?>
	<?php endforeach ?>
  </select>
  <p class="szts"><span></span></p>
  <label class="sizi">单位名称：</label>
  <input type="text" class="bzsr" value="<?php echo $name?>" name="name"/>
  <p class="szts"><span></span></p>
  <label class="sizi">单位LOGO：</label>
  <input name="logo" type="file" class="bzsr"/></br></br>
  <input name="oldlogo" type="hidden" value="<?php echo($logo)?>" />
  <img style=" width: 200px; height: 200px; margin-left: 89px; "src="<?php echo($logo)?>"/>
  <p class="szts"><span></span></p>
  <label class="sizi">单位简介：</label>
  <textarea name="brief" cols="" rows="" class="bzsr3" style=" width: 360px; "><?php echo $brief?></textarea>
  <p class="szts"><span></span></p>
  <label class="sizi">企业地址：</label>
  <input type="text" class="bzsr" style=" width: 360px; " value="<?php echo $address?>" name="address" />
  <p class="szts"><span></span></p>
  <label class="sizi">参观路线：</label>
  <input type="text" class="bzsr" style=" width: 360px; " value="<?php echo $way?>" name="way"/>
  <p class="szts"><span></span></p>
  <label class="sizi">产品图片：</label>
  <p class="szts"><span></span></p>
          <!-- 加载编辑器的容器 --> 
    <script id="info" name="info" type="text/plain" style=" width: 100%; height:180px;"></script> 
          <!-- 配置文件 --> 
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script> 
          <!-- 编辑器源码文件 --> 
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script> 
          <!-- 实例化编辑器 --> 
    <script type="text/javascript">
			var ue = UE.getEditor('info',{
				initialHeight:300,
				initialFrameHeight:200,
				scaleEnabled:true
			});
	</script>
  <div class="caozuo">
	<input type="hidden" name="mid" value="<?php echo $id?>" />
    <input type="submit" class="b_bnt01" value="提 交"/>
    <input type="button" class="b_bnt01" value="取 消"/>
  </div>
  </form>
</div>
</div>
  </div>
</div>
