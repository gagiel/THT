<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        table{
            width:30em;
            table-layout:fixed;/* 只有定义了表格的布局算法为fixed，下面td的定义才能起作用。 */
        }
        td{
            width:100%;
            word-break:keep-all;/* 不换行 */
            white-space:nowrap;/* 不换行 */
            overflow:hidden;/* 内容超出宽度时隐藏超出部分的内容 */
            text-overflow:ellipsis;/* 当对象内文本溢出时显示省略标记(...) ；需与overflow:hidden;一起使用。*/
        }
    </style>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
    <script src="/js/xw.js"></script>
    <body>
    <div>
        <table cellpadding="0" cellspacing="0" class="biaozhun" style="width:100%;min-width:200px">
            <tr class="tab_tit">
                <td>您有新的工作方案提醒</td>
                <td></td>
            </tr>
            <?php
            if(!empty($list)){
                foreach($list as $key=>$val){?>
                    <tr id="yue_<?php echo $val->id?>">
                        <td style="text-align: left;width: 80%"><?php echo $val->info?></td>
                        <td style="text-align: right;width: 20%"><input type="button" value="已阅" onclick="workyue(<?php echo $val->id?>)"></td>
                    </tr>
                <?php }
            }?>
        </table>
    <div>
    </body>
<script>
    function workyue(id){
//        var data ={
//            info:moban_nei,
//            id:id,
//        };
//        $.post("/index.php/plan/save_2",data,function(response){
//
//            if(response==1){
//                alert('保存成功');
//            }else{
//                alert('保存失败');
//            }
//        })
        $('#yue_'+id).remove();
    }
</script>
</html>
