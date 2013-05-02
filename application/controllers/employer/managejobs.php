<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Managejobs extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('job_model', '', TRUE);
    $this->load->model('application_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Manage Jobs';
  }

  public function index() {
    $this->data['jobs'] = $this->job_model->get_jobs($this->data['uid']);
    $this->data['apps'] = array();
    foreach ($this->data['jobs'] as $job) {
      $this->data['apps'][$job['JID']] = $this->application_model->get_apps_by_jid($job['JID']);
    }
    $this->data['discarded'] = $this->session->flashdata('job_discarded');

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);

    $this->load->view('employer/nav_view', $this->data);
    $this->load->view('employer/managejobs_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
