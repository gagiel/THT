<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>活动方案>方案管理>修改方案</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
   <div style="margin:10px; min-width:900px;">
    <div style="float:left;">
	    <!-- 加载编辑器的容器 -->
	    <script id="info"><?=$info->info?></script>
	    <!-- 配置文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    </div>
    <div style="float:left; min-width:490px;">
	    <label class="sizi">编 号：</label>
	    <input type="text" class="bzsr" id="num" name="num" value="<?=$info->num?>"/>
	    <p class="szts"><span></span></p>
	    <label class="sizi">标 题：</label>
	    <input type="text" class="bzsr" id="title" name="title" value="<?=$info->title?>"/>
	    <p class="szts"><span></span></p>
	    <label class="sizi">时 间：</label>
	    <input type="text" class="Wdate" id="time" name="time" width="120" value="<?=substr($info->start,0,-3)?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
	    <p class="szts"><span></span></p>
	     <label class="sizi">出席领导：</label>
	     <input type="hidden" class="bzsr" id="name" name="name" width="120" value="<?=$info->join_user?>"  />
              <lable id="names_show" style="float:left;line-height:36px;margin: 0 5px;"><?=$info->join_user?></lable>
              <input class="btn_cxld" value="请选择"  type="button" onclick="get_ld()">
	    <p class="szts"><span></span></p>
	    <label class="sizi">参加范围：</label>
	    <input type="hidden" class="bzsr" id="department" name="department" width="120" value="<?= $info->join_dept?>" />
             <lable id="department_show" style="float:left;line-height:36px;margin: 0 5px;"><?= $info->join_dept?></lable>
             <input class="btn_cjfw" value="请选择"  type="button" onclick="get_fw()">
             <p class="szts"><span></span></p>
            <label class="sizi">方案类型：</label>
              <select class="bzsr2" id="type" name="type" >
		    	<option value="0">请选择</option>
                         <? 
				if(is_array($plan_type))
				{
					foreach($plan_type as $key=>$value)
					{
				?>
                                <option value="<?=$key?>" <?php if($key==$info->type) echo "selected";?>><?=$value?></option>
				<?
					}
				}
				?>
			</select>
            <p class="szts"><span></span></p>
            <label class="sizi">方案性质：</label>
             <select class="bzsr2" id="nature" name="nature" >
		    	<option value="0">请选择</option>
                         <? 
				if(is_array($plan_nature))
				{
					foreach($plan_nature as $key=>$value)
					{
                                        
				?>
                                <option value="<?=$key?>" <?php if($key==$info->nature) echo "selected";?>><?=$value?></option>
				<?
					}
				}
				?>
			</select>
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
        	$users = explode(',',$info->users);
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
              <input type="checkbox" name="range_user" id="u_<?=$j?>" value="<?=$u->id?>" class="check_<?=$i?>"<?=in_array($u->id,$users)?' checked':''?> />
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
	<p class="szts"><span></span></p>
        <label class="sizi">前期准备：</label>
	<input  id="del_ready_list" value="" type="hidden">
	  
              <table class="biaozhun06" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td>准备事项</td>
                    <td width="10%"><input id="add_ready" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/></td>
                  </tr>
		  	<?php if(!empty($ready)){ 
	              foreach($ready as $k=>$v ){
	    ?> 
                 <tr>
			   <td>
			       <input class="bzsr11" name="ready[]" type="text" tab="<?=$k?>" value="<?=$v?>" />
			   </td>
			   <td>
			       <input type="button" value="-" class="tj_bnt tabn plusRedu" style=" margin-left: 8px;"/>
			   </td>
			   </tr>
		<?php 
		 }
                  }
                      ?>
                     
	              <tr id="last_ready">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>

	<p class="szts"><span></span></p>
        <label class="sizi">附件：</label>
        <input  id="del_file_list" value="" type="hidden">
              <table class="biaozhun04" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td>附件信息</td>
                    <td></td>
                    <td width="10%">
                        <input id="add_file" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/>
                    </td>
                  </tr>
                   <?php
                        if(!empty($file)){
                            foreach($file as $key=>$value){
                        ?>
                    <tr >
			   <td width="80%">
                               <input class="bzsr11" name="c_file[]" type="text" style="width:95%;" id="file_<?=$key?>" value="<?=$value->name?>" tag="<?=$value->id?>"/>
                               <input class="bzsr10" name="c_fileurl[]" type="hidden" id="fileurl_<?=$key?>" value="<?=$value->url;?>"/>
                               <input class="bzsr10" name="c_fileid[]" type="hidden" id="fileid_<?=$key?>" value="<?=$value->id;?>"/>
			   </td>
                           <td width="10%">
                               <input class="btn_cxld a_file" value="上传" type="button" onclick="get_file(this)" num="<?=$key?>"/>
                              
			   </td >
                           <td width="10%"><input type="button" value="-" class="tj_bnt tabn plus" style=" margin-left: 8px;" onclick="del_file(this)"/></td>
                      </tr>
                      <?php        
                            }
                        }else{
                            ?>
                      <tr>
			   <td width="80%">
                               <input class="bzsr11" name="c_file[]" type="text" style="width:95%;" id="file_0" value="" />
                               <input class="bzsr10" name="c_fileurl[]" type="hidden" id="fileurl_0" value=""/>
                               <input class="bzsr10" name="c_fileid[]" type="hidden" id="fileid_0" value="0"/>
			   </td>
                           <td width="10%">
                               <input class="btn_cxld a_file" value="上传" type="button" onclick="get_file(this)" num="0"/>
                              
			   </td >
                           <td width="10%"><input type="button" value="-" class="tj_bnt tabn plus" style=" margin-left: 8px;" onclick="del_file(this)"/></td>
                      </tr>
                     <?php
                        }
                        ?>
                      <tr id="last_file">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>
	<p class="szts"><span></span></p>
        <label class="sizi">备注：</label>
	<textarea name="other" cols="" rows="" id="other" class="bzsr13"><?=$info->remark ?></textarea>
	<p class="szts"><span></span></p>
   </div>
  </div>
  <div class="caozuo5">
    <input type="button" id="btn_save" class="b_bnt01" value="保 存" />
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
		$join_users = explode(',',$info->join_user);
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
              <input type="checkbox" name="r_names" id="u_<?=$i?>" value="<?=$u->name?>" <?=in_array($u->name,$join_users)?' checked':''?>/>
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
		$join_dept = explode(',',$info->join_dept);
          	foreach($d_list as $d)
          	{
          		$i++;
	            if(isset($u_list[$d->id]))
	            {
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <input type="checkbox" name="r_dept" id="d_<?=$i?>" value="<?=$d->name?>" <?=in_array($d->name,$join_dept)?' checked':''?>/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
          </li>
          
            <?
            	}
          	}
        }
        ?>
        </ul>
      </div>
       <div id="file_div" class="CNLTreeMenu1" style="height:100px; display: none">
                
		<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
	    <form action="/index.php/plan/update_file" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame">
	    <label class="sizi">文  件：</label>
            <input type='text' class='bzsr' id='i_pic' style="width:110px;"  filename="" value="" num=""/> 
	    <input type='button' class='btn' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file').click();" />
	    <input type="file" class="file" name="i_file" id="i_file" onchange="$('#i_pic').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" /> 
	    <input type="submit" name="submit" class="btn" value="上传" style="margin:5px 5px 5px 0;" />
	    </form>
	    <p class="szts"><span></span></p>
	   
       </div> 
  </div>
  <div class="caozuo" id='create_div'>
    <input type="button" class="b_bnt01" value="确 定" id="btn_names" onclick="do_names();" />
    <input type="button" class="b_bnt01" value="确 定" id="btn_dept" onclick="do_dept();" />
    <input type="button" class="b_bnt01" value="确 定" id="btn_file" onclick="do_file();" />
	<input type="button" class="b_bnt01" value="关 闭" onclick="$('#winregister').hide();$('#wincover').hide();" />
  </div>
