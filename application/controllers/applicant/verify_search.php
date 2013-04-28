<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify search */
class Verify_search extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('url');
  }

  function index() {
    $this->form_validation->set_rules('region', 'Region', 'is_natural');
    $this->form_validation->set_rules('category', 'Category', 'is_natural');
    $this->form_validation->set_rules('level', 'Job level', 'is_natural');

    $rid = $this->input->post('region');
    if (strlen($rid) <= 0) $rid = 0;
    $caid = $this->input->post('category');
    if (strlen($caid) <= 0) $caid = 0;
    $jlid = $this->input->post('level');
    if (strlen($jlid) <= 0) $jlid = 0;
    $keyword = $this->input->post('search');

    redirect('applicant/search/search_job/'.$rid.'/'.$caid.'/'.$jlid.'/'.$keyword, 'refresh');
  }

}
