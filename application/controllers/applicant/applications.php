<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Applications extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Applications';
  }

  public function index() {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('applicant/nav_view', $this->data);

    $this->load->view('applicant/applications_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
