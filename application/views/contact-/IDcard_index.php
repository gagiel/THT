<SCRIPT LANGUAGE="JavaScript">
//加载核心
function LoadRecogKenal()
{
    //alert("识别核心未加载，请先成功加载识别核心");
    if(!objIDCard.IsLoaded())
    {
       var strDllPath = "";
       var nRet = objIDCard.InitIDCard('59296625390562138974',1);

       if(nRet==0)
       { 
          alert("识别核心加载成功");
       }
       else
       {
         alert("识别核心加载失败\r\n返回值：");
      
         document.IDScanRecog.result.innerText += nRet;
         if(nRet==1)
         {
            document.IDScanRecog.result.innerText += "(无效的UserID)";
         }
       }
    }
    else
    {
          alert("核心已经加载");
    }
 
}
//释放核心
function FreeRecogKenal()
{
    objIDCard.FreeIdcard();
    
}
//识别
function RecognizeImg()
{
	LoadRecogKenal();
    if(objIDCard.IsLoaded())
    {
        //采集图像
        var nResult = objIDCard.AcquireImage('13');
        if(nResult!=0)
       {
           var strError = "采集图像失败\r\n返回值：";
           strError += nResult;
           alert(strError);
           return;
       }
       //调用识别接口识别
        
       //设置要识别的证件类型
       //0表示添加次主类型的所有子模板
      
		objIDCard.ProcessImage(2);		
		nResult = objIDCard.RecogBusinessCard(1);
	if(nResult!=0)
        {
           //alert("识别失败");
           var strError = "识别失败\r\n返回值：";
           strError += nResult;
           alert(strError);
           return;
        } 
         
        //显示识别结果
        
        DisplayResult();
        //保存图像
		var time = new Date().getTime();
        objIDCard.SaveImage('F:/wamp/www/web/binhai/card_entering/card'+time+'.jpg');
        //保存头像
       // objIDCard.SaveHeadImage(document.IDScanRecog.HeadPath.value);
    }
    else
    {
        //alert("识别核心未加载，请先成功加载识别核心");
    }
   
}

//显示识别结果
function DisplayResult()
{
  
	var strResult = "识别成功\r\n";   
		  
	for(var i=0;i<10;++i)
	{	
		var nCount = objIDCard.GetBusinessCardResultCount(i);
		
		
		if (nCount==0)
		{
			var aa = objIDCard.GetBusinessCardFieldName(i);	
				
			if(strResult.indexOf(aa) > 0){
				continue;
			}
				
			strResult += objIDCard.GetBusinessCardFieldName(i);
			strResult +="::";
			strResult +="";
			strResult  += "\r\n";
		}
		for (var j=0;j<nCount;j++)
		{
			var aa = objIDCard.GetBusinessCardFieldName(i);	
				
			if(strResult.indexOf(aa) > 0){
				continue;
			}
				
			strResult += objIDCard.GetBusinessCardFieldName(i);
			strResult+="::";
			strResult +=objIDCard.GetBusinessCardResult(i,j);
			strResult += "\r\n";
		}
	}
	var arr_1 = strResult.split("\n");
	var str = '';
	var arr = '';
	for(x in arr_1){
		str = arr_1[x].split("::");
		arr += str[1]+"&& ";
	}
	
	data = arr.split('&&');
	data.pop();
		
	$("input[name='name']").val(data[1]);
	$("input[name='position']").val(data[2]);
	$("#get_name").val(data[4]);
	$("#mobile").val(data[3]);
	$("input[name='tel']").val(data[6]);
	$("input[name='fax']").val(data[7]);
	$("input[name='email']").val(data[8]);
	$("#address").val(data[5]);
	//alert(data[1]+data[2]+data[3]+data[4]+data[5]+data[6]+data[7]+data[8]+data[9]+data[10]+'完了');
}
//获取当前SDK的版本信息
function GetSDKVersion()
{
   if(objIDCard.IsLoaded())
   {
     alert(objIDCard.GetVersionInfo()); 
   }
   else
   {
     //alert("识别核心未加载，请先成功加载识别核心");
   }

}
//判断设备是否在线
function DeviceIsOnLine()
{
   if(objIDCard.IsLoaded())
   {
   
      if(objIDCard.CheckDeviceOnline()==1)
      {
        alert("在线");
      }
      else
      {
        alert("离线");
      }
   }
   else
   {
     //alert("识别核心未加载，请先成功加载识别核心");
   }
}
//获取设备名称
function GetDeviceName()
{
   if(objIDCard.IsLoaded())
   {
        alert(objIDCard.GetCurrentDevice());
   }
   else
   {
     //alert("识别核心未加载，请先成功加载识别核心");
   }
}
//获取设备按钮状态
function GetDeviceBtnStatus()
{
   if(objIDCard.IsLoaded())
   {
        var nBtnStatus = objIDCard.GetButtonDownType();
        if(nBtnStatus==0)
        {
           alert("无");
        }
        else if(nBtnStatus==1)
        {
           alert("左键");
        }
        else if(nBtnStatus==2)
        {
           alert("右键");
        }
   }
   else
   {
    // alert("识别核心未加载，请先成功加载识别核心");
   }
}
//设置采集属性
function SetCollecttionPropety()
{
    if(objIDCard.IsLoaded())
    {
        var nLightType = 1;//设置采集的是可见光图像
        var nImgType = 1;   //设置采集的是彩色图像
        var nResult = objIDCard.SetAcquireImageType(nLightType,nImgType);
        if(nResult)
        {
            alert("采集设置成功");
        }
        else
        {
            alert("采集设置失败");
        }
    }
    else
    {
       //alert("识别核心未加载，请先成功加载识别核心");
    }
}

