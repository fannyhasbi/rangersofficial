<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official_model extends CI_Model { 
  public function getRangers(){
    $q = $this->db->get('rangers');
    return $q->result();
  }
}