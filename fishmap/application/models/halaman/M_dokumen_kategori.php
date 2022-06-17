<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_dokumen_kategori extends AplicationModel
{
    protected $primary_key = 'cat_id';
    protected $table_name = 'dokumen_kategori';

    // construct
    function __construct()
    {
        parent::__construct();
    }

    // get all dokumen_kategori
    public function get_dokumen_kategori($params = '', $limit = '')
    {
        $sql = "SELECT * FROM dokumen_kategori 
                WHERE cat_title LIKE ?
                AND deleted_at IS NULL";
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

    // get id kategori
    public function get_id_kategori($cat_id)
    {
        $sql = "SELECT * FROM dokumen_kategori
                WHERE cat_id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $cat_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get list kategori
    public function list_kategori()
    {
        $sql = "SELECT a.*, COUNT(b.doc_id) jumlah, MAX(b.created_at) last_update 
                FROM dokumen_kategori a
                LEFT JOIN dokumen_file b USING(cat_id)
                WHERE a.deleted_at IS NULL
                GROUP BY a.cat_id
                ORDER BY last_update DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }
}
