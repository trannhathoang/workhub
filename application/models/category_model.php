<?php
class Category_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of regions */
  public function get_categories() {
    $query = $this->db->get('Category');
    return $query->result_array();
  }

}
