<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class templat_bulid{
    public static function templet_top_bulid($title,$num,$affairs){
        $html="<h1 style='font-family: 文星标宋; font-size: 30px; text-align: center; padding: 0px 4px 0px 0px; margin: 0px 0px 20px;'>$title</h1>
			<p style='font-family: 仿宋_GB2312; font-size: 22px; text-align: center;'>（".$num."）</p>
			<p style='font-family: 仿宋_GB2312; font-size: 22px;'>　　$affairs</p>";
        return $html;
    }
    public static function templet_botton_bulid($year,$month,$day,$week,$hour,$minute,$address,$name,$depart,$plan,$time,$done,$info_title_moban,$data_array){
        $n=0;
        $i=1;
        $arr_n = array('一','二','三','四','五','六');
        $c_plan_more=$data_array['c_plan_more'];
        $c_time_start=$data_array['c_time_start'];
        $c_time_end=$data_array['c_time_end'];
        $c_time_xi=$data_array['c_time_xi'];
        $c_plan_more_xi=$data_array['c_plan_more_xi'];
        if(!empty($name)){
            foreach($name as $key=>$val){
                if(empty($name[$key])){
                    unset($name[$key]);
                }
            }
        }
        $html="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>".$arr_n[$n++]."、时间：</strong>".$year."年".$month."月".$day."日（周".$week."）".$hour.":".$minute."开始</p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>".$arr_n[$n++]."、地点：</strong>";
        if(!empty($address)){
            $count=count($address);
            foreach($address as $key=>$val){
                if($key<$count-1){
                    $html.=$val."、";
                }else{
                    $html.=$val;
                }
            }
        }
        $html.=	"</p>";
        if(!empty($name)){
            $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>".$arr_n[$n++]."、出席领导：</strong></p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px;'>　　请<strong>";
            $count=count($name);
            $name_n=0;
            foreach($name as $key=>$val){
                $name_n++;
                if($name_n<$count){
                    $html.=$val."、";
                }else{
                    $html.=$val;
                }
            }
            $html.="</strong>同志出席</p>";
        }
        if(!empty($depart[0])) {
            $html .= "<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>" . $arr_n[$n++] . "、参加范围：</strong></p>
                      <p style='font-family: 仿宋_GB2312; font-size: 22px;'>　　";
            $count=count($depart);
            foreach($depart as $key=>$val){
                if($key<$count-1){
                    $html.=$val."、";
                }else{
                    $html.=$val;
                }
            }
            $html.="</p>";
        }

        if(!empty($plan[0])){
            $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>".$arr_n[$n++]."、具体安排：</strong></p>";
            $html.="<table width='100%' style='border:1px solid rgb(255,255,255)'>";
            foreach($plan as $key=>$val){
                $html.="<tr style='border:1px solid rgb(255,255,255)'>
							<td valign='top' style='border:1px solid rgb(255,255,255);text-align: left;width:60px;'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>$time[$key]</p></td>
							<td style='border:1px solid rgb(255,255,255);text-align: left;'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>$val</p></td>
						</tr>";
            }
            $html.="</table>";
        }
        if(!empty($c_plan_more)){
            foreach($c_plan_more as $key=>$val){
                if($c_time_start[$key]!=$c_time_end[$key]){
                    $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>$c_time_start[$key]-$c_time_end[$key]</strong></p>";
                    $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'>　　$c_plan_more[$key]</p>";
                }else{
                    $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>$c_time_start[$key]</strong></p>";
                    $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'>　　$c_plan_more[$key]</p>";
                }
                if(!empty($c_plan_more_xi[$key])){
                    foreach($c_plan_more_xi[$key] as $key1=>$val1){
                        $html.="<table width='100%' style='border:1px solid rgb(255,255,255)'>";
                        $html.="<tr style='border:1px solid rgb(255,255,255)'>";

                        if(!isset($c_time_xi[$key][$key1]{1})){
                            $html.="<td valign='top' style='border:1px solid rgb(255,255,255);width:60px;text-align: left'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>".$c_time_xi[$key][$key1]."</p></td>";
                        }else{
                            $html.="<td valign='top' style='border:1px solid rgb(255,255,255);width:60px;text-align: right'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>".$c_time_xi[$key][$key1]."</p></td>";
                        }
                        $html.="<td style='border:1px solid rgb(255,255,255);text-align: left'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>".$c_plan_more_xi[$key][$key1]."</p></td>
								</tr>";
                        $html.="</table>";
                    }
                }
            }
        }
        if(!empty($done[0])){
            $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'><strong>".$arr_n[$n++]."、工作分工：</strong></p>";
            $html.="<table width='100%' style='border:1px solid rgb(255,255,255)'>";
            foreach($done as $key=>$val){
                $html.="<tr style='border:1px solid rgb(255,255,255)'>
							<td valign='top' style='border:1px solid rgb(255,255,255);text-align: left;width:1px;'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>$i.</p></td>
							<td style='border:1px solid rgb(255,255,255);text-align: left;'><p style='font-family: 仿宋_GB2312; font-size: 22px;'>$val</p></td>
						</tr>";
                $i++;
            }
            $html.="</table>";
        }
        $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p>";
        $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p>";
        if(!empty($info_title_moban[0])){
            foreach($info_title_moban as $key=>$val){
                $html.="<p style='font-family: 仿宋_GB2312; font-size: 22px;'>";
                if($key=="0"){
                    $html.="附件: ".$val;
                }else{
                    $html.="&nbsp;&nbsp;&nbsp;".$val;
                }
                $html.="</p>";
            }
        }
        return $html;
    }
    public static function templet_footer_bulid($remark,$re_time,$people_name_moban){
        $html="<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px; text-align: right;'>$remark<br>$re_time</p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p>
				<p style='font-family: 仿宋_GB2312; font-size: 22px;'></p><p style='font-family: 仿宋_GB2312; font-size: 22px;'>";
        if(!empty($people_name_moban)){
            foreach($people_name_moban as $key=>$val){
                $html.=$val;
            }
        }
        $html.=	"</p>";
        return $html;
    }
}