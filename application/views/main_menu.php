<?
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
$company_id = $this->session->userdata('company_id');
$i=0;
$arr_menu = array();
if(in_array('1',$arr_jurisdict)){
	$arr_menu['user'] = $i;
	$i++;
}
$arr_menu['concact'] = $i;
$i++;
if(in_array('13',$arr_jurisdict)){
	$arr_menu['company'] = $i;
	$i++;
}
$arr_menu['news'] = $i;
$i++;
if(in_array('11',$arr_jurisdict)){
	$arr_menu['remind'] = $i;
	$i++;
}
if(in_array('12',$arr_jurisdict)){
	$arr_menu['plan'] = $i;
	$i++;
}
//权限跳转左侧菜单标识(工作方案)
if(in_array('12',$arr_jurisdict)){
	$arr_menu['plan_r'] = $i;
	$i++;
}
if(in_array('14',$arr_jurisdict)){
	$arr_menu['stock'] = $i;
	$i++;
}
if(in_array('17',$arr_jurisdict)){
	$arr_menu['wechat'] = $i;
	$i++;
}
if(in_array('20',$arr_jurisdict)){
	$arr_menu['event'] = $i;
	$i++;
}
/*if(in_array('25',$arr_jurisdict)){
	$arr_menu['investment'] = $i;
	$i++;
}*/



?>
<script src="/js/jquery.cookies.js"></script>
<div class="submenu">
<input id="curnavi" type="hidden" value="<?=isset($menu)&&isset($arr_menu[$menu])?$arr_menu[$menu]:'-1'?>" />
  <!--<div class="user_b">
    <div class="user_photo"><img name="" src="/images/mrtx.jpg" alt="用户头像" /></div>
    <p>你好！<span><?=$this->session->userdata('user_name')?></span>欢迎登录</p>
    <p><a href="/index.php/welcome/logout" class="user_tc">退出</a><a href="/index.php/user/pass" class="user_sz">修改密码</a></p>
  </div>-->
  <div class="bcon">
      <div class="list_lh">
        <ul id="my_remind">
		</ul>
<!--	    <ul id="my_remind_r">-->
<!--		</ul>-->
      </div>
    </div>
  <!--<p class="sm_tit">导航菜单</p>-->
