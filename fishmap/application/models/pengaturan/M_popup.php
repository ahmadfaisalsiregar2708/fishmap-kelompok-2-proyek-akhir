<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_popup extends AplicationModel
{
    protected $use_deleted_at = false;
    protected $timestamps = true;
    // construct
    function __construct()
    {
        parent::__construct();
    }

    //get total slide
    function get_total_popup($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM popup 
                WHERE title LIKE ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }

    // get all slide
    public function get_popup($params = '', $limit = '')
    {
        $sql = "SELECT * FROM popup
                WHERE title LIKE ? 
                AND deleted_at IS NULL";
        if (!empty($limit)) {
            $sql .= " LIMIT ?, ?";
            $params = array_merge($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get id slide
    public function get_id_popup($slide_id)
    {
        $sql = "SELECT * FROM popup
                WHERE id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $slide_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function slide_index($params = null)
    {
        $sql = "SELECT * FROM slide  WHERE slide_active = '1' AND deleted_at IS NULL
                ORDER BY slide_stiky DESC, created_at DESC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get all slide
    public function get_popup_public($params = '', $limit = '')
    {
        $sql = "SELECT * FROM popup
                    WHERE title LIKE ? AND is_active = '1' 
                    AND deleted_at IS NULL";
        if (!empty($limit)) {
            $sql .= " LIMIT ?, ?";
            $params = array_merge($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get all dokumen_file
    public function get_popup_layanan($params = '', $limit = '')
    {
        $sql = "SELECT *
                 FROM popup b      
                 INNER JOIN (
                     SELECT * FROM popup_layanan a
                     WHERE a.name LIKE ? AND a.id = ?
                 ) c
                 ON b.id = c.id                                         
                 WHERE c.deleted_at IS NULL                 
                 ";
        if (!empty($limit)) {
            $sql .= " LIMIT ?, ?";
            $params = array_merge($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get all dokumen_file
    public function get_popup_layanan_public($params = '', $limit = '')
    {
        $sql = "SELECT *
                 FROM popup b      
                 INNER JOIN (
                     SELECT * FROM popup_layanan a
                     WHERE a.name LIKE ?
                 ) c
                 ON b.id = c.id                                         
                 WHERE c.deleted_at IS NULL And is_active = '1'                
                 ";
        if (!empty($limit)) {
            $sql .= " LIMIT ?, ?";
            $params = array_merge($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // insert pop up layana
    public function insert_layanan($data)
    {
        if ($this->timestamps) {
            if (!array_key_exists('created_at', $data)) {
                $data['created_at'] = date('Y-m-d H:i:s');
            }
            if (!array_key_exists('created_by', $data)) {
                $data['created_by'] = $this->com_user['user_id'];
            }
        }
        return $this->db->insert('popup_layanan', $data);
    }

    // get id layanan
    public function get_id_layanan($slide_id)
    {
        $sql = "SELECT * FROM popup_layanan
                  WHERE pop_id = ? 
                  AND deleted_at IS NULL";
        $query = $this->db->query($sql, $slide_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // update file layanan
    public function edit_file_proccess_layanan($data, $where)
    {
        // if (empty($foreign)) {
        //     $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        // }
        if ($this->timestamps) {
            if (!array_key_exists('updated_at', $data)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
            }
            if (!array_key_exists('updated_by', $data)) {
                $data['updated_by'] = $this->com_user['user_id'];
            }
        }
        return $this->db->update('popup_layanan', $data, $where);
    }

    //  Delete popup layanan
    public function delete_proccess_layanan($where)
    {
        return $this->db->update('popup_layanan', ['deleted_at' => date('Y-m-d H:i:s')], $where);
    }
}
