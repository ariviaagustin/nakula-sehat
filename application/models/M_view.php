<?php
    class M_view extends CI_Model 
    {
        public function get_materi($jenis_materi, $id_kurikulum)
        {
            $this->db->select('id_materi');
            $this->db->from('materi');
            $this->db->where('jenis_materi ',$jenis_materi);
            $this->db->where('id_kurikulum',$id_kurikulum);
            $query = $this->db->get();
            return $query;
        }

        public function get_materi_metode($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('metode_materi');
            $this->db->join('materi', 'materi.id_materi = metode_materi.id_materi', 'inner');
            $this->db->where('metode_materi.id_kurikulum ', $id_kurikulum);
            $this->db->where('is_penugasan', 1);
            $this->db->where('id_metode != ', 4);
            $this->db->group_by('metode_materi.id_materi');
            $this->db->order_by('materi.jenis_materi', 'ASC');
            $query = $this->db->get();
            return $query;
        }

        public function get_materi_metode_pl($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('metode_materi');
            $this->db->join('materi', 'materi.id_materi = metode_materi.id_materi', 'inner');
            $this->db->where('metode_materi.id_kurikulum ', $id_kurikulum);
            $this->db->where('is_penugasan', 1);
            $this->db->where('id_metode', 4);
            $this->db->group_by('metode_materi.id_materi');
            $query = $this->db->get();
            return $query;
        }

        public function get_all_materi_pl($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('metode_materi');
            $this->db->join('materi', 'materi.id_materi = metode_materi.id_materi', 'inner');
            $this->db->where('metode_materi.id_kurikulum ', $id_kurikulum);
            $this->db->where('is_penugasan', 1);
            $this->db->where('id_metode', 4);
            $query = $this->db->get();
            return $query;
        }

        public function kurikulum_status($status)
        {
            $this->db->select('count(*) as total');
            $this->db->from('kurikulum');
            $this->db->where('status', $status);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total+0;
            }
        }

        public function institusi_kurikulum($institusi)
        {
            $this->db->select('count(*) as total');
            $this->db->from('kurikulum');
            $this->db->where('id_institusi', $institusi);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total+0;
            }
        }

        public function get_pengecekan_kurikulum($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 2);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function get_list_pengerjaan_kurikulum_penilaian($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 4);
            $this->db->or_where('status', 9);
            $query = $this->db->get();
            return $query;
        }

        public function get_penilaian_kurikulum($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('penilaian_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 1);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function get_list_pengerjaan_kurikulum($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 2);
            $this->db->or_where('status', 6);
            $query = $this->db->get();
            return $query;
        }

        public function get_pengecekan_list_kurikulum($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 1);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function get_pengecekan_list_kurikulum_perbaikan($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 1);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function get_list_kurikulum($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 1);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function get_list_kurikulum_perbaikan($id_kurikulum)
        {
            $this->db->select('*');
            $this->db->from('list_pengerjaan_kurikulum');
            $this->db->where('id_kurikulum ', $id_kurikulum);
            $this->db->where('status', 1);
            $this->db->or_where('status', 5);
            $this->db->or_where('status', 8);
            $query = $this->db->get();
            return $query;
        }

        public function permohonan_kurikulum()
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('status ', 1);
            $this->db->or_where('status', 3);
            $query = $this->db->get();
            return $query;
        }

        public function isi_kelengkapan_institusi($id_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_institusi', $id_institusi);
            $this->db->where('status ', 3);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function isi_kelengkapan_pj_institusi($id_sdm_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_sdm_institusi', $id_sdm_institusi);
            $this->db->where('status ', 3);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            return $query;
        }

        public function perbaikan_kurikulum_institusi($id_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_institusi', $id_institusi);
            $this->db->where('status ', 8);
            $query = $this->db->get();
            return $query;
        }

        public function perbaikan_kurikulum_pj_institusi($id_sdm_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_sdm_institusi', $id_sdm_institusi);
            $this->db->where('status ', 8);
            $query = $this->db->get();
            return $query;
        }

        public function upload_cover_institusi($id_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_institusi', $id_institusi);
            $this->db->where('status ', 9);
            $query = $this->db->get();
            return $query;
        }

        public function upload_cover_pj_institusi($id_sdm_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_sdm_institusi', $id_sdm_institusi);
            $this->db->where('status ', 9);
            $query = $this->db->get();
            return $query;
        }

        public function filter_kurikulum($config=array(), $id_role)
        {
            $defaults = array(  
                'tgl_pengajuan' => NULL,
                'judul' => NULL,
                'id_institusi' => NULL,
                'id_penilai' => NULL,
                'id_sdm_institusi' => NULL,
                'status' => NULL,
            );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }

            $this->db->select('*');
            $this->db->from('kurikulum');
            if($tgl_pengajuan){$this->db->where('tgl_pengajuan', $tgl_pengajuan);}
            if($judul){$this->db->where('judul', $judul);}
            if($id_institusi){$this->db->where('id_institusi', $id_institusi);}
            if($id_penilai){$this->db->where('id_penilai', $id_penilai);}
            if($id_sdm_institusi){$this->db->where('id_sdm_institusi', $id_sdm_institusi);}
            if($status)
            {
                if($status == 'permohonan-pengajuan')
                {
                    if($id_role == 1)
                    {
                        $this->db->where('status', 1);
                        $this->db->or_where('status', 2);
                    }
                    else
                    {
                        $this->db->where('status', 1);
                    }
                }
                else if($status == 'penyusunan-kurikulum')
                {
                    if($id_role == 1 || $id_role == 5)
                    {
                        $this->db->where('status >= ', 3);
                        $this->db->where('status < ', 10);
                    }
                }
                else if($status == 'selesai')
                {
                    if($id_role == 1)
                    {
                        $this->db->where('status', 11);
                    }
                    else if($id_role == 2 || $id_role == 4)
                    {
                        $this->db->where('status', 11);
                        $this->db->or_where('status', 12);
                    }
                    else if($id_role == 3)
                    {
                        $this->db->where('status >= ', 9);
                        $this->db->where('status <= ', 12);
                    }
                    else if($id_role == 5)
                    {
                        $this->db->where('status > ', 9);
                        $this->db->where('status <= ', 12);
                    }
                }
                else if($status == 'kirim-siakpel'){$this->db->where('status', 12);}
                else if($status == 'dihentikan'){$this->db->where('status', 0);}
                else if($status == 'pengesahan-kurikulum'){$this->db->where('status', 10);}
                else if($status == 'verifikasi-kesesuaian'){$this->db->where('status', 4);}
                else if($status == 'perbaikan-kesesuaian'){$this->db->where('status', 5);}
                else if($status == 'pilih-penilai'){$this->db->where('status', 6);}
                else if($status == 'isi-kelengkapan')
                {
                    if($id_role == 2 || $id_role == 4)
                    {
                        $this->db->where('status', 3);
                        $this->db->or_where('status', 5);
                    }
                }
                else if($status == 'penilaian-kurikulum')
                {
                    if($id_role == 2 || $id_role == 4)
                    {
                        $this->db->where('status', 6);
                        $this->db->or_where('status', 7);
                    }
                    else if($id_role == 3)
                    {
                        $this->db->where('status', 7);
                    }
                }
                else if($status == 'perbaikan-kurikulum'){$this->db->where('status', 8);}
                else if($status == 'upload-cover'){$this->db->where('status', 9);}
            }
            $this->db->order_by('updated_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_proses_kurikulum_pj_institusi($id_sdm_institusi)
        {
            $this->db->select('*');
            $this->db->from('kurikulum');
            $this->db->where('id_sdm_institusi', $id_sdm_institusi);
            $this->db->where('status ', 3);
            $this->db->or_where('status ', 5);
            $this->db->or_where('status ', 8);
            $query = $this->db->get();
            return $query;
        }
    }
?>