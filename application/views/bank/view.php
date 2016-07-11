<?php 
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
?>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>信贷业务管理>查看信贷</p>
  </div>
   <div style="width: 80%; margin: 120px auto; padding-left: 50px; left:auto;position:fixed;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<? if(in_array('26',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	    <? } ?>
		
	</div>
	<div class="caozuo8">
		<? if(in_array('26',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/bank/edit/<?=$id?>/<?=$thispage?>'" />
	    <? } ?>
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/bank/index/<?=$thispage?>'" value="back"/>
	</div>
  </div>
    <div class="con_detail" style="top:155px;">	
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">银行名称：</td>
          <td width="42%" class="cknr2"><?=$name?></td>
        </tr>
       <tr>
       	<td colspan="4">
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="20%">业务名称</td>
                <td width="80%">业务说明</td>
              </tr>
              <?php
              if(!empty($credit)){
              	foreach($credit as $key=>$value){
              	?>
              	 <tr>
	                <td>
	                    <?=$value['business_name']?>
	                </td>
                   <td>
	               		<textarea style="width:80%;" disabled><?=$value['business_explain']?></textarea>
	               </td>
              	</tr>
              	<?php 
              	}
              }
              	?>
            </table>
          </td>
       </tr>
        <tr>
          <td width="8%" class="cklt">联系人：</td>
          <td width="92%" colspan="3" class="cknr2">
            <?=$contact?>
          </td>
        </tr>
		<tr>
          <td width="8%" class="cklt">电  话：</td>
          <td width="92%" colspan="3" class="cknr2">
            <?=$tel?>
          </td>
        </tr>
        <tr id="dhxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2">
              <?=$mobile?>
          </td> 
        </tr>
        <tr id="sjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
      </table>
    </div>
   <div class="caozuo5" style="width: 80%; margin: 10px auto; padding-left: 50px; left:auto;">
	<div class="caozuo6">
		<input type="hidden" value="<?=$thispage?>" id="thispage"/>
		<? if(in_array('26',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="删 除" onClick="delInfo(<?=$id?>)" />
	    <? } ?>
	</div>
	<div class="caozuo8">
		<? if(in_array('26',$arr_jurisdict)){ ?>
			<input type="button" class="b_bnt01" value="编 辑" onClick="window.location.href='/index.php/bank/edit/<?=$id?>/<?=$thispage?>'" />
	    <? } ?>
		<input type="button" class="b_bnt01" value="返 回" onclick="window.location.href='/index.php/bank/index/<?=$thispage?>'" value="back"/>
	</div>
  </div>
  </form>
</div>

<script>
$(function(){
	var h = 235;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});
});

function delInfo(id)
{
	if(confirm("确认删除该条记录吗？"))
	{
		$.post(
			"/index.php/bank/delete",
			{
				ids:id
			},
			function (data) //回传函数
			{
				alert(data);
				if(data=='删除成功')
				{
					window.location.href='/index.php/bank/index';
				}
			}
		);
	}
}

</script>