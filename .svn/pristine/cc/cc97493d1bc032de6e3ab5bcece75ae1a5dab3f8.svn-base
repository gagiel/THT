<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class Wechat1 extends CI_Controller
{
	var $encodingAesKey = "CzpX3bjjg37kJLbDwmsmA4rHR4UbSZsh4LI8whYJ7FA";
	var $token = "thtprm";
	var $appId = "wx335eeedb7c339288";
	var $appSecret = "c56e2d73d701b6ad716b0b2e93a7ee6a"; 
	
	var $toUsername		= "";
	var $fromUsername	= "";
	var $msgType		= "";
	var $content		= "";
	var $event			= "";
	var $eventKey		= "";
	var $time			= "";
	
	var $debug			= false;	//调试
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_news_other');
		$this->load->model('m_wechat_set');
		$this->load->model('m_news');
	}
	
	/**
	 * 微信管理 - 系统回复设置
	 */
	public function set()
	{
		$this->load->library('session');
		$this->load->library('login');
		$this->login->check_login($this->session->userdata('user_id'));
		$this->login->check_jurisdict('17',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'wechat'));
		
		$re = $this->m_wechat_set->set_list();
		
		$this->load->helper('select');
		
		$data = array(
			'list'		=> $re,
			'select'	=> type_select(),
		);
		
		$this->load->view('wechat/set',$data);
		$this->load->view('main_footer');
	}
	
	/**
	 * 设置模板消息类型为
	 */	
	public function setIndustry()
	{
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
		$data = array(
			'industry_id1'=>21
		);
		$jsondata = urldecode(json_encode($data)); 
		echo $jsondata;
		$url = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.$access_token;
		
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$url); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch,CURLOPT_POST,1); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$jsondata); 
		$rejson = curl_exec($ch); 
		curl_close($ch);
		
		echo $rejson;
	}
	
	public function pic_upload()
	{
		if(isset($_POST['do']))
		{
			print_r($_FILES['i_file']);
			exit();
		}
		else
		{
			$this->load->view('wechat/pic_upload');
		}
		
	}
	
	/**
	 * 上传媒体图片文件
	 */
	public function addMedia()
	{
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
		
		$pic_url = realpath('/images/weixin_newsletter_2015.jpg');
		echo $pic_url;
		exit();
		$filedata = array('media'=> "@".$pic_url);
		
//		$pic = file_get_contents('/images/weixin_newsletter_2015.jpg');
		//var_dump($pic);

		$url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token.'&type=image';
		
		
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$url); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_POST,1); 
		curl_setopt($ch,CURLOPT_HEADER, 0 );
		curl_setopt($ch,CURLOPT_POSTFIELDS,$filedata); 
		$rejson = curl_exec($ch); 
		curl_close($ch);
		var_dump($rejson);
	}
	
