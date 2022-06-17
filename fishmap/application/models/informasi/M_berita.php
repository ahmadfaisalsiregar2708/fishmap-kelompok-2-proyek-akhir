<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_berita extends AplicationModel
{
    protected $primary_key = 'post_id';
    protected $table_name = 'post';
    protected $order_by = 'post_date';
    protected $select = '*';

    // construct
    function __construct()
    {
        parent::__construct();
    }

    //get total berita
    function get_total_berita($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM post 
                WHERE post_category = ? AND post_title LIKE ? AND post_date LIKE ? 
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

    // get all berita
    public function get_berita($params = '', $limit = '')
    {
        $sql = "SELECT * FROM post 
                WHERE post_category = ? AND post_title LIKE ? AND post_date LIKE ? 
                AND deleted_at IS NULL 
                ORDER BY {$this->order_by} DESC";
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

    // get last order
    public function get_last_order()
    {
        $sql = "SELECT post_order FROM post 
                ORDER BY post_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result[0];
        }
        return [];
    }

    //get total search
    function get_total_search($params)
    {
        $sql = "SELECT COUNT(*) 'total' FROM post 
                WHERE (
                    post_title LIKE ? 
                    OR post_content LIKE ?                     
                    )    
                AND post_status = 'publish'                
                AND post_category != 'tim'   
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

    // get all search
    public function get_search($params = '', $limit = '')
    {        
        $sql = "SELECT * FROM post 
                WHERE (
                    post_title LIKE ? 
                    OR post_content LIKE ?                     
                    )                 
                AND post_status = 'publish'
                AND post_category != 'tim'   
                AND deleted_at IS NULL                    
                ORDER BY post_category ASC";                
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
