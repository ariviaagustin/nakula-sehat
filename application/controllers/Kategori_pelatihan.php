<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_pelatihan extends CI_Controller {
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
		$data['kategori'] = $this->M_entitas->get_order('master__kategori_pelatihan', 'kategori_pelatihan_id', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('kategori_pelatihan/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('kategori_pelatihan/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $data = array(
            'kategori_pelatihan_name' => $this->input->post('kategori_pelatihan_name'),
            'kategori_pelatihan_status' => $this->input->post('kategori_pelatihan_status'),
            'kategori_pelatihan_updated' => date('Y-m-d H:i:s'),
        );
        $query = $this->M_entitas->all_insert('master__kategori_pelatihan', $data);

        redirect('kategori-pelatihan');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kategori'] = $this->M_entitas->selectX('master__kategori_pelatihan', array('kategori_pelatihan_id' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kategori_pelatihan/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $data = array(
            'kategori_pelatihan_name' => $this->input->post('kategori_pelatihan_name'),
            'kategori_pelatihan_status' => $this->input->post('kategori_pelatihan_status'),
            'kategori_pelatihan_updated' => date('Y-m-d H:i:s'),
        );
        $where = array('kategori_pelatihan_id' => $this->input->post('kategori_pelatihan_id'));
        $this->M_entitas->all_update('master__kategori_pelatihan', $data, $where);

        redirect('kategori-pelatihan');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $this->M_entitas->delete_data('master__kategori_pelatihan', array('kategori_pelatihan_id' => $id));

        redirect('kategori-pelatihan');
    }
}