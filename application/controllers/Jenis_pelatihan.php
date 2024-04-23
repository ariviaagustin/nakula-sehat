<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pelatihan extends CI_Controller {
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
		$data['jenis'] = $this->M_entitas->get_order('master__jenis_pelatihan', 'jenis_pelatihan_id', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('jenis_pelatihan/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('jenis_pelatihan/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $data = array(
            'jenis_pelatihan_name' => $this->input->post('jenis_pelatihan_name'),
            'jenis_pelatihan_status' => $this->input->post('jenis_pelatihan_status'),
            'jenis_pelatihan_updated' => date('Y-m-d H:i:s'),
        );
        $query = $this->M_entitas->all_insert('master__jenis_pelatihan', $data);

        redirect('jenis-pelatihan');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['jenis'] = $this->M_entitas->selectX('master__jenis_pelatihan', array('jenis_pelatihan_id' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('jenis_pelatihan/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $data = array(
            'jenis_pelatihan_name' => $this->input->post('jenis_pelatihan_name'),
            'jenis_pelatihan_status' => $this->input->post('jenis_pelatihan_status'),
            'jenis_pelatihan_updated' => date('Y-m-d H:i:s'),
        );
        $where = array('jenis_pelatihan_id' => $this->input->post('jenis_pelatihan_id'));
        $this->M_entitas->all_update('master__jenis_pelatihan', $data, $where);

        redirect('jenis-pelatihan');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $this->M_entitas->delete_data('master__jenis_pelatihan', array('jenis_pelatihan_id' => $id));

        redirect('jenis-pelatihan');
    }
}