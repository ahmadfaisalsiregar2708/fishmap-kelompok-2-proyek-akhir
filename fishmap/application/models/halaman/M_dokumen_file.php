<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_dokumen_file extends AplicationModel
{    
    protected $primary_key = 'doc_id';
    protected $table_name = 'dokumen_file';

    // construct
    function __construct()
    {
        parent::__construct();
    }

    // count dokumen_file
    public function count_dokumen_file($params)
    {        
        $sql = "SELECT COUNT(*) AS 'total' 
                FROM dokumen_kategori b      
                INNER JOIN (
                    SELECT * FROM dokumen_file a
                    WHERE a.doc_title LIKE ? AND a.cat_id = ?
                ) c
                ON b.cat_id = c.cat_id                                         
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

    // get all dokumen_file
    public function get_dokumen_file($params = '', $limit = '')
    {                                        
        $sql = "SELECT *
                FROM dokumen_kategori b      
                INNER JOIN (
                    SELECT * FROM dokumen_file a
                    WHERE a.doc_title LIKE ? AND a.cat_id = ?
                ) c
                ON b.cat_id = c.cat_id                                         
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

    // get id file
    public function get_id_file($doc_id)
    {
        $sql = "SELECT * FROM dokumen_file
                WHERE doc_id = ? 
                AND deleted_at IS NULL";
        $query = $this->db->query($sql, $doc_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get all dokumen_file
    public function get_dokumen_files($params = '', $limit = '')
    {                                        
        $sql = "SELECT *
                FROM dokumen_kategori b      
                INNER JOIN (
                    SELECT * FROM dokumen_file a
                    WHERE a.doc_title LIKE ? AND a.doc_year LIKE ? AND a.cat_id = ?
                ) c
                ON b.cat_id = c.cat_id                                         
                WHERE c.deleted_at IS NULL ORDER BY c.doc_year DESC             
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
 
}
