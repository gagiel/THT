<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>活动方案>方案管理>新增方案</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
    <div id="info_div" style="display:none;">
     <div style="margin:10px; min-width:900px;">
      <div style="float:left;">
	    <!-- 加载编辑器的容器 -->
	    <script id="info"></script>
	    <!-- 配置文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
      </div>
      <div style="float:left; min-width:290px;">
	    <label class="sizi">编 号：</label>
	    <input type="text" class="bzsr" id="num" name="num" value=""/>
	    <input type="hidden" class="bzsr" id="c_num" name="c_num" value=""/>
	    <p class="szts"><span></span></p>
	    <label class="sizi">标 题：</label>
	    <input type="text" class="bzsr" id="title" name="title" value=""/>
	    <p class="szts"><span></span></p>
	    <label class="sizi">时 间：</label>
	    <input type="text" class="Wdate" id="time" name="time" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
            <p class="szts"><span></span></p>
	    <label class="sizi">发布时间：</label>
	    <input type="text" class="Wdate" id="re_time" name="re_time" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
	    <p class="szts"><span></span></p>
        <label class="sizi">提醒范围：</label>
        <input type="button" style="margin:5px; padding:0 5px;" value="全选" onclick="checkall(true)" />
        <input type="button" style="margin:5px; padding:0 5px;" value="反选" onclick="recheck()" />
        <input type="button" style="margin:5px; padding:0 5px;" value="取消" onclick="checkall(false)" />
        <p class="szts"><span></span></p>
        <div id="CNLTreeMenu1" style="margin-left:50px;">
        <ul>
        <?
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <input type="checkbox" name="range_department" id="d_<?=$i?>" value="<?=$d->id?>" onclick="change(<?=$i?>,this.checked);"/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
            <ul class="Child" id="d_u_<?=$i?>">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <img class="s" src="/images/s.gif" alt="展开/折叠">
              <input type="checkbox" name="range_user" id="u_<?=$j?>" value="<?=$u->id?>" class="check_<?=$i?>" />
              <span onClick="$('#u_<?=$j?>').click();"><?=$u->name?></span>
            </li>
            <?
            		}
            ?>
            </ul>
          </li>

            <?
            	}
          	}
        }
        ?>
        </ul>
        </div>
      </div>
     </div>
    </div>
    <div id="create_div">
     <div id='cccinfo' style="display:none"></div>
     <input type="button" style="display:none" id="iscc"/>
     <iframe id="info_frame" name="info_frame" style="display:none"></iframe>
     <form id="create_form" name="create_form" method="post" action="/index.php/plan/create" target="info_frame">
      <table class="biaozhun" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td class="cklt" width="8%">模板：</td>
            <td colspan="3" class="cknr2" width="92%">
            <select class="bzsr2" id="c_templet" name="c_templet" >
		    	<option value="0">请选择</option>
				<?
				if(is_array($templet))
				{
					foreach($templet as $v)
					{
				?>
				<option value="<?=$v->id?>"><?=$v->name?></option>
				<?
					}
				}
				?>
				<?=$type_opt?>
			</select>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="8%">标题：</td>
            <td colspan="3" class="cknr2" width="92%">
            <input type="text" class="bzsr" id="c_title" name="c_title" value=""/>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="8%">编号：</td>
            <td colspan="3" class="cknr2" width="92%">
              <input type="text" class="bzsr15" id="c_num_y" name="c_num_y" value="<?=date('Y')?>" style="width:40px; text-align:center" />
              <label class="sizi" style="width:10px; text-align:center;padding:0px;" >-</label>
              <input type="text" class="bzsr" id="c_num_n" name="c_num_n" value="<?=sprintf("%03d", $num);?>" style="width:40px;"/></td>
          </tr>
          <tr>
            <td class="cklt" width="8%">导语：</td>
            <td colspan="3" class="cknr2" width="92%">
              <textarea name="c_affairs" cols="" rows="" class="bzsr13" id="c_affairs"></textarea>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="8%">开始时间：</td>
            <td colspan="3" class="cknr2" width="92%">
            <input type="text" class="Wdate" id="c_start" name="c_start" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
            </td>
          </tr>
          <tr>
            <td width="8%" class="cklt">地 址：</td>
            <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr8" name="c_address[]" id="address"/>
              <input name="" type="button" value="+" class="tj_bnt" id="add_addr"/>
                <input type="text" class="bzsr8" name="c_point[]"  id="c_p_<?=$key?>" value="" style="margin-left:2px;"/>
                <input type="button" value="定" class="tj_bnt tabn"  style="margin-top:10px; margin-left:2px;" onclick="get_point(<?=$key?>)"/>
            </td>
          </tr>
          <tr id="dzxx"><td colspan="4" style="height:0px;"></td></tr>
          <tr><td colspan="4" style="height:0px;"></td></tr>
          <tr id="cxld">
            <td class="cklt" width="8%">出席领导：</td>
            <td  width="92%">
              <input type="hidden" name="c_names" id="c_names" value="" />
              <lable id="names_show" style="float:left;line-height:36px;margin: 0 5px;"></lable>
              <input class="btn_cxld" value="请选择"  type="button" onclick="get_ld()">
            </td>
          </tr>
          <tr>
            <td class="cklt" width="8%">参加范围：</td>
            <td width="92%">
              <input type="hidden" name="c_department" id="c_department" value="" />
              <lable id="department_show" style="float:left;line-height:36px;margin: 0 5px;"></lable>
              <input class="btn_cjfw" value="请选择"  type="button" onclick="get_fw()">
            </td>
          </tr>

          <tr>
            <td class="cklt" width="8%">具体安排：</td>
            <td  width="92%"></td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun2" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td width="20%">时间</td>
                    <td>内容</td>
                    <td width="10%"><input id="add_time" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/></td>
                  </tr>
                  <tr>
                    <td>
                      <input class="Wdate bzsr" name="c_time[]" value="" id="d4321" onfocus="WdatePicker({dateFmt:'HH:mm'})" style="width:80px; text-align:center;" type="text">
                    </td>
                    <td>
                      <input class="bzsr11" name="c_plan[]" type="text" style="width:100%;">
                    </td>
                    <td>
                    </td>
                  </tr>
	              <tr id="last_time">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr><td style="height:0px;"></td></tr>
          <tr>
            <td class="cklt" width="8%">工作分工：</td>
            <td  width="92%"></td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun2" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td>分工内容</td>
                    <td width="10%"><input id="add_done" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/></td>
                  </tr>
                  <tr>
                    <td>
                      <input class="bzsr10" name="c_done[]" type="text" style="width:100%;">
                    </td>
                  </tr>
	              <tr id="last_done">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr><td style="height:0px;"></td></tr>
          <tr>
            <td class="cklt" width="8%">落款：</td>
            <td colspan="3" class="cknr2" width="92%"><textarea name="c_remark" cols="" rows="" class="bzsr13"></textarea></td>
          </tr>
      </tbody>
      </table>
     </form>
    </div>
  </div>
  <div class="caozuo5">
    <input type="button" class="b_bnt01" value="确 定" id="btn_create" />
    <input type="button" class="b_bnt01" value="保 存" id="btn_save" style="display:none;" />
  </div>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister">
  <h3 id="div_title">新增方案--选择</h3>
  <div class="nl_det">
      <div id='names_div' class="CNLTreeMenu1" style="height:200px;">
        <ul>
        <?
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		if($d->id!='11')continue;
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Opened">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <span  onClick="return false;"><?=$d->name?></span>
            <ul class="Child" id="d_u_<?=$i?>">
            <?
	            	foreach($u_list[$d->id] as $u)
	            	{
	            		$j++;
            ?>
            <li>
              <img class="s" src="/images/s.gif" alt="展开/折叠">
              <input type="checkbox" name="r_names" id="u_<?=$i?>" value="<?=$u->name?>"/>
              <span  onClick="$('#u_<?=$i?>').click();"><?=$u->name?></span>
            </li>
            <?
            		}
            ?>
            </ul>
          </li>
            <?
            	}
          	}
        }
        ?>
        </ul>
      </div>
      <div id='dept_div' class="CNLTreeMenu1" style="height:200px;display:none;">
        <ul>
        <?
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <input type="checkbox" name="r_dept" id="d_<?=$i?>" value="<?=$d->name?>"/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
          </li>

            <?
            	}
          	}
        }
        ?>
        </ul>
      </div>
  </div>
  <div class="caozuo" id='create_div'>
    <input type="button" class="b_bnt01" value="确 定" id="btn_names" onclick="do_names();" />
    <input type="button" class="b_bnt01" value="确 定" id="btn_dept" onclick="do_dept();" />
	<input type="button" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();" />
  </div>
