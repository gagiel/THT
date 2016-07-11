<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页 > 投资意向管理> 新增投资意向</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
     <form id="create_form" name="create_form" method="post" action="/index.php/investment/save" >
	  <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">产业名称：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="industry" /></td>
        </tr>
        <tr>
          <td colspan="2">
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="30%">投资部门</td>
                <td width="50%">部门电话(多个电话用/分割)</td>
                <td width="10%"><input name="" type="button" value="新增" class="s_bnt01" id="add"/></td>
              </tr>
              <tr>
                <td>
                     <input type="text" class="bzsr" name="department[]"/>
                </td>
                <td>
                    <input type="text" class="bzsr" name="tel[]"/>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="8%" class="cklt">排 序：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="mark" />
          </td>
        </tr>
        <tr id="zwxx"><td colspan="4" style="height:0px;"></td></tr>
        </table>
	   	 </div>
	   	  <div class="caozuo5">
    		<input type="button" id="btn_save" class="b_bnt01" value="保 存" onclick="save()" />
    		<input type="button" class="b_bnt01" value="返 回"  onclick="window.location.href='/index.php/investment/index'" />
  		  </div>
	</form>
  </div>
 
</div>
</div>

<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	/* 添加部门 */
	$("#add").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input type="text"  name="department[]" class="bzsr" />'
			   +   '</td>'
			   +   '<td>'
			   +     '<input type="text"  name="tel[]" class="bzsr" />'
			   +   '</td>'
			   +   '<td><input type="button" value="删除" class="s_bnt01 red" onclick="del_dpt(this)" /></td>'
			   + '</tr>';
		$('.biaozhun2').append(tr);
	});

});

function save(){
	var industry       = $('[name="industry"]').val();
	if(industry==''){
		alert('请填写产业名称');
		return false;
	}
	var department = '';
	$('[name="department[]"]').each(function(){
		if($(this).val() != ''){
			department += $(this).val()+',';
		}
	});
	var tel = '';
	$('[name="tel[]"]').each(function(){
		if($(this).val() != ''){
			tel += $(this).val()+',';
		}
	});
	if(department==''){
		alert('投资部门不能为空');
		return false;
	}
	if(tel==''){
		alert('电话不能为空');
		return false;
	}
	$.post(
		"/index.php/investment/save",
		$('#create_form').serialize(),
		function (data) //回传函数
		{
			alert(data);
			if(data=='操作成功')
			{
				
				location.href="/index.php/investment/add";
			}
		}
	);
}
        
/* 删除部门 */
function del_dpt(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
	

</script>
