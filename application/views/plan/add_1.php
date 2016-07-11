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
    <div id="create_div">
     <div id='cccinfo' style="display:none"></div>
     <input type="button" style="display:none" id="iscc"/>
     <iframe id="info_frame" name="info_frame" style="display:none"></iframe>
     <form id="create_form" name="create_form" method="post" action="/index.php/plan/create_1" >
       <div class="haha"> 
      <table class="biaozhun01" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td class="cklt" width="10%">模板：</td>
            <td colspan="3" class="cknr2" width="90%">
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
				
			</select>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="10%">标题：</td>
            <td colspan="3" class="cknr2" width="90%">
            <input type="text" class="bzsr" id="c_title" name="c_title" value=""/>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="10%">编号：</td>
            <td colspan="3" class="cknr2" width="90%">
              <input type="text" class="bzsr15" id="c_num_y" name="c_num_y" value="<?=date('Y')?>" style="width:40px; text-align:center" />
              <label class="sizi" style="width:10px; text-align:center;padding:0px;" >-</label>
              <input type="text" class="bzsr" id="c_num_n" name="c_num_n" value="<?=sprintf("%03d", $num);?>" style="width:40px;"/></td>
          </tr>
          <tr>
            <td class="cklt" width="10%">导语：</td>
            <td colspan="3" class="cknr2" width="90%">
              <textarea name="c_affairs" cols="" rows="" class="bzsr13" id="c_affairs"></textarea>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="10%">开始时间：</td>
            <td colspan="3" class="cknr2" width="10%">
            <input type="text" class="Wdate" id="c_start" name="c_start" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
            </td>
          </tr>
          <tr>
            <td width="10%" class="cklt">地 址：</td>
            <td width="90%" colspan="3" class="cknr2">
              <input type="text" class="bzsr8" name="c_address[]" id="address"/>
              <input name="" type="button" value="+" class="tj_bnt" id="add_addr"/>
            </td>
          </tr>
          <tr id="dzxx"><td colspan="4" style="height:0px;"></td></tr>
          <tr><td colspan="4" style="height:0px;"></td></tr>
          <tr id="cxld">
            <td class="cklt" width="10%">出席领导：</td>
            <td  width="10%">
              <input type="hidden" name="c_names" id="c_names" value="" />
              <lable id="names_show" style="float:left;line-height:36px;margin: 0 5px;"></lable>
              <input class="btn_cxld" value="请选择"  type="button" onclick="get_ld()">
            </td>
          </tr>
          <tr>
            <td class="cklt" width="10%">参加范围：</td>
            <td width="90%">
              <input type="hidden" name="c_department" id="c_department" value="" />
              <lable id="department_show" style="float:left;line-height:36px;margin: 0 5px;"></lable>
              <input class="btn_cjfw" value="请选择"  type="button" onclick="get_fw()">
            </td>
          </tr>
          
          <tr>
            <td class="cklt" width="10%">具体安排：</td>
            <td  width="90%"></td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun03" cellpadding="0" cellspacing="0">
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
            <td class="cklt" width="10%">工作分工：</td>
            <td  width="90%"></td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun04" cellpadding="0" cellspacing="0">
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
            <td class="cklt" width="10%">落款：</td>
            <td colspan="3" class="cknr2" width="90%"><textarea name="c_remark" cols="" rows="" class="bzsr13"></textarea></td>
          </tr>  
	   <tr><td style="height:0px;"></td></tr>
      </tbody>
      </table>	
	<table class="biaozhun02" cellpadding="0" cellspacing="0">
        <tbody>
          <tr><td style="height:0px;"></td></tr>
             <tr>
            <td class="cklt" width="10%">方案类型：</td>
            <td colspan="3" class="cknr2" width="90%">
            <select class="bzsr2" id="c_type" name="c_type" >
		    	<option value="0">请选择</option>
                        <? 
				if(is_array($type))
				{
					foreach($type as $key=>$value)
					{
				?>
                                <option value="<?=$key?>"><?=$value?></option>
				<?
					}
				}
				?>
			</select>
            </td>
          </tr>
           <tr><td style="height:0px;"></td></tr>
             <tr>
            <td class="cklt" width="10%">方案性质：</td>
            <td colspan="3" class="cknr2" width="90%">
            <select class="bzsr2" id="c_nature" name="c_nature" >
		    	<option value="0">请选择</option>
                         <? 
				if(is_array($nature))
				{
					foreach($nature as $key=>$value)
					{
				?>
                                <option value="<?=$key?>"><?=$value?></option>
				<?
					}
				}
				?>
			</select>
            </td>
          </tr>
          <tr>
            <td class="cklt" width="10%">前期准备：</td>
            <td  width="90%"></td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun05" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td>准备事项</td>
                    <td width="10%"><input id="add_ready" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/></td>
                  </tr>
                  <tr>
                    <td>
                      <input class="bzsr10" name="c_ready[]" type="text" style="width:100%;">
                    </td>
                  </tr>
	              <tr id="last_ready">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>
            </td>
          </tr>
         
          <tr><td style="height:0px;"></td></tr>
           <tr>
            <td class="cklt" width="10%">附件：</td>
            <td colspan="3" class="cknr2" width="90%">
           </tr>
          <tr>
            <td colspan="4">
              <table class="biaozhun04" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr class="tab_tit alt">
                    <td>附件信息</td>
                    <td></td>
                    <td width="10%">
                        <input id="add_file" value="+"   class="tj_bnt" style=" float: right; margin-right: 3px; position: relative; top: -2px; " type="button"/>
                    </td>
                  </tr>
                    <tr >
			   <td width="80%">
			       <input class="bzsr11" name="c_file[]" type="text" style="width:95%;" id="file_0"/>
                               <input class="bzsr10" name="c_fileurl[]" type="hidden" id="fileurl_0"/>
			   </td>
                           <td width="10%">
			   <input class="btn_cxld a_file" value="上传" type="button" onclick="get_file(this)" num="0"/>
			   </td >
                      </tr>
                      <tr id="last_file">
	                <td colspan="3" style="height:0px;"></td>
	              </tr>
                </tbody>
              </table>
            </td>
          </tr>
           <tr><td style="height:0px;"></td></tr>
            <tr><td style="height:0px;"></td></tr>
          <tr>
            <td class="cklt" width="10%">备注：</td>
            <td colspan="3" class="cknr2" width="90%"><textarea name="c_other" cols="" rows="" class="bzsr13"></textarea></td>
          </tr> 
      </tbody>
      </table>	 
	    </div>
     </form>
    </div>
  </div>
  <div class="caozuo5">
    <input type="button" class="b_bnt01" value="确 定" id="btn_create" />
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
	/* 添加地址 */
	$("#add_addr").click(function(){
		var tr = "<tr class='mdz'>"
			   +   "<td width='10%'></td>"
			   +   "<td width='90%' colspan='3' class='cknr2'>"
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
	/* 添加前期准备 */
	$("#add_ready").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input class="bzsr11" name="c_ready[]" type="text" style="width:100%;">'
			   +   '</td>'
			   +   '<td><input type="button" value="-" class="tj_bnt tabn" style=" margin-left: 8px;" onclick="del_ready(this)"/></td>'
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
			   +   '</td>'
                           +   '<td width="10%">'
			   +     '<input class="btn_cxld a_file" value="上传" type="button" onclick="get_file(this)" num="'+num+'" >'
			   +   '</td>'
			   +   '<td width="10%"><input type="button" value="-" class="tj_bnt tabn" style=" margin-left: 8px;" onclick="del_file(this)"/></td>'
			   + '</tr>';
              
		$("#last_file").before(tr);
	});

	$('#btn_create').click(function(){
		var num_y	= $('#c_num_y').val();
		var num_n	= $('#c_num_n').val();
		var title	= $('#c_title').val();
		var start	= $('#c_start').val();
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
		$("#create_form").submit();
	});
	
});


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
/* 删除准备事项 */
function del_ready(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
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
	$('#file_div').hide();
	$('#btn_file').hide();
        
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
function do_file(){
   var url=$('#i_pic').val();
   var name=$('#i_pic').attr('filename');
   var num=$('#i_pic').attr('num');
   
   $("#file_"+num).val(name);
   $("#fileurl_"+num).val(url);
   $('#wincover').hide();
   $('#winregister').hide();
        
}
function get_fw()
{
	$("#div_title").html("新增方案--参加范围");
	
	$('#names_div').hide();
	$('#btn_names').hide();
	$('#file_div').hide();
	$('#btn_file').hide();
        
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