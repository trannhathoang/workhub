<?php
class Application_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_regions() {
    $query = $this->db->get('Region');
    return $query->result_array();
  }

  public function create_application($data) {
    if ( ! isset($data)) return FALSE;
    // Check required fields
    if ( ! (isset($data['CID'])
            && isset($data['JID'])
            && isset($data['AUID'])
            && isset($data['Status']))) {
      return FALSE;
    }

    // Write data to database
    $ins_result = $this->db->insert('Application', $data);

    return $ins_result;
  }

}
