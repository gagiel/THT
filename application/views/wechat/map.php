<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>天津滨海高新区公共关系管理系统</title>
<style type="text/css">
body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BVF9x5CGxnCGuWWIew21u7YT"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
</head>
<body>
  <div id="content">
	<div id="allmap"></div>

<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(117.203339,39.13699);
	map.centerAndZoom(point,12);
	// 创建地址解析器实例
	var myGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
	myGeo.getPoint("<?=urldecode($name).urldecode($addr)?>", function(point){
		if (point) {
			var marker = new BMap.Marker(point);  // 创建标注
			
			
			map.centerAndZoom(point, 16);
			map.enableScrollWheelZoom();
			
		    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
		                    '地址：<?=urldecode($addr)?>' +
		                  '</div>';
		
		    //创建检索信息窗口对象
		    var searchInfoWindow = null;
			searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
					title  : "<?=urldecode($name)?>",      //标题
					width  : 200,             //宽度
					height : 45,              //高度
					panel  : "panel",         //检索结果面板
					enableAutoPan : true,     //自动平移
					searchTypes   :[
						BMAPLIB_TAB_SEARCH,   //周边检索
						BMAPLIB_TAB_TO_HERE,  //到这里去
						BMAPLIB_TAB_FROM_HERE //从这里出发
					]
				});
		    marker.enableDragging(); //marker可拖拽
		    marker.addEventListener("click", function(e){
			    searchInfoWindow.open(marker);
		    })
		    map.addOverlay(marker); //在地图中添加marker
			
		}else{
			alert("您选择地址没有解析到结果!");
		}
	}, "天津市");
</script>

  </div>
</body>
</html>