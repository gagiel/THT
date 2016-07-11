<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<script src="/js/tree.js" type="text/javascript" ></script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>信贷业务管理>添加信贷</p>
  </div>
  
  <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="/index.php/bank/save" id="sub_form">
    <div class="con_detail">
      <table cellpadding="0" cellspacing="0" class="biaozhun">
        <tr>
          <td width="8%" class="cklt">银行名称：</td>
          <td width="42%" class="cknr2"><input type="text" class="bzsr" name="name" id="name" /></td>
        </tr>
       <tr>
       	<td colspan="4">
		    <table cellspacing="0" cellpadding="0" class="biaozhun2">
              <tr class="tab_tit">
                <td width="20%">业务名称</td>
                <td width="70%">业务说明</td>
                <td width="5%">排序 </td>
                <td width="5%"><input name="" type="button" value="新增" class="s_bnt01" id="add"/></td>
              </tr>
              <tr>
                <td>
                     <input type="text" class="bzsr" name="business_name[]"/>
                </td>
                <td>
                    <textarea name="business_explain[]" style="width:80%"></textarea>
                </td>
                 <td>
                    <input type="text" class="bzsr" name="mark[]"/>
                </td>
              </tr>
            </table>
          </td>
       </tr>
        <tr>
          <td width="8%" class="cklt">联系人：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="contact" />
          </td>
        </tr>
		<tr>
          <td width="8%" class="cklt">电  话：</td>
          <td width="92%" colspan="3" class="cknr2">
            <input type="text" class="bzsr" name="tel[]" />
            <input type="button" value="+" class="tj_bnt" id="add_tel"/>
          </td>
        </tr>
        <tr id="dhxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">手 机：</td>
          <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr" name="mobile[]"  />
              <input type="button" value="+" class="tj_bnt" id="add_mobile"/>
          </td> 
        </tr>
        <tr id="sjxx"><td colspan="4" style="height:0px;"></td></tr>
        <tr><td colspan="4" style="height:0px;"></td></tr>
        <tr>
          <td width="8%" class="cklt">排 序：</td>
          <td width="92%" colspan="3" class="cknr2">
              <input type="text" class="bzsr" name="b_mark"  />
          </td> 
        </tr>
      </table>
    </div>
    <div class="caozuo5">
      <input type="button" class="b_bnt01" value="保 存" onclick="checksubmit()"/>
      <input type="button" class="b_bnt01" value="返 回"  onclick="window.location.href='/index.php/bank/index'" />
      <input type="reset" class="b_bnt01" value="取 消"/>
    </div>
  </form>
</div>

<script>
$(function(){
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	/* 添加部门 */
	$("#add").click(function(){
		var tr = '<tr>'
			   +   '<td>'
			   +     '<input type="text"  name="business_name[]" class="bzsr" />'
			   +   '</td>'
			   +   '<td>'
			   +     '<textarea name="business_explain[]" style="width:80%"></textarea>'
			   +   '</td>'
			   +   '<td>'
			   +  	'<input type="text" class="bzsr" name="mark[]"/>'
			   +   '</td>'
			   +   '<td><input type="button" value="删除" class="s_bnt01 red" onclick="del_dpt(this)" /></td>'
			   + '</tr>';
		$('.biaozhun2').append(tr);
	});

	/* 添加手机号 */
	$("#add_mobile").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='mobile[]'/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#sjxx").before(tr);
	});
    /*添加电话*/
	$("#add_tel").click(function(){
		var tr = "<tr class='msj'>"
			   +   "<td width='8%'></td>"
			   +   "<td width='92%' colspan='3' class='cknr2'>"
			   +     "<input type='text' class='bzsr' name='tel[]'/>"
			   +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
			   +   "</td>"
			   + "</tr>";
		$("#dhxx").before(tr);
	});

});
/* 删除 */
function min_mob(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

function checksubmit(){
	var name       = $('[name="name"]').val();
	var contact    = $('[name="contact"]').val();
	if(name==''){
		alert('请填写银行名称');
		return false;
	}
	var business_name = '';
	$('[name="business_name[]"]').each(function(){
		if($(this).val() != ''){
			business_name += $(this).val()+',';
		}
	});
	var business_explain = '';
	$('[name="business_explain[]"]').each(function(){
		if($(this).val() != ''){
			business_explain += $(this).val()+',';
		}
	});
	var mark = '';
	$('[name="mark[]"]').each(function(){
		if($(this).val() != ''){
			mark += $(this).val()+',';
		}
	});
	var mobile = '';
	$('[name="mobile[]"]').each(function(){
		if($(this).val() != ''){
			mobile += $(this).val()+',';
		}
	});
	if(business_name==''){
		alert('业务名称不能为空');
		return false;
	}
	if(business_explain==''){
		alert('业务说明不能为空');
		return false;
	}
	if(mark==''){
		alert('排序不能为空');
		return false;
	}
	if(contact==''){
		alert('联系人不能为空');
		return false;
	}
	if(mobile==''){
		alert('手机号不能为空');
		return false;
	}
	$.post(
		"/index.php/bank/save",
		$('#sub_form').serialize(),
		function (data) //回传函数
		{
			alert(data);
			if(data=='操作成功')
			{
				
				location.href="/index.php/bank/add";
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