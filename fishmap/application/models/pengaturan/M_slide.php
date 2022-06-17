<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_slide extends AplicationModel
{
    protected $use_deleted_at = false;
    protected $timestamps = false;
    // construct
    function __construct()
    {
        parent::__construct();
    }

    //get total slide
    function get_total_slide($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM slide 
                WHERE slide_nm LIKE ? 
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
    public function get_slide($params = '', $limit = '')
    {
        $sql = "SELECT * FROM slide
                WHERE slide_nm LIKE ? 
                AND deleted_at IS NULL ORDER BY slide_id DESC";
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

    // get id slide
    public function get_id_slide($slide_id)
    {
        $sql = "SELECT * FROM slide
                WHERE slide_id = ? 
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
                ORDER BY slide_stiky DESC, created_at DESC LIMIT 5";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function get_url_produk()
    {
        $sql = "SELECT post_title, post_category, post_id, CONCAT(IF(post_category = post_category), '/',post_id) post_link  FROM post 
        WHERE post_status = 'publish' 
        AND post_category IN ('berita', 'artikel', 'halaman')
        ORDER BY post_category";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function getdata()
    {
        $sql = "SELECT COUNT(*) 'total' FROM slide 
        WHERE slide_active = 1 
        AND deleted_at IS NULL";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
}
