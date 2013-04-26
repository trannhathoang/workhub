<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->model('region_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  /* Default behavior is add new */
  public function index() {
    $this->data['title'] = 'Edit Job';
    $this->data['regions'] = $this->region_model->get_regions();

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('employer/nav_view', $this->data);

    $this->load->view('employer/job_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

  public function edit($jid) {
  }

}
