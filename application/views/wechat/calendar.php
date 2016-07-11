<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<link rel="stylesheet" type="text/css" href="/css/calendar.css">
<script src="/js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="/js/calendar-wx.min.js"></script>
<script src="/js/gcal.js"></script>
<style type="text/css">
#calendar{width:300px; margin:20px auto 10px auto}
</style>
<script type="text/javascript">
$(function() {
	$('#calendar').fullCalendar({
		header: {
			center: 'title mreport',//title
			left: 'prev',			//prev,next today
			right: 'next today'		//month,agendaWeek,agendaDay
		},
		firstDay:1,//每周从星期一开始
		editable: true,
		buttonText: {
			prev: "&lsaquo;",
			next: "&rsaquo;",
		},
		allDaySlot:false,
		//weekends: false, //不显示周末，将会隐藏周六和周日 
		dayClick:function(date){//日期点击时调用函数
	        click(date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate());
	    }
	});
});
function showMonthlyReport()
{
	location.href="/index.php/wechat/newsletter/";
}
function click(date)
{
	location.href="/index.php/wechat/newsletter/"+date;
}
</script>

<div id='calendar'></div>
<form id="sub_form" action="/index.php/newsletter/view" method="post">
	<input type="hidden" id="ntype" name="type" value="0" />
	<input type="hidden" id="start" name="start" value="" />
	<input type="hidden" id="end" name="end" value="" />
	<input type="hidden" id="info" name="info" value="" />
</form>
<form id="month_form" action="/index.php/news/monthly_view" method="post">
	<input type="hidden" id="month" name="month" value="" />
</form>