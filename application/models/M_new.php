<?php
    class M_new extends CI_Model 
    {
        public function get_panduan()
        {
            $this->db->select('*');
            $this->db->from('panduan');
            $this->db->join('entitas__bagian_kurikulum', 'entitas__bagian_kurikulum.id_bagian = panduan.id_bagian', 'inner');
            $this->db->order_by('id_panduan', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_panduan_id($id)
        {
            $this->db->select('*');
            $this->db->from('panduan');
            $this->db->join('entitas__bagian_kurikulum', 'entitas__bagian_kurikulum.id_bagian = panduan.id_bagian', 'inner');
            $this->db->where('id_panduan', $id);
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi()
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->group_by('pengajuan.id_pengajuan');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_bagian($pengajuan)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->where('diskusi.id_pengajuan', $pengajuan);
            $this->db->group_by('diskusi.id_bagian');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_penilai($id)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->where('pengajuan.id_penilai', $id);
            $this->db->group_by('pengajuan.id_pengajuan');
            // $this->db->group_by('diskusi.id_bagian');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_penilai_bagian($pengajuan)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            // $this->db->where('pengajuan.id_penilai', $id);
            $this->db->where('pengajuan.id_pengajuan', $pengajuan);
            $this->db->group_by('diskusi.id_bagian');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_pengaju($id)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->where('pengajuan.pj_subtansi', $id);
            $this->db->group_by('pengajuan.id_pengajuan');
            // $this->db->group_by('diskusi.id_bagian');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_pengaju_bagian($pengajuan)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            // $this->db->where('pengajuan.pj_subtansi', $id);
            $this->db->where('pengajuan.id_pengajuan', $pengajuan);
            $this->db->group_by('diskusi.id_bagian');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_antar_penilai($id)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->where('pengajuan.id_penilai != ', $id);
            $this->db->group_by('pengajuan.id_pengajuan');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_antar_penilai_pj($id, $pj)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('pengajuan', 'pengajuan.id_pengajuan = diskusi.id_pengajuan', 'inner');
            $this->db->where('pengajuan.id_penilai != ', $id);
            $this->db->where('pengajuan.pj_subtansi != ', $pj);
            $this->db->group_by('pengajuan.id_pengajuan');
            $this->db->order_by('diskusi.created_at', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_id($id_p, $id_b)
        {
            $this->db->select('*, diskusi.created_at as waktu_diskusi');
            $this->db->from('diskusi');
            $this->db->join('user', 'user.id_user = diskusi.pendiskusi', 'inner');
            $this->db->where('diskusi.id_pengajuan', $id_p);
            $this->db->where('diskusi.id_bag_pengaju', $id_b);
            $this->db->order_by('diskusi.id_diskusi', 'ASC');
            $query = $this->db->get();
            return $query;
        }

        public function get_diskusi_penilai_id($id_p, $id_b)
        {
            $this->db->select('*, diskusi_penilai.created_at as waktu_diskusi');
            $this->db->from('diskusi_penilai');
            $this->db->join('user', 'user.id_user = diskusi_penilai.pendiskusi', 'inner');
            $this->db->where('diskusi_penilai.id_pengajuan', $id_p);
            $this->db->where('diskusi_penilai.id_bag_pengaju', $id_b);
            $this->db->order_by('diskusi_penilai.id_diskusi_p', 'ASC');
            $query = $this->db->get();
            return $query;
        }

        public function hitung_riwayat($config=array())
        {
            $defaults = array(  
                'pj' => NULL,
                'judul_kurikulum' => NULL,
                'id_penilai' => NULL,
                'status' => NULL,
                'kelengkapan' => NULL,
                'bulan' => NULL,
                'tahun' => NULL,
                'pengaju' => NULL,
            );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }

            $this->db->select('*');
            $this->db->from('pengajuan');
            if($pj){$this->db->where('pengajuan.pj_subtansi', $pj);}
            if($pengaju){$this->db->where('pengajuan.pengaju', $pengaju);}
            if($judul_kurikulum){$this->db->like('pengajuan.judul_kurikulum', $judul_kurikulum);}
            if($id_penilai){$this->db->where('pengajuan.id_penilai', $id_penilai);}
            if($status){$this->db->where('pengajuan.status', $status);}
            if($kelengkapan)
            {
                if($kelengkapan == 1)
                {
                    $this->db->where('pengajuan.kelengkapan', 1);
                }
                else if($kelengkapan == 2)
                {
                    $this->db->where('pengajuan.kelengkapan > ', 1);
                    $this->db->where('pengajuan.kelengkapan < ', 15);
                }
                if($kelengkapan == 3)
                {
                    $this->db->where('pengajuan.kelengkapan', 15);
                }
            }
            if($bulan){ $this->db->where('month(pengajuan.created_at)', $bulan); }
            if($tahun){ $this->db->where('year(pengajuan.created_at)', $tahun); }
            // if($created_at)
            // {
            //     $w_awal = $created_at." 00:00:00";
            //     $w_akhir = $created_at." 23:59:59";
            //     $this->db->where('pengajuan.created_at >= ', $w_awal);
            //     $this->db->where('pengajuan.created_at <= ', $w_akhir);
            // }
            $this->db->order_by('id_pengajuan', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function riwayat($limit,$offset,$config=array())
        {
            $defaults = array(  
                'pj' => NULL,
                'judul_kurikulum' => NULL,
                'id_penilai' => NULL,
                'status' => NULL,
                'kelengkapan' => NULL,
                'bulan' => NULL,
                'tahun' => NULL,
                'pengaju' => NULL,
            );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }

            $this->db->select('*');
            $this->db->from('pengajuan');
            if($pj){$this->db->where('pengajuan.pj_subtansi', $pj);}
            if($pengaju){$this->db->where('pengajuan.pengaju', $pengaju);}
            if($judul_kurikulum){$this->db->like('pengajuan.judul_kurikulum', $judul_kurikulum);}
            if($id_penilai){$this->db->where('pengajuan.id_penilai', $id_penilai);}
            if($status){$this->db->where('pengajuan.status', $status);}
            if($kelengkapan)
            {
                if($kelengkapan == 1)
                {
                    $this->db->where('pengajuan.kelengkapan', 1);
                }
                else if($kelengkapan == 2)
                {
                    $this->db->where('pengajuan.kelengkapan > ', 1);
                    $this->db->where('pengajuan.kelengkapan < ', 15);
                }
                if($kelengkapan == 3)
                {
                    $this->db->where('pengajuan.kelengkapan', 15);
                }
            }
            if($bulan){ $this->db->where('month(pengajuan.created_at)', $bulan); }
            if($tahun){ $this->db->where('year(pengajuan.created_at)', $tahun); }
            // if($created_at)
            // {
            //     $w_awal = $created_at." 00:00:00";
            //     $w_akhir = $created_at." 23:59:59";
            //     $this->db->where('pengajuan.created_at >= ', $w_awal);
            //     $this->db->where('pengajuan.created_at <= ', $w_akhir);
            // }
            $this->db->order_by('id_pengajuan', 'DESC');
            $this->db->limit($limit,$offset);
            $query = $this->db->get();
            return $query;
        }

        public function get_pengajuan($config=array())
        {
            $defaults = array(  
                'pengaju' => NULL,
                'judul_kurikulum' => NULL,
                'id_penilai' => NULL,
                'status' => NULL,
                'kelengkapan' => NULL,
                'tanggal_awal' => NULL,
                'tanggal_akhir' => NULL,
                'tambahan' => NULL,
                'is_aktif' => NULL,
            );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }

            $this->db->select('*');
            $this->db->from('pengajuan');
            if($pengaju){$this->db->where('pengajuan.pengaju', $pengaju);}
            if($judul_kurikulum){$this->db->like('pengajuan.judul_kurikulum', $judul_kurikulum);}
            if($id_penilai){$this->db->where('pengajuan.id_penilai', $id_penilai);}
            if($status){$this->db->where('pengajuan.status', $status);}
            if(!$status){$this->db->where('pengajuan.status > ', 0);}
            if($kelengkapan)
            {
                if($kelengkapan == 1)
                {
                    $this->db->where('pengajuan.kelengkapan', 1);
                }
                else if($kelengkapan == 2)
                {
                    $this->db->where('pengajuan.kelengkapan > ', 1);
                    $this->db->where('pengajuan.kelengkapan < ', 15);
                }
                if($kelengkapan == 3)
                {
                    $this->db->where('pengajuan.kelengkapan', 15);
                }
            }
            if($tanggal_awal)
            {
                $taw_awal = $tanggal_awal." 00:00:00";
                $this->db->where('pengajuan.created_at >= ', $taw_awal);
            }
            if($tanggal_akhir)
            {
                $ta_akhir = $tanggal_akhir." 23:59:59";
                $this->db->where('pengajuan.created_at <= ', $ta_akhir);
            }
            if($tambahan)
            {
                if($tambahan == 5)
                {
                    $this->db->where('pengajuan.status != ', 5);
                    $this->db->where('pengajuan.status != ', 6);
                }
                
            }
            if($is_aktif == 1)
            {
                $this->db->where('pengajuan.is_aktif', 1);
            }
            $this->db->order_by('id_pengajuan', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_permohonan($config=array())
        {
            $defaults = array(  
                'pengaju' => NULL,
                'judul_kurikulum' => NULL,
                'id_penilai' => NULL,
                'status' => NULL,
                'tanggal_awal' => NULL,
                'tanggal_akhir' => NULL,
            );
            foreach ($defaults as $key => $val) {
                $$key = ( ! isset($config[$key])) ? $val : $config[$key];
            }

            $this->db->select('*');
            $this->db->from('pengajuan');
            $this->db->where('pengajuan.status != ', 100);
            if($pengaju){$this->db->where('pengajuan.pengaju', $pengaju);}
            if($judul_kurikulum){$this->db->like('pengajuan.judul_kurikulum', $judul_kurikulum);}
            if($id_penilai){$this->db->where('pengajuan.id_penilai', $id_penilai);}
            if(!$status){$this->db->where('pengajuan.status > ', 4);}
            if($status){$this->db->where('pengajuan.status', $status);}
            if($tanggal_awal)
            {
                $taw_awal = $tanggal_awal." 00:00:00";
                $this->db->where('pengajuan.created_at >= ', $taw_awal);
            }
            if($tanggal_akhir)
            {
                $ta_akhir = $tanggal_akhir." 23:59:59";
                $this->db->where('pengajuan.created_at <= ', $ta_akhir);
            }
            $this->db->order_by('id_pengajuan', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function cetak_pengajuan($id_p)
        {
            $this->db->select('*');
            $this->db->from('bagian_kurikulum_pengaju');
            $this->db->join('entitas__bagian_kurikulum', 'entitas__bagian_kurikulum.id_bagian = bagian_kurikulum_pengaju.id_bagian', 'inner');
            $this->db->where('bagian_kurikulum_pengaju.id_pengajuan', $id_p);
            $this->db->order_by('bagian_kurikulum_pengaju.id_bagian', 'ASC');
            $query = $this->db->get();
            return $query;
        }

        public function get_penilai($pengaju)
        {
            $this->db->select('*');
            $this->db->from('penilai');
            $this->db->where('asal_instansi', NULL);
            $this->db->or_where('asal_instansi != ', $pengaju);
            $query = $this->db->get();
            return $query;
        }

        public function get_riwayat($pengajuan)
        {
            $this->db->select('*');
            $this->db->from('riwayat_revisi');
            $this->db->join('entitas__bagian_kurikulum', 'entitas__bagian_kurikulum.id_bagian = riwayat_revisi.id_bagian', 'inner');
            $this->db->where('riwayat_revisi.id_pengajuan', $pengajuan);
            $this->db->group_by('riwayat_revisi.id_bagian');
            $query = $this->db->get();
            return $query;
        }

        public function get_riwayat_bagian($pengajuan, $bagian)
        {
            $this->db->select('*');
            $this->db->from('riwayat_revisi');
            $this->db->where('riwayat_revisi.id_pengajuan', $pengajuan);
            $this->db->where('riwayat_revisi.id_bagian', $bagian);
            $this->db->order_by('riwayat_revisi.id_riwayat', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_riwayat_bagian_notif($pengajuan, $bagian)
        {
            $this->db->select('*');
            $this->db->from('riwayat_revisi');
            $this->db->where('riwayat_revisi.id_pengajuan', $pengajuan);
            $this->db->where('riwayat_revisi.id_bagian', $bagian);
            $this->db->group_by('riwayat_revisi.id_bagian');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query;
        }

        public function get_pj()
        {
            $this->db->select('*');
            $this->db->from('pj_subtansi');
            $this->db->join('pengaju', 'pengaju.id_pengaju = pj_subtansi.asal_pengaju', 'inner');
            $this->db->order_by('pj_subtansi.id_pj_subtansi', 'DESC');
            $query = $this->db->get();
            return $query;
        }

        public function get_pj_user($id)
        {
            $this->db->select('*');
            $this->db->from('pj_subtansi');
            $this->db->join('pengaju', 'pengaju.id_pengaju = pj_subtansi.asal_pengaju', 'inner');
            $this->db->where('pj_subtansi.id_user', $id);
            $query = $this->db->get();
            return $query;
        }

        public function get_lembaga_penilai()
        {
            $this->db->select('*');
            $this->db->from('penilai');
            $this->db->join('pengaju', 'pengaju.id_pengaju = penilai.asal_instansi', 'inner');
            $this->db->group_by('penilai.asal_instansi');
            $query = $this->db->get();
            return $query;
        }

        public function pengajuan_penilai($penilai)
        {
            $this->db->select('count(*) as total_pengajuan');
            $this->db->from('pengajuan');
            $this->db->where('id_penilai', $penilai);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total_pengajuan+0;
            }
        }

        public function pengajuan_penilai_selesai($penilai)
        {
            $this->db->select('count(*) as total_pengajuan');
            $this->db->from('pengajuan');
            $this->db->where('id_penilai', $penilai);
            $this->db->where('status >= ', 4);
            $this->db->where('status < ', 10);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total_pengajuan+0;
            }
        }

        public function pengajuan_penilai_berjalan($penilai)
        {
            $this->db->select('count(*) as total_pengajuan');
            $this->db->from('pengajuan');
            $this->db->where('id_penilai', $penilai);
            $this->db->where('status', 3);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total_pengajuan+0;
            }
        }

        public function pengajuan_lembaga($pengaju)
        {
            $this->db->select('count(*) as total_pengajuan');
            $this->db->from('pengajuan');
            $this->db->join('penilai', 'penilai.id_penilai = pengajuan.id_penilai', 'inner');
            $this->db->join('pengaju', 'pengaju.id_pengaju = penilai.asal_instansi', 'inner');
            $this->db->where('pengaju.id_pengaju', $pengaju);
            $data = $this->db->get();        
            foreach ($data->result() as $a) 
            {
              return $a->total_pengajuan+0;
            }
        }

        public function get_update($id_pengajuan)
        {
            $this->db->select('*');
            $this->db->from('update_pengajuan');
            $this->db->where('update_pengajuan.id_pengajuan', $id_pengajuan);
            $this->db->where('update_pengajuan.status', 0);
            $this->db->group_by('update_pengajuan.id_bagian');
            $query = $this->db->get();
            return $query;
        }
    }
?>