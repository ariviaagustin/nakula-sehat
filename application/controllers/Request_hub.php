<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_hub extends CI_Controller {
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
		$data['get_request'] = $this->M_entitas->order_by_where('request_hub_penilai', array('status' => 1), 'request_date', 'ASC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('request_hub_penilai/index', $data);
		$this->load->view('shared/footer_akun');
	}

	public function request_hubungi_penilai()
	{
		$id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

		$data = array(
			'id_kurikulum' => $id_kurikulum,
			'status' => 1,
			'request_date' => date('Y-m-d H:i:s'),
			'request_by' => $this->session->userdata('id_user'),
		);
		$query = $this->M_entitas->all_insert('request_hub_penilai', $data);

		redirect('list-pengisian-kurikulum/'.bin2hex(base64_encode($id_kurikulum)));
	}

	public function acc_request_hubungi_penilai()
	{
		$id_request_hub_penilai = base64_decode(hex2bin($this->uri->segment(2)));

		$data = array(
			'status' => 2,
			'acc_date' => date('Y-m-d H:i:s'),
			'acc_by' => $this->session->userdata('id_user'),
		);
		$where = array('id_request_hub_penilai' => $id_request_hub_penilai);
		$query = $this->M_entitas->all_update('request_hub_penilai', $data, $where);

		redirect('request-hubungi-penilai-institusi');
	}
}