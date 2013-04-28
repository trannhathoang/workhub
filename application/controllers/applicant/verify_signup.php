<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify applicant info */
class Verify_signup extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('region_model', '', TRUE);
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    if ($this->form_validation->run('signup_app') === FALSE || $this->check_signup() === FALSE) {
      //Field validation failed
      $data['title'] = 'Enter information';
      $data['regions'] = $this->region_model->get_regions();

      $this->load->view('templates/header.php', $data);
      $this->load->view('applicant/signup_view', $data);
      $this->load->view('templates/footer.php', $data);
    } else {
      //Go to login view
      redirect('login', 'refresh');
    }
  }

  function check_signup() {
    $sex = strcmp($this->input->post('sex'), 'male') == 0 ? 0 : 1;
    $data = array('Username' => $this->input->post('username'),
                  'Password' => MD5($this->input->post('password')),
                  'Type' => APPLICANT,
                  'Status' => ACTIVE,
                  'Email' => $this->input->post('email'),
                  'Name' => $this->input->post('name'),
                  'RID' => $this->input->post('region'),
                  'Address' => $this->input->post('address'),
                  'Description' => $this->input->post('description'),
                  /* Applicant fields */
                  'Sex' => $sex,
                  'Birthday' => $this->input->post('birthday'),
                  /* Employer field */
                  'Size' => NULL);

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
