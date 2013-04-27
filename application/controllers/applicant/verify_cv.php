<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify CV */
class Verify_cv extends CI_Controller {
  
  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $cid = $this->input->post('id');
    if ($this->form_validation->run('cv') === FALSE || $this->save_cv($cid) === FALSE) {
      // Prepare data to repopulate
      $this->data['title'] = 'Edit CV';
      $this->data['regions'] = $this->region_model->get_regions();
      $this->data['cv'] = NULL;
      if ($cid > 0) {
        $query = $this->cv_model->get_cv($cid, $this->data['uid']);
        foreach ($query as $row) {
          $this->data['cv'] = $row;
        }
      }

      // Show view
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      $this->load->view('applicant/nav_view', $this->data);

      $this->load->view('applicant/cv_view', $this->data);

      $this->load->view('templates/footer.php', $this->data);
    } else {
      $this->session->set_flashdata('cv_saved', TRUE);
      if ($cid > 0) {
        redirect('applicant/cv/edit/'.$cid, 'refresh');
      } else {
        redirect('home/managecvs', 'refresh');
      }
    }
  }

  function save_cv($cid) {
    $newdata = array();

    $newdata['UID'] = $this->data['uid'];

    $subject = $this->input->post('subject');
    if (strlen($subject) > 0) {
      $newdata['Subject'] = $subject;
    } else {
      $newdata['Subject'] = 'No subject';
    }

    $newdata['Status'] = $this->input->post('status');
    $newdata['Category'] = $this->input->post('category');
    $newdata['EduLev'] = $this->input->post('edu_lev');
    $newdata['Skill'] = $this->input->post('skill');
    $newdata['Language'] = $this->input->post('language');
    $newdata['Exp'] = $this->input->post('exp');
    $newdata['RID'] = $this->input->post('region');
    $newdata['AddInfo'] = $this->input->post('add_info');

    // $newdata MUST NOT have 'JID' field
    return $this->cv_model->save_cv($cid, $this->data['uid'], $newdata);
  }

}
