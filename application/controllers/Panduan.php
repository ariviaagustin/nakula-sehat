<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panduan extends CI_Controller {
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
		$data['panduan'] = $this->M_entitas->selectX('panduan', array('id_role' => $this->session->userdata('id_role')))->row();

		$this->load->view('shared/header_akun');
		$this->load->view('panduan/index', $data);
		$this->load->view('shared/footer_akun');
	}

	public function index_panduan()
	{
		$data['panduan'] = $this->M_entitas->selectSemua('panduan')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('panduan/index_panduan', $data);
		$this->load->view('shared/footer_akun');
	}

	public function ubah()
	{
		$id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['panduan'] = $this->M_entitas->selectX('panduan', array('id_panduan'=> $id))->row();

		$this->load->view('shared/header_akun');
		$this->load->view('panduan/ubah', $data);
		$this->load->view('shared/footer_akun');
	}

	public function aksi_ubah()
	{
		if(isset($_FILES['panduan']['name']))
        {
          $config['upload_path']   = './agenda/perdata/panduan';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('panduan'))
            {
                $panduan = $this->input->post('panduan_old');
            }else{
                $panduan = $this->upload->data()['file_name'];
            }
        }
        else
        {
            $panduan = $this->input->post('panduan_old');
        }

		$data = array(
			'panduan' => $panduan,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('id_user'),
		);
		$where = array('id_panduan'=>$this->input->post('id_panduan'));
		$query = $this->M_entitas->all_update('panduan', $data, $where);

		redirect('master-data-panduan');
	}
}