<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official extends CI_Controller {
  public function __construct(){
    parent::__construct();
    
    // always check login data
    $this->cekLogin();
  }

  private function cekLogin(){
    if(! $this->session->userdata('login_official'))
      redirect(site_url('login'));
  }

  public function index(){
    $this->load->model('official_model');
    $data['view_name'] = 'home_rangers';
    $data['rangers']   = $this->official_model->getRangers();
    
    $this->load->view('official/index_view', $data);
  }

}
