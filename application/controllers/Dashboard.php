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
        $AllData = $this->Dashboard_model->getCountNonActiveUser();
        // print_r($AllData); die;
        $data['totalProject'] = $this->Dashboard_model->getCountAllProject();
        $total = 0;
        foreach($AllData as $test):
            if($test['JumlahAktif'] == 0){
                $total= $total +1;
            }
        endforeach; 
        $data['UserNonAktif'] = $total;
        $data['Year'] = $this->Dashboard_model->getTahun();
        
        $data['judul'] = "Pemetaan Client | Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('dashboard/dashbord.php', $data);
        $this->load->view('layout/footer', $data);
	}
}
