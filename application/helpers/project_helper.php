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


?>