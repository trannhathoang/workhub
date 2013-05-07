<?php
class Invitation_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function create_invitation($data) {
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
    $ins_result = $this->db->insert('Invitation', $data);

    return $ins_result;
  }

  public function get_inv($cid, $jid) {
    $this->db->select('Invitation.*, CV.CID, Job.JID, Job.Name as Job_Name, User.Name as Applicant_Name');
    $this->db->from('Invitation');
    $this->db->join('CV', 'Invitation.CID = CV.CID');
    $this->db->join('Job', 'Invitation.JID = Job.JID');
    $this->db->join('User', 'Invitation.AUID = User.UID');
    $where = array('Invitation.CID' => $cid, 'Invitation.JID' => $jid);
    $this->db->where($where);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Get invitation fields, CV ID, Job ID, Job name, Applicant name.
     This function is usually used for employer. */
  public function get_invs_by_euid($euid) {
    $this->db->select('Invitation.*, CV.CID, Job.JID, Job.Name as Job_Name, User.Name as Applicant_Name');
    $this->db->from('Invitation');
    $this->db->join('CV', 'Invitation.CID = CV.CID');
    $this->db->join('Job', 'Invitation.JID = Job.JID');
    $this->db->join('User', 'Invitation.AUID = User.UID');
    $this->db->where('Invitation.EUID', $euid);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Get invitation by CV ID */
  public function get_invs_by_cid($cid) {
    $this->db->from('Invitation');
    $where = array('CID' => $cid);
    $this->db->where($where);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return NULL;
    }
  }

  /* Get jobs that invitations were sent for a CV */
  public function get_invs_jobs($cid) {
    $this->db->select('Invitation.*, Invitation.Status as Inv_Status, Job.*, Job.Name as Job_Name, Job.Status as Job_Status, JobLevel.Name as Level_Name, Category.Name as Category_Name, Region.Name as Region_Name, Job.Address as Job_Address, User.Name as Employer_Name');
    $this->db->from('Invitation');
    $this->db->join('Job', 'Invitation.JID = Job.JID');
    $this->db->join('JobLevel', 'Job.JLID = JobLevel.JLID');
    $this->db->join('Category', 'Job.CAID = Category.CAID');
    $this->db->join('Region', 'Job.RID = Region.RID');
    $this->db->join('User', 'Invitation.EUID = User.UID');

    $where = array('Invitation.CID' => $cid, 'Job.Status !=' => DISABLED, 'User.Status' => ACTIVE);
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
    $this->db->update('Invitation', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
