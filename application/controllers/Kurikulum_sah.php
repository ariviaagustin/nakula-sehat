<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum_sah extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->model('M_view');
        $this->load->helper('judul_helper');
        $this->load->helper('kurikulum_siakpel_helper');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
		$data['kurikulum'] = $this->M_entitas->order_by_where('kurikulum', array('status' => 13), 'id_kurikulum', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('kurikulum_sah/index', $data);
		$this->load->view('shared/footer_akun');
	}
}