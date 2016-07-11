<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>物品管理>查看物品</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <div class="caozuo9" > 
    <!-- 物品信息 -->
    <table cellpadding="0" cellspacing="0" class="ser_b" style=" color: #465c8d; font-size: 16px; ">
      <tr>
        <td width="10%" align="right" class="cklt"><b>物品名称：</b></td>
        <td width="10%" class="cknr2"><?=$info['name']?></td>
        <td width="10%" align="right"class="cklt"><b>规 格：</b></td>
        <td width="10%" class="cknr2"><?=$info['standard']?></td>
        <td width="10%" align="right"class="cklt"><b>库存数量：</b></td>
        <td width="10%" class="cknr2"><?=$info['num']?></td>
        <td width="10%" align="right"class="cklt"><b>时间范围：</b></td>
        <td width="30%" class="cknr2"><input type="text" class="Wdate"  name="start" value="<?=$start?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;" onchange="showData(<?=$type?>)" /> 
         <label class="sizi" style="width:10px;">~</label>
        <input type="text" class="Wdate" name="end" value="<?=$end?>" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;" onchange="showData(<?=$type?>)" /></td>		
      </tr>
      <input type="hidden" id="stock_id" name="stock_id" value="<?=$info['id']?>" />
    </table>
  </div>
  <div class="caozuo4" >
      <input type="button" id="all" class="b_bnt01" style=" margin: 5px;" value="全部" onClick="showData(0)" /><input type="button" id="lingyong" class="b_bnt01" style=" margin: 5px;" value="领用" onClick="showData(2)" /><input type="button" id="ruku" class="b_bnt01" style=" margin: 5px;" value="入库" onClick="showData(1)" />
  </div>
  <!-- 物品出入库详细记录 -->
  <div class="con_detail">
    <table cellpadding="0" cellspacing="0" class="biaozhun">
      <tr class="tab_tit">
        <td width="20%">时 间</td>
        <td width="10%">类 型</td>
        <td width="10%">数 量</td>
        <td width="60%">备注</td>
      </tr>
      <? 
      if(is_array($list))
      {
      	foreach($list as $v)
      	{
      ?>
      <tr>
        <td><?=$v->s_time?></td>
        <td><?=$v->stype=='1'?'入库':'领用'?></td>
        <td><?=$v->stock_num?></td>
        <td style="text-align:left"><?=str_replace("\n","<br>",$v->remark)?></td>
      </tr>
      <?
      	}
      }
      ?>
    </table>
    <div style=" margin: 10px auto; width: 90%; min-width: 900px; ">
  	<p id="rukucount" style=" float: left; margin-right: 50px;">入库总数：<span><?=$instorage?></span></p> 
  	<p id="lingyongcount" style=" float: left; margin-right: 50px; " >领用总数：<span><?=$outstorage?></span></p>
    </div>
    <div class="sabrosus">
      <?=$pages?>
    </div>
  </div>
</div>
<script>
//物品出入库明细表高度自动适应窗口高度

$(function(){
	var h = 165+$(".caozuo9").height();
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});

	var type='<?php echo $type?>';
	if(type == 0){
		$('#all').css('color','#999');
		$('#lingyong').css('color','none');
		$('#ruku').css('color','none');
	}else if(type == 1){
		$('#all').css('color','none');
		$('#lingyong').css('color','none');
		$('#ruku').css('color','#999');
		$('#lingyongcount').hide();
	}else if(type == 2){
		$('#all').css('color','none');
		$('#lingyong').css('color','#999');
		$('#ruku').css('color','none');
		$('#rukucount').hide();
	}
});

function showData(type){
	var id = $('#stock_id').val();
	var start = $('[name="start"]').val();
	var end = $('[name="end"]').val();
	if(start=='' || start=='undefined'){
		start = 0;
	}
	if(end=='' || end=='undefined'){
		end = 0;
	}
	location.href="/index.php/stock/view/"+id+'/'+type+'/'+start+'/'+end;
	
}

</script> 
