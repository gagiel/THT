<link rel="stylesheet" type="text/css" href="/css/calendar.css">
<script src="/js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="/js/calendar.min.js"></script>
<script src="/js/gcal.js"></script>
<style type="text/css">
#calendar{width:800px; margin:20px auto 10px auto}
</style>
<script type="text/javascript">
var view = false;
$(function() {
	$('#calendar').fullCalendar({
		header: {
			center: '',			//title
			left: 'title',		//prev,next today
			right: 'mreport prev,next today'	//month,agendaWeek,agendaDay
		},
		firstDay:1,//每周从星期一开始
		editable: true,
		buttonText: {
			prev: "&lsaquo;上个月",
			next: "下个月&rsaquo;"
		},
		allDaySlot:false,
		//weekends: false, //不显示周末，将会隐藏周六和周日 
		dayClick:function(date){//日期点击时调用函数
	        click(date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate(),0);
	    },
	    events: function(start,end) {
	    	fstart = start.getFullYear()+"-"+(start.getMonth()+1)+"-"+start.getDate();
	    	fend = end.getFullYear()+"-"+(end.getMonth()+1)+"-"+end.getDate();
	    	if(view)
	    	{
	    		getdata();
				$.cookies.set('calendar_year',$("#fcs_date_year").val());
				$.cookies.set('calendar_month',$("#fcs_date_month").val());
	    	}
	    }
	});
	
	if($.cookies.get('calendar_year')>0)
	{
		$("#calendar").fullCalendar('gotoDate', $.cookies.get('calendar_year'), $.cookies.get('calendar_month'));
	}
	getdata();
	view = true;
	/** 绑定事件到日期下拉框 **/
	$(function(){
		$("#fc-dateSelect").delegate("select","change",function(){
			var fcsYear = $("#fcs_date_year").val();
			var fcsMonth = $("#fcs_date_month").val();
			$("#calendar").fullCalendar('gotoDate', fcsYear, fcsMonth);
		});
	});
});
function showMonthlyReport()
{
	$("#month").val($("#fcs_date_year").val()+"-"+(parseInt($("#fcs_date_month").val())+1))
	$("#month_form").submit();
}
function click(date,type)
{
	$.cookies.set('calendar_year',$("#fcs_date_year").val());
	$.cookies.set('calendar_month',$("#fcs_date_month").val());
	$("#start").val(date);
	$("#end").val(date);
	$("#ntype").val(type);
	$("#sub_form").submit();
}
function getdata()
{
	$.post(
		"/index.php/select/calendar_data",
		{
			start: fstart,
			end: fend
		},
		function (data) //回传函数
		{
			$("#calendar").fullCalendar('removeEvents'); //清空上次加载的日程
			
			var json;
			if (typeof(JSON) == 'undefined'){  
			    json = eval("("+data+")");  
			}else{  
			    json = JSON.parse(data);
			}
			for(var i in json)
			{
				var obj = new Object();
				obj.title = json[i];
				obj.start = new Date(i);
				obj.url = "javascript:click('"+i+"');";
				$("#calendar").fullCalendar('renderEvent',obj,true);//把从后台取出的数据进行封装以后在页面上以fullCalendar的方式进行显示
				
				<? /*
				var obj = new Object();
				obj.title = json[i].title;
				obj.start = new Date(json[i].tdate);
				//obj.url = "javascript:click('"+json[i].tdate+"',"+json[i].ntype+");";
				obj.url = "javascript:click('"+json[i].tdate+"');";
				$("#calendar").fullCalendar('renderEvent',obj,true);//把从后台取出的数据进行封装以后在页面上以fullCalendar的方式进行显示
				alert(json[i].tdate);
				a++;
				*/ ?>
			} 
		}
	);
}
</script>
<div class="maincon">
  <div class="sst_bg">
    <p>当前位置：首页>NewsLetter</p>
	<div class="sst_sm">
	  <?=$select?>
	</div>
  </div>
  <div class="con_detail">
  	<div id='calendar'></div>
	<form id="sub_form" action="/index.php/news/view" method="post">
		<input type="hidden" id="ntype" name="type" value="0" />
		<input type="hidden" id="start" name="start" value="" />
		<input type="hidden" id="end" name="end" value="" />
		<input type="hidden" id="info" name="info" value="" />
	</form>
	<form id="month_form" action="/index.php/news/monthly_view" method="post">
		<input type="hidden" id="month" name="month" value="" />
	</form>
  </div>
</div>