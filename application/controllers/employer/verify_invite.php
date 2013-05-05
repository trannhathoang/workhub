<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify Invitation */
class Verify_invite extends CI_Controller {
  
  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('user_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);
    $this->load->model('invitation_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $cid = $this->input->post('cid');
    $jid = $this->input->post('job');
    $auid = $this->input->post('auid');

    if ($this->form_validation->run('invitation') === FALSE || $this->invite($cid, $jid, $auid) === FALSE) {
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

        $this->data['jobs'] = $this->job_model->get_jobs($this->data['uid']);
      }

      $this->data['title'] = 'Invite';

      if ($this->data['cv'] != NULL) {
           $this->load->view('templates/header.php', $this->data);
           $this->load->view('acc_view', $this->data);
           $this->load->view('employer/nav_view', $this->data);

           $this->load->view('employer/invite_view', $this->data);

           $this->load->view('templates/footer.php', $this->data);
      } else {
        redirect('home', 'refresh');
      }
    } else {
      // $this->session->set_flashdata('invitation_sent', TRUE);
      redirect('employer/invitations', 'refresh');
    }
  }

  function invite($cid, $jid, $auid) {
    $newdata = array('CID' => $cid,
                    'JID' => $jid,
                    'AUID' => $auid,
                    'EUID' => $this->data['uid'],
                    'Status' => WAITING);

    return $this->invitation_model->create_invitation($newdata);
  }

}
