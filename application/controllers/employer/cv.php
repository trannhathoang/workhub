<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

/* CV controller for employer */
class CV extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('user_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['regions'] = $this->region_model->get_regions();
    $this->data['cv'] = NULL;
    $this->data['applicant'] = NULL;
  }

  public function view($cid) {
    $query = $this->cv_model->get_cv($cid);
    if ($query) {
      foreach ($query as $row) {
        $this->data['cv'] = $row;
      }

      $query = $this->user_model->get_user($this->data['cv']['UID']);
      if ($query) {
        foreach ($query as $row) {
          $this->data['applicant'] = $row;
        }
      }
    }

    $this->data['title'] = 'View CV';

    $this->_show_view('cv_view');
  }

  public function invite($cid) {
    $query = $this->cv_model->get_cv($cid);
    if ($query) {
      foreach ($query as $row) {
        $this->data['cv'] = $row;
      }

      $query = $this->user_model->get_user($this->data['job']['UID']);
      if ($query) {
        foreach ($query as $row) {
          $this->data['applicant'] = $row;
        }
      }

      //$this->data['jobs'] = $this->jobs_model->get_jobs($this->data['uid']);
    }

    $this->data['title'] = 'Invite';

    if ($this->data['job'] != NULL) {
      $this->_show_view('invite_view');
    } else {
      redirect('home', 'refresh');
    }
  }

  private function _show_view($view) {
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      $this->load->view('employer/nav_view', $this->data);

      $this->load->view('employer/'.$view, $this->data);

      $this->load->view('templates/footer.php', $this->data);
  }

}
