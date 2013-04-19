<?php
class User_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function get_user($uid) {
    $query = $this->db->get_where('user', array('uid' => $uid));
    return $query->row_array();
  }

  public function login($username, $password) {
    $this->db->select('uid, username, password');
    $this->db->from('user');
    $this->db->where('username', $username);
    $this->db->where('password', MD5($password));
    $this->db->limit(1);

    $query = $this->db->get();

    if($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

}
