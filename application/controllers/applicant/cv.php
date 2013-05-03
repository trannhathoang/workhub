<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Cv extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['regions'] = $this->region_model->get_regions();
    $this->data['cv'] = NULL;
  }

  /* Default behavior is add new */
  public function index() {
    $this->data['title'] = 'Edit CV';
    $this->_show_view('cv_view');
  }

  public function edit($cid) {
    $query = $this->cv_model->get_cv($cid);
    if ($query) {
      foreach ($query as $row) {
        $this->data['cv'] = $row;
      }
    } else {
      $this->data['cv'] = NULL;
    }

    $this->data['title'] = 'Edit CV';
    // If CV was saved previously
    $this->data['saved'] = $this->session->flashdata('cv_saved');

    $this->_show_view('cv_view');
  }

  public function discard($cid) {
    $query = $this->cv_model->get_cv($cid);
    if ($query) {
      foreach ($query as $row) {
        $this->data['cv'] = $row;
      }
    } else {
      $this->data['cv'] = NULL;
    }

    $this->data['title'] = 'Discard CV';

    if ($this->data['cv'] != NULL) {
      $this->_show_view('discard_cv_view');
    } else {
      redirect('home/managecvs', 'refresh');
    }
  }

  public function discard_confirmed($cid) {
    $query = $this->cv_model->get_cv($cid);
    if ($query) {
      foreach ($query as $row) {
        $this->data['cv'] = $row;
      }
    } else {
      $this->data['cv'] = NULL;
    }

    if ($this->data['cv'] != NULL) {
      // Disable the CV
      if ($this->cv_model->set_status($cid, $this->data['uid'], DISABLED)) {
        $this->session->set_flashdata('cv_discarded', TRUE);
      }
    }

    redirect('home/managecvs', 'refresh');
  }

  private function _show_view($view) {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('applicant/nav_view', $this->data);

    $this->load->view('applicant/'.$view, $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
