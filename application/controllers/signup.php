<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('form');
  }

  function index() {
    $this->choose_type();
  }

  function choose_type() {
    $data['title'] = 'Choose account type';
    $this->load->view('templates/header.php', $data);
    $this->load->view('signup_type_view');
    $this->load->view('templates/footer.php', $data);
  }

  function enter_info($acctype) {
    $data['title'] = 'Enter information';
    $this->load->view('templates/header.php', $data);

    if ($acctype == EMPLOYER) {
      $this->load->view('signup_emp_view');
    } else {
      $this->load->view('signup_app_view');
    }

    $this->load->view('templates/footer.php', $data);
  }

}
