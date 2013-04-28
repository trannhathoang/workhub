<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Managecvs extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('cv_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Manage CVs';
  }

  public function index() {
    $this->data['cvs'] = $this->cv_model->get_cvs($this->data['uid']);
    $this->data['discarded'] = $this->session->flashdata('cv_discarded');

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('applicant/nav_view', $this->data);

    $this->load->view('applicant/managecvs_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
