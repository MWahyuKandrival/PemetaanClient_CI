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
    }

    public function getData($id_client = ""){
        $data = $this->Client_model->getById($id_client);
        echo json_encode($data);
    }
    function index()
    {
        $data['judul'] = "Halaman Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->get();
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
            'owner' => $this->input->post('owner'),
            'alamat' => $this->input->post('alamat'),
            'negara' => $this->input->post('negara'),
            'region' => $this->input->post('region'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'domain' => $this->input->post('domain'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'mulai_kerja_sama' => $this->input->post('mulai_kerja_sama'),
            'henti_kerja_sama' => $this->input->post('henti_kerja_sama'),
            'status_kerja_sama' => $this->input->post('status_kerja_sama'),
        ];
        $id = $this->input->post('id_client');
        $input = $this->Client_model->update(['id_client' => $id], $data);
        // $this->db->error(); 
        redirect('Client/detail/').$id;
    }
    function hapus($id)
	{
		$this->Client_model->delete($id);
		redirect('Client');
	}
    public function export()
    {
        $dompdf = new Dompdf();
        $this->data['all_jual'] = $this->Client_model->get();
        $this->data['title'] = 'Laporan Data Client';
        $this->data['no'] = 1;
        $dompdf->setPaper('A4', 'Portrait');
        $html = $this->load->view('laporan/report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Tanggal ' . date('d F Y'), array("Attachment" => false));
    } 
}

?>