<? if(is_array($arr_jurisdict)){ ?>
  <div class="show_btn" id="show_menu"><span>&nbsp;&nbsp;展开菜单</span></div>
  <div class="container">
  <div class="hidden_btn" id="hidden_menu"><span >&nbsp;&nbsp;收起菜单</span></div>
    <? if(in_array('1',$arr_jurisdict)){ ?>
    <div class="menutitle"><span class="gzry_s">工作人员</span></div>
    <div class="menucontent">
      <ul>
           <? if(in_array('2',$arr_jurisdict)){ ?>
        <li><a href="/index.php/department">部门管理</a></li>
         <? } ?>
         <? if(in_array('3',$arr_jurisdict)){ ?>
        <li><a href="/index.php/user">人员管理</a></li>
        <? } ?>
		  <? if(in_array('31',$arr_jurisdict)){ ?>
			  <li><a href="/index.php/user/register_list">注册管理</a></li>
		  <? } ?>
      </ul>
    </div>
    <? } ?>


	<div class="menutitle">
            <span class="lxr_s" onclick="location.href='/index.php/contact/';">名片系统</span>
        </div>
    <div class="menucontent">
      <ul>

		<? if(in_array('6',$arr_jurisdict)){ ?>
		<li><a href="/index.php/contact/add">名片录入</a></li>
		<? } ?>
		<? if(in_array('22',$arr_jurisdict)){ ?>
		<li><a href="/index.php/contact/contact_manage">内部名片</a></li>
		<? } ?>
                <? if(in_array('5',$arr_jurisdict)){ ?>
                <li><a href="/index.php/company_type/index">名片分组</a></li>
		<? } ?>
		<? if(in_array('7',$arr_jurisdict)){ ?>
		<li><a href="/index.php/activity/index">往来活动</a></li>
		<? } ?>
      </ul>
    </div>
    <? if(in_array('13',$arr_jurisdict)){ ?>
	  <div class="menutitle"><span class="dwgl_s">单位管理</span></div>
	  <div class="menucontent">
		  <ul>
			  
				  <li><a href="/index.php/company/index">单位管理</a></li>
			
			  <? if(in_array('29',$arr_jurisdict)){ ?>
				  <li><a href="/index.php/account/index">单位帐号管理</a></li>
			  <? } ?>
			  <li>
				  <? if(isset($company_id)&&!empty($company_id)):?>
					  <a href="/index.php/edit_company_info/user_submit/<? echo $company_id ?>">单位信息变更</a>
				  <? else:?>
					  <a href="/index.php/edit_company_info/index">单位信息变更</a>
				  <? endif;?>
			  </li>

		  </ul>
	  </div>
       <? } ?>     
	<div class="menutitle"><span class="xxts_s" onclick="location.href='/index.php/news/calendar';">NewsLetter</span></div>
    <div class="menucontent">
      <ul>
  		<? if(in_array('8',$arr_jurisdict)){ ?>
        <li><a href="/index.php/news/monthly_report">月刊管理</a></li>
  		<? } ?>
  		<? if(in_array('9',$arr_jurisdict)){ ?>
        <li><a href="/index.php/news/download">短信推送</a></li>
  		<? } ?>
          <? if(in_array('9',$arr_jurisdict)){ ?>
          <li><a href="/index.php/news/wechat_pushview">微信推送</a></li>
  		<? } ?>      
  		<? if(in_array('8',$arr_jurisdict)){ ?>
        <li><a href="/index.php/news/type_list">新闻类型</a></li>
  		<? } ?>
  		<? if(in_array('10',$arr_jurisdict)){ ?>
        <li><a href="/index.php/news/sender">推送号码管理</a></li>
        <li><a href="/index.php/news/group">推送分组管理</a></li>
  		<? } ?>
      </ul>
    </div>
    <? if(isset($company_id)&&!empty($company_id)):?>
	<? else:?>
	<div class="menutitle"><span class="gztx_s" onclick="location.href='/index.php/remind/index';">工作提醒</span></div>
	 <? if(in_array('11',$arr_jurisdict)){ ?>
	<div class="menucontent">
	  <ul>
	    <li><a href="/index.php/remind/manage">提醒管理</a></li>
	  </ul>
	</div>
	<? }else{
	?>
	<div class="menucontent" style="height:0px;padding:0px;"></div>
	<?
	} ?>
	<? endif;?>

	<? if(in_array('12',$arr_jurisdict)){ ?>
	<div class="menutitle"><span class="hdfa_s" onclick="location.href='/index.php/plan/index';">活动方案</span></div>
    <div class="menucontent">
      <ul>
        <? if(in_array('27',$arr_jurisdict)){ ?>  
	 <li><a href="/index.php/plan/mass_qun_index">短信群发</a></li>
          <? } ?>
         <? if(in_array('28',$arr_jurisdict)){ ?>
        <li><a href="/index.php/plan/smsreport">短信报告</a></li>
         <? } ?>
<!--        <li><a href="/index.php/plan/templet">模板管理</a></li>-->
      </ul>
    </div>
    <? } ?>
	  <? if(in_array('30',$arr_jurisdict)){ ?>
	  <div class="menutitle"><span class="hdfa_s" onclick="location.href='/index.php/plan_r/index';">工作方案</span></div>
	  <div class="menucontent">
		  <ul>
			  <li><a href="/index.php/plan_r/templet">模板管理</a></li>
		  </ul>
	  </div>
	  <? } ?>
	<? if(in_array('14',$arr_jurisdict)){ ?>
	<div class="menutitle"><span class="wpgl_s" onclick="location.href='/index.php/stock/index';">物品管理</span></div>
    <div class="menucontent" style="height:0px;padding:0px;"></div>
    <? } ?>
	<? if(in_array('17',$arr_jurisdict)){ ?>
	<div class="menutitle"><span class="wxgl_s">微信管理</span></div>
    <div class="menucontent">
      <ul>
        <li><a href="/index.php/wechat/set">系统回复设置</a></li>
        <li><a href="/index.php/wechat/jyxc">建言献策</a></li>
      </ul>
    </div>
    <? } ?>
    <? if(in_array('20',$arr_jurisdict)){ ?>
	<div class="menutitle"><span class="dsj_s" onclick="location.href='/index.php/event/view';">大事记查看</span></div>
    <div class="menucontent">
      <ul> 
        <? if(in_array('21',$arr_jurisdict)){ ?>
      	<li><a href="/index.php/event/index">大事记管理</a></li>
      	<?} ?>
	  </ul>
    </div>
    <? } ?>
<!--
      <? if(in_array('24',$arr_jurisdict)){ ?>
	<div class="menutitle"><span class="yrz_s">易融资</span></div>
    <div class="menucontent">
      <ul> 
        <? if(in_array('25',$arr_jurisdict)){ ?>
      	<li><a href="/index.php/investment/index">投资意向管理</a></li>
      	<?} ?>
	  </ul>
      <ul> 
        <? if(in_array('26',$arr_jurisdict)){ ?>
      	<li><a href="/index.php/bank/index">信贷业务管理</a></li>
      	<?} ?>
	  </ul>
    </div>
    <? } ?>
-->
    <div class="menutitle"><span class="xgmm_s" onclick="location.href='/index.php/welcome/edit_password';">修改密码</span></div>
  </div>
<? } ?>
</div>
<?
if(isset($menu)&&isset($arr_menu[$menu])&&is_array($arr_jurisdict))
{
?>
<script>
var curnavi = $('#curnavi').val();
$('.menutitle').eq(curnavi).next("div").slideToggle("fast")
.siblings(".menucontent:visible").slideUp("fast");
$('.menutitle').eq(curnavi).toggleClass("activetitle");
$('.menutitle').eq(curnavi).siblings(".activetitle").removeClass("activetitle");
</script>
<?
}
?>
<script type="text/javascript" src="/js/scroll.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.list_lh li:even').addClass('lieven');
	
    $("#show_menu").click(function() {
		$("#show_menu").css("display","none");
		$(".container").css("display","block");
		rowUp($(".container").height());
		$.cookies.set('hide_menu','0');
	});
	$("#hidden_menu").click(function() {
		$(".container").css("display","none");
		$("#show_menu").css("display","block");
		rowUp($("#show_menu").height());
		$.cookies.set('hide_menu','1');
	});
	get_my_remind();
	//get_my_remind_r();
	if($.cookies.get('hide_menu')==1)
	{
		$("#hidden_menu").click();
	}
});
//function get_my_remind_r(){
//	$.post(
//		"/index.php/remind_r/get_my_remind",
//		{},
//		function (data) //回传函数
//		{
//			$("#my_remind_r").html(data);
//			rowUp($(".container").height());
//			setTimeout("get_my_remind();",10*60*1000);
//		}
//	);
//}
function get_my_remind()
{
	$.post(
		"/index.php/remind/get_my_remind",
		{},
		function (data) //回传函数
		{
			$("#my_remind").html(data);
			rowUp($(".container").height());
			setTimeout("get_my_remind();",10*60*1000);
		}
	);
}
function rowUp(h)
{
	h = 155;
	$("div.list_lh").height($(window).height()-h);
	$(window).resize(function(){
		$("div.list_lh").html($("div.list_lh").html());
		$("div.list_lh").height($(window).height()-h);
	});
	
	$("div.list_lh").myScroll({
		speed:40, //数值越大，速度越慢
		rowHeight:55 //li的高度
	});
}
function read(obj,state)
{
	id = obj.parentNode.parentNode.value
	$.post(
		"/index.php/remind/read",
		{
			id:id,
			state:state
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				if(state=='1')
				{
					obj.parentNode.style.display = "none";
					$("#remind_"+id).css("color","gray");
				}
				else
				{
					obj.parentNode.parentNode.style.display = "none";
				}
				
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>