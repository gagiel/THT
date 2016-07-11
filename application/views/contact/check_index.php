<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>查看名片</p>
    <div class="sst_sm">
      	<?=$select?>
    </div>
  </div>
  <div style="width: 80%; margin: 120px auto; padding-left: 50px; left:auto;position:fixed;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	</div>
	<div class="caozuo8">
	    <a href="/index.php/activity/index_add/<?=$id?>" class="b_bnt01" >往 来</a>
		<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/contact/check_edit/<?=$id?>/<?=$thispage?>'" />
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/contact/index/<?=$thispage?>'" value="back"/>
	</div>
  </div>
  <div class="con_detail" style="top:155px;">	
    <table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tr class="tab_tit">
		<td colspan="4">联系人信息</td>
	  </tr>
	  <tr> 
		<td width="8%" class="cklt">姓 名：</td>
		<td width="42%" class="cknr2"><?=$name?></td>
		<td width="8%" class="cklt">星 级：</td>
		<td width="42%" class="cknr2">
		 <div class="shop-rating"> 
          <ul class="rating-level" id="stars2"> 
             <li><a href="javascript:void(0);" class="one-star" star:value="20"></a></li> 
             <li><a href="javascript:void(0);" class="two-stars" star:value="40"></a></li> 
             <li><a href="javascript:void(0);" class="three-stars" star:value="60"></a></li> 
             <li><a href="javascript:void(0);" class="four-stars" star:value="80"></a></li> 
             <li><a href="javascript:void(0);" class="five-stars" star:value="100"></a></li> 
           </ul> 
           <span id="stars2-tips" class="result"></span> 
           <input type="hidden" id="stars2-input" name="b" value="<?=$star?>" size="2" /> 
         </div>
		</td>
	  </tr>
	  <tr> 
	    <td colspan="4">
		  <table cellspacing="0" cellpadding="0" class="biaozhun2">
		    <?php foreach($type_company_position as $v) :?>
			<tr>
				<td width="10%" class="cklt">分 组：</td>
				<td width="20%" class="cknr2"><?=$v['type_name']?></td>
				<td width="10%" class="cklt">单位名称：</td>
				<td width="30%" class="cknr2"><?=$v['company_name']?></td>
				<td width="10%" class="cklt">职 务：</td>
				<td width="20%" class="cknr2"><?=$v['position']?></td>
            </tr>
			<?php endforeach?>
          </table>
		</td>
	  </tr>
	  <tr id="sjxx"> 
	    <td width="8%" class="cklt">手 机：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?php if(is_array($mobile)):?>
				<?php foreach($mobile as $v) :?>
					<p class="hmyjjh" ><?=$v?></p>
				<?php endforeach?>
			<?php else:?>
				<p class="hmyjjh" ><?=$mobile?></p>
			<?php endif?>
	  </tr>
	  <tr>
	    <td width="8%" class="cklt">电 话：</td>
		<td width="42%" class="cknr2"><?=$tel?></td> 
		<td width="8%" class="cklt">传  真：</td>
		<td width="42%" class="cknr2"><?=$fax?></td>
	  </tr>
	  <tr id="dzxx"> 
		<td width="8%" class="cklt">地 址：</td>
		<td width="92%" colspan="3" class="cknr2">
			<?php if(is_array($address)):?>
				<?php foreach($address as $v) :?>
					<p class="hmyjjh" ><?=$v?></p>
				<?php endforeach?>
			<?php else:?>
				<p class="hmyjjh" ><?=$address?></p>
			<?php endif?>
		</td>
	  </tr>
	  <tr>
	    <td width="8%" class="cklt">E-mail：</td>
		<td width="92%" colspan="3" class="cknr2"><?=$email?></td>
	  </tr>
	  <tr> 
		<td width="8%" class="cklt">名 片：</td>
		<td colspan="3" class="cknr2"><p class="hmyjjh" ><img src="<?=$pic_front==''?'/images/logo_03.jpg':$pic_front?>" id="photo"/><img src="<?=$pic_reverse==''?'/images/logo_03.jpg':$pic_reverse?>" id="photo" class="mor_pic"/></p><input type="button" value="+" class="tj_bnt tabn" id="add_pic" style=" position: relative; top: 10px; "/><input type="button" value="-" class="tj_bnt tabn" id="min_pic" style=" display: none; position: relative; top: 10px; "/></td>
	  </tr>
	  <tr> 
		<td width="8%" class="cklt">名片主人：</td>
		<td width="42%" class="cknr2"><?=$username?></td>
		<td width="8%" class="cklt">公 开：</td>
		<?php if($public == 1):?>
			<td width="42%" class="cknr2">是</td>
		<?php else:?>
			<td width="42%" class="cknr2">否</td>
		<?php endif;?>
	  </tr>
	  <tr> 
		<td width="8%" class="cklt"><input type="button" class="b_bnt01" style=" margin-left: 22px;" id="bnt_more"value="更多选项"/></td>
		<td width="92%" colspan="3" class="cknr2"></td>
	  </tr>
		<tr id="mplr_more" style=" display: none; "> 
			<td width="92%" colspan="4" class="cknr2">
			 <table width="100%" cellspacing="0" cellpadding="0">
			  <tr> 
			   <td width="8%" class="cklt">个人信息：</td>
			   <td width="92%" colspan="3" class="cknr2"><?=$remark?></td>
			  </tr>
			  <tr> 
			   <td width="8%" class="cklt">区内事务：</td>
			   <td width="92%" colspan="3" class="cknr2"><?=$affairs_contact?></td>
			  </tr>
			 </table>
			</td>
		</tr>
	</table>
  </div>
  <div class="caozuo5" style="width: 80%; margin: 10px auto; padding-left: 50px; left:auto;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	</div>
	<div class="caozuo8">
	    <a href="/index.php/activity/index_add/<?=$id?>" class="b_bnt01" >往 来</a>
		<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/contact/check_edit/<?=$id?>/<?=$thispage?>'" />
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/contact/index/<?=$thispage?>'" value="back"/>
	</div>
  </div>
  
