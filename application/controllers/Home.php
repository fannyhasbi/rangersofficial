<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function index(){
    redirect(site_url('login'));
  }

  public function login(){
    if($this->input->post('login-official')){
      $username = (string) $this->input->post('username');
      $password = (string) $this->input->post('password');

      // Ini masih konyol, jangan ditiru yaa
      if($username == 'officialfls2019' && md5($password) == md5('officialfls2019')){
        $data_session = array(
          'username' => $username,
          'nama'     => 'Official FLS 2019',
          'login_official' => true
        );

        $this->session->set_userdata($data_session);
      }
      else {
        $this->session->set_flashdata('msg', 'Username atau password salah');

        redirect(site_url('login'));
      }
    }
    else {
      $data['message'] = $this->session->flashdata('msg');

      $this->load->view('home/login', $data);
    }
  }

  public function logout(){
    $this->session->sess_destroy();

    redirect(site_url());
  }

}
