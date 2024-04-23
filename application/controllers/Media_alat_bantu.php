<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media_alat_bantu extends CI_Controller {
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
		$data['media_alat_bantu'] = $this->M_entitas->get_order('entitas__media_alat_bantu', 'id_media_alat_bantu', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('media_alat_bantu/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $data['metode'] = $this->M_entitas->selectX('entitas__metode', array('status' => 1, 'is_penugasan' => 1))->result();

        $this->load->view('shared/header_akun', $data);
        $this->load->view('media_alat_bantu/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $id_metode = $this->input->post('id_metode');
        $get_metode = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id_metode))->row();
        $metode = $get_metode->metode;

        $data = array(
            'id_metode' => $id_metode,
            'metode' => $metode,
            'media_alat_bantu' => $this->input->post('media_alat_bantu'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user'),
        );
        $query = $this->M_entitas->all_insert('entitas__media_alat_bantu', $data);

        redirect('media-alat-bantu');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['media_alat_bantu'] = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_media_alat_bantu' => $id))->row();
        $data['metode'] = $this->M_entitas->selectX('entitas__metode', array('status' => 1, 'is_penugasan' => 1))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('media_alat_bantu/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $id_metode = $this->input->post('id_metode');
        $get_metode = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id_metode))->row();
        $metode = $get_metode->metode;

        $data = array(
            'id_metode' => $id_metode,
            'metode' => $metode,
            'media_alat_bantu' => $this->input->post('media_alat_bantu'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_media_alat_bantu' => $this->input->post('id_media_alat_bantu'));
        $this->M_entitas->all_update('entitas__media_alat_bantu', $data, $where);

        redirect('media-alat-bantu');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $this->M_entitas->delete_data('entitas__media_alat_bantu', array('id_media_alat_bantu' => $id));

        redirect('media-alat-bantu');
    }
}