<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_pengesah extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->helper('judul_helper');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
		$data['pengesah'] = $this->M_entitas->selectSemua('master_pengesah')->result();
		$data['logo'] = $this->M_entitas->selectSemua('logo')->row();

		$this->load->view('shared/header_akun', $data);
		$this->load->view('master_pengesah/index');
		$this->load->view('shared/footer_akun');
	}

	public function ubah()
	{
		$id = base64_decode(hex2bin($this->uri->segment(2)));
		$data['pengesah'] = $this->M_entitas->selectX('master_pengesah', array('id_master_pengesah' => $id))->row();

		$data['logo'] = $this->M_entitas->selectSemua('logo')->row();

		$this->load->view('shared/header_akun', $data);
		$this->load->view('master_pengesah/ubah');
		$this->load->view('shared/footer_akun');
	}

	public function aksi_ubah()
	{
		$id_master_pengesah = $this->input->post('id_master_pengesah');

	    if(isset($_FILES['ttd']['name']))
        {
            $config['upload_path']   = './agenda/perdata/pengesah';
		    $config['file_name']     = rand(0,999999).date('YmdHis');
		    $config['overwrite']     = true;
		    $config['allowed_types']     = '*';
		    $this->upload->initialize($config);
            if(!$this->upload->do_upload('ttd'))
            {
                $ttd = $this->input->post('ttd_old');
            }
            else
            {
                $ttd = $this->upload->data()['file_name'];
                $ttd_old = './agenda/perdata/pengesah/'.$this->input->post('ttd_old');
				if(file_exists($ttd_old)) { unlink($ttd_old); }
            }
        }
        else
        {
        	$ttd = $this->input->post('ttd_old');
        }

		$data = array(
			'nama' => $this->input->post('nama'),
			'jabatan' => $this->input->post('jabatan'),
			'nip' => $this->input->post('nip'),
			'ttd' => $ttd,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('id_user'),
		);
		$where = array('id_master_pengesah' => $id_master_pengesah);
		$query = $this->M_entitas->all_update('master_pengesah', $data, $where);

		redirect('master-pengesah');
	}
}