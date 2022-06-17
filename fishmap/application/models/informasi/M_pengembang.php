<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_pengembang extends AplicationModel
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

    //get total pengembang
    function get_total_pengembang($params) 
    {
        $sql = "SELECT COUNT(*) 'total' FROM post 
                WHERE post_category = ? AND post_title LIKE ? AND post_date LIKE ? 
                AND deleted_at IS NULL";                
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result['total'];
        } else {
                return array();
        }
    }

    // get all pengembang
    public function get_pengembang($params = '', $limit = '')
    {                                
        $sql = "SELECT * FROM post 
                WHERE post_category = ? AND post_title LIKE ? AND post_date LIKE ? 
                AND deleted_at IS NULL";                
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

}
