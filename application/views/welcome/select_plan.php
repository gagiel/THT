<div id="content">
  <ul class="plan" style="margin-left:176px;">
    <? 
if(is_array($list))
{
	foreach($list as $val)
	{
?>

    <li>
      <!--<p>编号: <span><?php echo $val->num ?></span></p>-->
      <p>【2015-0327】<a href="/index.php/select/planview?id=<?php echo $val->id ?>"><?php echo $val->title ?></a></p>
      <div class="clean"></div>
    </li>
  <?php 
  
  }
  }
  ?>
 
  </ul>
</div>
<div id="page" style="padding-left:176px;">
  <?=$pages?>
</div>
