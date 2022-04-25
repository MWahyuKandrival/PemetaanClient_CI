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

    public function getData($id_client = "")
    {
        $data = $this->Client_model->getById($id_client);
        echo json_encode($data);
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
        $data['client'] = $this->Client_model->getRows();
        $data['judul'] = "Halaman Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->get($status);
        // $data['client_data'] = $this->Client_model->fetch_data();
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
        if ($data['client']['id_client'] == "") {
            echo "<script>alert('Data Client tidak ditemukan'); window.location.href = '" . base_url('Client') . "';</script>";
        }
        $this->load->view("layout/header", $data);
        $this->load->view("map/vw_detail_client", $data);
        $this->load->view("layout/footer", $data);
    }
    function edit($id = "")
    {
        $data['judul'] = "Halaman Edit Client";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->Client_model->getById($id);
        if ($data['client']['id_client'] == "") {
            echo "<script>alert('Data Client tidak ditemukan'); window.location.href = '" . base_url('Client') . "';</script>";
        }
        $this->load->view("layout/header", $data);
        $this->load->view("map/vw_edit_client", $data);
        $this->load->view("layout/footer", $data);
    }
    function update()
    {
        if (isset($_POST['edit_client'])) {
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
            if ($status_kerja_sama == "Berakhir") {
                $id_client = $this->input->post('id_client');
                $project = ['status' => 'Berakhir'];
                $input = $this->Project_model->update(['id_client' => $id_client], $project);
            }
            $id = $this->input->post('id_client');
            $input = $this->Client_model->update(['id_client' => $id], $data);
            // $this->db->error(); 
            redirect('Client/detail/' . $id);
        } else {
            echo "<script>alert('UnAuthorized'); window.location.href = '" . base_url('Client') . "';</script>";
        }
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
            redirect('Client/detail/' . $id);
        }
    }

    function hapus($id = "")
    {
        $this->Project_model->deleteClient($id);
        $this->Client_model->delete($id);
        redirect('Client');
    }

    function export_csv()
    {
        $file_name = 'Client_Export_on_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // get data 
        $client_data = $this->Client_model->fetch_data();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("id_client", "nama_client", "pic", "alamat", "negara", "region", "email", "no_hp", "domain", "status_kerja_sama");
        fputcsv($file, $header);
        foreach ($client_data->result_array() as $key => $value) {
            fputcsv($file, $value, ";", '"');
        }
        fclose($file);
        exit;
    }

    public function cekDate()
    {
        $today = date("Y-M-D");
        echo $today;
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
                                'id_client' => $row['id_client'],
                                'nama_client' => $row['nama_client'],
                                'pic' => $row['pic'],
                                'alamat' => $row['alamat'],
                                'negara' => $row['negara'],
                                'region' => $row['region'],
                                'email' => $row['email'],
                                'no_hp' => $row['no_hp'],
                                'domain' => $row['domain'],
                                'status_kerja_sama' => $row['status_kerja_sama'],
                            );

                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'id_client' => $row['id_client']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Client_model->getRows($con);

                            if ($prevCount > 0) {
                                // Update member data
                                $condition = array('id_client' => $row['id_client']);
                                $update = $this->Client_model->updateimport($memData, $condition);

                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                // Insert member data
                                $insert = $this->Client_model->insertimport($memData);

                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Client imported successfully. Total Rows (' . $rowCount . ') | Inserted (' . $insertCount . ') | Updated (' . $updateCount . ') | Not Inserted (' . $notAddCount . ')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('Client');
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
