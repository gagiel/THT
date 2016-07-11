<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>工作提醒>提醒管理</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  
	<div class="ser_b">
	  <form id="get_form" action="/index.php/remind" method="post">
	    <label class="sizi">时 间：</label>
	    <input class="Wdate" name="start" value="<?=$where['start']?>" id="d4321" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" type="text">
	    <label class="sizi" style="width:10px;">~</label>
	    <input class="Wdate" name="end" value="<?=$where['end']?>" id="d4322" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;" type="text">
	        
	    <label class="sizi">提醒内容：</label>
	    <input class="bzsr" name="info" value="<?=$where['info']?>" style="width:130px;" type="text">
	
	    <input class="b_bnt01" value="查 询" type="submit">
	  </form>
	</div>
	<table cellpadding="0" cellspacing="0" class="biaozhun">
	  <tbody>
	    <tr class="tab_tit alt">
	      <td width="30%">提醒时间</td>
	      <td width="45%">提醒内容</td>
	      <td width="8%">状态</td>
	      <td width="18%">&nbsp;</td>
	    </tr>
<?
if(is_array($list))
{
	$arr_state = array('未阅读','已阅读','不再提醒');
	foreach($list as $k => $v)
	{
		$state = isset($read_state[$v->id])?$read_state[$v->id]:'0';
?>
	    <tr>
	      <td colspan="4" style="height:1px; background-color:#333"></td>
	    </tr>
	    <tr>
	      <td colspan="4" style="height:0px;"></td>
	    </tr>
	    <tr class="alt">
	      <td <? if($v->t_end<date('Y-m-d H:i:s'))echo 'style="text-decoration:line-through; color:#aaa;"';?>><?=substr($v->t_start,0,-3)?> ~ <?=substr($v->t_end,0,-3)?></td>
	      <td style="text-align:left;<? if($v->t_end<date('Y-m-d H:i:s'))echo 'text-decoration:line-through; color:#aaa;';?>"><?=$v->info?></td>
	      <td <? if($v->t_end<date('Y-m-d H:i:s'))echo 'style="text-decoration:line-through; color:#aaa;"';?>><?=$arr_state[$state]?></td>
	      <td>
	      	<? 
	      	if($state<1){
	      		echo '<input type="button" class="s_bnt green" value="已阅读" onclick="read('.$v->id.',1)">'; 
	        }
	        if($state<2){
	        	echo '<input type="button" class="s_bnt red" value="不再提醒" onclick="read('.$v->id.',2)">'; 
	        }
	        ?>
	      </td>
	    </tr>
<?
	}
}
?>
	  </tbody>
	</table>
  </div>
</div>
<script>
function read(id,state)
{
	$.post(
		"/index.php/remind_r/read",
		{
			id:id,
			state:state
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				$('#get_form').submit();
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>