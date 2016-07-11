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
    .part{
        width:80px;
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
        text-overflow: ellipsis;/* IE/Safari */
        -ms-text-overflow: ellipsis;
        -o-text-overflow: ellipsis;/* Opera */
        -moz-binding: url("ellipsis.xml#ellipsis");/*FireFox*/
    }
</style>
<div class="maincon">
    <div class="sst_bg">
        <p>当前位置：首页 > 活动方案 > 短信群发</p>
        <div class="sst_sm">
            <?=$select?>
        </div>
    </div>
    <div class="con_detail">
        <div id="wait_r" style="position: absolute; left: 40%;top: 40%;display: none;z-index: 9999;font-size: 30px;">
            <img src="/images/loading.gif"/>
            等待发送中...
        </div>
        <div id="wait_r_su" style="position: absolute; left: 40%;top: 40%;display: none;z-index: 9999;font-size: 30px;">
            发送成功!!!
        </div>
        <div id="create_div">
            <form id="create_form" name="create_form" method="post" action="/index.php/plan/save_1" >
                <div class="wai" style="margin: 10px">
                <div class="nei" style="float: left;width: 35%">
                    <div>短信内容</div>
                    <textarea id="mass_area" style="font-size: 20px;width: 100%;height: 700px"><?php if(!empty($list_one)){echo $list_one['msg'];}?></textarea>
                </div>
                <div style="float:left;width: 50%">
                    <table class="biaozhun01" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>内部人员:</td>
                            <td>
                                <input class="btn_cxld" value="请选择" type="button" onclick="get_tixing()">
                            </td>
                        </tr>
                        <tr>
                            <td>名片人员:</td>
                            <td>
                                <input class="btn_cxld" value="请选择" type="button" onclick="get_tixing_r()">
                            </td>
                        </tr>
                        <tr>
                            <td>其他号码:</td>
                            <td>
                                <input class="btn_cxld" value="请选择" type="button" onclick="get_tixing_q()">
                            </td>
                        </tr>
<!--                        <tr id="sjxx"><td colspan="2"></td></tr>-->

                    </table>
                    <div style="float: left;height: 500px;overflow-y: auto;margin-left: 50px;">
                        <table class="biaozhun02" style="width: 700px;">
                            <tr>
                                <td>类型</td>
                                <td>部门</td>
                                <td>操作</td>
                            </tr>
                            <?php if(empty($is_id)){?>
                            <tbody id="mass_p">
                            <tr>
                                <td></td>
                                <td>工作人员暂无选择的联系人</td>
                                <td></td>
                            </tr>
                            </tbody>
                            <tbody id="mass_m">
                            <tr>
                                <td></td>
                                <td>名片人员暂无选择的联系人</td>
                                <td></td>
                            </tr>
                            </tbody>
                            <?php }else{?>
                            <tbody id="mass_p">
                            </tbody>
                                <?php if(!empty($nb_list)) {
                                    foreach ($nb_list as $key => $val) {
                                        ?>
                                    <tbody class="mass_p_p">
                                        <tr id='nb_<?php echo $val['id'] ?>'>
                                            <input type='hidden' name='phone' value='<?php echo $val['phone'] ?>'>
                                            <input type='hidden' name='nb_id' value='<?php echo $val['id'] ?>'>
                                            <td><?php echo $val['ry_type'] ?></td>
                                            <td><span class='part'><?php echo $val['d_name'] ?></span>/<span
                                                    class='part'><?php echo $val['name'] ?></span></td>
                                            <td><a href='javascript:void(0)' onclick='del_nb(<?php echo $val['id'] ?>)'>删除</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php }
                                }?>
                            <tbody id="mass_m">
                            </tbody>
                                <?php if(!empty($mp_list)) {
                                    foreach ($mp_list as $key2 => $val2) {
                                        ?>
                                    <tbody class="mass_m_m">
                                        <tr id='mp_<?php echo $val2['u_id']?>'>
                                        <input type='hidden' name='phone' value='<?php echo $val2['mobile']?>'>
                                        <input type='hidden' name='mp_id' value='<?php echo $val2['u_id']?>'>
                                        <td>名片人员</td>
                                        <td>
                                            <?php echo $val2['c_name']?>/<?php echo $val2['position']?>/<?php echo $val2['u_name']?></div>
                                        </td>
                                        <td><a href='javascript:void(0)' onclick='del_mp(<?php echo $val2['u_id']?>)'>删除</a></td>
                                        </tr>
                                    </tbody>
                                    <?php }
                                    }?>

                                <?php }?>
                            <tbody>
                            <?php if(!empty($list_one['otherphone'])){?>
                                <?php foreach($list_one['otherphone'] as $key4=>$val4){?>
                                    <tr id="qt_<?php echo $key4?>">
                                        <input type='hidden' name='phone' value='<?php echo $val4?>'>
                                        <input type='hidden' name='qt_phone' value='<?php echo $val4?>'>
                                        <td>其他号码</td>
                                        <td>
                                            <?php echo $val4?>
                                        </td>
                                        <td><a href='javascript:void(0)' onclick='del_qt(<?php echo $key4?>)'>删除</a></td>
                                    </tr>
                                <?php }?>
                            <?php }?>
                            </tbody>
                            <tbody id="qita_phone">

                            </tbody>
                        </table>
                    </div>


                </div>
                </div>
            </form>
        </div>
        <div class="caozuo5">
            <input type="button" class="b_bnt01" value="发 送" id="btn_create" onclick="do_fa()"/>
            <input type="button" class="b_bnt01" value="重 置 " onclick="window.location.reload()" />
        </div>
    </div>
