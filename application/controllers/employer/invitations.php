<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Invitations extends CI_Controller {

  private $data;

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('invitation_model');

    $sess_data = $this->session->userdata('logged_in');
    $this->data['uid'] = $sess_data['uid'];
    $this->data['username'] = $sess_data['username'];
    $this->data['type'] = $sess_data['type'];

    $this->data['title'] = 'Invitations';
  }

  public function index() {
    $this->data['invitations'] = $this->invitation_model->get_invs_by_euid($this->data['uid']);
    $this->_show_view('invitations_view');
  }

  private function _show_view($view) {
    $this->load->view('templates/header.php', $this->data);
    $this->load->view('acc_view', $this->data);
    $this->load->view('employer/nav_view', $this->data);

    $this->load->view('employer/'.$view, $this->data);

    $this->load->view('templates/footer.php', $this->data);
  }

}