</div>
<script type="text/javascript">
    function cha_mpp_r(obj){
        var map = new BMap.Map("allmap");    // 创建Map实例
        var point = new BMap.Point(116.331398,39.897445);
        map.centerAndZoom(point,14);
        map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
        function myFun(result){
            var cityName = result.name;
            map.setCenter(cityName);
        }
        var myCity = new BMap.LocalCity();
        myCity.get(myFun);
        //单击获取点击的经纬度
        map.addEventListener("click",function(e){
            alert("当前选择的横坐标为"+ e.point.lng + ", 纵坐标为" + e.point.lat);
            dairu_r(e.point.lng+','+e.point.lat,obj);
        });
    }
    // 百度地图API功能
    function cha_mpp(key){
        var map = new BMap.Map("allmap");    // 创建Map实例
        var point = new BMap.Point(116.331398,39.897445);
        map.centerAndZoom(point,14);
        map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
        function myFun(result){
            var cityName = result.name;
            map.setCenter(cityName);
        }
        var myCity = new BMap.LocalCity();
        myCity.get(myFun);
        //单击获取点击的经纬度
        map.addEventListener("click",function(e){
            alert("当前选择的横坐标为"+ e.point.lng + ", 纵坐标为" + e.point.lat);

            dairu(e.point.lng+','+e.point.lat,key);
            //坐标定位用
//    var x = e.point.lng;
//    var y = e.point.lat;
//    var ggPoint = new BMap.Point(x,y);
//
//    //坐标转换完之后的回调函数
//    translateCallback = function (data){
//      if(data.status === 0) {
//        var marker = new BMap.Marker(data.points[0]);
//        map.addOverlay(marker);
//        var label = new BMap.Label("横坐标:"+e.point.lng+"纵坐标:"+e.point.lat,{offset:new BMap.Size(20,-10)});
//        marker.setLabel(label); //添加百度label
//        map.setCenter(data.points[0]);
//      }
//    }
//
//    setTimeout(function(){
//      var convertor = new BMap.Convertor();
//      var pointArr = [];
//      pointArr.push(ggPoint);
//      convertor.translate(pointArr, 1, 5, translateCallback)
//    }, 1000);
        });
    }