</div>
<div id="wincover"></div>
<div class="newli" id="winregister">

    <h3 id="div_title">修改人员--选择</h3>
    <div class="nl_det">
        <!-- 内容区域开始 -->
        <!-- 选择出席领导 -->
        <div id='names_div' class="CNLTreeMenu1" style="height:200px;">
            <ul>
                <?
                if(is_array($d_list))
                {
                    $i = 0;
                    $j = 0;
                    //$join_users = explode(',',$info->join_user);
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
        <!-- 选择参加范围 -->
        <div id='dept_div' class="CNLTreeMenu1" style="height:200px;display:none;">
            <ul>
                <?
                if(is_array($d_list))
                {
                    $i = 0;
                    $j = 0;
                    //$join_dept = explode(',',$info->join_dept);
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
        <!-- 选择上传附件 -->

        <!-- 部门人员发送短信 -->
        <div id="tixing_div" class="CNLTreeMenu1" style="display:none;overflow:hidden;">
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
                                                    <input type="checkbox" class="tixing_checkbox_<?=$d->id?>" name="range_user" id="u_<?=$u->id?>" value="<?=$u->id?>" class="check_<?=$i?>"
                                                        <?php
                                                        if(!empty($nb_list))
                                                        {foreach($nb_list as $key3=>$val3){?>
                                                            <?php if($u->id==$val3['id']){echo "checked";}?>
                                                        <?php }
                                                        }?>
                                                        />
                                                    <input type="hidden" name="range_user_name" value="<?=$u->name?>">
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



        <!-- 内容区域结束 -->
    </div>

    <!-- 名片人员发送短信 -->
    <div id="tixing_div_r" class="CNLTreeMenu1">
        <iframe name="myFrame" src="/index.php/contact/index_mass/" style="width: 100%;height: 600px">
            您的浏览器不支持框架，请升级您的浏览器。
        </iframe>
    </div>
    <div id="tixing_div_q" class="CNLTreeMenu1">
        <table class="biaozhun01" cellpadding="0" cellspacing="0">
            <tr>
                <td>其他号码:</td>
                <td>
                    <input type="text" class="bzsr" name="tel" id='tel' style="width: 150px"/>
                    <input type="button" value="+" class="tj_bnt" id="add_mob"/>
                </td>
            </tr>
            <tr id="sjxx"></tr>
        </table>
    </div>
    <div class="caozuo" id="btn_win_div">
        <input type="button" class="b_bnt01" value="确 定" id="btn_win_save"/>
        <input type="button" class="b_bnt01" value="关 闭" id="btn_win_close" onclick="closeWin()" />
    </div>
</div>

<script>
    /* 添加手机号 */

    $("#add_mob").click(function(){
        var tr = "<tr class='msj'>"
            +   "<td></td>"
            +   "<td class='cknr2'>"
            +     "<input type='text' class='bzsr' name='tel' id='' value='' style='width: 150px'/>"
            +     "<input type='button' value='-' class='tj_bnt tabn' style=' margin-top: 5px; ' id='' onclick='min_mob(this)'/>"
            +   "</td>"
            + "</tr>";
        $("#sjxx").before(tr);

    });
    /* 删除电话 */
    function min_mob(obj)
    {
        var tr=obj.parentNode.parentNode;
        var tbody=tr.parentNode;
        tbody.removeChild(tr);
    }
    //调用子级页的方法
    function callchild(){
        myFrame.window.get_mp();
    }
    //ajax传回session
    function ajax_confim(){
        var data={
            status:true,
        }
        $.post("/index.php/plan/ajax_session", {data:data},function(response){
            $('#mass_m').html(response);
        });
        $('#wincover').hide();
        $('#winregister').hide();
        $('#tixing_div_q').hide();
        $('#winregister').css('width','500px');

    }
    //发送短信
    function do_fa(){
        var str = ""
        var nb_id = ""
        var mp_id = ""
        var qt_phone=""

        $("input[name='phone']").each(function(){
            str+=$(this).val()+",";
        });
        $("input[name='nb_id']").each(function(){
            nb_id+=$(this).val()+",";
        });
        $("input[name='mp_id']").each(function(){
            mp_id+=$(this).val()+",";
        });
        $("input[name='qt_phone']").each(function(){
            qt_phone+=$(this).val()+",";
        });
        var mass_area=$("#mass_area").val();

        var data_str={
            nb_id:nb_id,
            mp_id:mp_id,
            str:str,
            qt_phone:qt_phone,
            mass_area:mass_area
        }

        if(confirm("是否发送")){
        $('#btn_create').prop('disabled',true);
        $('#wait_r').show();
        $('#wincover').show();
        $.post("/index.php/plan/pushmessage_r", data_str,function(response){
            $('#btn_create').prop('disabled',false);
            $('#wait_r').hide();
            $('#wincover').hide();
            $('#wait_r_su').show();
            $('#wait_r_su').html(response);

            setTimeout(function(){$("#wait_r_su").fadeOut();},2000);

        });
        }
    }


    function closeWin()
    {
        $('#winregister').hide();
        $('#tixing_div_q').hide();
        $('#winregister').css('width','500px');
        $('#wincover').hide();
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
    //选择内部人员
    function get_nb()
    {
        $("#div_title").html("短信群发--内部人员");

        $('#dept_div').hide();
        $('#file_div').hide();
        $('#tixing_div').hide();

        $('#names_div').show();

        $('#btn_win_div').show();
        $('#btn_win_save').attr('onclick','do_names_r()');

        $('#wincover').show();
        $('#winregister').center();
    }
    //确定内部人员
    function do_names_r()
    {
        var names = '';
        $('input[name="range_user"]').each(function(){
            if(this.checked)
            {
                if(names!='')names += ',';
                names += $(this).val();
            }
        });
        var data ={
            u_id:names,
        };
        $.post("/index.php/plan/ajax_user",data,function(response){
            $("#mass_p").html(response);
            $(".mass_p_p").hide();
        })
//        $("#mass_p").html(names);
//
        $('#wincover').hide();
        $('#winregister').hide();
        $('#tixing_div_q').hide();
    }
    //确定其他号码
    function qita()
    {
        var tel="";
        $("input[name='tel']").each(function(){
            tel+=$(this).val()+",";

        });
        var data ={
            tel:tel,
        };
        $.post("/index.php/plan/ajax_qita",data,function(response){
//            $('#qita_rr').remove();
            $('#qita_phone').before(response);
        })

        $('#wincover').hide();
        $('#winregister').hide();
        $('#tixing_div_r').hide();
    }
    //删除内部人员
    function del_nb(id){
        $("#u_"+id).prop('checked',false);
        $('#nb_'+id).remove();
    }
    //删除其他号码
    function del_qt(id){
        $('#qt_'+id).remove();
    }
    //删除其他号码ajax
    function del_qt_rr(id){
        $('#qt_rr_'+id).remove();
    }
    //删除名片人员
    function del_mp(id){
        myFrame.window.del_mp(id);
        var data={
            id:id,
        }
        $.post("/index.php/plan/ajax_mp_quxiao",data,function(response){
            $('#mp_'+id).remove();
        })
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
    /* 选择参加范围 */
    function get_fw()
    {
        $("#div_title").html("修改方案--参加范围");

        $('#names_div').hide();
        $('#file_div').hide();
        $('#tixing_div').hide();

        $('#dept_div').show();

        $('#btn_win_div').show();
        $('#btn_win_save').attr('onclick','do_dept()');

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
    /* 选择内部人员通讯录 */
    function get_tixing()
    {
        $("#div_title").html("内部人员");

        $('#dept_div').hide();
        $('#file_div').hide();
        $('#names_div').hide();
        $('#tixing_div_r').hide();
        $('#tixing_div_q').hide();
        $('#tixing_div').show();
        $('#sendmessage').attr('checked',false);
        $('#msgContent').hide();

        $('#btn_win_div').show();
        $('#btn_win_save').attr('onclick','do_names_r()');

        $('#wincover').show();
        $('#winregister').center();
    }
    /* 选择名片人员通讯录 */
    function get_tixing_r()
    {
        $("#div_title").html("名片人员");
        $("#winregister").css('width','920px');
        //$("#winregister").css('height','600px');
        $("#winregister").css('z-index','99999');
        $('#dept_div').hide();
        $('#file_div').hide();
        $('#names_div').hide();
        $('#tixing_div').hide();
        $('#tixing_div_r').show();
        $('#tixing_div_q').hide();
        $('#sendmessage').attr('checked',false);
        $('#msgContent').hide();

        $('#btn_win_div').show();
        $('#btn_win_save').attr('onclick','ajax_confim()');

        $('#wincover').show();
        $('#winregister').center();
    }
    /* 添加其他号码 */
    function get_tixing_q()
    {
        $("#div_title").html("其他号码");
        $("#winregister").css('width','500px');
        $(".msj").remove();
        $("#tel").val('');
        $('#dept_div').hide();
        $('#file_div').hide();
        $('#names_div').hide();
        $('#tixing_div').hide();
        $('#tixing_div_r').hide();
        $('#tixing_div_q').show();
        $('#sendmessage').attr('checked',false);
        $('#msgContent').hide();

        $('#btn_win_div').show();
        $('#btn_win_save').attr('onclick','qita()');

        $('#wincover').show();
        $('#winregister').center();
    }
    function do_tixing(){
        var user = '';
        $('input[name="range_user"]').each(function(){
            if(this.checked)
            {
                if(user!='')user += ',';
                user += $(this).val();
            }
        });
        if($('#sendmessage').is(':checked')){
            var text = $('#plan').val();
            $.post(
                "/index.php/plan/pushmessage",
                {
                    text	: $('#plan').val(),
                    user	: user,

                },
                function (data) //回传函数
                {
                    alert(data);
                    $('#winregister').hide();$('#wincover').hide();

                }
            );
        }else{
            $.post(
                "/index.php/plan/saveTxUsers",
                {
                    user	: user
                },
                function (data) //回传函数
                {
                    alert(data);
                    $('#winregister').hide();$('#wincover').hide();
                }
            );
        }
    }

    //全选、取消全部
    function checkall(check)
    {
        $("input[name='range_department']").each(function(){
            this.checked=check;
        });
        $("input[name='range_user']").each(function(){
            this.checked=check;
        });
    }
    //反选
    function recheck()
    {
        $("input[name='range_department']").each(function(){
            this.checked=!this.checked;
        });
        $("input[name='range_user']").each(function(){
            this.checked=!this.checked;
        });
    }
    //部门全部选中
    function check_d(id){
        if($("#range_department_"+id).is(':checked')){
            $(".tixing_checkbox_"+id).prop("checked",true);
        }else{
            $(".tixing_checkbox_"+id).prop("checked",false);
        }

    }


</script>