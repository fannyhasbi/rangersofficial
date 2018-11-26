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

  public function getSelectedRangers(){
    $q = "
      SELECT dv.nama, COUNT(d.id) as jumlah
      FROM diterima d
      RIGHT JOIN division dv
        ON d.id_division = dv.id
      GROUP BY dv.id;
    ";
    $q = $this->db->query($q);

    return $q->result();
  }

  public function addSelected($division, $rangers){
    $selected = array();
    foreach($rangers as $rangers_id){
      $selected[] = [
        "id_division" => $division,
        "id_rangers"  => $rangers_id
      ];
    }

    $this->db->insert_batch('diterima', $selected);
  }
}