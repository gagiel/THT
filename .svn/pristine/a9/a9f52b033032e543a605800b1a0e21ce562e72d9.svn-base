<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand">
<title>天津滨海高新区公共关系管理系统</title>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.DB_rotateRollingBanner.min.js"></script>
<script src="/js/xw.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide2.js"></script>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link href="/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var selectListShow = 0;
$(function(){
	$("#type,.img").click(function(){
			if (selectListShow){
				$("#selectTypeList").slideUp("fast");
				selectListShow = 0;
			}else{
				$("#selectTypeList").slideDown("fast");
				selectListShow = 1;
			}
			return false;
		});
	$("body").click(function(){
		if (selectListShow){
			$("#selectTypeList").slideUp("fast");
			selectListShow = 0;
		}
	});
	$(".searchselect li").click(function(){
		$("#type").text($(this).text());
		$("#type").attr("typename",$(this).attr("typename"));
		$(this).parent().hide();
	});
	
});	
</script>
</head>

<body>
<div id="content">
<!--<div id="tht"><img src="/images/tht_03.png"/></div>-->
<div id="denglukuang">
<? if($is_login)
{
?>
<a class="denglu" href="/index.php/welcome/logout" class="user_tc">[退出]</a>
<a class="denglu" href="http://www.bhgxq.com/index.php/welcome/edit_password" class="user_tc">[修改密码]</a>
<a class="denglu">你好！<span><?=$this->session->userdata('user_name')?></span></a>
<?
}
?>
</div>
<div id="light" class="white_content">
<form id='sub_form' action="/index.php/welcome/login" method="post">
  <h3>用户登录<a href="javascript:void(0)" onclick="$('#light').hide();$('#fade').hide();">关闭</a></h3>
  <input type="text" class="log_sr log_icon1" name="name" id="name" value="" />
  <input type="password" class="log_sr log_icon2" name="pass" id="pass" />
  <p class="zddl"><input name="next" id="next" type="checkbox" value="1" />下次自动登录</p>
  <input type="submit" class="log_bnt" value="登 录" />
  <p id='errmsg' style="color:red"></p>
</form>
</div>
<div id="tht"><img src="/images/tht_03.png"/></div>
<div id="fade" class="black_overlay"></div>
  <div id="content_inner">
  	<div class="img"><img src="/images/search_btn_07.png"/></div>
    <div id="search">
      <form id="sel_form" action="/index.php/select" method="post">
      	<input type="hidden" id="seltype" name="seltype" value="all" />
        <input class="search_text" type="text" name="selvalue" id="selvalue" value="请输入关键词" onClick="this.focus();" onfocus="if(this.value=='请输入关键词')this.value='';" onblur="if(this.value=='')this.value='请输入关键词';" />
        <input class="search_btn" type="submit" value="查 询" />
	    <div class="searchselect"> 
	      <span id="type" typename="song">全　站</span>
	        <ul id="selectTypeList">
	          <li typename="a"><a href="javascript:;" onclick="$('#seltype').val('contact')">联系人</a></li>
	          <li typename="b"><a href="javascript:;" onclick="$('#seltype').val('news')">NewsLetter</a></li>
              <li typename="c"><a href="javascript:;" onclick="$('#seltype').val('plan')">活动方案</a></li>
	          <li typename="f"><a href="javascript:;" onclick="$('#seltype').val('all')">全　站</a></li>
	        </ul>
	    </div>
      </form>
    </div>
  </div>
</div>
<div id="nav">
  <div id="nav_inner">
    <ul>
<? if($is_login)
{
?>
	  <li><a class="xitong" href="/index.php/welcome/main"></a></li>
      <li><a class="gongzuo" href="#"></a></li>
      <li><a class="lianxiren" href="/index.php/contact"></a></li>
      <li><a class="news" href="/index.php/news/calendar"></a></li>
      <li><a class="xiaoxi" href="/index.php/news/down"></a></li>
      <li><a class="huodong" href="#"></a></li>
      <li><a class="zhuanti" href="#"></a></li>
<?
}
else
{
?>
	  <li><a class="xitong" href="javascript:;" onclick="document.getElementById('light').style.display='block'; document.getElementById('fade').style.display='block'"></a></li>
      <li><a class="lianxiren" href="javascript:;" onclick="$('#seltype').val('contact');$('#sel_form').submit();"></a></li>
      <li><a class="news" href="/index.php/select/newsletter"></a></li>
      <li><a class="huodong" href="#"></a></li>
      <li><a class="zhuanti" href="#"></a></li>
      <li><a class="zhuce" href="javascript:;" onclick="show_register()"></a></li>
<?
}
?>
    </ul>
  </div>
