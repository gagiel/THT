<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>修改密码</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail" >
	<form action="/index.php/user/pass" method="post" onsubmit="return check();">
	  <div class="nl_det" style=" width: 320px; padding: 10px; margin: 10px; background: #e7e7e7; ">
		<label class="sizi">账 号：</label>
		<label class="sizi"><?=$this->session->userdata('user_account')?></label>
	    <input type="hidden" name="name" value="<?=$this->session->userdata('user_account')?>" />
	    <p class="szts"><span></span></p>
		<label class="sizi">原 密 码：</label>
	    <input type="password" class="bzsr" name="opass" id="opass" />
	    <p class="szts"><span></span></p>
		<label class="sizi">新 密 码：</label>
	    <input type="password" class="bzsr" name="npass" id="npass" />
	    <p class="szts"><span></span></p>
		<label class="sizi">确认密码：</label>
	    <input type="password" class="bzsr" name="npass2" id="npass2" />
		<p class="szts"><span></span></p>
	    <div class="caozuo" style=" margin-left: 100px; ">
		  <input type="submit" class="b_bnt01" value="提 交"/>
	    </div>
	  </div>
	</form>
  </div>
</div>
<script>
<? 
if($errorMsg!='')
{
?>
alert("<?=$errorMsg?>");
<?
}
?>
function check()
{
	if($('#opass').val()=='')
	{
		alert("请填写原密码");
		return false;
	}
	if($('#npass').val()=='')
	{
		alert("请填写新密码");
		return false;		
	}
	if($('#npass').val()!=$('#npass2').val())
	{
		alert("两次密码不一致");
		return false;		
	}
	return true;
}
</script>