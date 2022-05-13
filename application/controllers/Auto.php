<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        date_default_timezone_set("Asia/Jakarta"); //Mengatur Zona waktu Jadi Indonesia
    }
    public function cekDate()
    {
        //Mengambil format tanggal hari ini
        $today = date("Y-m-d");
        //Mencari data pada database yang end_datenya hari ini
        $data = $this->Project_model->getDate($today);
        //Lakukan perulangan jika terdapat data
        foreach ($data as $d) :
            //Tampung kode_projek dan buat statusnya berakhir
            $projek = [
                'kode_projek' => $d['kode_projek'],
                'status' => 'Berakhir'
            ];
            //Jalankan function test yang ada pada project_helper
            test($d['id_client'], $projek);
            //Ubah Status pada projek
            $status = ['status' => "Berakhir"];
            $this->Project_model->update(['kode_projek' => $d['kode_projek']], $status);
            echo "Berhasil Mengubah Status <br><br>";
        endforeach;
        print_r($data);
        print_r($today);
        
    }

    public function cekPrevDate()
    {
        $today = date("Y-m-d");
        $data = $this->Project_model->getPrevDate($today);
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
