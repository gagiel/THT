$(document).ready(function(){
  //表格奇数行背景色
  $(".biaozhun tr:even").addClass("alt");
  $(".biaozhun2 tr:odd").addClass("alt2");
  $(".biaozhun_news tr:even").addClass("alt");
  
  //主导航器
  $(".menutitle").click(function(){
	$(this).next("div").slideToggle("fast")
	.siblings(".menucontent:visible").slideUp("fast");
	$(this).toggleClass("activetitle");
	$(this).siblings(".activetitle").removeClass("activetitle");
  });
  //其它
});
//其它


(function($){ 
$.fn.center = function(){ 
var top = ($(window).height() - this.height())/2; 
var left = ($(window).width() - this.width())/2; 
var scrollTop = $(document).scrollTop(); 
var scrollLeft = $(document).scrollLeft(); 
return this.css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show(); 
} 
})(jQuery);
