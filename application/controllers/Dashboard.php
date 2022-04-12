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
        $data['UserNonAktif'] = $this->Dashboard_model->getCountNonActiveUser();
        $data['totalProject'] = $this->Dashboard_model->getCountAllProject();
        $data['AktifProject'] = $this->Dashboard_model->getCountActiveProject();
        $data['BerakhirProject'] = $this->Dashboard_model->getCountNonActiveProject();
        
        $data['Year'] = $this->Dashboard_model->getTahun();
        
        $data['judul'] = "Pemetaan Client | Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('dashboard/dashbord.php', $data);
        $this->load->view('layout/footer', $data);
	}
}
