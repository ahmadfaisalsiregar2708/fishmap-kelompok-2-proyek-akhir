<?php

class M_menu extends CI_Model
{

    public function get_menu($group_id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('group_id', $group_id);
        $this->db->order_by('parent_id , position');
        $query = $this->db->get();
        $res = $query->result();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * Get group title
     *
     * @param int $group_id
     * @return string
     */
    public function get_menu_group_title($group_id)
    {
        $this->db->select('*');
        $this->db->from('menu_group');
        $this->db->where('id', $group_id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get all items in menu group table
     *
     * @return array
     */
    public function get_menu_groups()
    {
        $this->db->select('*');
        $this->db->from('menu_group');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_menu_group($data)
    {
        if ($this->db->insert('menu_group', $data)) {
            $response['status'] = 1;
            $response['id'] = $this->db->Insert_ID();
            return $response;
        } else {
            $response['status'] = 2;
            $response['msg'] = 'Add group error.';
            return $response;
        }
    }

    public function get_row($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get the highest position number
     *
     * @param int $group_id
     * @return string
     */
    public function get_last_position($group_id)
    {
        $pos;
        $this->db->select_max('position');
        $this->db->from('menu');
        $this->db->where('group_id', $group_id);
        $this->db->where('parent_id', '0');
        $query = $this->db->get();
        $data = $query->row();
        $pos = $data->position + 1;
        return $pos;
    }

    /**
     * Recursive method
     * Get all descendant ids from current id
     * save to $this->ids
     *
     * @param int $id
     */
    public function get_descendants($id)
    {
        $this->db->select('id');
        $this->db->from('menu');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $data = $query->row();

        $ids;
        if (!empty($data)) {
            foreach ($data as $v) {
                $ids[] = $v;
                $this->get_descendants($v);
            }
        }
    }

    // Delete the menu
    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('menu');
    }

    // Update MenuController Group
    public function update_menu_group($data, $id)
    {
        if ($this->db->update('menu_group', $data, 'id' . ' = ' . $id)) {
            return true;
        }
    }

    // Delete MenuController Group
    public function delete_menu_group($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('menu_group');
    }

    // Delete Menu
    public function delete_menus($id)
    {
        $this->db->where('group_id', $id);
        return $this->db->delete('menu');
    }

    // List Menu
    function list($params = null)
    {
        $sql = "SELECT * FROM menu a WHERE a.parent_id = ? ORDER BY position ASC ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // Menu ID
    function menu_id($params = null)
    {
        $sql = "SELECT * FROM menu a WHERE a.id = ? ORDER BY position ASC ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // List Post
    function getList($params)
    {
        $sql = "SELECT *, if(post_category = post_category) post_category FROM post WHERE (post_title LIKE ? OR if(post_category = post_category) LIKE ?)
            AND post_category IN ('halaman', 'berita', 'artikel', 'tim') 
            AND post_status = 'publish' ORDER BY post_id ASC LIMIT 150 ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            $data = array();
            foreach ($result as $b) {
                $data[] = array(
                    "id" => $b['post_category'] . '-' . 'detail' . '/' . $b['post_id'] . '/' . strtolower(str_replace(' ', '-', $b['post_title'])),
                    "text" => "[" . $b['post_category'] . "] " . $b['post_title']
                );
            }
            return $data;
        } else {
            return [];
        }
    }
}
