update t_plan_templet set info='<p style="font-family: ���Ǳ���; font-size: 22px; text-align: center; padding: 0px 4px 0px 0px; margin: 0px 0px 20px;">$title$</p>
<p style="font-family: ����_GB2312; font-size: 15px; text-align: center;">��$num$��</p>
<p style="font-family: ����_GB2312; font-size: 16px; text-indent: 2em;">$affairs$</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>һ��ʱ�䣺</strong>$year$��$month$��$day$�գ���$week$��$hour$:$minute$��ʼ</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>�����ص㣺</strong></p>
<p style="font-family: ����_GB2312; font-size: 16px; text-indent: 2em;">$for$��$address$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>������ϯ�쵼��</strong></p>
<p style="font-family: ����_GB2312; font-size: 16px; text-indent: 2em;">��$for$��$<strong>$name$</strong>ͬ־$endfor$��ϯ</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>�ġ��μӷ�Χ��</strong></p>
<p style="font-family: ����_GB2312; font-size: 16px; text-indent: 2em;">$for$��$department$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>�塢���尲�ţ�</strong></p>
<p style="font-family: ����_GB2312; font-size: 16px;">$for$</p><p style="font-family: ����_GB2312; font-size: 16px;">$<span stype="float:left;">$time$</span>&nbsp;<span stype="float:right;">$plan$</span>$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 16px;"><strong>���������ֹ���</strong></p>
<p style="font-family: ����_GB2312; font-size: 16px;">$for$</p><p style="font-family: ����_GB2312; font-size: 16px;">$i$.$done$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 16px;"></p> 
<p style="font-family: ����_GB2312; font-size: 16px; text-align: right;">$remark$<br/>$re_time_r$</p>' 
where t_plan_templet.id=1;