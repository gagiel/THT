<?php
class M_plan_note extends CI_Model {

    var $table_name = 't_plan_note';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
     * plan_work	工作方案根据条件查询
     * @param 	$data	array
     * @return	int
     */
    function get_plan_by_userid($userid)
    {
        if($userid=='-1')
        {
            $this->db->where('state','1');
            $this->db->where('t_end >=',date('Y-m-d H:i:s'));
            $this->db->where('range_type','3');//对外
            $this->db->order_by('t_start','asc');
            $this->db->order_by('t_end','asc');

            $re = $this->db->get($this->table_name);
        }
        else
        {
            $sql =  " select * from ".$this->table_name." " .
                " where state=1 " .
                " and t_end >='".date('Y-m-d H:i:s')."' " .
                " and ( " .
                "   range_type=2 " .
                "   or " .
                "   ( " .
                "      range_type=1 " .
                "      and " .
                "      concat(',',range_user,',') like '%,".$userid.",%' " .
                "   ) " .
                " ) " .
                " order by t_start,t_end";
            $re = $this->db->query($sql);
        }
        return $re->result();
    }

    /**
     * plan_insert	新增活动方案
     * @param 	$data	array
     * @return	int
     */
    function plan_insert($data)
    {
        return $this->db->insert($this->table_name,$data);
    }
    function plan_insert_fankui($data)
    {
        return $this->db->insert('t_plan_fankui',$data);
    }
    /**
     * plan_insert	新增活动方案并获取id
     * @param 	$data	array
     * @return	int
     */
    function plan_insert_id($data)
    {
        return $this->db->insert_id($this->table_name,$data);
    }
    /**
     *
     * 获取活动方案详情
     */
    function plan_show($id)
    {
        $this->db->where('id',$id);
        $data= $this->db->get($this->table_name)->row();
        return $data;

    }

    /**
     * plan_update	修改活动方案
     * @param $id int 活动方案ID
     * @param $data array
     * @return float
     */
    function plan_update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table_name,$data);
    }

    /**
     * plan_update_by_id	批量修改活动方案
     * @param $id array 活动方案ID
     * @param $data array
     * @return float
     */
    function plan_update_by_id($idArr,$data)
    {
        $this->db->where_in('id',$idArr);
        return $this->db->update($this->table_name,$data);
    }

    /**
     * plan_delete	删除活动方案
     * @param $id int 活动方案ID
     * @return float
     */
    function plan_delete($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table_name);
    }

    /**
     *
     */
    function plan_state($id,$state)
    {
        $this->db->trans_start();

        $plan = $this->plan_get(array('id'=>$id));

        $this->db->where('id',$id);
        $this->db->update($this->table_name,array('state'=>$state));

        $table_remind = 't_remind_copy';

        $this->db->where('plan_id',$id);
        if($state=='1')
        {
            //发布
            $this->db->select('*');
            $re = $this->db->get($table_remind);
            if($re->num_rows()>0)
            {
                $this->db->where('plan_id',$id);
                $data = array(
                    'info'			=> $plan->title,
                    't_end'			=> $plan->start,
                    'range_user'	=> $plan->users,
                    'state'			=> $state,
                );
                $this->db->update($table_remind,$data);
            }
            else
            {
                $time = date('Y-m-d H:i:s');
                $data = array(
                    'info'			=> $plan->title,
                    't_start'		=> $time,
                    't_end'			=> $plan->start,
                    'userid'		=> $plan->creater,
                    'range_type'	=> '1',
                    'range_user'	=> $plan->users,
                    'state'			=> '1',
                    'addtime'		=> $time,
                    'plan_id'		=> $plan->id,
                );

                $this->db->insert($table_remind,$data);
            }
        }
        else
        {
            //撤销
            $this->db->update($table_remind,array('state'=>$state));
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * plan_num	获取新闻数量
     */
    function plan_num($where)
    {
        $this->db->select('*');

        if(isset($where['title']) && $where['title']!='')
        {
            $this->db->like('title',$where['title']);
        }
        if(isset($where['start']) && $where['start']!='')
        {
            $this->db->where('start >=',$where['start'].' 00:00:00');
        }
        if(isset($where['end']) && $where['end']!='')
        {
            $this->db->where('start <=',$where['end'].' 23:59:59');
        }
        if(isset($where['state']) && $where['state']!='')
        {
            $this->db->where_in('state',$where['state']);
        }
        $this->db->where('isdel',0);
        $this->db->order_by('start','desc');
        $re = $this->db->get($this->table_name);

        return $re->num_rows();
    }

    //获取满足条件的活动方案数量
    public function get_plan_num($value){
        $this->db->select('*');
        $this->db->where('state',1); //查询状态是已发布
        $this->db->like('title',$value);
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }

    /**
     * plan_list	活动方案列表
     */
    function plan_list()
    {
        $this->db->select('*');
//        $this->db->like("concat(',',users,',')",',1,');
//        $this->db->like("concat(',',fabu_id,',')",',1,');
        $this->db->order_by('addtime','desc');
        $re = $this->db->get($this->table_name);
        $plan_list=$re->result();
        return $plan_list;
    }

    /**
     * plan_get	获取指定活动方案信息
     */
    function plan_get($where,$type='obj')
    {
        $this->db->select('*');
        if(is_array($where))
        {
            foreach($where as $key => $val)
            {
                $this->db->where($key,$val);
            }
        }
        $re = $this->db->get($this->table_name);
        if($type=='arr')
        {
            $data = $re->result_array();
        }
        else
        {
            $data = $re->result();
        }
        return $data[0];
    }

    function max_num()
    {
        $this->db->select('max(c_num) as num');
        $this->db->like('num',date('Y'),'befor');
        $re = $this->db->get($this->table_name);
        if($re->num_rows()>0)
        {
            $data = $re->result_array();
            return $data[0]['num']+1;
        }
        else
        {
            return '1';
        }
    }

    /**
     *
     * 获取活动方案列表
     */
    function plan_select($value,$start,$pageSize){
        $this->db->select('*');
        $this->db->where('state',1); //查询状态是已发布
        $this->db->like('title',$value);
        $this->db->limit($pageSize,$start);
        $data = $this->db->get($this->table_name)->result();
        return $data;
    }
}
?>