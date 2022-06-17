<?php
require_once APPPATH . 'models/base/AplicationModel.php';

class M_page extends AplicationModel
{
    protected $primary_key = 'post_id';
    protected $table_name = 'post';

    function __construct()
    {
        parent::__construct();
    }

    // get all post and user
    function getBerita($params = '', $limit = '')
    {
        $sql = "SELECT * FROM com_user b      
                INNER JOIN users d USING(user_id) 
                INNER JOIN (
                    SELECT * FROM post a 
                    WHERE a.post_category = ? AND a.post_status = 'publish'
                    AND a.deleted_at IS NULL 
                ) c
                ON b.user_name = c.post_author                     
                ORDER BY post_date DESC
                ";        
                
        if(! empty($limit)){
            $sql .= " LIMIT ?, ?";
            $params = array_merge($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $a => $b) {
                $result[$a]['post_content']= self::_cutText($result[$a]['post_content']);
            }
            return $result;
        }
        return [];
    }

    // cut text
    private function _cutText($params = null, $panjang = 97)
    {
        $text = strip_tags(htmlspecialchars_decode($params));
        $preview = substr($text, 0, $panjang) . " ... ";
        //
        return $preview;
    }

    // get sidebar
    public function getSidebar()
    {
        $sql = "SELECT post_category, count(*) jml FROM post
                WHERE post_category IN ('artikel', 'berita')
                AND deleted_at IS NULL AND post_status = 'publish'
                GROUP BY post_category ORDER BY post_order ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    // get trend
    public function getTrend()
    {
        $sql = "SELECT a.post_id, a.post_title, a.post_image, a.post_category, a.post_date, a.counter FROM post a
                WHERE a.post_category IN ('artikel', 'berita')
                AND a.deleted_at IS NULL 
                AND a.post_status = 'publish'
                ORDER BY a.counter DESC
                LIMIT 5";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

     // get user post
     function get_user_post($user)
     {        
         $sql = "SELECT * FROM com_user b      
                 INNER JOIN (
                     SELECT * FROM post a
                     WHERE a.post_author LIKE ?
                 ) c
                 ON b.user_name = c.post_author                     
                 ";
 
         $query = $this->db->query($sql, $user);
         if ($query->num_rows() > 0) {
             $result = $query->result_array();
             $query->free_result();
             return $result;
         } else {
             return [];
         }
     }

     public function get_page($params)
     {
         $sql = "SELECT * FROM post 
                WHERE post_id = ? AND post_title LIKE ? 
                AND post_status = 'publish' AND deleted_at IS NULL";
         $query = $this->db->query($sql, $params);
         if ($query->num_rows() > 0) {
             $result = $query->row_array();
             $query->free_result();
             return $result;
         }
         return [];
     }
     
}