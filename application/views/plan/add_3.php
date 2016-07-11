<script language="javascript" type="text/javascript" src="/js/calendar/WdatePicker.js"></script>
<script src="/js/tree.js" type="text/javascript" ></script>
<link href="/css/tree.css" rel="stylesheet" type="text/css" />
<style>
.biaozhun01{min-width:96%; border:none;}
.biaozhun01 .cklt{width:70px;}
.biaozhun03 , .biaozhun04{min-width:100%; border:none;}
textarea.bzsr13{width:200px;}
input.bzsr8{width:180px;}
input.qqzb{width:500px;}
.tj_bnt{height: 15px; line-height: 10px; width: 15px;margin: 10px 0 0;}
</style>
<div class="maincon">

  <div class="sst_bg">
    <p>当前位置：首页 > 活动方案 > 方案管理 > 新增单日方案</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
    <div id="create_div">

      <iframe id="info_frame" name="info_frame" style="display:none"></iframe>

	  <form id="create_form" name="create_form" method="post" action="/index.php/plan/save_1" >

      <div class="info_left" style="float:left; overflow:auto;">

        <input type="hidden" name="id" value="0"/>
        <input type="hidden" name="info_title_h">
		<table class="biaozhun01" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td class="cklt">标题：</td>
            <td class="cknr2">
            <input type="text" class="bzsr" id="c_title" name="c_title" value=""/>
            </td>
          </tr>
          <tr>
            <td class="cklt">编号：</td>
            <td class="cknr2">
              <input type="text" class="bzsr15" id="c_num_y" name="c_num_y" value="<?=date('Y')?>" style="width:40px; text-align:center" />
              <label class="sizi" style="width:10px; text-align:center;padding:0px;" >-</label>
              <input type="text" class="bzsr" id="c_num_n" name="c_num_n" value="<?=sprintf("%03d", $num);?>" style="width:40px;"/></td>
          </tr>
          <tr>
            <td class="cklt">导语：</td>
            <td class="cknr2">
              <textarea name="c_affairs" cols="" rows="" class="bzsr13" id="c_affairs"></textarea>
            </td>
          </tr>
          <tr>
            <td class="cklt">开始时间：</td>
            <td class="cknr2">
                <input type="text" class="Wdate" id="c_start" name="c_start" width="120" value="" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})"/>
            </td>
          </tr>
          <tr>
            <td class="cklt">地址：</td>
            <td class="cknr2">
              <table class="biaozhun04" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td>
                      <input type="text" class="bzsr8" name="c_address[]" value=""/>
                      <input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr(this)"/>
                      <input type="hidden" class="bzsr8" name="c_point_lng[]" id="point_lng" style="margin-left:2px;" value=""/>
                      <input type="hidden" class="bzsr8" name="c_point_lat[]" id="point_lat" style="margin-left:2px;" value=""/>
                      <input type="button" value="定" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="get_point()"/>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr id="cxld">
            <td class="cklt">出席领导：</td>
            <td>
              <label id="names_show_lingdao" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>
              <input type="hidden" name="names_show_shi"/>
              <input type="hidden" name="names_show_qu"/>
              <input type="hidden" name="department_show_qu"/>
              <input type="hidden" name="department_show_shi"/>
              <input type="hidden" name="c_names" id="c_names"/>
              <input type="hidden" name="names_show_qita"/>
              <input class="btn_cxld" value="请选择"  type="button" onclick="get_ld_all()">
            </td>
          </tr>
<!--          <tr id="cxld">-->
<!--            <td class="cklt">出席领导：</td>-->
<!--            <td>-->
<!--              <label id="names_show_shi" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>-->
<!--              <input type="hidden" name="names_show_shi">-->
<!--              <input class="btn_cxld" value="市领导"  type="button" onclick="get_ld_shi()">-->
<!--            </td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="cklt"></td>-->
<!--            <td>-->
<!--              <input type="hidden" name="c_names" id="c_names"/>-->
<!--              <label id="names_show" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>-->
<!--              <input class="btn_cxld" value="委领导"  type="button" onclick="get_ld()">-->
<!--            </td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="cklt"></td>-->
<!--            <td>-->
<!--              <label id="names_show_qita" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>-->
<!--              <input type="hidden" name="names_show_qita">-->
<!--              <input class="btn_cxld" value="其他领导"  type="button" onclick="get_ld_qita()">-->
<!--            </td>-->
<!--          </tr>-->
          <tr>
            <td class="cklt">参加范围：</td>
            <td>
              <label id="department_show_all" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>
<!--              <input type="hidden" name="department_show_shi">-->
              <input type="hidden" name="c_department" id="c_department" />
              <input type="hidden" name="department_show_qita" />
              <input class="btn_cjfw" value="请选择"  type="button" onclick="get_depart_all()">
            </td>
          </tr>
