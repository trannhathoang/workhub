<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load->helper('form');
    $this->load->helper('url');
    $data['title'] = 'Login';
    $this->load->view('templates/header.php', $data);
    $this->load->view('login_view');
    $this->load->view('templates/footer.php', $data);
  }

}
