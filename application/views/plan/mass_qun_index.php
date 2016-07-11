<style>
    .part{
        width:400px;
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
        <p>当前位置：首页&gt;活动方案&gt;短信群发</p>
        <div class="sst_sm"><?=$select?></div>
    </div>
    <div class="con_detail">
        <div class="ser_b">
            <input type="button" value="新 建" class="b_bnt01" onclick="window.location.href='/index.php/plan/mass_qun'">
            <input type="button" class="b_bnt01" value="删 除" onclick="delInfo()">
        </div>
        <table cellpadding="0" cellspacing="0" class="biaozhun">
            <tr class="tab_tit">
                <td width="20"><input type="checkbox" id="all" onclick="checkall()"></td>
                <td width="20%">发送时间</td>
                <td width="10%">发送人</td>
                <td width="20%">发送内容</td>
                <td width="20%">其他推送号码</td>
                <td width="10%"></td>

            </tr>
            <?php
            if(!empty($info)){
                foreach($info as $key=>$val){?>
            <tr>
                <td><input name="ids[]" value="<?php echo $val['id']?>" type="checkbox"></td>
                <td><?php echo $val['time']?></td>
                <td><?php echo $val['name']?></td>
                <td title="<?php echo $val['msg']?>" align="center" valign="middle"><div class="part" style="text-align: center"><?php echo $val['msg']?></div></td>
                <td title="<?php echo $val['otherphone']?>" align="center" valign="middle"><div class="part" style="text-align: center"><?php echo $val['otherphone']?></div></td>
                <td><input name="" type="button" value="重发" class="s_bnt01" onclick="window.location.href='/index.php/plan/mass_qun_chong/<?php echo $val['id']?>'"></td>
            </tr>
            <?php }
            }else{?>
                <tr>
                    <td colspan="4">暂无符合条件的记录</td>
                </tr>
            <?php }?>


        </table>
<!--        <div class="sabrosus">--><?//=$pages?><!--</div>-->
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".com_name").change(function(){
            var name = $(this).val();
            if(name != ''){
                $.post(
                    "/index.php/account/get_companyname",
                    {
                        name:name
                    },
                    function (data) //回传函数
                    {
                        var obj = eval('('+data+')');
                        var str = '';
                        $(".gjzlx").show();
                        for(x in obj){
                            str += "<p class=''><span onclick='aaa(this)'>"+obj[x]['name']+"</span><input name='' type='hidden' value='"+obj[x]['id']+"' /></p>";
                            $(".gjzlx").html(str);
                        }
                    }
                );
            }
        });
    });
    function aaa(obj){
        var text1 = obj.innerHTML;
        $(".com_name").val(text1)
        $(".companyid").val($(obj).next().val())
        $(".gjzlx").hide();
    }
    //全选,取消
    function checkall()
    {
        if($('#all').is(':checked')){
            $("input[type=checkbox]").each(function(){
                this.checked=true;
            });
        }else{
            $("input[type=checkbox]").each(function(){
                this.checked=false;
            });
        }

    }
    //删除
    function delInfo()
    {
        var id = '';
        $('[name="ids[]"]').each(function(){
            if(this.checked)
            {
                if(id!='')id += ',';
                id += $(this).val();
            }
        });
        //alert(id);
        if(id==''){
            alert('请选择短信进行删除');
            return false;
        }else{
            $.post(
                "/index.php/plan/delete_mass",
                {
                    id:id
                },
                function (data) //回传函数
                {
                    if(data=='success')
                    {
                        alert('删除成功');
                        window.location.reload();
                    }
                    else
                    {
                        alert(data);
                    }
                }
            );
        }
    }
</script>