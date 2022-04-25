<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model
{
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
            if (array_key_exists("id_client", $params)) {
                $this->db->where('id_client', $params['id_client']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id_client', 'desc');
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
