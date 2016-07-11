<div class="newli" style=" margin-top: 150px; ">
  <h3>用户管理--修改密码</h3>
  <form action="/index.php/welcome/edit" method="post">
    <div class="nl_det">
      <label class="sizi">旧密码：</label>
      <input type="password" name="oldpassword" class="bzsr"  style=" width: 250px; "/>
      <p class="szts"><span></span></p>
      <label class="sizi">新密码：</label>
      <input type="password" name="newpassword" class="bzsr" style=" width: 250px; "/>
      <p class="szts"><span></span></p>
      <label class="sizi">确认密码：</label>
      <input type="password" name="newpass" class="bzsr" style=" width: 250px; "/>
      <p class="szts"><span></span></p>
      <input type="hidden" name="oldid" value="<?php echo $this->session->userdata('user_id')?>">
      <?php $company_id = $this->session->userdata('company_id')?>
      <?php if(isset($company_id)&&!empty($company_id)):?>
      <input type="hidden" name="type" value="1">
      <?php else :?>
      <input type="hidden" name="type" value="2">
      <?php endif;?>
    </div>
    <div class="caozuo">
      <input type="submit" name="submit" value="提 交" class="b_bnt01"/>
      <input type="button" name="submit" value="取 消" class="b_bnt01" onclick="history.go(-1)"/>
    </div>
  </form>
</div>