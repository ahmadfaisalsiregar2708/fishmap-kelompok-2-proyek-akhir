<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_layanan extends AplicationModel
{
    protected $use_deleted_at = false;
    protected $timestamps = false;
    // construct
    function __construct()
    {
        parent::__construct();
    }

    //get total layana
    function get_total_layanan($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM layanan 
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

    // get all layanan
    public function get_layanan($params = '', $limit = '')
    {
        $sql = "SELECT * FROM layanan
                WHERE title LIKE ?
                AND deleted_at IS NULL ORDER BY position ASC";
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

    // get id layanan
    public function get_id_layanan($layanan_id)
    {
        $sql = "SELECT * FROM layanan
                WHERE layanan_id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $layanan_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get data layanan front end
    public function get_layanan_front_end()
    {
        $sql = "SELECT * FROM layanan
                WHERE layanan_active = '1' 
                AND deleted_at IS NULL ORDER BY layanan_id DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }
    // get data layanan front end
    // get all berita
    public function get_layanan_beranda($params = '', $limit = '')
    {
        $sql = "SELECT * FROM layanan
                 WHERE layanan_active LIKE ?
                 AND deleted_at IS NULL ORDER BY layanan_id DESC";
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
}
