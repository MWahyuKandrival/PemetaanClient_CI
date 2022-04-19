<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
    }
    public function cekDate()
    {
        $today = date("Y-m-d");
        $data = $this->Project_model->getDate($today);
        foreach ($data as $d) :
            $projek = [
                'kode_projek' => $d['kode_projek'],
                'status' => 'Berakhir'
            ];
            test($d['id_client'], $projek);
            $status = ['status' => "Berakhir"];
            $this->Project_model->update(['kode_projek' => $d['kode_projek']], $status);
            echo "Berhasil Mengubah Status <br><br>";
        endforeach;
    }
}