<!--          <tr>-->
<!--            <td class="cklt"></td>-->
<!--            <td>-->
<!--              <input type="hidden" name="c_department" id="c_department" />-->
<!--              <label id="department_show" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>-->
<!--              <input class="btn_cjfw" value="委部门"  type="button" onclick="get_fw()">-->
<!--            </td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="cklt"></td>-->
<!--            <td>-->
<!--              <label id="department_show_qita" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>-->
<!--              <input type="hidden" name="department_show_qita">-->
<!--              <input class="btn_cjfw" value="其他部门"  type="button" onclick="get_depart_qi()">-->
<!--            </td>-->
<!--          </tr>-->
          <tr>
            <td class="cklt">具体安排：</td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="2">
              <table class="biaozhun03" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                  <tr>
                    <td style=" text-align: left; "><input class="Wdate bzsr" name="c_time[]" value="" id="d4321" onfocus="WdatePicker({dateFmt:'HH:mm'})" style="width:15%; text-align:center; float: left; " type="text"><input class="bzsr11" name="c_plan[]" type="text" style="width:74%; float: left;"><input type="button" value="+" class="tj_bnt" style="margin-left:6px;" onclick="add_time(this)" /></td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td class="cklt">工作分工：</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">
              <table class="biaozhun03" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td><div class="key"></div></td>
                    <td><input class="bzsr10" name="c_done[]" type="text" style="width:90%; float: left;"><input type="button" value="+" class="tj_bnt" style="margin-left:6px;" onclick="add_done(this)" /></td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td class="cklt">联系人  ：</td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="2">
              <table class="biaozhun03" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                  <td><input class="Wdate bzsr" name="people_name[]" value="" id="d4321"
                  style="width:15%; text-align:center; float: left; " type="text">
                    <input class="bzsr11" name="people_phone[]" type="text" style="width:74%; float: left;">
                    <input type="button" value="+" class="tj_bnt" style="margin-left:6px;" onclick="add_pople(this)" />
                  </td>
                </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td class="cklt">添加附件：</td>
            <td>
              <input class="btn_cxld" value="请点击" type="button" onclick="get_area()">
              <textarea name="add_info" id="add_info" style="display: none"></textarea>
            </td>
          </tr>
          <tr>
            <td class="cklt">负责人：</td>
            <td>
              <label id="names_show_person" style="float:left;line-height:36px;margin: 0 5px; text-align:left;"></label>
              <input type="hidden" id="person_names_h" name="person_names_h">
              <input class="btn_cxld" value="请点击" type="button" onclick="get_person()">
            </td>
          </tr>
          <tr>
            <td class="cklt">落款：</td>
            <td class="cknr2">
                <input name="c_remark" id="c_remark" value="" class="bzsr"/>
            </td>
          </tr>
           <tr>
            <td class="cklt">发布时间：</td>
            <td class="cknr2">
            <input type="text" class="Wdate" id="c_re_time" name="c_re_time" width="120" value="<?=date('Y-m-d')?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            </td>
          </tr>
	      <tr>
            <td class="cklt">方案类型：</td>
            <td class="cknr2">
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
          <tr>
            <td class="cklt">方案性质：</td>
            <td class="cknr2">
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
<!--          <tr>-->
<!--            <td class="cklt">附件：</td>-->
<!--            <td class="cknr2">-->
<!--              <table class="biaozhun04" cellpadding="0" cellspacing="0">-->
<!--                <tbody>-->
<!--                  <tr>-->
<!--                    <td><input type="button" value="+" class="tj_bnt" style="margin-left:3px; position:relative; top:-5px;" onclick="add_file(this)" /></td>-->
<!--                  </tr>-->
<!--                </tbody>-->
<!--              </table>-->
<!--            </td>-->
<!--          </tr>-->

          <tr>
            <td class="cklt">备注：</td>
            <td class="cknr2"><textarea name="c_other" cols="" rows="" class="bzsr13"></textarea></td>
          </tr>
        </tbody>
        </table>
	  </div>

	  <div style="float:left; margin-left:3px;">
	  <div>
	    <!-- 加载编辑器的容器 -->
		<script id="info"></script>
		<!-- 配置文件 -->
		<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
		<!-- 编辑器源码文件 -->
		<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
	  </div>
<!--	  <div style="float: left; margin:5px 3px; height:140px; width:680px; overflow:auto;">-->
<!--	    <table class="biaozhun01" cellpadding="0" cellspacing="0" style="width:450px;" >-->
<!--        <tbody>-->
<!--          <tr>-->
<!--            <td class="cklt">前期准备：</td>-->
<!--            <td class="cknr2">-->
<!--              <table class="biaozhun04" cellpadding="0" cellspacing="0">-->
<!--                <tbody>-->
<!--                  <tr>-->
<!--                    <td>-->
<!--                      <input type="text" class="bzsr8 qqzb" name="c_ready[]"/>-->
<!--                      <input type="button" value="+" class="tj_bnt" onclick="add_ready(this)" />-->
<!--		 			</td>-->
<!--                  </tr>-->
<!--                </tbody>-->
<!--              </table>-->
<!--            </td>-->
<!--          </tr>-->
<!--        </tbody>-->
<!--        </table>-->
<!--	  </div>-->
	  </div>

	  </form>
    </div>
    <div class="caozuo5">
      <input type="button" class="b_bnt01" value="生 成" id="btn_create" />
    </div>
  </div>
</div>

