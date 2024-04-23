<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('M_entitas');
		$this->load->model('M_view');
        $this->load->helper('judul_helper');
        $this->load->helper('tanggalmerah_helper');
        $this->load->helper('kurikulum_siakpel_helper');
		if($this->session->userdata('id_user'))
		{

		}else{
			redirect(site_url());
		}
    }


	public function index()
	{
        $postdata['tgl_pengajuan'] = $this->input->get('tgl_pengajuan');
        $postdata['judul'] = $this->input->get('judul');
        $postdata['status'] = $this->input->get('status');

        if($this->session->userdata('id_role') == 1)
        {
            $postdata['id_institusi'] = $this->input->get('id_institusi');
            $postdata['id_penilai'] = $this->input->get('id_penilai');

            $data['id_institusi_isi'] = $this->input->get('id_institusi');
            $data['id_penilai_isi'] = $this->input->get('id_penilai');

            $data['permohonan_pengajuan'] = $this->M_entitas->selectX('kurikulum', array('status > ' => 0, 'status <= ' => 2))->num_rows();
            $data['pengesahan_kurikulum'] = $this->M_entitas->selectX('kurikulum', array('status' => 10))->num_rows();
        }
        else if($this->session->userdata('id_role') == 2)
        {
            $id_institusi = $this->session->userdata('id_institusi');
            $postdata['id_institusi'] = $id_institusi;

            $data['isi_kelengkapan'] = $this->M_view->isi_kelengkapan_institusi($id_institusi)->num_rows();
            $data['perbaikan_kurikulum'] = $this->M_view->perbaikan_kurikulum_institusi($id_institusi)->num_rows();
            $data['upload_cover'] = $this->M_view->upload_cover_institusi($id_institusi)->num_rows();
        }
        else if($this->session->userdata('id_role') == 3)
        {
            $postdata['id_penilai'] = $this->session->userdata('id_penilai');

            $data['penilaian_kurikulum'] = $this->M_entitas->selectX('kurikulum', array('status' => 7, 'id_penilai' => $this->session->userdata('id_penilai')))->num_rows();
        }
        else if($this->session->userdata('id_role') == 4)
        {
            $id_sdm_institusi = $this->session->userdata('id_sdm_institusi');
            $postdata['id_sdm_institusi'] = $id_sdm_institusi;

            $data['isi_kelengkapan'] = $this->M_view->isi_kelengkapan_pj_institusi($id_sdm_institusi)->num_rows();
            $data['perbaikan_kurikulum'] = $this->M_view->perbaikan_kurikulum_pj_institusi($id_sdm_institusi)->num_rows();
            $data['upload_cover'] = $this->M_view->upload_cover_pj_institusi($id_sdm_institusi)->num_rows();
        }
        else if($this->session->userdata('id_role') == 5)
        {
          // $data['verifikasi_kesesuaian'] = $this->M_entitas->selectX('kurikulum', array('status' => 1))->num_rows();
          $data['verifikasi'] = $this->M_entitas->selectX('kurikulum', array('status' => 1))->num_rows();
          $data['penyusunan'] = $this->M_entitas->selectX('kurikulum', array('status > ' => 2))->num_rows();
          $data['selesai'] = $this->M_entitas->selectX('kurikulum', array('status > ' => 11))->num_rows();
          $data['dibatalkan'] = $this->M_entitas->selectX('kurikulum', array('status' => 0))->num_rows();
        }
        else if($this->session->userdata('id_role') == 6)
        {
            $data['verifikasi_kesesuaian'] = $this->M_entitas->selectX('kurikulum', array('status' => 4))->num_rows();
            $data['pilih_penilai'] = $this->M_entitas->selectX('kurikulum', array('status' => 6))->num_rows();
            $data['pengesahan_kurikulum'] = $this->M_entitas->selectX('kurikulum', array('status' => 10))->num_rows();
        }

        $id_role = $this->session->userdata('id_role');
        $data['kurikulum'] = $this->M_view->filter_kurikulum($postdata, $id_role)->result();

        $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();
        $data['penilai'] = $this->M_entitas->selectSemua('penilai')->result();

        $data['tgl_pengajuan_isi'] = $this->input->get('tgl_pengajuan');
        $data['judul_isi'] = $this->input->get('judul');
        $data['status_isi'] = $this->input->get('status');

		$this->load->view('shared/header_akun');
		$this->load->view('kurikulum/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $id_institusi = $this->input->post('id_institusi');
        $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi' => $id_institusi))->row();
        $nama_institusi = $get_institusi->nama_institusi;

        $judul_kurikulum = $this->input->post('judul');
        $judul = judul_helper($judul_kurikulum);

        if(isset($_FILES['kak_tor']['name']))
        {
          $config['upload_path']   = './agenda/perdata/kak_tor';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('kak_tor'))
            {
                $kak_tor = NULL;
            }else{
                $kak_tor = $this->upload->data()['file_name'];
            }
        }
        else
        {
            $kak_tor = NULL;
        }

        if(isset($_FILES['surat_pengantar']['name']))
        {
          $config['upload_path']   = './agenda/perdata/surat_pengantar';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('surat_pengantar'))
            {
                $surat_pengantar = NULL;
            }else{
                $surat_pengantar = $this->upload->data()['file_name'];
            }
        }
        else
        {
            $surat_pengantar = NULL;
        }

        $id_sdm_institusi = $this->input->post('id_sdm_institusi');
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $id_sdm_institusi))->row();
        $nama_sdm = $get_sdm->nama_sdm;

        $data = array(
            'id_institusi' => $id_institusi,
            'nama_institusi' => $nama_institusi,
            'id_sdm_institusi' => $id_sdm_institusi,
            'nama_sdm' => $nama_sdm,
            'judul' => $judul_kurikulum,
            'judul_portal' => $judul,
            'tujuan' => $this->input->post('tujuan'),
            'kompetensi' => $this->input->post('kompetensi'),
            'jumlah_jpl' => $this->input->post('jumlah_jpl'),
            'sasaran_peserta' => $this->input->post('sasaran_peserta'),
            'kak_tor' => $kak_tor,
            'surat_pengantar' => $surat_pengantar,
            'no_surat_pengantar' => $this->input->post('no_surat_pengantar'),
            'tanggal_surat_pengantar' => $this->input->post('tanggal_surat_pengantar'),
            'perihal_surat_pengantar' => $this->input->post('perihal_surat_pengantar'),
            'status' => 1,
            'keterangan_status' => 'Pengajuan Pengembangan Kompetensi',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user'),
            'tgl_pengajuan' => date('Y-m-d'),
        );
        $query = $this->M_entitas->all_insert('kurikulum', $data);

        $id_kurikulum = $this->db->insert_id();

        if($this->input->post('tujuan'))
        {
            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'is_bab_subbab' => 2,
                'id_bab_subbab' => 1,
                'last_updated' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
        }

        if(count($this->input->post('isi_kompetensi')) > 0)
        {
            foreach ($this->input->post('isi_kompetensi') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'isi_kompetensi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('isi_kompetensi', $data);
            }

            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'is_bab_subbab' => 2,
                'id_bab_subbab' => 2,
                'last_updated' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
        }        

        if(count($this->input->post('materi_pelatihan_dasar')) > 0)
        {
            foreach ($this->input->post('materi_pelatihan_dasar') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 1,
                    'materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);
            }
        }

        $no = 0;
        if(count($this->input->post('materi_pelatihan_inti')) > 0)
        {
            foreach ($this->input->post('materi_pelatihan_inti') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 2,
                    'materi' => $key,
                    'hasil_belajar' => $this->input->post('isi_kompetensi')[$no],
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);

                $no++;
            }
        }

        if(count($this->input->post('materi_pelatihan_penunjang')) > 0)
        {
            foreach ($this->input->post('materi_pelatihan_penunjang') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 3,
                    'materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);
            }
        }

        if(count($this->input->post('isi_peserta')) > 0)
        {
            foreach ($this->input->post('isi_peserta') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'isi_peserta' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('isi_peserta', $data);
            }
        }

        redirect('kurikulum/?status=permohonan-pengajuan');
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kurikulum'] = $kurikulum;
        $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();
        $data['sdm_institusi'] = $this->M_entitas->selectX('sdm_institusi', array('id_institusi' => $kurikulum->id_institusi, 'id_user != ' => NULL))->result();
        $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
        $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
        $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
        $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_institusi = $this->input->post('id_institusi');
        $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi' => $id_institusi))->row();
        $nama_institusi = $get_institusi->nama_institusi;

        $judul_kurikulum = $this->input->post('judul');
        $judul = judul_helper($judul_kurikulum);

        if(isset($_FILES['kak_tor']['name']))
        {
          $config['upload_path']   = './agenda/perdata/kak_tor';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('kak_tor'))
            {
                $kak_tor = $this->input->post('kak_tor_lama');
            }
            else
            {
                $kak_tor = $this->upload->data()['file_name'];
                $kak_tor_lama = './agenda/perdata/kak_tor/'.$this->input->post('kak_tor_lama');
                if(file_exists($kak_tor_lama)) { unlink($kak_tor_lama); }
            }
        }
        else
        {
            $kak_tor = $this->input->post('kak_tor_lama');
        }

        if(isset($_FILES['surat_pengantar']['name']))
        {
          $config['upload_path']   = './agenda/perdata/surat_pengantar';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('surat_pengantar'))
            {
                $surat_pengantar = $this->input->post('surat_pengantar_old');
            }
            else
            {
                $surat_pengantar = $this->upload->data()['file_name'];
                $surat_pengantar_old = './agenda/perdata/surat_pengantar/'.$this->input->post('surat_pengantar_old');
                if(file_exists($surat_pengantar_old)) { unlink($surat_pengantar_old); }
            }
        }
        else
        {
            $surat_pengantar = $this->input->post('surat_pengantar_old');
        }

        $id_sdm_institusi = $this->input->post('id_sdm_institusi');
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $id_sdm_institusi))->row();
        $nama_sdm = $get_sdm->nama_sdm;

        $data = array(
            'id_institusi' => $id_institusi,
            'nama_institusi' => $nama_institusi,
            'id_sdm_institusi' => $id_sdm_institusi,
            'nama_sdm' => $nama_sdm,
            'judul' => $judul_kurikulum,
            'judul_portal' => $judul,
            'tujuan' => $this->input->post('tujuan'),
            'kompetensi' => $this->input->post('kompetensi'),
            'jumlah_jpl' => $this->input->post('jumlah_jpl'),
            'sasaran_peserta' => $this->input->post('sasaran_peserta'),
            'kak_tor' => $kak_tor,
            'surat_pengantar' => $surat_pengantar,
            'no_surat_pengantar' => $this->input->post('no_surat_pengantar'),
            'tanggal_surat_pengantar' => $this->input->post('tanggal_surat_pengantar'),
            'perihal_surat_pengantar' => $this->input->post('perihal_surat_pengantar'),
            'status' => 1,
            'keterangan_status' => 'Pengajuan Pengembangan Kompetensi',
            'tgl_ubah_pengajuan' => date('Y-m-d H:i:s'),
            'ubah_pengajuan_oleh' => $this->session->userdata('id_user'),
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        if($this->input->post('tujuan'))
        {
            $data = array(
                'last_updated' => date('Y-m-d H:i:s'),
            );
            $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => 1, 'status' => 1);
            $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
        }

        if(count($this->input->post('isi_kompetensi')) > 0)
        {
            $this->M_entitas->delete_data('isi_kompetensi', array('id_kurikulum' => $id_kurikulum));

            foreach ($this->input->post('isi_kompetensi') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'isi_kompetensi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('isi_kompetensi', $data);
            }

            $data = array(
                'last_updated' => date('Y-m-d H:i:s'),
            );
            $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => 2, 'status' => 1);
            $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
        }

        
        if(count($this->input->post('materi_pelatihan_dasar')) > 0)
        {
            $this->M_entitas->delete_data('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 1));

            foreach ($this->input->post('materi_pelatihan_dasar') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 1,
                    'materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);
            }
        }

        if(count($this->input->post('materi_pelatihan_inti')) > 0)
        {
            $this->M_entitas->delete_data('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 2));

            foreach ($this->input->post('materi_pelatihan_inti') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 2,
                    'materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);
            }
        }

        if(count($this->input->post('materi_pelatihan_penunjang')) > 0)
        {
            $this->M_entitas->delete_data('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 3));

            foreach ($this->input->post('materi_pelatihan_penunjang') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'jenis_materi' => 3,
                    'materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('materi', $data);
            }
        }

        if(count($this->input->post('isi_peserta')) > 0)
        {
            $this->M_entitas->delete_data('isi_peserta', array('id_kurikulum' => $id_kurikulum));

            foreach ($this->input->post('isi_peserta') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'isi_peserta' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('isi_peserta', $data);
            }
        }

        redirect('kurikulum/?status=permohonan-pengajuan');
    }

    public function ubah_informasi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kurikulum'] = $kurikulum;
        $data['institusi'] = $this->M_entitas->selectSemua('institusi')->result();
        $data['sdm_institusi'] = $this->M_entitas->selectX('sdm_institusi', array('id_institusi' => $kurikulum->id_institusi))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_informasi_kurikulum', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_informasi()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_institusi = $this->input->post('id_institusi');
        $get_institusi = $this->M_entitas->selectX('institusi', array('id_institusi' => $id_institusi))->row();
        $nama_institusi = $get_institusi->nama_institusi;

        $judul_kurikulum = $this->input->post('judul');
        $judul = judul_helper($judul_kurikulum);

        if(isset($_FILES['kak_tor']['name']))
        {
          $config['upload_path']   = './agenda/perdata/kak_tor';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('kak_tor'))
            {
                $kak_tor = $this->input->post('kak_tor_lama');
            }
            else
            {
                $kak_tor = $this->upload->data()['file_name'];
                $kak_tor_lama = './agenda/perdata/kak_tor/'.$this->input->post('kak_tor_lama');
                if(file_exists($kak_tor_lama)) { unlink($kak_tor_lama); }
            }
        }
        else
        {
            $kak_tor = $this->input->post('kak_tor_lama');
        }

        if(isset($_FILES['surat_pengantar']['name']))
        {
          $config['upload_path']   = './agenda/perdata/surat_pengantar';
          $config['file_name']     = rand(0,999999).'_'.$judul.'_'.date('YmdHis');
          $config['overwrite']     = true;
          $config['allowed_types']     = '*';
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('surat_pengantar'))
            {
                $surat_pengantar = $this->input->post('surat_pengantar_old');
            }
            else
            {
                $surat_pengantar = $this->upload->data()['file_name'];
                $surat_pengantar_old = './agenda/perdata/surat_pengantar/'.$this->input->post('surat_pengantar_old');
                if(file_exists($surat_pengantar_old)) { unlink($surat_pengantar_old); }
            }
        }
        else
        {
            $surat_pengantar = $this->input->post('surat_pengantar_old');
        }

        $id_sdm_institusi = $this->input->post('id_sdm_institusi');
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $id_sdm_institusi))->row();
        $nama_sdm = $get_sdm->nama_sdm;

        $data = array(
            'id_institusi' => $id_institusi,
            'nama_institusi' => $nama_institusi,
            'id_sdm_institusi' => $id_sdm_institusi,
            'nama_sdm' => $nama_sdm,
            'judul' => $judul_kurikulum,
            'judul_portal' => $judul,
            'jumlah_jpl' => $this->input->post('jumlah_jpl'),
            'kak_tor' => $kak_tor,
            'surat_pengantar' => $surat_pengantar,
            'no_surat_pengantar' => $this->input->post('no_surat_pengantar'),
            'tanggal_surat_pengantar' => $this->input->post('tanggal_surat_pengantar'),
            'perihal_surat_pengantar' => $this->input->post('perihal_surat_pengantar'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user'),
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $id_kurikulum = bin2hex(base64_encode($id_kurikulum));

        redirect('list-pengisian-kurikulum/'.$id_kurikulum);
    }

    public function get_detail_dihentikan()
    {
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id')))->row();

        $this->load->view('kurikulum/get_detail_dihentikan', $data);
    }

    public function verifikasi_kebutuhan_pelatihan()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
        $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
        $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
        $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();

        $judul = $this->input->get('judul');
        if($judul)
        {
            $data['judul_isi'] = $this->input->get('judul');
            $a = $this->get_api_kurikulum_by_judul($judul);
        }
        else
        {
            $data['judul_isi'] = $data['kurikulum']->judul;
            $a = $this->get_api_kurikulum_by_judul($data['kurikulum']->judul);
        }

        $b = json_decode($a,true);        

        if($b['message'] == "success")
        {
            $get_data = $b['data'];

            $data['kurikulum_tersedia'] = $get_data;
            $data['ketersediaan_kurikulum'] = 1;
            $data['msg'] = 'Kurikulum Telah Tersedia Di SIAKPEL';
            $data['ket'] = 'Pengajuan dengan judul ini sudah tersedia di SIAKPEL';
            $data['icon'] = 'fa fa-check-circle';
            $data['alert'] = 'success';
        }
        else
        {
            $data['ketersediaan_kurikulum'] = 2;
            $data['msg'] = 'Kurikulum Belum Tersedia Di SIAKPEL';
            $data['ket'] = 'Pengajuan dengan judul ini belum tersedia di SIAKPEL';
            $data['icon'] = 'fa fa-times-circle';
            $data['alert'] = 'danger';
        }

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/verifikasi_kebutuhan_pelatihan', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_verifikasi_kebutuhan_pelatihan()
    {
        $kebutuhan_pelatihan = $this->input->post('kebutuhan_pelatihan');
        if($kebutuhan_pelatihan == 1)
        { 
            $keterangan_kebutuhan_pelatihan = "Pelatihan"; 
            $status = 2; 
            $keterangan_status = "Verifikasi Ketersediaan Kurikulum"; 
            $surat_rekomendasi = NULL;
            $dihentikan_oleh = NULL;
            $alasan_dihentikan = NULL;
            $status_dihentikan = NULL;
            $keterangan_status_dihentikan = NULL;
            $waktu_dihentikan = NULL;
        }
        else
        { 
            $keterangan_kebutuhan_pelatihan = "Non Pelatihan"; 
            $status = 0; 
            $keterangan_status = "Dihentikan";
            $dihentikan_oleh = $this->session->userdata('id_user');
            $alasan_dihentikan = "Kebutuhan Non Pelatihan";
            $status_dihentikan = 1;
            $keterangan_status_dihentikan = "Non Pelatihan";
            $waktu_dihentikan = date('Y-m-d H:i:s');
            
            if(isset($_FILES['surat_rekomendasi']['name']))
            {
                $config['upload_path']   = './agenda/perdata/surat_rekomendasi/non_pelatihan/';
                $config['file_name']     = rand(1,9999)."_".$this->input->post('judul_portal')."_".date('YmdHis'); 
                $config['overwrite']     = true;
                $config['allowed_types']     = '*';
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('surat_rekomendasi')){
                    $surat_rekomendasi = NULL;
                }else{
                    $surat_rekomendasi = $this->upload->data()['file_name'];
                }
            }
            else
            {
                $surat_rekomendasi = NULL;
            }
        }

        $data = array(
            'kebutuhan_pelatihan' => $kebutuhan_pelatihan,
            'keterangan_kebutuhan_pelatihan' => $keterangan_kebutuhan_pelatihan,
            'surat_rekomendasi' => $surat_rekomendasi,
            'status' => $status,
            'keterangan_status' => $keterangan_status,
            'updated_by' => $this->session->userdata('id_user'),
            'updated_at' => date('Y-m-d H:i:s'),
            'dihentikan_oleh' => $dihentikan_oleh,
            'alasan_dihentikan' => $alasan_dihentikan,
            'status_dihentikan' => $status_dihentikan,
            'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
            'waktu_dihentikan' => $waktu_dihentikan,
        );
        $where = array('id_kurikulum' => $this->input->post('id_kurikulum'));
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id_kurikulum')))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();
        
        if($kebutuhan_pelatihan == 1)
        { 
            redirect('verifikasi-ketersediaan-kurikulum/'.bin2hex(base64_encode($this->input->post('id_kurikulum')))); 
        }
        else
        { 
            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Kurikulum Non Pelatihan');
            $this->email->to($to_mail);
            $this->email->subject('Kurikulum Non Pelatihan');
            $this->email->message('
                <h2>Non Pelatihan</h2>
                <p>Pengajuan Kurikulum Bapak/Ibu dengan  :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Tidak dapat dilanjutkan karena tidak termasuk kategori <b>PELATIHAN</b>.<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=dihentikan'); 
        }
    }

    public function verifikasi_ketersediaan_kurikulum()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
        $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
        $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
        $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();

        $judul = $this->input->get('judul');
        if($judul)
        {
            $data['judul_isi'] = $this->input->get('judul');
            $a = $this->get_api_kurikulum_by_judul($judul);
        }
        else
        {
            $data['judul_isi'] = $data['kurikulum']->judul;
            $a = $this->get_api_kurikulum_by_judul($data['kurikulum']->judul);
        }

        $b = json_decode($a,true);        

        if($b['message'] == "success")
        {
            $get_data = $b['data'];

            $data['kurikulum_tersedia'] = $get_data;
            $data['ketersediaan_kurikulum'] = 1;
            $data['msg'] = 'Kurikulum Telah Tersedia Di SIAKPEL';
            $data['ket'] = 'Pengajuan dengan judul ini sudah tersedia di SIAKPEL';
            $data['icon'] = 'fa fa-check-circle';
            $data['alert'] = 'success';
        }
        else
        {
            $data['ketersediaan_kurikulum'] = 2;
            $data['msg'] = 'Kurikulum Belum Tersedia Di SIAKPEL';
            $data['ket'] = 'Pengajuan dengan judul ini belum tersedia di SIAKPEL';
            $data['icon'] = 'fa fa-times-circle';
            $data['alert'] = 'danger';
        }

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/verifikasi_ketersediaan_kurikulum', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_verifikasi_ketersediaan_kurikulum()
    {
        $ketersediaan_kurikulum = $this->input->post('ketersediaan_kurikulum');

        if($ketersediaan_kurikulum == 1)
        {
            $keterangan_ketersediaan_kurikulum = "Tersedia"; 
            $status = 0; 
            $keterangan_status = "Dihentikan";
            $dihentikan_oleh = $this->session->userdata('id_user');
            $alasan_dihentikan = "Tersedia Di SIAKPEL";
            $status_dihentikan = 2;
            $keterangan_status_dihentikan = "Tersedia Di SIAKPEL";
            $waktu_dihentikan = date('Y-m-d H:i:s');
            $kata_kunci = $this->input->post('kata_kunci');

            $data = array(
                'ketersediaan_kurikulum' => $ketersediaan_kurikulum,
                'keterangan_ketersediaan_kurikulum' => $keterangan_ketersediaan_kurikulum,
                'status' => $status,
                'keterangan_status' => $keterangan_status,
                'verif_at' => date('Y-m-d H:i:s'),
                'verif_by' => $this->session->userdata('id_user'),
                'updated_by' => $this->session->userdata('id_user'),
                'updated_at' => date('Y-m-d H:i:s'),
                'dihentikan_oleh' => $dihentikan_oleh,
                'alasan_dihentikan' => $alasan_dihentikan,
                'status_dihentikan' => $status_dihentikan,
                'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
                'waktu_dihentikan' => $waktu_dihentikan,
                'kata_kunci' => $kata_kunci,
            );
            $where = array('id_kurikulum' => $this->input->post('id_kurikulum'));
            $query = $this->M_entitas->all_update('kurikulum', $data, $where);

            $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id_kurikulum')))->row();
            $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Kurikulum Tersedia');
            $this->email->to($to_mail);
            $this->email->subject('Kurikulum Tersedia');
            $this->email->message('
                <h2>Ketersediaan Kurikulum</h2>
                <p>Pengajuan Kurikulum Bapak/Ibu dengan  :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Tidak dapat dilanjutkan karena Kurikulum <b>Telah Tersedia</b> di SIAKPEL. Silahkan menggunakan Kurikulum yang telah direkomendasikan.<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=dihentikan');

        }
        else
        { 
            $kebutuhan_pelatihan = $this->input->post('kebutuhan_pelatihan');
            if($kebutuhan_pelatihan == 1)
            { 
                $keterangan_ketersediaan_kurikulum = "Tidak Tersedia"; 
                $keterangan_kebutuhan_pelatihan = "Pelatihan";
                $status = 3; 
                $keterangan_status = "Proses Pengisian Kurikulum";
                $dihentikan_oleh = NULL;
                $alasan_dihentikan = NULL;
                $status_dihentikan = NULL;
                $keterangan_status_dihentikan = NULL;
                $waktu_dihentikan = NULL;
                $kata_kunci = $this->input->post('kata_kunci');

                $data = array(
                    'ketersediaan_kurikulum' => $ketersediaan_kurikulum,
                    'keterangan_ketersediaan_kurikulum' => $keterangan_ketersediaan_kurikulum,
                    'kebutuhan_pelatihan' => $kebutuhan_pelatihan,
                    'keterangan_kebutuhan_pelatihan' => $keterangan_kebutuhan_pelatihan,
                    'status' => $status,
                    'keterangan_status' => $keterangan_status,
                    'verif_at' => date('Y-m-d H:i:s'),
                    'verif_by' => $this->session->userdata('id_user'),
                    'updated_by' => $this->session->userdata('id_user'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'dihentikan_oleh' => $dihentikan_oleh,
                    'alasan_dihentikan' => $alasan_dihentikan,
                    'status_dihentikan' => $status_dihentikan,
                    'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
                    'waktu_dihentikan' => $waktu_dihentikan,
                    'kata_kunci' => $kata_kunci,
                );
                $where = array('id_kurikulum' => $this->input->post('id_kurikulum'));
                $query = $this->M_entitas->all_update('kurikulum', $data, $where);

                $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id_kurikulum')))->row();
                $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

                $to_mail = $get_sdm->email;

                $this->load->library('email');

                $from_email = "no-reply";
                $config['protocol']    = 'smtp';
                $config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
                $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not

                $this->email->initialize($config);

                $this->email->from($from_email, 'Verifikasi Pengajuan Kurikulum');
                $this->email->to($to_mail);
                $this->email->subject('Verifikasi Pengajuan Kurikulum');
                $this->email->message('
                    <h2>Pengajuan Kurikulum Telah Di Verifikasi</h2>
                    <p>Pengajuan Kurikulum Bapak/Ibu dengan  :
                    <br>  
                    <p>
                        Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                        <br>
                    </p>
                    <br><br>
                    <p>Telah diverifikasi, silahkan lengkapi kurikulum Bapak/Ibu.<br>
                    </p>
                    <p>
                    Terima Kasih<br>
                    Nakula Sehat Kementerian Kesehatan</p>
                ');
                $this->email->send();

                redirect('kurikulum/?status=penyusunan-kurikulum');

            }
            else
            {
                $keterangan_ketersediaan_kurikulum = "Tidak Tersedia";
                $keterangan_kebutuhan_pelatihan = "Non Pelatihan"; 
                $status = 0; 
                $keterangan_status = "Dihentikan";
                $dihentikan_oleh = $this->session->userdata('id_user');
                $alasan_dihentikan = "Kebutuhan Non Pelatihan";
                $status_dihentikan = 1;
                $keterangan_status_dihentikan = "Non Pelatihan";
                $waktu_dihentikan = date('Y-m-d H:i:s');
                $deadline = NULL;
                $kata_kunci = $this->input->post('kata_kunci');

                $data = array(
                    'ketersediaan_kurikulum' => $ketersediaan_kurikulum,
                    'keterangan_ketersediaan_kurikulum' => $keterangan_ketersediaan_kurikulum,
                    'kebutuhan_pelatihan' => $kebutuhan_pelatihan,
                    'keterangan_kebutuhan_pelatihan' => $keterangan_kebutuhan_pelatihan,
                    'status' => $status,
                    'keterangan_status' => $keterangan_status,
                    'verif_at' => date('Y-m-d H:i:s'),
                    'verif_by' => $this->session->userdata('id_user'),
                    'updated_by' => $this->session->userdata('id_user'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'deadline' => $deadline,
                    'dihentikan_oleh' => $dihentikan_oleh,
                    'alasan_dihentikan' => $alasan_dihentikan,
                    'status_dihentikan' => $status_dihentikan,
                    'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
                    'waktu_dihentikan' => $waktu_dihentikan,
                    'kata_kunci' => $kata_kunci,
                );
                $where = array('id_kurikulum' => $this->input->post('id_kurikulum'));
                $query = $this->M_entitas->all_update('kurikulum', $data, $where);

                $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id_kurikulum')))->row();
                $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

                $to_mail = $get_sdm->email;

                $this->load->library('email');

                $from_email = "no-reply";
                $config['protocol']    = 'smtp';
                $config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
                $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not

                $this->email->initialize($config);

                $this->email->from($from_email, 'Kurikulum Non Pelatihan');
                $this->email->to($to_mail);
                $this->email->subject('Kurikulum Non Pelatihan');
                $this->email->message('
                    <h2>Non Pelatihan</h2>
                    <p>Pengajuan Kurikulum Bapak/Ibu dengan  :
                    <br>  
                    <p>
                        Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                        <br>
                    </p>
                    <br><br>
                    <p>Tidak dapat dilanjutkan karena tidak termasuk kategori <b>PELATIHAN</b>.<br>
                    </p>
                    <p>
                    Terima Kasih<br>
                    Nakula Sehat Kementerian Kesehatan</p>
                ');
                $this->email->send();

                redirect('kurikulum/?status=dihentikan'); 
            }
        }

    }

    public function surat_keterangan_ketersediaan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(3)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;
        $data['pengesah'] = $this->M_entitas->selectSemua('master_pengesah')->row();

        $a = $this->get_api_kurikulum_by_judul($kurikulum->kata_kunci);

        $b = json_decode($a,true);

        if($b['message'] == "success")
        {
            $get_data = $b['data'];

            $data['kurikulum_tersedia'] = $get_data;
            $data['ketersediaan_kurikulum'] = 1;
        }
        else
        {
            $data['ketersediaan_kurikulum'] = 2;
        }

        $this->load->view('kurikulum/surat_keterangan_ketersediaan_kurikulum',$data);
    }

    public function surat_keterangan_non_pelatihan()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(3)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;
        $data['pengesah'] = $this->M_entitas->selectSemua('master_pengesah')->row();

        $this->load->view('kurikulum/surat_keterangan_non_pelatihan',$data);
    }

    public function list_pengisian_kurikulum()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['draft'] = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id))->result();
        $data['jumlah_draft'] = count($data['draft']);

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/list_pengisian_kurikulum');
        $this->load->view('shared/footer_akun');
    }

    public function isi_bab_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));
        $id_bab = base64_decode(hex2bin($this->uri->segment(3)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $id_bab))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        if($list)
        {
            $data['catatan'] = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum, 'status' => 1))->num_rows();
            $data['get_catatan'] = $this->M_entitas->order_by_where_limit('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum), 'id_catatan', 'DESC', 1)->row();
            $data['list'] = $list;
        }
        else
        {
            $data['catatan'] = ""; $data['get_catatan'] = ""; $data['list'] = NULL;
        }
        $data['id_bab'] = $id_bab;

        if($id_bab == 1)
        {
            $data['bab_satu_pendahuluan'] = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $id_kurikulum))->row();
            $get_view = "pendahuluan";
        }
        else if($id_bab == 3)
        {
            $data['diagram'] = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $id_kurikulum))->row();
            $get_view = "diagram_alur_pelatihan";
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_bab_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_list_pengerjaan_kurikulum = $this->input->post('id_list_pengerjaan_kurikulum');
        if($id_list_pengerjaan_kurikulum == 0)
        {
            $list = "";
            $id_bab = $this->input->post('id_bab');
        }
        else
        {
            $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();
            $id_bab = $list->id_bab_subbab;
        }

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;

        if($kurikulum->status == 3 || $kurikulum->status == 5){ $is_kesesuaian_penilaian = 1; }
        else if($kurikulum->status == 8){ $is_kesesuaian_penilaian = 2; }

        if($id_bab == 1)
        {
            $cek = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $id_kurikulum))->row();
            if($cek)
            {
                $data = array(
                    'pendahuluan' => $this->input->post('pendahuluan'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->userdata('id_user'),
                );
                $where = array('id_kurikulum' => $id_kurikulum);
                $query = $this->M_entitas->all_update('bab_satu_pendahuluan', $data, $where);

                $bab_satu_pendahuluan = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $id_kurikulum))->row();

                $id_bab_satu_pendahuluan = $bab_satu_pendahuluan->id_bab_satu_pendahuluan;

                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $id_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);

                $is_perbaikan = $this->input->post('is_perbaikan');
                if($is_perbaikan == 1)
                {
                    $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();

                    foreach ($get_catatan as $key) 
                    {
                        $data = array(
                            'status' => 2,
                        );
                        $where = array('id_catatan' => $key->id_catatan);
                        $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                    }

                    $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();
                    if($get_list->status == 3){ $status = 5; }
                    else if($get_list->status == 6){ $status = 8; }

                    $data = array(
                        'status' => $status,
                    );
                    $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                    $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
                }
            }
            else
            {
                $data = array(
                    'id_kurikulum' => $this->input->post('id_kurikulum'),
                    'judul' => $this->input->post('judul'),
                    'pendahuluan' => $this->input->post('pendahuluan'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('bab_satu_pendahuluan', $data);

                $id_bab_satu_pendahuluan = $this->db->insert_id();

                $data = array(
                    'id_kurikulum' => $this->input->post('id_kurikulum'),
                    'is_bab_subbab' => 1,
                    'id_bab_subbab' => $id_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }

            redirect('list-pengisian-kurikulum/'.bin2hex(base64_encode($id_kurikulum)));
        }
        else if($id_bab == 3)
        {
            $cek = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $id_kurikulum))->num_rows();
            $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

            if($cek == 1)
            {
                if(isset($_FILES['diagram_alur_proses_pelatihan']['name']))
                {
                    $config['upload_path']   = './agenda/perdata/diagram_alur_proses_pelatihan/';
                    $config['file_name']     = rand(1,990)."_".$get_kurikulum->judul_portal."_".date('YmdHis'); 
                    $config['overwrite']     = true;
                    $config['allowed_types']     = '*';
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('diagram_alur_proses_pelatihan')){
                        $diagram_alur_proses_pelatihan = $this->input->post('diagram_alur_proses_pelatihan_old');
                    }
                    else
                    {
                        $diagram_alur_proses_pelatihan = $this->upload->data()['file_name'];
                        $diagram_alur_proses_pelatihan_old = './agenda/perdata/diagram_alur_proses_pelatihan/'.$this->input->post('diagram_alur_proses_pelatihan_old');
                        if(file_exists($diagram_alur_proses_pelatihan_old)) { unlink($diagram_alur_proses_pelatihan_old); }
                    }
                }
                else
                {
                    $diagram_alur_proses_pelatihan = $this->input->post('diagram_alur_proses_pelatihan_old');
                }

                $data = array(
                    'diagram_alur_proses_pelatihan' => $diagram_alur_proses_pelatihan,
                    'keterangan' => $this->input->post('keterangan'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->userdata('id_user'),
                );
                $where = array('id_diagram_alur_proses_pelatihan' => $this->input->post('id_diagram_alur_proses_pelatihan'));
                $query = $this->M_entitas->all_update('diagram_alur_proses_pelatihan', $data, $where);

                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $id_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);

                $is_perbaikan = $this->input->post('is_perbaikan');
                if($is_perbaikan == 1)
                {
                    $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                    foreach ($get_catatan as $key) 
                    {
                        $data = array(
                            'status' => 2,
                        );
                        $where = array('id_catatan' => $key->id_catatan);
                        $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                    }

                    $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                    if($get_list->status == 3){ $status = 5; }
                    else if($get_list->status == 6){ $status = 8; }

                    $data = array(
                        'status' => $status,
                    );
                    $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                    $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
                }
            }
            else
            {
                if(isset($_FILES['diagram_alur_proses_pelatihan']['name']))
                {
                    $config['upload_path']   = './agenda/perdata/diagram_alur_proses_pelatihan';
                    $config['file_name']     = rand(1,990)."_".$get_kurikulum->judul_portal."_".date('YmdHis');
                    $config['overwrite']     = true;
                    $config['allowed_types']     = '*';
                    $this->upload->initialize($config);
                        if(!$this->upload->do_upload('diagram_alur_proses_pelatihan'))
                        {
                            $diagram_alur_proses_pelatihan = NULL;
                        }else{
                            $diagram_alur_proses_pelatihan = $this->upload->data()['file_name'];
                        }
                }
                else
                {
                    $diagram_alur_proses_pelatihan = NULL;
                }

                $data = array(
                    'id_kurikulum' => $this->input->post('id_kurikulum'),
                    'diagram_alur_proses_pelatihan' => $diagram_alur_proses_pelatihan,
                    'keterangan' => $this->input->post('keterangan'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('diagram_alur_proses_pelatihan', $data);

                $data = array(
                    'id_kurikulum' => $this->input->post('id_kurikulum'),
                    'is_bab_subbab' => 1,
                    'id_bab_subbab' => $id_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }

            redirect('list-pengisian-kurikulum/'.bin2hex(base64_encode($id_kurikulum)));
        }
    }

    public function isi_subbab_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));
        $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->row();
        
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        if($list)
        {
            $data['catatan'] = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum, 'status' => 1))->num_rows();
            $data['get_catatan'] = $this->M_entitas->order_by_where_limit('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum), 'id_catatan', 'DESC', 1)->row();
            $data['list'] = $list;
        }
        else
        {
            $data['catatan'] = ""; $data['get_catatan'] = ""; $data['list'] = NULL;
        }

        $data['id_sub_bab'] = $id_sub_bab;

        if($id_sub_bab == 1)
        {
            $get_view = "tujuan";
        }
        else if($id_sub_bab == 2)
        {
            $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id_kurikulum))->result();

            $get_view = "kompetensi";
        }
        else if($id_sub_bab == 3)
        {
            $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 3))->result();

            $get_view = "struktur_kurikulum";
        }
        else if($id_sub_bab == 4)
        {
            $data['evaluasi_hasil_belajar'] = $this->M_entitas->selectX('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id_kurikulum))->result();

            $get_view = "evaluasi_hasil_belajar";
        }
        else if($id_sub_bab == 5)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;

            $get_view = "rbpmp";
        }
        else if($id_sub_bab == 6)
        {
            $data['master_jadwal'] = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id_kurikulum))->result();

            $get_view = "master_jadwal";
        }
        else if($id_sub_bab == 7)
        {
            $metode_materi = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id_kurikulum, 'is_penugasan' => 1), 'id_materi', 'ASC')->result();
            $data['materi_metode'] = $this->M_view->get_materi_metode($id_kurikulum)->result();
            $panduan_praktik_lapang = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $id_kurikulum))->result();

            $a = 0; $b = 0; $jumlah_status = 0;
            foreach ($metode_materi as $key) 
            {
                if($key->id_metode != 4)
                {
                    $a++;
                    if($key->status_penugasan == 1)
                    {
                        $jumlah_status++;
                    }
                }
                else if($key->id_metode == 4)
                {
                    $b = 1;
                    $is_pl = 1;
                }
            }
            if($b == 1){ $ada_pl = 1; } else { $ada_pl = 0; }
            $c = $a + $b;
            
            if($panduan_praktik_lapang){ $jumlah_status += 1; }

            $data['jumlah_status'] = $jumlah_status;
            $data['ada_pl'] = $ada_pl;
            $data['jumlah_metode_penugasan'] = $c;
            $data['metode_materi'] = $metode_materi;

            $get_view = "panduan_penugasan";
        }
        else if($id_sub_bab == 8)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id_kurikulum))->result();

            $get_view = "ketentuan_penyelenggaraan_pelatihan";
        }
        else if($id_sub_bab == 9)
        {
            $data['instrumen_evaluasi'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum))->result();
            $data['evaluasi_peserta'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 1))->result();
            $data['evaluasi_fasilitator'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 2))->result();
            $data['evaluasi_penyelenggara'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 3))->result();

            $data['nilai_instrumen_evaluasi'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum))->result();
            $data['nilai_evaluasi_peserta'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 1))->result();
            $data['nilai_evaluasi_fasilitator'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 2))->result();
            $data['nilai_evaluasi_penyelenggara'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id_kurikulum, 'jenis_penilaian' => 3))->result();

            $get_view = "instrumen_evaluasi";
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_subbab_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_list_pengerjaan_kurikulum = $this->input->post('id_list_pengerjaan_kurikulum');

        if($id_list_pengerjaan_kurikulum == 0)
        {
            $list = ""; 
            $id_sub_bab = $this->input->post('id_sub_bab');
        }
        else
        {
            $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();
            $id_sub_bab = $list->id_bab_subbab;
        }

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;

        if($kurikulum->status == 3 || $kurikulum->status == 5){ $is_kesesuaian_penilaian = 1; }
        else if($kurikulum->status == 8){ $is_kesesuaian_penilaian = 2; }

        if($id_sub_bab == 1)
        {
            $data = array(
                'tujuan' => $this->input->post('tujuan')
            );
            $where = array('id_kurikulum' => $id_kurikulum);
            $query = $this->M_entitas->all_update('kurikulum', $data, $where);

            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 2)
        {
            $data = array(
                'kompetensi' => $this->input->post('kompetensi')
            );
            $where = array('id_kurikulum' => $id_kurikulum);
            $query = $this->M_entitas->all_update('kurikulum', $data, $where);

            if(count($this->input->post('isi_kompetensi')) > 0)
            {
                $this->M_entitas->delete_data('isi_kompetensi', array('id_kurikulum' => $id_kurikulum));

                foreach ($this->input->post('isi_kompetensi') as $key) 
                {
                    $data = array(
                        'id_kurikulum' => $id_kurikulum,
                        'isi_kompetensi' => $key,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_user'),
                    );
                    $query = $this->M_entitas->all_insert('isi_kompetensi', $data);
                }
            }
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 3)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'status_penilaian' => 1))->result();

                if($get_materi)
                {
                    foreach ($get_materi as $key) 
                    {
                        $data = array(
                            'status_penilaian' => 2,
                        );
                        $where = array('id_materi' => $key->id_materi);
                        $query = $this->M_entitas->all_update('materi', $data, $where);
                    }
                }

                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 4)
        {
            $data = array(
                'evaluasi_hasil_belajar' => $this->input->post('evaluasi_hasil_belajar')
            );
            $where = array('id_kurikulum' => $id_kurikulum);
            $query = $this->M_entitas->all_update('kurikulum', $data, $where);

            if(count($this->input->post('isi_evaluasi_hasil_belajar')) > 0)
            {
                $this->M_entitas->delete_data('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id_kurikulum));

                foreach ($this->input->post('isi_evaluasi_hasil_belajar') as $key) 
                {
                    $data = array(
                        'id_kurikulum' => $id_kurikulum,
                        'isi_evaluasi_hasil_belajar' => $key,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_user'),
                    );
                    $query = $this->M_entitas->all_insert('isi_evaluasi_hasil_belajar', $data);
                }
            }

            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 5)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id_kurikulum, 'status_penilaian_rbpmp' => 1))->result();

                if($get_materi)
                {
                    foreach ($get_materi as $key) 
                    {
                        $data = array(
                            'status_penilaian_rbpmp' => 2,
                        );
                        $where = array('id_materi' => $key->id_materi);
                        $query = $this->M_entitas->all_update('materi', $data, $where);
                    }
                }

                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 6)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 7)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_panduan = $this->M_entitas->selectX('metode_materi', array('id_kurikulum' => $id_kurikulum, 'status_penilaian' => 1))->result();

                if($get_panduan)
                {
                    foreach ($get_panduan as $key)
                    {
                        $data = array(
                            'status_penilaian' => 2,
                        );
                        $where = array('id_metode_materi' => $key->id_metode_materi);
                        $query = $this->M_entitas->all_update('metode_materi', $data, $where);
                    }
                }

                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 8)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan_ketentuan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $id_kurikulum, 'status' => 1))->result();

                if($get_catatan_ketentuan)
                {
                    foreach ($get_catatan_ketentuan as $key)
                    {
                        $data = array(
                            'status' => 2,
                        );
                        $where = array('id_catatan_ketentuan_penyelenggara_pelatihan' => $key->id_catatan_ketentuan_penyelenggara_pelatihan);
                        $query = $this->M_entitas->all_update('catatan_ketentuan_penyelenggara_pelatihan', $data, $where);
                    }
                }

                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }
        else if($id_sub_bab == 9)
        {
            $cek = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab))->num_rows();

            if($cek == 0)
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'is_bab_subbab' => 2,
                    'id_bab_subbab' => $id_sub_bab,
                    'status' => 1,
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data);
            }
            else if($cek > 0)
            {
                $data = array(
                    'last_updated' => date('Y-m-d H:i:s'),
                );
                $where = array('id_kurikulum' => $id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $id_sub_bab);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $is_perbaikan = $this->input->post('is_perbaikan');
            if($is_perbaikan == 1)
            {
                $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->result();
                foreach ($get_catatan as $key) 
                {
                    $data = array(
                        'status' => 2,
                    );
                    $where = array('id_catatan' => $key->id_catatan);
                    $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
                }

                $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

                if($get_list->status == 3){ $status = 5; }
                else if($get_list->status == 6){ $status = 8; }

                $data = array(
                    'status' => $status,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }
        }

        redirect('list-pengisian-kurikulum/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function detail_kata_pengantar()
    {
        $id = base64_decode(hex2bin($this->input->post('id')));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kata_pengantar'] = $this->M_entitas->selectX('kata_pengantar', array('id_kurikulum' => $id))->row();

        $this->load->view('kurikulum/detail_kata_pengantar', $data);
    }

    public function detail_tim_penyusun()
    {
        $id = base64_decode(hex2bin($this->input->post('id')));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['tim_penyusun'] = $this->M_entitas->selectX('tim_penyusun', array('id_kurikulum' => $id))->result();

        $this->load->view('kurikulum/detail_tim_penyusun', $data);
    }

    public function detail_bab_kurikulum()
    {
        $id = base64_decode(hex2bin($this->input->post('id')));
        $id_bab = base64_decode(hex2bin($this->input->post('id_bab')));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        if($id_bab == 1)
        {
            $data['bab_satu_pendahuluan'] = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $id))->row();
            $get_view = "detail_pendahuluan";
        }
        else if($id_bab == 3)
        {
            $data['diagram'] = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $id))->row();
            $get_view = "detail_diagram_alur_pelatihan";
        }

        $this->load->view('kurikulum/'.$get_view, $data);
    }

    public function detail_subbab_kurikulum()
    {
        $id = base64_decode(hex2bin($this->input->post('id')));
        $id_sub_bab = base64_decode(hex2bin($this->input->post('id_subbab')));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['kurikulum'] = $kurikulum;

        if($id_sub_bab == 1)
        {
            $get_view = "detail_tujuan";
        }
        else if($id_sub_bab == 2)
        {
            $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
            $get_view = "detail_kompetensi";
        }
        else if($id_sub_bab == 3)
        {
            $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $get_view = "detail_struktur_kurikulum";
        }
        else if($id_sub_bab == 4)
        {
            $data['evaluasi_hasil_belajar'] = $this->M_entitas->selectX('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id))->result();
            $get_view = "detail_evaluasi_hasil_belajar";
        }
        else if($id_sub_bab == 5)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $get_view = "detail_rbpmp";

            $data['jumlah_materi'] = count($materi);

            $jumlah_status = 0;
            foreach ($materi as $key){ if($key->status == 1){ $jumlah_status++; } }

            $data['status_materi'] = $jumlah_status;
        }
        else if($id_sub_bab == 6)
        {
            $data['master_jadwal'] = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id))->result();
            $get_view = "detail_master_jadwal";
        }
        else if($id_sub_bab == 7)
        {
            $data['penugasan_materi'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'is_penugasan' => 1, 'id_metode != ' => 4), 'id_materi', 'ASC')->result();
            $data['penugasan_pl'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'id_metode' => 4), 'id_materi', 'ASC')->result();

            $get_view = "detail_panduan_penugasan_list";
        }
        else if($id_sub_bab == 8)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();
            $get_view = "detail_ketentuan_penyelenggaraan_pelatihan";

            $jumlah_materi = count($materi);
            $data['jumlah_materi'] = $jumlah_materi;

            $jumlah_status_materi = 0;
            foreach ($materi as $key){ if($key->status_ketentuan_penyelenggaraan_pelatihan == 1){ $jumlah_status_materi++; } }

            $jumlah_status = $jumlah_status_materi;
            
            $cek_peserta = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->num_rows();

            if($cek_peserta > 0){ $jumlah_status += 1; }
            if($kurikulum->jumlah_peserta){ $jumlah_status += 1; }
            if($kurikulum->ketentuan_penyelenggara){ $jumlah_status += 1; }
            if($kurikulum->sertifikat){ $jumlah_status += 1; }

            $data['jumlah'] = $jumlah_materi + 4;

            $data['status_materi'] = $jumlah_status;
        }
        else if($id_sub_bab == 9)
        {
            $data['instrumen_evaluasi'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['evaluasi_peserta'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['evaluasi_fasilitator'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['evaluasi_penyelenggara'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $data['nilai_instrumen_evaluasi'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['nilai_evaluasi_peserta'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['nilai_evaluasi_fasilitator'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['nilai_evaluasi_penyelenggara'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $status_nilai = 0;
            // if(count($data['evaluasi_peserta']) > 0){ $status_nilai += 1; }
            if(count($data['evaluasi_fasilitator']) > 0){ $status_nilai += 1; }
            if(count($data['evaluasi_penyelenggara']) > 0){ $status_nilai += 1; }
            // if(count($data['nilai_evaluasi_peserta']) > 0){ $status_nilai += 1; }
            if(count($data['nilai_evaluasi_fasilitator']) > 0){ $status_nilai += 1; }
            if(count($data['nilai_evaluasi_penyelenggara']) > 0){ $status_nilai += 1; }


            $data['status_nilai'] = $status_nilai;

            $get_view = "detail_instrumen_evaluasi";
        }

        $data['id_sub_bab'] = $id_sub_bab;

        $this->load->view('kurikulum/'.$get_view, $data);
    }

    public function tambah_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_materi()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'jenis_materi' => $this->input->post('jenis_materi'),
            'materi' => $this->input->post('materi'),
            't' => $this->input->post('t'),
            'p' => $this->input->post('p'),
            'pl' => $this->input->post('pl'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('materi', $data);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(3)));
    }

    public function ubah_materi()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_materi()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $this->input->post('id_materi')))->row();

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'jenis_materi' => $this->input->post('jenis_materi'),
            'materi' => $this->input->post('materi'),
            't' => $this->input->post('t'),
            'p' => $this->input->post('p'),
            'pl' => $this->input->post('pl'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_materi' => $this->input->post('id_materi'));
        $query = $this->M_entitas->all_update('materi', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(3)));
    }

    public function hapus_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(3)));

        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $id))->row();
        $id_kurikulum = $materi->id_kurikulum;

        $this->M_entitas->delete_data('materi', array('id_materi' => $id));

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(3)));
    }

    public function isi_ubah_rbpmp()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();
        $data['indikator_hasil_belajar'] = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $id_materi))->result();
        $data['metode'] = $this->M_entitas->selectX('metode_materi', array('id_materi' => $id_materi))->result();
        $data['media_alat_bantu'] = $this->M_entitas->selectX('media_alat_bantu_materi', array('id_materi' => $id_materi))->result();
        $data['referensi'] = $this->M_entitas->selectX('referensi_materi', array('id_materi' => $id_materi))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_rbpmp', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_ubah_rbpmp()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $materi->id_kurikulum))->row();
        $cek_deskripsi = $materi->deskripsi;
        $cek_hasil_belajar = $materi->hasil_belajar;
        $cek_indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $id_materi))->result();
        $cek_metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $id_materi))->result();
        $cek_media = $this->M_entitas->selectX('media_alat_bantu_materi', array('id_materi' => $id_materi))->result();
        $cek_referensi = $this->M_entitas->selectX('referensi_materi', array('id_materi' => $id_materi))->result();

        $nilai = 0;
        if($cek_deskripsi){ $nilai = $nilai+1; }
        if($cek_hasil_belajar){ $nilai = $nilai+1; }
        if($cek_indikator){ $nilai = $nilai+1; }
        if($cek_metode){ $nilai = $nilai+1; }
        if($cek_referensi){ $nilai = $nilai+1; }

        if($nilai == 5){ $status = 1; }
        else{ $status = 2; }

        $data = array(
            'status' => $status,
            'nilai' => $nilai,
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode(5)));
    }

    public function detail_materi()
    {
        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $this->input->post('id')))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $materi->id_kurikulum))->row();
        $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $materi->id_materi))->result();
        $data['metode'] = $this->M_entitas->selectX('metode_materi', array('id_materi' => $materi->id_materi))->result();
        $data['media'] = $this->M_entitas->selectX('media_alat_bantu_materi', array('id_materi' => $materi->id_materi))->result();
        $data['referensi'] = $this->M_entitas->selectX('referensi_materi', array('id_materi' => $materi->id_materi))->result();
        $data['materi'] = $materi;
        $data['total_indikator'] = count($indikator);
        $data['indikator'] = $indikator;

        $this->load->view('kurikulum/detail_materi', $data);
    }

    public function isi_deskripsi_mata_pelatihan_materi()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_deskripsi_mata_pelatihan_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_deskripsi_mata_pelatihan_materi()
    {
        $id_materi = $this->input->post('id_materi');

        $data = array(
            'deskripsi' => $this->input->post('deskripsi')
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function isi_hasil_belajar_materi()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_hasil_belajar_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_hasil_belajar_materi()
    {
        $id_materi = $this->input->post('id_materi');

        $data = array(
            'hasil_belajar' => $this->input->post('hasil_belajar')
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function tambah_indikator_hasil_belajar()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_indikator_hasil_belajar', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_indikator_hasil_belajar()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_materi = $this->input->post('id_materi');

        $data = array(
            'id_materi' => $id_materi,
            'id_kurikulum' => $id_kurikulum,
            'indikator_hasil_belajar' => $this->input->post('indikator_hasil_belajar'),
            'materi_sub_materi_pokok' => $this->input->post('materi_sub_materi_pokok'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('indikator_hasil_belajar', $data);

        $id_indikator_hasil_belajar = $this->db->insert_id();

        if(count($this->input->post('isi_materi_sub_materi_pokok')) > 0)
        {
            if($this->input->post('isi_materi_sub_materi_pokok')[0] != "")
            {
                foreach ($this->input->post('isi_materi_sub_materi_pokok') as $key) 
                {
                    $data = array(
                        'id_indikator_hasil_belajar' => $id_indikator_hasil_belajar,
                        'id_materi' => $id_materi,
                        'id_kurikulum' => $id_kurikulum,
                        'isi_materi_sub_materi_pokok' => $key
                    );
                    $query = $this->M_entitas->all_insert('isi_materi_sub_materi_pokok', $data);
                }
            }
        }

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function ubah_indikator_hasil_belajar()
    {
        $id_indikator_hasil_belajar = base64_decode(hex2bin($this->uri->segment(2)));

        $data['indikator_hasil_belajar'] = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_indikator_hasil_belajar' => $id_indikator_hasil_belajar))->row();
        $data['materi_sub_materi_pokok'] = $this->M_entitas->selectX('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $id_indikator_hasil_belajar))->result();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $data['indikator_hasil_belajar']->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_indikator_hasil_belajar', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_indikator_hasil_belajar()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_materi = $this->input->post('id_materi');
        $id_indikator_hasil_belajar = $this->input->post('id_indikator_hasil_belajar');

        $data = array(
            'indikator_hasil_belajar' => $this->input->post('indikator_hasil_belajar'),
            'materi_sub_materi_pokok' => $this->input->post('materi_sub_materi_pokok'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_indikator_hasil_belajar' => $id_indikator_hasil_belajar);
        $query = $this->M_entitas->all_update('indikator_hasil_belajar', $data, $where);

        $this->M_entitas->delete_data('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $id_indikator_hasil_belajar));

        if(count($this->input->post('isi_materi_sub_materi_pokok')) > 0)
        {
            if($this->input->post('isi_materi_sub_materi_pokok')[0] != "")
            {
                foreach ($this->input->post('isi_materi_sub_materi_pokok') as $key) 
                {
                    $data = array(
                        'id_indikator_hasil_belajar' => $id_indikator_hasil_belajar,
                        'id_materi' => $id_materi,
                        'id_kurikulum' => $id_kurikulum,
                        'isi_materi_sub_materi_pokok' => $key
                    );
                    $query = $this->M_entitas->all_insert('isi_materi_sub_materi_pokok', $data);
                }
            }
        }

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function hapus_indikator_hasil_belajar()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_indikator_hasil_belajar' => $id))->row();
        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $indikator->id_materi))->row();
        $id_materi = $materi->id_materi;

        $this->M_entitas->delete_data('indikator_hasil_belajar', array('id_indikator_hasil_belajar' => $id));
        $this->M_entitas->delete_data('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $id));

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function tambah_metode_materi()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();
        $data['metode'] = $this->M_entitas->selectX('entitas__metode', array('status' => 1))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_metode_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_metode_materi()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_metode = $this->input->post('id_metode');
        $get_metode = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id_metode))->row();
        $metode = $get_metode->metode;
        $is_penugasan = $get_metode->is_penugasan;

        $data = array(
            'id_materi' => $id_materi,
            'id_kurikulum' => $id_kurikulum,
            'id_metode' => $id_metode,
            'metode' => $metode,
            'is_penugasan' => $is_penugasan,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('metode_materi', $data);        

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function ubah_metode_materi()
    {
        $id_metode_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['metode_materi'] = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id_metode_materi))->row();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $data['metode_materi']->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();
        $data['metode'] = $this->M_entitas->selectX('entitas__metode', array('status' => 1))->result();
        $data['tambahan_alat_bantu'] = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $id_metode_materi))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_metode_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_metode_materi()
    {
        $id_materi = $this->input->post('id_materi');
        $id_metode_materi = $this->input->post('id_metode_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_metode = $this->input->post('id_metode');
        $get_metode = $this->M_entitas->selectX('entitas__metode', array('id_metode' => $id_metode))->row();
        $metode = $get_metode->metode;
        $is_penugasan = $get_metode->is_penugasan;
 
        $data = array(
            'id_metode' => $id_metode,
            'metode' => $metode,
            'is_penugasan' => $is_penugasan,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_metode_materi' => $id_metode_materi);
        $query = $this->M_entitas->all_update('metode_materi', $data, $where);

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function hapus_metode_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $metode = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id))->row();
        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $metode->id_materi))->row();
        $id_materi = $materi->id_materi;

        $this->M_entitas->delete_data('metode_materi', array('id_metode_materi' => $id));

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function tambah_referensi_materi()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_referensi_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_referensi_materi()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');

        if(count($this->input->post('referensi_materi')) > 0)
        {
            foreach ($this->input->post('referensi_materi') as $key) 
            {
                $data = array(
                    'id_materi' => $id_materi,
                    'id_kurikulum' => $id_kurikulum,
                    'referensi_materi' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id_user')
                );
                $query = $this->M_entitas->all_insert('referensi_materi', $data);
            }
        }

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function ubah_referensi_materi()
    {
        $id_referensi_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['referensi'] = $this->M_entitas->selectX('referensi_materi', array('id_referensi_materi' => $id_referensi_materi))->row();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $data['referensi']->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_referensi_materi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_referensi_materi()
    {
        $id_materi = $this->input->post('id_materi');
        $id_referensi_materi = $this->input->post('id_referensi_materi');
 
        $data = array(
            'referensi_materi' => $this->input->post('referensi_materi'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_referensi_materi' => $id_referensi_materi);
        $query = $this->M_entitas->all_update('referensi_materi', $data, $where);

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function hapus_referensi_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $referensi = $this->M_entitas->selectX('referensi_materi', array('id_referensi_materi' => $id))->row();
        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $referensi->id_materi))->row();
        $id_materi = $materi->id_materi;

        $this->M_entitas->delete_data('referensi_materi', array('id_referensi_materi' => $id));

        redirect('isi-ubah-rbpmp/'.bin2hex(base64_encode($id_materi)));
    }

    public function aksi_isi_hari_jadwal()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
 
        $data = array(
            'jumlah_hari_pelatihan' => $this->input->post('jumlah_hari_pelatihan')
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(6)));
    }

    public function tambah_master_jadwal()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_master_jadwal', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_master_jadwal()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $is_materi = $this->input->post('is_materi');

        $cek = $this->M_entitas->selectX('master_jadwal', array('hari_ke' => $this->input->post('hari_ke'), 'id_kurikulum' => $id_kurikulum))->result();
        $get_jpl = 0;
        foreach ($cek as $key) 
        {
            $get_jpl += $key->jpl;
        }

        if($get_jpl <= 10)
        {
            if($is_materi == 1)
            {
                $id_materi = $this->input->post('id_materi');
                $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
                $mata_pelatihan = $get_materi->materi;
                $t_p_pl_materi = $this->input->post('t_p_pl_materi');
                $jpl = $this->input->post('jpl');
            }
            else if($is_materi == 2)
            {
                $id_materi = NULL; $t_p_pl_materi = NULL; $jpl = NULL;
                $mata_pelatihan = $this->input->post('mata_pelatihan');
            }

            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'hari_ke' => $this->input->post('hari_ke'),
                'waktu_awal' => $this->input->post('waktu_awal'),
                'waktu_akhir' => $this->input->post('waktu_akhir'),
                'is_materi' => $is_materi,
                'id_materi' => $id_materi,
                't_p_pl_materi' => $t_p_pl_materi,
                'jpl' => $jpl,
                'mata_pelatihan' => $mata_pelatihan,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user')
            );
            $query = $this->M_entitas->all_insert('master_jadwal', $data);

            redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(6)));
        }
        else
        {
            $message['msg'] = 'JPL sudah melebihi batas maksimum perhari';
            $this->session->set_flashdata($message);
            redirect('tambah-master-jadwal/'.bin2hex(base64_encode($id_kurikulum)));
        }
    }

    public function ubah_master_jadwal()
    {
        $id_master_jadwal = base64_decode(hex2bin($this->uri->segment(2)));

        $data['master_jadwal'] = $this->M_entitas->selectX('master_jadwal', array('id_master_jadwal' => $id_master_jadwal))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['master_jadwal']->id_kurikulum))->row();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $data['kurikulum']->id_kurikulum))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_master_jadwal', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_master_jadwal()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $is_materi = $this->input->post('is_materi');

        if($is_materi == 1)
        {
            $id_materi = $this->input->post('id_materi');
            $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
            $mata_pelatihan = $get_materi->materi;
            $t_p_pl_materi = $this->input->post('t_p_pl_materi');
            if($t_p_pl_materi == 1){ $jpl = $get_materi->t; }
            else if($t_p_pl_materi == 2){ $jpl = $get_materi->p; }
            else if($t_p_pl_materi == 3){ $jpl = $get_materi->pl; }
        }
        else if($is_materi == 2)
        {
            $id_materi = NULL; $t_p_pl_materi = NULL; $jpl = NULL;
            $mata_pelatihan = $this->input->post('mata_pelatihan');
        }

        $data = array(
            'hari_ke' => $this->input->post('hari_ke'),
            'waktu_awal' => $this->input->post('waktu_awal'),
            'waktu_akhir' => $this->input->post('waktu_akhir'),
            'is_materi' => $is_materi,
            'id_materi' => $id_materi,
            't_p_pl_materi' => $t_p_pl_materi,
            'jpl' => $jpl,
            'mata_pelatihan' => $mata_pelatihan,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_master_jadwal' => $this->input->post('id_master_jadwal'));
        $query = $this->M_entitas->all_update('master_jadwal', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(6)));
    }

    public function hapus_master_jadwal()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $master_jadwal = $this->M_entitas->selectX('master_jadwal', array('id_master_jadwal' => $id))->row();
        $id_kurikulum = $master_jadwal->id_kurikulum;

        $this->M_entitas->delete_data('master_jadwal', array('id_master_jadwal' => $id));

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(6)));
    }

    public function isi_ubah_panduan_penugasan()
    {
        $id_metode_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id_metode_materi))->row();
        $data['metode_materi'] = $metode_materi;
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $metode_materi->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $metode_materi->id_kurikulum))->row();
        $data['indikator'] = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $metode_materi->id_materi))->result();
        $data['media_alat_bantu'] = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $metode_materi->id_metode))->result();
        $data['petunjuk'] = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $id_metode_materi))->result();
        $data['media_tambahan'] = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $id_metode_materi))->result();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_panduan_penugasan', $data);
        $this->load->view('shared/footer_akun');
    }

    public function tambah_alat_bahan_panduan_penugasan_metode()
    {
        $id_metode_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id_metode_materi))->row();
        $data['metode_materi'] = $metode_materi;
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $metode_materi->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $metode_materi->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_alat_bahan_panduan_penugasan_metode', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_alat_bahan_panduan_penugasan_metode()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_metode_materi = $this->input->post('id_metode_materi');
        $id_metode = $this->input->post('id_metode');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'id_metode_materi' => $id_metode_materi,
            'id_materi' => $id_materi,
            'id_metode' => $id_metode,
            'media_alat_bantu' => $this->input->post('media_alat_bantu'),
        );
        $query = $this->M_entitas->all_insert('media_alat_bantu_tambahan', $data);

        redirect('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($id_metode_materi)));
    }

    public function hapus_alat_bahan_panduan_penugasan_metode()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $get_tambahan = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_media_alat_bantu_tambahan' => $id))->row();
        $id_metode_materi = $get_tambahan->id_metode_materi;

        $this->M_entitas->delete_data('media_alat_bantu_tambahan', array('id_media_alat_bantu_tambahan' => $id));

        redirect('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($id_metode_materi)));
    }

    public function tambah_petunjuk_panduan_penugasan_metode()
    {
        $id_metode_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id_metode_materi))->row();
        $data['metode_materi'] = $metode_materi;
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $metode_materi->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $metode_materi->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_petunjuk_panduan_penugasan_metode', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_petunjuk_panduan_penugasan_metode()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_metode_materi = $this->input->post('id_metode_materi');
        $id_metode = $this->input->post('id_metode');

        $data = array(
            'id_metode_materi' => $id_metode_materi,
            'id_materi' => $id_materi,
            'materi' => $this->input->post('materi'),
            'id_metode' => $id_metode,
            'metode' => $this->input->post('metode'),
            'id_kurikulum' => $id_kurikulum,
            'petunjuk_panduan_penugasan' => $this->input->post('petunjuk_panduan_penugasan'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('petunjuk_panduan_penugasan', $data);

        redirect('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($id_metode_materi)));
    }

    public function ubah_petunjuk_panduan_penugasan_metode()
    {
        $id_petunjuk_panduan_penugasan = base64_decode(hex2bin($this->uri->segment(2)));

        $petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_petunjuk_panduan_penugasan' => $id_petunjuk_panduan_penugasan))->row();
        $data['petunjuk'] = $petunjuk;
        $data['metode_materi'] = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $petunjuk->id_metode_materi))->row();
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $petunjuk->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $petunjuk->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_petunjuk_panduan_penugasan_metode', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_petunjuk_panduan_penugasan_metode()
    {
        $id_materi = $this->input->post('id_materi');
        $id_metode_materi = $this->input->post('id_metode_materi');
        $id_petunjuk_panduan_penugasan = $this->input->post('id_petunjuk_panduan_penugasan');
 
        $data = array(
            'petunjuk_panduan_penugasan' => $this->input->post('petunjuk_panduan_penugasan'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_petunjuk_panduan_penugasan' => $id_petunjuk_panduan_penugasan);
        $query = $this->M_entitas->all_update('petunjuk_panduan_penugasan', $data, $where);

        redirect('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($id_metode_materi)));
    }

    public function hapus_petunjuk_panduan_penugasan_metode()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_petunjuk_panduan_penugasan' => $id))->row();
        $id_metode_materi = $petunjuk->id_metode_materi;

        $this->M_entitas->delete_data('petunjuk_panduan_penugasan', array('id_petunjuk_panduan_penugasan' => $id));

        redirect('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($id_metode_materi)));
    }

    public function aksi_isi_ubah_panduan_penugasan()
    {
        $id_metode_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id_metode_materi))->row();
        $cek_petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $id_metode_materi))->result();

        if($cek_petunjuk)
        { 
            $data = array(
                'status_penugasan' => 1,
            );
            $where = array('id_metode_materi' => $id_metode_materi);
            $query = $this->M_entitas->all_update('metode_materi', $data, $where);
        }

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($metode_materi->id_kurikulum)).'/'.bin2hex(base64_encode(7)));
    }

    public function detail_panduan_penugasan()
    {
        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $this->input->post('id')))->row();
        $data['metode_materi'] = $metode_materi;
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $metode_materi->id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $metode_materi->id_kurikulum))->row();
        $data['indikator'] = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $metode_materi->id_materi))->result();
        $data['media'] = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $metode_materi->id_metode))->result();
        $data['media_tambahan'] = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $metode_materi->id_metode_materi))->result();
        $data['petunjuk'] = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $metode_materi->id_metode_materi))->result();

        $this->load->view('kurikulum/detail_panduan_penugasan', $data);
    }

    public function isi_ubah_panduan_praktik_lapang()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['petunjuk'] = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $id_kurikulum))->result();
        $data['materi_pl'] = $this->M_view->get_materi_metode_pl($id_kurikulum)->result(); 
        
        $get_materi_pl = $this->M_view->get_all_materi_pl($id_kurikulum)->result();
        
        $jpl = 0;
        foreach ($get_materi_pl as $key) 
        {
            $jpl += $key->pl;
        }
        $data['jpl'] = $jpl;    

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_panduan_praktik_lapang', $data);
        $this->load->view('shared/footer_akun');
    }

    public function tambah_petunjuk_panduan_praktik_lapang()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_petunjuk_panduan_praktik_lapang', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_petunjuk_panduan_praktik_lapang()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'panduan_penugasan' => $this->input->post('panduan_penugasan'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('panduan_praktik_lapang', $data);

        redirect('isi-ubah-panduan-praktik-lapang/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function ubah_petunjuk_panduan_praktik_lapang()
    {
        $id_panduan_praktik_lapang = base64_decode(hex2bin($this->uri->segment(2)));

        $petunjuk = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_panduan_praktik_lapang' => $id_panduan_praktik_lapang))->row();
        $data['petunjuk'] = $petunjuk;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $petunjuk->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_petunjuk_panduan_praktik_lapang', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_petunjuk_panduan_praktik_lapang()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_panduan_praktik_lapang = $this->input->post('id_panduan_praktik_lapang');

        $data = array(
            'panduan_penugasan' => $this->input->post('panduan_penugasan'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_panduan_praktik_lapang' => $id_panduan_praktik_lapang);
        $query = $this->M_entitas->all_update('panduan_praktik_lapang', $data, $where);

        redirect('isi-ubah-panduan-praktik-lapang/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function hapus_petunjuk_panduan_praktik_lapang()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $petunjuk = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_panduan_praktik_lapang' => $id))->row();
        $id_kurikulum = $petunjuk->id_kurikulum;

        $this->M_entitas->delete_data('panduan_praktik_lapang', array('id_panduan_praktik_lapang' => $id));

        redirect('isi-ubah-panduan-praktik-lapang/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function aksi_isi_ubah_panduan_praktik_lapang()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $cek_petunjuk = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $id_kurikulum))->result();

        if($cek_petunjuk)
        {
            $get_materi_pl = $this->M_entitas->selectX('metode_materi', array('id_kurikulum' => $id_kurikulum, 'id_metode' => 4))->result();

            foreach ($get_materi_pl as $key) 
            {
                $data = array(
                    'status_penugasan' => 1
                );
                $where = array('id_metode_materi' => $key->id_metode_materi);
                $query = $this->M_entitas->all_update('metode_materi', $data, $where);
            }
        }

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(7)));
    }

    public function detail_panduan_praktik_lapang()
    {
        $data['petunjuk'] = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $this->input->post('id')))->result();
        $data['materi_pl'] = $this->M_view->get_materi_metode_pl($this->input->post('id'))->result();
        
        $get_materi_pl = $this->M_view->get_all_materi_pl($this->input->post('id'))->result();
        
        $jpl = 0;
        foreach ($get_materi_pl as $key) 
        {
            $jpl += $key->pl;
        }
        $data['jpl'] = $jpl;

        $this->load->view('kurikulum/detail_panduan_praktik_lapang', $data);
    }

    public function tambah_kriteria_peserta()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_kriteria_peserta', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_kriteria_peserta()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'isi_peserta' => $this->input->post('isi_peserta'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('isi_peserta', $data);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function ubah_kriteria_peserta()
    {
        $id_isi_peserta = base64_decode(hex2bin($this->uri->segment(2)));

        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_isi_peserta' => $id_isi_peserta))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['peserta']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_kriteria_peserta', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_kriteria_peserta()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'isi_peserta' => $this->input->post('isi_peserta'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_isi_peserta' => $this->input->post('id_isi_peserta'));
        $query = $this->M_entitas->all_update('isi_peserta', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function hapus_kriteria_peserta()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $peserta = $this->M_entitas->selectX('isi_peserta', array('id_isi_peserta' => $id))->row();
        $id_kurikulum = $peserta->id_kurikulum;

        $this->M_entitas->delete_data('isi_peserta', array('id_isi_peserta' => $id));

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function isi_ubah_jumlah_peserta()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_jumlah_peserta', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_ubah_jumlah_peserta()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'jumlah_peserta' => $this->input->post('jumlah_peserta')
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function isi_ubah_kriteria_fasilitator()
    {
        $id_materi = base64_decode(hex2bin($this->uri->segment(2)));

        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $id_materi))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['materi']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_kriteria_fasilitator', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_ubah_kriteria_fasilitator()
    {
        $id_materi = $this->input->post('id_materi');
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'kriteria_fasilitator' => $this->input->post('kriteria_fasilitator'),
            'status_ketentuan_penyelenggaraan_pelatihan' => 1,
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function isi_ubah_ketentuan_penyelenggara()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_ketentuan_penyelenggara', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_ubah_ketentuan_penyelenggara()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'ketentuan_penyelenggara' => $this->input->post('ketentuan_penyelenggara')
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function isi_ubah_sertifikat()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/isi_ubah_sertifikat', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_isi_ubah_sertifikat()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'sertifikat' => $this->input->post('sertifikat')
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(8)));
    }

    public function aksi_isi_instrumen_evaluasi_peserta()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $judul_portal = $this->input->post('judul_portal');

        if(isset($_FILES['instrumen_evaluasi_peserta']['name']))
        {
            $config['upload_path']   = './agenda/perdata/instrumen_evaluasi_peserta';
            $config['file_name']     = rand(0,999999).'_'.$judul_portal.'_'.date('YmdHis');
            $config['overwrite']     = true;
            $config['allowed_types']     = '*';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('instrumen_evaluasi_peserta'))
            {
                $instrumen_evaluasi_peserta = $this->input->post('instrumen_evaluasi_peserta_old');
            }
            else
            {
                $instrumen_evaluasi_peserta = $this->upload->data()['file_name'];
                $instrumen_evaluasi_peserta_old = './agenda/perdata/instrumen_evaluasi_peserta/'.$this->input->post('instrumen_evaluasi_peserta_old');
                if(file_exists($instrumen_evaluasi_peserta_old)) { unlink($instrumen_evaluasi_peserta_old); }
            }
        }
        else
        {
            $instrumen_evaluasi_peserta = $this->input->post('instrumen_evaluasi_peserta_old');
        }
 
        $data = array(
            'instrumen_evaluasi_peserta' => $instrumen_evaluasi_peserta
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function tambah_nilai_instrumen_evaluasi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_nilai_instrumen_evaluasi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_nilai_instrumen_evaluasi()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'jenis_penilaian' => $this->input->post('jenis_penilaian'),
            'nilai' => $this->input->post('nilai'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('nilai_instrumen_evaluasi', $data);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function tambah_aspek_penilaian()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/tambah_aspek_penilaian', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah_aspek_penilaian()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'id_kurikulum' => $id_kurikulum,
            'jenis_penilaian' => $this->input->post('jenis_penilaian'),
            'aspek_penilaian' => $this->input->post('aspek_penilaian'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );
        $query = $this->M_entitas->all_insert('instrumen_evaluasi', $data);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function ubah_nilai_instrumen_evaluasi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['nilai'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_nilai_instrumen_evaluasi' => $id))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['nilai']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_nilai_instrumen_evaluasi', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_nilai_instrumen_evaluasi()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'nilai' => $this->input->post('nilai'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_nilai_instrumen_evaluasi' => $this->input->post('id_nilai_instrumen_evaluasi'));
        $query = $this->M_entitas->all_update('nilai_instrumen_evaluasi', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function ubah_aspek_penilaian()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['aspek'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_instrumen_evaluasi' => $id))->row();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $data['aspek']->id_kurikulum))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/ubah_aspek_penilaian', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_aspek_penilaian()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $data = array(
            'aspek_penilaian' => $this->input->post('aspek_penilaian'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_instrumen_evaluasi' => $this->input->post('id_instrumen_evaluasi'));
        $query = $this->M_entitas->all_update('instrumen_evaluasi', $data, $where);

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function hapus_nilai_instrumen_evaluasi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $nilai = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_nilai_instrumen_evaluasi' => $id))->row();
        $id_kurikulum = $nilai->id_kurikulum;

        $this->M_entitas->delete_data('nilai_instrumen_evaluasi', array('id_nilai_instrumen_evaluasi' => $id));

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function hapus_aspek_penilaian()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $aspek = $this->M_entitas->selectX('instrumen_evaluasi', array('id_instrumen_evaluasi' => $id))->row();
        $id_kurikulum = $aspek->id_kurikulum;

        $this->M_entitas->delete_data('instrumen_evaluasi', array('id_instrumen_evaluasi' => $id));

        redirect('isi-subbab-kurikulum/'.bin2hex(base64_encode($id_kurikulum)).'/'.bin2hex(base64_encode(9)));
    }

    public function kirim_draft()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        if($kurikulum->status == 3 || $kurikulum->status == 5){ $is_kesesuaian_penilaian = 1; $status_list = 2; $status_kurikulum = 4; $keterangan_status = "Proses Pengecekan Kesesuaian"; }
        else if($kurikulum->status == 8){ $is_kesesuaian_penilaian = 2; $status_list = 9; $status_kurikulum = 7; $keterangan_status = "Proses Penilaian"; }

        $get_list_draft = $this->M_view->get_list_kurikulum_perbaikan($id_kurikulum)->result();

        if($get_list_draft)
        {
            $cek_draft = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum))->num_rows();

            $draft_ke = $cek_draft + 1;

            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'draft_ke' => $draft_ke,
                'is_kesesuaian_penilaian' => $is_kesesuaian_penilaian,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user'),
            );
            $query = $this->M_entitas->all_insert('draft_kurikulum', $data);

            $id_draft_kurikulum = $this->db->insert_id();
            
            foreach ($get_list_draft as $key) 
            {
                $data = array(
                    'status' => $status_list,
                    'id_draft_kurikulum' => $id_draft_kurikulum,
                    'draft_ke' => $draft_ke,
                    'waktu_terkirim' => date('Y-m-d H:i:s'),
                );
                $where = array('id_list_pengerjaan_kurikulum' => $key->id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
            }

            $data = array(
                'status' => $status_kurikulum,
                'keterangan_status' => $keterangan_status,
            );
            $where = array('id_kurikulum' => $id_kurikulum);
            $query = $this->M_entitas->all_update('kurikulum', $data, $where);
        }
        
        redirect('list-pengisian-kurikulum/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function pengecekan_kesesuaian()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['list'] = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum))->result();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $jumlah_draft = count($this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum))->result());
        $draft = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum))->result();
        $data['id_draft_kurikulum'] = $draft[$jumlah_draft-1]->id_draft_kurikulum;
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/pengecekan_kesesuaian', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_pengecekan_kesesuaian()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_draft_kurikulum = $this->input->post('id_draft_kurikulum');

        $list_pengerjaan_kurikulum = $this->M_view->get_pengecekan_kurikulum($id_kurikulum)->result();

        $tdk_sesuai = 0;
        foreach ($list_pengerjaan_kurikulum as $key) 
        {
            $data = array(
                'status' => $this->input->post('status'.$key->id_list_pengerjaan_kurikulum),
                'waktu_penilaian' => date('Y-m-d H:i:s'),
            );
            $where = array('id_list_pengerjaan_kurikulum' => $key->id_list_pengerjaan_kurikulum);
            $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);

            if($this->input->post('status'.$key->id_list_pengerjaan_kurikulum) == 3)
            {
                $tdk_sesuai += 1;
            }

            if($this->input->post('catatan'.$key->id_list_pengerjaan_kurikulum))
            {
                $data = array(
                    'id_list_pengerjaan_kurikulum' => $key->id_list_pengerjaan_kurikulum,
                    'id_kurikulum' => $id_kurikulum,
                    'is_pengecekan_penilaian' => 1,
                    'catatan' => $this->input->post('catatan'.$key->id_list_pengerjaan_kurikulum),
                    'status' => 1,
                    'created_by' => $this->session->userdata('id_user'),
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $query = $this->M_entitas->all_insert('catatan_pengecekan_penilaian', $data);
            }
        }

        $jumlah_tdk_sesuai = $tdk_sesuai;

        if($jumlah_tdk_sesuai > 0)
        {
            $kesesuaian = 0;
        }
        else
        {
            $kesesuaian = 1;
        }

        if($kesesuaian == 1)
        {
            $status = 6;
            $keterangan_status = "Proses Pemilihan Penilai";

            $data = array(
                'is_kesesuaian_penilaian' => 2,
            );
            $where = array('id_draft_kurikulum' => $id_draft_kurikulum);
            $query = $this->M_entitas->all_update('draft_kurikulum', $data, $where);
        }
        else
        {
            $status = 5;
            $keterangan_status = "Perbaikan Kesesuaian";
        }

        $data = array(
            'status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_draft_kurikulum' => $id_draft_kurikulum);
        $query = $this->M_entitas->all_update('draft_kurikulum', $data, $where);

        $data = array(
            'status' => $status,
            'keterangan_status' => $keterangan_status,
            'pengecekan_kesesuaian_at' => date('Y-m-d H:i:s'),
            'pengecekan_kesesuaian_by' => $this->session->userdata('id_user')
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

        if($kesesuaian == 1)
        {
            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Verifikasi Pengisian Kurikulum');
            $this->email->to($to_mail);
            $this->email->subject('Verifikasi Pengisian Kurikulum');
            $this->email->message('
                <h2>Pengisian Kurikulum Telah Di Verifikasi</h2>
                <p>Kurikulum Bapak/Ibu dengan  :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Telah diverifikasi, saat ini sedang dalam proses penilaian oleh Tim Penilai.<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=pilih-penilai');
        }
        else
        {
            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Revisi Kurikulum');
            $this->email->to($to_mail);
            $this->email->subject('Revisi Kurikulum');
            $this->email->message('
                <h2>Kurikulum Butuh Di Revisi</h2>
                <p>Kurikulum Bapak/Ibu dengan  :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Berdasarkan hasil review, bahwa Kurikulum Bapak/Ibu masih memerlikan perbaikan dengan beberapa catatan. Bapak/Ibu dapat melakukan perbaikan pada Aplikasi Nakula Sehat<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=perbaikan-kesesuaian');
        }
    }

    public function pemilihan_penilai()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['penilai'] = $this->M_entitas->selectX('penilai', array('is_penilaian != ' => 1))->result();
        $data['list'] = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum))->result();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/pemilihan_penilai', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_pemilihan_penilai()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $id_penilai = $this->input->post('id_penilai');
        $get_penilai = $this->M_entitas->selectX('penilai', array('id_penilai' => $id_penilai))->row();
        $nama_penilai = $get_penilai->nama_penilai;

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        if($get_kurikulum->is_ubah_penilai == 1)
        {
            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'id_penilai' => $get_kurikulum->id_penilai,
                'nama_penilai' => $get_kurikulum->nama_penilai,
                'ubah_penilai_at' => date('Y-m-d H:i:s'),
                'ubah_penilai_by' => $this->session->userdata('id_user'),
            );
            $query = $this->M_entitas->all_insert('riwayat_ubah_penilai', $data);

            $status_ubah_penilai = 2;
            $keterangan_status_ubah_penilai = "Proses pilih penilai selesai";

            $deadline = $get_kurikulum->deadline;
        }
        else
        {
            $status_ubah_penilai = $get_kurikulum->status_ubah_penilai;
            $keterangan_status_ubah_penilai = $get_kurikulum->keterangan_status_ubah_penilai;

            $hari_ini = date('Y-m-d');
            $deadline = date('Y-m-d', strtotime('+2 month', strtotime($hari_ini)));
        }

        $data = array(
            'id_penilai' => $id_penilai,
            'nama_penilai' => $nama_penilai,
            'status' => 7,
            'deadline' => $deadline,
            'keterangan_status' => 'Proses Penilaian',
            'pilih_penilai_at' => date('Y-m-d H:i:s'),
            'pilih_penilai_by' => $this->session->userdata('id_user'),
            'is_ubah_penilai' => NULL,
            'status_ubah_penilai' => $status_ubah_penilai,
            'keterangan_status_ubah_penilai' => $keterangan_status_ubah_penilai,
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $data = array(
            'is_penilaian' => 1,
        );
        $where = array('id_penilai' => $id_penilai);
        $query = $this->M_entitas->all_update('penilai', $data, $where);

        $to_mail = $get_penilai->email;

        $this->load->library('email');

        $from_email = "no-reply";
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
        $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from($from_email, 'Pemilihan Penilai Kurikulum');
        $this->email->to($to_mail);
        $this->email->subject('Pemilihan Penilai Kurikulum');
        $this->email->message('
            <h2>Penilaian Kurikulum</h2>
            <p>Bapak/Ibu terpilih untuk menilai dan membimbing Kurikulum dengan  :
            <br>  
            <p>
                Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                <br>
                Institusi                  : <strong>'.$get_kurikulum->nama_institusi.'</strong>
                <br>
            </p>
            <br><br>
            <p>Silahkan lakukan penilaian terhadap Kurikulum tersebut. Penilaian dapat dilakukan pada Aplikasi Nakula Sehat<br>
            </p>
            <p>
            Terima Kasih<br>
            Nakula Sehat Kementerian Kesehatan</p>
        ');
        $this->email->send();
        
        if($this->session->userdata('id_role') == 1){ redirect('kurikulum/?status=penyusunan-kurikulum'); }
        else if($this->session->userdata('id_role') == 6){ redirect('kurikulum/?status=pilih-penilai'); }
    }

    public function penilaian_penilai()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['list'] = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum))->result();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['last_draft'] = $this->M_entitas->order_by_where('draft_kurikulum', array('id_kurikulum' => $id_kurikulum), 'id_draft_kurikulum', 'DESC')->row();
        $data['draft'] = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum, 'is_kesesuaian_penilaian' => 2))->result();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/penilaian_penilai', $data);
        $this->load->view('shared/footer_akun');
    }

    public function get_detail_pj_substansi()
    {
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id')))->row();
        $data['sdm'] = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $data['kurikulum']->id_sdm_institusi))->row();

        $this->load->view('kurikulum/get_detail_pj_substansi', $data);
    }

    public function beri_penilaian_bab()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id))->row();
        $data['list'] = $list;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();

        if($list->id_bab_subbab == 1)
        {
            $data['bab_satu_pendahuluan'] = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $list->id_kurikulum))->row();

            $get_view = "penilaian_pendahuluan";
        }
        else if($list->id_bab_subbab == 3)
        {
            $data['diagram'] = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $list->id_kurikulum))->row();
            $get_view = "penilaian_diagram_alur_pelatihan";
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $this->input->post('id_list_pengerjaan_kurikulum')))->row();

        if($list->is_bab_subbab == 2)
        {
            if($list->id_bab_subbab == 3 || $list->id_bab_subbab == 5 || $list->id_bab_subbab == 7)
            {
                if($this->input->post('catatan') == "")
                {
                    $catatan = "Penilaian tersedia di masing-masing materi";
                }
                else
                {
                    $catatan = $this->input->post('catatan');
                }
            }
            else if($list->id_bab_subbab == 8)
            {
                if($this->input->post('catatan') == "")
                {
                    $catatan = "Penilaian tersedia di masing-masing sub";
                }
                else
                {
                    $catatan = $this->input->post('catatan');
                }
            }
            else
            {
                $catatan = $this->input->post('catatan');
            }
        }
        else
        {
            $catatan = $this->input->post('catatan');
        }

        if($this->input->post('keterangan') == '-')
        {
            $keterangan = NULL;
        }
        else
        {
            $keterangan = $this->input->post('keterangan');
        }

        $data = array(
            'id_list_pengerjaan_kurikulum' => $this->input->post('id_list_pengerjaan_kurikulum'),
            'id_kurikulum' => $id_kurikulum,
            'is_pengecekan_penilaian' => 2,
            'catatan' => $catatan,
            'keterangan' => $keterangan,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user'),            
        );
        $query = $this->M_entitas->all_insert('catatan_pengecekan_penilaian', $data);

        redirect('penilaian-penilai/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function ubah_penilaian_bab()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_catatan' => $id))->row();
        $data['catatan'] = $catatan;
        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $catatan->id_list_pengerjaan_kurikulum))->row();
        $data['list'] = $list;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();

        if($list->id_bab_subbab == 1)
        {
            $data['bab_satu_pendahuluan'] = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $list->id_kurikulum))->row();

            $get_view = "ubah_penilaian_pendahuluan";
        }
        else if($list->id_bab_subbab == 3)
        {
            $data['diagram'] = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $list->id_kurikulum))->row();
            $get_view = "ubah_penilaian_diagram_alur_pelatihan";
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function ajax_ubah_penilaian_kurikulum()
    {
        $id_catatan = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_catatan' => $id_catatan);
        $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
    }

    public function aksi_ubah_penilaian_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $id_list_pengerjaan_kurikulum = $this->input->post('id_list_pengerjaan_kurikulum');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_kurikulum' => $id_kurikulum, 'id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum, 'status' => 1))->row();

        if($cek)
        {
            if($this->input->post('keterangan') == '-')
            {
                $keterangan = NULL;
            }
            else
            {
                $keterangan = $this->input->post('keterangan');
            }

            $data = array(
                'catatan' => $this->input->post('catatan'),
                'keterangan' => $keterangan,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id_user'),            
            );
            $where = array('id_catatan' => $this->input->post('id_catatan'));
            $query = $this->M_entitas->all_update('catatan_pengecekan_penilaian', $data, $where);
        }
        else
        {
            $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum))->row();

            if($list->is_bab_subbab == 2)
            {
                if($list->id_bab_subbab == 3 || $list->id_bab_subbab == 5 || $list->id_bab_subbab == 7)
                {
                    if($this->input->post('catatan') == "")
                    {
                        $catatan = "Penilaian tersedia di masing-masing materi";
                    }
                    else
                    {
                        $catatan = $this->input->post('catatan');
                    }
                }
                else if($list->id_bab_subbab == 8)
                {
                    if($this->input->post('catatan') == "")
                    {
                        $catatan = "Penilaian tersedia di masing-masing sub";
                    }
                    else
                    {
                        $catatan = $this->input->post('catatan');
                    }
                }
                else
                {
                    $catatan = $this->input->post('catatan');
                }
            }
            else
            {
                $catatan = $this->input->post('catatan');
            }

            if($this->input->post('keterangan') == '-')
            {
                $keterangan = NULL;
            }
            else
            {
                $keterangan = $this->input->post('keterangan');
            }

            $data = array(
                'id_list_pengerjaan_kurikulum' => $id_list_pengerjaan_kurikulum,
                'id_kurikulum' => $id_kurikulum,
                'is_pengecekan_penilaian' => 2,
                'catatan' => $catatan,
                'keterangan' => $keterangan,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user'),            
            );
            $query = $this->M_entitas->all_insert('catatan_pengecekan_penilaian', $data);
        }

        redirect('penilaian-penilai/'.bin2hex(base64_encode($id_kurikulum)));
    }

    public function beri_penilaian_subbab()
    {
        $id_list = base64_decode(hex2bin($this->uri->segment(2)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list))->row();
        $data['list'] = $list;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();
        $id_sub_bab = $list->id_bab_subbab;
        $id = $list->id_kurikulum;

        if($id_sub_bab == 1)
        {
            $get_view = "penilaian_tujuan";
        }
        else if($id_sub_bab == 2)
        {
            $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
            $get_view = "penilaian_kompetensi";
        }
        else if($id_sub_bab == 3)
        {
            $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $get_view = "penilaian_struktur_kurikulum";
        }
        else if($id_sub_bab == 4)
        {
            $data['evaluasi_hasil_belajar'] = $this->M_entitas->selectX('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id))->result();
            $get_view = "penilaian_evaluasi_hasil_belajar";
        }
        else if($id_sub_bab == 5)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $get_view = "penilaian_rbpmp";
        }
        else if($id_sub_bab == 6)
        {
            $data['master_jadwal'] = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id))->result();
            $get_view = "penilaian_master_jadwal";
        }
        else if($id_sub_bab == 7)
        {
            $data['penugasan_materi'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'is_penugasan' => 1, 'id_metode != ' => 4), 'id_materi', 'ASC')->result();
            $data['penugasan_pl'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'id_metode' => 4), 'id_materi', 'ASC')->result();

            $get_view = "penilaian_panduan_penugasan";
        }
        else if($id_sub_bab == 8)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();
            $get_view = "penilaian_ketentuan_penyelenggaraan_pelatihan";
        }
        else if($id_sub_bab == 9)
        {
            $data['instrumen_evaluasi'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['evaluasi_peserta'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['evaluasi_fasilitator'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['evaluasi_penyelenggara'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $data['nilai_instrumen_evaluasi'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['nilai_evaluasi_peserta'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['nilai_evaluasi_fasilitator'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['nilai_evaluasi_penyelenggara'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $get_view = "penilaian_instrumen_evaluasi";
        }

        $data['id_sub_bab'] = $id_sub_bab;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function ubah_penilaian_subbab()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_catatan' => $id))->row();
        // print_r($catatan); die();
        $data['catatan'] = $catatan;
        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $catatan->id_list_pengerjaan_kurikulum))->row();
        $data['list'] = $list;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();
        $id_sub_bab = $list->id_bab_subbab;
        $id = $list->id_kurikulum;

        if($id_sub_bab == 1)
        {
            $get_view = "ubah_penilaian_tujuan";
        }
        else if($id_sub_bab == 2)
        {
            $data['kompetensi'] = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
            $get_view = "ubah_penilaian_kompetensi";
        }
        else if($id_sub_bab == 3)
        {
            $data['materi'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $get_view = "ubah_penilaian_struktur_kurikulum";
        }
        else if($id_sub_bab == 4)
        {
            $data['evaluasi_hasil_belajar'] = $this->M_entitas->selectX('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id))->result();
            $get_view = "ubah_penilaian_evaluasi_hasil_belajar";
        }
        else if($id_sub_bab == 5)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $get_view = "ubah_penilaian_rbpmp";
        }
        else if($id_sub_bab == 6)
        {
            $data['master_jadwal'] = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id))->result();
            $get_view = "ubah_penilaian_master_jadwal";
        }
        else if($id_sub_bab == 7)
        {
            $data['penugasan_materi'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'is_penugasan' => 1, 'id_metode != ' => 4), 'id_materi', 'ASC')->result();
            $data['penugasan_pl'] = $this->M_entitas->order_by_where('metode_materi', array('id_kurikulum' => $id, 'id_metode' => 4), 'id_materi', 'ASC')->result();
            $get_view = "ubah_penilaian_panduan_penugasan";
        }
        else if($id_sub_bab == 8)
        {
            $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result();
            $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
            $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
            $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
            $data['materi'] = $materi;
            $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();
            $get_view = "ubah_penilaian_ketentuan_penyelenggaraan_pelatihan";
        }
        else if($id_sub_bab == 9)
        {
            $data['instrumen_evaluasi'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['evaluasi_peserta'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['evaluasi_fasilitator'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['evaluasi_penyelenggara'] = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $data['nilai_instrumen_evaluasi'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id))->result();
            $data['nilai_evaluasi_peserta'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 1))->result();
            $data['nilai_evaluasi_fasilitator'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
            $data['nilai_evaluasi_penyelenggara'] = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();

            $get_view = "ubah_penilaian_instrumen_evaluasi";
        }

        $data['id_sub_bab'] = $id_sub_bab;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/'.$get_view);
        $this->load->view('shared/footer_akun');
    }

    public function penilaian_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $id))->row();
        $data['materi'] = $materi;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $materi->id_kurikulum))->row();
        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 3;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/penilaian_materi');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_materi()
    {
        $data = array(
            'catatan' => $this->input->post('catatan'),
            'status_penilaian' => 1,
            'waktu_nilai' => date('Y-m-d H:i:s'),
        );
        $where = array('id_materi' => $this->input->post('id_materi'));
        $query = $this->M_entitas->all_update('materi', $data, $where);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list, 'is_pengecekan_penilaian' => 2))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ajax_ubah_penilaian_materi()
    {
        $id_materi = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);
    }

    public function penilaian_materi_rbpmp()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $materi = $this->M_entitas->selectX('materi', array('id_materi' => $id))->row();
        $data['materi'] = $materi;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $materi->id_kurikulum))->row();
        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 5;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/penilaian_materi_rbpmp');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_materi_rbpmp()
    {
        $data = array(
            'catatan_rbpmp' => $this->input->post('catatan_rbpmp'),
            'status_penilaian_rbpmp' => 1,
            'waktu_nilai' => date('Y-m-d H:i:s'),
        );
        $where = array('id_materi' => $this->input->post('id_materi'));
        $query = $this->M_entitas->all_update('materi', $data, $where);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list, 'is_pengecekan_penilaian' => 2))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ajax_ubah_penilaian_materi_rbpmp()
    {
        $id_materi = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_materi' => $id_materi);
        $query = $this->M_entitas->all_update('materi', $data, $where);
    }

    public function penilaian_panduan_penugasan_metode_materi()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $metode_materi = $this->M_entitas->selectX('metode_materi', array('id_metode_materi' => $id))->row();
        $data['metode_materi'] = $metode_materi;
        $data['materi'] = $this->M_entitas->selectX('materi', array('id_materi' => $metode_materi->id_materi))->row();
        $data['indikator'] = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $metode_materi->id_materi))->result();
        $data['media'] = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $metode_materi->id_metode))->result();
        $data['media_tambahan'] = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $metode_materi->id_metode_materi))->result();
        $data['petunjuk'] = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $metode_materi->id_metode_materi))->result();
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $metode_materi->id_kurikulum))->row();

        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 7;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/penilaian_panduan_penugasan_metode_materi');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_panduan_penugasan_metode_materi()
    {
        $data = array(
            'catatan_penilaian' => $this->input->post('catatan_penilaian'),
            'status_penilaian' => 1,
        );
        $where = array('id_metode_materi' => $this->input->post('id_metode_materi'));
        $query = $this->M_entitas->all_update('metode_materi', $data, $where);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list, 'is_pengecekan_penilaian' => 2))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ajax_ubah_penilaian_panduan_penugasan_metode_materi()
    {
        $id_metode_materi = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_metode_materi' => $id_metode_materi);
        $query = $this->M_entitas->all_update('metode_materi', $data, $where);
    }

    public function penilaian_panduan_penugasan_praktik_lapang()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $data['metode_materi'] = $this->M_entitas->selectX('metode_materi', array('id_kurikulum' => $id, 'id_metode' => 4))->result();
        $data['petunjuk'] = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $id))->result();
        $data['kurikulum'] = $kurikulum;

        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 7;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/penilaian_panduan_penugasan_praktik_lapang');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_panduan_penugasan_praktik_lapang()
    {
        $data = array(
            'id_kurikulum' => $this->input->post('id_kurikulum'),
            'id_metode_materi' => json_encode($this->input->post('id_metode_materi')),
            'catatan' => $this->input->post('catatan'),
            'status' => 1,
            'waktu_nilai' => date('Y-m-d H:i:s'),
        );
        $query = $this->M_entitas->all_insert('catatan_praktik_lapang', $data);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list, 'is_pengecekan_penilaian' => 2))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ubah_penilaian_panduan_penugasan_praktik_lapang()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $catatan = $this->M_entitas->selectX('catatan_praktik_lapang', array('id_catatan_praktik_lapang' => $id))->row();
        $data['catatan'] = $catatan;
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $catatan->id_kurikulum))->row();
        $data['metode_materi'] = $this->M_entitas->selectX('metode_materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'id_metode' => 4))->result();
        $data['petunjuk'] = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
        $data['kurikulum'] = $kurikulum;

        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 7;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/ubah_penilaian_panduan_penugasan_praktik_lapang');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_penilaian_panduan_penugasan_praktik_lapang()
    {
        $data = array(
            'catatan' => $this->input->post('catatan'),
            'waktu_nilai' => date('Y-m-d H:i:s'),
        );
        $where = array('id_catatan_praktik_lapang' => $this->input->post('id_catatan_praktik_lapang'));
        $query = $this->M_entitas->all_update('catatan_praktik_lapang', $data, $where);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ajax_ubah_penilaian_panduan_penugasan_praktik_lapang()
    {
        $id_catatan = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_catatan_praktik_lapang' => $id_catatan);
        $query = $this->M_entitas->all_update('catatan_praktik_lapang', $data, $where);
    }

    public function penilaian_ketentuan_penyelenggara_pelatihan_item()
    {
        $jenis = base64_decode(hex2bin($this->uri->segment(2)));
        $id_list = base64_decode(hex2bin($this->uri->segment(3)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id_list))->row();
        $data['list'] = $list;
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;
        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
        $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
        $data['materi'] = $materi;
        $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 1))->result();
        $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 2))->result();
        $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 3))->result();

        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 8;
        $data['jenis'] = $jenis;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/penilaian_ketentuan_penyelenggara_pelatihan_item');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_penilaian_ketentuan_penyelenggara_pelatihan_item()
    {
        $data = array(
            'id_kurikulum' => $this->input->post('id_kurikulum'),
            'jenis' => $this->input->post('jenis'),
            'catatan' => $this->input->post('catatan'),
            'status' => 1,
        );
        $query = $this->M_entitas->all_insert('catatan_ketentuan_penyelenggara_pelatihan', $data);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list, 'is_pengecekan_penilaian' => 2))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ubah_penilaian_ketentuan_penyelenggara_pelatihan_item()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_catatan_ketentuan_penyelenggara_pelatihan' => $id))->row();
        $data['catatan'] = $catatan;
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $catatan->id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;
        $data['peserta'] = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
        $data['materi_dasar'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 1))->result();
        $data['materi_inti'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 2))->result();
        $data['materi_penunjang'] = $this->M_entitas->selectX('materi', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis_materi' => 3))->result();

        $data['id_list'] = base64_decode(hex2bin($this->uri->segment(3)));
        $data['id_sub_bab'] = 8;
        $data['jenis'] = $catatan->jenis;

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/ubah_penilaian_ketentuan_penyelenggara_pelatihan_item');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah_penilaian_ketentuan_penyelenggara_pelatihan_item()
    {
        $data = array(
            'catatan' => $this->input->post('catatan'),
            'status' => 1,
        );
        $where = array('id_catatan_ketentuan_penyelenggara_pelatihan' => $this->input->post('id_catatan_ketentuan_penyelenggara_pelatihan'));
        $query = $this->M_entitas->all_update('catatan_ketentuan_penyelenggara_pelatihan', $data, $where);

        $id_list = $this->input->post('id_list');

        $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list))->row();
        if($cek)
        {
            redirect('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan)));
        }
        else
        {
            redirect('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list)));
        }
    }

    public function ajax_ubah_penilaian_ketentuan_penyelenggara_pelatihan_item()
    {
        $id_catatan = $this->input->post('id');
        $nama = $this->input->post('parameter');
        $catatan = $this->input->post('isi');

        $data = array(
            $nama => $catatan
        );
        $where = array('id_catatan_ketentuan_penyelenggara_pelatihan' => $id_catatan);
        $query = $this->M_entitas->all_update('catatan_ketentuan_penyelenggara_pelatihan', $data, $where);
    }

    public function lihat_penilaian_ketentuan_penyelenggara_pelatihan()
    {
        $id_kurikulum = base64_decode(hex2bin($this->input->post('id_kurikukum')));
        $jenis = base64_decode(hex2bin($this->input->post('jenis')));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        $data['catatan'] = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('jenis' => $jenis))->row();

        $this->load->view('kurikulum/lihat_penilaian_ketentuan_penyelenggara_pelatihan', $data);
    }

    public function list_penilaian()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $id))->row();
        $data['list'] = $list;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $list->id_kurikulum))->row();
        $data['catatan'] = $this->M_entitas->order_by_where('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id), 'id_catatan', 'DESC')->result();
        if($list->is_bab_subbab == 1)
        {
            $data['bab_subbab'] = $this->M_entitas->selectX('bab', array('id_bab' => $list->id_bab_subbab))->row();
        }
        else
        {
            $data['bab_subbab'] = $this->M_entitas->selectX('sub_bab', array('id_sub_bab' => $list->id_bab_subbab))->row();
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/list_penilaian');
        $this->load->view('shared/footer_akun');
    }

    public function lihat_penilaian()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_catatan' => $id))->row();
        $list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $catatan->id_list_pengerjaan_kurikulum))->row();
        $data['list'] = $list;
        $data['catatan'] = $catatan;
        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $catatan->id_kurikulum))->row();

        if($list->is_bab_subbab == 1)
        {
            $data['bab_subbab'] = $this->M_entitas->selectX('bab', array('id_bab' => $list->id_bab_subbab))->row();
            $data['is_bab_subbab'] = 1;
        }
        else if($list->is_bab_subbab == 2)
        {
            $data['bab_subbab'] = $this->M_entitas->selectX('sub_bab', array('id_sub_bab' => $list->id_bab_subbab))->row();
            $data['is_bab_subbab'] = 2;
        }

        $this->load->view('shared/header_akun', $data);
        $this->load->view('kurikulum/lihat_penilaian');
        $this->load->view('shared/footer_akun');
    }

    public function kirim_penilaian_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));
        $id_draft_kurikulum = base64_decode(hex2bin($this->uri->segment(3)));

        $list_pengerjaan_kurikulum = $this->M_view->get_list_pengerjaan_kurikulum_penilaian($id_kurikulum)->result();

        if($list_pengerjaan_kurikulum)
        {
            foreach ($list_pengerjaan_kurikulum as $list) 
            {
                $cek_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum, 'status' => 1))->result();

                if($cek_catatan)
                {
                    $data = array(
                        'status' => 6,
                        'waktu_penilaian' => date('Y-m-d H:i:s'),
                    );
                    $where = array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum);
                    $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
                }
            }
        }

        $list_pengerjaan_kurikulum = $this->M_view->get_list_pengerjaan_kurikulum_penilaian($id_kurikulum)->result();

        foreach ($list_pengerjaan_kurikulum as $list) 
        {
            $data = array(
                'status' => 7,
                'waktu_penilaian' => date('Y-m-d H:i:s'),
            );
            $where = array('id_list_pengerjaan_kurikulum' => $list->id_list_pengerjaan_kurikulum);
            $query = $this->M_entitas->all_update('list_pengerjaan_kurikulum', $data, $where);
        }

        $data = array(
            'is_kesesuaian_penilaian' => 2,
            'status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user'),
        );
        $where = array('id_draft_kurikulum' => $id_draft_kurikulum);
        $query = $this->M_entitas->all_update('draft_kurikulum', $data, $where);

        $data = array(
            'status' => 8,
            'keterangan_status' => 'Proses Perbaikan Kurikulum',
            'penilaian_at' => date('Y-m-d H:i:s'),
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

        $to_mail = $get_sdm->email;

        $this->load->library('email');

        $from_email = "no-reply";
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
        $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from($from_email, 'Penyusunan Kurikulum Butuh Perbaikan');
        $this->email->to($to_mail);
        $this->email->subject('Penyusunan Kurikulum Butuh Perbaikan');
        $this->email->message('
            <h2>Perbaikan Kurikulum</h2>
            <p>Kurikulum Bapak/Ibu  :
            <br>  
            <p>
                Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                <br>
            </p>
            <br><br>
            <p>Berdasarkan review oleh Penilai, Kurikulum Bapak/Ibu membutuhkan perbaikan dengan catatan yang telah diberikan. Perbaikan dapat dilakukan pada Aplikasi Nakula Sehat<br>
            </p>
            <p>
            Terima Kasih<br>
            Nakula Sehat Kementerian Kesehatan</p>
        ');
        $this->email->send();
        
        redirect('kurikulum/?status=perbaikan-kurikulum');
    }

    public function preview_kurikulum()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $institusi = $kurikulum->nama_institusi;
        $judul = $kurikulum->judul;
        $judul_portal = $kurikulum->judul_portal;
        $get_pendahuluan = $this->M_entitas->selectX('bab_satu_pendahuluan', array('id_kurikulum' => $id))->row();
        $bab_satu_pendahuluan = $get_pendahuluan->pendahuluan;
        $get_kompetensi = $this->M_entitas->selectX('isi_kompetensi', array('id_kurikulum' => $id))->result();
        $get_materi_dasar = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 1))->result();
        $get_materi_inti = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 2))->result();
        $get_materi_penunjang = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id, 'jenis_materi' => 3))->result();
        $evaluasi_hasil_belajar = $kurikulum->evaluasi_hasil_belajar;
        $isi_evaluasi_hasil_belajar = $this->M_entitas->selectX('isi_evaluasi_hasil_belajar', array('id_kurikulum' => $id))->result();
        $diagram = $this->M_entitas->selectX('diagram_alur_proses_pelatihan', array('id_kurikulum' => $id))->row();
        $materi = $this->M_entitas->selectX('materi', array('id_kurikulum' => $id))->result(); 
        $master_jadwal = $this->M_entitas->selectX('master_jadwal', array('id_kurikulum' => $id))->result();
        $metode_materi = $this->M_view->get_materi_metode($id)->result();
        $metode_praktik_lapang = $this->M_view->get_all_materi_pl($id)->result();
        $peserta = $this->M_entitas->selectX('isi_peserta', array('id_kurikulum' => $id))->result();
        $evaluasi_fasilitator = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
        $evaluasi_penyelenggara = $this->M_entitas->selectX('instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();
        $nilai_evaluasi_fasilitator = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 2))->result();
        $nilai_evaluasi_penyelenggara = $this->M_entitas->selectX('nilai_instrumen_evaluasi', array('id_kurikulum' => $id, 'jenis_penilaian' => 3))->result();
        $kata_pengantar = $this->M_entitas->selectX('kata_pengantar', array('id_kurikulum' => $id))->row();
        $tgl = date('YmdHis');

        $data['kurikulum'] = $kurikulum;
        $data['judul'] = $judul;
        $data['bab_satu_pendahuluan'] = $bab_satu_pendahuluan;
        $data['tujuan'] = $kurikulum->tujuan;
        $data['kompetensi'] = $kurikulum->kompetensi;
        $data['isi_kompetensi'] = $get_kompetensi;
        $data['materi_dasar'] = $get_materi_dasar;
        $data['materi_inti'] = $get_materi_inti;
        $data['materi_penunjang'] = $get_materi_penunjang;
        $data['evaluasi_hasil_belajar'] = $evaluasi_hasil_belajar;
        $data['isi_evaluasi_hasil_belajar'] = $isi_evaluasi_hasil_belajar;
        $data['diagram'] = $diagram;
        $data['materi'] = $materi;
        $data['master_jadwal'] = $master_jadwal;
        $data['metode_materi'] = $metode_materi;
        $data['metode_praktik_lapang'] = $metode_praktik_lapang;
        $data['peserta'] = $peserta;
        $data['evaluasi_fasilitator'] = $evaluasi_fasilitator;
        $data['evaluasi_penyelenggara'] = $evaluasi_penyelenggara;
        $data['nilai_evaluasi_fasilitator'] = $nilai_evaluasi_fasilitator;
        $data['nilai_evaluasi_penyelenggara'] = $nilai_evaluasi_penyelenggara;
        $data['kata_pengantar'] = $kata_pengantar;
        $data['cover'] = $kurikulum->cover;

        $this->load->library('MYPDF');

        // $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nakula-Sehat 2.0');
        $pdf->SetTitle($judul);
        $pdf->SetSubject($institusi);
        $pdf->SetKeywords('Kurikulum');

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255)); 

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
        
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $pdf->SetFont('dejavusans', '', 9);

        if($kurikulum->cover)
        {
            // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(0, 0, 0, true);

            // add a page
            $pdf->AddPage('P','A4');
            $pdf->SetAutoPageBreak(false, 0);
            $img_file = FCPATH.'agenda/perdata/cover/'.$kurikulum->cover;
            $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->setPageMark();

            // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(20, 20, 20, true);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // add a page
            // $pdf->AddPage('P','A4');
            // $pdf->SetAutoPageBreak(true, 15);
            // $html = $this->load->view('kurikulum/preview_daftar_isi',$data,TRUE);
            // $pdf->writeHTML($html, true, false, true, false, '');

            $pdf->AddPage('P','A4');
            $pdf->SetAutoPageBreak(true, 15);
            $html_ = $this->load->view('kurikulum/preview_kurikulum',$data,TRUE);
            $pdf->writeHTML($html_, true, false, true, false, '');

            
        }
        else
        {
            // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(20, 20, 20, true);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // add a page
            $pdf->AddPage('P','A4');

            $html = $this->load->view('kurikulum/preview_kurikulum',$data,TRUE);

            $pdf->writeHTML($html, true, false, true, false, '');
        }
        
        // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(20, 20, 20, true);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->AddPage('L','A4');
        $html2 = $this->load->view('kurikulum/preview_rbpmp',$data,TRUE);
        $pdf->writeHTML($html2, true, false, true, false, '');

        $pdf->AddPage('L','A4');
        $html3 = $this->load->view('kurikulum/preview_master_jadwal',$data,TRUE);
        $pdf->writeHTML($html3, true, false, true, false, '');

        $pdf->AddPage('P','A4');
        $html4 = $this->load->view('kurikulum/preview_panduan_penugasan',$data,TRUE);
        $pdf->writeHTML($html4, true, false, true, false, '');

        $pdf->AddPage('P','A4');
        $html4 = $this->load->view('kurikulum/preview_ketentuan_penyelenggaraan_pelatihan',$data,TRUE);
        $pdf->writeHTML($html4, true, false, true, false, '');

        // $pdf->AddPage('P','A4');
        // $html4 = $this->load->view('kurikulum/preview_instrumen_evaluasi',$data,TRUE);

        // $pdf->writeHTML($html4, true, false, true, false, '');
        
        $pdf->lastPage();

        ob_end_clean();
        $pdf->Output($judul_portal."-".$tgl.'.pdf', 'I');
    }

    public function selesaikan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        $get_list_draft = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $id_kurikulum, 'status != ' => 7))->result();     

        if($get_list_draft)
        {
            foreach ($get_list_draft as $key) 
            {
                $data = array(
                    'status' => 7,
                );
                $where = array('id_list_pengerjaan_kurikulum' => $key->id_list_pengerjaan_kurikulum);
                $query = $this->M_entitas->all_insert('list_pengerjaan_kurikulum', $data, $where);
            }
        }

        $get_draft = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum, 'status' => 1))->result();

        if($get_draft)
        {
            foreach ($get_draft as $key) 
            {
                $data = array(
                    'status' => 2,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->session->userdata('id_user'),
                );
                $where = array('id_draft_kurikulum' => $key->id_draft_kurikulum);
                $query = $this->M_entitas->all_update('draft_kurikulum', $data, $where);
            }
        }

        $get_catatan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_kurikulum' => $id_kurikulum, 'status' => 1))->result();

        if($get_catatan)
        {
            foreach ($get_catatan as $key)
            {
                $data = array(
                    'status' => 2,
                );
                $where = array('id_catatan' => $key->id_catatan);
                $query = $this->M_entitas->all_insert('catatan_pengecekan_penilaian', $data, $where);
            }
        }

        $data = array(
            'is_penilaian' => 0
        );
        $where = array('id_penilai' => $kurikulum->id_penilai);
        $query = $this->M_entitas->all_update('penilai', $data, $where);

        $data = array(
            'status' => 9,
            'keterangan_status' => 'Upload Cover dan Kata Pengantar',
            'tgl_verifikasi_penilai' => date('Y-m-d H:i:s'),
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $kurikulum->id_sdm_institusi))->row();

        $to_mail = $get_sdm->email;

        $this->load->library('email');

        $from_email = "no-reply";
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
        $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from($from_email, 'Verifikasi Kurikulum Oleh Penilai');
        $this->email->to($to_mail);
        $this->email->subject('Verifikasi Kurikulum Oleh Penilai');
        $this->email->message('
            <h2>Verifikasi Kurikulum</h2>
            <p>Kurikulum Bapak/Ibu  :
            <br>  
            <p>
                Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                <br>
            </p>
            <br><br>
            <p>Penyusunan Kurikulum Bapak/Ibu <b>Telah Disetujui</b> oleh Penilai. Silahkan Upload Cover dan Kata Pengantar untuk dapat disahkan.<br>
            </p>
            <p>
            Terima Kasih<br>
            Nakula Sehat Kementerian Kesehatan</p>
        ');
        $this->email->send();
        
        if($this->session->userdata('id_role') == 3){ redirect('kurikulum/?status=selesai'); }
        else if($this->session->userdata('id_role') == 1){ redirect('kurikulum/?status=penyusunan-kurikulum'); }
    }

    public function upload_cover_kata_pengantar()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kata_pengantar'] = $this->M_entitas->selectX('kata_pengantar', array('id_kurikulum' => $id_kurikulum))->row();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();

        $data['tim_penyusun'] = $this->M_entitas->selectX('tim_penyusun', array('id_kurikulum' => $id_kurikulum))->result();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/upload_cover_kata_pengantar', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_upload_cover_kata_pengantar()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $cek_kata_pengantar = $this->M_entitas->selectX('kata_pengantar', array('id_kurikulum' => $id_kurikulum))->row();
        if($cek_kata_pengantar)
        {
            $data = array(
                'kata_pengantar' => $this->input->post('kata_pengantar'),
                'kota' => $this->input->post('kota'),
                'tgl_kata_pengantar' => $this->input->post('tgl_kata_pengantar'),
                'jabatan_ttd' => $this->input->post('jabatan_ttd'),
                'nama_ttd' => $this->input->post('nama_ttd'),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id_user'),
            );
            $where = array('id_kurikulum' => $id_kurikulum);
            $query = $this->M_entitas->all_update('kata_pengantar', $data, $where);
        }
        else
        {
            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'kata_pengantar' => $this->input->post('kata_pengantar'),
                'kota' => $this->input->post('kota'),
                'tgl_kata_pengantar' => $this->input->post('tgl_kata_pengantar'),
                'jabatan_ttd' => $this->input->post('jabatan_ttd'),
                'nama_ttd' => $this->input->post('nama_ttd'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user'),
            );
            $query = $this->M_entitas->all_insert('kata_pengantar', $data);
        }

        $judul_portal = $this->input->post('judul_portal');

        if(isset($_FILES['cover']['name']))
        {
            $config['upload_path']   = './agenda/perdata/cover/';
            $config['file_name']     = $judul_portal."_".date('YmdHis'); 
            $config['overwrite']     = true;
            $config['allowed_types']     = '*';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('cover')){
                $cover = $this->input->post('cover_old');
            }else{
                $cover = $this->upload->data()['file_name'];
                $cover_old = './agenda/perdata/cover/'.$this->input->post('cover_old');
                if(file_exists($cover_old)) { unlink($cover_old); }
            }
        }
        else
        {
            $cover = $this->input->post('cover_old');
        }

        $data = array(
            'cover' => $cover,
            'status' => 10,
            'keterangan_status' => 'Pengesahan Kurikulum',
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        if(count($this->input->post('nama_penyusun')) > 0)
        {
            $this->M_entitas->delete_data('tim_penyusun', array('id_kurikulum' => $id_kurikulum));

            foreach ($this->input->post('nama_penyusun') as $key) 
            {
                $data = array(
                    'id_kurikulum' => $id_kurikulum,
                    'nama_penyusun' => $key,
                );
                $query = $this->M_entitas->all_insert('tim_penyusun', $data);
            }
        }
        
        redirect('kurikulum/?status=pengesahan-kurikulum');
    }

    public function pengesahan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['jenis'] = $this->M_entitas->selectSemua('master__jenis_pelatihan')->result();
        $data['kategori'] = $this->M_entitas->selectSemua('master__kategori_pelatihan')->result();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/pengesahan_kurikulum', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_pengesahan_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');

        $judul_portal = $this->input->post('judul_portal');

        if(isset($_FILES['surat_keterangan_menilai']['name']))
        {
            $config['upload_path']   = './agenda/perdata/surat_keterangan_menilai/';
            $config['file_name']     = $judul_portal."_".date('YmdHis'); 
            $config['overwrite']     = true;
            $config['allowed_types']     = '*';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('surat_keterangan_menilai')){
                $surat_keterangan_menilai = $this->input->post('surat_keterangan_menilai_old');
            }else{
                $surat_keterangan_menilai = $this->upload->data()['file_name'];
                $surat_keterangan_menilai_old = './agenda/perdata/surat_keterangan_menilai/'.$this->input->post('surat_keterangan_menilai_old');
                if(file_exists($surat_keterangan_menilai_old)) { unlink($surat_keterangan_menilai_old); }
            }
        }
        else
        {
            $surat_keterangan_menilai = $this->input->post('surat_keterangan_menilai_old');
        }

        $kategori_pelatihan_id = $this->input->post('kategori_pelatihan_id');
        $get_kategori = $this->M_entitas->selectX('master__kategori_pelatihan', array('kategori_pelatihan_id' => $kategori_pelatihan_id))->row();
        $kategori_pelatihan_name = $get_kategori->kategori_pelatihan_name;

        $jenis_pelatihan_id = $this->input->post('jenis_pelatihan_id');
        $get_jenis = $this->M_entitas->selectX('master__jenis_pelatihan', array('jenis_pelatihan_id' => $jenis_pelatihan_id))->row();
        $jenis_pelatihan_name = $get_jenis->jenis_pelatihan_name;

        $data = array(
            'kategori_pelatihan_id' => $kategori_pelatihan_id,
            'kategori_pelatihan_name' => $kategori_pelatihan_name,
            'jenis_pelatihan_id' => $jenis_pelatihan_id,
            'jenis_pelatihan_name' => $jenis_pelatihan_name,
            'nilai_skp' => $this->input->post('nilai_skp'),
            'surat_keterangan_menilai' => $surat_keterangan_menilai,
            'tgl_pengesahan' => $this->input->post('tgl_pengesahan'),
            'tempat_pengesahan' => $this->input->post('tempat_pengesahan'),
            'pengesahan_oleh' => $this->session->userdata('id_user'),
            'status' => 11,
            'keterangan_status' => 'Selesai',
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

        $to_mail = $get_sdm->email;

        $this->load->library('email');

        $from_email = "no-reply";
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
        $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from($from_email, 'Pengesahan Kurikulum');
        $this->email->to($to_mail);
        $this->email->subject('Pengesahan Kurikulum');
        $this->email->message('
            <h2>Kurikulum Telah Disahkan</h2>
            <p>Kurikulum Bapak/Ibu  :
            <br>  
            <p>
                Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                <br>
            </p>
            <br><br>
            <p>Penyusunan Kurikulum Bapak/Ibu <b>Telah Disahkan</b> oleh DITMUTU.<br>
            </p>
            <p>
            Terima Kasih<br>
            Nakula Sehat Kementerian Kesehatan</p>
        ');
        $this->email->send();
        
        redirect('kurikulum/?status=selesai');
    }

    public function surat_pengesahan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['kurikulum'] = $kurikulum;
        $jumlah_kurikulum = $this->M_entitas->selectX('kurikulum', array('status >= ' => 11))->num_rows();
        $data['jumlah_kurikulum'] = $jumlah_kurikulum;
        $data['master_pengesah'] = $this->M_entitas->selectSemua('master_pengesah')->row();

        $this->load->view('kurikulum/surat_pengesahan_kurikulum',$data);
    }

    public function detail_kurikulum_selesai()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $data['draft'] = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum))->result();
        $data['catatan'] = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_kurikulum' => $id_kurikulum))->result();
        $data['bab'] = $this->M_entitas->selectX('bab', array('status' => 1))->result();
        $data['riwayat_hentikan'] = $this->M_entitas->selectX('riwayat_hentikan', array('id_kurikulum' => $id_kurikulum))->result();
        $data['riwayat_ubah_penilai'] = $this->M_entitas->selectX('riwayat_ubah_penilai', array('id_kurikulum' => $id_kurikulum))->result();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/detail_kurikulum_selesai', $data);
        $this->load->view('shared/footer_akun');
    }

    public function kirim_kurikulum_siakpel()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data = array(
            'status' => 12,
            'keterangan_status' => 'Kurikulum Telah Dikirim ke Siakpel',
            'kirim_siakpel_at' => date('Y-m-d H:i:s'),
            'kirim_siakpel_by' => $this->session->userdata('id_user'),
        );
        $where = array('id_kurikulum' => $id);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

        $to_mail = $get_sdm->email;

        $this->load->library('email');

        $from_email = "no-reply";
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
        $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->from($from_email, 'Pengiriman Kurikulum Ke SIAKPEL');
        $this->email->to($to_mail);
        $this->email->subject('Pengiriman Kurikulum Ke SIAKPEL');
        $this->email->message('
            <h2>Kurikulum Telah Dikirimkan Ke SIAKPEL</h2>
            <p>Kurikulum Bapak/Ibu  :
            <br>  
            <p>
                Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                <br>
            </p>
            <br><br>
            <p>Kurikulum Bapak/Ibu <b>Telah Dikirim Ke SIAKPEL</b> oleh DITMUTU.<br>
            </p>
            <p>
            Terima Kasih<br>
            Nakula Sehat Kementerian Kesehatan</p>
        ');
        $this->email->send();

        redirect('kurikulum/?status=kirim-siakpel');
    }

    public function konfirmasi_kelanjutan_penyusunan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/konfirmasi_kelanjutan_penyusunan_kurikulum', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_konfirmasi_kelanjutan_penyusunan_kurikulum()
    {
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $this->input->post('id_kurikulum')))->row();

        $status_dihentikan = $this->input->post('status_dihentikan');
        if($status_dihentikan == 4)
        {
            $keterangan_status_dihentikan = "Permohonan Kelanjutan Penyusunan Kurikulum";
            $waktu_dihentikan = $this->input->post('waktu_dihentikan');
            $dihentikan_oleh = $this->input->post('dihentikan_oleh');
        }
        else if($status_dihentikan == 7)
        {
            $keterangan_status_dihentikan = "Penyusunan Kurikulum Dihentikan";
            $waktu_dihentikan = date('Y-m-d H:i:s');
            $dihentikan_oleh = $this->session->userdata('id_user');

            if($kurikulum->status_sebelumnya >= 7)
            {
                $data = array(
                    'is_penilaian' => 0
                );
                $where = array('id_penilai' => $kurikulum->id_penilai);
                $query = $this->M_entitas->all_update('penilai', $data, $where);
            }
        }

        $data = array(
            'status_dihentikan' => $status_dihentikan,
            'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
            'waktu_dihentikan' => $waktu_dihentikan,
            'dihentikan_oleh' => $dihentikan_oleh,
        );
        $where = array('id_kurikulum' => $this->input->post('id_kurikulum'));
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $data_riwayat = array(
            'ajukan_by' => $this->session->userdata('id_user'),
            'ajukan_at' => date('Y-m-d H:i:s'),
            'status' => 2,
        );
        $where = array('id_kurikulum' => $this->input->post('id_kurikulum'), 'status' => 1);
        $query = $this->M_entitas->all_update('riwayat_hentikan', $data_riwayat);

        redirect('kurikulum/?status=dihentikan');
    }

    public function verifikasi_permohonan_kelanjutan_penyusunan_kurikulum()
    {
        $id_kurikulum = base64_decode(hex2bin($this->uri->segment(2)));

        $data['kurikulum'] = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        
        $this->load->view('shared/header_akun');
        $this->load->view('kurikulum/verifikasi_permohonan_kelanjutan_penyusunan_kurikulum', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_verifikasi_permohonan_kelanjutan_penyusunan_kurikulum()
    {
        $id_kurikulum = $this->input->post('id_kurikulum');
        $kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();

        $tambahan_waktu = $this->input->post('tambahan_waktu');

        $status_dihentikan = $this->input->post('status_dihentikan');
        if($status_dihentikan == 5)
        {
            $keterangan_status_dihentikan = "Permohonan Kelanjutan Penyusunan Kurikulum Diterima";
            $waktu_dihentikan = $kurikulum->waktu_dihentikan;
            $dihentikan_oleh = $kurikulum->dihentikan_oleh;
            $status = $kurikulum->status_sebelumnya;
            $keterangan_status = $kurikulum->keterangan_status_sebelumnya;

            $total_tambah_waktu = $tambahan_waktu * 7;

            if($kurikulum->alasan_hentikan_sistem == 1)
            {
                $deadline = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($kurikulum->deadline)));
            }
            else if($kurikulum->alasan_hentikan_sistem == 2)
            {
                $deadline = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($kurikulum->deadline)));
            }
            else if($kurikulum->alasan_hentikan_sistem == 3)
            {
                $get_draft = $this->M_entitas->selectX('draft_kurikulum', array('id_kurikulum' => $id_kurikulum, 'dihentikan' => 1))->row();
                $updated_at = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($get_draft->updated_at)));

                $data = array(
                    'updated_at' => $updated_at,
                    'dihentikan' => NULL,
                );
                $where = array('id_draft_kurikulum' => $get_draft->id_draft_kurikulum);
                $query = $this->M_entitas->all_update('draft_kurikulum', $data, $where);

                $deadline = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($kurikulum->deadline)));
            }

            $data_riwayat = array(
                'aktifkan_by' => $this->session->userdata('id_user'),
                'aktifkan_at' => date('Y-m-d H:i:s'),
                'status' => 3,
            );
            $where = array('id_kurikulum' => $id_kurikulum, 'status' => 2);
            $query = $this->M_entitas->all_update('riwayat_hentikan', $data_riwayat, $where);
        }
        else if($status_dihentikan == 7)
        {
            $keterangan_status_dihentikan = "Penyusunan Kurikulum Dihentikan";
            $waktu_dihentikan = date('Y-m-d H:i:s');
            $dihentikan_oleh = $this->session->userdata('id_user');
            $status = $kurikulum->status_sebelumnya;
            $keterangan_status = $kurikulum->keterangan_status;
            $deadline = $kurikulum->deadline;

            if($kurikulum->status_sebelumnya >= 7)
            {
                $data = array(
                    'is_penilaian' => 0
                );
                $where = array('id_penilai' => $kurikulum->id_penilai);
                $query = $this->M_entitas->all_update('penilai', $data, $where);
            }

            $data_riwayat = array(
                'hentikan_by' => $this->session->userdata('id_user'),
                'hentikan_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            );
            $where = array('id_kurikulum' => $id_kurikulum, 'status' => 2);
            $query = $this->M_entitas->all_update('riwayat_hentikan', $data_riwayat, $where);
        }

        $data = array(
            'status_dihentikan' => $status_dihentikan,
            'keterangan_status_dihentikan' => $keterangan_status_dihentikan,
            'waktu_dihentikan' => $waktu_dihentikan,
            'dihentikan_oleh' => $dihentikan_oleh,
            'status' => $status,
            'keterangan_status' => $keterangan_status,
            'tambahan_waktu' => $tambahan_waktu,
            'deadline' => $deadline,
        );
        $where = array('id_kurikulum' => $id_kurikulum);
        $query = $this->M_entitas->all_update('kurikulum', $data, $where);

        $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $id_kurikulum))->row();
        $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_sdm_institusi' => $get_kurikulum->id_sdm_institusi))->row();

        if($status_dihentikan == 5)
        {
            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Pengajuan Kelanjutan Penyusunan Kurikulum');
            $this->email->to($to_mail);
            $this->email->subject('Pengajuan Kelanjutan Penyusunan Kurikulum');
            $this->email->message('
                <h2>Pengajuan Kelanjutan Penyusunan Kurikulum</h2>
                <p>Pengajuan kelanjutan penyusunan Kurikulum Bapak/Ibu dengan :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Berdasarkan hasil review oleh DITMUTU, pengajuan kelanjutan penyusunan Kurikulum Bapak/Ibu <b>Telah Disetujui</b> Silahkan lanjutkan penyusunan Kurikulum pada Aplikasi Nakula Sehat.<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=penyusunan-kurikulum');
        }
        else if($status_dihentikan == 6)
        {
            $to_mail = $get_sdm->email;

            $this->load->library('email');

            $from_email = "no-reply";
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'ekurikulumkemenkes@gmail.com';
            $config['smtp_pass']    = 'sbujyzcvwpxnkoac';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from($from_email, 'Pengajuan Kelanjutan Penyusunan Kurikulum');
            $this->email->to($to_mail);
            $this->email->subject('Pengajuan Kelanjutan Penyusunan Kurikulum');
            $this->email->message('
                <h2>Pengajuan Kelanjutan Penyusunan Kurikulum</h2>
                <p>Pengajuan kelanjutan penyusunan Kurikulum Bapak/Ibu dengan :
                <br>  
                <p>
                    Judul Kurikulum            : <strong>'.$get_kurikulum->judul.'</strong>
                    <br>
                </p>
                <br><br>
                <p>Berdasarkan hasil review oleh DITMUTU, pengajuan kelanjutan penyusunan Kurikulum Bapak/Ibu <b>Tidak Disetujui</b>.F<br>
                </p>
                <p>
                Terima Kasih<br>
                Nakula Sehat Kementerian Kesehatan</p>
            ');
            $this->email->send();

            redirect('kurikulum/?status=dihentikan');
        }
    }

    public function hapus_kurikulum()
    {
        $id = base64_decode(hex2bin($this->uri->segment(3)));

        $this->M_entitas->delete_data('kurikulum', array('id_kurikulum' => $id));

        redirect('kurikulum/?status=penyusunan-kurikulum');
    }

    public function get_api_kurikulum_by_judul($judul)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://siakpel.kemkes.go.id/index.php/Api/kurikulum_all',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => 'Ekurma','pelatihan_name' => $judul),
          CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=vpo7s50j0ap483p7bqv1lvv91pt6ms10'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    
}