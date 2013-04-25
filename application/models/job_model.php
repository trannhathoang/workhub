<?php
class Job_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of regions */
  public function get_jobs($uid) {
    $this->db->where('UID', $uid);
    $query = $this->db->get('Job');
    return $query->result_array();
  }

}
