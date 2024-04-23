<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller {
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
		$data['user'] = $this->M_entitas->get_order('user', 'id_user', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('pengguna/index', $data);
		$this->load->view('shared/footer_akun');
	}

	public function tambah()
	{
		$this->load->view('shared/header_akun');
		$this->load->view('pengguna/tambah');
		$this->load->view('shared/footer_akun');
	}

	public function aksi_tambah()
	{
		$id_role = $this->input->post('id_role');
		if($id_role == 1){ $role = "Administrator"; }
		else if($id_role == 5){ $role = "Tim 1"; }
		else if($id_role == 6){ $role = "Tim 2"; }

		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),			
			'id_role' => $id_role,
			'role' => $role,
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

		redirect('pengguna');
	}

	public function ubah()
	{
		$id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['user'] = $this->M_entitas->selectX('user', array('id_user'=> $id))->row();
        $data['another'] = $this->M_entitas->selectX('another', array('id_user'=> $id))->row();

		$this->load->view('shared/header_akun');
		$this->load->view('pengguna/ubah', $data);
		$this->load->view('shared/footer_akun');
	}

	public function aksi_ubah()
	{
		if(!empty($this->input->post('password')))
		{
			$password = md5($this->input->post('password'));
			$pass = $this->input->post('password');
		}
		else
		{
			$password = $this->input->post('password_old');
			$pass = $this->input->post('pass_old');
		}

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $password,
			'status' => $this->input->post('status'),
		);
		$where = array('id_user'=>$this->input->post('id_user'));
		$query = $this->M_entitas->all_update('user', $data, $where);

		$data_pass = array(
			'username' => $this->input->post('username'),
			'password' => $pass,
		);
		$where_pass = array('id_user'=>$this->input->post('id_user'));
		$query_pass = $this->M_entitas->all_update('another', $data_pass, $where_pass);

		redirect('pengguna');
	}

	public function hapus()
	{
		$id = base64_decode(hex2bin($this->uri->segment(2)));

		$this->M_entitas->delete_data('another', array('id_user' => $id));
		$this->M_entitas->delete_data('user', array('id_user' => $id));

		redirect('pengguna');
	}

	public function get_detail_akun()
    {
        $data['akun'] = $this->M_entitas->selectX('another', array('id_user' => $this->input->post('id')))->row();
        $data['user'] = $this->M_entitas->selectX('user', array('id_user' => $this->input->post('id')))->row();

        $this->load->view('pengguna/get_detail_akun', $data);
    }
	
}