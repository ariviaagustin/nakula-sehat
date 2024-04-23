<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_institusi extends CI_Controller {
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
        if($this->session->userdata('id_role') == 1)
        {
            $data['sdm'] = $this->M_entitas->get_order('sdm_institusi', 'id_sdm_institusi', 'DESC')->result();
            $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();
        }
        else if($this->session->userdata('id_role') == 2)
        {
            $data['sdm'] = $this->M_entitas->order_by_where('sdm_institusi', array('id_institusi_siaksi' => $this->session->userdata('id_institusi_siaksi')), 'id_sdm_institusi', 'DESC')->result();
            $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();
        }

		$this->load->view('shared/header_akun');
		$this->load->view('sdm_institusi/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function buat_akun()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));
        $data['sdm'] = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('sdm_institusi/buat_akun', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_buat_akun()
    {
        $data = array(
            'id_sdm_siaksi' => $this->input->post('id_sdm_siaksi'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),          
            'id_role' => 4,
            'role' => 'pj substansi',
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('user', $data);

        $id_user = $this->db->insert_id();

        $data_pass = array(
            'id_user' => $id_user,
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );
        $query_pass = $this->M_entitas->all_insert('another', $data_pass);

        $data_sdm = array(
            'id_user' => $id_user,
        );
        $where_sdm = array('id_sdm_institusi'=>$this->input->post('id_sdm_institusi'));
        $query_sdm = $this->M_entitas->all_update('sdm_institusi', $data_sdm, $where_sdm);

        redirect('sdm-institusi');
    }

    public function aksi_tarik_data()
    {
        $a = $this->get_api_sdm_institusi();
        $b = json_decode($a,true);
        $get_data = $b['data'];

        if($get_data)
        {
            foreach ($get_data as $key)
            {
                $cek = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_siaksi' => $key['id_sdm']))->row();
                if(!$cek)
                {
                    $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi_siaksi' => $key['id_institusi']))->row();

                    if($get_institusi)
                    {
                        $data = array(
                            'id_institusi' => $get_institusi->id_institusi,
                            'id_sdm_siaksi' => $key['id_sdm'],
                            'id_institusi_siaksi' => $key['id_institusi'],
                            'nama_institusi' => $get_institusi->nama_institusi,
                            'nama_sdm' => $key['nama_sdm'],
                            'nik' => $key['nik'],
                            'status_sdm' => $key['status_sdm'],
                            'keterangan_status' => $key['keterangan_status']
                        );
                        $query = $this->M_entitas->all_insert('sdm_institusi', $data);
                    }
                }   
            }
            redirect('sdm-institusi');
        }
        else
        {
            $message['msg-gagal'] = 'SDM Tidak Tersedia di SIAKSI';
            $this->session->set_flashdata($message);
            redirect('sdm-institusi');
        }
    }

    public function get_api_sdm_institusi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_akses_ins/institusi_sdm',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi'),
          CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=maimdlqsvqnmkj6m3dg8q5mrj049vnkm'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function aksi_tarik_sdm_by_institusi()
    {
        $id_institusi_siaksi = $this->input->post('id_institusi_siaksi');

        $a = $this->get_api_sdm_by_institusi($id_institusi_siaksi);
        $b = json_decode($a,true);
        $get_data = $b['data'];

        if($get_data)
        {
            $this->M_entitas->delete_data('sdm_institusi', array('id_institusi_siaksi' => $id_institusi_siaksi));

            foreach ($get_data as $key)
            {
                $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi_siaksi' => $key['id_institusi']))->row();

                $data = array(
                    'id_institusi' => $get_institusi->id_institusi,
                    'id_sdm_siaksi' => $key['id_sdm'],
                    'id_institusi_siaksi' => $key['id_institusi'],
                    'nama_institusi' => $get_institusi->nama_institusi,
                    'nama_sdm' => $key['nama_sdm'],
                    'nik' => $key['nik'],
                    'status_sdm' => $key['status_sdm'],
                    'keterangan_status' => $key['keterangan_status']
                );
                $query = $this->M_entitas->all_insert('sdm_institusi', $data);

                $cek_user = $this->M_entitas->selectX('user', array('id_sdm_siaksi' => $key['id_sdm']))->row();
                if($cek_user)
                {
                    $data = array(
                        'id_user' => $cek_user->id_user,
                    );
                    $where = array('id_sdm_siaksi' => $key['id_sdm']);
                    $this->M_entitas->all_update('sdm_institusi', $data, $where);
                }
            }

            $message['msg-berhasil'] = 'Berhasil';
            $this->session->set_flashdata($message);
            redirect('sdm-institusi');
        }
        else
        {
            $message['msg-gagal'] = 'SDM Tidak Tersedia di SIAKSI';
            $this->session->set_flashdata($message);
            redirect('sdm-institusi');
        }
    }

    public function aksi_tarik_sdm_by_institusi_institusi()
    {
        $id_institusi_siaksi = base64_decode(hex2bin($this->uri->segment(2)));

        $a = $this->get_api_sdm_by_institusi($id_institusi_siaksi);
        $b = json_decode($a,true);
        $get_data = $b['data'];

        if($get_data)
        {
            $this->M_entitas->delete_data('sdm_institusi', array('id_institusi_siaksi' => $id_institusi_siaksi));

            foreach ($get_data as $key)
            {
                $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi_siaksi' => $key['id_institusi']))->row();

                $data = array(
                    'id_institusi' => $get_institusi->id_institusi,
                    'id_sdm_siaksi' => $key['id_sdm'],
                    'id_institusi_siaksi' => $key['id_institusi'],
                    'nama_institusi' => $get_institusi->nama_institusi,
                    'nama_sdm' => $key['nama_sdm'],
                    'nik' => $key['nik'],
                    'status_sdm' => $key['status_sdm'],
                    'keterangan_status' => $key['keterangan_status']
                );
                $query = $this->M_entitas->all_insert('sdm_institusi', $data);

                $cek_user = $this->M_entitas->selectX('user', array('id_sdm_siaksi' => $key['id_sdm']))->row();
                if($cek_user)
                {
                    $data = array(
                        'id_user' => $cek_user->id_user,
                    );
                    $where = array('id_sdm_siaksi' => $key['id_sdm']);
                    $this->M_entitas->all_update('sdm_institusi', $data, $where);
                }
            }

            $message['msg-berhasil'] = 'Berhasil';
            $this->session->set_flashdata($message);
            redirect('sdm-institusi');
        }
        else
        {
            $message['msg-gagal'] = 'SDM Tidak Tersedia di SIAKSI';
            $this->session->set_flashdata($message);
            redirect('sdm-institusi');
        }
    }

    public function get_api_sdm_by_institusi($id_institusi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_akses_ins/institusi_sdm',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi','id_institusi' => $id_institusi),
          CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=tijf50mi1jcnmng3icptpi3tvib1873t'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}