<div id="wincover"></div>
<div class="newli" id="winregister">
  <h3 id="div_title">新增方案--选择</h3>
  <div class="nl_det">
    <div id="area_div" class="CNLTreeMenu1" style="width: 100%;display: none">
      <div style="float: left;height:400px;overflow-y:auto;overflow-x:hidden;">附件标题1<font color="#dc143c">(请手动修改附件内标题与附件标题一致)</font>
        <table class="biaozhun03" cellpadding="0" cellspacing="0" border="0">
          <tbody>
          <tr>
            <td><div class='key_title'>1</div></td>
            <td style=" text-align: left; ">
              <input class="bzsr11" name="info_title[]" type="text" style="width:74%; float: left;">
              <input type="button" value="+" class="tj_bnt" style="margin-left:6px;" onclick="add_info_title(this)" />
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <div style="float: right">
        <script id="editor2" type="text/plain" style="width:700px;height:300px;">
                    <p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"><br/></strong></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p><span style=";font-family:黑体;font-size:29px"></span></p><p><font face="黑体"><span style="font-size: 21px;">附件1</span></font></p><p><span style=";font-family:黑体;font-size:29px"></span><br/></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p style="text-align: center;"><span style="font-family: 文星标宋; font-size: 24px; font-weight: bold; letter-spacing: 0px;">附件标题1</span><br/></p><p style="text-align: center;"><br/></p><p style="white-space: normal;"><strong><span style="font-family: 仿宋_GB2312; font-size: 22px;"></span></strong></p><p style="margin-left: 21px; white-space: normal; text-indent: 11px; line-height: 41px;"><span style="font-family: 仿宋_GB2312; font-size: 21px;">内容1</span></p>
                </script>
      </div>
    </div>
    <!-- 负责人list   -->
    <div id="person" class="CNLTreeMenu1" style="display:none;overflow:hidden;">

      <div style="float:left;height:200px;overflow-y:auto;overflow-x:hidden;">
        <label class="sizi">发送范围：</label>
        <input type="button" style="margin:5px; padding:0 5px;" value="全选" onclick="checkall(true)" />
        <input type="button" style="margin:5px; padding:0 5px;" value="反选" onclick="recheck()" />
        <input type="button" style="margin:5px; padding:0 5px;" value="取消" onclick="checkall(false)" />
        <p class="szts"><span></span></p>
        <div id="CNLTreeMenu1" style="margin-left:0px;">
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
                    <input type="checkbox" class="tixing_checkbox" name="range_department" id="range_department_<?=$d->id?>" value="<?=$d->id?>" onclick="check_d(<?=$d->id?>)"/>
                    <span><?=$d->name?></span>
                    <ul class="Child" id="d_u_<?=$i?>">
                      <?
                      foreach($u_list[$d->id] as $u)
                      {
                        $j++;
                        ?>
                        <li>
                          <img class="s" src="/images/s.gif" alt="展开/折叠">
                          <input type="checkbox" class="tixing_checkbox_<?=$d->id?>" name="person_names" id="u_<?=$u->id?>" value="<?=$u->name?>" class="check_<?=$i?>"
                              
                              />
                          <input type="hidden" name="u_name" value="<?=$u->name?>">
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
    <div id="allmap" class="CNLTreeMenu1" style="width: 800px; height: 600px;display: none">
    </div>
    <div id="smap" style="display: none">
      <input type="text" name="seach_map">
      <input type="hidden" name="seach_map_r">
      <input type="button" id="seach_map" value="搜索" onclick="seach_map()">
    </div>
    <!-- 选择出席领导-->
    <div id="alllingdao" class="CNLTreeMenu1" style="display: none">
        <input type="button" value="市领导" onclick="get_ld_shi()">
      <input type="button" value="市部门" onclick="get_depart_shi()">
      <input type="button" value="区领导" onclick="get_ld_qu()">
      <input type="button" value="区部门" onclick="get_depart_qu()">
      <input type="button" value="委领导" onclick="get_ld()">
      <input type="button" value="其他领导" onclick="get_ld_qita()">
    </div>
    <!-- 选择市领导 -->
    <div id="shilingdao" class="CNLTreeMenu1" style="display: none">
      <td class="cknr2">
        <table>
          <tbody>
          <tr>
            <td>
              <input type="text" class="bzsr8" name="c_shi_lingdao[]"  value="" />
              <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_shi(this)" />
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </div>
    <!-- 区领导-->
    <div id="qulingdao" class="CNLTreeMenu1" style="display: none">
      <td class="cknr2">
        <table>
          <tbody>
          <tr>
            <td>
              <input type="text" class="bzsr8" name="qu_lingdao[]"  value="" />
              <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_qu(this)" />
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </div>
    <!-- 选择其他 -->
    <div id="qitalingdao" class="CNLTreeMenu1" style="display: none">
      <td class="cknr2">
        <table>
          <tbody>
          <tr>
            <td>
              <input type="text" class="bzsr8" name="c_qita_lingdao[]"  value="" />
              <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_qita(this)" />
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </div>
    <!-- 选择出席领导 -->
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
    <!--全部部门-->
    <div id="allbumen" style="display:none">
      <input type="button" value="委部门" onclick="get_fw()">
      <input type="button" value="其他部门" onclick="get_depart_qi()">
    </div>
    <!-- 市部门-->
    <div id="shibumen" class="CNLTreeMenu1" style="display:none">
        <table>
          <tbody>
          <tr>
            <td>
              <input type="text" class="bzsr8" name="c_shi_bumen[]"  value="" />
              <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_depart_shi(this)" />
            </td>
          </tr>
          </tbody>
        </table>
    </div>
    <!-- 选择参加范围 -->
      <div id='dept_div' class="CNLTreeMenu1" style="height:200px;display:none;overflow:auto;">
        <ul>
        <?
        if(is_array($d_list))
        {
        	$i = 0;
        	$j = 0;
          	foreach($d_list as $d)
          	{
          		$i++;
            ?>
          <li class="Closed">
            <img class="s" alt="展开/折叠" onclick="ExCls(this,'Opened','Closed',1);" src="/images/s.gif"/>
            <input type="checkbox" name="r_dept" id="d_<?=$i?>" value="<?=$d->name?>"/>
            <span  onClick="$('#d_<?=$i?>').click();"><?=$d->name?></span>
          </li>

            <?
          	}
        }
        ?>
        </ul>
      </div>
    <!--区部门 -->
    <div id="qubumen" style="display:none">
      <table>
        <tbody>
        <tr>
          <td>
            <input type="text" class="bzsr8" name="qu_bumen[]"  value="" />
            <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_depart_qu(this)" />
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- 其他部门-->
    <div id="qitabumen" class="CNLTreeMenu1" style="display:none">
        <table>
          <tbody>
          <tr>
            <td>
              <input type="text" class="bzsr8" name="c_qita_bumen[]"  value="" />
              <input type="button" value="+" class="tj_bnt tabn" onclick="add_addr_depart_qita(this)" />
            </td>
          </tr>
          </tbody>
        </table>
    </div>
    <!-- 选择上传附件 -->
      <div id="file_div" class="CNLTreeMenu1" style="height:50px; display: none">
		<iframe name='pic_frame' id="pic_frame" style='display:none'></iframe>
	    <form action="/index.php/plan/update_file" id="pic_form" encType="multipart/form-data"  method="post" target="pic_frame">
	    <label class="sizi">文  件：</label>
        <input type='text' class='bzsr' id='i_pic' style="width:150px;" value="" />
	    <input type='button' class='bnt01' value='浏览' style="margin:5px 5px 5px 0;" onclick="$('#i_file').click();" />
	    <input type="file" class="file" name="i_file" id="i_file" onchange="$('#i_pic').val(this.value)" size="2" style=" position:absolute; filter:alpha(opacity:0);opacity: 0; width:1px;" />
	    <input type="submit" name="submit" class="bnt01" value="上传" style="margin:5px 5px 5px 0;" />
	    <input type="button" class="bnt01" value="取消" style="margin:5px 5px 5px 0;" onclick="closeWinFile()" />
	    </form>
	    <p class="szts"><span></span></p>
       </div>
  </div>
  <div class="caozuo" id="btn_win_div">
    <input type="button" class="b_bnt01" value="确 定" id="btn_win_save" onclick="" />
    <input type="button" class="b_bnt01" value="关 闭" id="btn_win_close" onclick="closeWin()" />
  </div>
  <div class="caozuo" id="btn_win_div_point" style="display: none;">
    <input type="button" class="b_bnt01" value="关 闭" id="btn_win_close" onclick="closeWin()" />
  </div>
</div>
<script type="text/javascript">

  //实例化编辑器
  //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
  var ue = UE.getEditor('editor2');

  function isFocus(e){
    alert(UE.getEditor('editor2').isFocus());
    UE.dom.domUtils.preventDefault(e)
  }
  function setblur(e){
    UE.getEditor('editor2').blur();
    UE.dom.domUtils.preventDefault(e)
  }
  function insertHtml() {
    var value = prompt('插入html代码', '');
    UE.getEditor('editor2').execCommand('insertHtml', value)
  }
  function createEditor() {
    enableBtn();
    UE.getEditor('editor2');
  }
  function getAllHtml() {
    alert(UE.getEditor('editor2').getAllHtml())
  }
  function getContent() {
    var arr = [];
    arr.push("使用editor2.getContent()方法可以获得编辑器的内容");
    arr.push("内容为：");
    arr.push(UE.getEditor('editor2').getContent());
    alert(arr.join("\n"));
  }
  function getPlainTxt() {
    var arr = [];
    arr.push("使用editor2.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
    arr.push("内容为：");
    arr.push(UE.getEditor('editor2').getPlainTxt());
    alert(arr.join('\n'))
  }
  function setContent(isAppendTo) {
    UE.getEditor('editor2').setContent('欢迎使用ueditor', isAppendTo);
  }
  function setDisabled() {
    UE.getEditor('editor2').setDisabled('fullscreen');
    disableBtn("enable");
  }

  function setEnabled() {
    UE.getEditor('editor2').setEnabled();
    enableBtn();
  }

  function getText() {
    //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
    var range = UE.getEditor('editor2').selection.getRange();
    range.select();
    var txt = UE.getEditor('editor2').selection.getText();
    alert(txt)
  }

  function getContentTxt() {
    var arr = [];
    arr.push("使用editor2.getContentTxt()方法可以获得编辑器的纯文本内容");
    arr.push("编辑器的纯文本内容为：");
    arr.push(UE.getEditor('editor2').getContentTxt());
    alert(arr.join("\n"));
  }
  function hasContent() {
    var arr = [];
    arr.push("使用editor2.hasContents()方法判断编辑器里是否有内容");
    arr.push("判断结果为：");
    arr.push(UE.getEditor('editor2').hasContents());
    alert(arr.join("\n"));
  }
  function setFocus() {
    UE.getEditor('editor2').focus();
  }
  function deleteEditor() {
    disableBtn();
    UE.getEditor('editor2').destroy();
  }
  function disableBtn(str) {
    var div = document.getElementById('btns');
    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    for (var i = 0, btn; btn = btns[i++];) {
      if (btn.id == str) {
        UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
      } else {
        btn.setAttribute("disabled", "true");
      }
    }
  }
  function enableBtn() {
    var div = document.getElementById('btns');
    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    for (var i = 0, btn; btn = btns[i++];) {
      UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
    }
  }

  function getLocalData () {
    alert(UE.getEditor('editor2').execCommand( "getlocaldata" ));
  }

  function clearLocalData () {
    UE.getEditor('editor2').execCommand( "clearlocaldata" );
    alert("已清空草稿箱")
  }
</script>
<script type="text/javascript">
  function cha_mpp_r(obj){
    var mapobj = obj.previousSibling.previousSibling;
    var mapobj_r = obj.previousSibling;
    var lng=mapobj.value;
    var lat=mapobj_r.value;
    if(lng==""){
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
      if(window.confirm("当前选择的横坐标为"+ e.point.lng + ", 纵坐标为" + e.point.lat)){
        //alert("确定");
        dairu_r(e.point.lng,e.point.lat,obj);
        closeWin();
      }else{
        //alert("取消");
        return false;
      }

    });
    }else{
      var map = new BMap.Map("allmap");
      map.centerAndZoom(new BMap.Point(116.331398,39.897445),14);
      map.enableScrollWheelZoom(true);
      var x = lng;
      var y = lat;
      var new_point = new BMap.Point(x,y);
      var marker = new BMap.Marker(new_point);  // 创建标注
      map.addOverlay(marker);              // 将标注添加到地图中
      map.panTo(new_point);
      function showInfo(e){
        if (window.confirm("当前选择的横坐标为" + e.point.lng + ", 纵坐标为" + e.point.lat)) {
          //alert("确定")
          dairu_r(e.point.lng, e.point.lat,obj);
          closeWin();
        } else {
          //alert("取消");
          return false;
        }
      }
      //单击获取点击的经纬度
      map.addEventListener("click", showInfo);
    }
  }

  // 百度地图API功能
  function cha_mpp(){
    var lng=$('#point_lng').val();
    var lat=$('#point_lat').val();
    if(lng=="") {
      var map = new BMap.Map("allmap");    // 创建Map实例
      var point = new BMap.Point(116.331398, 39.897445);
      map.centerAndZoom(point, 14);
      map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
      map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
      function myFun(result) {
        var cityName = result.name;
        map.setCenter(cityName);
      }

      var myCity = new BMap.LocalCity();
      myCity.get(myFun);
      //单击获取点击的经纬度
      map.addEventListener("click", function (e) {
        //alert("当前选择的横坐标为"+ e.point.lng + ", 纵坐标为" + e.point.lat);
        if (window.confirm("当前选择的横坐标为" + e.point.lng + ", 纵坐标为" + e.point.lat)) {
          //alert("确定")
          dairu(e.point.lng, e.point.lat);
          closeWin();
        } else {
          //alert("取消");
          return false;
        }

      });
    }else{
      // 百度地图API功能
      var map = new BMap.Map("allmap");
      map.centerAndZoom(new BMap.Point(116.331398,39.897445),14);
      map.enableScrollWheelZoom(true);
      var x = lng;
      var y = lat;
      var new_point = new BMap.Point(x,y);
      var marker = new BMap.Marker(new_point);  // 创建标注
      map.addOverlay(marker);              // 将标注添加到地图中
      map.panTo(new_point);
      function showInfo(e){
        if (window.confirm("当前选择的横坐标为" + e.point.lng + ", 纵坐标为" + e.point.lat)) {
          //alert("确定")
          dairu(e.point.lng, e.point.lat);
          closeWin();
        } else {
          //alert("取消");
          return false;
        }
      }
    //单击获取点击的经纬度
      map.addEventListener("click", showInfo);
      }

  }
  //地图搜索
  function seach_map(){

    var seach_map=$("input[name='seach_map']").val();
    var key_map=$("input[name='seach_map_r']").val();
    alert(key_map);
    var map = new BMap.Map("allmap");    // 创建Map实例
    var point = new BMap.Point(116.331398,39.897445);
    var local = new BMap.LocalSearch(map, {
      renderOptions:{map: map}
    });
    local.search(seach_map);
    map.centerAndZoom(point,14);
    map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    //单击获取点击的经纬度
    function myFun(result){
      var cityName = result.name;
      map.setCenter(cityName);
    }
    var myCity = new BMap.LocalCity();
    myCity.get(myFun);
    map.addEventListener("click",function(e){
      if(window.confirm("当前选择的横坐标为"+ e.point.lng + ", 纵坐标为" + e.point.lat)){
        //alert("确定");
        dairu(e.point.lng,e.point.lat,key_map);
        closeWin();
      }else{
        //alert("取消");
        return false;
      }
    });

  }

