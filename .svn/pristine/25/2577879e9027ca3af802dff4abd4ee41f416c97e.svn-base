<link rel="stylesheet" href="/css/about.css">
<!--下面是引用jquery库-->
<!-- <script src="/js/jquery-1.7.2.min.js" type="text/javascript" ></script> -->
<!--下面是时间轴控制脚本-->
<script>
$(document).ready(function(){
	$('label').click(function(){
		$('.event_year>li').removeClass('current');
		$(this).parent('li').addClass('current');
		var year = $(this).attr('for');
		$('#'+year).parent().prevAll('div').slideUp(800);
		$('#'+year).parent().slideDown(800).nextAll('div').slideDown(800);
	});
});
</script>
<body>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页 > 大事记管理> 大事记管理 > 大事记查看</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
   <div class="con_detail">
   <div style="margin:10px; min-width:900px;">
<div class="conter">
  <div class="box">
    <ul class="event_year">
    <?php if($list){
    	$k=0;
    }
    foreach($list as $year=>$val){
    	if($k==0){
    		echo  "<li class='current'><label for=$year>$year</label></li>";
    	}else{
    		echo "<li><label for=$year>$year</label></li>";
    	}
    	$k++;
    }
    ?>
    </ul>
    <ul class="event_list">
    <?php 
    	if($list){
    		foreach($list as $y=>$value){
    	?>
      <div>
			<h3 id="<?=$y?>"><?=$y?></h3>
		<?php 
			foreach($value as $k=>$v){
		?>

			<li><span><?=$v['time']?></span>
			  <p>
			  <?php 
			  if($v['is_link'] == 1){
			  ?>
			  <span><a href="<?=$v['url']?>" target="_blank" style="text-decoration:none;color:#222;" ><?=$v['title']?></a></span>
			  <?php 
			  }else{
			  ?>
			   <span><a onclick="show(<?=$v['id']?>)"><?=$v['title']?></a></span>
    		<?php 
    			}
    			?>
    			</p>
			</li>
     <?php 	
    		}
    		?>
    		</div>
    		<?php 
    		  	}
    		}
   		?>
  
    </ul>  
  </div>
</div>
</div>
</div>
</body>

<div id="wincover"></div>
<div class="newli" id="winregister" style="width:600px">
 	<div id="containerObj">
		    <!-- 加载编辑器的容器-->
			<script id="info"></script> 
			<!-- 配置文件 -->
			<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
			<!-- 编辑器源码文件 -->
			<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
	</div>
 <div class="caozuo" id="btn_win_div">
    <input type="button" class="b_bnt01" value="关 闭" id="btn_win_close" onclick="closeWin()" style="text-align:center" />
  </div>
</div>
<style>
	#containerObj{
		margin:10px;
	}
	#info{
		height:500px;
		overflow:auto;
	}
</style>
<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	$('.info_left').height($('.con_detail').height()-20);
	$('.info_left').width($('.con_detail').width()-710);
    var editor = new UE.ui.Editor({
        toolbars:[[
        	'undo', 'redo', '|',
        	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', '|', 
        	'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'indent', '|', 
        	'rowspacingtop', 'rowspacingbottom', 'lineheight', '|', 
        	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
        	'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        	'selectall', 'cleardoc']],
    	initialHeight:$('.con_detail').height()-220,
    	initialFrameHeight:$('.con_detail').height()-220,
    	initialWidth:680,
    	initialFrameWidth:680,
    	scaleEnabled:true
    });
    editor.render("info");  
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
		$('.info_left').height($('.con_detail').height()-20);
		$('.info_left').width($('.con_detail').width()-710);
		editor.setHeight($('.con_detail').height()-220);
	});	

	
});
function show(id){
	$("#info").html('');
	$.post('/index.php/event/get_content',{id:id},function(data){
		$("#info").html(data);
	});
	$('#wincover').show();
	$('#winregister').center();
}

function closeWin()
{
	$('#winregister').hide();
	$('#wincover').hide();
}

</script>