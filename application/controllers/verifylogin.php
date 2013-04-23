<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('user_model','',TRUE);
  }

  function index() {
    $this->load->helper('url');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_login');

    if($this->form_validation->run() === FALSE) {
      //Field validation failed.&nbsp; User redirected to login page
      $data['title'] = 'Login';
      $this->load->view('templates/header.php', $data);
      $this->load->view('login_view');
      $this->load->view('templates/footer.php', $data);
    } else {
      //Go to private area
      redirect('home', 'refresh');
    }
  }

  function check_login($password) {
    $this->load->library('session');

    //Field validation succeeded.&nbsp; Validate against database
    $username = $this->input->post('username');

    //query the database
    $result = $this->user_model->login($username, $password);

    if ($result) {
      $sess_array = array();
      foreach ($result as $row) {
        $sess_array = array(
            'uid' => $row->UID,
            'username' => $row->Username
            );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    } else {
      $this->form_validation->set_message('check_login', 'Invalid username or password');
      return FALSE;
    }
  }

}
