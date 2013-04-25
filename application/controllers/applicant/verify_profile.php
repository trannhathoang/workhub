<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Verify applicant profile */
class Verify_profile extends CI_Controller {

  private $data;

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('region_model', '', TRUE);
    $this->load->model('user_model','',TRUE);

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];
  }

  function index() {
    $this->load->library('form_validation');
    $this->load->helper('url');

    if ($this->form_validation->run('profile_app') === FALSE || $this->update_profile() === FALSE) {
      // Prepare data
      $this->data['title'] = 'Profile';
      $result = $this->user_model->get_user($this->data['uid']);
      foreach ($result as $row) {
        $this->data['user'] = $row;
      }
      $this->data['regions'] = $this->region_model->get_regions();

      // Show form
      $this->load->view('templates/header.php', $this->data);
      $this->load->view('acc_view', $this->data);
      if ($this->data['type'] == EMPLOYER) {
        $this->load->view('employer/nav_view', $this->data);
        $this->load->view('employer/profile_view', $this->data);
      } else {
        $this->load->view('applicant/nav_view', $this->data);
        $this->load->view('applicant/profile_view', $this->data);
      }
      $this->load->view('templates/footer.php', $this->data);
    } else {
      $this->session->set_flashdata('profile_updated', TRUE);
      redirect('home/profile', 'refresh');
    }
  }

  function update_profile() {
    $newdata = array();

    $password = $this->input->post('password');
    if (strlen($password) > 0) $newdata['Password'] = $password;

    $email = $this->input->post('email');
    if (strlen($email) > 0) $newdata['Email'] = $email;

    $name = $this->input->post('name');
    if (strlen($name) > 0) $newdata['Name'] = $name;

    $sex = strcmp($this->input->post('sex'), 'male') == 0 ? 0 : 1;
    $newdata['Sex'] = $sex;

    $newdata['Birthday'] = $this->input->post('birthday');
    $newdata['RID'] = $this->input->post('region');
    $newdata['Address'] = $this->input->post('address');
    $newdata['Description'] = $this->input->post('description');

    $this->db->where('UID', $this->data['uid']);
    $this->db->update('User', $newdata);

    return TRUE;
  }

}
