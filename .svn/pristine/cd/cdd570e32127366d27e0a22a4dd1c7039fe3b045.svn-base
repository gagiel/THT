alter table `t_plan` add column `info_title` text COMMENT '附件标题',
alter table `t_plan` add column `people_name` text COMMENT '联系人姓名',
alter table `t_plan` add column `people_phone` text COMMENT '联系人电话',
update t_plan_templet set info='<h1 style="font-family: 文星标宋; font-size: 30px; text-align: center; padding: 0px 4px 0px 0px; margin: 0px 0px 20px;">$title$</h1>
<p style="font-family: 仿宋_GB2312; font-size: 22px; text-align: center;">（$num$）</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">　　$affairs$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>一、时间：</strong>$year$年$month$月$day$日（周$week$）$hour$:$minute$开始</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>二、地点：</strong>$for$、$address$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>三、出席领导：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">　　请$for$、$<strong>$name$</strong>$endfor$同志出席</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>四、参加范围：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">　　$for$、$department$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>五、具体安排：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 22px;">$<span stype="float:left;">　　$time$</span>&nbsp;<span stype="float:right;">$plan$</span>$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"><strong>六、工作分工：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 22px;">$　　$i$.$done$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 22px;">$info_title_moban$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px; text-align: right;">$remark$<br>$re_time$</p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;"></p>
<p style="font-family: 仿宋_GB2312; font-size: 22px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 22px;">$people_name_moban$endfor$</p>' 
where t_plan_templet.id=1;