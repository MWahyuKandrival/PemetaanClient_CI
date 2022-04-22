<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Client_model');
        $this->load->model('Project_model');
    }

    public function getData($id_client = ""){
        $data = $this->Client_model->getById($id_client);
        echo json_encode($data);
    }
    function index($status = "")
    {
        $data['judul'] = "Halaman Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->get($status);
        $data['client_data'] = $this->Client_model->fetch_data();
        $this->load->view("layout/header", $data);
        $this->load->view("map/vw_client", $data);
        $this->load->view("layout/footer", $data);
    }
    function detail($id = "")
    {
        $data['judul'] = "Halaman Detail Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->getById($id);
        // print_r($data['client']);die;
        $this->load->view("layout/header", $data);
        $this->load->view("map/vw_detail_client", $data);
        $this->load->view("layout/footer", $data);
    }
    function edit($id)
    {
        $data['judul'] = "Halaman Edit Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->getById($id);
        $this->load->view("layout/header", $data);
        $this->load->view("map/vw_edit_client", $data);
        $this->load->view("layout/footer", $data);
    }
    function update()
    {
        $data = [
            'nama_client' => $this->input->post('nama_client'),
            'pic' => $this->input->post('pic'),
            'alamat' => $this->input->post('alamat'),
            'negara' => $this->input->post('negara'),
            'region' => $this->input->post('region'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'domain' => $this->input->post('domain'),
            // 'mulai_kerja_sama' => $this->input->post('mulai_kerja_sama'),
            // 'henti_kerja_sama' => $this->input->post('henti_kerja_sama'),
            'status_kerja_sama' => $this->input->post('status_kerja_sama'),
        ];
        $status_kerja_sama = $this->input->post('status_kerja_sama');
        if($status_kerja_sama == "Berakhir"){
            $id_client = $this->input->post('id_client');
			$project = ['status' => 'Berakhir'];
			$input = $this->Project_model->update(['id_client' => $id_client], $project);
        }
        $id = $this->input->post('id_client');
        $input = $this->Client_model->update(['id_client' => $id], $data);
        // $this->db->error(); 
        redirect('Client/detail/'.$id);
    }
    
	public function addClient()
	{
		//Validasi Data Tidak Boleh Kosong
		$this->form_validation->set_rules('nama_client', 'Nama Client', 'required', array(
			'required' => 'Nama Client Wajib di isi!!!'
		));

		$this->form_validation->set_rules('pic', 'Owner', 'required', array(
			'required' => 'Owner Wajib di isi!!!'
		));

		$this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
			'required' => 'Alamat Wajib di isi!!!'
		));

		$this->form_validation->set_rules('negara', 'Negara', 'required', array(
			'required' => 'Negara Wajib di isi!!!'
		));

		$this->form_validation->set_rules('region', 'Region', 'required', array(
			'required' => 'Region Wajib di isi!!!'
		));

		$this->form_validation->set_rules('email', 'Email', 'required', array(
			'required' => 'Email Wajib di isi!!!'
		));

		$this->form_validation->set_rules('no_hp', 'No HP', 'required', array(
			'required' => 'No HP Wajib di isi!!!'
		));

		$this->form_validation->set_rules('domain', 'Domain', 'required', array(
			'required' => 'Domain Wajib di isi!!!'
		));

		// $this->form_validation->set_rules('latitude', 'Latitude', 'required', array(
		// 	'required' => 'Latitude Wajib di isi!!!'
		// ));

		// $this->form_validation->set_rules('longitude', 'Longitude', 'required', array(
		// 	'required' => 'Longitude Wajib di isi!!!'
		// ));

		// $this->form_validation->set_rules('mulai_kerja_sama', 'Tanggal Mulai Kerja Sama', 'required', array(
		// 	'required' => 'Tanggal Mulai Kerja Sama Wajib di isi!!!'
		// ));

		// $this->form_validation->set_rules('status_kerja_sama', 'Status Kerja Sama', 'required', array(
		// 	'required' => 'Status Kerja Sama Wajib di isi!!!'
		// ));

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'judul' => "Pemetaan Client | Tambah Client"
			);
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$this->load->view("layout/header", $data);
			$this->load->view("map/vw_tambah_client", $data);
			$this->load->view("layout/footer");
		} else {
			$data = array(
				'nama_client' => $this->input->post('nama_client'),
				'pic' => $this->input->post('pic'),
				'alamat' => $this->input->post('alamat'),
				'negara' => $this->input->post('negara'),
				'region' => $this->input->post('region'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'domain' => $this->input->post('domain'),
				// 'latitude' => $this->input->post('latitude'),
				// 'longitude' => $this->input->post('longitude'),
				'status_kerja_sama' => $this->input->post('status_kerja_sama'),
				);
			$id = $this->Client_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Ditambah!</div>');
			redirect('Client/detail/'.$id);
		}
	}

    function hapus($id)
	{
        $this->Project_model->deleteClient($id);
		$this->Client_model->delete($id);
		redirect('Client');
	}

    // public function export()
    // {
    //     $dompdf = new Dompdf();
    //     $this->data['all_jual'] = $this->Client_model->get();
    //     $this->data['title'] = 'Laporan Data Client';
    //     $this->data['no'] = 1;
    //     $dompdf->setPaper('A4', 'Portrait');
    //     $html = $this->load->view('laporan/report', $this->data, true);
    //     $dompdf->load_html($html);
    //     $dompdf->render();
    //     $dompdf->stream('Laporan Data Tanggal ' . date('d F Y'), array("Attachment" => false));
    // }

    function export_csv()
    {
     $file_name = 'Client_Export_on_'.date('Ymd').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $client_data = $this->Client_model->fetch_data();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("id_client", "nama_client", "pic", "alamat", "negara", "region", "email", "no_hp", "domain", "status_kerja_sama"); 
     fputcsv($file, $header);
     foreach ($client_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
    }

    public function cekDate()
    {
        $today = date("Y-M-D");
        echo $today;
    }
    
    public function test(){
        $this->load->view("layout/header");
        $this->load->view("map/test");
        $this->load->view("layout/footer");
    }
}
