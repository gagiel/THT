<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>名片编辑</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>

<input type="hidden" id="pic_id" value="" />
<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
<form id="pic_form" name="pic_form" action="/index.php/contact/pic" encType="multipart/form-data"  method="post" target="pic_frame">
<input type="file" class="file" id="i_file" name="i_file" onchange="this.form.submit();" style="position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
</form>
  
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/contact/save/edit" id="sub_form">
  	<input type="hidden" id="del_relax" name="del_relax" value="0" />
  	<input type="hidden" value="<?=$thispage?>" name="thispage"/>
  	<input type="hidden" value="<?=$info['id']?>" name="id"/>
  	
    <div class="caozuo4" >
      <? /*<input type="button" class="b_bnt01" value="名片扫描" onClick="scan()" <?=$usingie?'':'disabled="true" style="color:gray"'?>/>*/?>
      <?=$usingie?'<iframe name="scan_frame" id="scan_frame" src="/CardReading/index.html" style="display:none"></iframe>':'<font style="color:red;line-height: 35px;">扫描控件只支持IE浏览器</font>'?>
    
      <input type="button" class="b_bnt01" value="返 回" onclick="location.href='/index.php/contact/view/<?=$info['id']?>/<?=$thispage?>'" style="float:right;"/>
      <? /*<input type="button" class="b_bnt01" value="保 存" onclick="checksubmit()" style="float:right;"/>*/?>
    </div>
    
    <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">姓 名：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="name" id="name" value="<?=$info['name']?>" /></td>
          <td width="8%" class="cklt">星 级：</td>
          <td width="42%" class="cknr2"><div class="shop-rating">
              <ul class="rating-level" id="stars2">
                <li><a href="javascript:void(0);" class="one-star" star:value="20"></a></li>
                <li><a href="javascript:void(0);" class="two-stars" star:value="40"></a></li>
                <li><a href="javascript:void(0);" class="three-stars" star:value="60"></a></li>
                <li><a href="javascript:void(0);" class="four-stars" star:value="80"></a></li>
                <li><a href="javascript:void(0);" class="five-stars" star:value="100"></a></li>
              </ul>
              <span id="stars2-tips" class="result"></span>
              <input type="hidden" id="stars2-input" name="star" value="<?=$info['star']?>" size="2" />
            </div></td>
        </tr>
        <tr>
          <td colspan="4">
            <input type="hidden" id="c_value" value="" />
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                  <td width="25%">分 组</td>
                  <td width="20%">单位名称</td>
                  <td width="10%">网址</td>
                  <td width="10%">邮编</td>
                  <td width="10%">职 务</td>
                  <td width="15%">单位落户</td>
                <td width="10%"><input name="" type="button" value="新增" class="s_bnt01" id="add_company"/></td>
              </tr>
              <? 
              $i = 0;
              if(is_array($info['company_id']))
              {
              	foreach($info['company_id'] as $k => $v)
              	{
              		$i = $k+1;
              ?>
              <tr>
                <td id="td_company_type_<?=$i?>">
				  <p id="company_tname_<?=$i?>"><?=$info['type_name'][$k]?></p>
				  <input type="hidden" id="company_type_<?=$i?>" name="typeid[]" value="<?=$info['type_id'][$k]?>"/>
				</td>
                <td style=" position: relative;">
				  <input type="text" id="company_name_<?=$i?>" name="companyname[]" value="<?=$info['company_name'][$k]?>" class="bzsr companyname" autocomplete="off"  onkeyup="company_input(event,this.value,<?=$i?>);" />
				  <input type="hidden" value="<?=$v?>" id="company_id_<?=$i?>" name="companyid[]"/>
				  <div id="company_sel_<?=$i?>" style ="  position: absolute; top: 32px; left: 133px; width:250px; background: #fff; border:solid 1px #aaa; display:none; text-align:left;z-index:1; "></div>
                </td>
                <td id="td_company_url_<?=$i?>">
                    <input type="text" class="bzsr" id="company_url_<?=$i?>" value="<?=$info['url'][$k]?>" name="url[]"/>
                </td>
                  <td id="td_company_postcode_<?=$i?>">
                      <input type="text" class="bzsr" id="company_postcode_<?=$i?>" value="<?=$info['postcode'][$k]?>" name="postcode[]"/>
                  </td>
                <td>
                  <input type="text" class="bzsr" id="position_<?=$i?>" name="position[]" value="<?=$info['position'][$k]?>" />
                </td>
                 <td id="td_company_settle_<?=$i?>">
                    <p id="company_sname_<?=$i?>"><?=$info['settlename'][$k]?></p>
                    <input type="hidden" id="company_settle_<?=$i?>" name="settle[]" value="<?=$info['settle'][$k]?>"/>
                </td>
                <td>
                  <input type="hidden" id="relax_<?=$i?>" name="relax[]" value='<?=$info['relax'][$k]?>'/>
                  <? if($k>0) {?><input type="button" value="删除" class="s_bnt01 red" onclick="del_company(<?=$info['relax'][$k]?>,this)" /><? }?>
                </td>
              </tr>
              <?
              	}
              }
              $i++;
              ?>
              <tr id="last_company">
                <td colspan="3" style="height:0px;">
                  <input type="hidden" id="company_num" value="<?=$i?>" />
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php if(is_array($mobile)){
            foreach($mobile as $key=>$v) { 
             if($key==0){
            ?>
		<tr>
                    <td width="8%" class="cklt">手 机：</td>
                    <td width="92%" colspan="3" class="cknr2">
			<input type="text" class="bzsr" name="mobile[]" id="mobile" value="<?=$v?>"/>
                        <input type="button" value="+" class="tj_bnt" id="add_mob"/>     
                    </td>
               </tr>
             <?php
             }else{
                 ?>
                <tr class='msj'>
			     <td width='8%'></td>
			      <td width='92%' colspan='3' class='cknr2'>
			        <input type='text' class='bzsr' name='mobile[]' id='' value='<?=$v?>'/>
			        <input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>
			      </td>
	         </tr>
         <?php }}}?>
        <tr id="sjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <?php if(is_array($tel)) {
             foreach($tel as $key=>$v){
             if($key==0){
             ?>
          <tr>
          <td width="8%" class="cklt">电 话：</td>
          <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr" name="tel[]" id='tel' value="<?=$v?>"/>
              <input type="button" value="+" class="tj_bnt" id="add_tel"/>
          </td> 
        </tr>
         <?php }else{?>
                 <tr class='msj'>
			     <td width='8%'></td>
			      <td width='92%' colspan='3' class='cknr2'>
			        <input type='text' class='bzsr' name='tel[]' id='' value='<?=$v?>'/>
			        <input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>
			      </td>
	         </tr>
        <?php }}}?>
         <tr id="dhxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <?php if(is_array($fax)) {
            foreach($fax as $key=>$v){ 
              if($key==0){
            ?>
        <tr>
          <td width="8%" class="cklt">传  真：</td>
          <td width="42%" class="cknr2">
              <input type="text" class="bzsr" name="fax[]" id="fax" value="<?=$v?>" />
              <input type="button" value="+" class="tj_bnt" id="add_fax"/>
              </td>
        </tr>
        <?php }else{?>
                 <tr class='msj'>
			     <td width='8%'></td>
                  <td width='92%' colspan='3' class='cknr2'>
                    <input type='text' class='bzsr' name='fax[]' id='' value='<?=$v?>'/>
                    <input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>
                  </td>
	         </tr>
        <?php }}}?>
        <tr id="czxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <?php 
        if(is_array($email)){ 
            foreach($email as $key=>$v){ 
               if($key==0){ 
            ?>
         <tr>
          <td width="8%" class="cklt">E-mail：</td>
          <td width="92%" class="cknr2">
              <input type="text" class="bzsr" name="email[]" id="email" value="<?=$v?>"/>
              <input type="button" value="+" class="tj_bnt" id="add_email"/> 
          </td>
        </tr>
        <?php }else{?>
        <tr class='msj'>
			     <td width='8%'></td>
			      <td width='92%' colspan='3' class='cknr2'>
			        <input type='text' class='bzsr' name='email[]' id='' value='<?=$v?>'/>
			        <input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>
			      </td>
	         </tr>
        <?php }}}?>
         <tr id="yjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <?php if(is_array($address)){
            foreach($address as $key=>$v) {
             if($key==0) {     
?>
        <tr>
          <td width="8%" class="cklt">地 址：</td>
          <td width="92%" colspan="3" class="cknr2">
			<input type="text" class="bzsr8" name="address[]" id="address" value="<?=$v?>"/>
                        <input name="" type="button" value="+" class="tj_bnt" id="add_addr"/>
          </td>
        </tr>
         <?php }else{?>
         <tr class='msj'>
			     <td width='8%'></td>
			      <td width='92%' colspan='3' class='cknr2'>
			        <input type='text' class='bzsr' name='address[]' id='' value='<?=$v?>'/>
			        <input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>
			      </td>
	         </tr>
        <?php }}}?>
        <tr id="dzxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
		<tr>
          <td width="8%" class="cklt">名片主人：</td>
          <td width="42%" class="cknr2">
            <span id="owner_show" style="float:left;line-height: 35px;"><?=isset($owner_name)?$owner_name:''?></span>
            <input type="button"  class="b_bnt01" value="选 择" onclick="$('#wincover').show();$('#winregister').center();" />
            <input type="hidden" name="owner" id="owner" value="<?=$info['owner']?>" />
          </td>
          <td width="8%" class="cklt">公开：</td>
          <td width="42%" class="cknr2"><input name="public" type="checkbox" value="1" /></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">名 片：</td>
          <td colspan="3" class="cknr2">
		    <table width="100%" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="300">
		          <p>
				    <input type='text' class='bzsr' id='front' name="front" style="width:150px;" value="<?=$info['pic_front']?>" /> 
				    <input type="button" value="扫描" class="s_bnt01" <?=$usingie?'':'disabled="true"'?> style="margin:5px 2px; height:25px;<?=$usingie?'':'color:gray;'?>" onclick="scan1('front')" />
				    <!--<input type="button" value="上传" class="s_bnt01" style="margin:5px 2px; height:25px;" onclick="$('#pic_form').submit();" />-->
				    <input type="button" value="浏览" class="s_bnt01" style="margin:5px 2px; height:25px;" onclick="$('#pic_id').val('front');$('#i_file').click();" />
			      </p>
		          <p class="hmyjjh" ><img src="<?=$info['pic_front']==''?'/images/logo_03.jpg':$info['pic_front']?>" id="front_img" style="margin-left:0px;" onclick="$('#front_img').attr('src',$('#front').val())" title="点击刷新图片" /></p>
		        </td>
		        <td width="300" class="mor_pic" style="padding-left:10px;">
		          <p>
				    <input type='text' class='bzsr' id='reverse' name="reverse" style="width:150px;" value="<?=$info['pic_reverse']?>" /> 
				    <input type="button" value="扫描" class="s_bnt01" <?=$usingie?'':'disabled="true"'?> style="margin:5px 2px;<?=$usingie?'':'color:gray;'?>" onclick="scan1('reverse')" title="点击刷新图片" />
				    <!--<input type="button" value="上传" class="s_bnt01" style="margin:5px 2px;" onclick="$('#pic_form').submit();" />-->
				    <input type='button' value='浏览' class="s_bnt01" style="margin:5px 2px;" onclick="$('#pic_id').val('reverse');$('#i_file').click();" />
				  </p>
		          <p class="hmyjjh" ><img src="<?=$info['pic_reverse']==''?'/images/logo_03.jpg':$info['pic_reverse']?>" id="reverse_img" style=" margin-left:0px;" onclick="$('#reverse_img').attr('src',$('#reverse').val())"/></p>
		        </td>
		        <td align="left" valign="top" style="text-align:left;padding-left:10px;">
		          <span>*图片尺寸：300*200PX</span>
		          <br /><br />
		          <input type="button" value="+" class="tj_bnt tabn" id="add_pic" style=" position: relative; top: 10px; "/>
		          <input type="button" value="-" class="tj_bnt tabn" id="min_pic" style=" display: none; position: relative; top: 10px; "/>
		        </td>
		      </tr>
		    </table>
        </tr>
        <tr>
          <td width="8%" class="cklt"><input type="button" class="b_bnt01" style=" margin-left: 22px;" id="bnt_more" value="更多选项"/></td>
          <td width="92%" colspan="3" class="cknr2"></td>
        </tr>
        <tr id="mplr_more" style=" display: none; ">
          <td width="92%" colspan="4" class="cknr2"><table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%" class="cklt">个人信息：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="remark" cols="" rows="" class="bzsr4"><?=$info['remark']?></textarea></td>
              </tr>
              <tr>
                <td width="8%" class="cklt">区内事务：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="affairs" cols="" rows="" class="bzsr4" id="affairs" ><?=$info['affairs_contact']?></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="caozuo5">
      <input type="botton" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
      <input type="button" class="b_bnt01" value="返 回" onclick="location.href='/index.php/contact/view/<?=$info['id']?>/<?=$thispage?>'"/>
    </div>
  </form>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister">
  <h3 id="div_title">名片录入--选择名片主人</h3>
  <div class="nl_det">
        <div id="CNLTreeMenu1" style="height:200px;">
        <ul>
        <? 
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <span  onClick="return false;"><?=$d->name?></span>
            <ul class="Child" id="d_u_<?=$i?>">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <input name="checkedid[]" type="checkbox" value="<?=$u->id?>" />
              <input name="checkedname[]" type="hidden" value="<?=$u->name?>" />
              <span><?=$u->name?></span>
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
  <div class="caozuo" id='create_div'>
      <input type="button" class="b_bnt01" value="确定" onclick="confirmOwn()" />
	  <input type="button" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();" />
  </div>
