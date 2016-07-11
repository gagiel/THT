</div>
</body>
<script language="javascript" type="text/javascript">
    function tanchu(){
        window.onload=function(){showBox();setTimeout("closeBox()",30000)}
    }

    function showBox(o){
        if (o==undefined) o=document.getElementById("rbbox");
        o.style.height=o.clientHeight+2+"px";
        if (o.clientHeight<200) setTimeout(function(){showBox(o)},5);
    }
    function closeBox()
    {
        document.getElementById("rbbox").style.display="none";
    }
</script>
</html>