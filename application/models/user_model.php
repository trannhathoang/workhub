<?php
class User_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function login($username, $password) {
    $this->db->select('UID, Username, Password');
    $this->db->from('User');
    $this->db->where('Username', $username);
    $this->db->where('Password', MD5($password));
    $this->db->limit(1);

    $query = $this->db->get();

    if($query->num_rows() == 1) {
      return $query->result();
    } else {
      return FALSE;
    }
  }

}
