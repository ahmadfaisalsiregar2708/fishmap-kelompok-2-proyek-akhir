<?php
/**
 * Base Model Aplication
 */
class AplicationModel extends CI_Model
{
    protected $primary_key = 'id';
    protected $timestamps = true;
    protected $com_user = [];
    protected $select = '*';

    public function __construct()
    {
        parent::__construct();
        // $this->com_user = $this->tsession->userdata($this->config->item('session_operator_key'));
    }

    public function all()
    {
        $params = [];
        $sql = "SELECT {$this->select} FROM {$this->get_table_name()} WHERE deleted_at IS NULL";
        if (property_exists($this, 'order_by')) {
            $sql .= " ORDER BY {$this->order_by}";
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function get_where($args = [], $excepts = [])
    {
        $params = [];
        $sql = "SELECT {$this->select} FROM {$this->get_table_name()}";
        $index = 0;
        foreach ($args as $field => $value) {
            $sql .= $index == 0 ? " WHERE {$field} = ?" : " AND {$field} = ?";
            array_push($params, $value);
            $index++;
        }
        foreach ($excepts as $field => $value) {
            if (!is_array($value)) {
                $value = [$value];
            }
            foreach ($value as $val) {
                $sql .= $index == 0 ? " WHERE {$field} != ?" : " AND {$field} != ?";
                array_push($params, $val);
                $index++;
            }
        }
        $sql .= " AND deleted_at IS NULL ";
        if (property_exists($this, 'order_by')) {
            $sql .= " ORDER BY {$this->order_by}";
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function get_by_id($id)
    {
        $sql = "SELECT {$this->select} FROM {$this->get_table_name()} WHERE {$this->primary_key} = ? AND deleted_at IS NULL";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function get_by($args = [])
    {
        $params = [];
        $sql = "SELECT {$this->select} FROM {$this->get_table_name()}";
        $index = 0;
        foreach ($args as $field => $value) {
            $sql .= $index == 0 ? " WHERE {$field} = ?" : " AND {$field} = ?";
            $sql .= " AND deleted_at IS NULL";
            array_push($params, $value);
            $index++;
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
        return [];
    }

    public function count_where($args = [])
    {
        $params = [];
        $sql = "SELECT COUNT(*) AS 'total' FROM {$this->get_table_name()}";
        $index = 0;
        foreach ($args as $field => $value) {
            $sql .= $index == 0 ? " WHERE {$field} = ?" : " AND {$field} = ?";
            array_push($params, $value);
            $index++;
        }
        $sql .= " AND deleted_at IS NULL ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        }
        return 0;
    }

    public function is_exists($args = [], $except = [])
    {
        $params = [];
        $sql = "SELECT COUNT(*) AS 'total' FROM {$this->get_table_name()}";
        $index = 0;
        foreach ($args as $field => $value) {
            $sql .= $index == 0 ? " WHERE {$field} = ?" : " AND {$field} = ?";
            array_push($params, $value);
            $index++;
        }
        foreach ($except as $field => $value) {
            $sql .= count($args) == 0 ? " WHERE {$field} != ?" : " AND {$field} != ?";
            array_push($params, $value);
        }
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if ($result['total'] == 0) {
                return false;
            }
        }
        return true;
    }

    public function get_insert_id()
    {
        return $this->db->insert_id();
    }

    public function insert($data)
    {
        if ($this->timestamps) {
            if (!array_key_exists('created_at', $data)) {
                $data['created_at'] = date('Y-m-d H:i:s');
            }
            if (!array_key_exists('created_by', $data)) {
                $data['created_by'] = $this->com_user['user_id'];
            }
        }
        return $this->db->insert($this->get_table_name(), $data);
    }

    public function insert_batch($data)
    {
        if ($this->timestamps) {
            foreach ($data as $key => $value) {
                if (!array_key_exists('created_at', $value)) {
                    $data[$key]['created_at'] = date('Y-m-d H:i:s');
                }
                if (!array_key_exists('created_by', $value)) {
                    $data[$key]['created_by'] = $this->com_user['user_id'];
                }
            }
        }
        return $this->db->insert_batch($this->get_table_name(), $data);
    }

    public function insert_or_update($params)
    {
        $last_key = array_pop(array_keys($params));
        $sql_values = "";
        $sql_fields = "";
        $sql_update = "";
        foreach ($params as $key => $value) {
            if ($key == $last_key) {
                $sql_values .= "?";
                $sql_fields .= " $key";
                $sql_update .= " $key=VALUES($key)";
            } else {
                $sql_values .= "?, ";
                $sql_fields .= " $key, ";
                $sql_update .= " $key=VALUES($key), ";
            }
        }
        $sql = "INSERT INTO {$this->get_table_name()} ($sql_fields) VALUES ($sql_values) ON DUPLICATE KEY UPDATE $sql_update";
        return $this->db->query($sql, $params);
    }

    public function update($data, $where, $foreign = '1')
    {
        if (empty($foreign)) {
            $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        }
        if ($this->timestamps) {
            if (!array_key_exists('updated_at', $data)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
            }
            if (!array_key_exists('updated_by', $data)) {
                $data['updated_by'] = $this->com_user['user_id'];
            }
        }
        return $this->db->update($this->get_table_name(), $data, $where);
    }

    public function delete_force($where)
    {
        return $this->db->delete($this->get_table_name(), $where);
    }

    public function delete($where)
    {
        return $this->db->update($this->get_table_name(), ['deleted_at' => date('Y-m-d H:i:s')], $where);
    }

    public function get_table_name()
    {
        if (property_exists($this, 'table_name')) {
            return $this->table_name;
        }
        $class_name = strtolower(get_class($this));
        return substr_replace($class_name, '', 0, 2);
    }

    public function set_table_name($table_name)
    {
        $this->table_name = $table_name;
        return $this;
    }

    public function get_id()
    {
        $micro = explode(' ', microtime());
        $micro[0] = preg_replace('/(\ |,|\.)/', '', $micro[0]);
        return $micro[1] . $micro[0];
    }
}
