<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->model('user_model', '', TRUE);
    $this->load->model('region_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  public function index() {
    $this->data['title'] = 'Home';

    if ($this->data['type'] == EMPLOYER) {
      // Show employer's home page
    } else {
      // Show applicant's home page
      $this->load->model('cv_model', '', TRUE);
      $this->load->model('invitation_model', '', TRUE);

      // CVs
      $this->data['cvs'] = NULL;
      $this->data['cvs'] = $this->cv_model->get_cvs($this->data['uid']);

      $this->data['invs'] = array();
      foreach ($this->data['cvs'] as $cv) {
        $this->data['invs'][$cv['CID']] = $this->invitation_model->get_invs_by_cid($cv['CID']);
      }

      // Applications
      $this->load->model('application_model');
      $this->data['applications'] = $this->application_model->get_apps_by_auid($this->data['uid']);
    }

    $this->_show_view('home_view');
  }

  public function logout() {
    $this->session->unset_userdata('logged_in');
    redirect('login', 'refresh');
  }

  public function profile() {
    $this->data['title'] = 'Profile';
    $result = $this->user_model->get_user($this->data['uid']);
    foreach ($result as $row) {
      $this->data['user'] = $row;
    }
    $this->data['regions'] = $this->region_model->get_regions();
    $this->data['updated'] = $this->session->flashdata('profile_updated');
    $this->_show_view('profile_view');
  }

  /* Check session and load a view of applicant or employer. */
  public function _show_view($view = 'home_view') {
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