/**
	 * 上传媒体缩略图片文件
	 */
	public function addThumbMedia($path=false)
	{
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
                if($path!==false){
                    $path=  substr($path, 1);
                 $pic_url =  realpath($path);   
                }else{
                 $pic_url = realpath('images/weixin_newsletter_2015.jpg');   
                }
		$filedata = array('media'=> "@".$pic_url);
		$url = 'https://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token.'&type=thumb';
		$output = $this->https_request($url,$filedata);
                return $output;	
	}

	/*
	 * NewsLetter微信推送（群发推送）
	 */
	
	public function sendNewsLetter()
	{
		$test		= $this->input->post('test');
		$title		= $this->input->post('title');
		$date		= $this->input->post('sdate');
              
		if($test)
		{
			$group_id = "100";
		}
		else
		{
			$group_id = "0";
		}
		
		if($title=='')
		{
			exit("请填写标题");
		}

		//获取变量$access_token
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
		
	    //设置接口链接变量
		$url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$access_token; 
        $url_upload="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$access_token;
		
		//获取推送内容信息
		$data = $this->_get_newsletter($date);
		$content=$this->newscontent($date);
		
	    if(!$data['succ'])
		{
			exit("推送内容获取失败");
		}
	    if(!$content['succ'])
		{
			exit("推送详细内容获取失败");
		}
		//获取thumb_media_id变量
        $data1 = $this->addThumbMedia();
        $data1=json_decode($data1);
		$media_id=$data1->thumb_media_id;

		$data = $data['data'];
		//拼接数组
		$tmpdata=array();
		$tmpdata['thumb_media_id']=$media_id;
		$tmpdata['author']=urlencode("天津滨海高新区");
		$tmpdata['title'] = urlencode($title);
		$tmpdata['content_source_url']=$data['url'];
		$content['data']=str_replace('src="','src="http://prm.tht.gov.cn', $content['data']);
		$tmpdata['content'] =urlencode(htmlspecialchars(str_replace("\"","'",str_replace("\n","<br>",$content['data']))));
		$tmpdata['digest']=urlencode(htmlspecialchars(str_replace("\"","'",$data['description'])));
		$tmpdata['show_cover_pic']=1;
		$postdata['articles'][]=$tmpdata;
	    $postdata = json_encode($postdata); 
        $postdata= urldecode($postdata);
        $postdata= htmlspecialchars_decode($postdata);
	   
	   
	    //获取media_id变量
	     $renews = $this->https_request($url_upload,$postdata);
			$news_tmp = json_decode($renews);
		 $news_id=$news_tmp->media_id;
		
		
		//拼接json数组
		$redata = array(
		        'filter'=>array(
		          'is_to_all'=>false,
		          'group_id'=>$group_id,
		),
		       'mpnews'=>array(
		           "media_id"=>$news_id
		),	
		       'msgtype'=> 'mpnews'		
		);
		

		   $succ = false;
	       $jsondata =json_encode($redata); 
               
	      //调用群发接口，进行群发操作
			$rejson = $this->https_request($url,$jsondata);	
			$arr_tmp = json_decode($rejson);
                       
			if($arr_tmp->errcode==0)
			{
				$succ = true;
			}

		if($succ)
		{
			exit('发送成功');
		}
		else
		{
			exit('发送失败');
		}		
		
		
	}	
	
        	/*
	 * NewsLetter微信推送（群发推送）
	 */
	
	public function sendNewsLetter2()
	{
		$test		= $this->input->post('test');
		$title		= $this->input->post('title');
		$date		= $this->input->post('sdate');
                $idstr          =$this->input->post('idstr');//其他推送信息拼接的字符串
//               $test		= false;
//		$title		= "NewsLetter(2015-05-19)";
//		$date		= '2015-05-19';
//               $idstr          ="3,4,";//其他推送信息拼接的字符串
                                               
		if($test)
		{
			$group_id = "100";
                        $is_to_all=true;
		}
		else
		{
			$group_id = "0";
                        $is_to_all=false;
		}
		
		if($title=='')
		{
			exit("请填写标题");
		}
		//获取变量$access_token
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
		
	    //设置接口链接变量
		$url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$access_token; 
               $url_upload="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$access_token;
		
		//获取newsletter推送内容信息
		$data = $this->_get_newsletter($date);
		$content=$this->newscontent($date);
		
	    if(!$data['succ'])
		{
			exit("推送内容获取失败");
		}
	    if(!$content['succ'])
		{
			exit("推送详细内容获取失败");
		}
		//获取thumb_media_id变量
            $data1 = $this->addThumbMedia();
             $data1=json_decode($data1);
		$media_id=$data1->thumb_media_id;

		$data = $data['data'];
		//拼接NewsLetterl数组
		$tmpdata=array();
		$tmpdata['thumb_media_id']=$media_id;
		$tmpdata['author']=urlencode("天津滨海高新区");
		$tmpdata['title'] = urlencode($title);
		$tmpdata['content_source_url']=$data['url'];
		$content['data']=str_replace('src="','src="http://prm.tht.gov.cn', $content['data']);
		$tmpdata['content'] =urlencode(htmlspecialchars(str_replace("\"","'",str_replace("\n","<br>",$content['data']))));
		$tmpdata['digest']=urlencode(htmlspecialchars(str_replace("\"","'",$data['description'])));
		$tmpdata['show_cover_pic']=1;
		$tmp[]=$tmpdata;
               
               
	   //获取其他推送信息 
                if($idstr!==""){
                    //idstr 该字符串最后一个字符去除
                  $idstr=substr($idstr,0,-1); 
                  //生成搜索所需的where语句
                  $where="id in (".$idstr.")";
                  //获取其他推送信息
                  $other_data = $this->m_news_other->get_field(false,$where,false);
                  //拼接出其他推送信息数组
                  $arr_other=array();
                  foreach($other_data as $value){
                      $temp=array();
                      //获取thumb_media_id变量
                      $thumb_media=$this->addThumbMedia($value['show_cover_pic']);
                      $thumb_media=json_decode($thumb_media);
                      $temp['thumb_media_id']=$thumb_media->thumb_media_id;
                      $temp['author']=urlencode($value['author']);
                     $temp['title']=urlencode($value['title']);
                      // 判读原文链接参数是否为空，如果为空，则不生成该参数
                      if($value['content_source_url']!==""){
                        $temp['content_source_url']=$value['content_source_url'];    
                       } 
                      $value['content']=str_replace('src="','src="http://prm.tht.gov.cn', $value['content']); 
		      $temp['content'] =urlencode(htmlspecialchars(str_replace("\"","'",str_replace("\n","<br>",$value['content'])))); 
                      $temp['digest']=urlencode(htmlspecialchars(str_replace("\"","'",$value['digest'])));
                     $temp['show_cover_pic']=1;
                      $arr_other[]=$temp;
                  }
                }
               
                //把newsletter信息数组和其他推送信息数组进行拼接
                $articles=array_merge($tmp,$arr_other);
                //生成图文信息数组，并进行相关转码工作
                $postdata['articles']=$articles;
              
                
                 $postdata = json_encode($postdata); 
                 $postdata= urldecode($postdata);
                 $postdata= htmlspecialchars_decode($postdata);
                 
	    // 通过调用图文上传接口，上传图文信息，并获取推送信息所需media_id变量
                            $renews = $this->https_request($url_upload,$postdata);
                            $news_tmp = json_decode($renews);
                            $news_id=$news_tmp->media_id;                 
                            var_dump($news_tmp);
		//拼接json数组
                //该数组为群发接口所需的post值 
		$redata = array(
		        'filter'=>array(
		          'is_to_all'=>$is_to_all,
		          'group_id'=>$group_id,
		),
		       'mpnews'=>array(
		           "media_id"=>$news_id
		),	
		       'msgtype'=> 'mpnews'		
		);
		

		   $succ = false;
	       $jsondata =json_encode($redata); 
               
	      //调用群发接口，进行群发操作
			$rejson = $this->https_request($url,$jsondata);	
			$arr_tmp = json_decode($rejson);
                        var_dump($arr_tmp);
			if($arr_tmp->errcode==0)
			{
				$succ = true;
			}

		if($succ)
		{
			exit('发送成功');
		}
		else
		{
			exit('发送失败');
		}		
		
		
	}	
	
	/**
	 * NewsLetter微信推送
	 */	
	public function sendNewsLetter1()
	{
		$test		= $this->input->post('test');
		$title		= $this->input->post('title');
		$openid		= $this->input->post('wechatid');
		$date		= $this->input->post('sdate');
		
		if($title=='')
		{
			exit("请填写标题");
		}
		
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			exit("微信接口验证失败");
		}
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token; 
		
		$data = $this->_get_newsletter($date);
		if(!$data['succ'])
		{
			exit("推送内容获取失败");
		}
		$data = $data['data'];	
		$data['title'] = $title;
		$data['description'] = urlencode($data['description']);
		//拼接json数组
		$redata = array(
				'msgtype'	=> 'news',
				'news'		=> array(
					'articles'	=> array(
						$data,
					),
				),
			);
		
		$arrUser = array();
		if($test=='true')
		{
			if($openid=='')
			{
				exit("请填写微信推送测试账号");
			}
			$arrUser[] = $openid;
		}
		else
		{
			/****获取全部用户****/
			$next_openid = '';
			do
			{
				$user_url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$access_token."&next_openid=".$next_openid;
				$user_ch = curl_init(); 
				curl_setopt($user_ch,CURLOPT_URL,$user_url); 
				curl_setopt($user_ch,CURLOPT_RETURNTRANSFER,1); 
				$user_re = curl_exec($user_ch); 
				curl_close($user_ch);
				
				$arr_tmp = json_decode($user_re);
				foreach ( $arr_tmp->data->openid as $v ) {
					if($v!='')
					{
						$arrUser[] = $v;
					}
				}
				
				$next_openid = $arr_tmp->next_openid;
			}while($arr_tmp->total>$arr_tmp->count);
		}
		
		$succ = false;
		foreach($arrUser as $op_id)
		{
			$redata['touser'] = $op_id;
			$jsondata = urldecode(json_encode($redata)); 
			
			$ch = curl_init(); 
			curl_setopt($ch,CURLOPT_URL,$url); 
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
			curl_setopt($ch,CURLOPT_POST,1); 
			curl_setopt($ch,CURLOPT_POSTFIELDS,$jsondata); 
			$rejson = curl_exec($ch); 
			curl_close($ch);
			$arr_tmp = json_decode($rejson);
			echo $op_id.$rejson;
			if($arr_tmp->errcode==0)
			{
				$succ = true;
			}
		}
		if($succ)
		{
			exit('发送成功');
		}
		else
		{
			exit('发送失败');
		}		
	}
	
	
	
	
	/**
	 * 微信主程序
	 */
	public function index()
	{
		if (isset($_GET['echostr'])) {
			$this->valid();
		}else{
			$this->responseMsg();
		}

	}
	
	/**
	 * 根据用户发送的信息，自动回复 主程序
	 */
	public function responseMsg()
	{
									
		$this->getMsg();
		
		$this->createMenu();
		
		if ($this->msgType==='event') 
		{
			//用户事件
			if($this->event=='subscribe')
			{
				//用户关注事件
				
				//系统设定回复
				$this->getSetMsg('event_subscribe');
			}
			if($this->event=='CLICK')
			{
				//用户点击事件
				
				//系统设定回复
				$this->getSetMsg($this->eventKey);
				
				//昨日要闻
				if($this->eventKey=='NL_TODAY')
				{
				    //昨日新闻
					$date=date('Y-m-d');
					$ninfo = $this->m_news->get_publish_prev($date);
					$ninfo=$ninfo[0];
					$this->content = date('Ymd', strtotime($ninfo->p_date));
					$this->reNewsLetter();
				}
			}
		}
		elseif($this->msgType=='text')
		{
			//用户发送文本
			
			//系统设定回复
			$this->getSetMsg($this->content);
			
			//回复NewsLettert
			if(strlen($this->content)==8 && preg_match("/^20[0-9]{2}[0-1]{1}[0-9]{1}[0-3]{1}[0-9]{1}$/",$this->content))
			{
				$this->reNewsLetter();
			}
			if(strlen($this->content)==6 && preg_match("/^20[0-9]{2}[0-1]{1}[0-9]{1}$/",$this->content))
			{
				$this->reNewsLetterMonth();
			}
			//建言献策
			if(substr($this->content,0,5)=='JYXC:' || substr($this->content,0,5)=='JYXC：')
			{
				$this->content = substr($this->content,5);
				$this->reJYXC();
			}
		}
		elseif ($this->msgType==='location') 
		{
			exit("...");
		}
		elseif ($this->msgType==='image') 
		{
			exit("...");
		}
		elseif ($this->msgType==='voice') 
		{
			exit("...");
		}
		
		//无匹配内容
		$re_msg = $this->m_wechat_set->get_re_msg("error");
		if($re_msg['info']=='')
		{
			exit();
		}
		else
		{
			$this->reText($re_msg['info']);
		}
	}

	/**
	 * 创建菜单
	 */
	public function createMenu($debug=false)
	{
		$access_token = $this->get_access_token();
		if(!$access_token)
		{
			$this->reText("菜单创建失败");
		}
		
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token; 
		$menu = array(
			'button'	=> array(
				array(
					'name'	=> urlencode('News'),
					'sub_button'=>array(
						array('type'=>'click','key'=>'NL_TODAY',	'name'=>urlencode("昨日新闻"),), 
						array('type'=>'click','key'=>'NL_LAST',		'name'=>urlencode("往期回顾"),) , 
						array('type'=>'click','key'=>'NL_MONTH',	'name'=>urlencode("月刊查阅"),),
					),
				),
				array(
					'name'	=> urlencode('易'),
					'sub_button'=>array(
						array('type'=>'click','key'=>'YI_ZC',	'name'=>urlencode("易注册"),), 
						array('type'=>'click','key'=>'YI_RZ',	'name'=>urlencode("易融资"),), 
						array('type'=>'click','key'=>'YI_SH',	'name'=>urlencode("易生活"),), 
						array('type'=>'click','key'=>'YI_ZD',	'name'=>urlencode("易指导"),), 
					),
				),
				array(
					'name'	=> urlencode('PRM'),
					'sub_button'=>array( 
						array('type'=>'click','key'=>'event_subscribe',	'name'=>urlencode("查看目录"),), 
						array('type'=>'view','url'=>'http://prm.tht.gov.cn/appfile/',	'name'=>urlencode("安装安卓版"),),
						array('type'=>'view','url'=>'http://prm.tht.gov.cn/appfile/',	'name'=>urlencode("安装IOS版"),),
					),
				),
			),
		);
		$jsondata = urldecode(json_encode($menu)); 
		
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$url); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch,CURLOPT_POST,1); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$jsondata); 
		$data = curl_exec($ch); 
		curl_close($ch);
		
		if($debug)
		{
			echo $url.'<br />'.$jsondata.'<br />';
			print_r($data);
		}
	}

	/**
	 * 删除菜单
	 */
	public function delMenu()
	{
		$access_token = $this->get_access_token();
		
		$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token; 
		$data = json_decode(file_get_contents($url),true); 
		print_r($data);
		if ($data['errcode']==0) { 
			# code...
			return true; 
		}else{ 
			return false; 
		} 
		
	}

	/**
	 * 获取用户发送的信息
	 */
	private function getMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		$this->m_wechat_set->log_insert(array('msg'=>$postStr,'addtime'=>date('Y-m-d H:i:s')));
		
		if (!empty($postStr)){
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->fromUsername	= $postObj->FromUserName;
			$this->toUsername	= $postObj->ToUserName;
			$this->msgType		= trim($postObj->MsgType);
			if ($this->msgType==='event')
			{
				$this->event		= trim($postObj->Event);
				$this->eventKey		= trim($postObj->EventKey);
			}
			if ($this->msgType==='text')
			{
				$this->content		= strtoupper(trim($postObj->Content));
			}
			
			$this->time			= time();
		}
		else
		{
			exit("...");
		}
	}
	
	/**
	 * 根据用户发送的信息，获取系统设定的回复内容
	 */
	private function getSetMsg($str,$debug=false)
	{
		$re_msg = $this->m_wechat_set->get_re_msg($str);
		
		if($debug)
		{
			print_r($re_msg);
		}
		
		if($re_msg['succ'])
		{
			if($re_msg['type']=='text')
			{
				//返回纯文本
				$this->reText($re_msg['info']);
			}
			if($re_msg['type']=='news')
			{
				//返回图文信息
				$arr = json_decode($re_msg['info']);
				
				$re_arr = array();
				if(is_array($arr))
				{
					foreach($arr as $k => $v)
					{
						foreach($v as $k1 => $v1)
						{
							$re_arr[$k][$k1] = $v1;
						}
					}
				}
				
				$this->reNews($re_arr);
			}
		}
	}
	
	/**
	 * 拼接 回复纯文本内容 的xml
	 */
	private function reText($str)
	{
		$textTpl =  "<xml>" .
					"<ToUserName><![CDATA[%s]]></ToUserName>" .
					"<FromUserName><![CDATA[%s]]></FromUserName>" .
					"<CreateTime>%s</CreateTime>" .
					"<MsgType><![CDATA[%s]]></MsgType>" .
					"<Content><![CDATA[%s]]></Content>" .
					"<FuncFlag>0</FuncFlag>" .
					"</xml>";   
		$msgType = "text";
		
		$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, $this->time, $msgType, $str);
		exit($resultStr);
	}
	
	/**
	 * 拼接 回复图文内容 的xml
	 * 参数:Array（
	 * 		Array(
	 * 			"title"			=> "标题"
	 * 			"description"	=> "内容"
	 * 			"picurl"		=> "图片"
	 * 			"url"			=> "跳转链接"
	 * 		)
	 * 	)
	 */
	private function reNews($newsData)
	{
		$newTplHeader 	= "<xml>" .
						  "<ToUserName><![CDATA[%s]]></ToUserName>" .
						  "<FromUserName><![CDATA[%s]]></FromUserName>" .
						  "<CreateTime>%s</CreateTime>" .
						  "<MsgType><![CDATA[%s]]></MsgType>" .
						  "<ArticleCount>%s</ArticleCount>" .
						  "<Articles>";
		
		$newTplItem		= "<item>" .
						  "<Title><![CDATA[%s]]></Title>" .
						  "<Description><![CDATA[%s]]></Description>" .
						  "<PicUrl><![CDATA[%s]]></PicUrl>" .
						  "<Url><![CDATA[%s]]></Url>" .
						  "</item>"; 
						  
		$newTplFoot 	= "</Articles>" .
						  "<FuncFlag>0</FuncFlag>" .
						  "</xml>";
						   
		$msgType = "news";
						  
		$resultStr = "";
		$itemsCount = count($newsData);
		$itemsCount = $itemsCount < 10 ? $itemsCount : 10;//微信公众平台图文回复的消息一次最多10条
		for($key=0;$key<$itemsCount;$key++)
		{
			 $item = $newsData[$key];
			 $resultStr .= sprintf($newTplItem,$item['title'],$item['description'],$item['picurl'],$item['url']);
		}
		
		$header = sprintf($newTplHeader, $this->fromUsername, $this->toUsername, $this->time, $msgType, $itemsCount);
		$footer = $newTplFoot;
		
		exit($header . $resultStr . $footer);
		
	}
	
	private function _get_newsletter($date)
	{
		$this->load->model('m_news');
		$ninfo = $this->m_news->get_publish($date);
		if(count($ninfo)>0)
		{
			$ninfo = $ninfo[0];
			
			//--------分解文字内容----------
			$description = "";
			$arr_t = explode('</p>',$ninfo->info_top);
			if(is_array($arr_t))
			{
				foreach($arr_t as $k => $v)
				{
					$tmp = strip_tags($v);//去除HTML标签
					$tmp = str_replace("&nbsp;", " ", $tmp);
					if(trim($tmp)=='')//非文本
					{				
						continue;
					}
					else
					{
						$description .= "\n".$tmp;
					}
				}
			}
			
			//--------分解文字内容----------
			
			$re_data = array(
				"title"			=> "NewsLetter【".$date."】",
				"description"	=> $description,
				"picurl"		=> "http://prm.tht.gov.cn/images/weixin_newsletter_2015.png",
				"url"			=> "http://prm.tht.gov.cn/index.php/wechat/newsletter/".$date,
			);
			return array('succ'=>true,'data'=>$re_data);
		}
		else
		{
			return array('succ'=>false);
		}
	}

	/**
	 * 用户发送"20150101",回复"NewsLetter信息"
	 */
	public function reNewsLetter()
	{
		//NewsLetter		
		if($this->content=='')
		{
			$date = date('Y-m-d');
		}
		else
		{
			$date = date('Y-m-d',strtotime($this->content));
		}
		$data = $this->_get_newsletter($date);
		if($data['succ'])
		{
			$this->reNews(array($data['data']));
		}
		else
		{
			$this->reText($date." 尚未发布NewsLetter");
		}
	}
	
	/**
	 * 用户发送"201501",回复"NewsLetter月刊"
	 */
	public function reNewsLetterMonth()
	{
		$this->load->helper('pic');
		//reNewsLetterMonth
		$ndate = date('Y-m',strtotime($this->content.'01'));
		$this->load->model('m_news_monthly_report');
		$ninfo = $this->m_news_monthly_report->report_info($ndate);
		if($ninfo->info!='')
		{			
			$re_data = array(
				"title"			=> "NewsLetter月刊【".$ndate."】",
				"description"	=> "点击查看月刊内容",
				"picurl"		=> "http://prm.tht.gov.cn/images/weixin_newsletter_2015.png",
				"url"			=> "http://prm.tht.gov.cn/index.php/wechat/newslettermonth/".$ndate,
			);
			$this->reNews(array($re_data));
		}
		else
		{
			$this->reText($ndate." 尚未发布NewsLetter月刊");
		}
	}

	/**
	 * 用户发送建言献策时，记录并简单回复
	 */
	private function reJYXC()
	{
		if($this->content=='')
		{
			$this->reText("请填写建言献策内容");
		}
		$data = array(
			'from_user'	=> strval($this->fromUsername),
			'from_time'	=> strval($this->time),
			'from_info'	=> strval($this->content),
		);
		if($this->m_wechat_set->jyxc_insert($data))
		{
			$this->reText("提交成功，我们会尽快回复");
		}
		else
		{
			$this->reText("提交失败，请重试");
		}
	}

	/**
	 * 显示页面内容
	 */
	public function view($str)
	{
		$re_msg = $this->m_wechat_set->get_re_msg($str);
		$this->load->view('wechat/view',array('info'=>$re_msg['view']));
	}
	
	/**
	 * 显示地图页面
	 */
	public function map($name,$address)
	{
		$data = array(
			'name'	=> $name,
			'addr'	=> $address
		);
		$this->load->view('wechat/map',$data);
	}
	
	/**
	 * 点击查看NewsLetter
	 */
	public function newsletter($date)
	{
		
		$this->load->model('m_news');
		$this->load->model('m_news_type');
		
		$ninfo = $this->m_news->get_publish($date);
		if(count($ninfo)>0)
		{
			$ninfo = $ninfo[0];
			
			$type = explode(',',$ninfo->info);
			
			if(count($type)==0)
			{
				$this->load->view('wechat/newsletter',array('info'=>"<font color='red'>暂无新闻</font>"));
				exit();
			}
			
			//获取新闻内容
			$where = array(
				'start' => $date,
				'end'	=> $date,
				'info'	=> '',
				'ids'	=> $type,
				'state'	=> '1'
			);
			$re = $this->m_news->news_list($where);
			
			if(count($re)==0)
			{
				$this->load->view('wechat/newsletter',array('info'=>"<font color='red'>暂无新闻</font>"));
				exit();
			}
						
			//将新闻按类型分组，并获取有效类型ID
			$news = array();
			if(is_array($re))
			{
				foreach($re as $val)
				{
					$news[$val->ntype][] = $val;
				}
			}
			//新闻ID->名称
			$type_info = $this->m_news_type->news_type_list();
			$type_hash = array();
			$type_detail = array();
			if(is_array($type_info))
			{
				foreach($type_info as $v)
				{
					$arr = explode('.',$v->detail);
					switch(count($arr))
					{
						case 1:	$type_hash[$v->id] = '【'.$v->name.'】';	break;
						case 2:	$type_hash[$v->id] = '*'.$v->name.'*';	break;
						default:$type_hash[$v->id] = $v->name;			break;
					}
					$type_detail[$v->id] = $arr;
				}
			}
			//拼新闻内容
			$data = "";
			$type_used = array();
			if(is_array($type))
			{
				foreach($type as $t)
				{
					if(empty($news[$t]))
					{
						continue;
					}
					$detail = $type_detail[$t];
					if(is_array($detail))
					{
						foreach($detail as $d)
						{
							if(!in_array($d,$type_used))
							{
								$type_used[] = $d;
								$data .= "<p style='text-indent:0px;'><strong>".$type_hash[$d]."</strong></p>";
							}
						}
					}
					if(isset($news[$t]) && is_array($news[$t]))
					{
						foreach($news[$t] as $val)
						{
							$data .= $val->info;
						}
					}
				}
			}
			$top	= str_replace("<p>", "<p style='text-indent:0px;'>", $ninfo->info_top);
			$data	= str_replace("<p><img", "<p style='text-indent:0px; text-align:center;'><img", $data);
			$footer	= str_replace("<p>", "<p style='text-align:right;'>", $ninfo->info_footer);
			//拼接显示内容
			$this->load->view('wechat/view',array('info'=>$top.$data.$footer));
		}
		else
		{
			$this->load->view('wechat/view',array('info'=>"<font color='red'>".$date." 尚未发布NewsLetter</font>"));
		}
	}
	/*
	 * 获取新闻内容
	 */
      public function newscontent($date)
	{
		//$="20150215";
		$this->load->model('m_news');
		$this->load->model('m_news_type');
		
		$ninfo = $this->m_news->get_publish($date);
		if(count($ninfo)>0)
		{
			$ninfo = $ninfo[0];
			
			$type = explode(',',$ninfo->info);
			
			if(count($type)==0)
			{
				$this->load->view('wechat/newsletter',array('info'=>"<font color='red'>暂无新闻</font>"));
				exit();
			}
			
			//获取新闻内容
			$where = array(
				'start' => $date,
				'end'	=> $date,
				'info'	=> '',
				'ids'	=> $type,
				'state'	=> '1'
			);
			$re = $this->m_news->news_list($where);
			
			if(count($re)==0)
			{
				$this->load->view('wechat/newsletter',array('info'=>"<font color='red'>暂无新闻</font>"));
				exit();
			}
						
			//将新闻按类型分组，并获取有效类型ID
			$news = array();
			if(is_array($re))
			{
				foreach($re as $val)
				{
					$news[$val->ntype][] = $val;
				}
			}
			//新闻ID->名称
			$type_info = $this->m_news_type->news_type_list();
			$type_hash = array();
			$type_detail = array();
			if(is_array($type_info))
			{
				foreach($type_info as $v)
				{
					$arr = explode('.',$v->detail);
					switch(count($arr))
					{
						case 1:	$type_hash[$v->id] = '【'.$v->name.'】';	break;
						case 2:	$type_hash[$v->id] = '*'.$v->name.'*';	break;
						default:$type_hash[$v->id] = $v->name;			break;
					}
					$type_detail[$v->id] = $arr;
				}
			}
			//拼新闻内容
			$data = "";
			$type_used = array();
			if(is_array($type))
			{
				foreach($type as $t)
				{
					if(empty($news[$t]))
					{
						continue;
					}
					$detail = $type_detail[$t];
					if(is_array($detail))
					{
						foreach($detail as $d)
						{
							if(!in_array($d,$type_used))
							{
								$type_used[] = $d;
								$data .= "<p style='text-indent:0px;'><strong>".$type_hash[$d]."</strong></p>";
							}
						}
					}
					if(isset($news[$t]) && is_array($news[$t]))
					{
						foreach($news[$t] as $val)
						{
							$data .= $val->info;
						}
					}
				}
			}
			//$top	= str_replace("<p>", "<p style='text-indent:0px;'>", $ninfo->info_top);
			$data	= str_replace("<p><img", "<p style='text-indent:0px; text-align:center;'><img", $data);
			$footer	= str_replace("<p>", "<p style='text-align:right;'>", $ninfo->info_footer);
			$data=$data.$footer;
			//拼接显示内容
			return array('succ'=>true,'data'=>$data);
			//$this->load->view('wechat/view',array('info'=>$top.$data.$footer));
		}
		else
		{
			return array('succ'=>false);
		}
		
	}
	/**
	 * 点击查看NewsLetter月刊
	 */
	public function newslettermonth($date)
	{
		$this->load->model('m_news_monthly_report');
		$ninfo = $this->m_news_monthly_report->report_info($date);
		
		if($ninfo->info!='')
		{
			$data = $ninfo->info;
			$data = str_replace("<p><img", "<p style='text-indent:0px; text-align:center;'><img", $data);
			$this->load->view('wechat/view',array('info'=>$data));
		}
		else
		{
			$this->load->view('wechat/view',array('info'=>"<font color='red'>".$date." 尚未发布NewsLetter月刊</font>"));
		}
	}

	/**
	 * 安卓版下载页
	 */
	public function android()
	{
		$this->load->view('wechat/android');
	}
	
	public function calendar()
	{
		$this->load->view('wechat/calendar');
	}
	
	
	/**
	 * 接口测试
	 */
	private function valid()
	{
		$echoStr = $_GET["echostr"];

		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit();
		}
	}
	
	/** 
	 * 获取access_token 
	 */ 
	private function get_access_token() 
	{ 
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret; 
		$data = json_decode(file_get_contents($url),true); 
		
		if($data['access_token']){ 
			return $data['access_token']; 
		}else{ 
			return false;
		} 
	} 

	
	/**
	 * token验证
	 */
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
				
		$tmpArr = array($this->token, $timestamp, $nonce);
		// use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
/*
 * 传入接口链接和post的json变量，调用相应接口，并返回相关json串
 */	
 function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

}

?>