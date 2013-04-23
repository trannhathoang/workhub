<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify employer info */
class Verifyeinfo extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|alpha_dash|is_unique[User.Username]');
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[6]|max_length[64]');
    $this->form_validation->set_rules('confirm', 'Password confirmation', 'required|xss_clean|matches[password]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[User.Email]');
    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
    //TODO Region
    $this->form_validation->set_rules('address', 'Address', 'max_length[256]');
    $this->form_validation->set_rules('category', 'Category', 'max_length[256]'); // TODO
    $this->form_validation->set_rules('size', 'Size', 'max_length[256]'); // TODO
    $this->form_validation->set_rules('description', 'Description', 'max_length[512]');

    if ($this->form_validation->run() === FALSE || $this->check_signup() === FALSE) {
      //Field validation failed
      $data['title'] = 'Enter information';
      $this->load->view('templates/header.php', $data);
      $this->load->view('signup_emp_view');
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
                  'RID' => NULL /*TODO*/,
                  'Address' => $this->input->post('address'),
                  'Description' => $this->input->post('description'),
                  /* Applicant fields */
                  'Sex' => 0,
                  'Birthday' => NULL,
                  /* Employer field */
                  'Category' => $this->input->post('category'),
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
