<?php
class Application_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function create_application($data) {
    if ( ! isset($data)) return FALSE;
    // Check required fields
    if ( ! (isset($data['CID'])
            && isset($data['JID'])
            && isset($data['AUID'])
            && isset($data['EUID'])
            && isset($data['Status']))) {
      return FALSE;
    }

    // Write data to database
    $ins_result = $this->db->insert('Application', $data);

    return $ins_result;
  }

  public function get_app($cid, $jid) {
    $this->db->select('Application.*, CV.Subject, Job.Name as Job_Name, User.Name as Employer_Name');
    $this->db->from('Application');
    $this->db->join('CV', 'Application.CID = CV.CID');
    $this->db->join('Job', 'Application.JID = Job.JID');
    $this->db->join('User', 'Application.EUID = User.UID');
    $where = array('Application.CID' => $cid, 'Application.JID' => $jid);
    $this->db->where($where);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Get application fields, CV subject, Job name, Employer name.
     This function is usually used for applicant. */
  public function get_apps_by_auid($auid) {
    $this->db->select('Application.*, CV.Subject, Job.Name as Job_Name, User.Name as Employer_Name');
    $this->db->from('Application');
    $this->db->join('CV', 'Application.CID = CV.CID');
    $this->db->join('Job', 'Application.JID = Job.JID');
    $this->db->join('User', 'Application.EUID = User.UID');
    $this->db->where('Application.AUID', $auid);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Get 'enabled' applications by Job ID */
  public function get_apps_by_jid($jid) {
    $this->db->from('Application');
    $where = array('JID' => $jid, 'Status !=' => DISABLED);
    $this->db->where($where);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  public function set_status($cid, $jid, $status) {
    $data = array('Status' => $status);
    $where = array('CID' => $cid, 'JID' => $jid);

    $this->db->where($where);
    $this->db->update('Application', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
