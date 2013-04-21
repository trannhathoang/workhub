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

  public function signup($username, $password, $type) {
    // Check valid fields
    if ( ! (isset($username) && isset($password) && isset($type))) {
      return FALSE;
    }

    // Check for valid user type
    if ($type !== UT_APPLICANT && $type !== UT_EMPLOYER) return FALSE;

    $ins_result = TRUE;

    // Write data to database
    $data = array('Username' => $username,
                  'Password' => MD5($password),
                  'Type' => $type);
    $ins_result = $this->db->insert('User', $data);

    return TRUE;
  }

  /* Check if an username can be used to signup */
  public function check_available($username) {
    if ( ! isset($username)) return FALSE;

    // Check if 'username' is used
    $this->db->select('UID');
    $this->db->from('User');
    $this->db->where('Username', $username);
    $this->db->limit(1);

    $query = $this->db->get();
    if ($query->num_rows() > 0) return FALSE;

    return TRUE;
  }

}
