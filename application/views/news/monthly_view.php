<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>查看月刊</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  
  <div class="con_detail">
	  <form id="get_form" action="" method="post">
	    <div class="ser_b">
	    <label class="sizi">月份：</label>
	    <input type="text" class="Wdate" name="month" value="<?=$month?>" id="d4321" onFocus="WdatePicker({dateFmt:'yyyy-MM'})" style="width:80px;" onchange="$('#get_form').submit();" />
    	<input type="button" class="b_bnt01" value="返 回" onclick="back()" style="float:right;"/>
	   <?php 
	 	if($info){
	 		?>
	      <input type="button" class="b_bnt01"  value="下载pdf文件" onclick="download('<?=$info?>')" />
	      <?php 
	 	}
	 	?>
	    </div>
	  </form>
	    <br/>
	  	<div style="margin: 10px auto;min-width:900px;width: 90%; ">
	 	<?php 
 	if($info){
 		?>
 		
 		<span style="color:red">温馨提示：如果不能正常显示月刊,下载Adobe Reader XI阅读器,然后设置浏览器,以ie为例:设置->Internet选项->程序->管理加载项->开启Adobe PDF Reader</span>
 		  <embed src="<?=$info?>" width="100%" height="650" ></embed>
 		  
 		  <?php 
 	} else{
 		  ?>
 		 <span style="margin-left:85px;padding-top:60px">没有月刊</span> 
 		  <?php 
 	}
 		  ?>
	</div>
  </div>
</div>
<script>
function back()
{
	location.href="/index.php/news/calendar";
}

function download(url){
	 window.location.href = '/index.php/monthly_report/downloadPdf?wordname=.'+url;
}
</script>