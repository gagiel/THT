update t_plan_templet set info='<p style="font-family: 文星标宋; font-size: 22px; text-align: center; padding: 0px 4px 0px 0px; margin: 0px 0px 20px;">$title$</p>
<p style="font-family: 仿宋_GB2312; font-size: 15px; text-align: center;">（$num$）</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px; text-indent: 2em;">$affairs$</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>一、时间：</strong>$year$年$month$月$day$日（周$week$）$hour$:$minute$开始</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>二、地点：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 16px; text-indent: 2em;">$for$、$address$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>三、出席领导：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 16px; text-indent: 2em;">请$for$、$<strong>$name$</strong>同志$endfor$出席</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>四、参加范围：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 16px; text-indent: 2em;">$for$、$department$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>五、具体安排：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 16px;">$<span stype="float:left;">$time$</span>&nbsp;<span stype="float:right;">$plan$</span>$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"><strong>六、工作分工：</strong></p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;">$for$</p><p style="font-family: 仿宋_GB2312; font-size: 16px;">$i$.$done$endfor$</p>
<p style="font-family: 仿宋_GB2312; font-size: 16px;"></p> 
<p style="font-family: 仿宋_GB2312; font-size: 16px; text-align: right;">$remark$<br/>$re_time_r$</p>' 
where t_plan_templet.id=1;