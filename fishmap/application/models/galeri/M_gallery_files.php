<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_gallery_files extends AplicationModel
{    
    // construct
    function __construct()
    {
        parent::__construct();
    }

    // count gallery_files
    public function count_gallery_files($params)
    {        
        $sql = "SELECT COUNT(*) AS 'total' 
                FROM gallery_album b      
                INNER JOIN (
                    SELECT * FROM gallery_files a
                    WHERE a.album_id = ?
                ) c
                ON b.album_id = c.album_id                                         
                WHERE c.deleted_at IS NULL    
                ";   
        $query = $this->db->query($sql,$params);        
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];            
        }
        return 0;
    }

    // get all gallery_files
    public function get_gallery_files($params = '', $limit = '')
    {                                        
        $sql = "SELECT *
                FROM gallery_album b      
                INNER JOIN (
                    SELECT * FROM gallery_files a
                    WHERE a.album_id = ?
                ) c
                ON b.album_id = c.album_id                                         
                WHERE c.deleted_at IS NULL                 
                ";           
        if(! empty($limit)){
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

    // get id album
    public function get_id_album($album_id)
    {
        $sql = "SELECT * FROM gallery_album
                WHERE album_id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $album_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get id file
    public function get_id_file($file_id)
    {
        $sql = "SELECT * FROM gallery_files
                WHERE file_id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $file_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }
 
}
