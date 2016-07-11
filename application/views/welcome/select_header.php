<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand">
<title>天津滨海高新区公共关系管理系统</title>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link href="/css/select.css" rel="stylesheet" type="text/css" />
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
<div id="header">
  
  <div id="logo"><img src="/images/logo_03.png" /></div>
  <div class="img"><img src="/images/search_btn_07.png"/></div>
  <div id="search">
    <form id="sel_form" action="/index.php/select" method="post">
      <input type="hidden" name="tab" id="tab_name" value="<?=$tab?>" />
      <input type="hidden" id="seltype" name="seltype" value="<?=$type?>" />
      <input class="search_text" type="text" value="<?=$value?>" name="selvalue" id="selvalue" onfocus="if(this.value=='请输入关键词')this.value='';" onblur="if(this.value=='')this.value='请输入关键词';" />
      <input class="search_btn" type="submit" value="查 询" />
    <div class="searchselect"> <span id="type" typename="song">   
      <?
      $arrType = array(
      	'contact'	=> '联系人',
      	'news'	=> 'NewsLetter',
      	'plan'	=> '活动方案',
      	'all'	=> '全　站',
      );
      ?>
      <p id="type" typename="song"><?=$arrType[$type]?></p>
      </span>
      <ul id="selectTypeList">
        <li typename="a"><a href="javascript:;" onclick="$('#seltype').val('contact')">联系人</a></li>
        <li typename="b"><a href="javascript:;" onclick="$('#seltype').val('news')">NewsLetter</a></li>
        <li typename="b"><a href="javascript:;" onclick="$('#seltype').val('plan')">活动方案</a></li>
        <li typename="f"><a href="javascript:;" onclick="$('#seltype').val('all')">全　站</a></li>
      </ul>
    </div>
    </form>
  </div>
  <div id="land"> 
<div id="denglukuang">
<? if($is_login)
{
?>
	<span>你好！<?=$this->session->userdata('user_name')?></span>
	<a href="/index.php/welcome/logout" class="user_tc">[退出]</a>
<?
}
?>
</div>
    <div id="light" class="white_content"> 
    <iframe id="iframe1" src="about:blank" frameBorder="0" marginHeight="0" marginWidth="0" style="position:absolute; visibility:inherit; top:0px;left:0px;width:100%; height:100%;z-index:-1; filter:alpha(opacity=0);"></iframe>
<form id='sub_form' action="/index.php/welcome/login" method="post">
  <h3>用户登录<a href="javascript:void(0)" onclick="$('#light').hide();$('#fade').hide();">关闭</a></h3>
  <input type="text" class="log_sr log_icon1" name="name" id="name" value="" />
  <input type="password" class="log_sr log_icon2" name="pass" id="pass" />
  <p class="zddl"><input name="next" id="next" type="checkbox" value="1" />下次自动登录</p>
  <input type="submit" class="log_bnt" value="登 录" />
  <p id='errmsg' style="color:red"></p>
</form>
    </div>
    <div id="fade" class="black_overlay"></div>
  </div>
  <div class="clear"></div>
</div>
<div id="nav">
	<ul>
    	<li><a href="/">回到首页</a></li>
<? if($is_login)
{
?>
        <li><a href="/index.php/welcome/main">进入系统</a></li>
        <li><a href="#">我的工作</a></li>
        <li><a href="/index.php/contact">联系人</a></li>
        <li><a href="/index.php/news/calendar">NewsLetter</a></li>
        <li><a href="/index.php/news/down">信息推送</a></li>
        <li><a href="#">活动方案</a></li>
        <li><a href="#">专题内容</a></li>
<?
}
else
{
?>
        <li><a href="javascript:;" onclick="document.getElementById('light').style.display='block'; document.getElementById('fade').style.display='block';">进入系统</a></li>
        <li><a href="/index.php/contact">联系人</a></li>
        <li><a href="/index.php/select/newsletter">NewsLetter</a></li>
        <li><a href="#">活动方案</a></li>
        <li><a href="#">专题内容</a></li>
<?
}
?>
    </ul>
</div>