</script>
<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
    var editor = new UE.ui.Editor({
        toolbars:[[
        	'undo', 'redo', '|',
        	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', '|',
        	'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'indent', '|',
        	'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
        	'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        	'selectall', 'cleardoc']],
    	initialHeight:$('.con_detail').height()-70,
    	initialFrameHeight:$('.con_detail').height()-70,
    	initialWidth:680,
    	initialFrameWidth:680,
    	scaleEnabled:true
    });
    editor.render("info");
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
		editor.setHeight($('.con_detail').height()-70);
	});

	/* 添加地址 */
	$("#add_addr").click(function(){
		var tr = "<tr class='mdz'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr8' name='c_address[]' id='' value=''/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_addr(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dzxx").before(tr);
	});
	/* 添加具体安排 */
	$("#add_time").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input class="Wdate bzsr" name="c_time[]" value="" id="d4321" onfocus="WdatePicker({dateFmt:\'HH:mm\'})" style="width:80px; text-align:center;" type="text">'
			   +   '</td>'
			   +   '<td>'
			   +     '<input class="bzsr11" name="c_plan[]" type="text" style="width:100%;">'
			   +   '</td>'
			   +   '<td><input type="button" value="-" class="tj_bnt tabn" style=" margin-left: 8px;" onclick="del_time(this)"/></td>'
			   + '</tr>';

		$("#last_time").before(tr);
	});
	/* 添加工作分工 */
	$("#add_done").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input class="bzsr11" name="c_done[]" type="text" style="width:100%;">'
			   +   '</td>'
			   +   '<td><input type="button" value="-" class="tj_bnt tabn" style=" margin-left: 8px;" onclick="del_done(this)"/></td>'
			   + '</tr>';

		$("#last_done").before(tr);
	});

	$('#iscc').click(function(){
		editor.setContent($('#cccinfo').html());
		$("#create_div").hide();
		$("#btn_create").hide();
		$("#info_div").show();
		$("#btn_save").show();
	})

	$('#btn_create').click(function(){
		var num_y	= $('#c_num_y').val();
		var num_n	= $('#c_num_n').val();
		var title	= $('#c_title').val();
		var start	= $('#c_start').val();
                var re_time     = $('#re_time').val();
		if(num_y=='' || num_n=='')
		{
			alert('请填写编号');
			return false;
		}
		if(title=='')
		{
			alert('请填写标题');
			return false;
		}
		if(start=='')
		{
			alert('请填写开始时间');
			return false;
		}
                if(re_time=='')
		{
			alert('请填写发布时间');
			return false;
		}
		$("#create_form").submit();
	});

	$('#btn_save').click(function(){
		var num		= $('#num').val();
		var c_num		= $('#c_num').val();
		var title	= $('#title').val();
		var time	= $('#time').val();
		var info	= editor.getContent();
		var user	= '';
                var remark      =$('#c_remark').val();
                var re_time     =$('#re_time').val();

		if(num=='')
		{
			alert('请填写编号');
			return false;
		}
		if(title=='')
		{
			alert('请填写标题');
			return false;
		}
		if(time=='')
		{
			alert('请填写时间');
			return false;
		}
		$('input[name="range_user"]').each(function(){
			if(this.checked)
			{
				if(user!='')user += ',';
				user += $(this).val();
			}
		});
		$.post(
			"/index.php/plan/save",
			{
				id	: 0,
				num	: num,
				title	: title,
				time	: time,
				info	: info,
				user	: user,
				c_num	: c_num,
                                remark  :remark,
                                re_time :re_time
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert("保存成功");
					location.href="/index.php/plan/index";
				}
				else
				{
					alert(data);
				}
			}
		);
	});
});
function dairu_r(point,obj){

    var mapobj = obj.previousSibling;
    mapobj.value=point;
}
//全选、取消全部
function checkall(check)
{
	$("input[type='checkbox']").each(function(){
		this.checked=check;
	});
}
//反选
function recheck()
{
	$("input[type='checkbox']").each(function(){
		this.checked=!this.checked;
	});
}

