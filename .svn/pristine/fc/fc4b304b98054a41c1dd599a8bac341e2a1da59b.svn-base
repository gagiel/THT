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

<iframe id="info_frame" name="info_frame" style="display:none"></iframe>
<iframe id="hidden_frame" name="hidden_frame" style="display:none"></iframe>
<div>
<form id="create_form_if" name="create_form" method="post" action="/index.php/plan/area_session" target="hidden_frame" >



            <!-- 加载编辑器的容器 -->
            <script id="info"><?php if(!empty($info->info_add)){echo $info->info_add;}?></script>
            <!-- 配置文件 -->
            <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>

</form>
</div>
<script>
    function get_in_area(area) {
        $(function () {
            /********* 高度自适应 *********/
            var h = 190;
            $('.con_detail').height($(window).height() - h);
            $('.info_left').height($('.con_detail').height() - 20);
            $('.info_left').width($('.con_detail').width() - 720);
            var editor2 = new UE.ui.Editor({
                toolbars: [[
                    'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', '|',
                    'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'indent', '|',
                    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'simpleupload', 'insertimage',
                    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                    'selectall', 'cleardoc']],

                initialHeight: $('.con_detail').height() - 100,
                initialFrameHeight: $('.con_detail').height() - 100,
                initialWidth: 700,
                initialFrameWidth: 699,
                initialFrameHeight: 250,
                scaleEnabled: true
            });
            editor2.render("info");
            $(window).resize(function () {
                $('.con_detail').height($(window).height() - h);
                $('.info_left').height($('.con_detail').height() - 20);
                $('.info_left').width($('.con_detail').width() - 720);
                editor2.setHeight($('.con_detail').height() - 60);
            });
            //获取info的值
            //var info_add=editor2.getContent();
            //var info_add=$('#info').html();
            //alert(info_add);
            /********* 高度自适应 *********/
            editor2.addListener("ready", function () {
                // editor准备好之后才可以使用
                editor2.setContent(area);

            });


        });
    }

    //提交富文本编辑器内容
    function get_area(){
        $('#create_form_if').submit();
    }
//    function get_in_area(area){
//
//    }



</script>