</div>
<div id="logo">
<div id="logo_inner">
  <h1>区内企业</h1>
  <p>TIANJIN BINHAI HI-TECH INDUSTRIAL DEVELOPMENT AREA</p>
  <div class="friend">
    <div class="mr_frbox">
        <img class="mr_frBtnL prev" src="images/prev_29.jpg" />
        <div class="mr_frUl">
            <ul id="mr_fu">
            <? /*
            if(is_array($logos))
            {
            	foreach($logos as $val)
            	{
            ?>
                <li><a href="#">
                    <img src="<?=$val['logo']==''?'/images/imglogo_03.jpg':$val['logo']?>" /><img src="<?=$val['logo']==''?'/images/imglogo_03.jpg':$val['logo']?>" class="preview" />
                </a>
                    
                </li>
            <?	
            	}
            }
            for($i=0;$i<5-count($logos);$i++)
            {
            ?>
                <li><a href="#">
                    <img src="images/imglogo_03.jpg" /><img src="images/imglogo_03.jpg" class="preview"/>
                </a>
                </li>
            <?
            }*/
            ?>
            <?php
            if(is_array($logos))
            {
            	foreach($logos as $val)
            	{
            ?>
            <li><a href="http://prm.tht.gov.cn/index.php/select/companyview/<?=$val->id; ?>"><img src="<?=$val->logo;?>" /><img src="<?=$val->logo; ?>" class="preview"/></a></li>
             <?php
            }
                }
            ?>
            
               <!-- <li><a href="#"><img src="/images/logo/001.jpg" /><img src="/images/logo/001.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/002.jpg" /><img src="/images/logo/002.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/003.jpg" /><img src="/images/logo/003.jpg" class="preview"/></a></li>
                <li><a href="/index.php/select/companyview/1500"><img src="/images/logo/004.jpg" /><img src="/images/logo/004.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/005.jpg" /><img src="/images/logo/005.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/006.jpg" /><img src="/images/logo/006.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/007.jpg" /><img src="/images/logo/007.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/008.jpg" /><img src="/images/logo/008.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/009.jpg" /><img src="/images/logo/009.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/010.gif" /><img src="/images/logo/010.gif" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/011.gif" /><img src="/images/logo/011.gif" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/012.jpg" /><img src="/images/logo/012.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/013.jpg" /><img src="/images/logo/013.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/014.jpg" /><img src="/images/logo/014.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/015.jpg" /><img src="/images/logo/015.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/016.jpg" /><img src="/images/logo/016.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/017.jpg" /><img src="/images/logo/017.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/018.jpg" /><img src="/images/logo/018.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/019.jpg" /><img src="/images/logo/019.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/020.jpg" /><img src="/images/logo/020.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/021.jpg" /><img src="/images/logo/021.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/022.jpg" /><img src="/images/logo/022.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/023.jpg" /><img src="/images/logo/023.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/024.png" /><img src="/images/logo/024.png" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/025.jpg" /><img src="/images/logo/025.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/026.jpg" /><img src="/images/logo/026.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/027.jpg" /><img src="/images/logo/027.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/028.jpg" /><img src="/images/logo/028.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/029.png" /><img src="/images/logo/029.png" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/030.jpg" /><img src="/images/logo/030.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/031.png" /><img src="/images/logo/031.png" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/032.jpg" /><img src="/images/logo/032.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/033.jpg" /><img src="/images/logo/033.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/034.jpg" /><img src="/images/logo/034.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/035.jpg" /><img src="/images/logo/035.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/036.jpg" /><img src="/images/logo/036.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/037.jpg" /><img src="/images/logo/037.jpg" class="preview"/></a></li>
                <li><a href="#"><img src="/images/logo/038.png" /><img src="/images/logo/038.png" class="preview"/></a></li>-->
            </ul>
        </div>
        <img class="mr_frBtnR next" src="images/next_29.jpg" />
    </div>
