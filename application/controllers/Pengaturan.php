<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
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


	public function logo()
	{
		$data['datalogo'] = $this->M_entitas->selectSemua('logo')->row();
		$data['logo'] = $this->M_entitas->selectSemua('logo')->row();

		$this->load->view('shared/header_akun', $data);
		$this->load->view('pengaturan/logo');
		$this->load->view('shared/footer_akun');
	}

	public function ubah_logo($id)
	{
		$id = base64_decode(hex2bin($this->uri->segment(2)));
		$data['datalogo'] = $this->M_entitas->selectX('logo', array('id_logo' => $id))->row();

		$data['logo'] = $this->M_entitas->selectSemua('logo')->row();

		$this->load->view('shared/header_akun', $data);
		$this->load->view('pengaturan/ubah_logo');
		$this->load->view('shared/footer_akun');
	}

	public function aksi_ubah_logo()
	{
		$id_logo = $this->input->post('id_logo');

	    if(isset($_FILES['logo']['name']))
        {
            $config['upload_path']   = './agenda/perdata/bg';
		    $config['file_name']     = rand(0,999999).date('YmdHis');
		    $config['overwrite']     = true;
		    $config['allowed_types']     = '*';
		    $this->upload->initialize($config);
            if(!$this->upload->do_upload('logo'))
            {
                $logo = $this->input->post('logo_old');
            }
            else
            {
                $logo = $this->upload->data()['file_name'];
                $logo_old = './agenda/perdata/bg/'.$this->input->post('logo_old');
				if(file_exists($logo_old)) { unlink($logo_old); }
            }
        }
        else
        {
        	$logo = $this->input->post('logo_old');
        }

		$data = array(
			'logo' => $logo,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('id_user'),
		);
		$where = array('id_logo' => $id_logo);
		$query = $this->M_entitas->all_update('logo', $data, $where);

		redirect('pengaturan-logo');
	}
}