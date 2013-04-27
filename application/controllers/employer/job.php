<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['regions'] = $this->region_model->get_regions();
    $this->data['job'] = NULL;
  }

  /* Default behavior is add new */
  public function index() {
    $this->data['title'] = 'Edit Job';
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('employer/nav_view', $this->data);

    $this->load->view('employer/job_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

  public function edit($jid) {
    $query = $this->job_model->get_job($jid, $this->data['uid']);
    if ($query) {
      foreach ($query as $row) {
        $this->data['job'] = $row;
      }
    } else {
      $this->data['job'] = NULL;
    }

    $this->data['title'] = 'Edit Job';
    // If job was saved previously
    $this->data['saved'] = $this->session->flashdata('job_saved');

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('employer/nav_view', $this->data);

    $this->load->view('employer/job_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

  public function discard($jid) {
    $query = $this->job_model->get_job($jid, $this->data['uid']);
    if ($query) {
      foreach ($query as $row) {
        $this->data['job'] = $row;
      }
    } else {
      $this->data['job'] = NULL;
    }

    $this->data['title'] = 'Discard Job';

    if ($this->data['job'] != NULL) {
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      $this->load->view('employer/nav_view', $this->data);

      $this->load->view('employer/discard_job_view', $this->data);

      $this->load->view('templates/footer.php', $this->data);
    } else {
      redirect('home/managejobs', 'refresh');
    }
  }

  public function discard_confirmed($jid) {
    $query = $this->job_model->get_job($jid, $this->data['uid']);
    if ($query) {
      foreach ($query as $row) {
        $this->data['job'] = $row;
      }
    } else {
      $this->data['job'] = NULL;
    }

    if ($this->data['job'] != NULL) {
      // Disable the job
      if ($this->job_model->discard_job($jid, $this->data['uid'])) {
        $this->session->set_flashdata('job_discarded', TRUE);
      }
    }

    redirect('home/managejobs', 'refresh');
  }

}
