<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Map_model');
		$this->load->model('Client_model');
		$this->load->model('Project_model');
	}

	public function index()
	{
		//Mapping
		$data = array(
			// Tampil ALL DATA
			'client'=> $this->Map_model->tampil(),
			// Tampil SELEKSI Negara
			'filterIndonesia' => $this->db->like('negara','indonesia'),
			'filterIndonesia'=> $this->Map_model->tampil(),
			'filterForeign' => $this->db->not_like('negara','indonesia'),
			'filterForeign'=> $this->Map_model->tampil(),
		);

		// print_r($data["filterForeign"]);die;
		//Deklarasi dasar
		$data['judul'] = "Pemetaan Client | Map";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		//Pencarian
		$keyword = $this->input->post('keyword');
		$data['products']=$this->Map_model->get_product_keyword($keyword);
		// load vw_bank
		$this->load->view("layout/header", $data);
		$this->load->view("map/vw_map", $data);
		$this->load->view("layout/footer");
	}

}
