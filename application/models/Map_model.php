<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {
    //Untuk Membuat Data CRUD
    public $table = "client";
     public function insert($data)
    {
        $this->db->insert('client', $data);
    }

	public function tampil()
    {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->order_by('id_client');
        return $this->db->get()->result_array();
    }

    public function get_product_keyword($keyword){
	    $this->db->select('*');
	    $this->db->from('client');
		$this->db->like('negara',$keyword);
		$this->db->or_like('region',$keyword);
		return $this->db->get()->result_array();
	}

    public function detail($id_client)
    {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->where('id_client',$id_client);
        return $this->db->get()->row_array();
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

}