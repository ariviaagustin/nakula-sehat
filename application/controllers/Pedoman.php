<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedoman extends CI_Controller {
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
		$data['pedoman'] = $this->M_entitas->selectSemua('pedoman')->row();

		$this->load->view('shared/header_akun');
		$this->load->view('pedoman/index', $data);
		$this->load->view('shared/footer_akun');
	}

	public function ubah()
	{
		$data['pedoman'] = $this->M_entitas->selectSemua('pedoman')->row();
		
		$this->load->view('shared/header_akun');
		$this->load->view('pedoman/ubah', $data);
		$this->load->view('shared/footer_new');
	}

	public function aksi_ubah()
	{
        if(isset($_FILES['pedoman']['name']))
        {
            $config['upload_path']   = './agenda/perdata/pedoman/';
	        $config['file_name']     = date('YmdHis'); 
	        $config['overwrite']     = true;
	        $config['allowed_types']     = '*';
	        $this->upload->initialize($config);
            if(!$this->upload->do_upload('pedoman')){
                $pedoman = $this->input->post('pedoman_old');
            }else{
                $pedoman = $this->upload->data()['file_name'];
                $pedoman_old = './agenda/perdata/pedoman/'.$this->input->post('pedoman_old');
                if(file_exists($pedoman_old)) { unlink($pedoman_old); }
            }
        }

		$data = array(
			'pedoman' => $pedoman,
			'updated_by' => $this->session->userdata('id_user'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$where = array('id_pedoman' => $this->input->post('id_pedoman'));
		$query = $this->M_entitas->all_update('pedoman', $data, $where);
		
		$message['msg'] = "<i class = 'fa fa-check'></i> Berhasil";
      	$this->session->set_flashdata($message);
		redirect('pedoman');
	}
}