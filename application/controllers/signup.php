<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('region_model', '', TRUE);
    $this->load->helper('form');
  }

  function index() {
    $this->choose_type();
  }

  function choose_type() {
    $data['title'] = 'Choose account type';
    $this->load->view('templates/header.php', $data);
    $this->load->view('signup_type_view', $data);
    $this->load->view('templates/footer.php', $data);
  }

  function enter_info($acctype) {
    $data['title'] = 'Enter information';
    $data['regions'] = $this->region_model->get_regions();

    $this->load->view('templates/header.php', $data);

    if ($acctype == EMPLOYER) {
      $this->load->view('employer/signup_view', $data);
    } else {
      $this->load->view('applicant/signup_view', $data);
    }

    $this->load->view('templates/footer.php', $data);
  }

}
