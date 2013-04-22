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
    $this->load->view('signup_type_view');
  }

  function enter_info($acctype) {
    if ($acctype == EMPLOYER) {
      $this->load->view('signup_emp_view');
    } else {
      $this->load->view('signup_app_view');
    }
  }

}
