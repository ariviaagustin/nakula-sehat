<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bab_dan_sub_bab extends CI_Controller {
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
		$data['bab'] = $this->M_entitas->get_order('bab', 'id_bab', 'ASC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('bab_dan_sub_bab/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function ubah_bab()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['bab'] = $this->M_entitas->selectX('bab', array('id_bab' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('bab_dan_sub_bab/ubah_bab', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_bab()
    {
        $data = array(
            'bab' => $this->input->post('bab'),
            'judul' => $this->input->post('judul'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_bab' => $this->input->post('id_bab'));
        $this->M_entitas->all_update('bab', $data, $where);

        if($this->input->post('status') == 2)
        {
            $cek = $this->M_entitas->selectX('sub_bab', array('id_bab' => $this->input->post('id_bab')))->result();
            if($cek)
            {
                foreach ($cek as $key) 
                {
                    $data = array(
                        'status' => 2
                    );
                    $where = array('id_sub_bab' => $key->id_sub_bab);
                    $this->M_entitas->all_update('sub_bab', $data, $where);
                }
            }
        }

        if($this->input->post('status') == 1)
        {
            $cek = $this->M_entitas->selectX('sub_bab', array('id_bab' => $this->input->post('id_bab')))->result();
            if($cek)
            {
                foreach ($cek as $key) 
                {
                    $data = array(
                        'status' => 1
                    );
                    $where = array('id_sub_bab' => $key->id_sub_bab);
                    $this->M_entitas->all_update('sub_bab', $data, $where);
                }
            }
        }

        redirect('bab-dan-sub-bab');
    }

    public function ubah_sub_bab()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['sub_bab'] = $this->M_entitas->selectX('sub_bab', array('id_sub_bab' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('bab_dan_sub_bab/ubah_sub_bab', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_sub_bab()
    {
        $data = array(
            'sub_bab' => $this->input->post('sub_bab'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_sub_bab' => $this->input->post('id_sub_bab'));
        $this->M_entitas->all_update('sub_bab', $data, $where);

        redirect('bab-dan-sub-bab');
    }
}