</div>
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
		
	$('#btn_save').click(function(){
		
		var num		= $('#num').val();
		var title	= $('#title').val();
		var time	= $('#time').val();
		var info	= editor.getContent();
		var other       =$('#other').html();
		var name	=$('#name').val();
		var department  =$('#department').val();
		var del_ready   =$('#del_ready_list').val();
                var del_file    =$('#del_file_list').val();
                var type        =$('#type').val();
                var nature      =$('#nature').val();
		var ready       ='';
		var user	= '';
		var tab         ='';
                var file='';
                var fileurl='';
                var fileid='';
		
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
		$('input[name="ready[]"]').each(function(){
			  var _this =  $(this);
				if(ready!=''){  
				ready += ',';
				tab+=',';
				}
				ready += _this.val();   
				tab+=_this.attr('tab');
		});
		$('input[name="range_user"]').each(function(){
			if(this.checked)
			{
				if(user!='')user += ',';
				user += $(this).val(); 
			}
		});
                 $('input[name="c_file[]"]').each(function(){
				if(file!='')file += ',';
				file += $(this).val(); 
			
		});
                $('input[name="c_fileurl[]"]').each(function(){
				if(fileurl!='')fileurl += ',';
				fileurl += $(this).val(); 
			
		});
                $('input[name="c_fileid[]"]').each(function(){
				if(fileid!='')fileid += ',';
				fileid += $(this).val(); 
			
		});
		$.post(
			"/index.php/plan/save",
			{
				id		: <?=$info->id?>,
				num		: num,
				title	: title,
				time	: time,
				info	: info,
				user	: user,
                                type    :type,
                                nature  :nature,
				other   : other,
				ready   : ready,
				del_file: del_file,
				name    : name,
				department: department,
			        del_ready: del_ready,
			        tab:tab,
                                file:file,
                                fileurl:fileurl,
                                fileid:fileid
                                
			},
			function (data) //回传函数
			{
				if(data=='success')
				{
					alert("修改成功");
					location.href="/index.php/plan/index";
				}
				else
				{
					alert(data);
				}
			}
		);
	});
	
	/* 添加前期准备 */
	$("#add_ready").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input class="bzsr11" name="ready[]" type="text" tab="0" />'
			   +   '</td>'
			   +   '<td><input type="button" value="-" class="tj_bnt tabn plusRedu" style=" margin-left: 8px;"/></td>'
			   + '</tr>';
              
		$("#last_ready").before(tr);
	});
        /* 添加附件信息 */
	$("#add_file").click(function(){
           var number=Number($(".a_file:last").attr('num'));
            var num= number+1;
           
		var tr = '<tr>'
			   +   '<td width="80%">'
			   +     '<input class="bzsr11" name="c_file[]" type="text" style="width:95%;" id="file_'+num+'">'
                           +     '<input class="bzsr10" name="c_fileurl[]" type="hidden" id="fileurl_'+num+'"/>'
                           +     '<input class="bzsr10" name="c_fileid[]" type="hidden" id="fileid_'+num+'" value="0"/>'
			   +   '</td>'
                           +   '<td width="10%">'
			   +     '<input class="btn_cxld a_file" value="上传" type="button" onclick="get_file(this)" num="'+num+'" >'
			   +   '</td>'
			   +   '<td width="10%"><input type="button" value="-" class="tj_bnt tabn" style=" margin-left: 8px;" onclick="del_file(this)"/></td>'
			   + '</tr>';
              
		$("#last_file").before(tr);
	});
	
	$(document).on('click','.plusRedu',function(){
	               var tr=$(this).parent().parent();
		       var name = tr.find(".bzsr11").attr("tab");
		       var del_list=$('#del_ready_list').attr('value')+name+",";
		       $("#del_ready_list").attr('value',del_list);
		       tr.remove(); 
		});
      $(document).on('click','.plus',function(){
	               var tr=$(this).parent().parent();
		       var name = tr.find(".bzsr11").attr("tag");
		       var del_list=$('#del_file_list').attr('value')+name+",";
		       $("#del_file_list").attr('value',del_list);
		       tr.remove(); 
		});          
});
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
/* 删除附件 */
function del_file(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
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

function get_file(ev)
{
      
       var num=ev.getAttribute("num");
	$("#div_title").html("新增方案--上传附件");
	
	$('#dept_div').hide();
	$('#btn_dept').hide();
	$('#names_div').hide();
	$('#btn_names').hide();
        
	$('#file_div').show();
	$('#btn_file').show();
        $('#i_pic').attr('num',num);
	$('#i_pic').val('');
        $('#i_pic').attr("filename","");
	$('#wincover').show();
	$('#winregister').center();
}

function do_file(){
   var url=$('#i_pic').val();
   var name=$('#i_pic').attr('filename');
   var num=$('#i_pic').attr('num');
   
   $("#file_"+num).val(name);
   $("#fileurl_"+num).val(url);
   $('#wincover').hide();
   $('#winregister').hide();
        
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
	$("#name").val(names);
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
	$("#department").val(dept);
	$("#department_show").html(dept);
	
	$('#wincover').hide();
	$('#winregister').hide();
	
}
//上传图片后，返回显示
function pic_back(re)
{
	if(re=='false')
	{
		alert('图片上传失败');
	}
	else
	{
            //console(re);
            //alert(re);
            var retu=re.split(",");
		$("#i_pic").val(retu[1]);
		$("#i_pic").attr("filename",retu[0]);
	}
}
</script>