<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->model('M_view');
		$this->load->library('MYPDF');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
		$kurikulum = $this->M_entitas->selectSemua('kurikulum')->result();
		
		for($i = 0; $i <= 12; $i++)
		{
			$get_kurikulum_status[] = $this->M_view->kurikulum_status($i);
		}
		$data['get_kurikulum_status'] = json_encode($get_kurikulum_status);


		$get_institusi_kurikulum = $this->M_entitas->grup_by_where('kurikulum', array('status > ' => 0), 'id_kurikulum', 'ASC', 'id_institusi')->result();

		foreach ($get_institusi_kurikulum as $key) 
		{
			$get_nama_institusi_kurikulum[] = $key->nama_institusi;
			$get_jumlah_kurikulum_institusi[] = $this->M_view->institusi_kurikulum($key->id_institusi);
		}
		$data['get_nama_institusi_kurikulum'] = json_encode($get_nama_institusi_kurikulum);
		$data['get_jumlah_kurikulum_institusi'] = json_encode($get_jumlah_kurikulum_institusi);

		$pengisian_kurikulum = $this->M_entitas->selectX('kurikulum', array('status' => 6))->result();

		if($pengisian_kurikulum)
		{
			foreach ($pengisian_kurikulum as $key) 
			{
				$deadline = $this->M_entitas->get_deadline($key->pilih_penilai_at);
				if(date('Y-m-d') > $deadline)
				{
					$data_kurikulum = array(
	                    'status' => 0,
	                    'keterangan_status' => 'Dihentikan',
	                    'dihentikan_oleh' => 0,
	                    'alasan_dihentikan' => 'Penyusunan melebihi batas waktu',
	                    'status_dihentikan' => 3,
	                    'keterangan_status_dihentikan' => 'Melebihi Batas Waktu Penyusunan',
	                    'waktu_dihentikan' => date('Y-m-d H:i:s'),
	                    'status_sebelumnya' => $key->status,
	                    'keterangan_status_sebelumnya' => $key->keterangan_status,
	                    'alasan_hentikan_sistem' => 1,
	                    'keterangan_alasan_hentikan_sistem' => 'Tidak mengisi kurikulum',
	                );
	                $where = array('id_kurikulum' => $key->id_kurikulum);
	                $query = $this->M_entitas->all_update('kurikulum', $data_kurikulum, $where);

	                $data_riwayat = array(
	                    'id_kurikulum' => $key->id_kurikulum,
	                    'id_institusi' => $key->id_institusi,
	                    'id_sdm_institusi' => $key->id_sdm_institusi,
	                    'id_penilai' => $key->id_penilai,
	                    'alasan' => 1,
	                    'keterangan_alasan' => 'Tidak mengisi kurikulum',
	                    'hentikan_by' => 0,
	                    'hentikan_at' => date('Y-m-d H:i:s'),
	                    'status' => 1,
	                );
	                $query = $this->M_entitas->all_insert('riwayat_hentikan', $data_riwayat);
				}				
			}
		}

		if($kurikulum)
		{
			foreach ($kurikulum as $key) 
			{
				if($key->status == 8)
				{
					if(date('Y-m-d') > $key->deadline)
					{
						$data_kurikulum = array(
		                    'status' => 0,
		                    'keterangan_status' => 'Dihentikan',
		                    'dihentikan_oleh' => 0,
		                    'alasan_dihentikan' => 'Penyusunan melebihi batas waktu',
		                    'status_dihentikan' => 3,
		                    'keterangan_status_dihentikan' => 'Melebihi Batas Waktu Penyusunan',
		                    'waktu_dihentikan' => date('Y-m-d H:i:s'),
		                    'status_sebelumnya' => $key->status,
			                'keterangan_status_sebelumnya' => $key->keterangan_status,
			                'alasan_hentikan_sistem' => 2,
			                'keterangan_alasan_hentikan_sistem' => 'Deadline Penyusunan',
		                );
		                $where = array('id_kurikulum' => $key->id_kurikulum);
		                $query = $this->M_entitas->all_update('kurikulum', $data_kurikulum, $where);

		                $data_riwayat = array(
		                    'id_kurikulum' => $key->id_kurikulum,
		                    'id_institusi' => $key->id_institusi,
		                    'id_sdm_institusi' => $key->id_sdm_institusi,
		                    'id_penilai' => $key->id_penilai,
		                    'alasan' => 2,
		                    'keterangan_alasan' => 'Deadline Penyusunan',
		                    'hentikan_by' => 0,
		                    'hentikan_at' => date('Y-m-d H:i:s'),
		                    'status' => 1,
		                );
		                $query = $this->M_entitas->all_insert('riwayat_hentikan', $data_riwayat);
		            }
	            }
			}
		}

		$draft_kurikulum = $this->M_entitas->grup_by_where('draft_kurikulum', array('status' => 1), 'id_draft_kurikulum', 'ASC', 'id_kurikulum')->result();
		if($draft_kurikulum)
		{
			foreach ($draft_kurikulum as $key) 
			{
				if($key->updated_at)
				{
					$deadline = $this->M_entitas->get_deadline($key->updated_at);
					if(date('Y-m-d') > $deadline)
					{
						$data_draft = array(
		                    'dihentikan' => 1,
		                );
		                $where = array('id_draft_kurikulum' => $key->id_draft_kurikulum);
		                $query = $this->M_entitas->all_update('draft_kurikulum', $data_draft, $where);

		                $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $key->id_kurikulum))->row();

		                $data_kurikulum = array(
		                    'status' => 0,
		                    'keterangan_status' => 'Dihentikan',
		                    'dihentikan_oleh' => 0,
		                    'alasan_dihentikan' => 'Penyusunan melebihi batas waktu',
		                    'status_dihentikan' => 3,
		                    'keterangan_status_dihentikan' => 'Melebihi Batas Waktu Penyusunan',
		                    'waktu_dihentikan' => date('Y-m-d H:i:s'),
		                    'status_sebelumnya' => $get_kurikulum->status,
	                    	'keterangan_status_sebelumnya' => $get_kurikulum->keterangan_status,
	                    	'alasan_hentikan_sistem' => 3,
	                		'keterangan_alasan_hentikan_sistem' => 'Tidak mengirim draft',
		                );
		                $where = array('id_kurikulum' => $key->id_kurikulum);
		                $query = $this->M_entitas->all_update('kurikulum', $data_kurikulum, $where);

		                $data_riwayat = array(
		                    'id_kurikulum' => $key->id_kurikulum,
		                    'id_institusi' => $key->id_institusi,
		                    'id_sdm_institusi' => $key->id_sdm_institusi,
		                    'id_penilai' => $key->id_penilai,
		                    'alasan' => 3,
		                    'keterangan_alasan' => 'Tidak mengirim draft',
		                    'hentikan_by' => 0,
		                    'hentikan_at' => date('Y-m-d H:i:s'),
		                    'status' => 1,
		                );
		                $query = $this->M_entitas->all_insert('riwayat_hentikan', $data_riwayat);
					}
				}
			}
		}

		$get_penilaian_kurikulum = $this->M_entitas->selectX('kurikulum', array('status' => 7))->result();


		if($get_penilaian_kurikulum)
		{
			foreach($get_penilaian_kurikulum as $key) 
			{
				$get_draft = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $key->id_kurikulum))->result();
				if(count($get_draft) == 1)
                {
                  	$deadline = $this->M_entitas->get_deadline_penilaian($key->pilih_penilai_at);
                }
                else
                {
                	$get_draft_penilaian = $this->M_entitas->order_by_where('draft_kurikulum', array('id_kurikulum' => $key->id_kurikulum), 'id_draft_kurikulum', 'DESC')->row();
                  	$deadline = $this->M_entitas->get_deadline_penilaian($get_draft_penilaian->created_at);
                }
                
				if(date('Y-m-d') > $deadline)
				{
					$data_kurikulum = array(
	                    'status' => 6,
	                    'keterangan_status' => 'Proses Pemilihan Penilai',
	                    'is_ubah_penilai' => 1,
	                    'status_ubah_penilai' => 1,
	                    'keterangan_status_ubah_penilai' => 'Proses Pilih Penilai Kembali',
	                    'status_sebelumnya_ubah_penilai' => $key->status,
	                    'keterangan_status_sebelumnya_ubah_penilai' => $key->keterangan_status,
	                );
	                $where = array('id_kurikulum' => $key->id_kurikulum);
	                $query = $this->M_entitas->all_update('kurikulum', $data_kurikulum, $where);

	                $get_penilai = $this->M_entitas->selectX('penilai', array('id_penilai' => $key->id_penilai))->row();
	                $data_penilai = array(
	                    'is_penilaian' => 0,
	                );
	                $where = array('id_penilai' => $key->id_penilai);
	                $query = $this->M_entitas->all_update('penilai', $data_penilai, $where);
				}				
			}
		}

		if($this->session->userdata('id_role') == 1)
		{
			$data['jenis_pelatihan'] = $this->M_entitas->selectSemua('master__jenis_pelatihan')->result();
			$data['kategori_pelatihan'] = $this->M_entitas->selectSemua('master__kategori_pelatihan')->result();

			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index');
			$this->load->view('shared/footer_akun');
		}
		else if($this->session->userdata('id_role') == 2)
		{ 
			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index_institusi');
			$this->load->view('shared/footer_akun');
		}
		else if($this->session->userdata('id_role') == 3)
		{ 
			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index_penilai');
			$this->load->view('shared/footer_akun');
		}
		else if($this->session->userdata('id_role') == 4)
		{ 
			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index_pj_institusi');
			$this->load->view('shared/footer_akun');
		}
		else if($this->session->userdata('id_role') == 5)
		{ 
			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index');
			$this->load->view('shared/footer_akun');
		}
		else if($this->session->userdata('id_role') == 6)
		{ 
			$this->load->view('shared/header_akun', $data);
			$this->load->view('beranda/index');
			$this->load->view('shared/footer_akun');
		}
	}

	public function tes()
	{
		$tgl_merah = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);
		print_r($tgl_merah); die();
	}

	public function ujicoba_tcpdf()
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 064');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 064', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)


		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 8);

		$txt = 'a';


		// add a page
		$pdf->AddPage();
		$pdf->writeHTML($txt, true, false, true, false, '');

		ob_end_clean();
		$pdf->Output('example_064.pdf', 'I');
	}	
}