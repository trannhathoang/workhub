<?php
class Job_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of jobs */
  public function get_jobs($uid) {
    $this->db->where('UID', $uid);
    $query = $this->db->get('Job');
    return $query->result_array();
  }

  /* Get specific job. Use foreach to retrieve job from query. */
  public function get_job($jid) {
    $this->db->where('JID', $jid);
    $query = $this->db->get('Job');
    return $query->result_array();
  }

  /* Save new or update job. If $jid <= 0, job will be newly created.
     The array $jobdata MUST NOT have index 'JID'. */
  public function save_job($jid, $jobdata) {
    if ($jid > 0) {
      $this->db->where('JID', $jid);
      $this->db->update('Job', $jobdata);
    } else {
      $this->db->insert('Job', $jobdata);
    }
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
