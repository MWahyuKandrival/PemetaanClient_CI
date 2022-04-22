<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model{
    public $table = 'client';
    public $id = 'client.id_client';
    public function __contruct()
    {
        parent::__construct();
    }
    public function get($status = "")
    {
        $this->db->select("c.*, count(p.id_client) as jumlah");
        $this->db->from("client c");
        $this->db->join("project p", "p.id_client = c.id_client", 'left');
        $this->db->like("status_kerja_sama", $status);
        $this->db->group_by("c.id_client");
        $this->db->order_by('c.id_client', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function fetch_data()
    {
        $this->db->select("*");
        $this->db->from('client');
        return $this->db->get();
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