<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model("Dashboard_model");
    }

	public function index()
	{
        $data['totalUser'] = $this->Dashboard_model->getCountAllUser();
        $data['UserAktif'] = $this->Dashboard_model->getCountActiveUser();
        // print_r($data['UserAktif']); die;
        $data['judul'] = "Pemetaan Client | Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('dashboard/dashbord.php', $data);
        $this->load->view('layout/footer', $data);
	}
}
