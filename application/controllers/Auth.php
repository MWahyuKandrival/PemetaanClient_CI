<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller 
{
    Public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','userrole');
    }
    function index()
    {
        $this->load->view("auth/login");
    }
    function cek_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role' => $user['role'],
					'id' => $user['id'],
				];
				$this->session->set_userdata($data);
				if ($user['role'] == 'Admin') {
					redirect('Dashboard');
				} else {
					redirect('Dashboard');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Tedaftar! </div>');
			redirect('auth');
		}
	}
    public function logout(){
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Logout! </div>');
            redirect('auth');
        }

    public function registrasi()
    {
        $this->load->view("auth/registrasi");
    }

    public function addregistrasi()
    {
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => "Admin"
        ];
        // print_r($data);
        // print_r($this->input->post("password"));
        // die;
        $this->userrole->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!  Akunmu telah berhasil terdaftar, Silahkan Login! </div>');
        redirect('auth');
    }
}
?>