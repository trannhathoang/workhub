<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifysignup extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('confirm', 'Password confirmation', 'trim|required|xss_clean|callback_check_signup');

    if ($this->form_validation->run() === FALSE) {
      //Field validation failed
      $this->load->view('signup_view');
    } else {
      //Go to login view
      echo "Redirecting";
      redirect('login', 'refresh');
    }
  }

  function check_signup($confirm) {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    // Check if password is matched
    if (strcmp($confirm, $password) != 0) {
      $this->form_validation->set_message('check_signup', 'Password confirmation is not match');
      return FALSE;
    }

    // Check if the username is available
    if ( ! $this->user_model->check_available($username)) {
      $this->form_validation->set_message('check_signup', 'Username is not available');
      return FALSE;
    }

    // Field validation succeeded. Validate against database
    $result = $this->user_model->signup($username, $password, 0);

    if ($result) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_signup', 'Cannot sign up. Please check your information');
      return FALSE;
    }
  }

}
