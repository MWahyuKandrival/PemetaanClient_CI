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
		$data = array();
        
        // Get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        
        // Get rows
        $data['project'] = $this->Project_model->getRows();

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

		$header = array("kode_projek","nama_projek","domain","package","id_client","latitude","longitude","start_date","end_date","status","ketua_projek");
		fputcsv($file, $header);
		foreach ($client_data->result_array() as $key => $value) {
			fputcsv($file, $value, ";", '"');
		}
		fclose($file);
		exit;
	}

	function hapus($id)
	{
		$this->Project_model->delete($id);
		redirect('Project');
	}

	public function import()
    {
        $data = array();
        $memData = array();

        // If import request is submitted
        if ($this->input->post('importSubmit')) {
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            // Validate submitted form data
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                // If file uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Load CSV reader library
                    $this->load->library('CSVReader');

                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    // print_r($csvData);die;
                    // Insert/update CSV data into database
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $rowCount++;

                            // Prepare data for DB insertion
                            $memData = array(
                                'kode_projek' => $row['kode_projek'],
                                'nama_projek' => $row['nama_projek'],
                                'domain' => $row['domain'],
                                'package' => $row['package'],
                                'id_client' => $row['id_client'],
                                'latitude' => $row['latitude'],
                                'longitude' => $row['longitude'],
                                'start_date' => $row['start_date'],
                                'end_date' => $row['end_date'],
                                'status' => $row['status'],
								'ketua_projek' => $row['ketua_projek'],
                            );

                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'kode_projek' => $row['kode_projek']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Project_model->getRows($con);
							// print_r($prevCount);die;
                            if ($prevCount > 0) {
                                // Update member data
                                $condition = array('kode_projek' => $row['kode_projek']);
                                $update = $this->Project_model->updateimport($memData, $condition);
								// print_r($update);die;
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                // Insert member data
                                $insert = $this->Project_model->insertimport($memData);

                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Project imported successfully. Total Rows (' . $rowCount . ') | Inserted (' . $insertCount . ') | Updated (' . $updateCount . ') | Not Inserted (' . $notAddCount . ')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('Project');
    }

    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}
