<?php
class Job_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /* Get array of jobs of a specific employer */
  public function get_jobs($uid) {
    $this->db->where('UID', $uid);
    $query = $this->db->get('Job');
    return $query->result_array();
  }

  /* Get specific job. Use foreach to retrieve job from query. */
  public function get_job($jid, $uid) {
    $where = array('JID' => $jid, 'UID' => $uid);
    $this->db->where($where);
    $query = $this->db->get('Job');

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Save new or update job. If $jid <= 0, job will be newly created.
     The array $jobdata MUST NOT have index 'JID'. */
  public function save_job($jid, $uid, $jobdata) {
    if ($jid > 0) {
      $where = array('JID' => $jid, 'UID' => $uid);
      $this->db->where($where);
      $this->db->update('Job', $jobdata);
    } else {
      $jobdata['UID'] = $uid;
      $this->db->insert('Job', $jobdata);
    }

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /* Disable a "discarded" job */
  public function discard_job($jid, $uid) {
    $data = array('Status' => DISABLED);

    if ($jid > 0) {
      $where = array('JID' => $jid, 'UID' => $uid);
      $this->db->where($where);
      $this->db->update('Job', $data);
    } else {
      return FALSE;
    }

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
