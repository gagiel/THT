<div style="padding-left:200px">
	<h2>创建一个单位</h2>
	<?php echo $error; ?>
	<?php echo form_open_multipart('company/addhandle');?>

		<label for="cfield">单位领域</label> 
		<select name="cfield"> 
			<option value="0">请选择</option>
			<?php foreach($fieldname as $v) :?>
			  <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
			<?php endforeach ?>
		</select> 
		</br>
		</br>
		<label for="ctype">单位分组</label> 
		<select name="ctype"> 
			<option value="0">请选择</option>
			<?php foreach($typename as $v) :?>
			  <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
			<?php endforeach ?>
		</select> 
		</br>
		</br>

		<label for="name">单位名称</label>
		<input type="input" name="name"/><br /><br />

		<label for="brief">单位简介</label> 
		<textarea type="textarea" name="brief"></textarea><br /><br />
		
		<label for="address">公司地址</label> 
		<input type="input" name="address" /><br /><br />
		
		<label for="logo">公司logo</label> 
		<input type="file" name="logo" size="20" /><br /><br />
		
		<label for="pic">产品图片</label> 
		<input type="file" name="pic" size="20" /><br /><br />

		<label for="affairs">区内事务</label> 
		<input type="input" name="affairs" /><br /><br />
		
		<label for="way">参观路线</label> 
		<input type="input" name="way" /><br /><br />


		<input type="submit" name="submit" value="提交" /> 

	</form>
</div>