<?php
defined('BASEPATH') or exit('No direct script access allowed');

class All extends CI_Controller {
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
        $this->load->view('sementara');
    }

    public function get_master_jadwal($hari, $id_kurikulum)
    {
        $jadwal = $this->M_entitas->order_by_where_limit('master_jadwal', array('id_kurikulum' => $id_kurikulum, 'hari_ke' => $hari), 'id_master_jadwal', 'DESC', 1)->row();
        if($jadwal)
        {
            $waktu_akhir = $jadwal->waktu_akhir;
        }
        else{ $waktu_akhir = "00:00"; }

        $data = $waktu_akhir;

        echo $data;
    }

    public function get_jpl_master_jadwal($t_p_pl_materi, $id_materi, $id_kurikulum)
    {
        $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        if($t_p_pl_materi == 1){ $jumlah_alokasi_waktu = $get_materi->t; }
        else if($t_p_pl_materi == 2){ $jumlah_alokasi_waktu = $get_materi->p; }
        else if($t_p_pl_materi == 3){ $jumlah_alokasi_waktu = $get_materi->pl; }

        $get_master_jadwal = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id_kurikulum, 'id_materi' => $id_materi))->result();
        $jpl = 0;
        foreach ($get_master_jadwal as $key) 
        {
            if($key->t_p_pl_materi == $t_p_pl_materi)
            {
                $jpl += $key->jpl;
            }
        }

        $sisa_jpl = $jumlah_alokasi_waktu - $jpl;

        $data = "<option value = ''>--Pilih JPL--</option>";
        for($i = 1; $i <= $sisa_jpl; $i++){
            $data .= "<option value='".$i."'>".$i."</option>";
        }

        echo $data;
    }

    public function get_waktu_selesai($alokasi_waktu, $jpl, $hari, $id_kurikulum)
    {
        $jadwal = $this->M_entitas->order_by_where_limit('master_jadwal', array('id_kurikulum' => $id_kurikulum, 'hari_ke' => $hari), 'id_master_jadwal', 'DESC', 1)->row();

        if($jadwal)
        {
            $get_waktu_akhir = $jadwal->waktu_akhir;
        }
        else{ $get_waktu_akhir = "00:00"; }

        $get_waktu_awal = $get_waktu_akhir;

        if($alokasi_waktu == 1)
        {
            $total_jpl = $jpl * 45;
        }
        else if($alokasi_waktu == 2)
        {
            $total_jpl = $jpl * 45;
        }
        else if($alokasi_waktu == 3)
        {
            $total_jpl = $jpl * 60;
        }

        $waktu_awal_a = substr($get_waktu_awal, 0,2);
        $waktu_awal_b = substr($get_waktu_awal, 3, 2);

        $waktu_awal_a_menit = $waktu_awal_a * 60;

        $total_akhir = $waktu_awal_a_menit + $waktu_awal_b + $total_jpl;
        $total_akhir = $total_akhir * 60;

        if(($total_akhir > 60) and ($total_akhir < 3600))
        {
            $detik = fmod($total_akhir, 60);
            $menit = $total_akhir - $detik;
            $menit = $menit / 60;
            $get_menit = $menit;
            $get_jam = "00";
        }
        elseif($total_akhir > 3600)
        {
            $detik = fmod($total_akhir, 60);
            $tempmenit = ($total_akhir - $detik) / 60;
            $menit = fmod($tempmenit, 60);
            $jam = ($tempmenit - $menit) / 60;    
            $get_jam = $jam;
            $get_menit = $menit;
            if($menit == 0){ $get_menit = "00"; } else { $get_menit = $get_menit; }
        }
        
        $jumlah_jam = strlen($get_jam);
        if($jumlah_jam == 1){ $get_jam = "0".$get_jam; }
        else{ $get_jam = $get_jam; }

        $data = $get_jam.":".$get_menit;
        echo $data;
    }

    public function get_pj_institusi($id_institusi)
    {
        $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi' => $id_institusi))->row();
        $query = $this->db->get_where('sdm_institusi', array('id_institusi_siaksi' => $get_institusi->id_institusi_siaksi, 'id_user != ' => NULL));
        $data = "<option disabled >--Pilih pj substansi --</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_sdm_siaksi."'>".$value->nama_sdm."</option>";
        }
        echo $data;
    }

	public function get_kabupaten($provinsi)
    {
        $query = $this->db->get_where('entitas__kabupaten', array('id_provinsi' => $provinsi));
        $data = "<option disabled >--Pilih Kabupaten--</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kokab."'>".$value->nama_kokab."</option>";
        }
        echo $data;
    }

    public function get_kecamatan($kabupaten)
    {
        $query = $this->db->get_where('entitas__kecamatan', array('id_kokab' => $kabupaten));
        $data = "<option disabled >--Pilih Kecamatan--</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_kecamatan."'>".$value->nama_kecamatan."</option>";
        }
        echo $data;
    }

    public function get_kelurahan($kecamatan)
    {
        $query = $this->db->get_where('entitas__kelurahan', array('id_kecamatan' => $kecamatan));
        $data = "<option disabled >--Pilih Kelurahan--</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id_deskel."'>".$value->nama_deskel."</option>";
        }
        echo $data;
    }	

    public function lihat_dokumen()
    {
        $where = array('id_pesanan'=>$this->input->post('id'));
        $pesanan = $this->M_entitas->selectX('pesanan',$where)->row();
        $data['id'] = $pesanan->id_pesanan;
        $data['file'] = $pesanan->bukti_bayar;
        $this->load->view('pembeli/show_dokumen',$data);   
    }

    public function lihat_bukti_kirim()
    {
        $where = array('id_bukti_pengiriman'=>$this->input->post('id'));
        $bukti = $this->M_entitas->selectX('bukti_pengiriman',$where)->row();
        $data['id'] = $bukti->id_pesanan;
        $data['file'] = $bukti->bukti_pengiriman;
        $this->load->view('pembeli/show_bukti_pengiriman',$data);   
    }
}