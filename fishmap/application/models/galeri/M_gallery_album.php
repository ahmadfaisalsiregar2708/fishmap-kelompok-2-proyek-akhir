<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_gallery_album extends AplicationModel
{
    protected $primary_key = 'album_id';
    protected $table_name = 'gallery_album';

    // construct
    function __construct()
    {
        parent::__construct();
    }

    //get total data 
    function get_total_data($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM gallery_album
                WHERE album_type = ? AND album_title LIKE ? 
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

    // get all gallery_album
    public function get_gallery_album($params = '', $limit = '')
    {
        $sql = "SELECT * FROM gallery_album
                WHERE album_type = ? AND album_title LIKE ?
                AND deleted_at IS NULL ORDER BY album_id DESC";
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

    // get album
    public function getAlbum($params = null, $limit = '')
    {
        $sql = "SELECT a.*, COUNT(b.file_id) jumlah, MAX(a.created_at) last_post, b.file_path, b.file_url FROM gallery_album a
                LEFT JOIN gallery_files b USING(album_id)
                WHERE a.album_type = ? AND a.deleted_at IS NULL AND b.deleted_at IS NULL
                GROUP BY a.album_id ORDER BY last_post DESC";
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
