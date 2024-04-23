<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institusi extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->model('M_view');
		$this->load->model('M_new');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
		$data['institusi'] = $this->M_entitas->get_order('institusi', 'id_institusi', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('institusi/index', $data);
		$this->load->view('shared/footer_akun');
	}

	public function aksi_tarik_data()
	{
		$a = $this->get_api_instansi();
        $b = json_decode($a,true);
        $get_data = $b['data'];

        if($get_data)
        {
        	foreach ($get_data as $key)
	        {
	        	$cek = $this->M_entitas->selectX('institusi', array('id_institusi_siaksi' => $key['id_institusi']))->row();
	        	if(!$cek)
	        	{
	        		$data = array(
						'username' => $key['username'],
						'password' => md5($key['password']),
						'id_role' => 2,
						'role' => 'Institusi',
						'nama_lengkap' => $key['nama_institusi'],
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('id_user'),
					);
					$query = $this->M_entitas->all_insert('user', $data);

					$id_user = $this->db->insert_id();

					$data = array(
						'id_user' => $id_user,
						'username' => $key['username'],
						'password' => $key['password'],
					);
					$query = $this->M_entitas->all_insert('another', $data);

	        		$data = array(
	        			'id_user' => $id_user,
						'id_institusi_siaksi' => $key['id_institusi'],
						'kode_institusi' => $key['kode_institusi'],
						'nama_institusi' => $key['nama_institusi'],
						'email' => $key['email'],
						'alamat' => $key['alamat'],
						'lokasi_prov' => $key['lokasi_prov'],
						'lokasi_kab' => $key['lokasi_kab'],
						'lokasi_kec' => $key['lokasi_kec'],
						'lokasi_kel' => $key['lokasi_kel'],
						'status_aktif_ins' => $key['status_aktif_ins'],
						'keterangan_status' => $key['keterangan_status'],
						'status_akreditasi' => $key['status_akreditasi'],
						'keterangan_akreditasi' => $key['keterangan_akreditasi'],
						'id_user_siaksi' => $key['id_user'],
					);
					$query = $this->M_entitas->all_insert('institusi', $data);
	        	}	
	        }
        }

		redirect('institusi');
	}

	public function get_api_instansi()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_akses_ins',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi'),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=qahrb0mju9m0checsb4k9lm38m832pvp'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}

	public function aksi_tarik_data_by_email()
	{
		$email = $this->input->post('email');

		$a = $this->get_api_instansi_by_email($email);
        $b = json_decode($a,true);
        $get_data = $b['data'];
        $get_data = $get_data[0];

        if($get_data)
        {
        	$cek = $this->M_entitas->selectX('institusi', array('id_institusi_siaksi' => $get_data['id_institusi']))->row();
        	if(!$cek)
        	{
        		$data = array(
					'username' => $get_data['username'],
					'password' => md5($get_data['password']),
					'id_role' => 2,
					'role' => 'Institusi',
					'nama_lengkap' => $get_data['nama_institusi'],
					'status' => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id_user'),
				);
				$query = $this->M_entitas->all_insert('user', $data);

				$id_user = $this->db->insert_id();

				$data = array(
					'id_user' => $id_user,
					'username' => $get_data['username'],
					'password' => $get_data['password'],
				);
				$query = $this->M_entitas->all_insert('another', $data);

        		$data = array(
        			'id_user' => $id_user,
					'id_institusi_siaksi' => $get_data['id_institusi'],
					'kode_institusi' => $get_data['kode_institusi'],
					'nama_institusi' => $get_data['nama_institusi'],
					'email' => $get_data['email'],
					'alamat' => $get_data['alamat'],
					'lokasi_prov' => $get_data['lokasi_prov'],
					'lokasi_kab' => $get_data['lokasi_kab'],
					'lokasi_kec' => $get_data['lokasi_kec'],
					'lokasi_kel' => $get_data['lokasi_kel'],
					'status_aktif_ins' => $get_data['status_aktif_ins'],
					'keterangan_status' => $get_data['keterangan_status'],
					'status_akreditasi' => $get_data['status_akreditasi'],
					'keterangan_akreditasi' => $get_data['keterangan_akreditasi'],
					'id_user_siaksi' => $get_data['id_user'],
				);
				$query = $this->M_entitas->all_insert('institusi', $data);

				$message['msg-berhasil'] = 'Berhasil';
          		$this->session->set_flashdata($message);
				redirect('institusi');
        	}
        	else
        	{
        		$message['msg-gagal'] = 'Institusi Telah Tersedia';
          		$this->session->set_flashdata($message);
				redirect('institusi');
        	}
        }
	}

	public function get_api_instansi_by_email($email)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_akses_ins',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi','email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=sslaiev8a4srviqagh2jh6kd49e7qfaa'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}
}