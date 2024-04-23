<?php
    class M_entitas extends CI_Model 
    {     
        public function get_order($tabel, $order, $sort)
        {
            $this->db->select("*");
            $this->db->from($tabel);
            $this->db->order_by($order, $sort);
            $query = $this->db->get();
            return $query;
        }

        public function hapus_semua($tbl)
        {
            $this->db->truncate($tbl);
        }
        
        public function selectSemua($tbl)
        {
            return $this->db->get($tbl);//nama tabel
        }

        public function selectX($tbl,$where)
        {
            return $this->db->get_where($tbl,$where);
        }

        public function all_insert($table,$data)
        {
            $this->db->insert($table,$data);
            return $this->db->insert_id();
        }

        public function all_update($table,$data,$where)
        {
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function delete_data($tbl,$where)
        {
            $this->db->delete($tbl,$where);
        }

        public function order_by_where($tbl, $where, $order_by, $sort)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->where($where);
            $this->db->order_by($order_by, $sort);
            $query = $this->db->get();
            return $query;
        }

        public function order_by($tbl, $order_by, $sort)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->order_by($order_by, $sort);
            $query = $this->db->get();
            return $query;
        }

        public function grup_by_where($tbl, $where, $order_by, $sort, $grup)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->where($where);
            $this->db->order_by($order_by, $sort);
            $this->db->group_by($grup);
            $query = $this->db->get();
            return $query;
        }
        
        public function grup_order_by($tbl, $order_by, $sort, $grup)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->order_by($order_by, $sort);
            $this->db->group_by($grup);
            $query = $this->db->get();
            return $query;
        }

        public function order_by_where_limit($tbl, $where, $order_by, $sort, $limit)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->where($where);
            $this->db->order_by($order_by, $sort);
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query;
        }

        public function input_log($log)
        {
            $data = array(
                'id_user' => $this->session->userdata('id_user'),
                'id_role' => $this->session->userdata('id_role'),
                'role' => $this->session->userdata('role'),
                'log' => $log,
                'waktu' => date('Y-m-d H:i:s')
            );
            $this->db->insert('log', $data);
            return $this->db->insert_id();
        }

        public function update_kurikulum($id_kurikulum, $nama_update)
        {
            $data = array(
                'id_kurikulum' => $id_kurikulum,
                'nama_update' => $nama_update,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id_user'),                
            );
            $this->db->insert('update_kurikulum', $data);
            return $this->db->insert_id();
        }

        public function get_deadline($tanggal)
        {
            $tanggal = date('Y-m-d', strtotime($tanggal));
            $day = 5;
            for ($i = 0; $i <= $day; $i++) 
            { 
              $deadline = date('Y-m-d', strtotime($i.' days', strtotime($tanggal)));
              $cek = $this->selectX('tanggal_merah', array('tanggal_merah' => $deadline))->row();

              if($cek)
              {
                $day += 1;
              }

              if(date("D",strtotime($deadline)) == "Sat")
              {
                $day += 1;
              }

              if(date("D",strtotime($deadline)) == "Sun")
              {
                $day += 1;
              }
            }
            $deadline = date('Y-m-d', strtotime($day.' days', strtotime($tanggal)));
            return $deadline;
        }

        public function get_deadline_penilaian($tanggal)
        {
            $tanggal = date('Y-m-d', strtotime($tanggal));
            $day = 8;
            for ($i = 0; $i <= $day; $i++) 
            { 
              $deadline = date('Y-m-d', strtotime($i.' days', strtotime($tanggal)));
              $cek = $this->selectX('tanggal_merah', array('tanggal_merah' => $deadline))->row();

              if($cek)
              {
                $day += 1;
              }

              if(date("D",strtotime($deadline)) == "Sat")
              {
                $day += 1;
              }

              if(date("D",strtotime($deadline)) == "Sun")
              {
                $day += 1;
              }
            }
            $deadline = date('Y-m-d', strtotime($day.' days', strtotime($tanggal)));
            return $deadline;
        }

        public function tanggal_indo($tanggal, $cetak_hari = false)
        {
            $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );

              $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
              $split    = explode('-', $tanggal);
              $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

              if ($cetak_hari) {
                $num = date('N', strtotime($tanggal));
                return $hari[$num] . ', ' . $tgl_indo;
            }
            return $tgl_indo;
        }
    }
?>