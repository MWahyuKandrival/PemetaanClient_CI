<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {
    public $table = 'project';
    public $id = 'project.kode_projek';
    public function __contruct()
    {
        parent::__construct();
    }
    public function get($status)
    {
        $this->db->select('p.*,c.nama_client as nama');
        $this->db->from('project p');
        $this->db->like('p.status', $status);
        $this->db->join('client c', 'p.id_client = c.id_client');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getByClient($id)
    {
        $this->db->select("p.*, c.nama_client as nama");
        $this->db->from("client c");
        $this->db->join("project p", "p.id_client = c.id_client", "left");
        $this->db->where("c.id_client", $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->select("p.*, c.nama_client as nama, c.latitude, c.longitude");
        $this->db->from("project p");
        $this->db->join("client c", "p.id_client = c.id_client");
        $this->db->where("p.kode_projek", $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getBy()
    {
        $this->db->from($this->table);
        $this->db->where('email', $this->session->userdata('email'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    public function cekStatus($id_client)
    {
        $this->db->select('id_client,
         sum(case when status = "Aktif" then 1 else 0 end) as JumlahAktif,
         sum(case when status = "Berakhir" then 1 else 0 end) as JumlahNonAktif');
        $this->db->from("project");
        $this->db->where("id_client", $id_client);
        $query = $this->db->get();
        return $query->row_array();
    }
}