<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify Application */
class Verify_apply extends CI_Controller {
  
  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('user_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);
    $this->load->model('application_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $jid = $this->input->post('job');
    $cid = $this->input->post('cv');
    $euid = $this->input->post('euid');

    if ($this->form_validation->run('application') === FALSE || $this->apply($cid, $jid, $euid) === FALSE) {
      $query = $this->job_model->get_job($jid);
      if ($query) {
        foreach ($query as $row) {
          $this->data['job'] = $row;
        }

        $query = $this->user_model->get_user($this->data['job']['UID']);
        if ($query) {
          foreach ($query as $row) {
            $this->data['employer'] = $row;
          }
        }

        $this->data['cvs'] = $this->cv_model->get_cvs($this->data['uid']);
      }

      $this->data['title'] = 'Apply Job';

      if ($this->data['job'] != NULL) {
           $this->load->view('templates/header.php', $this->data);
           $this->load->view('acc_view', $this->data);
           $this->load->view('applicant/nav_view', $this->data);

           $this->load->view('applicant/apply_job_view', $this->data);

           $this->load->view('templates/footer.php', $this->data);
      } else {
        redirect('home', 'refresh');
      }
    } else {
      // $this->session->set_flashdata('application_sent', TRUE);
      redirect('applicant/applications', 'refresh');
    }
  }

  function apply($cid, $jid, $euid) {
    $newdata = array('CID' => $cid,
                    'JID' => $jid,
                    'AUID' => $this->data['uid'],
                    'EUID' => $euid,
                    'Status' => ACTIVE);

    return $this->application_model->create_application($newdata);
  }

}
