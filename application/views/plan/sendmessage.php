<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>活动方案>方案管理>发送短信</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
   <div style="margin:10px; min-width:900px;">
    <div style="float:left;width:680px;z-index:999;">
	  <textarea id="plan" name="plan" cols="80" rows="30" ><?=$info->info?></textarea>
    </div>
    <div style="float:left; min-width:290px;">
	    <label class="sizi">测试号码：</label>
	    <input type="text" class="bzsr" id="phone" name="phone" value=""/>
	    <p class="szts"><span></span></p>
	    <input type="button" id="btn" name="btn" value="推送测试" onclick="testpush()"/>
	    <p class="szts"><span></span></p>
        <label class="sizi">发送范围：</label>
        <input type="button" style="margin:5px; padding:0 5px;" value="全选" onclick="checkall(true)" />
        <input type="button" style="margin:5px; padding:0 5px;" value="反选" onclick="recheck()" />
        <input type="button" style="margin:5px; padding:0 5px;" value="取消" onclick="checkall(false)" />
        <p class="szts"><span></span></p>
        <div id="CNLTreeMenu1" style="margin-left:50px;">
        <ul>
        <? 
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
        	$users = explode(',',$info->users);
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <input type="checkbox" name="range_department" id="d_<?=$i?>" value="<?=$d->id?>" onclick="change(<?=$i?>,this.checked);"/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
            <ul class="Child" id="d_u_<?=$i?>">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <img class="s" src="/images/s.gif" alt="展开/折叠">
              <input type="checkbox" name="range_user" id="u_<?=$j?>" value="<?=$u->id?>" class="check_<?=$i?>"<?=in_array($u->id,$users)?' checked':''?> />
              <span onClick="$('#u_<?=$j?>').click();"><?=$u->name?></span>
            </li>
            <?
            		}
            ?>
            </ul>
          </li>
          
            <?
            	}
          	}
        }
        ?>
        </ul>
     
    </div>
   </div>
  </div>
  <div class="caozuo5">
    <input type="button" id="btn_send" class="b_bnt01" value="发 送" />
  </div>
</div>
<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	$('#btn_send').click(function(){
		var text = $('#plan').val();
		var flag = true;
		var length = getByteLen(text);
		//alert(length);
		if(length<=0){
			alert('内容不能为空');
			flag = false;
		}
		var user='';
		$('input[name="range_user"]').each(function(){
			if(this.checked)
			{
				if(user!='')user += ',';
				user += $(this).val(); 
			}
		});
		if(flag){
			$.post(
				"/index.php/plan/pushmessage",
				{
					text	: $('#plan').val(),
					user	: user
				},
				function (data) //回传函数
				{
					alert(data);
				}
			);
		}
	});
});

function getByteLen(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
       var length = val.charCodeAt(i);
       if(length>=0&&length<=128)
        {
            len += 1;
        }
        else
        {
            len += 2;
        }
    }
    return len;
}

function testpush(){
	var phone = $('#phone').val();
	var flag = true;
	if(phone.length == 0){
		alert('号码不能为空');
		flag = false;
	}
	if(flag){
		$.post(
			"/index.php/plan/testpush",
			{
				text	: $('#plan').val(),
				phone	: phone
			},
			function (data) //回传函数
			{
				alert(data);
			}
		);
	}
}

//全选、取消全部
function checkall(check)
{
	$("input[type='checkbox']").each(function(){
		this.checked=check;
	});
}
//反选
function recheck()
{
	$("input[type='checkbox']").each(function(){
		this.checked=!this.checked;
	});
}

function change(i,checked) {
	$("input[type='checkbox']").each(function(){
		if(this.className=='check_'+i)
		this.checked=checked;
	});
}
</script>