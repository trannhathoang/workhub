<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('category_model', '', TRUE);
    $this->load->model('job_level_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Search';
    $this->data['regions'] = $this->region_model->get_regions();
    $this->data['categories'] = $this->category_model->get_categories();
    $this->data['levels'] = $this->job_level_model->get_levels();
  }

  public function index() {
    $this->data['search_result'] = NULL;

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('applicant/nav_view', $this->data);

    $this->load->view('applicant/search_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

  public function search_job($rid = 0, $caid = 0, $jlid = 0, $keyword = NULL) {
    $this->data['search_result'] = $this->job_model->search_jobs($rid, $caid, $jlid, $keyword);

    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('applicant/nav_view', $this->data);

    $this->load->view('applicant/search_view', $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
