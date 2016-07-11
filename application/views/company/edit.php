<div style="padding-left:200px">
	<h2>修改单位</h2>
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart('company/edithandle');?>
		<label for="cfield">单位领域:</label>
		<select name="cfield">
			<?php foreach($fieldname as $v) :?>
				
				<?php if ($data[0]['fname'] == $v['name']): ?>
					<option value ="<?php echo $v['id'] ?>" selected="selected"><?php echo $v['name'] ?></option>
				<?php else: ?>
				    <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
				<?php endif; ?>
			<?php endforeach ?>
		</select> </br></br>

		<label for="ctype">单位分组:</label> 
		<select name="ctype">
			<?php foreach($typename as $v) :?>
				<?php if ($data[0]['tname'] == $v['name']): ?>
					<option value ="<?php echo $v['id'] ?>" selected="selected"><?php echo $v['name'] ?></option>
				<?php else: ?>
				    <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
				<?php endif; ?>
			<?php endforeach ?>
		</select> </br></br>

		<label for="name">单位名称:</label>
		<input type="text" name="name" value="<?php echo $data[0]['name'] ?>" /></br></br>

		<label for="brief">单位简介:</label> 
		<input type="text" name="brief" value="<?php echo $data[0]['brief'] ?>" /></br></br>
		
		<label for="address">公司地址:</label> 
		<input type="text" name="address" value="<?php echo $data[0]['address'] ?>" /></br></br>
		
		<label for="logo">公司logo:</label>
		<label><?php echo $data[0]['logo'] ?></label></br>
		<input type="hidden" name="logo_old" value="<?php echo $data[0]['logo'] ?>" />
		<input type="file" name="logo" size="20" /></br></br>
		
		<label for="pic">产品图片:</label>
		<label><?php echo $data[0]['pic'] ?></label></br>
		<input type="hidden" name="pic_old" value="<?php echo $data[0]['pic'] ?>" />
		<input type="file" name="pic" size="20" /></br></br>

		<label for="affairs">区内事务:</label>
		<input type="text" name="affairs" value="<?php echo $data[0]['affairs'] ?>" /></br></br>
		
		<label for="way">参观路线:</label> 
		<input type="text" name="way" value="<?php echo $data[0]['way'] ?>" /></br></br>
		
		<input type="hidden" name="id" value="<?php echo $data[0]['id'] ?>" />
		<input type="submit" name="submit" value="提交" /> 
	</form>
</div>