function change(i,checked) {
	$("input[type='checkbox']").each(function(){
		if(this.className=='check_'+i)
		this.checked=checked;
	});
}
/* 删除地址 */
function min_addr(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除具体安排 */
function del_time(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 删除工作分工 */
function del_done(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
function create(data)
{
	$('#title').val($('#c_title').val());
	$('#num').val($('#c_num_y').val()+'-'+$('#c_num_n').val());
	$('#c_num').val($('#c_num_n').val());
	$('#time').val($('#c_start').val());
	$('#cccinfo').html(data);
	$('#iscc').click();
}
function get_ld()
{
	$("#div_title").html("新增方案--出席领导");

	$('#dept_div').hide();
	$('#btn_dept').hide();

	$('#names_div').show();
	$('#btn_names').show();

	$('#wincover').show();
	$('#winregister').center();
}
function do_names()
{
	var names = '';
	$('input[name="r_names"]').each(function(){
		if(this.checked)
		{
			if(names!='')names += ',';
			names += $(this).val();
		}
	});
	$("#c_names").val(names);
	$("#names_show").html(names);

	$('#wincover').hide();
	$('#winregister').hide();

}
function get_fw()
{
	$("#div_title").html("新增方案--参加范围");

	$('#names_div').hide();
	$('#btn_names').hide();

	$('#dept_div').show();
	$('#btn_dept').show();

	$('#wincover').show();
	$('#winregister').center();
}
function do_dept()
{
	var dept = '';
	$('input[name="r_dept"]').each(function(){
		if(this.checked)
		{
			if(dept!='')dept += ',';
			dept += $(this).val();
		}
	});
	$("#c_department").val(dept);
	$("#department_show").html(dept);

	$('#wincover').hide();
	$('#winregister').hide();

}
c_department
</script>