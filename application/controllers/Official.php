<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official extends CI_Controller {
  public function __construct(){
    parent::__construct();
    
    // always check login data
    $this->cekLogin();
    $this->load->model('official_model');
  }

  private function cekLogin(){
    if(! $this->session->userdata('login_official'))
      redirect(site_url('login'));
  }

  public function index(){
    $data['view_name'] = 'home_rangers';
    $data['rangers']   = $this->official_model->getRangers();
    
    $this->load->view('official/index_view', $data);
  }

  public function selection(){
    if($this->input->post('send-selection')){
      $division = (int) $this->input->post('division');
      $rangers = array();
      foreach($this->input->post('rangers') as $id)
        $rangers[] = (int) $id;

      $this->official_model->addSelected($division, $rangers);

      $this->session->set_flashdata('msg', 'Berhasil menyimpan');
      $this->session->set_flashdata('type', 'success');

      redirect(site_url('official/selection'));
    }
    else {
      $data['view_name'] = 'home_selection';
      $data['division']  = $this->official_model->getDivision();
      $data['rangers']   = $this->official_model->getUnselectedRangers();

      $this->load->view('official/index_view', $data);
    }
  }

  public function selected(){
    $data['view_name'] = 'home_selected';
    $data['selected']  = $this->official_model->getSelectedRangers();
    
    $this->load->view('official/index_view', $data);
  }

}
