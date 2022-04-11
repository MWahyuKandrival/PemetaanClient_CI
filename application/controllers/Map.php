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
			// // Tampil SELEKSI JB-FUNGSI
			// 'filterBU' => $this->db->like('jb_fungsi','Bank Umum'),
			// 'filterBU'=> $this->Map_model->tampil(),
			// 'filterBST' => $this->db->like('jb_fungsi','Bank Sentral'),
			// 'filterBST'=> $this->Map_model->tampil(),
			// 'filterBPR' => $this->db->like('jb_fungsi','Bank Perkreditan Rakyat'),
			// 'filterBPR'=> $this->Map_model->tampil(),
			// // Tampil SELEKSI JB-KEPEMILIKAN
			// 'filterBMP' => $this->db->like('jb_kepemilikan','Bank Milik Pemerintah'),
			// 'filterBMP'=> $this->Map_model->tampil(),
			// 'filterBSMN' => $this->db->like('jb_kepemilikan','Bank Swasta Milik Nasional'),
			// 'filterBSMN'=> $this->Map_model->tampil(),
			// 'filterBPD' => $this->db->like('jb_kepemilikan','Bank Pembangunan Daerah'),
			// 'filterBPD'=> $this->Map_model->tampil(),
			// 'filterBA' => $this->db->like('jb_kepemilikan','Bank Asing'),
			// 'filterBA'=> $this->Map_model->tampil(),
			// 'filterBMC' => $this->db->like('jb_kepemilikan','Bank Milik Campuran'),
			// 'filterBMC'=> $this->Map_model->tampil(),
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
				'status_kerja_sama' => $this->input->post('status_kerja_sama'),
				);
			$id = $this->Client_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Ditambah!</div>');
			redirect('Client/detail/'.$id);
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

	public function addRandomProjek($limit = "")
	{
		$client = $this->Map_model->tampil();
		for($i = 1; $i < $limit; $i++)
		{
			$nama_projek = "Test ". $i;
			$domain = "domain".$i.".com";
			$ranPackage = rand(1,3);
			switch($ranPackage):
				case 1:
					$package = "Bronze";
					break;

				case 2:
					$package = "Silver";
					break;

				case 3:
					$package = "Gold";
					break;
			endswitch;
			$id_client =  $client[rand(0,99)]['id_client'];
			$randDate = rand(1300000000, 1640000000);
			$start_date = date("Y-m-d", $randDate);
			$ranStatus = rand(1,2);
			if($ranStatus == 1)
			{
				$status = "Berlangsung";
			}else{
				$status = "Selesai";
				$end_date  = date("Y-m-d", strtotime(date("Y-m-d", strtotime($start_date)) . " + " . rand(1, 730) . " day"));
			}
			$ketua_projek = "Doni Romdoni";
			$data = [
				"nama_projek" => $nama_projek,
				"domain" => $domain,
				"package" => $package,
				"id_client" => $id_client,
				"start_date" => $start_date,
				"end_date" => $end_date,
				"status" => $status,
				"ketua_projek" => $ketua_projek
			];

			$this->Project_model->insert($data);
		}
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
