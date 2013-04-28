<?php
class Job_level_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of regions */
  public function get_levels() {
    $query = $this->db->get('JobLevel');
    return $query->result_array();
  }

}