//设置图像大小
function SetImageSize()
{
    if(objIDCard.IsLoaded())
    {
        var nWidth = 2550; 
        var nHeight = 3700;
        var nResult = objIDCard.SetUserDefinedImageSize(nWidth,nHeight);
        if(nResult)
        {
            alert("采集设置成功");
            //扫描看下效果
            objIDCard.AcquireImage(20);     //保存图像
            objIDCard.SaveImage(document.IDScanRecog.ImgPath.value);
        }
        else
        {
            alert("采集设置失败");
        }
    }
    else
    {
      // alert("识别核心未加载，请先成功加载识别核心");
    }
}
//设置扫描的分辨率
function SetScanResolution()
{
    if(objIDCard.IsLoaded())
    {
        var nResolutionX = 300; 
        var nResolutionY = 300;
        var nResult = objIDCard.SetAcquireImageResolution(nResolutionX,nResolutionY);
        if(nResult)
        {
            alert("采集设置成功");
            //扫描看下效果
            objIDCard.AcquireImage(2);     //保存图像
            objIDCard.SaveImage(document.IDScanRecog.ImgPath.value);
        }
        else
        {
            alert("采集设置失败");
        }
    }
    else
    {
       
    }
}
function AutoPhotoAndRecog()
{
   if(objIDCard.IsLoaded())
    {
 	var nRet=objIDCard.GetGrabSignalType();
	if(nRet==1)
	{
	    var nResult = objIDCard.AcquireImage(21);
            if(nResult!=0)
           {
               var strError = "采集图像失败\r\n返回值：";
               strError += nResult;
               alert(strError);
               return;
           }
          //调用识别接口识别
          objIDCard.ProcessImage(2);
          //设置要识别的证件类型
          //0表示添加次主类型的所有子模板
          objIDCard.SetIDCardType(13,0);
          objIDCard.AddIDCardType(9,0);
          objIDCard.AddIDCardType(12,0);
          objIDCard.AddIDCardType(2,0);
          objIDCard.AddIDCardType(5,0);
          //识别
          nResult = objIDCard.RecogIDCard(); 
          if(nResult<=0)
          {
              //alert("识别失败");
              var strError = "识别失败\r\n返回值：";
              strError += nResult;
              alert(strError);
              return;
          }  
           //显示识别结果
        
          DisplayResult();
          //保存图像
          objIDCard.SaveImage(document.IDScanRecog.ImgPath.value);
         //保存头像
          objIDCard.SaveHeadImage(document.IDScanRecog.HeadPath.value);
       }
    } 
    else
    {
       // alert("识别核心未加载，请先成功加载识别核心");
    }
}
function GetDeviceSNCode()
{
    if(objIDCard.IsLoaded())
    {
        
        var nResult = objIDCard.GetDeviceSN();
       
       alert(nResult );
 
        
    }
    else
    {
      // alert("识别核心未加载，请先成功加载识别核心");
    }
}
setInterval("AutoPhotoAndRecog()", 100);
</SCRIPT>
<script>
$(document).ready(function(){
  $("#add_mob").click(function(){
    $("#sjxx").after("<tr class='msj'><td width='8%'></td><td width='92%' colspan='3' class='cknr2'><input type='text' class='bzsr' name='mobile[]' id=''/><input type='button' value='-' class='tj_bnt tabn' style='margin-top: 5px;' id='del_mob' onclick='min_mob(this)'/></td></tr>");
  });
  $("#add_add").click(function(){
    $("#dzxx").after("<tr class='mdz'><td width='8%'></td><td width='92%' colspan='3' class='cknr2'><input type='text' class='bzsr8' name='address[]' id=''/><input type='button' value='-' class='tj_bnt tabn' style='margin-top: 5px;' id='del_add' onclick='min_add(this)'/></td></tr>");
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
</script>
<OBJECT classid="clsid:10EC554B-357B-4188-9E5E-AC5039454D8B" id="objIDCard" width="0" height="0">
</OBJECT>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>名片系统>名片录入</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/contact/add_total/" id="sub_form">
    <OBJECT classid="clsid:10EC554B-357B-4188-9E5E-AC5039454D8B" id="objIDCard" width="0" height="0">
    </OBJECT>
    <div class="caozuo4" >
      <input type="button" class="b_bnt01" value="名片扫描" onClick="RecognizeImg()"/>
    </div>
    <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">姓 名：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="name" /></td>
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
              <input type="hidden" id="stars2-input" name="star" value="" size="2" />
            </div></td>
        </tr>
        <tr>
          <td colspan="4">
		  <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="25%">分 组</td>
                <td width="30%">单位名称</td>
                <td width="30%">职 务</td>
                <td width="15%"><input name="" type="button" value="新增" class="s_bnt01" id="add_njl"/></td>
              </tr>
              <tr id="xjlnr">
                <td width="20%" class="cknr2" style=" text-align: center; ">
					<p>未分组</p>
					<input type="hidden" name="typeid[]" value=""/>
				</td>
                <td>
					<input type="text" class="bzsr companyname" name="companyname[]" id="get_name" onclick="enabletest1()"/>
					<input type="hidden" value="" id="companyid" name="companyid[]">
                </td>
                <td><input type="text" class="bzsr" name="position[]"/></td>
                <td><!--<input name="" type="button" value="删除" class="s_bnt01 red"/>--></td>
              </tr>
            </table></td>
        </tr>
		<tr id="sjxx">
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr" name="mobile[]" id="mobile"/>
            <input type="button" value="+" class="tj_bnt" id="add_mob"/>
          </td>
        </tr>
        <tr>
          <td width="8%" class="cklt">电 话：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr" name="tel"/></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">传  真：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="fax"/></td>
          <td width="8%" class="cklt">E-mail：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="email"/></td>
        </tr>
        <tr id="dzxx">
          <td width="8%" class="cklt">地 址：</td>
          <td width="92%" colspan="3" class="cknr2"><input type="text" class="bzsr8" name="address[]" id="address"/>
            <input name="" type="button" value="+" class="tj_bnt" id="add_add"/>
          </td>
        </tr>
		<tr>
          <td width="8%" class="cklt">名片主人：</td>
          <td width="42%" class="cknr2"><select class="bzsr2" name="owner" id="owner_option">
              <option value="0">全 部</option>
              <?php foreach($owner as $v) :?>
              <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td width="8%" class="cklt">公开：</td>
          <td width="42%" class="cknr2"><input name="public" type="checkbox" value="1" /></td>
        </tr>
        <tr>
          <td width="8%" class="cklt">名 片：</td>
          <td colspan="3" class="cknr2"><input name="photo" type="file" class="bzsr" />
            <span>*图片尺寸：300*200PX</span></td>
        </tr>
        <tr>
          <td width="8%" class="cklt"></td>
          <td colspan="3" class="cknr2"><input name="photo_reverse" type="file" class="bzsr" />
            <span>*图片尺寸：300*200PX</span></td>
        </tr>
        <tr>
          <td width="8%" class="cklt"><input type="button" class="b_bnt01" style=" margin-left: 22px;" id="bnt_more"value="更多选项"/></td>
          <td width="92%" colspan="3" class="cknr2"></td>
        </tr>
        <tr id="mplr_more" style=" display: none; ">
          <td width="92%" colspan="4" class="cknr2"><table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%" class="cklt">个人信息：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="remark" cols="" rows="" class="bzsr4"></textarea></td>
              </tr>
              <tr>
                <td width="8%" class="cklt">区内事务：</td>
                <td width="92%" colspan="3" class="cknr2"><textarea name="affairs" cols="" rows="" class="bzsr4" id="affairs" ></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="caozuo5">
      <input type="botton" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
      <input type="button" class="b_bnt01" value="取 消"/>
    </div>
  </form>
</div>
<script>
	function enabletest1(){
		$('.companyname').bind('blur',function(){
			var objj = $(this);
			var name = $(this).val();
			$.post(
			"/index.php/contact/get_company_name",
			{
				name:name,
			},
			function (data) //回传函数
			{
				if(data == 0){
					objj.parent().prev().children().html("<select class='bzsr2' name='typeid[]' id=''><option value='0'>请选择</option><?php foreach($type as $v):?><?php $arr = explode('.',$v['detail']);$len = count($arr);$sp='';for($i=0;$i<$len-1;$i++){$sp .= "&nbsp;&nbsp;";}?><option value='<?php echo $v['id']?>'><?php echo $sp ?><?php echo $v['name']?></option><?php endforeach?></select>");
				}else{
					var obj = eval('('+data+')');
					objj.parent().prev().children('p').html(obj.typename);
					objj.parent().prev().children('input').val(obj.typeid);
					objj.next().val(obj.id);
				}
				
			}
			);
		});
	}
	
 $("#add_njl").click(function(){
    $("#xjlnr").after("<tr><td><p class='type_name'></p><input type='hidden' name='typeid[]'/></td><td><input type='text' class='bzsr companyname'name='companyname[]' /><input type='hidden' value='' name='companyid[]'/></td><td><input type='text' class='bzsr' name='position[]' /></td><td><input type='button' value='删除' class='s_bnt01 red' onclick='min_njl(this)'/></td></tr>");
	enabletest1();
});
function min_njl(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
</script>
<!-- 新增 -->
<div id="wincover"></div>
<div class="newli_b" id="winregister">
  <h3 id="div_title">单位管理--新建/修改单位</h3>
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/company/edit" id="sub_form_1">
    <div class="nl_det">
      <label class="sizi">分 组：</label>
      <select name="ctype" class="bzsr2" id="typename_option">
        <option value="0">全 部</option>
        <?php foreach($type as $v) :?>
        <option value ="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
        <?php endforeach ?>
      </select>
      <!--<p class="cknr"><span id="tname"></span></p>-->
      <label class="sizi">单位名称：</label>
      <input type="input" name="name" class="bzsr" id="companyname_1"/>
      <p class="szts"><span></span></p>
      <label class="sizi">单位简介：</label>
      <textarea type="textarea" name="brief" class="bzsr4" id="brief"></textarea>
      <p class="szts"><span></span></p>
      <label class="sizi">单位地址：</label>
      <input type="input" name="address[]" class="bzsr9" style="margin-left: 0;"/>
      <input name="" type="button" value="+" class="tj_bnt" id="add_dznr2"/>
      <p class="szts"><span></span></p>
      <label class="sizi">单位LOGO：</label>
      <input type="file" name="logo" class="bzsr" value="" />
      <p class="ygzp"><img src="" id="logo" class="big_pic"/></p>
      <label class="sizi">产品图片：</label>
      <input type="file" name="pic" class="bzsr" value="" />
      <p class="ygzp"><img src="" id="pic" class="big_pic"/></p>
      <label class="sizi">区内事务：</label>
      <input type="input" name="affairs" class="bzsr" id="affairs_1" />
      <label class="sizi">参观路线：</label>
      <input type="input" name="way"  class="bzsr"/>
      <br />
      <br />
    </div>
    <div class="caozuo">
      <input type="hidden" id="mid" name="mid"/>
      <input type="botton" class="b_bnt01" value="保 存" id="save" />
      <input type="botton" class="b_bnt01" value=" 取 消" onclick="$('#winregister').hide();$('#wincover').hide();" id="close"/>
    </div>
  </form>
</div>
<script>

function checksubmit()
{
	if($("#ctype").val()==0){
		alert("分组不能为空！");
		return false;
	}
	if($("input[name='name']").val()==''){
		alert("联系人姓名不能为空！");
		return false;
	}
	if($("input[name='position']").val()==''){
		alert("职务不能为空！");
		return false;
	}
	if($("input[name='companyname']").val()==''){
		alert("单位名称不能为空！");
		return false;
	}
	$("#sub_form").submit();
}



</script>
<script>
$(document).ready(function(){
//$("#add_mob").click(function(){
//$("#add_mob").before("<input type='text' class='bzsr' name='mobile[]'/>");
//});
//$("#add_dznr").click(function(){
//$("#add_dznr").before("<input type='text' class='bzsr8' name='address[]'/>");
//});
//$("#add_dznr2").click(function(){
//$("#add_dznr2").before("<input type='input' class='bzsr9' name='address[]'/>");
// });
});
</script>
<script>
$(document).ready(function(){
  $("#bnt_more").click(function(){
    $("#mplr_more").fadeToggle("fast");
  });
});
</script>
<script> 
var TB = function() { 
var T$ = function(id) { return document.getElementById(id) } 
var T$$ = function(r, t) { return (r || document).getElementsByTagName(t) } 
var Stars = function(cid, rid, hid, config) { 
var lis = T$$(T$(cid), 'li'), curA; 
for (var i = 0, len = lis.length; i < len; i++) { 
lis[i]._val = i; 

lis[i].onclick = function() { 
T$(rid).innerHTML = '<em>' + (T$(hid).value = T$$(this, 'a')[0].getAttribute('star:value')) + '</em>' ; 
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

$(function(){
	var h = 225;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
});

function editInfo()
{
	//弹窗获得主页上的值
	$("#companyname_1").val($("#get_name").val());
	$("#typename_option").val($("#ctype").val());
	$("#affairs_1").val($("#affairs").val());
	var len = $(".bzsr8").length;
	if(len > 1){
		for(x=0;x<len-1;x++){
			$("#add_dznr2").before("<input type='input' class='bzsr9' name='address[]'/>");
		}
		$(".bzsr8").each(function(i,item){
		var str = $(item).val();
		$(".bzsr9").eq(i).val(str);
		});
	}else{
		$(".bzsr8").each(function(i,item){
		var str = $(item).val();
		$(".bzsr9").eq(i).val(str);
		});
	}
	
	$('#wincover').show();
	$('#winregister').center();
}

//获取单位名称
function get_company_name()
{	
	var get_name = $("#get_name").val();
	$.post(
			"/index.php/contact/get_company_name",
			{
				name:get_name
			},
			function (data) //回传函数
			{
				var obj = eval('('+data+')');
				if(obj){
					//弹窗的值
					$('#div_title').html('名片系统--修改单位');
					$('#sub_form_1').attr('action', '/index.php/company/edit');
					$("input[name='logo']").hide();	
					$("input[name='pic']").hide();
					$("#mid").val(obj.id);
					$("#typename_option").val(obj.ctype);
					$("#companyname_1").val(obj.name);
					$("#brief").val(obj.brief);
					$("input[name='address']").val(obj.address);
					$("input[name='affairs']").val(obj.affairs);
					$("input[name='way']").val(obj.way);
					
					//主页上的值
					$("#ctype").hide();
					$(".cknr").show();
					$("#type").text(obj.typename);
					$("#companyid").val(obj.id);
					$("#brief").val(obj.brief);
					$("#brief").attr('readonly','readonly');
					
					$("#address").val(obj.address);
					$("#address").attr('readonly','readonly');
					$(".ygzp").show();
					$(".big_pic").show();
					$("#pic_total").hide();
					$("#pic_total_1").hide();
					$("#logo").attr('src',obj.logo);
					$("#pic").attr('src',obj.pic);
					
					
					$("#affairs").val(obj.affairs);
					$("#affairs").attr('readonly','readonly');
					
					$("#way").val(obj.way);
					$("#way").attr('readonly','readonly');
				}else{
					$('#div_title').html('名片系统--新增单位');
					$('#sub_form_1').attr('action', '/index.php/company/add');
					//清空表
					$('.bzsr8').val('');
					$('#affairs').val('');
					$("#affairs").removeAttr('readonly');
					document.getElementById("sub_form_1").reset();
					//弹窗以及主页分组的显隐
					$("input[name='logo']").show();	
					$("input[name='pic']").show();
					$(".ygzp").hide();
					$("#type_hidden").hide();
					$("#ctype").show();
					//弹窗获得主页上的值
					$("#companyname_1").val($("#get_name").val());
					$("#typename_option").val($("#ctype").val());
					$("#affairs_1").val($("#affairs").val());
				}
			}
	);
}
</script>
