<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>联系人>单位管理</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <div class="con_detail">
    <div class="newli_sb" >
    <h3 id="div_title">单位管理--单位查看</h3>
        <div class="nl_det">
          <label class="sizi">分 类：</label><p class="wznr_p_s"><?php echo $tname ?></p>
          <label class="sizi" style=" margin-left: 20%; ">单位名称：</label><p class="wznr_p_s" id="companyname"><?php echo $name ?></p>
		  <input type="hidden" id="address" value="<?php echo $address ?>" />
          <p class="szts"><span></span></p>
          <label class="sizi">单位简介：</label>
          <p class="wznr_p_b" id="brief"><?php echo $brief ?></p>
          <p class="szts"><span></span></p>
			<label class="sizi">单位网站：</label>
			<p class="wznr_p_b" id="url"><?php echo $url ?></p>
			<p class="szts"><span></span></p>
			<label class="sizi">单位邮编：</label>
			<p class="wznr_p_b" id="postcode"><?php echo $postcode ?></p>
			<p class="szts"><span></span></p>
          <label class="sizi">单位LOGO：</label>
          <p class="hmyjjh" ><img src="<?php echo $logo ?>" id="photo" class="qyck_gslg"/></p>
          <p class="szts"><span></span></p>
          <label class="sizi">单位落户：</label>
		  <?php if($settle == '0'):?>
			<p class="wznr_p_b">未落户</p>
		  <?php elseif($settle == '1'): ?>
		    <p class="wznr_p_b">已落户</p>
		  <?php else : ?>
			<p class="wznr_p_b">有意向</p>
		  <?php endif;?>
          <p class="szts"><span></span></p>
		  <label class="sizi">单位地址：</label>
		  <p class="wznr_p_b"><?php echo $address?></p>
		  <p class="szts"><span></span></p>
          <label class="sizi">参观路线：</label>
          <p class="wznr_p_s"><?php echo $way ?></p>
          <p class="szts"><span></span></p>
          <label class="sizi">产品图片：</label>
          <p class="szts"><span></span></p>
          <!-- 加载编辑器的容器 -->
          <script id="info" name="info" type="text/plain" style=" width: 100%; height:180px;"><?php echo $pic ?></script>
          <!-- 配置文件 -->
          <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
          <!-- 编辑器源码文件 -->
          <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
          <!-- 实例化编辑器 -->
          <script type="text/javascript">
			var ue = UE.getEditor('info',{
				toolbars:[],
				initialHeight:200,
				initialFrameHeight:200,
				scaleEnabled:true,
			});
		 </script>
          <div id="contact" style="display:none">
            <input type="text" id="contactstr" />
          </div>
          <div id="contact_arr">
            <label class="sizi">联 系 人：</label>
            <ul class="lxr_con">
			<?php if(isset($contact['0'])):?>
				<?php foreach($contact as $v):?>
				  <li><span><?php echo $v['name'] ?></span><span><?php echo $v['position'] ?></span></li>
				<?php endforeach; ?>
			<?php else: ?>
			<?php endif;?>
            </ul>
          </div>
          <p class="szts"><span></span></p>
          <div id="settle_arr">
            <label class="sizi">领导批示：</label>
            <ul class="lxr_settle">
			<?php if(isset($settleinfo['0'])):?>
				<?php foreach($settleinfo as $v):?>
				  <li><span><?php echo $v['username'] ?></span><p><?php echo $v['info'] ?></p><input type="button" class="s_bnt01 red" style=" float: left; "value="删除" onClick="delsettle('+settleArr[x]['id']+')"  /></li>
				<?php endforeach; ?>
			<?php else: ?>
			<?php endif;?>
            </ul>
          </div>
          <p class="szts"><span></span></p>
           <label class="sizi">地图导航：</label>
           <div style=" margin: 9px 0 0 5px; width:720px; height:550px; border:#ccc solid 1px;" id="container"></div>


  </div>
  </div>

  </div>
  <div class="caozuo5">
          <input type="reset" class="b_bnt01" value="返 回" onclick="history.go(-1)" id="close"/>
        </div>
</div>
<style type="text/css">
	#preview{width:160px;height:25px; border:solid #000;overflow:hidden;}
	#imghead {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);}
	.fileInput{width:160px; height:25px;overflow:hidden;position:relative;}
	.upfile{position:absolute;top:-100px;}
	.upFileBtn{width:160px; height:20px;opacity:0;filter:alpha(opacity=0);cursor:pointer;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=s7Qa8mTGF31TYrAvPoL0modY"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
<script type="text/javascript">
	//图片上传预览，IE用了滤镜
	function previewImage(file,i)
	{
		var MAXWIDTH  = 120;
	    var MAXHEIGHT = 140;
		var div = document.getElementById('preview'+i);
		var uploaddiv = document.getElementById('upimg'+i);
	  if (file.files && file.files[0])
	  {
	      div.innerHTML ='<img id=imghead'+i+'>';
	      var img = document.getElementById('imghead'+i);
		  img.onload = function(){
	        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
	        img.width  =  rect.width;
	        img.height =  rect.height;
			img.style.marginTop = rect.top+'px';
	      }
	      var reader = new FileReader();
		  div.style.display="";
		  uploaddiv.style.display="none";
	      reader.onload = function(evt){img.src = evt.target.result;}
	      reader.readAsDataURL(file.files[0]);
	  }
	  else //兼容IE
	  {
	    var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
	    file.select();
	    var src = document.selection.createRange().text;
	    div.innerHTML = '<img id=imghead>';
	    var img = document.getElementById('imghead');
	    img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
	    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
	    status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
	    div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
	  }
	}
	function clacImgZoomParam( maxWidth, maxHeight, width, height ){
	    var param = {top:0, left:0, width:width, height:height};
	    if( width>maxWidth || height>maxHeight )
	    {
	        rateWidth = width / maxWidth;
	        rateHeight = height / maxHeight;
	        if( rateWidth > rateHeight )
       {
	            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
	        }else
	        {
	            param.width = Math.round(width / rateHeight);
	            param.height = maxHeight;
        }
	    }
	    param.left = Math.round((maxWidth - param.width) / 2);
	    param.top = Math.round((maxHeight - param.height) / 2);
	    return param;
}

$(function(){
	var h = 200;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
	//searchByStationName();
});
</script>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("container");
	var point = new BMap.Point(116.331398,39.897445);
	map.centerAndZoom(point,12);
	// 创建地址解析器实例
	var myGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
	myGeo.getPoint("<?=$address?>", function(point){
		if (point) {
			var marker = new BMap.Marker(point);  // 创建标注


			map.centerAndZoom(point, 16);
			map.enableScrollWheelZoom();

		    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
		                    '地址：<?=$address?>' +
		                  '</div>';

		    //创建检索信息窗口对象
		    var searchInfoWindow = null;
			searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
					title  : "<?=$name?>",      //标题
					width  : 200,             //宽度
					height : 45,              //高度
					panel  : "panel",         //检索结果面板
					enableAutoPan : true,     //自动平移
					searchTypes   :[
						BMAPLIB_TAB_SEARCH,   //周边检索
						BMAPLIB_TAB_TO_HERE,  //到这里去
						BMAPLIB_TAB_FROM_HERE //从这里出发
					]
				});
		    marker.enableDragging(); //marker可拖拽
		    marker.addEventListener("click", function(e){
			    searchInfoWindow.open(marker);
		    })
		    map.addOverlay(marker); //在地图中添加marker

		}else{
			alert("您选择地址没有解析到结果!");
		}
	}, "天津市");
</script>