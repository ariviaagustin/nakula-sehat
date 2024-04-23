<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanggal_merah extends CI_Controller {
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
		$data['tanggal_merah'] = $this->M_entitas->get_order('tanggal_merah', 'id_tanggal_merah', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('tanggal_merah/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('tanggal_merah/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $data = array(
            'tanggal_merah' => $this->input->post('tanggal_merah'),
            'keterangan' => $this->input->post('keterangan'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user'),
        );
        $query = $this->M_entitas->all_insert('tanggal_merah', $data);

        redirect('tanggal-merah');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['tanggal_merah'] = $this->M_entitas->selectX('tanggal_merah', array('id_tanggal_merah' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('tanggal_merah/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $data = array(
            'tanggal_merah' => $this->input->post('tanggal_merah'),
            'keterangan' => $this->input->post('keterangan'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user'),
        );
        $where = array('id_tanggal_merah' => $this->input->post('id_tanggal_merah'));
        $this->M_entitas->all_update('tanggal_merah', $data, $where);

        redirect('tanggal-merah');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $this->M_entitas->delete_data('tanggal_merah', array('id_tanggal_merah' => $id));

        redirect('tanggal-merah');
    }
}