<!DOCTYPE html>
<html>
<head>
<title>天津滨海高新区公共关系管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
<meta content="telephone=no" name="format-detection" />
<style>
	*{
		margin:0;
		padding:0;
	}
	body{
		width:100%;
	}
	img{
		width:100% !important;
		height:auto !important;
	}
</style>
</head>
<body>
<div style="width:95%; margin:10px auto;">
  <img name="" src="<?=$company['logo']?>" alt="" width="80%" />
  <div class="qynr_con">
    <p class="qymc_tit">单位名称：<span><?=$company['name']?></span></p>
    <p>分组名称：<span><?=$company['tname']?></span></p>
    <p>单位地址：<span><?=$company['address']?></span></p>
    <!--<p>联 系 人：<span><? if(is_array($contact))foreach($contact as $v){echo $v->u_name.'【'.$v->position.'】　';}?></span></p>
    <p>区内事务：<span><?=$company['affairs']?></span></p>-->
  </div>
  <div class="qyjj_con">
    <p class="qyjj_tit">单位简介:</p>
    <p><?=$company['brief']?></p>
    <p class="qyjj_tit">产品图片:</p>
    <p><?=$company['pic']?></p>
  </div>
</div>
</body>
</html>