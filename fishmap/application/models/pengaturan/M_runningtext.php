<?php
require_once APPPATH . 'models/base/AplicationModel.php';
class M_runningtext extends AplicationModel
{
  protected $use_deleted_at = false;
  protected $timestamps = false;
  // construct
  function __construct()
  {
    parent::__construct();
  }

  //get total slide
  function get_total_slide($params)
  {
    $sql = "SELECT COUNT(*) 'total' FROM runningtext 
                WHERE running_text LIKE ? 
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

  // get all slide
  public function get_runningtext($params = '', $limit = '')
  {
    $sql = "SELECT * FROM runningtext
                WHERE running_text LIKE ? 
                AND deleted_at IS NULL ORDER BY id DESC";
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

  // get id slide
  public function get_id_runningtext($slide_id)
  {
    $sql = "SELECT * FROM runningtext
                WHERE id = ? 
                AND deleted_at IS NULL";
    $query = $this->db->query($sql, $slide_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    }
    return [];
  }

  // Get data ajax active
  public function getdata()
  {
    $sql = "SELECT COUNT(*) 'total' FROM runningtext 
      WHERE running_active = 1 
      AND deleted_at IS NULL";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result['total'];
    } else {
      return array();
    }
  }

  // get data for public
  public function get_runningtext_public($params = '', $limit = '')
  {
    $sql = "SELECT * FROM runningtext
            WHERE running_text LIKE ? AND running_active = '1'
            AND deleted_at IS NULL ORDER BY id DESC";
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

  // get data for public
  public function get_runningtext_public_active($params = '', $limit = '')
  {
    $sql = "SELECT * FROM runningtext
            WHERE running_text LIKE ? AND running_active = '1'
            AND deleted_at IS NULL ORDER BY id DESC";
    if (!empty($limit)) {
      $sql .= " LIMIT ?, ?";
      $params = array_merge($params, $limit);
    }
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    }
    return [];
  }
}
