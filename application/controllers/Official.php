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

  public function division($id_division){
    $id_division = (int) $id_division;

    $cek = $this->official_model->checkDivision($id_division);
    if($cek->num_rows() == 0){
      $this->session->set_flashdata('msg', 'Divisi tidak ditemukan');
      $this->session->set_flashdata('type', 'warning');
      redirect(site_url('official/selected'));
    }
    else {
      $data['view_name'] = 'detail_division';
      $data['division']  = $this->official_model->getDivisionName($id_division);
      $data['rangers']   = $this->official_model->getDivisionRangers($id_division);

      $this->load->view('official/index_view', $data);
    }
  }

  public function cancel_rangers($id){
    $id = (int) $id;

    if($this->official_model->checkSelected($id)->num_rows() == 0){
      $this->session->set_flashdata('msg', 'Rangers tidak ditemukan');
      $this->session->set_flashdata('type', 'warning');
      redirect(site_url('official/selected'));
    }
    else {
      $this->official_model->deleteSelected($id);

      $this->session->set_flashdata('msg', 'Rangers berhasil dibatalkan');
      $this->session->set_flashdata('type', 'success');
      redirect(site_url('official/selected'));
    }
  }

  public function send_email(){
    $this->load->view('email');
  }

}
