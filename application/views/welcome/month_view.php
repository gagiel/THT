<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div id="content">
	<div class="ser_b">
		<form id='data_form' method="post">
			<label class="sizi_one">日 期：</label>
			<input type="text" class="Wdate" name="month" value="<?=$month?>" id="d4321"  onFocus="WdatePicker({dateFmt:'yyyy-MM'})" style="width:100px;" onchange="retime(this)"/>
			<input type="hidden" value="<?=date('Y-m')?>" id="d4322" />
			 <?php 
	 	if($info){
	 		?>
	      <input type="button" class="b_bnt01"  value="下载pdf文件" onclick="download('<?=$info?>')" />
	      <?php 
	 	}
	 	?>
			<input type="button" class="b_bnt01" style="float:right" name="back" value="返回" onclick="location.href='/index.php/select/newsletter';" />
		</form>
		<br/>
			
	</div>
	    <br/>
	  
	  	<div id="pdfview" style="margin: 10px auto;min-width:900px;width: 90%;z-index:0" ">
	 	<?php 
 	if($info){
 		?>
 		
 		<span style="color:red">温馨提示：如果不能正常显示月刊,下载Adobe Reader XI阅读器,然后设置浏览器,以ie为例:设置->Internet选项->程序->管理加载项->开启Adobe PDF Reader</span>
 		  <embed src="<?=$info?>"  width="100%" height="650" ></embed>
 		

 		 
 		  
 		  <?php 
 	} else{
 		  ?>
 		 <span style="margin-left:85px;padding-top:60px">没有月刊</span> 
 		  <?php 
 	}
 		  ?>
	</div>
   
</div>
<script>
function retime(obj)
{
	if(obj.value=='<?=$date?>')
	{
		return false;
	}
	$("#data_form").submit();
}

function download(url){
	 window.location.href = '/index.php/monthly_report/downloadPdf?wordname=.'+url;
}
</script>

