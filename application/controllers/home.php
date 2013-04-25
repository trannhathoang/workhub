<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller {

  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('user_model');

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $this->data['title'] = 'Home';
    $this->_view('home_view');
  }

  function logout() {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('login', 'refresh');
  }

  function search() {
    $this->data['title'] = 'Search';
    $this->_view('search_view');
  }

  function managecvs() {
    $this->data['title'] = 'Manage CVs';
    $this->_view('managecvs_view');
  }

  function applications() {
    $this->data['title'] = 'Applications';
    $this->_view('applications_view');
  }

  function profile() {
    $this->data['title'] = 'Profile';
    $result = $this->user_model->get_user($this->data['uid']);
    foreach ($result as $row) {
      $this->data['user'] = $row;
    }
    $this->_view('profile_view');
  }

  /* Check session and load a view of applicant or employer. */
  function _view($view = 'home_view') {
    if($this->session->userdata('logged_in')) {
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      if ($this->data['type'] == EMPLOYER) {
        $this->load->view('employer/nav_view', $this->data);
        $this->load->view('employer/'.$view, $this->data);
      } else {
        $this->load->view('applicant/nav_view', $this->data);
        $this->load->view('applicant/'.$view, $this->data);
      }
      $this->load->view('templates/footer.php', $this->data);
    } else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

}
