<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {
    //Untuk Membuat Data CRUD
    public $table = "project";
    
    public function insert($data)
    {
        $this->db->insert('project', $data);
    }
}