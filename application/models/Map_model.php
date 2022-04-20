<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {
    //Untuk Membuat Data CRUD
    public $table = "client";

	public function tampil()
    {
        $this->db->select('p.kode_projek, p.nama_projek, c.nama_client, c.negara, p.latitude as latitude, p.longitude as longitude');
        $this->db->from('project p');
        $this->db->join('client c', 'p.id_client = c.id_client');
        $this->db->order_by('kode_projek', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_product_keyword($keyword){
	    $this->db->select('p.kode_projek, p.nama_projek, c.nama_client, c.negara, p.latitude as latitude, p.longitude as longitude');
	    $this->db->from('project p');
        $this->db->join('client c', 'p.id_client = c.id_client');
        $this->db->like('c.nama_client',$keyword);
		$this->db->or_like('c.negara',$keyword);
        $this->db->or_like('c.alamat',$keyword);
		$this->db->or_like('c.region',$keyword);
        $this->db->or_like('p.nama_projek',$keyword);
		return $this->db->get()->result_array();
	}

    public function detail($id_client)
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('id_client',$id_client);
        return $this->db->get()->row_array();
    }

}