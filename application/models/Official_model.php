<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official_model extends CI_Model { 
  public function checkDivision($id_division){
    return $this->db->get_where('division', ['id' => $id_division]);
  }

  public function checkSelected($id){
    return $this->db->get_where('diterima', ['id' => $id]);
  }

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
      SELECT dv.id, dv.nama, COUNT(d.id) as jumlah
      FROM diterima d
      RIGHT JOIN division dv
        ON d.id_division = dv.id
      GROUP BY dv.id;
    ";
    $q = $this->db->query($q);

    return $q->result();
  }

  public function getDivisionName($id_division){
    $q = $this->db->get_where('division', ['id' => $id_division]);
    return $q->row()->nama;
  }

  public function getDivisionRangers($id_division){
    $q = "
      SELECT d.id, r.nama, r.email
      FROM diterima d
      INNER JOIN rangers r
        ON d.id_rangers = r.id
      WHERE id_division = $id_division
    ";
    $q = $this->db->query($q);
    
    return $q->result();
  }

  public function getDivisionRangerById($id_diterima){
    $q = "
      SELECT d.id, r.nama, r.email
      FROM diterima d
      INNER JOIN rangers r
        ON d.id_rangers = r.id
      WHERE d.id = ". $id_diterima;
    $q = $this->db->query($q);
    
    return $q->row();
  }

  public function getDirector($id_division){
    $id_division = (int) $id_division;
    $q = '
      SELECT dr.nama, dr.telp, dr.kontak_line
      FROM director dr
      INNER JOIN division dv
        ON dr.id_division = dv.id
      WHERE id_division = '. $id_division;
    
    $q = $this->db->query($q);

    return $q->row();
  }

  public function getSelectedData($id_diterima){
    $q = $this->db->get_where('diterima', ['id' => $id_diterima]);
    return $q->row();
  }

  public function getDivisionStatus($id_division){
    $q = $this->db->get_where('division_status', ['id' => $id_division]);

    return $q->row();
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

  public function updateDivisionStatus($id_division){
    $this->db->where('id', (int) $id_division);
    $data = array(
      'status' => 1
    );

    $this->db->update('division_status', $data);
  }

  public function deleteSelected($id){
    $this->db->where('id', $id);
    $this->db->delete('diterima');
  }
}