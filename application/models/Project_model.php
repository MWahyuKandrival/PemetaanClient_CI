<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {
    public $table = 'project';
    public $id = 'project.kode_project';
    public function __contruct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('p.*,c.nama_client as nama');
        $this->db->from('project p');
        $this->db->join('client c', 'p.id_client = c.id_client');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}