<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify search */
class Verify_search extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
  }

  function index() {
    $this->form_validation->set_rules('region', 'Region', 'is_natural');
    $this->form_validation->set_rules('sex', 'Sex', 'is_natural');

    $sex = $this->input->post('sex');
    if (strlen($sex) <= 0) $sex = -1;
    $rid = $this->input->post('region');
    if (strlen($rid) <= 0) $rid = 0;
    $keyword = $this->input->post('search');

    redirect('employer/search/search_apps/'.$sex.'/'.$rid.'/'.$keyword, 'refresh');
  }

}
