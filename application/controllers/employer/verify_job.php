<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify job */
class Verify_job extends CI_Controller {
  
  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('job_model', '', TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $jid = $this->input->post('id');
    if ($this->form_validation->run('job') === FALSE || $this->save_job($jid) === FALSE) {
      // Prepare data
      $this->data['title'] = 'Edit Job';
      $this->data['regions'] = $this->region_model->get_regions();
      $this->data['job'] = NULL;
      if ($jid > 0) {
        $query = $this->job_model->get_job($jid, $this->data['uid']);
        foreach ($query as $row) {
          $this->data['job'] = $row;
        }
      }

      // Show view
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      $this->load->view('employer/nav_view', $this->data);

      $this->load->view('employer/job_view', $this->data);

      $this->load->view('templates/footer.php', $this->data);
    } else {
      $this->session->set_flashdata('job_saved', TRUE);
      if ($jid > 0) {
        redirect('employer/job/edit/'.$jid, 'refresh');
      } else {
        redirect('home/managejobs', 'refresh');
      }
    }
  }

  function save_job($jid) {
    $newdata = array();

    $newdata['UID'] = $this->data['uid'];

    $name = $this->input->post('name');
    if (strlen($name) > 0) {
      $newdata['Name'] = $name;
    } else {
      $newdata['Name'] = 'Untitled job';
    }

    $newdata['Status'] = $this->input->post('status');
    $newdata['Category'] = $this->input->post('category');

    $min_salary = $this->input->post('min_salary');
    if (strlen($min_salary) > 0) {
      $newdata['MinSalary'] = $min_salary;
    } else {
      $newdata['MinSalary'] = NULL;
    }
    $max_salary = $this->input->post('max_salary');
    if (strlen($min_salary) > 0) {
      $newdata['MaxSalary'] = $max_salary;
    } else {
      $newdata['MaxSalary'] = NULL;
    }

    $expire = $this->input->post('expire');
    if (strlen($expire) > 0) {
      $newdata['ExpiredDate'] = $expire;
    } else {
      $newdata['ExpiredDate'] = NULL;
    }

    $newdata['RID'] = $this->input->post('region');
    $newdata['Address'] = $this->input->post('address');
    $newdata['Description'] = $this->input->post('description');

    // $newdata MUST NOT have 'JID' field
    return $this->job_model->save_job($jid, $this->data['uid'], $newdata);
  }

}
