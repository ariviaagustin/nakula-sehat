<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->model('M_view');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
        if($this->session->userdata('id_role') == 2)
        {
            $data['profil'] = $this->M_entitas->selectX('institusi', array('id_institusi' => $this->session->userdata('id_institusi')))->row();

            $this->load->view('shared/header_akun');
            $this->load->view('profil/index_institusi', $data);
            $this->load->view('shared/footer_akun');
        }
        else if($this->session->userdata('id_role') == 4)
        {
            $data['profil'] = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi')))->row();

            $this->load->view('shared/header_akun');
            $this->load->view('profil/index_pj_institusi', $data);
            $this->load->view('shared/footer_akun');
        }
	}

    public function tarik_institusi()
    {
        $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi' => $this->session->userdata('id_institusi')))->row();

        $a = $this->get_api_instansi_by_id($get_institusi->id_institusi_siaksi);
        $b = json_decode($a,true);
        $get_data = $b['data'];
        $get_data = $get_data[0];

        if($get_data)
        {
            $data = array(
                'username' => $get_data['username'],
                'password' => md5($get_data['password']),
                'nama_lengkap' => $get_data['nama_institusi'],
            );
            $where = array('id_user' => $get_institusi->id_user);
            $query = $this->M_entitas->all_update('user', $data, $where);

            $data = array(
                'username' => $get_data['username'],
                'password' => $get_data['password'],
            );
            $where = array('id_user' => $get_institusi->id_user);
            $query = $this->M_entitas->all_update('another', $data, $where);

            $data = array(
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
            $where = array('id_institusi' => $get_institusi->id_institusi);
            $query = $this->M_entitas->all_update('institusi', $data, $where);

            $message['msg-berhasil'] = 'Berhasil';
            $this->session->set_flashdata($message);
            redirect('informasi-profil');
        }
    }

    public function tarik_sdm_institusi()
    {
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi')))->row();

        $a = $this->get_api_instansi_by_id($get_sdm->id_sdm_siaksi);
        $b = json_decode($a,true);
        $get_data = $b['data'];
        $get_data = $get_data[0];

        if($get_data)
        {
            $data = array(
                'nama_sdm' => $get_data['nama_sdm'],
                'nik' => $get_data['nik'],
                'email' => $get_data['email'],
                'status_sdm' => $get_data['status_sdm'],
                'keterangan_status' => $get_data['keterangan_status'],
            );
            $where = array('id_sdm_institusi' => $get_sdm->id_sdm_institusi);
            $query = $this->M_entitas->all_update('sdm_institusi', $data, $where);

            $message['msg-berhasil'] = 'Berhasil';
            $this->session->set_flashdata($message);
            redirect('informasi-profil');
        }
    }

    public function get_api_instansi_by_id($id_institusi_siaksi)
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
          CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi','id_institusi' => $id_institusi_siaksi),
          CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=jighciop8hd931p28ra7c8cksnuk1827'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}