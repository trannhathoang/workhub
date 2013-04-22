<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify account type */
class Verifytype extends CI_Controller {

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    $this->form_validation->set_rules('type', 'Account type', 'required');

    if ($this->form_validation->run() === FALSE) {
      //Field validation failed
      $this->load->view('signup_type_view');
    } else {
      //Go to signup info view
      //echo "Redirecting";
      $type = $this->input->post('type');
      if (strcmp($type, 'employer') == 0) {
        redirect('signup/enter_info/'.EMPLOYER, 'refresh');
      } else {
        redirect('signup/enter_info/'.APPLICANT, 'refresh');
      }
    }
 
  }

}
