<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_post_file extends AplicationModel
{
    protected $primary_key = 'file_id';
    protected $table_name = 'post_file';            
    protected $select = '*';

    // construct
    function __construct()
    {
        parent::__construct();
    }

    // get all post_file
    public function get_post_file($post_id)
    {                                        
        $sql = "SELECT * FROM post_file
                WHERE post_id = ?                         
                AND deleted_at IS NULL
        ";                           
        $query = $this->db->query($sql, $post_id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    } 
       
}
