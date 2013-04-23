<?php
class User_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function login($username, $password) {
    $this->db->select('UID, Username, Password, Type');
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

  /* Sign up with user data passed through array */
  public function signup($data) {
    if ( ! isset($data)) return FALSE;
    // Check required fields
    if ( ! (isset($data['Username'])
            && isset($data['Password'])
            && isset($data['Type'])
            && isset($data['Email'])
            && isset($data['Name']))) {
      return FALSE;
    }

    // Check for valid user type
    if ($data['Type'] !== APPLICANT && $data['Type'] !== EMPLOYER) return FALSE;

    // Write data to database
    $this->db->trans_start();

    $this->db->insert('User', $data);
    $ins_result = $this->db->trans_status();

    $this->db->trans_complete();

    return $ins_result;
  }

}
