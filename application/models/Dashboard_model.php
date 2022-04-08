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
        return $query->row_array();
    }

    public function getCountActiveUser()
    {
        $this->db->select("count(DISTINCT id_client) as total");
        $this->db->from("project");
        $this->db->where("status", "Aktif");
        $query = $this->db->get();
        return $query->row_array();    
    }
    
    public function getCountNonActiveUser()
    {
        $this->db->select('id_client,
         sum(case when status = "Aktif" then 1 else 0 end) as JumlahAktif,
         sum(case when status = "Berakhir" then 1 else 0 end) as JumlahNonAktif');
        $this->db->from("project");
        $this->db->group_by("id_client");
        $query = $this->db->get();
        return $query->result_array();
        //select id_client,
        // sum(case when status = "Aktif" then 1 else 0 end) as JumlahAktif,
        // sum(case when status = "Berakhir" then 1 else 0 end) as JumlahNonAktif
        // from project
        // WHERE jumlahAktif = 0
        // group by id_client;
    }

    public function getCountAllProject()
    {
        $this->db->select("count(*) as total_project");
        $this->db->from("project");
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTahun()
    {
        // SELECT
        // EXTRACT(year FROM start_date) AS year,
        // COUNT(*) AS Total
        // FROM project
        // GROUP BY EXTRACT(year FROM start_date);
        $this->db->select("EXTRACT(year FROM start_date) AS year, COUNT(*) AS Total");
        $this->db->from("project");
        $this->db->group_by("EXTRACT(year FROM start_date)");
        $query = $this->db->get();
        return $query->result_array();
    }
}