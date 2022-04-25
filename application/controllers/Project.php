<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Project_model');
		$this->load->model('Client_model');
	}
	function index($status = "")
	{
		$data['judul'] = "Halaman Project";
		//Get Date
		$lastWeek = date("Y-m-d", strtotime("-7 days"));
		$lastMonth = date("Y-m-d", strtotime("-1 month"));
		$data['tanggal'] = [
			'today' => date('Y-m-d'),
			'last_week' => $lastWeek,
			'last_month' => $lastMonth,
		];
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['project'] = $this->Project_model->get($status);
		$this->load->view("layout/header", $data);
		$this->load->view("project/vw_project", $data);
		$this->load->view("layout/footer", $data);
	}
	public function addproject()
	{
		//Validasi Data Tidak Boleh Kosong
		$this->form_validation->set_rules('nama_projek', 'Nama Project', 'required', array(
			'required' => 'Nama Project Wajib di isi!!!'
		));

		$this->form_validation->set_rules('domain', 'Domain', 'required', array(
			'required' => 'domain Wajib di isi!!!'
		));

		$this->form_validation->set_rules('package', 'Package', 'required', array(
			'required' => 'Nama Project Wajib di isi!!!'
		));

		$this->form_validation->set_rules('id_client', 'Id client', 'required', array(
			'required' => 'Id client Wajib di isi!!!'
		));

		$this->form_validation->set_rules('latitude', 'Latitude', 'required', array(
			'required' => 'Latitude Wajib di isi!!!'
		));

		$this->form_validation->set_rules('longitude', 'Longitude', 'required', array(
			'required' => 'Longitude Wajib di isi!!!'
		));

		$this->form_validation->set_rules('start_date', 'Start date', 'required', array(
			'required' => 'Start date Wajib di isi!!!'
		));

		$this->form_validation->set_rules('end_date', 'End date', 'required', array(
			'required' => 'End date Wajib di isi!!!'
		));

		$this->form_validation->set_rules('status', 'Status', 'required', array(
			'required' => 'Status Wajib di isi!!!'
		));

		$this->form_validation->set_rules('ketua_projek', 'Ketua projek', 'required', array(
			'required' => 'Ketua projek Wajib di isi!!!'

		));

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'judul' => "Pemetaan Project | Tambah Project"
			);
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['client'] = $this->Client_model->get();
			$this->load->view("layout/header", $data);
			$this->load->view("project/vw_tambah_project", $data);
			$this->load->view("layout/footer");
		} else {
			$data = array(
				'nama_projek' => $this->input->post('nama_projek'),
				'domain' => $this->input->post('domain'),
				'package' => $this->input->post('package'),
				'id_client' => $this->input->post('id_client'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'status' => $this->input->post('status'),
				'ketua_projek' => $this->input->post('ketua_projek'),
			);
			$status = $this->input->post('status');
			if ($status == "Aktif") {
				$id_client = $this->input->post('id_client');
				$client = ['status_kerja_sama' => 'Aktif'];
				$input = $this->Client_model->update(['id_client' => $id_client], $client);
			}
			$id = $this->Project_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Ditambah!</div>');
			redirect('Project/index/');
		}
	}

	function list($id = "")
	{
		$data['judul'] = "Halaman Detail Project";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['project'] = $this->Project_model->getByClient($id);
		if ($data['project']['id_client'] == "") {
            echo "<script>alert('Data Client tidak ditemukan'); window.location.href = '" . base_url('Client') . "';</script>";
        }
		// print_r($data['project']);die;
		$this->load->view("layout/header", $data);
		$this->load->view("project/vw_list_project", $data);
		$this->load->view("layout/footer", $data);
	}

	function detail($id = "")
	{
		$data['judul'] = "Halaman Detail Project";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['project'] = $this->Project_model->getById($id);
		if ($data['project']['kode_projek'] == "") {
            echo "<script>alert('Data Projek tidak ditemukan'); window.location.href = '" . base_url('Project') . "';</script>";
        }
		// print_r($data['project']);die;
		$this->load->view("layout/header", $data);
		$this->load->view("project/vw_detail_project", $data);
		$this->load->view("layout/footer", $data);
	}
	function edit($id = "")
	{
		$data['judul'] = "Halaman Edit Project";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['client'] = $this->Client_model->get();
		$data['project'] = $this->Project_model->getById($id);
		if ($data['project']['kode_projek'] == "") {
            echo "<script>alert('Data Projek tidak ditemukan'); window.location.href = '" . base_url('Project') . "';</script>";
        }
		$this->load->view("layout/header", $data);
		$this->load->view("project/vw_edit_project", $data);
		$this->load->view("layout/footer", $data);
	}
	function update()
	{
		$data = [
			'nama_projek' => $this->input->post('nama_projek'),
			'domain' => $this->input->post('domain'),
			'package' => $this->input->post('package'),
			'id_client' => $this->input->post('id_client'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'status' => $this->input->post('status'),
			'ketua_projek' => $this->input->post('ketua_projek'),
		];
		$id = $this->input->post('kode_projek');
		$projek = [
			'kode_projek' => $id,
			'status' => $this->input->post('status')
		];
		test($this->input->post('id_client'), $projek);
		$input = $this->Project_model->update(['kode_projek' => $id], $data);
		// $this->db->error(); 
		// die;
		redirect('Project/detail/' . $id);
	}
	function export_csv()
	{
		$file_name = 'Project_Export_on_' . date('Ymd') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Content-Type: application/csv;");

		// get data 
		$whare = [
            "mulai"=> $this->input->post('mulai'),
            "sampai"=> $this->input->post('sampai')
        ];
		$client_data = $this->Project_model->fetch_data($whare);

		// file creation 
		$file = fopen('php://output', 'w');

		$header = array("kode_projek,nama_projek,domain,package,id_client,latitude,longitude,start_date,end_date,status,ketua_projek");
		fputcsv($file, $header);
		foreach ($client_data->result_array() as $key => $value) {
			fputcsv($file, $value);
		}
		fclose($file);
		exit;
	}

	function hapus($id)
	{
		$this->Project_model->delete($id);
		redirect('Project');
	}
}
