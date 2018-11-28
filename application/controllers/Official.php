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

  public function send_email($id_division){
    $id_division = (int) $id_division;
    $cek = $this->official_model->checkDivision($id_division);

    if($cek->num_rows() == 0){
      $this->session->set_flashdata('msg', 'Divisi tidak ditemukan');
      $this->session->set_flashdata('type', 'warning');
      redirect(site_url('official/selected'));
    }
    else {
      // Update status to SENT
      $division_status = $this->official_model->getDivisionStatus($id_division);

      if($division_status->status == 1){
        $this->session->set_flashdata('msg', 'Pengiriman dibatalkan. Email sudah pernah dikirimkan sebelumnya');
        $this->session->set_flashdata('type', 'warning');
        redirect(site_url('official/selected'));
      }
      else {
        $this->official_model->updateDivisionStatus($id_division);

        $division = $cek->row();
        $director = $this->official_model->getDirector($id_division);
        $rangers = $this->official_model->getDivisionRangers($id_division);
        // Initialize content data
        $data['nama_divisi'] = $division->nama;
        $data['gambar']      = image_definer($id_division);
        $data['director']    = $director->nama;
        $data['telp']        = $director->telp;
        $data['line']        = $director->kontak_line;

        foreach($rangers as $person){
          // // Embedded data to content
          $data['nama'] = $person->nama;

          //Email content
          $htmlContent = $this->load->view('email', $data, true);
          
          $config = array(
              'protocol'  => 'smtp',
              'smtp_host' => getenv('OFFICIAL_SMTP_HOST'),
              'smtp_port' => getenv('OFFICIAL_SMTP_PORT'),
              'smtp_user' => getenv('OFFICIAL_SMTP_USER'),
              'smtp_pass' => getenv('OFFICIAL_SMTP_PASS'),
              'mailtype'  => 'html',
              'priority'  => 1,
              'charset'   => 'utf-8'
          );

          $this->load->library('email', $config);

          $this->email->to($person->email);
          $this->email->from('official@futureleadersummit.org','Official FLS 2019');
          $this->email->subject('Welcome to Future Leader Summit 2019');
          $this->email->message($htmlContent);

          //Send email
          if(!$this->email->send()){
            $this->session->set_flashdata('msg', 'Terjadi kesalahan dalam mengirim email ke <strong>'. $person->email .'</strong>');
            $this->session->set_flashdata('type', 'error');

            redirect(site_url('official/selected'));
          }
        }

        $this->session->set_flashdata('msg', 'Berhasil mengirim email');
        $this->session->set_flashdata('type', 'success');

        redirect(site_url('official/selected'));
      }
    }
  }

  public function preview_email($id_diterima){
    $selected = $this->official_model->getSelectedData($id_diterima);
    $id_division = (int) $selected->id_division;
    $id_rangers  = (int) $selected->id_rangers;

    $division = $this->official_model->checkDivision($id_division);
    $division = $division->row();
    $director = $this->official_model->getDirector($id_division);
    $person = $this->official_model->getDivisionRangerById($id_diterima);
    
    // Initialize content data
    $data['nama_divisi'] = $division->nama;
    $data['gambar']      = image_definer($id_division);
    $data['director']    = $director->nama;
    $data['telp']        = $director->telp;
    $data['line']        = $director->kontak_line;
      
    // // Embedded data to content
    $data['nama'] = $person->nama;

    $this->load->view('email', $data); 
  }
}
