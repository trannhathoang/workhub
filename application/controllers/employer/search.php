<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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

    $this->data['title'] = 'Search';
    $this->data['regions'] = $this->region_model->get_regions();
  }

  public function index() {
    $this->data['search_result'] = NULL;
    $this->_show_view('search_view');
  }

  public function search_apps($sex = -1, $rid = 0, $keyword = NULL) {
    $this->data['search_result'] = $this->cv_model->search_cvs($sex, $rid, $keyword);
    $this->_show_view('search_view');
  }

  private function _show_view($view) {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('employer/nav_view', $this->data);

    $this->load->view('employer/'.$view, $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