</div>

<script>
$(document).ready(function(){
	
	/* DIV高度随窗口变化 */
	$(function(){
		var h = 225;
		$('.con_detail').height($(window).height()-h);
		$(window).resize(function(){
			$('.con_detail').height($(window).height()-h);
		});
	});
	$('#del_relax').val("0");
	
	/* 添加单位 */
	$("#add_company").click(function(){
		var i = parseInt($("#company_num").val()) + 1;
        var tr = '<tr>'
            +   '<td id="td_company_type_' + i + '">'
            +     '<p id="company_tname_' + i + '">---</p>'
            +     '<input type="hidden" id="company_type_' + i + '" name="typeid[]" value=""/>'
            +   '</td>'
            +   '<td style=" position: relative;" >'
            +     '<input type="text" id="company_name_' + i + '" name="companyname[]" class="bzsr companyname" autocomplete="off"  onkeyup="company_input(event,this.value,' + i + ')" />'
            +     '<input type="hidden" value="" id="company_id_' + i + '" name="companyid[]">'
            +     '<div id="company_sel_' + i + '" style ="position: absolute; top: 32px; left: 133px; width:250px; background: #fff; text-align:left; border:solid 1px #aaa; display:none;"></div>'
            +   '</td>'
            +    '<td id="td_company_url_'+i+'">'
            +    '<p id="company_curl_'+i+'">-</p>'
            +    '<input type="hidden" id="company_url_'+i+'" name="url[]" value=""/>'
            +    '</td>'
            +    '<td id="td_company_postcode_'+i+'">'
            +    '<p id="company_cpostcode_'+i+'">-</p>'
            +    '<input type="hidden"  id="company_postcode_'+i+'" name="postcode[]" value=""/>'
            +    '</td>'
            +   '<td>'
            +     '<input type="text" class="bzsr" name="position[]"/>'
            +   '</td>'
            +    '<td id="td_company_settle_'+i+'">'
            +        '<p id="company_sname_'+i+'">---</p>'
            +        '<input type="hidden" id="company_settle_'+i+'" name="settle[]" value=""/>'
            +     '</td>'
            +   '<td>'
            +     '<input type="hidden" id="relax_' + i + '" name="relax[]" />'
            +     '<input type="button" value="删除" class="s_bnt01 red" onclick="del_company(0,this)" />'
            +   '</td>'
            + '</tr>';
		$("#last_company").before(tr);
		
		$("#company_num").val(i);
	});

	/* 添加手机 */
	$("#add_mob").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='mobile[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#sjxx").before(tr);
	});
	 /*添加电话*/
	$("#add_tel").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='tel[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dhxx").before(tr);
	});
	 /*添加传真*/
	$("#add_fax").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='fax[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#czxx").before(tr);
	});
        /*添加Email*/
        $("#add_email").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='email[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#yjxx").before(tr);
	});
	/* 添加地址 */
	$("#add_addr").click(function(){
		var tr = "<tr class='mdz'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr8' name='address[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_addr(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dzxx").before(tr);
	});
	
	/* 添加名片图片2 */
	$("#add_pic").click(function(){
		$(".mor_pic").show();
		$("#min_pic").show();
		$(this).hide();
	});
	/* 删除名片图片2 */
	$("#min_pic").click(function(){
		$(".mor_pic").hide();
		$("#add_pic").show();
		$(this).hide(); 
	});
	
	/* 更多选项 */
	$("#bnt_more").click(function(){
		$("#mplr_more").fadeToggle("fast");
	});
});
/* 删除单位 */
function del_company(companyid,obj){
	$('#del_relax').val($('#del_relax').val()+','+companyid);

	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除电话 */
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除地址 */
function min_addr(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

/******** 调用控件 ********/
var isLoad = false;//已加载
var isCard = false;//是否扫描名片信息
var pic_id = 'front';
/* 名片扫描 */
function scan()
{
	if(!isLoad)
	{
		window.frames["scan_frame"].LoadRecogKenal();
		isLoad = true;
	}
	isCard = true;
	pic_id = 'front';
	
	window.frames["scan_frame"].RecognizeImg();
}
/* 图片扫描 */
function scan1(id)
{
	if(!isLoad)
	{
		window.frames["scan_frame"].LoadRecogKenal();
		isLoad = true;
	}
	isCard = false;
	pic_id = id;
	
	window.frames["scan_frame"].RecognizeImg();
}
/* 名片扫描后图片处理 */
function scan_pic(src,info)
{
	$("#"+pic_id).val(src);
	$("#"+pic_id+"_img").attr('src',src);
	
	/* 识别 */
	if(isCard)
	{
		var arr = info.split("\r\n");
		if(arr[0]=='识别成功')
		{
			for(var i=1;i<arr.length;i++)
			{
				if(arr[i]=='')continue;
				var t = arr[i].toString().indexOf(":");
				if(t>0)
				{
					var name = arr[i].substr(0,t);
					var value = arr[i].substr(t+1);
					if(name=='姓名')		$("#name").val(value);
					if(name=='职务/部门')	$("#position_1").val(value);
					if(name=='手机')		$("#mobile").val(value);
					if(name=='公司')		$("#company_name_1").val(value);
					if(name=='地址')		$("#address").val(value);
					if(name=='电话')		$("#tel").val(value);
					if(name=='传真')		$("#fax").val(value);
					if(name=='电子邮箱')	$("#email").val(value);
					if(name=='网址')		$("#company_url_1").val(value);
					if(name=='邮编')		$("#company_postcode_1").val(value);
					get_cinfo(1);
				}
			}
		}
	}
}
/******** 调用控件 ********/

/* 上传图片后，返回显示 */
function pic_back(re)
{
	if(re=='false')
	{
		alert('图片上传失败');
	}
	else
	{
		$("#"+$('#pic_id').val()).val(re);
		$("#"+$('#pic_id').val()+"_img").attr("src",re);
	}
}
/* 单位名称输入 */
function company_input(e,value,i)
{
	if(e.keyCode==13)
	{
		//回车确认单位名称后，直接查询单位分组信息
		get_cinfo(i);
	}
	else
	{
		//判断单位名称是否改变，如改变，重新获取可选名称列表
		if($('#c_value').val()!=value)
		{
			$('#c_value').val(value);
			get_cnames(value,i);
		}
	}
}
/* 根据输入的文本获取单位名称列表 */
function get_cnames(cname,i)
{
	if(cname=='')
	{
		return;
	}
	$.post(
		"/index.php/contact/get_company_by_code",
		{
			name : cname
		},
		function (data) //回传函数
		{
			if(data=='')
			{
				$("#company_sel_"+i).hide();
				get_cinfo(i)
			}
			else
			{
				var html = '';
				var arr = data.split(",");
				for(var k in arr)
				{
					html += '<a onclick="set_cname(\''+arr[k]+'\','+i+')">'+arr[k]+'</a><br />';
				}
				html += '<a  class="s_bnt01 red" style=" margin: 5px; position: relative; left: -40%; " onclick="get_cinfo('+i+')" >关闭</a>';
				$("#company_sel_"+i).html(html);
				$("#company_sel_"+i).show();	
			}
		}
	);
}
/* 点击选择下拉列表中的单位 */
function set_cname(name,i)
{
	$("#company_name_"+i).val(name);
	$('#c_value').val(name);
	$("#company_sel_"+i).hide();
	get_cinfo(i);
}
/* 根据单位名称获取类型 */
function get_cinfo(i){
	var name = $('#company_name_'+i).val();
	$.post(
		"/index.php/contact/get_company_name",
		{
			name:name
		},
		function (data) //回传函数
		{
			if(data == 0){
				var html = "<select class='bzsr2' name='typeid[]'>"
						 +   "<option value='0'>请选择</option>"
						 +   "<? 
							 foreach($type as $v){
							 	$arr = explode('.',$v['detail']);
							 	$len = count($arr);
							 	$sp='';
							 	for($i=0;$i<$len-1;$i++){
							 		$sp .= "&nbsp;&nbsp;";
							 	}
						     ?>"
						 +   "<option value='<?=$v['id']?>'><?=$sp?><?=$v['name']?></option>"
						 +   "<?
						 	 }
						     ?>"
						 + "</select>";
                                                 
                                 var settleHtml="<select class='bzsr2' name='settle[]'>"
						 +   "<? 
							 foreach($settle as $k=>$v){ 	
						     ?>"
						 +   "<option value='<?=$k?>'><?=$v?></option>"
						 +   "<?
						 	 }
						     ?>"
						 + "</select>";
                var urlHtml="<input type='text' id='company_url_"+i+"' name='url[]' value=''   class='bzsr'/>";
                var postcodeHtml="<input type='text' id='company_postcode_"+i+"' name='postcode[]' value=''   class='bzsr'/>";
				$('#td_company_type_'+i).html(html);
                $('#company_id_'+i).val("");
                $('#td_company_url_'+i).html(urlHtml);
                $('#td_company_postcode_'+i).html(postcodeHtml);
                $('#td_company_settle_'+i).html(settleHtml);
			}else{
				var obj = eval('('+data+')');
				$('#td_company_type_'+i).html("<p id=company_tname_"+i+">"+obj.typename+"</p>"+"<input type='hidden' id='company_type_"+i+"' name='typeid[]' value='"+obj.typeid+"'/>");
				$('#company_id_'+i).val(obj.id);
                $('#td_company_url_'+i).html("<input type='text' id='company_url_"+i+"' name='url[]' value='"+obj.url+"' class='bzsr'/>");
                $('#td_company_postcode_'+i).html("<input type='text' id='company_postcode_"+i+"' name='postcode[]' value='"+obj.postcode+"'  class='bzsr'/>");
                $('#td_company_settle_'+i).html("<p id=company_sname_"+i+">"+obj.settlename+"</p>"+"<input type='hidden' id='company_settle_"+i+"' name='settle[]' value='"+obj.settlename+"'/>");
			}
			
		}
	);
	$("#company_sel_"+i).hide();	
}

function confirmOwn(){
	var ownername='';
	var ownerid='';
	$("input[name='checkedid[]']:checked").each(function(){
		if(ownername==''){
			ownername = $(this).next("input[name='checkedname[]']").val();
		}else{
			ownername += ','+$(this).next("input[name='checkedname[]']").val();
		}
		if(ownerid==''){
			ownerid = $(this).val();
		}else{
			ownerid += ','+$(this).val();
		}
	});
	$('#owner_show').html(ownername);
	$('#owner').val(ownerid);
	$('#winregister').hide();
	$('#wincover').hide();
}

/* 提交前判断 */
function checksubmit()
{
	if($("#name").val()==''){
		alert("请填写姓名");
		return false;
	}
	
	$("input[name='companyname[]']").each(function(){
		if(this.value=='')
		{
			alert("请填写单位名称");
			return false;
		}
	});
	$("input[name='position[]']").each(function(){
		if(this.value=='')
		{
			alert("请填写职务");
			return false;
		}
	});
	$("input[name='typeid[]']").each(function(){
		if(this.value=='')
		{
			alert("请选择分组");
			return false;
		}
	});
	//根据姓名、电话判断名片是否存在
	//待完善
	
	$("#sub_form").submit();
}

/**评星**/
var TB = function() {
var T$ = function(id) { return document.getElementById(id) }
var T$$ = function(r, t) { return (r || document).getElementsByTagName(t) }
var Stars = function(cid, rid, hid, config) {
var lis = T$$(T$(cid), 'li'), curA;
for (var i = 0, len = lis.length; i < len; i++) {
lis[i]._val = i;
lis[i].onclick = function() {
T$(rid).innerHTML = '<em>' + (T$(hid).value = T$$(this, 'a')[0].getAttribute('star:value')) + '</em>';
curA = T$$(T$(cid), 'a')[T$(hid).value / config.step - 1];
};
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