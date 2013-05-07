<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Managecvs extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('cv_model', '', TRUE);
    $this->load->model('invitation_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Manage CVs';
    $this->data['invs'] = array(); // Invitations to all CVs
    $this->data['jobs'] = NULL; // Jobs corresponding with invitations to a CV
  }

  public function index() {
    $this->examine(0);
  }

  public function examine($cid) {
    $this->data['excid'] = $cid;

    $this->data['cvs'] = $this->cv_model->get_cvs($this->data['uid']);

    foreach ($this->data['cvs'] as $cv) {
      $this->data['invs'][$cv['CID']] = $this->invitation_model->get_invs_by_cid($cv['CID']);

      // Currently examined CV
      if ($cid > 0 && $cv['CID'] == $cid) {
        $this->data['excv'] = $cv['Subject'];

        // Get jobs for being examined CV
        if (isset($this->data['invs'][$cid])) {
          $this->data['jobs'] = $this->invitation_model->get_invs_jobs($cid);
        } else {
          // Clear $this->data['jobs']
          unset($this->data['jobs']);
          $this->data['jobs'] = NULL;
        }
      }
    }
    $this->data['discarded'] = $this->session->flashdata('cv_discarded');

    $this->_show_view('managecvs_view');
  }

  /* Accept a invitation to a CV */
  public function accept($cid, $jid) {
    // Check if CV is owned by user
    $result = $this->cv_model->get_cv($cid);
    $cv = NULL;
    foreach ($result as $row) $cv = $row;
    if ($cv == NULL || $cv['UID'] !== $this->data['uid']) return FALSE;

    // Set status of invitation to ACCEPTED
    $this->invitation_model->set_status($cid, $jid, ACCEPTED);

    $this->examine($cid);
  }

  /* Refuse a invitation */
  public function refuse($cid, $jid) {
    // Check if CV is owned by user
    $result = $this->cv_model->get_cv($cid);
    $cv = NULL;
    foreach ($result as $row) $cv = $row;
    if ($cv == NULL || $cv['UID'] !== $this->data['uid']) return FALSE;

    // Set status of invitation to REFUSED
    $this->invitation_model->set_status($cid, $jid, REFUSED);

    $this->examine($cid);
  }

  private function _show_view($view) {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);

    $this->load->view('applicant/nav_view', $this->data);
    $this->load->view('applicant/'.$view, $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
