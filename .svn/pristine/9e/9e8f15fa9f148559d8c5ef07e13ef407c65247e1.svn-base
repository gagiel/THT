<div class="qyxxzs_con">
  <ul class="qyxxzs_ones">
    <li>
      <img class="logo_con" name="" src="<?=$company['logo']?>" alt="" />
      <div class="qynr_con">
        <p class="qymc_tit">单位名称：<span><?=$company['name']?></span></p>
        <p>分组名称：<span><?=$company['tname']?></span></p>
        <p>单位地址：<span><?=$company['address']?></span></p>
        <p>单位网站：<span><?=$company['url']?></span></p>
        <p>单位邮编： <span><?=$company['postcode']?></span></p>
        <!--<p>联 系 人：<span><? if(is_array($contact))foreach($contact as $v){echo $v->u_name.'【'.$v->position.'】　';}?></span></p>
        <p>区内事务：<span><?=$company['affairs']?></span></p>-->
      </div>
      <div class="qyjj_con">
        <p class="qyjj_tit">简介:</p>
        <p><?=$company['brief']?></p>
        <p class="qyjj_tit">详情:</p>
        <p><?=$company['pic']?></p>
      </div>
      <div class="clear"></div>
    </li>
  </ul>
  <div class="clear"></div>
</div>
<script type="text/javascript">
$(function(){
	var h = 200;
	$('.qyxxzs_con').height($(window).height()-h);
	$(window).resize(function(){
		$('.qyxxzs_con').height($(window).height()-h);
	});
});
</script>