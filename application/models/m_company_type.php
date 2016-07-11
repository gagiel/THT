<?php
/*
 * 联系人模块
 * 分类管理
 * 连接数据库的模型 数据库：company_type
 */
class M_company_type extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    //搜索条件：通过id
    public function get_field($id = FALSE, $where = FALSE)
    {
        if ($where) {
            $query = $this->db->get_where('t_company_type', $where);
            return $query->result_array();
        }
        if ($id === FALSE) {
            $this->db->order_by('parent', 'asc');
            $this->db->order_by('mark', 'asc');
            $query = $this->db->get('t_company_type');
            return $query->result_array();
        }

        $query = $this->db->get_where('t_company_type', array('id' => $id));
        return $query->row_array();
    }

    /*
     * 增加
     */
    public function add_field()
    {
        $parent = $_POST['parentid'] ? $_POST['parentid'] : 0;

        $data = array(
            'name' => $this->input->post('name'),
            'parent' => $parent,
        );
        $newparent = $parent;

        //插入除继承关系的其它数据 并获得id即newid
        $rel = $this->db->insert('t_company_type', $data);
        $newid = $this->db->insert_id($rel);

        //判断是否有父类 0：没有父类；非0：有父类
        if ($newparent == 0) {
            $detail = $newid;
        } else {
            //获取父类的继承关系
            $query = $this->db->get_where('t_company_type', array('id' => $newparent));
            $parent = $query->row_array();
            $parentDetail = $parent['detail'];
            $detail = $parentDetail . '.' . $newid;
        }

        //更新该新增分类的继承关系
        $newdata = array(
            'detail' => $detail,
            'mark' => $newid
        );

        $this->db->where('id', $newid)->update('t_company_type', $newdata);
        return $detail;
    }

    /*
     * 修改
     */
    public function edit_field()
    {
        $id = $this->input->post('mid');
        $query = $this->db->get_where('t_company_type', array('id' => $id));
        $olddata = $query->row_array();

        if ($olddata['parent'] == $_POST['parent']) {
            $data = array(
                'name' => $this->input->post('name'),
            );
        } else {
            if ($_POST['parent'] == 0) {
                $detail = $id;
            } else {
                $query = $this->db->get_where('t_company_type', array('id' => $_POST['parent']));
                $parent = $query->row_array();
                $parentDetail = $parent['detail'];
                $detail = $parentDetail . '.' . $id;
            }

            $data = array(
                'name' => $this->input->post('name'),
                'parent' => $this->input->post('parent'),
                'detail' => $detail
            );
        }

        return $this->db->where('id', $id)->update('t_company_type', $data);
    }

    /*
     * 删除
     * @param string $id 操作项id
     */
    public function del_field($id)
    {
        return $this->db->where('id', $id)->delete('t_company_type');
    }

    /*
     * 停用与启用功能
     * @param string $id 操作项id
     * @param string $status 该操作项的当前状态
     */
    public function stop_field($id, $status)
    {
        if ($status == 1) {
            return $this->db->where('id', $id)->update('t_company_type', array('status' => 0));
        } else {
            return $this->db->where('id', $id)->update('t_company_type', array('status' => 1));
        }
    }



}

?>