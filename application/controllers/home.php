<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('session');
  }

  function index() {
    if($this->session->userdata('logged_in')) {
      $sess_data = $this->session->userdata('logged_in');
      $data['title'] = 'Home';
      $data['uid'] = $sess_data['uid'];
      $data['username'] = $sess_data['username'];
      $data['type'] = $sess_data['type'];

      $this->load->view('templates/header.php', $data);
      if ($data['type'] == EMPLOYER) {
        $this->load->view('home_emp_view', $data);
      } else {
        $this->load->view('home_app_view', $data);
      }
      $this->load->view('templates/footer.php', $data);
    } else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  function logout() {
    $this->load->helper('url');
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('login', 'refresh');
  }

}
