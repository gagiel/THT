<?
$arr_jurisdict = explode(',',$this->session->userdata('user_jurisdict'));
?>
<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>

<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter>新闻查看</p>
    <div class="sst_sm">
      <?=$select?>
    </div>
  </div>
  <form id="sub_form" action="/index.php/news/view" method="post">
  <div class="con_detail">
    <div class="ser_b">
    <label class="sizi">类 型：</label>
    <select class="bzsr2" name="type" style="width:90px;" onchange="$('#get_form').submit();" >
      <option value="0">全部</option>
      <?=$type_opt?>
    </select>
    <label class="sizi">内 容：</label>
    <input type="text" class="bzsr" name="info" value="<?=$where['info']?>" style="width:130px;" />
    <label class="sizi">时 间：</label>
    <input type="text" class="Wdate" name="start" value="<?=$where['start']?>" id="d4321" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:0});}'})" style="width:100px;"/>
    <label class="sizi" style="width:10px;">~</label>
    <input type="text" class="Wdate" name="end" value="<?=$where['end']?>" id="d4322" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:0});}'})" style="width:100px;"/>
    <input type="submit" class="b_bnt01" value="查 询"/>
    <input type="button" class="b_bnt01" value="返 回" onclick="back()" style="float:right;"/>
    </div>
    
  <div class="biaozhun">
    <!-- 加载编辑器的容器 -->
    <script id="einfo" name="einfo" type="text/plain"><?=$info?></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
  </div>
  </div>
  	
      <div class="caozuo5" style="width:400px;">
        <? if(in_array('16',$arr_jurisdict)){ ?>
        <input type="button" id="btn_comment_manage" class="b_bnt01" value="点评管理" <?=$where['start']==$where['end']?'':' style="color:#aaa" disabled="true"'?> />
        <? 
        }if(in_array('11',$arr_jurisdict)){ ?>
        <input type="button" id="btn_discomment" class="b_bnt01" value="删除点评" <?=$where['start']==$where['end']?'':' style="color:#aaa" disabled="true"'?> />
        <input type="button" id="btn_comment" class="b_bnt01" value="点 评" <?=$where['start']==$where['end']?'':' style="color:#aaa" disabled="true"'?> />
        <? 
        }
        if(in_array('8',$arr_jurisdict)){ ?>
        <input type="button" id="btn_edit" class="b_bnt01" value="编 辑" />
        <? } ?>
      </div>
  </form>
</div>
<div id="wincover"></div>
<div class="newli" id="winregister">
<h3 id="div_title">NewsLetter--</h3>
 <div id='com_div'>
<? if(in_array('11',$arr_jurisdict) && $where['start']==$where['end']){ ?>
  <div class="nl_det">
  	<textarea id="com_info" name="info" rows="10" cols="50" wrap="off"></textarea>
  </div>
  <div class="caozuo">
	  <input type="button" class="b_bnt01" value="保 存" onclick="subCom()" />
	  <input type="button" class="b_bnt01" value="取 消" onclick="$('#winregister').hide();$('#wincover').hide();"/>
  </div>
<script>
var edit = false;
function subCom()
{
	var info = $("#com_info").val();
	if(info=='')
	{
		alert('请填写点评内容');
		return false;
	}
	$.post(
		"/index.php/news/comment",
		{
			ndate:'<?=$where['start']?>',
			info:info,
			isedit:edit
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				$("#sub_form").submit();
			}
			else
			{
				alert(data);
			}
		}
	);
}
</script>
<? }?>
 </div>
 <div id='com_del'>
  <div class="nl_det" style="width:500px; height:200px; overflow-y:auto; ">
  <table id='com_del_table' cellspacing="0" cellpadding="0" class="biaozhun" style="width:450px; min-width:450px;" >
	<tr class="tab_tit">
		<td>点评人</td>
		<td>内容</td>
		<td>操作</td>
	</tr>
</table>

  </div>
  <div class="caozuo" style="width:100px;">
	  <input type="button" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();$('#sub_form').submit();"/>
  </div>
 </div>
</div>
<script>
function back()
{
	location.href="/index.php/news/calendar";
}
function del_com(id){
	$.post(
		"/index.php/news/comment_del",
		{
			id:id
		},
		function (data) //回传函数
		{
			if(data=='success')
			{
				$("#deltr_"+id).hide();
			}
			else
			{
				alert(data);
			}
		}
	);
}
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
	});	
	
    var editor = new UE.ui.Editor({
    	toolbars:[],
    	readonly:true,
    	initialHeight:$('.con_detail').height()-80,
    	initialFrameHeight:$('.con_detail').height()-80,
    	scaleEnabled:true
    });
    editor.render("einfo");
    
    
<? if(in_array('16',$arr_jurisdict) && $where['start']==$where['end']){ ?>
    $("#btn_comment_manage").click(function(){
		$.post(
			"/index.php/news/comment_manage",
			{
				ndate:'<?=$where['start']?>'
			},
			function (data) //回传函数
			{
				var dataObj=eval("("+data+")");//转换为json对象 
				
				$('#div_title').html('NewsLetter--点评管理');
				$('#div_title').focus();
				$.each(dataObj,function(i,item){
					var tr = "<tr id='deltr_"+item.id+"'><td>"+item.name+"</td><td>"+item.info+"</td><td><input type='button' class='b_bnt' value='删除' onclick='del_com("+item.id+")'/></td></tr>";
					$("#com_del_table").append(tr);
				});
				$('#com_div').hide();
				$('#com_del').show();
				$('#wincover').show();
				$('#winregister').center();
			}
		);
    });
    
<? 
} if(in_array('11',$arr_jurisdict) && $where['start']==$where['end']){ ?>
    $("#btn_comment").click(function(){
		$.post(
			"/index.php/news/comment_get",
			{
				ndate:'<?=$where['start']?>'
			},
			function (data) //回传函数
			{
				if(data!='')edit=true;
				$('#div_title').html('NewsLetter--点评');
				$('#com_div').show();
				$('#com_del').hide();
				$('#wincover').show();
				$('#winregister').center();
				$("#com_info").val(data);
				$("#com_info").focus();
			}
		);
    });
    
    $("#btn_discomment").click(function(){
		$.post(
			"/index.php/news/comment_delete",
			{
				ndate:'<?=$where['start']?>'
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					$("#sub_form").submit();
				}
				else
				{
					alert(data);
				}
			}
		);
    });
<? 
}
if(in_array('8',$arr_jurisdict)){ ?>
    $("#btn_edit").click(function(){
		$('#sub_form').attr('action', '/index.php/news');
		$("#sub_form").submit();
    });
<? } ?>
    
});
</script>
