<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_akun extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
        $data['user'] = $this->M_entitas->selectX('user', array('id_user'=>$this->session->userdata('id_user')))->row();
        $data['another'] = $this->M_entitas->selectX('another', array('id_user'=>$this->session->userdata('id_user')))->row();

		$this->load->view('shared/header_akun');
		$this->load->view('pengaturan_akun/index', $data);
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
		);
		$where = array('id_user' => $this->input->post('id_user'));
		$query = $this->M_entitas->all_update('user', $data, $where);

		$data_pass = array(
			'username' => $this->input->post('username'),
			'password' => $pass,
		);
		$query_pass = $this->M_entitas->all_update('another', $data_pass, $where);

		$message['msg'] = "<i class = 'fa fa-check'></i> Berhasil";
      	$this->session->set_flashdata($message);
		redirect('pengaturan-akun');
	}
}