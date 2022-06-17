<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_user extends AplicationModel
{
    protected $primary_key = 'user_id';
    protected $table_name = 'com_user';

    function __construct()
    {
        parent::__construct();
    }

    function getPengguna($params = '', $limit = '', $isCount = '')
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm FROM com_user a 
            LEFT JOIN com_role_user b USING (user_id)
            LEFT JOIN com_role c USING (role_id)
            WHERE b.role_id = ? AND a.deleted_at IS NULL";
        if(! empty($limit)){
            $sql .= " LIMIT ?, ?";
            $params[] = $limit[0];
            $params[] = $limit[1];
            // array_push($params, $limit);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            if($isCount){
                $result = count($result);
            }
            return $result;
        } else {
            return [];
        }
    }

    function insertRole($params = null, $type = '')
    {
        $this->db->delete('com_role_user', ['user_id'=>$params['user_id']]);
        if(empty($type)){
            $rs = $this->db->insert('com_role_user', $params);
        } else {
            $rs = $this->db->insert_batch('com_role_user', $params);
        }
        return $rs;
    }

    function getAccountDetail($params = null)
    {
        $sql = "SELECT * FROM com_user a 
            LEFT JOIN users b USING (user_id)
            WHERE a.user_id = ? AND a.deleted_at IS NULL";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    function getAccountDetailUsername($params = null)
    {
        $sql = "SELECT * FROM com_user a 
            LEFT JOIN users b USING (user_id)
            WHERE a.user_name = ? AND a.deleted_at IS NULL";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    function updateBiodata($params = null, $where = null)
    {
        $query = $this->db->update('users', $params, $where);
        return $query;
    }

    function insertBiodata($params = null)
    {
        $query = $this->db->insert('users', $params);
        return $query;
    }
}
