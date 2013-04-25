<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify applicant profile */
class Verify_profile extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('region_model', '', TRUE);
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    if ($this->form_validation->run('profile_app') === FALSE || $this->update_profile() === FALSE) {
      redirect('home/profile', 'refresh');
    } else {
      redirect('home/profile', 'refresh');
    }
  }

  function update_profile() {
    return TRUE;
  }

}
