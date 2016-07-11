<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Content-type:text/html;charset=utf-8");

class News extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('login');
		//登录判断
		$this->login->check_login($this->session->userdata('user_id'));
		
		$this->load->model('m_news_type');
		$this->load->model('m_news');
		$this->load->model('m_news_sender');
		$this->load->model('m_news_send');
		$this->load->model('m_news_other');
		$this->load->helper('url');
		$this->load->helper('select');
	}
	
	/**
	 * 获取新闻类型列表
	 */
	public function type_list()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$data = array(
			'select'	=> type_select(),
		);
		
		$this->load->view('news/type',$data);
		$this->load->view('main_footer');
	}
	public function type_tree()
	{
		$open = $this->input->post('open');
		if(!$open)
		{
			$open = array();
		}
		//树形数组
		$tree = $this->m_news_type->news_type_tree();
		
		$this->load->helper('tree');
		
		echo tree_ntype($tree,$open);
	}
	public function type_option()
	{
		$re = $this->m_news_type->news_type_list();
		
		echo '<option value="0">无上级分类</option>'.$this->_get_tree_option($re,0,1);
	}
	
	/**
	 * 新增新闻类型
	 */
	public function type_add()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));

		$data = array(
					'name' => $this->input->post('name'),
					'parent' => $this->input->post('parent'),
				);
		if($this->m_news_type->news_type_insert($data))
		{
			echo 'success';
		}
		else
		{
			echo '新增失败';
		}
	}
	/**
	 * 修改新闻类型
	 */
	public function type_update()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
				
		$id = $this->input->post('id');
		
		$data = array(
					'name' => $this->input->post('name'),
					'parent' => $this->input->post('parent'),
				);
		if($this->m_news_type->news_type_update($id,$data))
		{
			echo 'success';
		}
		else
		{
			echo '修改失败';
		}
	}
	/**
	 * 删除新闻类型
	 */
	public function type_delete()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		$news = $this->m_news->news_list(array('ntype'=>$id));

		if(count($news)>0)
		{
			echo "类型中存在新闻";
			exit();
		}
		if($this->m_news_type->news_type_delete($id))
		{
			echo 'success';
		}
	}
	/**
	 * 新闻类型排序
	 */
	public function type_up()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
				
		$id = $this->input->post('id');
		
		if($this->m_news_type->news_type_mark($id,true))
		{
			echo 'success';
		}
		else
		{
			echo '排序失败';
		}
	}
	public function type_down()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
				
		$id = $this->input->post('id');
		
		if($this->m_news_type->news_type_mark($id,false))
		{
			echo 'success';
		}
		else
		{
			echo '排序失败';
		}
	}
	
	/**
	 * 新闻日历表
	 */
	public function calendar()
	{
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		$this->load->view('news/calendar',array('select'	=> type_select()));
		$this->load->view('main_footer');
	}
	
	/**
	 * 日历点击查看已发布的内容
	 */
	public function view()
	{
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$type = $this->input->post('type');
		$info = $this->input->post('info');
		
		//类型option
		$re = $this->m_news_type->news_type_list();
		$type_opt = $this->_get_tree_option($re,$type,2);
		
		$types = array();
		if($start==$end && !$type)
		{
			
			$type_publish = $this->m_news->get_publish($start);
			
			if(count($type_publish)>0)
			{
				$type_publish = $type_publish[0];
				$types = explode(',',$type_publish->info);
			}
		}
		else
		{
			if($type)
			{
				$re = $this->m_news_type->news_type_by_parent($type);
			}
			$type_list = $this->_get_tree_list($re);
			if(is_array($type_list))
			{
				foreach($type_list as $v)
				{
					if(!in_array($v->id,$types))
					{
						$types[] = $v->id;
					}
				}
			}
		}
		
		$info = $this->_get_info($start,$end,$types,$info);
		if($start==$end)
		{
			$comment = $this->_get_comment_by_date($start);
			$info .= $comment;
		}
		$data = array(
					'type_opt'	=> $type_opt,
					'info'		=> $info,
					'select'	=> type_select(),
					'where'		=> $_POST
				);
		
		/* 页面Word显示 */
		$this->load->view('news/view',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 获取新闻列表
	 */
	public function index($page='1',$pageSize='20')
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$post['start'] = $this->input->post('start');
		$post['end'] = $this->input->post('end');
		$post['info'] = $this->input->post('info');
		$post['ntype'] = $this->input->post('type');
		if($post['info'].$post['ntype'].$post['start'].$post['end']=='' && empty($_POST))
		{
			$post = $this->session->userdata('news_select');
		}
		if($post['start']==''&&$post['end']=='')
		{
			$post['start'] = date('Y-m-d');
			$post['end'] = date('Y-m-d');
		}
		if(!isset($post['ntype']) || $post['ntype']=='')
		{
			$post['ntype'] = 0;
		}
		if(!isset($post['info']))
		{
			$post['info'] = '';
		}
		$this->session->set_userdata(array('news_select'=>$post));
		
		//类型option
		$re = $this->m_news_type->news_type_list();
		$type_opt = $this->_get_tree_option($re,$post['ntype'],2);
		
		//类型hash
		$types = array();
		if(is_array($re))
		{
			foreach($re as $v)
			{
				$types[$v->id] = $v->name;
			}
		}
		$data = array(
			'where'		=> $post,
			'type_opt'	=> $type_opt,
			'types'		=> $types
		);
		
		$where = array(
			'info'		=> $post['info'],
			'start'		=> $post['start'],
			'end'		=> $post['end'],
		);
		$types = array();
		if($post['ntype'])
		{
			$re = $this->m_news_type->news_type_by_parent($post['ntype']);
		}
		$type_list = $this->_get_tree_list($re);
		if(is_array($type_list))
		{
			foreach($type_list as $v)
			{
				if(!in_array($v->id,$types))
				{
					$types[] = $v->id;
				}
			}
		}
		$where['ids'] = $types;
		
		//---------分页------------
		$num = $this->m_news->news_num($where);
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/news/index/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		//---------分页------------
		
		$list = $this->m_news->news_list($where,($page-1)*$pageSize,$pageSize);
		
		
		$data['list']	= $list;
		$data['pages']	= $pages;
		$data['select']	= type_select();
		
		$this->load->view('news/index',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 新闻发布页
	 */
	public function down()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$date = $this->input->post('date');
		if($date=='')$date = date('Y-m-d');
		
		$data = $this->_get_default_tree_info($date);
		$data['select']	= type_select();
		$data['date']	= $date;
		
		$this->load->view('news/down',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 根据日期获取有效的类型树及头尾内容
	 */
	public function down_data()
	{
		//获取日期
		$date = $this->input->get('date');
		
		//返回值
		$data = $this->_get_default_tree_info($date);
		
		//日期内有效的类型ID数组
		$types = $this->m_news->get_type_used($date,$date);
		if(count($types)==0)
		{
			$data['tree'] = '';
		}
		else
		{
			//树形数组
			$tree = $this->m_news_type->news_type_tree($types);
			//生成树
			$this->load->helper('tree');
			$data['tree'] = tree_ncheck($tree,$data['info']);
		}
		
		echo json_encode($data);
	}
	/**
	 * 获取日期已发布或默认头尾内容及类型ID
	 */
	function _get_default_tree_info($date)
	{	
		$re = array();
		$p_data = $this->m_news->get_publish($date);
		if(is_array($p_data) && count($p_data)>0)
		{
			$p_data = $p_data[0];
			$re['top'] = is_null($p_data->info_top)?'':$p_data->info_top;
			$re['foot'] = is_null($p_data->info_footer)?'':$p_data->info_footer;
			$re['info'] = explode(',',$p_data->info);
		}
		else
		{
			$this->load->library('lunar_calendar');
			$darr = explode('-',$date);
			$arr = $this->lunar_calendar->Cal($darr[0],$darr[1],$darr[2]);
			$re['top'] = '<p><img src="/images/newsletter_2015.png" /></p>' .
						 '<p>'.$darr[1].'月'.$darr[2].'日 星期'.$arr['week'].'</p>' .
						 '<p>农历'.$arr['month'].$arr['day'].'</p>' .
						 '<p>----------</p>' .
						 '<p>*精彩内容敬请阅读*</p>' .
						 '<p>————————————</p>';
			
			$re['foot'] ='<p>　　　天津高新区管委会</p>' .
						 '<p>　　（'.$this->session->userdata('user_department').' '.$this->session->userdata('user_name').' 采编）</p>';
			$re['info'] = array();
		}
							 
		return $re;
	}
	
	/**
	 * 发布前预览
	 */
	public function publish_view()
	{
		$date = $this->input->post('date');
		$ids = $this->input->post('ids');
		if($ids=='')
		{
			exit('暂无新闻');
		}
		else
		{
			
			echo $this->_get_info($date,$date,explode(',',$ids));
		}
	}
	/**
	 * 新闻发布
	 */
	public function publish()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$date = $this->input->post('date');
		$top = $this->input->post('tinfo');
		$footer = $this->input->post('finfo');
				
		$check = $this->input->post('tree');
		
		$ids = array();
		if(is_array($check))
		{
			foreach($check as  $val)
			{
				$ids[] = $val;
			}
		}
		if(count($ids)=='0')
		{
			exit("<script>alert('请选择发布的新闻类型');history.go(-1);</script>");
		}
		$types = implode(',',$ids);
		
		if($this->m_news->publish($date,$types,$top,$footer))
		{
			exit("<script>alert('发布成功');location.href='/index.php/news/'</script>");
		}
		else
		{
			exit("<script>alert('发布失败');history.go(-1);</script>");
		}
	}
	
	/**
	 * 新增新闻
	 */
	public function add()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$jurisdict = $this->input->post('tree');
		if(is_array($jurisdict))
		{
			$jurisdict = implode(',',$jurisdict);
		}
		
		$info = $this->input->post('info');
		$arr = explode('</p>',$info);
		$info = '';
		if(is_array($arr))
		{
			foreach($arr as $v)
			{
				if($v=='')continue;
				$tmp = strip_tags($v);//去除HTML标签
				$tmp = str_replace("&nbsp;", " ", $tmp);
				if(trim($tmp)=='')//非文本
				{
					$info .= $v;
				}
				else
				{
					$info .= '<p>'.$tmp;
				}
				$info .= '</p>';
			}
		}
		
		$data = array(
					'info' => $info,
					'ntype' => $this->input->post('type'),
					'ndate' => $this->input->post('ndate'),
					'user'	=> $this->session->userdata('user_id'),
					'addtime' => date('Y-m-d H:i:s'),
				);
		if($this->m_news->news_insert($data))
		{
			echo 'success';
		}
		else
		{
			echo '新闻添加失败';
		}
	}
	/**
	 * 修改新闻
	 */
	public function update()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		
		$info = $this->input->post('info');
		$arr = explode('</p>',$info);
		$info = '';
		if(is_array($arr))
		{
			foreach($arr as $v)
			{
				if($v=='')continue;
				$tmp = strip_tags($v);//去除HTML标签
				$tmp = str_replace("&nbsp;", " ", $tmp);
				if(trim($tmp)=='')//非文本
				{
					$info .= $v;
				}
				else
				{
					$info .= '<p>'.$tmp;
				}
				$info .= '</p>';
			}
		}
		
		$data = array(
					'info' => $info,
					'ntype' => $this->input->post('type'),
					'ndate' => $this->input->post('ndate'),
				);
		if($this->m_news->news_update($id,$data))
		{
			redirect($this->config->base_url().'index.php/news');
		}
	}
	/**
	 * 删除新闻
	 */
	public function delete()
	{
		$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		if($this->m_news->news_delete($id))
		{
			echo "success";
		}
	}
	public function mark()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		if($this->m_news->mark($id,$type=='down'))
		{
			echo "success";
		}
	}
	
	/**
	 * 根据日期范围、类型范围 获取新闻内容
	 * start	开始日期
	 * end		结束日期
	 * type		类型ID数据，新闻按数组顺序显示
	 * info		内容模糊查询
	 */
	function _get_info($start,$end,$type=array(),$info = '')
	{
		if(count($type)==0)
		{
			return "<font color='red'>暂无新闻</font>";
		}
		//获取新闻内容
		$where = array(
					'start' => $start,
					'end'	=> $end,
					'info'	=> $info,
					'ids'	=> $type,
					'state'	=> '1'
				);
		$re = $this->m_news->news_list($where);
		
		if(count($re)==0)
		{
			return "<font color='red'>暂无新闻</font>";
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
							$data .= "<p><strong>".$type_hash[$d]."</strong></p>";
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
		return $data;
		/*		
		$type_list = array();//新闻类型排序
		$info_top = "";		//发布的头内容
		$info_footer = "";	//发布的尾内容
		if($start==$end)
		{
			//一天数据按发布顺序排序
			$type_publish = $this->m_news->get_publish($start);
			if(is_array($type_publish) && count($type_publish)>0)
			{
				$tmp = $type_publish[0];
				$info_top = $tmp->info_top;
				$info_footer = $tmp->info_footer;
				$tmp = explode(',',$tmp->info);
				if(is_array($tmp))
				{
					foreach($tmp as $v)
					{
						$type_list[$v] = $types[$v];
					}
				}
			}
		}
		else
		{
			//多日数据按默认排序
			$type_list = $types;
		}
		
		$data = "";
		if(is_array($type_list))
		{
			foreach($type_list as $key => $tname)
			{
				if(isset($news[$key]) && is_array($news[$key]))
				{
					
					$data .= "<p><strong>【".$tname."】</strong></p>";
					foreach($news[$key] as $val)
					{
						$data .= $val->info;
					}
				}
			}
		}
		if(!$info_top)$info_top = "";
		if(!$info_footer)$info_footer = "";
		if($retype=='arr')
		{
			if($data=='')
			{
				$data = "<font color='red'>暂无新闻</font>";
			}
			$re = array(
					'top'	=> $info_top,
					'info'	=> $data,
					'foot'	=> $info_footer
				);
		}
		else
		{
			if($tf){
				$re = $info_top . $data . $info_footer;
			}
			else
			{
				$re = $data;
			}
			if($re=='')
			{
				$re = "<font color='red'>暂无新闻</font>";
			}
		}
		return $re;*/
	}

	/**
	 * 推送新闻显示页
	 */
	public function download()
	{
		$this->login->check_jurisdict('9',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$date = $this->input->post('date');
		if($date=='')
		{
			$date = date('Y-m-d');
		}
		
		$data = array(
			'date'		=> $date,
			'select'	=> type_select(),
			'groups'	=> $this->m_news_sender->news_group_list()//推送分组
		);		
		
		$type_publish = $this->m_news->get_publish($date);
		
		if(count($type_publish)>0)
		{
			$type_publish = $type_publish[0];
			
			$data['info'] =$type_publish->info_top . $this->_get_info($date,$date,explode(',',$type_publish->info)) . $type_publish->info_footer;
		}
		else
		{
			$data['info'] = '';
		}
		
		/*************上期回顾*************/
		$yesterday = $this->input->post('yesterday');
		if($yesterday=='1')
		{
			$type_yes = $this->m_news->get_publish_prev($date);
			if(count($type_yes)>0)
			{
				$type_yes = $type_yes[0];
				$info_yes =  $this->_get_info($type_yes->p_date,$type_yes->p_date,explode(',',$type_yes->info));
				$info_yes = str_replace("【要闻】","【要闻回顾】",$info_yes);
				//分解去除图片
				$arr = explode('</p>',$info_yes);
				if(is_array($arr))
				{
					foreach($arr as $k => $v)
					{
						$tmp = strip_tags($v);//去除HTML标签
						$tmp = str_replace("&nbsp;", " ", $tmp);
						if(trim($tmp)=='')//非文本
						{
							continue;
						}
						else
						{
							$data['info'] .= $v.'</p>';
						}
					}
				}
			}
		}

		$data['yesterday'] = $yesterday;
		/*************上期回顾*************/
		
		/* 页面Word显示 */
		$this->load->view('news/print',$data);
		$this->load->view('main_footer');
	}
        /**
	 * 微信推送新闻显示页
	 */
	public function wechat_pushview()
	{
		$this->login->check_jurisdict('9',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$date = $this->input->post('date');
		if($date=='')
		{
			$date = date('Y-m-d');
		}
		
		$data = array(
			'date'		=> $date,
			'select'	=> type_select(),
			'groups'	=> $this->m_news_sender->news_group_list()//推送分组
		);		
		
		$type_publish = $this->m_news->get_publish($date);
		
		if(count($type_publish)>0)
		{
			$type_publish = $type_publish[0];
			
			$data['info'] =$type_publish->info_top . $this->_get_info($date,$date,explode(',',$type_publish->info)) . $type_publish->info_footer;
		}
		else
		{
			$data['info'] = '';
		}
		
		/*************上期回顾*************/
		$yesterday = $this->input->post('yesterday');
		if($yesterday=='1')
		{
			$type_yes = $this->m_news->get_publish_prev($date);
			if(count($type_yes)>0)
			{
				$type_yes = $type_yes[0];
				$info_yes =  $this->_get_info($type_yes->p_date,$type_yes->p_date,explode(',',$type_yes->info));
				$info_yes = str_replace("【要闻】","【要闻回顾】",$info_yes);
				//分解去除图片
				$arr = explode('</p>',$info_yes);
				if(is_array($arr))
				{
					foreach($arr as $k => $v)
					{
						$tmp = strip_tags($v);//去除HTML标签
						$tmp = str_replace("&nbsp;", " ", $tmp);
						if(trim($tmp)=='')//非文本
						{
							continue;
						}
						else
						{
							$data['info'] .= $v.'</p>';
						}
					}
				}
			}
		}

		$data['yesterday'] = $yesterday;
		/*************上期回顾*************/
                
		/* 页面Word显示 */
		$this->load->view('news/wachat_push',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 信息推送
	 */
	public function send()
	{
		$this->login->check_jurisdict('9',$this->session->userdata('user_jurisdict'));
		$this->load->helper('pic');
		$test = $this->input->post('test');
		$title = $this->input->post('title');
		$tel = $this->input->post('tel');
		$group = $this->input->post('group');
		$date = $this->input->post('sdate');
		
		if($title=='')
		{
			exit("请填写彩信标题");
		}
		if($test=='true')
		{
			if($tel=='')
			{
				exit("请填写彩信推送测试号码");
			}
		}
		else
		{
			if($group=='')
			{
				exit("请选择推送分组");
			}
			elseif($group=='-1')
			{
				$sender = $this->m_news_sender->news_sender_list();
			}
			else
			{
				$sender = $this->m_news_sender->get_group_sender($group);
			}
			
			if(is_array($sender))
			{
				foreach($sender as $v)
				{
					if($tel!='')$tel .= ",";
					$tel .= $v->mobile;
				}
			}
		}
		
		//$info = '<p><strong>【政策】</strong></p><p>国务院批复天津自贸试验区，涵盖天津港片区、天津机场片区和滨海新区中心商务片区。</p><p><strong>【前沿科技】</strong></p><p><img title="1418959496129520.jpg" alt="20141218前沿科技1.jpg" src="/ueditor/php/upload/image/20141219/1418959496129520.jpg"/></p>';
		//$tel = '13920703837';
		//$title = '颐博站内新闻';

		if($tel=='')
		{
			exit("无推送号码");
		}
		
		$type_publish = $this->m_news->get_publish($date);
		$top = "";
		$foot = "";
		$info = "";
		
		if(count($type_publish)>0)
		{
			$type_publish = $type_publish[0];
			
			$top = $type_publish->info_top;
			$info = $this->_get_info($date,$date,explode(',',$type_publish->info));
			$foot = $type_publish->info_footer;
		}
		
		if($info=='')
		{
			exit("无彩信内容");
		}
		
		//发送彩信时，特殊字符转换
		$send_replace = array(
			'·'	=> '.',
		); 
		
		foreach($send_replace as $s => $re)
		{
			$top = str_replace($s, $re, $top);
			$info = str_replace($s, $re, $info);
			$foot = str_replace($s, $re, $foot);
		}
		
		//拼xml
		$data  = '<?xml version="1.0" encoding="utf-8"?>';
		$data .= '<Body>';
		$data .= '<account>tjybsm</account>';
		$data .= '<password>tjybsm123</password>';
		$data .= '<mms>';
		$data .= '<phonelist>'.$tel.'</phonelist>';
		$data .= '<subject>'.base64_encode($title).'</subject>';
		$data .= '<regulartime></regulartime>';
		$data .= '<pages>';

		$pages = array();
		$type_now = "";
		
		//分解top
		$arr = explode('</p>',$top);
		if(is_array($arr))
		{
			foreach($arr as $k => $v)
			{
				$tmp = strip_tags($v);//去除HTML标签
				$tmp = str_replace("&nbsp;", " ", $tmp);
				if(trim($tmp)=='')//非文本
				{
					if(strpos ($v , '<img ')>0 && strpos ($v , ' src=')>0)//图片
					{
						$src_id		= strpos($v			, ' src=');
						$src_str	= substr($v			, $src_id);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, $src_id+1);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, 1	, $src_id-1);
						//echo $src_str.'<br>';
						$type = substr($src_str,-3);
						
						/*if(!in_array($type,array('jpg','gif')))
						{
							exit('图片只支持jpg、gif');
						}*/
						
						$src = 'sendpic/img'.($k+1).'.jpg';
						
						$regstate = pic_jpg_300($this->config->base_url().$src_str,$src);
						
						if($regstate=='1')
						{
							//图片压缩
							$file=file_get_contents($src);
						}
						else
						{
							//原图
							$file=file_get_contents($this->config->base_url().$src_str);
						}
						
						$img = base64_encode($file);
						
						$pages[] = array(
									'type'	=> 'img',
									'info'	=> '<img type="jpg">'.$img.'</img>'
									);
						$type_now = "img";
					}
					else
					{
						continue;
					}
				}
				else
				{
					
					if($type_now!="txt")
					{
						$pages[] = array(
									'type'	=> 'txt',
									'info'	=> ''
									);
					}
					$c = count($pages)-1;
					$pages[$c]['info'] .= "\n".$tmp;
					$type_now = "txt";
				}
			}
		}
		
		//分解info
		$arr = explode('</p>',$info);
		if(is_array($arr))
		{
			foreach($arr as $k => $v)
			{
				$tmp = strip_tags($v);//去除HTML标签
				$tmp = str_replace("&nbsp;", " ", $tmp);
				if(trim($tmp)=='')//非文本
				{					
					if(strpos ($v , 'img ')>0 && strpos ($v , ' src=')>0)//图片
					{
						$src_id		= strpos($v			, ' src=');
						$src_str	= substr($v			, $src_id);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, $src_id+1);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, 1	, $src_id-1);
						//echo $src_str.'<br>';
						$type = substr($src_str,-3);
						
						/*if(!in_array($type,array('jpg','gif')))
						{
							exit('图片只支持jpg、gif');
						}*/
						
						$src = 'sendpic/img'.($k+1).'.jpg';
						
						$regstate = pic_jpg_300($this->config->base_url().$src_str,$src);
						
						if($regstate=='1')
						{
							//图片压缩
							$file=file_get_contents($src);
						}
						else
						{
							//原图
							$file=file_get_contents($this->config->base_url().$src_str);
						}
						
						$img = base64_encode($file);
						$pages[] = array(
									'type'	=> 'img',
									'info'	=> '<img type="jpg">'.$img.'</img>'
									);
						$type_now = "img";
					}
					else
					{
						continue;
					}
				}
				else
				{
					if($type_now!="txt")
					{
						$pages[] = array(
									'type'	=> 'txt',
									'info'	=> ''
									);
					}
					$c = count($pages)-1;
					$pages[$c]['info'] .= "\n";
					
					if('<strong>'.$tmp.'</strong>'==substr($v,3))
					{
						$pages[$c]['info'] .= "\n";
					}
					else
					{
						$pages[$c]['info'] .= "\n>";
					}
					
					$pages[$c]['info'] .= $tmp;
					$type_now = "txt";
				}
			}
		}
		//分解foot
		$arr = explode('</p>',$foot);
		if(is_array($arr))
		{
			foreach($arr as $k => $v)
			{
				$tmp = strip_tags($v);//去除HTML标签
				$tmp = str_replace("&nbsp;", " ", $tmp);
				if(trim($tmp)=='')//非文本
				{
					if(strpos ($v , 'img ')>0 && strpos ($v , ' src=')>0)//图片
					{
						$src_id		= strpos($v			, ' src=');
						$src_str	= substr($v			, $src_id);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, $src_id+1);
						$src_id		= strpos($src_str	, '"');
						$src_str	= substr($src_str	, 1	, $src_id-1);
						//echo $src_str.'<br>';
						$type = substr($src_str,-3);
						
						/*if(!in_array($type,array('jpg','gif')))
						{
							exit('图片只支持jpg、gif');
						}*/
						
						$src = 'sendpic/img'.($k+1).'.jpg';
						
						$regstate = pic_jpg_300($this->config->base_url().$src_str,$src);
						
						if($regstate=='1')
						{
							//图片压缩
							$file=file_get_contents($src);
						}
						else
						{
							//原图
							$file=file_get_contents($this->config->base_url().$src_str);
						}
						
						$img = base64_encode($file);
						
						$pages[] = array(
									'type'	=> 'img',
									'info'	=> '<img type="jpg">'.$img.'</img>'
									);
						$type_now = "img";
					}
					else
					{
						continue;
					}
				}
				else
				{
					if($type_now!="txt")
					{
						$pages[] = array(
									'type'	=> 'txt',
									'info'	=> ''
									);
					}
					$c = count($pages)-1;
					$pages[$c]['info'] .= "\n".$tmp;
					$type_now = "txt";
				}
			}
		}
				
		/*************上期回顾*************/
		$yesterday = $this->input->post('yesterday');
		if($yesterday=='1')
		{
			$type_yes = $this->m_news->get_publish_prev($date);
			if(count($type_yes)>0)
			{
				$type_yes = $type_yes[0];
				$info_yes =  $this->_get_info($type_yes->p_date,$type_yes->p_date,explode(',',$type_yes->info));
				$info_yes = str_replace("【要闻】","【要闻回顾】",$info_yes);
				
				//分解$info_yes
				$arr = explode('</p>',$info_yes);
				if(is_array($arr))
				{
					foreach($arr as $k => $v)
					{
						$tmp = strip_tags($v);//去除HTML标签
						$tmp = str_replace("&nbsp;", " ", $tmp);
						if(trim($tmp)=='')//非文本
						{					
							continue;
						}
						else
						{
							if($type_now!="txt")
							{
								$pages[] = array(
											'type'	=> 'txt',
											'info'	=> ''
											);
							}
							$c = count($pages)-1;
							$pages[$c]['info'] .= "\n";
							
							if('<strong>'.$tmp.'</strong>'==substr($v,3))
							{
								$pages[$c]['info'] .= "\n";
							}
							else
							{
								$pages[$c]['info'] .= "\n>";
							}
							
							$pages[$c]['info'] .= $tmp;
							$type_now = "txt";
						}
					}
				}
			}
		}		
		/*************上期回顾*************/
		$page = 1;
		if(is_array($pages))
		{
			foreach($pages as $p)
			{
				if($p['type']=="txt")
				{
					$data .= '<page dur="100" order="'.$page.'"><text type="txt">'.base64_encode(iconv( "UTF-8", "gb2312//translit" ,$p['info'])).'</text></page>';
				}
				else
				{
					$data .= '<page dur="100" order="'.$page.'">'.$p['info'].'</page>';
				}
				$page++;
			}
		}
		$data .= '</pages></mms></Body>';
		
		if(count($data)>65*1024)
		{
			exit('内容过长');
		}
		
		$header[] = "Content-type: text/xml";//定义content-type为xml
		$ch = @curl_init();  //初始化
		@curl_setopt($ch, CURLOPT_URL,"http://service.caixinbao.cn/sendMMS");  //设置选项
		@curl_setopt($ch, CURLOPT_POST, true);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: text/xml"));
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$regstate = @curl_exec($ch);  //执行并获取内容
		@curl_close($ch);  //释放curl句柄
		
		//写入数据库
		$arrInsert = array(
			'info'		=> $data,
			're'		=> $regstate,
			'userid'	=> $this->session->userdata('user_id')
		);
		$this->m_news_send->news_send_insert($arrInsert);
		
		$reObj = simplexml_load_string($regstate);
		
		/*
		 //写错误日志方法
		$file = 'testlog.txt';
		$str= "状态值：".$data."\r\n";
		$file_pointer = fopen($file,"a");
		$re=fwrite($file_pointer,$str);
		fclose($file_pointer);
		*/
		switch($reObj->submitstatus)
		{
			case '0000':exit('发送成功');
			case '1001':exit('彩信xml格式有误');
			case '1002':exit('彩信资源文件过大(视频类不能超过100K,其它不能超过80K)');
			case '1003':exit('读取彩信资源文件有误');
			case '1004':exit('彩信标题有误(不能超过30字且不能为空)');
			case '1005':exit('定时时间格式有误');
			case '1006':exit('账户余额不足');
			case '1007':exit('插入发送列表异常');
			case '1008':exit('生成资源文件有误');
			case '1009':exit('没有可发送的手机号码');
			case '1010':exit('电话号码过大(最多可一次提交500,000个手机号码)');
			case '1011':exit('含有敏感词');
			case '1012':exit('短信内容为空');
			case '1013':exit('绑定IP有误');
			case '1014':exit('提交时段错误');
			case '1015':exit('提交密码有误');
			case '1016':exit('提交账号有误');
			case '1017':exit('短信签名有误');
			case '9999':exit('其它错误');
			default:	exit('发送失败');
		}
	}
	/**
	 * 获取彩信余额
	 */
	public function get_mail_num()
	{
		
		$ch = @curl_init();  //初始化
		@curl_setopt($ch, CURLOPT_URL,"http://service.caixinbao.cn/queryBalance?account=tjybsm&password=tjybsm123");  //设置选项
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$regstate = @curl_exec($ch);  //执行并获取内容
		@curl_close($ch);  //释放curl句柄
		echo $regstate;
	}
	
	/**
	 * 信息推送分组管理
	 */
	public function group()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$re = $this->m_news_sender->news_group_list();
		
		$sender = $this->m_news_sender->news_sender_list();
		
		$data = array(
			'list'		=> $re,
			'sender'	=> $sender,
			'select'	=> type_select(),
		);
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		$this->load->view('news/group',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 新增推送分组
	 */
	public function group_add()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$data = array(
			'name' 		=> $this->input->post('name'),
		);
		$tels = $this->input->post('tels');
		if($this->m_news_sender->news_group_insert($data,$tels))
		{
			redirect($this->config->base_url().'index.php/news/group');
		}
	}
	/**
	 * 修改推送分组
	 */
	public function group_update()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		$data = array(
					'name' 		=> $this->input->post('name'),
				);
		$tels = $this->input->post('tels');
		if($this->m_news_sender->news_group_update($id,$data,$tels))
		{
			redirect($this->config->base_url().'index.php/news/group');
		}
	}
	/**
	 * 删除推送分组
	 */
	public function group_delete()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		if($this->m_news_sender->news_group_delete($id))
		{
			echo 'success';
		}
	}
		
	/**
	 * 信息推送号码管理
	 */
	public function sender($page='1',$pageSize='20')
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$where = array(
			'name' 		=> $this->input->post('name'),
			'mobile'	=> $this->input->post('mobile'),
		);
		
		//---------分页------------
		$num = $this->m_news_sender->news_sender_num($where);
		$pages = ceil($num/$pageSize);
		if($page>$pages)$page = $pages;
		if($page<1)$page = 1;
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/index.php/news/sender/';
		$config['total_rows'] = $num ;
		$config['per_page'] = $pageSize; 
		
		$this->pagination->initialize($config); 
		
		$pages = $this->pagination->create_links();
		//---------分页------------
		$re = $this->m_news_sender->news_sender_list($where,($page-1)*$pageSize,$pageSize);
		
		
		$groups = $this->m_news_sender->news_group_list();
		$data = array(
			'list'		=> $re,
			'where'		=> $where,
			'select'	=> type_select(),
			'groups'	=> $groups,
			'pages'		=> $pages,
		);
		$this->load->view('news/sender',$data);
		$this->load->view('main_footer');
	}
	/**
	 * 新增推送号码
	 */
	public function sender_add()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$data = array(
			'name' 		=> $this->input->post('name'),
			'mobile'	=> $this->input->post('mobile'),
		);
		$groups = $this->input->post('group');
		if($this->m_news_sender->news_sender_insert($data,$groups))
		{
			redirect($this->config->base_url().'index.php/news/sender');
		}
	}
	/**
	 * 修改推送号码
	 */
	public function sender_update()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'));
		
		$id = $this->input->post('id');
		$data = array(
					'name' 		=> $this->input->post('name'),
					'mobile'	=> $this->input->post('mobile'),
				);
		$groups = $this->input->post('groups');
		if($this->m_news_sender->news_sender_update($id,$data,$groups))
		{
			redirect($this->config->base_url().'index.php/news/sender');
		}
	}
	/**
	 * 删除推送号码
	 */
	public function sender_delete()
	{
		$this->login->check_jurisdict('10',$this->session->userdata('user_jurisdict'),true);
		
		$id = $this->input->post('id');
		if($this->m_news_sender->news_sender_delete($id))
		{
			echo 'success';
		}
	}

	/**
	 * 根据分组获取号码
	 */
	public function group_sender()
	{
		$id = $this->input->post('id');
		$re = $this->m_news_sender->news_sender_group('group_id',$id);
		$arr = array();
		if(is_array($re))
		{
			foreach($re as $v)
			{
				$arr[] = $v->sender_id;
			}
		}
		echo implode(',',$arr);
	}
	/**
	 * 根据号码获取分组
	 */
	public function sender_group()
	{
		$id = $this->input->post('id');
		$re = $this->m_news_sender->news_sender_group('sender_id',$id);
		$arr = array();
		if(is_array($re))
		{
			foreach($re as $v)
			{
				$arr[] = $v->group_id;
			}
		}
		echo implode(',',$arr);
	}
	
	/**
	 * 领导发表点评
	 */
	public function comment()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'),true);
		$this->load->model('m_news_comment');
		$isedit = $this->input->post('isedit');
		$data = array('info' => $this->input->post('info'));
		if($data['info']=='')
		{
			exit('请填写点评内容');
		}
		if($isedit=='true')
		{
			$ndate	= $this->input->post('ndate');
			$userid	= $this->session->userdata('user_id');
			$re = $this->m_news_comment->news_comment_update($ndate,$userid,$data);
		}
		else
		{
			$data['ndate'] 	= $this->input->post('ndate');
			$data['userid']	= $this->session->userdata('user_id');
			$data['addtime']= date('Y-m-d H:i:s');

			if($data['ndate']=='')
			{
				exit('请填写点评新闻的日期');
			}
			$re = $this->m_news_comment->news_comment_insert($data);
		}
		if($re)
		{
			echo 'success';
		}
		else
		{
			echo '点评失败';
		}
	}
	/**
	 * 根据日期获取领导点评内容
	 */
	function _get_comment_by_date($date)
	{
		$this->load->model('m_news_comment');
		$list = $this->m_news_comment->news_comment_list($date);
		
		$re = '';
		if(is_array($list))
		{
			foreach($list as $v)
			{
				$re.= '<p><strong>'.$v->name.':</strong>'.str_replace("\n", "<br />", $v->info).'</p>';
			}
		}
		if($re!='')
		{
			$re = '<p> * * * * * * * * * * * * * * * * * * * * </p><p><strong>【点评】</strong></p>'.$re;
		}
		return $re;
	}
	/**
	 * 获取一个人一天的评价信息
	 */
	public function comment_get()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'),true);
		$this->load->model('m_news_comment');
		$ndate = $this->input->post('ndate');
		$info = $this->m_news_comment->news_comment_get($ndate,$this->session->userdata('user_id'));
		
		if(count($info)>0)
		{
			echo $info[0]['info'];
		}
		else
		{
			echo '';
		}
	}
	
	/**
	 * 获取一天的所有评价
	 */
	public function comment_manage()
	{
		$this->login->check_jurisdict('16',$this->session->userdata('user_jurisdict'),true);
		$this->load->model('m_news_comment');
		$ndate = $this->input->post('ndate');
		$list = $this->m_news_comment->news_comment_list($ndate);
		
		echo json_encode($list);
	}
	
	/**
	 * 删除一个人一天的评价信息
	 */
	public function comment_delete()
	{
		$this->login->check_jurisdict('11',$this->session->userdata('user_jurisdict'),true);
		$this->load->model('m_news_comment');
		$ndate = $this->input->post('ndate');
		if($this->m_news_comment->news_comment_delete($ndate,$this->session->userdata('user_id')))
		{
			echo 'success';
		}
		else
		{
			echo '删除失败';
		}
	}
	
	/**
	 * 删除一条评价信息
	 */
	public function comment_del()
	{
		$this->login->check_jurisdict('16',$this->session->userdata('user_jurisdict'),true);
		$this->load->model('m_news_comment');
		$id = $this->input->post('id');
		if($this->m_news_comment->news_comment_del($id))
		{
			echo 'success';
		}
		else
		{
			echo '删除失败';
		}
	}
	/**
	 * 
	 */
    function _get_tree_list($arr)
    {
		$opts = array();
		$parent = '';
		$key_now = 0;
		
		if(is_array($arr))
		{
			foreach($arr as $v)
			{
				if($parent!=$v->parent)
				{
					if(is_array($opts)){
						foreach($opts as $k => $p)
						{
							if($v->parent == $p->id)
							{
								$key_now = $k+1;
								break;
							}
						}
					}
				}
				else
				{
					$key_now ++;
				}
				$parent = $v->parent;
				for($i=count($opts);$i>$key_now;$i--)
				{
					$opts[$i] = $opts[$i-1];					
				}
				$opts[$key_now] = $v;
			}
		}
		return $opts;
    }
    /**
     * 
     */
    function _get_tree_option($arr,$id=0,$max=0)
    {
		$opts = $this->_get_tree_list($arr);
		$html = '';
		if(is_array($opts))
		{
			foreach($opts as $v)
			{
				$d = explode('.',$v->detail);
				if($max>0 && count($d)>$max)//双层限制
				{
					continue;
				}
				$html .= '<option value="'.$v->id.'" ';
				if($v->id==$id)
				{
					$html .= ' selected ';
				}
				$html .= '>';
				for($i=1;$i<count($d);$i++)
				{
					$html .= "&nbsp;&nbsp;";
				}
				$html .= $v->name.'</option>';
			}
		}
        return $html;
    }
    
    public function monthly_report()
    {
    	$this->login->check_jurisdict('8',$this->session->userdata('user_jurisdict'));
		
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
		$month = $this->input->post('month');
		if($month=='')
		{
			$month = date("Y-m");
		}
		$month = date("Y-m",strtotime($month));
		
		//$info = "<font color='red'>暂无新闻</font>";
		$id = 0;
		$info = '';
		$this->load->model('m_news_monthly_report');
		$re = $this->m_news_monthly_report->report_info($month);
		if(isset($re->id))
		{
			$info = $re->url;;
			$id = $re->id;
		}
		
		$start = $month.'-01';
		$end = date('Y-m-t',strtotime($start));
		
		$types = $this->m_news->get_type_used($start,$end);
		//树形数组
		$tree = $this->m_news_type->news_type_tree($types);

		//生成树
		$this->load->helper('tree');

		$data = array(
			'month'		=> $month,
			'info'		=> $info,
			'id'		=> $id,
			'tree'		=> tree_ncheck($tree),
			'select'	=> type_select(),
		);
		$this->load->view('news/monthly_report',$data);
		$this->load->view('main_footer');
    }
    
    public function monthly_publish()
    {
    	$id = $this->input->post('id');
    	
    	$data = array(
    		'month'		=> $this->input->post('month'),
    		'addtime'	=> date('Y-m-d H:i:s'),
    		'userid'	=> $this->session->userdata('user_id'),
    		'url'		=> $this->input->post('fileToUpload')
    	);
    	
    	$this->load->model('m_news_monthly_report');
    	if($id=='0')
    	{
    		$re = $this->m_news_monthly_report->report_insert($data);
    	}
    	else
    	{
    		$re = $this->m_news_monthly_report->report_update($id,$data);
    	}
    	
    	if($re)
    	{
    		echo "发布成功";
    	}
    	else
    	{
    		echo "发布失败";
    	}
    }
    
    public function monthly_data()
    {
    	$ids = $this->input->post('ids');
    	
    	$month = $this->input->post('month');
		$month = date("Y-m",strtotime($month));
		
    	$start = $month.'-01 00:00:00';
		$end = date('Y-m-t',strtotime($start)).' 23:59:59';
		
    	echo $this->_get_info($start,$end,explode(',',$ids));
    }
    
    public function monthly_view()
    {
		$this->load->view('main_header');
		$this->load->view('main_menu',array('menu'=>'news'));
		
    	$month = $this->input->post('month');
    	if($month=='')
		{
			$month = date("Y-m");
		}
		$month = date("Y-m",strtotime($month));
		
		$this->load->model('m_news_monthly_report');
		$info = $this->m_news_monthly_report->report_info($month);
		if(isset($info->id))
		{
			$info	= $info->url;
		}
		else
		{
			$info 	= "";
		}
		
		$data = array(
			'month'		=> $month,
			'info'		=> $info,
			'select'	=> type_select(),
		);
		$this->load->view('news/monthly_view',$data);
		$this->load->view('main_footer');
    }
    /*
     * 推送信息——其他信息删除
     */
    
     public function other_del()
    {
        $id = $this->input->post('id');

        //判断是否有该信息
        $res = $this->m_news_other->get_field(FALSE, array('id' => $id));

        //企业下假删除的数量
      
        if (!empty($res)) {
  
                $this->m_news_other->del($id);
                echo 'success'; 
        } else {
                echo 'false';
        }
    }
    /*
     * 微信推送——其他信息修改
     */
    
    public function other_edit()
    {
        $dataArr = $this->m_news_other->get_field($_POST['mid']);

            $data = array(
               'title' => $_POST['othertitle'],
                'author' => $_POST['author'],
                'show_cover_pic' => $_POST['imgfile1'],
                'digest' => $_POST['digest'],
                'content_source_url' => $_POST['content_source_url'],
                'content' => $_POST['content'],
                'addtime' => time()  
            );
        
           
        

        $rel = $this->m_news_other->edit($_POST['mid'], $data);

        if ($rel) {
            redirect('news/wechat_pushview');
        } else {
            echo "<script>alert('操作失败')</script>";
        }
    }
    
    /*
     * 微信推送——其他信息添加
     */
      public function other_add()
    {
            $show_cover_pic = $_POST['imgfile1'];
            $data = array(
                'title' => $_POST['othertitle'],
                'author' => $_POST['author'],
                'show_cover_pic' => $show_cover_pic,
                'digest' => $_POST['digest'],
                'content_source_url' => $_POST['content_source_url'],
                'content' => $_POST['content'],
                'addtime' => time()     
            );
            //添加数据成功
            if ($this->m_news_other->add($data)) {
                redirect('news/wechat_pushview');
            } else {
                echo "<script>alert('操作失败')</script>";
            }
        
    }
    /**
	 * 上传图片
	 */
	public function other_pic()
	{
    	//上传
    	$config['upload_path'] = './uploads/othernews/';
    	$config['allowed_types'] = 'jpg';
        $config['file_name'] = date('YmdHis',time()).rand(1,99);
    	$config['max_size'] = '64';
    	$config['max_width'] = '2048';
    	$config['max_height'] = '1024';

    	$this->load->library('upload', $config);
    	
    	$load = $this->upload->do_upload('i_file');

    	if (!$load) 
    	{
            $errors=$this->upload->display_errors();
            $error1="<p>The file you are attempting to upload is larger than the permitted size.</p>";
            $error2="<p>The filetype you are attempting to upload is not allowed.</p>";
            if($errors==$error1){
             echo "<script>parent.pic_back('1');</script>";  
            }elseif($errors==$error2){
               echo "<script>parent.pic_back('2');</script>";  
            }else{
               echo "<script>parent.pic_back('0');</script>"; 
            }

    	} 
    	else
    	{
    		$data = $this->upload->data();
    		$logo = $data['full_path'];
    		$picArr = explode('/uploads/', $logo);
    		$logo = '/uploads/' . $picArr[1];
    		
	    	$pic = isset($logo) ? $logo : '';
	    	echo "<script>parent.pic_back('".$pic."');</script>";
    	}
	}
    /*
     * 微信推送——其他信息列表
     */
    public  function other_list(){
        $nowlist=$this->m_news_other->get_nowlist();
        $list=array();
        foreach($nowlist as $value){
            $value['addtime']=date("Y-m-d H:i:s",$value['addtime']);
            $list[]=$value;
        }
        $data=array();
        if(isset($list)&&!empty($list)){
           $data['mess']="succ";
           $data['data']=$list;
        }else{
           $data['mess']="false"; 
        }
        $data=json_encode($data);
        echo $data ;
    }
    /*
    * 微信推送——其他信息查看
    */
    public function other_check()
    {
        $id = $_POST['id'];
        //该主表id的全部信息
        $data = $this->m_news_other->get_field($id );
        echo json_encode($data);
    }
    
    public function test(){
		 if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			 if ($_FILES['file']['type'] != "application/pdf") {
			 	$msg = '请上传 PDF 格式的文件';
			 	$code = 101;
			 	echo json_encode(array('msg'=>$msg,'code'=>$code));
			 } else {
			 	$name = time();
				$url = './uploads/monthlyreport/'.$name.'.pdf';
				$data = '/uploads/monthlyreport/'.$name.'.pdf';
				$result = move_uploaded_file($_FILES['file']['tmp_name'],$url);
				if ($result == 1){
					$msg ="成功上传";
					$code = 100;
					echo json_encode(array('msg'=>$msg,'code'=>$code,'data'=>$data));
				}else{
					$msg = '对不起,上传发生错误 ';
					$code = 101;
					echo json_encode(array('msg'=>$msg,'code'=>$code));
				}
			}
			
		 }
    }
    
	
}

?>