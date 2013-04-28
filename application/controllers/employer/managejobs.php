<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Managejobs extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('job_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Manage Jobs';
  }

  public function index() {
    $this->data['jobs'] = $this->job_model->get_jobs($this->data['uid']);
    $this->data['discarded'] = $this->session->flashdata('job_discarded');

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);

    $this->load->view('employer/nav_view', $this->data);
    $this->load->view('employer/managejobs_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
