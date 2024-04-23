<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Metode extends CI_Controller {
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
		$data['metode'] = $this->M_entitas->get_order('entitas__metode', 'id_metode', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('metode/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('metode/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $data = array(
            'metode' => $this->input->post('metode'),
            'is_penugasan' => $this->input->post('is_penugasan'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user'),
        );
        $query = $this->M_entitas->all_insert('entitas__metode', $data);

        redirect('metode');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['metode'] = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('metode/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $data = array(
            'metode' => $this->input->post('metode'),
            'is_penugasan' => $this->input->post('is_penugasan'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_metode' => $this->input->post('id_metode'));
        $this->M_entitas->all_update('entitas__metode', $data, $where);

        redirect('metode');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $metode = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id))->row();

        $this->M_entitas->delete_data('entitas__media_alat_bantu', array('id_metode' => $metode->id_metode));
        $this->M_entitas->delete_data('entitas__metode', array('id_metode' => $id));

        redirect('metode');
    }
}