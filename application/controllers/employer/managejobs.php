<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Managejobs extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('job_model', '', TRUE);
    $this->load->model('application_model', '', TRUE);
    $this->load->model('cv_model', '', TRUE);
    $this->load->model('user_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Manage Jobs';
    $this->data['apps'] = array(); // Applications of all jobs
    $this->data['cvs'] = NULL; // CVs corresponding with applications of a job
  }

  public function index() {
    $this->examine(0); // Just view jobs
  }

  public function examine($jid) {
    $this->data['exjid'] = $jid;

    $this->data['jobs'] = $this->job_model->get_jobs($this->data['uid']);

    foreach ($this->data['jobs'] as $job) {
      $this->data['apps'][$job['JID']] = $this->application_model->get_apps_by_jid($job['JID']);

      // Currently examined job
      if ($jid > 0 && $job['JID'] == $jid) {
        $this->data['exjob'] = $job['Name'];

        // Get CVs for being examined job
        if (isset($this->data['apps'][$jid])) {
          $this->data['cvs'] = $this->application_model->get_apps_cvs($jid);
        } else {
          // Clear $this->data['cvs']
          unset($this->data['cvs']);
          $this->data['cvs'] = NULL;
        }
      }
    }
    $this->data['discarded'] = $this->session->flashdata('job_discarded');

    $this->_show_view('managejobs_view');
  }

  /* Accept a CV applying for a job */
  public function accept($jid, $cid) {
    // Check if job is owned by user
    $result = $this->job_model->get_job($jid);
    $job = NULL;
    foreach ($result as $row) $job = $row;
    if ($job == NULL || $job['UID'] !== $this->data['uid']) return FALSE;

    // Set status of application to ACCEPTED
    $this->application_model->set_status($cid, $jid, ACCEPTED);

    $this->examine($jid);
  }

  /* Refuse a CV applying for a job */
  public function refuse($jid, $cid) {
    // Check if job is owned by user
    $result = $this->job_model->get_job($jid);
    $job = NULL;
    foreach ($result as $row) $job = $row;
    if ($job == NULL || $job['UID'] !== $this->data['uid']) return FALSE;

    // Set status of application to REFUSED
    $this->application_model->set_status($cid, $jid, REFUSED);

    $this->examine($jid);
  }

  private function _show_view($view) {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);

    $this->load->view('employer/nav_view', $this->data);
    $this->load->view('employer/'.$view, $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
