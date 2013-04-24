<?php
class Region_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of regions */
  public function get_regions() {
    $query = $this->db->get('Region');
    return $query->result_array();
  }

}