</div>
    <div id="register" class="white_content" style="height: 500px;top:30%">
        <form id='sub_form' action="/index.php/register/save" method="post">
            <h3>用户注册<a href="javascript:void(0)" onclick="$('#register').hide();$('#fade').hide();">关闭</a></h3>
            <label class="sizi">账号：</label>
            <input type="text" class="log_sr" name="account" id="account" value="" />
            <label class="sizi">手机：</label>
            <input type="text" class="log_sr" name="phone" id="phone" value="" />
            <label class="sizi">姓名：</label>
            <input type="text" class="log_sr" name="user_name" id="user_name" value="" />
            <label class="sizi">密码：</label>
            <input type="password" class="log_sr" name="pass1" id="pass" />
            <label class="sizi">确认密码：</label>
            <input type="password" class="log_sr" name="pass2" id="pass_r" />
            <label class="sizi">部门名称：</label>
            <select style="margin-left: 55px; width: 300px;height: 35px;" name="department" id="department">
                <option value="">--请选择--</option>
                <?php if(!empty($department)){?>
                    <?foreach ($department as $key=>$val){?>
                        <option value="<?= $val->id ?>"><?= $val->name?></option>
                    <?php }?>
                <?php }?>
            </select>
            <input type="button" class="log_bnt" value="注 册" onclick="go_register()"/>
        </form>
    </div>
<script type="text/javascript">
$(document).ready(function () {
 
 /* 图片滚动效果 */
 $(".mr_frbox").slide({
  titCell: "",
  mainCell: ".mr_frUl ul",
  autoPage: true,
  effect: "leftLoop",
  autoPlay: true,
  vis: 8
 });
});
/*用户注册事件*/
function go_register(){
    var name=$("input[name='user_name']").val();
    var phone=$("input[name='phone']").val();
    var account=$("input[name='account']").val();
    var password=$("input[name='pass1']").val();
    var password_r=$("input[name='pass2']").val();
    var department=$("#department").val();
    if(name==null || name==''){
        alert('姓名不能为空');
    }else if(phone==null || phone==""){
        alert('手机号不能为空');
    }else if(account==null || account==""){
        alert('帐号不能为空');
    }else if(password==null || password_r==null || password=="" || password_r==""){
        alert('密码不能为空');
    }else if(department=="" || department==null){
        alert('没有选择部门');
    }
    else{
        $.ajax({
            cache:true,
            type:"POST",
            url:'/index.php/register/save',
            data:{
                'name':name,
                'phone':phone,
                'account':account,
                'password':password,
                'department':department

            },
            async:false,
            error: function(request){
                alert('网络连接异常');
            },
            success: function(data){
                if(data==1){
                    alert('注册成功,请等待审核');
                    $('#register').hide();$('#fade').hide();
                }else if(data==2){
                    alert('注册失败');
                    $('#register').hide();$('#fade').hide();
                }else if(data==3){
                    alert('账号已存在');
                    $('#register').hide();$('#fade').hide();
                }
            }
        });
    }

}
/*用户注册div*/
function show_register(){
    document.getElementById('register').style.display='block';
    document.getElementById('fade').style.display='block';
}
</script>
  <!--<div id="d_tab29">
		<ul class="d_img">						 
			<li class="d_pos1"><img src="/images/img1.jpg" alt=""/></li>
			<li class="d_pos2"><img src="/images/img2.jpg" alt=""/></li>
			<li class="d_pos3"><img src="/images/img1.jpg" alt=""/></li>
			<li class="d_pos4"><img src="/images/img2.jpg" alt=""/></li>
			<li class="d_pos5"><img src="/images/img1.jpg" alt=""/></li>
			<li><img src="/images/img2.jpg"></li>
			<li><img src="/images/img1.jpg"></li>
			<li><img src="/images/img2.jpg"></li>
			<li><img src="/images/img1.jpg"></li>
			<li><img src="/images/img2.jpg"></li>
		</ul>	
		
		<p class="d_prev"><img src="/images/prev_29.jpg" alt=""></p>
		<p class="d_next"><img src="/images/next_29.jpg" alt=""></p>
    </div>

<script>
	$('#d_tab29').DB_rotateRollingBanner({
		key:"c37080",            
		moveSpeed:200,           
		autoRollingTime:2000      
	})
</script>-->
</div>
</div>
<div id="footer">
  <p>版权所有：天津滨海高新技术产业开发区   津ICP备09000137号-4</p>
</div>
</body>
</html>