<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model{

    public function __contruct()
    {
        parent::__construct();
    }
    
    public function getCountAllUser()
    {
        $this->db->select("count(*) as total");
        $this->db->from("client");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCountActiveUser()
    {
        $this->db->select("count(*) as total");
        $this->db->from("client");
        $this->db->where("status_kerja_sama", "Aktif");
        $query = $this->db->get();
        return $query->result_array();
    }
}