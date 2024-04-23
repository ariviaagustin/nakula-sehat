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
		foreach ($kurikulum as $key) 
		{
			if($key->status == 5)
			{
				$tgl_verif = $key->verif_at;
              	$tgl_verif = date('Y-m-d', strtotime($tgl_verif));

              	$day = 5;
              	for ($i = 0; $i <= $day; $i++) 
              	{ 
                	$deadline = date('Y-m-d', strtotime($i.' days', strtotime($tgl_verif)));
                	$cek = tanggalmerah_helper($deadline);
                	if($cek == 1)
                	{
                  		$day += 1;
                	}
              	}
              	$deadline = date('Y-m-d', strtotime($day.' days', strtotime($tgl_verif)));
              	if($deadline)
				{
					if(date('Y-m-d') > $deadline)
					{
						$data_ = array(
							'status' => 13,
							'keterangan_status' => 'Penyusunan Kurikulum Dihentikan',
							'is_hentikan' => 1,
							'hentikan_at' => date('Y-m-d H:i:s')
						);
						$where = array('id_kurikulum' => $key->id_kurikulum);
						$query = $this->M_entitas->all_update('kurikulum', $data_, $where);

						if($key->id_penilai)
						{
							$data_ = array(
								'is_penilaian' => 0,
							);
							$where = array('id_penilai' => $key->id_penilai);
							$query = $this->M_entitas->all_update('penilai', $data_, $where);
						}
					}
				}
			}
			else if($key->status == 7)
			{
				$pilih_penilai_at = $key->pilih_penilai_at;
              	$pilih_penilai_at = date('Y-m-d', strtotime($pilih_penilai_at));

              	$day = 5;
              	for ($i = 0; $i <= $day; $i++) 
              	{ 
                	$deadline = date('Y-m-d', strtotime($i.' days', strtotime($pilih_penilai_at)));
                	$cek = tanggalmerah_helper($deadline);
                	if($cek == 1)
                	{
                  		$day += 1;
                	}
              	}
              	$deadline = date('Y-m-d', strtotime($day.' days', strtotime($pilih_penilai_at)));
              	if($deadline)
				{
					if(date('Y-m-d') > $deadline)
					{
						$data_ = array(
							'status' => 13,
							'keterangan_status' => 'Penyusunan Kurikulum Dihentikan',
							'is_hentikan' => 1,
							'hentikan_at' => date('Y-m-d H:i:s')
						);
						$where = array('id_kurikulum' => $key->id_kurikulum);
						$query = $this->M_entitas->all_update('kurikulum', $data_, $where);

						if($key->id_penilai)
						{
							$data_ = array(
								'is_penilaian' => 0,
							);
							$where = array('id_penilai' => $key->id_penilai);
							$query = $this->M_entitas->all_update('penilai', $data_, $where);
						}
					}
				}
			}
			else if($key->status == 8)
			{
				$penilaian_at = $key->penilaian_at;
              	$penilaian_at = date('Y-m-d', strtotime($penilaian_at));

              	$day = 5;
              	for ($i = 0; $i <= $day; $i++) 
              	{ 
                	$deadline = date('Y-m-d', strtotime($i.' days', strtotime($penilaian_at)));
                	$cek = tanggalmerah_helper($deadline);
                	if($cek == 1)
                	{
                  		$day += 1;
                	}
              	}
              	$deadline = date('Y-m-d', strtotime($day.' days', strtotime($penilaian_at)));
              	if($deadline)
				{
					if(date('Y-m-d') > $deadline)
					{
						$data_ = array(
							'status' => 14,
							'keterangan_status' => 'Penyusunan Kurikulum Dihentikan',
							'is_hentikan' => 1,
							'hentikan_at' => date('Y-m-d H:i:s')
						);
						$where = array('id_kurikulum' => $key->id_kurikulum);
						$query = $this->M_entitas->all_update('kurikulum', $data_, $where);

						if($key->id_penilai)
						{
							$data_ = array(
								'is_penilaian' => 0,
							);
							$where = array('id_penilai' => $key->id_penilai);
							$query = $this->M_entitas->all_update('penilai', $data_, $where);
						}
					}
				}
			}
		}

		for($i = 1; $i <= 12; $i++)
		{
			$get_kurikulum_status[] = $this->M_view->kurikulum_status($i);
		}
		$data['get_kurikulum_status'] = json_encode($get_kurikulum_status);

		if($this->session->userdata('id_role') == 1)
		{ 
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