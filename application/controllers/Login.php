<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_entitas');
    $this->load->model('M_view');
    $this->load->model('M_new');
    $this->load->library('session');
    $this->load->helper('periode_helper');
  }

  public function index()
  {
    $this->load->view('login/utama');
  }

  public function login()
  {
    $data['widget'] = $this->recaptcha->getWidget();
    $data['script'] = $this->recaptcha->getScriptTag();

    $this->load->view('login/login', $data);
  }

  public function aksi_login() 
  {
    $recaptcha = $this->input->post('g-recaptcha-response');
    if(!empty($recaptcha))
    {
      $response = $this->recaptcha->verifyResponse($recaptcha);
      if(isset($response['success']) and $response['success'] === true)
      {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = $this->M_entitas->selectX('user', array('username' => $username))->result();
        if(count($data) == 0) 
        {
          $cek_siaksi = $this->get_api_instansi_by_username($username, $password);
          $cek_siaksi = json_decode($cek_siaksi,true);
          $get_status = $cek_siaksi['status_code'];
          if($get_status == '200')
          {
            $get_data = $cek_siaksi['data'];
            $get_data = $get_data[0];

            if($get_data)
            {
              if($get_data['id_institusi'] > 1)
              {
                $data = array(
                  'username' => $username,
                  'password' => md5($password),
                  'id_role' => 2,
                  'role' => 'Institusi',
                  'nama_lengkap' => $get_data['nama_institusi'],
                  'status' => 1,
                  'created_at' => date('Y-m-d H:i:s'),
                  'created_by' => $this->session->userdata('id_user'),
                );
                $query = $this->M_entitas->all_insert('user', $data);

                $id_user = $this->db->insert_id();

                $data = array(
                  'id_user' => $id_user,
                  'username' => $username,
                  'password' => $password
                );
                $query = $this->M_entitas->all_insert('another', $data);

                $data = array(
                  'id_user' => $id_user,
                  'id_institusi_siaksi' => $get_data['id_institusi'],
                  'kode_institusi' => $get_data['kode_institusi'],
                  'nama_institusi' => $get_data['nama_institusi'],
                  'email' => $get_data['email'],
                  'alamat' => $get_data['alamat'],
                  'lokasi_prov' => $get_data['lokasi_prov'],
                  'lokasi_kab' => $get_data['lokasi_kab'],
                  'lokasi_kec' => $get_data['lokasi_kec'],
                  'lokasi_kel' => $get_data['lokasi_kel'],
                  'status_aktif_ins' => $get_data['status_aktif_ins'],
                  'keterangan_status' => $get_data['keterangan_status'],
                  'status_akreditasi' => $get_data['status_akreditasi'],
                  'keterangan_akreditasi' => $get_data['keterangan_akreditasi'],
                  'id_user_siaksi' => $get_data['id_user'],
                );
                $query = $this->M_entitas->all_insert('institusi', $data);

                $get_user = $this->M_entitas->selectX('user', array('id_user' => $id_user))->row();

                $session = array(
                  'id_user' => $get_user->id_user,
                  'username' => $get_user->username,
                  'password' => $get_user->password,
                  'id_role' => $get_user->id_role,
                  'role' => $get_user->role,
                  'nama_user' => $get_user->nama_lengkap,
                  'status' => $get_user->status,
                  'is_admin_acp' => $get_user->is_admin_acp,
                  'id_institusi' => $get_data->id_institusi,
                  'id_institusi_siaksi' => $get_data->id_institusi_siaksi,
                  'nama_institusi' => $get_data->nama_institusi,
                );
                $this->session->set_userdata($session);
                redirect('beranda');
              } 
            }
          }
          else
          {
            $message['msg'] = 'Gagal Login4';
            $this->session->set_flashdata($message);
            redirect('login');
          }
        }
        else
        {
          $query = $this->M_entitas->selectX('user',array('username' => $username, 'password' => md5($password)))->row();

          if(empty($query))
          {
            $message['msg'] = 'Gagal Login';
            $this->session->set_flashdata($message);
            redirect('login');
          }
          else
          {
            if ($query->status == '1') 
            {
              if($query->id_role == '1' || $query->id_role == 5 || $query->id_role == 6)
              {
                $session = array(
                  'id_user' => $query->id_user,
                  'username' => $query->username,
                  'password' => $query->password,
                  'id_role' => $query->id_role,
                  'role' => $query->role,
                  'nama_user' => $query->nama_lengkap,
                  'status' => $query->status,
                  'is_admin_acp' => $query->is_admin_acp,
                );
                $this->session->set_userdata($session);
                redirect('beranda'); 
              }
              else if($query->id_role == '2')
              {
                $institusi = $this->M_entitas->selectX('institusi', array('id_user' => $query->id_user))->row();
                if($institusi->is_dummy == NULL)
                {
                  $a = $this->get_api_instansi_by_id_siaksi($institusi->id_institusi_siaksi);
                  $b = json_decode($a,true);
                  $get_data = $b['data'];
                  $get_data = $get_data[0];

                  $data_institusi = array(
                    'kode_institusi' => $get_data['kode_institusi'],
                    'nama_institusi' => $get_data['nama_institusi'],
                    'email' => $get_data['email'],
                    'alamat' => $get_data['alamat'],
                    'lokasi_prov' => $get_data['lokasi_prov'],
                    'lokasi_kab' => $get_data['lokasi_kab'],
                    'lokasi_kec' => $get_data['lokasi_kec'],
                    'lokasi_kel' => $get_data['lokasi_kel'],
                    'status_aktif_ins' => $get_data['status_aktif_ins'],
                    'keterangan_status' => $get_data['keterangan_status'],
                    'status_akreditasi' => $get_data['status_akreditasi'],
                    'keterangan_akreditasi' => $get_data['keterangan_akreditasi'],
                    'id_user_siaksi' => $get_data['id_user'],
                  );
                  $where_institusi = array('id_institusi_siaksi' => $institusi->id_institusi_siaksi);
                  $query_institusi = $this->M_entitas->all_update('institusi', $data_institusi, $where_institusi);

                  $data_user = array(
                    'username' => $get_data['username'],
                    'password' => md5($get_data['password']),
                    'nama_lengkap' => $get_data['nama_institusi'],
                  );
                  $where_user = array('id_user' => $query->id_user);
                  $query_user = $this->M_entitas->all_update('user', $data_user, $where_user);

                  $data_pass = array(
                    'username' => $get_data['username'],
                    'password' => $get_data['password'],
                  );
                  $query_pass = $this->M_entitas->all_update('another', $data_pass, $where_user);

                  $institusi = $this->M_entitas->selectX('institusi', array('id_user' => $query->id_user))->row();
                }
                
                $get_user = $this->M_entitas->selectX('user', array('id_user' => $query->id_user))->row();

                $session = array(
                  'id_user' => $get_user->id_user,
                  'username' => $get_user->username,
                  'password' => $get_user->password,
                  'id_role' => $get_user->id_role,
                  'role' => $get_user->role,
                  'nama_user' => $get_user->nama_lengkap,
                  'status' => $get_user->status,
                  'is_admin_acp' => $get_user->is_admin_acp,
                  'id_institusi' => $institusi->id_institusi,
                  'id_institusi_siaksi' => $institusi->id_institusi_siaksi,
                  'nama_institusi' => $institusi->nama_institusi,
                );
                $this->session->set_userdata($session);
                redirect('beranda'); 
              }
              else if($query->id_role == '3')
              {
                $penilai = $this->M_entitas->selectX('penilai', array('id_user' => $query->id_user))->row();
                $session = array(
                  'id_user' => $query->id_user,
                  'username' => $query->username,
                  'password' => $query->password,
                  'id_role' => $query->id_role,
                  'role' => $query->role,
                  'nama_user' => $query->nama_lengkap,
                  'status' => $query->status,
                  'is_admin_acp' => $query->is_admin_acp,
                  'id_penilai' => $penilai->id_penilai,
                  'nama_penilai' => $penilai->nama_penilai,
                );
                $this->session->set_userdata($session);
                redirect('beranda'); 
              }
              else if($query->id_role == '4')
              {
                $sdm = $this->M_entitas->selectX('sdm_institusi', array('id_user' => $query->id_user))->row();
                $session = array(
                  'id_user' => $query->id_user,
                  'username' => $query->username,
                  'password' => $query->password,
                  'id_role' => $query->id_role,
                  'role' => $query->role,
                  'nama_user' => $query->nama_lengkap,
                  'status' => $query->status,
                  'is_admin_acp' => $query->is_admin_acp,
                  'id_sdm_institusi' => $sdm->id_sdm_institusi,
                  'nama_sdm' => $sdm->nama_sdm,
                );
                $this->session->set_userdata($session);
                redirect('beranda'); 
              }
              else
              {
                $message['msg'] = 'Gagal Login';
                $this->session->set_flashdata($message);
                redirect('login');
              }
            }
            else
            {
              $message['msg'] = 'Gagal Login';
              $this->session->set_flashdata($message);
              redirect('login');
            }
          }
        }
      }
      else
      {
        $message['msg'] = 'Gagal Login5';
        $this->session->set_flashdata($message);
        redirect('login');
      }
    }
    else
    {
      $message['msg'] = 'Gagal Login6';
      $this->session->set_flashdata($message);
      redirect('login');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }

  public function get_api_instansi_by_id_siaksi($id_institusi)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_akses_ins',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('username' => 'aksessiaksi','id_institusi' => $id_institusi),
      CURLOPT_HTTPHEADER => array(
        'Cookie: ci_session=sslaiev8a4srviqagh2jh6kd49e7qfaa'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }

  public function get_api_instansi_by_username($username, $password)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://siaksi.kemkes.go.id/API_access_new?api_auth_key=abe2a1a1ef7d131b9c20b8a2a785a32dfa72a4b1',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('username' => $username, 'password' => $password),
      CURLOPT_HTTPHEADER => array(
        'Cookie: ci_session=4rs47dn7ui97kdim5jtuam58dqib35fe'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}
