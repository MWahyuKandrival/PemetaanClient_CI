<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Map_model');
	}

	public function index()
	{
		$data['judul'] = "Pemetaan Client | Map";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// load vw_bank
		$this->load->view("layout/header", $data);
		$this->load->view("map/vw_map", $data);
		$this->load->view("layout/footer");
	}

	public function addClient()
	{
		//Validasi Data Tidak Boleh Kosong
		$this->form_validation->set_rules('nama_client', 'Nama Client', 'required', array(
			'required' => 'Nama Client Wajib di isi!!!'
		));

		$this->form_validation->set_rules('owner', 'Owner', 'required', array(
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

		$this->form_validation->set_rules('latitude', 'Latitude', 'required', array(
			'required' => 'Latitude Wajib di isi!!!'
		));

		$this->form_validation->set_rules('longitude', 'Longitude', 'required', array(
			'required' => 'Longitude Wajib di isi!!!'
		));

		$this->form_validation->set_rules('mulai_kerja_sama', 'Tanggal Mulai Kerja Sama', 'required', array(
			'required' => 'Tanggal Mulai Kerja Sama Wajib di isi!!!'
		));

		$this->form_validation->set_rules('status_kerja_sama', 'Status Kerja Sama', 'required', array(
			'required' => 'Status Kerja Sama Wajib di isi!!!'
		));

		$this->form_validation->set_rules('link_foto', 'Foto', 'required', array(
			'required' => 'Format Link upload Foto Drive --> https://drive.google.com/uc?export=view&id= [masukan id'
		));

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
				'nama' => $this->input->post('nama'),
				'jb_harga' => $this->input->post('jb_harga'),
				'jb_kepemilikan' => $this->input->post('jb_kepemilikan'),
				'jb_fungsi' => $this->input->post('jb_fungsi'),
				'jml_pendapatan' => $this->input->post('jml_pendapatan'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
				'latitude' => $this->input->post('latitude'),
				'link_foto' => $this->input->post('link_foto')
			);
			$this->m_bank->simpan($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Ditambah!</div>');
			redirect('home/');
		}
	}

	public function addRandomClient($limit = "")
	{
		$clients = $this->Map_model->tampil();
		for ($i = 1; $i < $limit; $i++) :

			$data = ['id_'];
		endfor;
	}

	public function getRandomLocation($longitude, $latitude, $ranRadius)
	{
		$longitude = (float) $longitude;
		$latitude = (float) $latitude;
		$radius = rand(1, $ranRadius); // in miles

		$lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
		$lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
		$lat_min = $latitude - ($radius / 69);
		$lat_max = $latitude + ($radius / 69);

		echo "Long-Max : " . $lng_max . "<br>";
		echo "Long-min : " . $lng_min . "<br>";
		echo "Long-Max : " . $lng_max . "<br>";
		echo "Long-min : " . $lng_min . "<br>";

		$randData = rand(1, 4);
		switch ($randData):
			case 1:
				$data = ['longitude' => $lng_min, 'latitude' => $lat_min];
				break;
			case 2:
				$data = ['longitude' => $lng_min, 'latitude' => $lat_max];
				break;
			case 3:
				$data = ['longitude' => $lng_max, 'latitude' => $lat_min];
				break;
			case 4:
				$data = ['longitude' => $lng_max, 'latitude' => $lat_max];
				break;
		endswitch;
		return $data;
	}

	public function updateClient()
	{
		$clients = $this->Map_model->tampil();

		foreach ($clients as $client) :
			$ranNegara = rand(1, 3);
			$ranKerjaSama = rand(1, 2);

			//Mengambil Value Negara, Region dan Koordinat
			switch ($ranNegara):
				case 1:
					$negara = "Indonesia";
					$ranRegion = rand(1, 5);
					switch ($ranRegion):
						case 1:
							$region = "Jawa";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 2:
							$region = "Sumatra";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.186486, 100);
							break;
						case 3:
							$region = "Kalimantan";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 4:
							$region = "Sulawesi";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 5:
							$region = "Papua";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
					endswitch;
					break;
				case 2:
					$negara = "Singapora";
					$ranRegion = rand(1, 5);
					switch ($ranRegion):
						case 1:
							$region = "Central Region";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 2:
							$region = "East Region";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 3:
							$region = "North Region";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 4:
							$region = "North-east Region";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 5:
							$region = "West Region";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
					endswitch;
					break;
				case 3:
					$negara = "Malaysia";
					$ranRegion = rand(1, 5);
					switch ($ranRegion):
						case 1:
							$region = "Johor";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 2:
							$region = "Kedah";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 3:
							$region = "Kelantan";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 4:
							$region = "Malacca ";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
						case 5:
							$region = "Negeri Sembilan";
							$dataKoordinat = $this->getRandomLocation(107.016802, -6.255237, 100);
							break;
					endswitch;
					break;
			endswitch;

			//Mengambil Value start end status kerja sama 
			$dataKerjaSama = [];
			$randDate = rand(1300000000, 1640000000);
			$mulai = date("Y-m-d", $randDate);
			$berakhir  = date("Y-m-d", strtotime(date("Y-m-d", strtotime($mulai)) . " + " . rand(1, 730) . " day"));

			switch ($ranKerjaSama):
				case 1:
					$dataKerjaSama['status_kerja_sama'] = "Aktif";
					$dataKerjaSama['mulai_kerja_sama'] = $mulai;
					$dataKerjaSama['henti_kerja_sama'] = "";
					break;
				case 2:
					$dataKerjaSama['status_kerja_sama'] = "Berakhir";
					$dataKerjaSama['mulai_kerja_sama'] = $mulai;
					$dataKerjaSama['henti_kerja_sama'] = $berakhir;
					break;
			endswitch;
			$client['negara'] = $negara;
			$client['region'] = $region;
			$client['longitude'] = $dataKoordinat['longitude'];
			$client['latitude'] = $dataKoordinat['latitude'];
			$client['mulai_kerja_sama'] = $dataKerjaSama['mulai_kerja_sama'];
			$client['henti_kerja_sama'] = $dataKerjaSama['henti_kerja_sama'];
			$client['status_kerja_sama'] = $dataKerjaSama['status_kerja_sama'];
			$this->Map_model->update(["id_client" => $client['id_client']], $client);
		endforeach;
	}
}
