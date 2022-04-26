<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{
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
        $this->db->order_by('p.kode_projek', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function fetch_data($where)
    {
        $this->db->select("*");
        $this->db->from('project');
        if ($where != null) {
            if ($where['mulai'] != "") {
                if($where['sampai'] != ""){
                    
                }
                $this->db->where('start_date >=', $where['mulai']);
                $this->db->where('start_date <=', $where['sampai']);
            }
        }
        return $this->db->get();
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
        $this->db->select("p.*, c.nama_client as nama");
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
    public function deleteClient($id)
    {
        $this->db->where('id_client', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function getDate($today)
    {
        $this->db->from('project');
        $this->db->where('end_date', $today);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPrevDate($today)
    {
        $this->db->from('project');
        $this->db->where('end_date <=', $today);
        $query = $this->db->get();
        return $query->result_array();
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
    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("kode_projek", $params)) {
                $this->db->where('kode_projek', $params['kode_projek']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('kode_projek', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data
        return $result;
    }

    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insertimport($data = array())
    {
        if (!empty($data)) {
            // Add created and modified date if not included
            // if(!array_key_exists("created", $data)){
            //     $data['created'] = date("Y-m-d H:i:s");
            // }
            // if(!array_key_exists("modified", $data)){
            //     $data['modified'] = date("Y-m-d H:i:s");
            // }

            // Insert member data
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function updateimport($data, $condition = array())
    {
        if (!empty($data)) {
            // Add modified date if not included
            // if(!array_key_exists("modified", $data)){
            //     $data['modified'] = date("Y-m-d H:i:s");
            // }

            // Update member data
            $update = $this->db->update($this->table, $data, $condition);

            // Return the status
            return $update ? true : false;
        }
        return false;
    }
}
