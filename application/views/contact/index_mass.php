<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-stand">
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script src="/js/xw.js"></script>
    <script type="text/javascript">
        $(function(){
            var h = 155;
            $('.con_detail').height($(window).height()-h);
            $(window).resize(function(){
                $('.con_detail').height($(window).height()-h);
            });
        });
    </script>
</head>
<body>
<div>
    <div>
        <form action="" method="post" id="index_option">
            <div class="ser_b" style=" position: relative;">

                <input type="hidden" id="order_field" name="order_field" value="<?=$where['order_field']?>" />
                <input type="hidden" id="order_type" name="order_type" value="<?=$where['order_type']?>" />

                <label class="sizi">关键字：</label>
                <input type="text" class="bzsr" name="value" value="<?=$where['value']?>" style="width:100px;" />
                <?php if($sel_owner){?>
                    <label class="sizi">名片主人：</label>
                    <select name="owner" class="bzsr2" style="width:auto;" >
                        <option value="0">全 部</option>
                        <?
                        foreach($ownerlist as $v){
                            ?>
                            <option value="<?=$v->id ?>" <?=$where['owner']==$v->id?' selected':''?>><?=$v->name?></option>
                        <? }?>
                    </select>
                <?php }?>
                <input type="submit" class="b_bnt01" value="查 询" />

                <p style=" float: left; color: #217bb1; line-height: 37px; margin-left: 10px; ">
                    共搜索到<span style=" margin: 0 5px; "><?=$num?></span>条名片系统信息
                </p>

                <select name="type" class="bzsr2" id="typename_option" style="position: absolute; right: 10px; width: 263px; ">
                    <option value="0">全 部</option>
                    <?
                    foreach($typename as $v){
                        $arr = explode('.',$v['detail']);
                        $len = count($arr);
                        $sp='';
                        for($i=0;$i<$len-1;$i++){
                            $sp .= "&nbsp;&nbsp;";
                        }
                        ?>
                        <option value="<?=$v['id'] ?>" <?=$where['type']==$v['id']?' selected':''?>><?=$sp.$v['name']?></option>
                    <? }?>
                </select>

            </div>
        </form>
        <table cellpadding="0" cellspacing="0" class="biaozhun">
            <tr class="tab_tit">
                <td width="6%">
                    <input onclick="selectAll()" type="checkbox" name="controlAll" style="controlAll" id="controlAll" />
                </td>
                <td width="10%">姓 名
                    <div class="pxan_bnt">
                        <a class="pxan_up" onclick="order('u_name','asc');">正序</a>
                        <a class="pxan_down" onclick="order('u_name','desc');">倒序</a>
                    </div>
                </td>
                <td width="32%">单位名称
                    <div class="pxan_bnt">
                        <a class="pxan_up" onclick="order('c_name','asc');">正序</a>
                        <a class="pxan_down" onclick="order('c_name','desc');">倒序</a>
                    </div>
                </td>
                <td width="32%">职 务
                    <div class="pxan_bnt">
                        <a class="pxan_up" onclick="order('position','asc');">正序</a>
                        <a class="pxan_down" onclick="order('position','desc');">倒序</a>
                    </div>
                </td>
                <td width="20%">分 组
                    <div class="pxan_bnt">
                        <a class="pxan_up" onclick="order('t_name','asc');">正序</a>
                        <a class="pxan_down" onclick="order('t_name','desc');">倒序</a>
                    </div>
                </td>
            </tr>
            <?php
            foreach ($list as $v)
            {
                ?>
                <tr>
                    <td colspan="5" style="height:1px; background-color:#333" />
                </tr>
                <tr>
                    <td width="6%">
                        <input type="checkbox" name="selected" value="1" id="<?=$v->u_id?>" onclick="get_mp(<?=$v->u_id?>)"
                            <?php if(!empty($_SESSION['mp_id_array'])){
                                foreach($_SESSION['mp_id_array'] as $key2=>$val2){
                                    if($v->u_id==$val2){
                                        echo "checked";
                                    }
                                }
                            }?>/>
                    </td>
                    <td width="10%" class="zhongdian" style="cursor: pointer;"><?=$v->u_name?></td>
                    <td width="35%" class="tip" style="position: relative;">
                        <?
                        $str = explode(',',$v->c_name);
                        echo $str['0'].(isset($str[1])?'...':'');
                        ?>
                        <div class="dygfd_tit"><?=$v->c_name?></div>
                    </td>
                    <td width="35%" class="tip" style="position: relative;">
                        <?
                        $str =  explode(',',$v->position);
                        echo $str['0'].(isset($str[1])?'...':'');
                        ?>
                        <div class="dygfd_tit"><?=$v->position?></div>
                    </td>
                    <td width="20%" class="tip" style="position: relative;">
                        <?
                        $str =  explode(',',$v->t_name);
                        echo $str['0'].(isset($str[1])?'...':'');
                        ?>
                        <div class="dygfd_tit"><?=$v->t_name?></div>
                    </td>
                </tr>
            <? }?>
        </table>
        <div class="sabrosus"><?=$pages?></div>
    </div>
</div>
</body>
<script>
    //被父级页面调用的子级页面的js方法
    function get_mp(id){
        if($("#"+id).is(':checked')){
            var ids = '0';
            $("input[name='selected']:checked").each(function(){
                ids += ','+$(this).attr("id");
            });

            $.post("/index.php/plan/ajax_mp", {ids:ids},function(response){

            });


        }else{
            $.post("/index.php/plan/ajax_mp_quxiao", {id:id},function(response){

            });
        }

    }
    //父级删除名片调用这个子级方法
    function del_mp(id){
        $('#'+id).prop('checked',false);
    }
    $("#typename_option").change(function(){
        $("#index_option").submit();
    })
    //每一行分别显示隐藏框
    $(".tip").mouseenter(function(){
        var $thistd = $(this);
        if($thistd.find('.dygfd_tit').text().indexOf(',')>0){
            $thistd.find('.dygfd_tit').show();
        }
    }).mouseleave(function(){
        var $thistd = $(this);
        $thistd.find('.dygfd_tit').hide();
    });

    function order(field,type)
    {
        $('#order_field').val(field);
        $('#order_type').val(type);
        $('#index_option').submit();
    }

    function delInfo()
    {
        var ids = '0';
        $("input[name='selected']:checked").each(function(){
            ids += ','+$(this).attr("id");
        });
        if(ids!=0)
        {
            if(confirm("确认删除这些单位吗？"))
            {
                $.post(
                    "/index.php/contact/delete",
                    {
                        ids:ids
                    },
                    function (data) //回传函数
                    {
                        if(data=='success')
                        {
                            $("#index_option").submit();
                        }
                        else
                        {
                            alert(data);
                        }
                    }
                );
            }
        }
    }
    /* 实现全选 */
    function selectAll(){
        var checklist = document.getElementsByName ("selected");
        if(document.getElementById("controlAll").checked)
        {
            for(var i=0;i<checklist.length;i++)
            {
                checklist[i].checked = 1;
            }
            var ids = '0';
            $("input[name='selected']:checked").each(function(){
                ids += ','+$(this).attr("id");
            });
            $.post("/index.php/plan/ajax_mp", {ids:ids},function(response){

            });
        }else{
            for(var j=0;j<checklist.length;j++)
            {
                checklist[j].checked = 0;
            }
            var ids = '0';
            $("input[name='selected']").not("input:checked").each(function(){
                ids += ','+$(this).attr("id");
            });
            $.post("/index.php/plan/ajax_mp_quxiao_r", {ids:ids},function(response){

            });
        }
    }
</script>