</div>
<script>
$(document).ready(function(){
  $("#add_pic").click(function(){
    $(".mor_pic").show();
	 $("#min_pic").show();
	$(this).hide();
  });
  $("#min_pic").click(function(){
    $(".mor_pic").hide();
	 $("#add_pic").show();
	$(this).hide();
  });
});
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
function min_add(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

function delInfo(id)
{
	if(confirm("确认删除该联系人吗？"))
	{
		$.post(
			"/index.php/contact/stop",
			{
				id:id
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert('删除成功');
					window.location.href='/index.php/contact/index';
				}
				else
				{
					alert(data);
				}
			}
		);
	}
}
</script>
<script> 
var TB = function() { 
var T$ = function(id) { return document.getElementById(id) } 
var T$$ = function(r, t) { return (r || document).getElementsByTagName(t) } 
var Stars = function(cid, rid, hid, config) { 
var lis = T$$(T$(cid), 'li'), curA; 
for (var i = 0, len = lis.length; i < len; i++) { 
lis[i]._val = i; 
//通过库中star的值显示星等级
window.onload=function(){
	var starvalue =  document.getElementById('stars2-input').value;
	if(starvalue == 0){
		var level = 0;
	}else{
		var level = starvalue*0.05-1
	}
	T$(rid).innerHTML = '<em>' + starvalue + '</em>' ;
	curA = T$$(T$(cid), 'a')[starvalue*0.05-1]; 
	curA && (curA.className += config.curcss);
} 
//确定star值
/*  lis[i].onclick = function() { 
T$(rid).innerHTML = '<em>' + (T$(hid).value = T$$(this, 'a')[0].getAttribute('star:value')) + '分</em> - ' + config.info[this._val];
curA = T$$(T$(cid), 'a')[T$(hid).value / config.step - 1]; 
alert(T$(hid).value / config.step - 1);
}; */  
lis[i].onmouseout = function() { 
curA && (curA.className += config.curcss); 
} 
lis[i].onmouseover = function() { 
curA && (curA.className = curA.className.replace(config.curcss, '')); 
} 
} 
}; 
return {Stars: Stars} 
}().Stars('stars2', 'stars2-tips', 'stars2-input', { 
'info' : ['', '', '', '', ''], 
'curcss': ' current-rating', 
'step': 20 
}); 
</script>
<script>
$(document).ready(function(){
  $("#bnt_more").click(function(){
    $("#mplr_more").fadeToggle("fast");
  });
});
</script>
<script type="text/javascript">
$(function(){
	var h = 235;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
});
</script>