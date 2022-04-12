<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model{
    public $table = 'project';
    public $id = 'project.kode_project';
    public function __contruct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select("c.*, count(p.id_project) as jumlah");
        $this->db->from("client c");
        $this->db->join("project p", "p.id_client = c.id_client", 'left');
        $this->db->group_by("c.id_client");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->select("c.*, count(p.id_client) as jumlah");
        $this->db->from("client c");
        $this->db->join("project p", "p.id_client = c.id_client", 'left');
        $this->db->where('c.id_client', $id);
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
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}