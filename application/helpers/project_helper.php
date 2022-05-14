<?php
function is_logged_in() //batasi akses ke halaman admin
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')){
        echo "<script>alert('Silahkan Login Terlebih Dahulu'); window.location.href = '".base_url('Auth')."';</script>";
    } else
    {
        $role = $ci->session->userdata('role');
        if ($role != "Admin") {
            echo "<script>alert('Silahkan Login Terlebih Dahulu'); window.location.href = '".base_url('Auth')."';</script>";
        } 
    }
}

//Berfungsi automatis mengubah status client jika tidak ada lagi projek yang aktif
function test($id_client = "", $data = "")
{
    $CI = get_instance();
    $CI->load->model('Client_model');
    $CI->load->model('Project_model');
    $client = $CI->Client_model->getById($id_client);
    $projek = $CI->Project_model->getById($data['kode_projek']);
    print_r($projek);
    echo "<br>";
    $cek_total = $CI->Project_model->cekStatus($id_client);
    echo 'Client : '. $client['nama_client']."<br>";
    echo 'Aktif : '. $cek_total['JumlahAktif']."<br>";
    echo 'NonAktif : '. $cek_total['JumlahNonAktif']."<br>";
    if($cek_total['JumlahAktif'] > 1){
        echo "Jumlah Aktif lebih dari 1  dengan jumlah : ". $cek_total['JumlahAktif'];	
    }else if($cek_total['JumlahAktif'] == 1){
        if($projek['status'] == 'Aktif' && $data['status']=="Berakhir"){
            echo "Input : ".$data['status']."<br>DB : ".$projek['status']."<br>";
            $status = ['status_kerja_sama'=> $data['status']];
            $CI->Client_model->update(['id_client' => $projek['id_client']], $status);
            echo "Mengubah Client menjadi status berakhir";
        }
        echo "Jumlah Aktif sama dengan 1 dengan jumlah : ". $cek_total['JumlahAktif'];	
    }else{
        if($projek['status'] == 'Berakhir' && $data['status']=="Aktif"){
            echo "Input : ".$data['status']."<br>DB : ".$projek['status']."<br>";
            $status = ['status_kerja_sama'=> $data['status']];
            $CI->Client_model->update(['id_client' => $projek['id_client']], $status);
            echo "Mengubah Client menjadi status Aktif";
        }
        echo "Jumlah Aktif :". $cek_total['JumlahAktif'];
    }
    echo $data['status']."<br>";
}