</script>
<script>
$(function(){
    $("input[name='c_point_lat[]']").each(function(){
      if($(this).val()!=""){
        $(this).next().css('background-color','#DCAC6C');
      }
    });
	/********* 高度自适应 *********/
	var h = 190;
	$('.con_detail').height($(window).height()-h);
	$('.info_left').height($('.con_detail').height()-20);
	$('.info_left').width($('.con_detail').width()-720);
    var editor = new UE.ui.Editor({
        toolbars:[[
        	'undo', 'redo', '|',
        	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', '|',
        	'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'indent', '|',
        	'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
        	'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        	'selectall', 'cleardoc']],
    	initialHeight:$('.con_detail').height()-100,
    	initialFrameHeight:$('.con_detail').height()-100,
    	initialWidth:680,
    	initialFrameWidth:680,
        //initialFrameHeight: 675,
    	scaleEnabled:true
    });
    editor.render("info");
	$(window).resize(function(){
		$('.con_detail').height($(window).height()-h);
		$('.info_left').height($('.con_detail').height()-20);
		$('.info_left').width($('.con_detail').width()-720);
		editor.setHeight($('.con_detail').height()-60);
	});
	/********* 高度自适应 *********/

	$('#btn_create').click(function(){
		var num_y	= $('#c_num_y').val();
		var num_n	= $('#c_num_n').val();
		var title	= $('#c_title').val();
		var start	= $('#c_start').val();
                var re_time	= $('#c_re_time').val();
		var c_names =  $('[name="c_names"]').val();
		var c_department = $('[name="c_department"]').val();
		var flag = false;
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
		$('[name="c_address[]"]').each(function(){
			if($(this).val()){
			  flag = true;
			}
		});
		if(!flag){
			alert('请填写地址');
			return false;
		}
//		if(c_names == ''){
//			alert('请选择出席领导');
//			return false;
//		}
//		if(c_department == ''){
//			alert('请选择参加范围');
//			return false;
//		}
		$("#create_form").submit();
	});

});
function dairu_r(lng,lat,obj){
  var mapobj = obj.previousSibling.previousSibling;
  var mapobj_r = obj.previousSibling;
  mapobj.value=lng;
  mapobj_r.value=lat;
}
function dairu(lng,lat){
  $('#point_lng').val(lng);
  $('#point_lat').val(lat);
}
/* 增加地图定位*/

function get_point_add(obj){
  $("#div_title").html("修改方案--地图定位");
  $("#div_title").css("width",'900px');
  $('#winregister').css('width','900px');
  $('.caozuo').hide();
  $('#btn_win_div_point').show();
  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#allmap').show();

  $('#btn_win_save').attr('onclick','do_names()');
  $('#names_div').hide();
  $('#wincover').show();
  $('#winregister').center();
  $('#smap').show();
  cha_mpp_r(obj);
}
function get_point(){
  $("#div_title").html("修改方案--地图定位");
  $("#div_title").css("width",'900px');
  $('#winregister').css('width','900px');
  $('.caozuo').hide();
  $('#btn_win_div_point').show();
  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#allmap').show();
  $('#smap').show();
  $('#btn_win_save').attr('onclick','do_names()');
  $('#names_div').hide();
  $('#wincover').show();
  $('#winregister').center();

  cha_mpp();
}
function closeWin()
{
  $('#winregister').hide();
  $('#wincover').hide();
  $('#area_div').hide();
  $('#person').hide();
  $('#allmap').hide();
  $('#shibumen').hide();
  $('#qitabumen').hide();
  $('#qubumen').hide();
  $('#shilingdao').hide();
  $('#qitalingdao').hide();
  $('#qulingdao').hide();
  $('#smap').hide();
  $('.caozuo').hide();
  $('#alllingdao').hide();
  $('#allbumen').hide();
  $('#btn_win_div_point').show();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $("input[name='c_point_lat[]']").each(function(){
    if($(this).val()!=""){
      $(this).next().css('background-color','#DCAC6C');
    }
  });
}
function closeWinFile()
{
	$("input[name='c_file[]']").each(function(){
		if(this.value=='')
			del_file(this);
	});
	closeWin();
}

function change(i,checked) {
	$("input[type='checkbox']").each(function(){
		if(this.className=='check_'+i)
		this.checked=checked;
	});
}

/* 获取tr在table中所在行号 */
function getTrIndex(trObj,tbObj)
{
	trIndex = 0;
	var trArr = tbObj.children;
	for(var trNo= 0; trNo < trArr.length; trNo++)
	{
		if(trObj == tbObj.children[trNo])
		{
			break;
		}
		trIndex++;
	}
	return trIndex;
}

/****** 添加/删除地址 ******/
function add_addr(obj)
{
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" name="c_address[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>'
      + '<input type="hidden" class="bzsr8" name="c_point_lng[]" style="margin-left:2px;" value=""/>'
      + '<input type="hidden" class="bzsr8" name="c_point_lat[]" style="margin-left:2px;" value=""/>'
      + '<input type="button" value="定" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="get_point_add(this)"/>';
}
function add_addr_shi(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="c_shi_lingdao" name="c_shi_lingdao[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_shi(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function add_addr_qu(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="qu_lingdao" name="qu_lingdao[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_qu(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function add_addr_qita(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="c_qita_lingdao" name="c_qita_lingdao[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_qita(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function add_addr_depart_shi(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="c_shi_bumen" name="c_shi_bumen[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_depart_shi(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function add_addr_depart_qu(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="qu_bumen" name="qu_bumen[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_depart_qu(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function add_addr_depart_qita(obj){
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;

  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML = '<input type="text" class="bzsr8" id="c_qita_bumen" name="c_qita_bumen[]" value=""/>'
      + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_addr_depart_qita(this)"/>'
      + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="min_addr(this)"/>';

}
function min_addr(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

/****** 添加/删除具体安排 ******/
function add_time(obj)
{
	var trObj = obj.parentNode.parentNode;
	var tbObj = trObj.parentNode;
	var trIndex = getTrIndex(trObj,tbObj)+1;

	var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
	var newTd1 = newTr.insertCell();
	newTd1.innerHTML = '<input class="Wdate bzsr" name="c_time[]" value="" id="d4321" onfocus="WdatePicker({dateFmt:\'HH:mm \'})" style="width:15%; float: left; text-align:center;" type="text"><input class="bzsr11" name="c_plan[]" type="text" style="width:74%; float: left; "><input type="button" value="+" class="tj_bnt tabn" style="" onclick="add_time(this)" />'
					 + '<input type="button" value="-" class="tj_bnt tabn" style=" margin-left:2px;" onclick="del_time(this)" />';
}
function del_time(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/****** 添加联系人 ******/
function add_pople(obj){
    var trObj = obj.parentNode.parentNode;
    var tbObj = trObj.parentNode;
    var trIndex = getTrIndex(trObj,tbObj)+1;

    var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
    var newTd1 = newTr.insertCell();
    newTd1.innerHTML = '<input class="Wdate bzsr" name="people_name[]" value="" id="d4321"  style="width:15%; float: left; text-align:center;" type="text"><input class="bzsr11" name="people_phone[]" type="text" style="width:74%; float: left; "><input type="button" value="+" class="tj_bnt tabn" style="" onclick="add_pople(this)" />'
      + '<input type="button" value="-" class="tj_bnt tabn" style=" margin-left:2px;" onclick="del_time(this)" />';

}
/****** 添加方案标题 ******/
function add_info_title(obj){
  var key_i=0;
  var trObj = obj.parentNode.parentNode;
  var tbObj = trObj.parentNode;
  var trIndex = getTrIndex(trObj,tbObj)+1;
  var str_r="";
  var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
  var newTd0 = newTr.insertCell();
  newTd0.innerHTML = "<div class='key_title'></div>";
  var newTd1 = newTr.insertCell();
  newTd1.innerHTML =
      '<input class="bzsr11" name="info_title[]" type="text" style="width:74%; float: left; ">' +
      '<input type="button" value="+" class="tj_bnt tabn" style="" onclick="add_info_title(this)" />'
      + '<input type="button" value="-" class="tj_bnt tabn" style=" margin-left:2px;" onclick="del_info_title(this)" />';
  var t=$(obj).prev().val();
  $('.key_title').each(function(){
    key_i++;
    $(this).html(key_i);
  });
  var key_i_title=key_i;
  str_r+='<p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"><br/></strong></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p><span style=";font-family:黑体;font-size:29px"></span></p><p><font face="黑体"><span style="font-size: 21px;">附件' +
      key_i_title+'</span></font></p><p><span style=";font-family:黑体;font-size:29px"></span><br/></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p style="text-align: center;">'
      +'<span style="font-family: 文星标宋; font-size: 24px; font-weight: bold; letter-spacing: 0px;">附件标题' +key_i_title+
      '</span><br/></p><p style="text-align: center;"><br/></p><p style="white-space: normal;">' +
      '<strong><span style="font-family: 仿宋_GB2312; font-size: 22px;"></span></strong></p>' +
      '<p style="margin-left: 21px; white-space: normal; text-indent: 11px; line-height: 41px;">' +
      '<span style="font-family: 仿宋_GB2312; font-size: 21px;">内容'+key_i_title+'</span></p>' ;
  UE.getEditor('editor2').setContent(str_r, true);

}
function del_info_title(obj)
{
  var tr=obj.parentNode.parentNode;
  var tbody=tr.parentNode;
  tbody.removeChild(tr);
  var key_i=0;
  $('.key_title').each(function(){
    key_i++;
    $(this).html(key_i);
  });
}

/****** 添加删除工作分工 ******/
function add_done(obj)
{
	var trObj = obj.parentNode.parentNode;
	var tbObj = trObj.parentNode;
	var trIndex = getTrIndex(trObj,tbObj)+1;

	var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
    var newTd0 = newTr.insertCell();
    newTd0.innerHTML = "<div class='key'></div>";
	var newTd1 = newTr.insertCell();
	newTd1.innerHTML = '<input class="bzsr10" name="c_done[]" type="text" style="width:90%; float: left;"><input type="button" value="+" class="tj_bnt tabn" style="" onclick="add_done(this)" />'
					 + '<input type="button" value="-" class="tj_bnt tabn" style=" margin-left:2px;" onclick="del_done(this)" />';
    var key_i=0;
    $('.key').each(function(){
      key_i++;
      $(this).html(key_i);
    });

}
function del_done(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
    var key_i=0;
    $('.key').each(function(){
      key_i++;
      $(this).html(key_i);
    });
}

/****** 删除准备事项 ******/
function add_ready(obj)
{
	var trObj = obj.parentNode.parentNode;
	var tbObj = trObj.parentNode;
	var trIndex = getTrIndex(trObj,tbObj)+1;

	var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
	var newTd1 = newTr.insertCell();
	newTd1.innerHTML = '<input type="text" class="bzsr8 qqzb" name="c_ready[]"/>'
		   			 + '<input type="button" value="+" class="tj_bnt tabn" style="margin-top:10px;" onclick="add_ready(this)"/>'
		   			 + '<input type="button" value="-" class="tj_bnt tabn" style="margin-top:10px; margin-left:2px;" onclick="del_ready(this)"/>';
}
function del_ready(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}

/* 添加/删除附件 */
var file_num = 0;
function add_file(obj)
{
	file_num++;

	var trObj = obj.parentNode.parentNode;
	var tbObj = trObj.parentNode;
	var trIndex = getTrIndex(trObj,tbObj);

	var newTr = tbObj.insertRow(trIndex);//添加新行，trIndex就是要添加的位置
	var newTd1 = newTr.insertCell();
	newTd1.innerHTML = '<label style="float:left; line-height:30px" id="filename_'+file_num+'"></label>'
		   			 + '<input type="hidden" name="c_file[]" id="file_'+file_num+'"/>'
		   			 + '<input type="hidden" name="c_fileurl[]" id="fileurl_'+file_num+'"/>'
		 			 + '<input type="button" value="-" class="tj_bnt tabn" style="margin-left:5px;" onclick="del_file(this)"/>';
	get_file(file_num);
}

function del_file(obj)
{
	var tr=obj.parentNode.parentNode;
	var tbody=tr.parentNode;
	tbody.removeChild(tr);
}
/* 选择出席领导 */
function get_ld()
{
  $("#div_title").html("修改方案--委领导");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#alllingdao').show();
  $('#names_div').show();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#btn_win_save').attr('onclick','do_names()');
  $('#btn_win_div').show();


  $('#wincover').show();
  $('#winregister').center();
}
/* 选择出席领导*/
function get_ld_all(){
  $("#div_title").html("修改方案--出席领导");
  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#qitalingdao').hide();
  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_lingdao_show()');
  $('#btn_win_div').show();

  $('#alllingdao').show();

  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}
function do_lingdao_show(){
  closeWin();
}
/* 选择市领导*/
function get_ld_shi(){
  $("#div_title").html("修改方案--市领导");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#qitalingdao').hide();
  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_names_shi()');
  $('#btn_win_div').show();

  $('#shilingdao').show();
  $('#alllingdao').hide();

  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}

function do_names_shi(){
  var str="";
  var str_r="";
  $("input[name='c_shi_lingdao[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='names_show_shi']").val(str);
  if($("input[name='names_show_shi']").val()!=""){
    str_r+=$("input[name='names_show_shi']").val();
  }
  if($("input[name='department_show_shi']").val()!=""){
    str_r+=","+$("input[name='department_show_shi']").val();
  }
  if($("input[name='names_show_qu']").val()!=""){
    str_r+=","+$("input[name='names_show_qu']").val();
  }
  if($("input[name='department_show_qu']").val()!=""){
    str_r+=","+$("input[name='department_show_qu']").val();
  }
  if($("input[name='c_names']").val()!=""){
    str_r+=","+$("input[name='c_names']").val();
  }
  if($("input[name='names_show_qita']").val()!=""){
    str_r+=","+$("input[name='names_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
    str_r=str_r.substr(1);
  }
  $('#names_show_lingdao').html(str_r);

  $('#shilingdao').hide();
  closeWin();

}
/* 选择区领导*/
function get_ld_qu(){
  $("#div_title").html("修改方案--区领导");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#qitalingdao').hide();
  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_names_qu()');
  $('#btn_win_div').show();

  $('#qulingdao').show();
  $('#alllingdao').hide();

  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}

function do_names_qu(){
  var str="";
  var str_r="";
  $("input[name='qu_lingdao[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='names_show_qu']").val(str);
  if($("input[name='names_show_shi']").val()!=""){
    str_r+=$("input[name='names_show_shi']").val();
  }
  if($("input[name='department_show_shi']").val()!=""){
    str_r+=","+$("input[name='department_show_shi']").val();
  }
  if($("input[name='names_show_qu']").val()!=""){
    str_r+=","+$("input[name='names_show_qu']").val();
  }
  if($("input[name='department_show_qu']").val()!=""){
    str_r+=","+$("input[name='department_show_qu']").val();
  }
  if($("input[name='c_names']").val()!=""){
    str_r+=","+$("input[name='c_names']").val();
  }
  if($("input[name='names_show_qita']").val()!=""){
    str_r+=","+$("input[name='names_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
  str_r=str_r.substr(1);
  }
  $('#names_show_lingdao').html(str_r);


  $('#qulingdao').hide();
  closeWin();

}
/* 选择其他领导*/
function get_ld_qita(){
  $("#div_title").html("修改方案--其他领导");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();
  $('#alllingdao').hide();
  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_names_qi()');
  $('#btn_win_div').show();

  $('#shilingdao').hide();
  $('#qitalingdao').show();

  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}

function do_names_qi(){
  var str="";
  var str_r="";
  $("input[name='c_qita_lingdao[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='names_show_qita']").val(str);
  if($("input[name='names_show_shi']").val()!=""){
    str_r+=$("input[name='names_show_shi']").val();
  }
  if($("input[name='department_show_shi']").val()!=""){
    str_r+=","+$("input[name='department_show_shi']").val();
  }
  if($("input[name='names_show_qu']").val()!=""){
    str_r+=","+$("input[name='names_show_qu']").val();
  }
  if($("input[name='department_show_qu']").val()!=""){
    str_r+=","+$("input[name='department_show_qu']").val();
  }
  if($("input[name='c_names']").val()!=""){
    str_r+=","+$("input[name='c_names']").val();
  }
  if($("input[name='names_show_qita']").val()!=""){
    str_r+=","+$("input[name='names_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
    str_r=str_r.substr(1);
  }
  $('#names_show_lingdao').html(str_r);
  $('#qitalingdao').hide();
  closeWin();

}
/* 全部部门选择*/
function get_depart_all(){
  $("#div_title").html("修改方案--选择部门");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_depart_shi()');
  $('#btn_win_div').show();

  $('#shilingdao').hide();
  $('#qitalingdao').hide();
  $('#alllingdao').hide();
  $('#allbumen').show();
  $('#qitabumen').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}

/* 市部门选择*/
function get_depart_shi(){
  $("#div_title").html("修改方案--市部门");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_depart_shi()');
  $('#btn_win_div').show();

  $('#shilingdao').hide();
  $('#qitalingdao').hide();
  $('#alllingdao').hide();
  $('#shibumen').show();
  $('#qitabumen').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}
function do_depart_shi(){
  var str="";
  var str_r="";
  $("input[name='c_shi_bumen[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='department_show_shi']").val(str);
  if($("input[name='names_show_shi']").val()!=""){
    str_r+=$("input[name='names_show_shi']").val();
  }
  if($("input[name='department_show_shi']").val()!=""){
    str_r+=","+$("input[name='department_show_shi']").val();
  }
  if($("input[name='names_show_qu']").val()!=""){
    str_r+=","+$("input[name='names_show_qu']").val();
  }
  if($("input[name='department_show_qu']").val()!=""){
    str_r+=","+$("input[name='department_show_qu']").val();
  }
  if($("input[name='c_names']").val()!=""){
    str_r+=","+$("input[name='c_names']").val();
  }
  if($("input[name='names_show_qita']").val()!=""){
    str_r+=","+$("input[name='names_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
    str_r=str_r.substr(1);
  }
  $('#names_show_lingdao').html(str_r);
  $('#shibumen').hide();
  closeWin();
}
/* 选择区部门 */
function get_depart_qu(){
  $("#div_title").html("修改方案--区部门");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_depart_qu()');
  $('#btn_win_div').show();

  $('#shilingdao').hide();
  $('#qitalingdao').hide();
  $('#alllingdao').hide();
  $('#shiqita').hide();
  $('#qubumen').show();
  $('#qitabumen').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}
function do_depart_qu(){
  var str="";
  var str_r="";
  $("input[name='qu_bumen[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='department_show_qu']").val(str);
  if($("input[name='names_show_shi']").val()!=""){
    str_r+=$("input[name='names_show_shi']").val();
  }
  if($("input[name='department_show_shi']").val()!=""){
    str_r+=","+$("input[name='department_show_shi']").val();
  }
  if($("input[name='names_show_qu']").val()!=""){
    str_r+=","+$("input[name='names_show_qu']").val();
  }
  if($("input[name='department_show_qu']").val()!=""){
    str_r+=","+$("input[name='department_show_qu']").val();
  }
  if($("input[name='c_names']").val()!=""){
    str_r+=","+$("input[name='c_names']").val();
  }
  if($("input[name='names_show_qita']").val()!=""){
    str_r+=","+$("input[name='names_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
    str_r=str_r.substr(1);
  }
  $('#names_show_lingdao').html(str_r);
  $('#qubumen').hide();
  closeWin();
}
/* 其他部门选择*/
function get_depart_qi(){
  $("#div_title").html("修改方案--其他部门");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();

  $('#btn_win_save').attr('onclick','do_depart_qi()');
  $('#btn_win_div').show();

  $('#shilingdao').hide();
  $('#qitalingdao').hide();
  $('#shibumen').hide();
  $('#allbumen').hide();
  $('#qitabumen').show();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
  $('#wincover').show();
  $('#winregister').center();
}
function do_depart_qi(){
  var str="";
  var str_r="";
  $("input[name='c_qita_bumen[]']").each(function(){
    str+=$(this).val()+",";
  });
  //str=str.substring(str.Length,str.Length);
  var reg=/,$/gi;
  str=str.replace(reg,"");
  $("input[name='department_show_qita']").val(str);


  if($("input[name='c_department']").val()!=""){
    str_r+=","+$("input[name='c_department']").val();
  }
  if($("input[name='department_show_qita']").val()!=""){
    str_r+=","+$("input[name='department_show_qita']").val();
  }
  if(str_r.substr(0,1)==','){
    str_r=str_r.substr(1);
  }
  $('#department_show_all').html(str_r);
  $('#qitabumen').hide();
  closeWin();
}
//添加活动方案负责人
function get_person(){
  $("#div_title").html("修改方案--负责人");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('#area_div').hide();
  $('#person').show();
  $('#btn_win_div').show();
  $('#btn_win_save').attr('onclick','do_person()');
  $('#wincover').show();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();
  $('#winregister').center();
}
function do_person()
{
  var names = '';
  var str_r="";
  $('input[name="person_names"]').each(function(){
    if(this.checked)
    {
      if(names!='')names += ',';
      names += $(this).val();
    }
  });
  $("#person_names_h").val(names);
  $("#names_show_person").html(names);
  $('#wincover').hide();
  $('#winregister').hide();

}
/* 添加附件中默认的生成内容*/
function get_area_mo(){
  var str_r="";
  var key_i_title=1;
  str_r+='<p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"><br/></strong></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p><span style=";font-family:黑体;font-size:29px"></span></p><p><font face="黑体"><span style="font-size: 21px;">附件' +
      key_i_title+'</span></font></p><p><span style=";font-family:黑体;font-size:29px"></span><br/></p><p style="white-space: normal;"><strong style="font-family: 仿宋_GB2312; font-size: 22px;"></strong></p><p style="text-align: center;">'
      +'<span style="font-family: 文星标宋; font-size: 24px; font-weight: bold; letter-spacing: 0px;">附件标题' +key_i_title+
      '</span><br/></p><p style="text-align: center;"><br/></p><p style="white-space: normal;">' +
      '<strong><span style="font-family: 仿宋_GB2312; font-size: 22px;"></span></strong></p>' +
      '<p style="margin-left: 21px; white-space: normal; text-indent: 11px; line-height: 41px;">' +
      '<span style="font-family: 仿宋_GB2312; font-size: 21px;">内容'+key_i_title+'</span></p>' ;
  UE.getEditor('editor2').setContent(str_r, true);
}
/* 添加生成内容*/
function get_area(){
  $("#div_title").css("width",'1150px');
  $("#div_title").html("修改方案--添加附件");

  $('#dept_div').hide();
  $('#file_div').hide();
  $('#tixing_div').hide();

  $('#names_div').hide();
  $('#area_div').show();
  $('#btn_win_div').show();
  $('#btn_win_save').attr('onclick','callchild()');
  $('#wincover').show();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();
  $("#winregister").css("width",'1150px');
  UE.getEditor('editor2').setHeight(300);
  $('#winregister').center();
}
//调用子级页的方法
function callchild(){
  var str="";
  var add_info=UE.getEditor('editor2').getContent();
  $('#add_info').html(add_info);
  $("input[name='info_title[]']").each(function(){
    str+=$(this).val()+"|";
  });
  var reg=/,$/gi;
  str=str.substring(0,str.length-1);
  $("input[name='info_title_h']").val(str);
  closeWin();

}
function do_names()
{
	var names = '';
  var str_r="";
	$('input[name="r_names"]').each(function(){
		if(this.checked)
		{
			if(names!='')names += ',';
			names += $(this).val();
		}
	});
	$("#c_names").val(names);

    if($("input[name='names_show_shi']").val()!=""){
      str_r+=$("input[name='names_show_shi']").val();
    }
    if($("input[name='department_show_shi']").val()!=""){
      str_r+=","+$("input[name='department_show_shi']").val();
    }
    if($("input[name='names_show_qu']").val()!=""){
      str_r+=","+$("input[name='names_show_qu']").val();
    }
    if($("input[name='department_show_qu']").val()!=""){
      str_r+=","+$("input[name='department_show_qu']").val();
    }
    if($("input[name='c_names']").val()!=""){
      str_r+=","+$("input[name='c_names']").val();
    }
    if($("input[name='names_show_qita']").val()!=""){
      str_r+=","+$("input[name='names_show_qita']").val();
    }
    if(str_r.substr(0,1)==','){
      str_r=str_r.substr(1);
    }
    $("#names_show_lingdao").html(str_r);
	$('#wincover').hide();
	$('#winregister').hide();

}

/* 选择参加范围 */
function get_fw()
{
	$("#div_title").html("新增方案--参加范围");

	$('#names_div').hide();
	$('#file_div').hide();
  $('.caozuo').show();
  $('#btn_win_div_point').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
	$('#dept_div').show();
    $('#allbumen').hide();
	$('#btn_win_div').show();
	$('#btn_win_save').attr('onclick','do_dept()');

	$('#wincover').show();
	$('#winregister').center();
}
function do_dept()
{
	var dept = '';
    var str_r='';
	$('input[name="r_dept"]').each(function(){
		if(this.checked)
		{
			if(dept!='')dept += ',';
			dept += $(this).val();
		}
	});
	$("#c_department").val(dept);

    if($("input[name='c_department']").val()!=""){
      str_r+=","+$("input[name='c_department']").val();
    }
    if($("input[name='department_show_qita']").val()!=""){
      str_r+=","+$("input[name='department_show_qita']").val();
    }
    if(str_r.substr(0,1)==','){
      str_r=str_r.substr(1);
    }
	$("#department_show_all").html(str_r);

	$('#wincover').hide();
	$('#winregister').hide();

}
/* 上传附件 */
function get_file(num)
{
	$("#div_title").html("新增方案--上传附件");
  $('.caozuo').show();
  $('#btn_win_div_point').hide();
  $("#div_title").css("width",'400px');
  $("#winregister").css("width",'400px');
	$('#dept_div').hide();
	$('#names_div').hide();

	$('#file_div').show();

    $('#i_pic').attr('num',num);
	$('#i_pic').val('');
    $('#i_pic').attr("filename","");

	$('#btn_win_div').hide();

	$('#wincover').show();
	$('#winregister').center();
}
function do_file(){
	var url=$('#i_pic').val();
	var name=$('#i_pic').attr('filename');

	$("#filename_"+file_num).text(name);
	$("#file_"+file_num).val(name);
	$("#fileurl_"+file_num).val(url);
	$('#wincover').hide();
	$('#winregister').hide();
}
//上传图片后，返回显示
function pic_back(re)
{
	if(re=='false')
	{
		alert('文件上传失败');
	}
	else
	{
        var retu=re.split(",");
		$("#i_pic").val(retu[1]);
		$("#i_pic").attr("filename",retu[0]);
		do_file();
	}
}
</script>