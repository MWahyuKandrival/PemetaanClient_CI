<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $data['judul'] = "Pemetaan Client | Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('dashboard/dashbord.php', $data);
        $this->load->view('layout/footer', $data);
	}
}
