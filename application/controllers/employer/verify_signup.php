<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify employer info */
class Verify_signup extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('region_model', '', TRUE);
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    if ($this->form_validation->run('signup_emp') === FALSE || $this->check_signup() === FALSE) {
      //Field validation failed
      $data['title'] = 'Enter information';
      $data['regions'] = $this->region_model->get_regions();

      $this->load->view('templates/header.php', $data);
      $this->load->view('employer/signup_view', $data);
      $this->load->view('templates/footer.php', $data);
    } else {
      //Go to login view
      redirect('login', 'refresh');
    }
  }

  function check_signup() {
    $data = array('Username' => $this->input->post('username'),
                  'Password' => MD5($this->input->post('password')),
                  'Type' => EMPLOYER,
                  'Status' => ACTIVE,
                  'Email' => $this->input->post('email'),
                  'Name' => $this->input->post('name'),
                  'RID' => $this->input->post('region'),
                  'Address' => $this->input->post('address'),
                  'Description' => $this->input->post('description'),
                  /* Applicant fields */
                  'Sex' => 0,
                  'Birthday' => NULL,
                  /* Employer field */
                  'Size' => $this->input->post('size'));

    // Field validation succeeded. Validate against database
    $result = $this->user_model->signup($data);

    if ($result) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_signup', 'Cannot sign up. Please check your information');
      return FALSE;
    }
  }

}
