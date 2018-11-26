<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official_model extends CI_Model { 
  public function getRangers(){
    $q = $this->db->get('rangers');
    return $q->result();
  }

  public function getDivision(){
    $q = $this->db->get('division');
    return $q->result();
  }

  public function getUnselectedRangers(){
    $q = "SELECT * FROM rangers WHERE id NOT IN (SELECT id_rangers FROM diterima)";
    $q = $this->db->query($q);

    return $q->result();
  }
}