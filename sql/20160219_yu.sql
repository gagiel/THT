alter table `t_plan` add column `info_title` text COMMENT '��������',
alter table `t_plan` add column `people_name` text COMMENT '��ϵ������',
alter table `t_plan` add column `people_phone` text COMMENT '��ϵ�˵绰',
update t_plan_templet set info='<h1 style="font-family: ���Ǳ���; font-size: 30px; text-align: center; padding: 0px 4px 0px 0px; margin: 0px 0px 20px;">$title$</h1>
<p style="font-family: ����_GB2312; font-size: 22px; text-align: center;">��$num$��</p>
<p style="font-family: ����_GB2312; font-size: 22px;">����$affairs$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>һ��ʱ�䣺</strong>$year$��$month$��$day$�գ���$week$��$hour$:$minute$��ʼ</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>�����ص㣺</strong>$for$��$address$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>������ϯ�쵼��</strong></p>
<p style="font-family: ����_GB2312; font-size: 22px;">������$for$��$<strong>$name$</strong>$endfor$ͬ־��ϯ</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>�ġ��μӷ�Χ��</strong></p>
<p style="font-family: ����_GB2312; font-size: 22px;">����$for$��$department$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>�塢���尲�ţ�</strong></p>
<p style="font-family: ����_GB2312; font-size: 22px;">$for$</p><p style="font-family: ����_GB2312; font-size: 22px;">$<span stype="float:left;">����$time$</span>&nbsp;<span stype="float:right;">$plan$</span>$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"><strong>���������ֹ���</strong></p>
<p style="font-family: ����_GB2312; font-size: 22px;">$for$</p><p style="font-family: ����_GB2312; font-size: 22px;">$����$i$.$done$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"></p>
<p style="font-family: ����_GB2312; font-size: 22px;">$for$</p><p style="font-family: ����_GB2312; font-size: 22px;">$info_title_moban$endfor$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"></p>
<p style="font-family: ����_GB2312; font-size: 22px; text-align: right;">$remark$<br>$re_time$</p>
<p style="font-family: ����_GB2312; font-size: 22px;"></p>
<p style="font-family: ����_GB2312; font-size: 22px;"></p>
<p style="font-family: ����_GB2312; font-size: 22px;">$for$</p><p style="font-family: ����_GB2312; font-size: 22px;">$people_name_moban$endfor$</p>' 
where t_plan_templet.id=1;