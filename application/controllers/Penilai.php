<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilai extends CI_Controller {
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
		$data['penilai'] = $this->M_entitas->get_order('penilai', 'id_penilai', 'DESC')->result();

		$this->load->view('shared/header_akun');
		$this->load->view('penilai/index', $data);
		$this->load->view('shared/footer_akun');
	}

    public function tambah()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('penilai/tambah');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_tambah()
    {
        $cek = $this->M_entitas->selectX('penilai', array('nik' => $this->input->post('nik')))->num_rows();
        if($cek > 0)
        {
            $message['msg'] = 'NIK Sudah terdaftar';
            $this->session->set_flashdata($message);
            redirect('tambah-penilai');
        }
        else
        {
            $data_user = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'id_role' => 3,
                'role' => 'penilai',
                'nama_lengkap' => $this->input->post('nama_penilai'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user'),
            );
            $query = $this->M_entitas->all_insert('user', $data_user);

            $id_user = $this->db->insert_id();

            $data_pass = array(
                'id_user' => $id_user,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            );
            $query_pass = $this->M_entitas->all_insert('another', $data_pass);

            $data = array(
                'id_user' => $id_user,
                'nama_penilai' => $this->input->post('nama_penilai'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'nip' => $this->input->post('nip'),
                'is_penilaian' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_user')
            );
            $this->M_entitas->all_insert('penilai', $data);

            redirect('penilai');
        }
    }

    public function ubah()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $data['penilai'] = $this->M_entitas->selectX('penilai', array('id_penilai' => $id))->row();

        $this->load->view('shared/header_akun');
        $this->load->view('penilai/ubah', $data);
        $this->load->view('shared/footer_akun');
    }

    public function aksi_ubah()
    {
        $data = array(
            'nama_penilai' => $this->input->post('nama_penilai'),
            'nik' => $this->input->post('nik'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'nip' => $this->input->post('nip'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );
        $where = array('id_penilai' => $this->input->post('id_penilai'));
        $this->M_entitas->all_update('penilai', $data, $where);

        redirect('penilai');
    }

    public function hapus()
    {
        $id = base64_decode(hex2bin($this->uri->segment(2)));

        $penilai = $this->M_entitas->selectX('penilai', array('id_penilai' => $id))->row();

        $this->M_entitas->delete_data('user', array('id_user' => $penilai->id_user));
        $this->M_entitas->delete_data('another', array('id_user' => $penilai->id_user));
        $this->M_entitas->delete_data('penilai', array('id_penilai' => $id));

        redirect('penilai');
    }

    public function upload_penilai()
    {
        $this->load->view('shared/header_akun');
        $this->load->view('penilai/upload_penilai');
        $this->load->view('shared/footer_akun');
    }

    public function aksi_upload()
    {
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $file = $_FILES['file']['name'];

        if(isset($_FILES['file']['name'])){
            $config['upload_path']   = './agenda/perdata/upload';
            $config['file_name']     = date('dmYHis');
            $config['allowed_types'] = 'xlsx|xls|csv';
            // $config['max_size'] = '10000';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('file')){
                $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
                redirect('penilai');
            }else{
                
                $data_upload = $this->upload->data();
                $file = $this->upload->data()['file_name'];

                $excelreader     = new PHPExcel_Reader_Excel2007();

                $loadexcel         = $excelreader->load('agenda/perdata/upload/'.$file); // Load file yang telah diupload ke folder excel
                $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

                $data = array();

                $numrow = 1;

                foreach($sheet as $row)
                {
                    $nama = $row['A'];

                    $username = $nama;
                    $username = strtolower($username);
                    $username = str_replace(" ", "", $username);
                    $username = str_replace(",", "", $username);
                    $username = str_replace(".", "", $username);
                    $username = str_replace(":", "", $username);
                    $username = str_replace("_", "", $username);
                    $username = str_replace("!", "", $username);
                    $username = str_replace("@", "", $username);
                    $username = str_replace("#", "", $username);
                    $username = str_replace("$", "", $username);
                    $username = str_replace("%", "", $username);
                    $username = str_replace("^", "", $username);
                    $username = str_replace("&", "", $username);
                    $username = str_replace("*", "", $username);
                    $username = str_replace("(", "", $username);
                    $username = str_replace(")", "", $username);
                    $username = str_replace("/", "", $username);
                    $username = str_replace("-", "", $username);

                    $email = $username."@mail.com";

                    $data = array(
                        'username' => $username,
                        'password' => md5(12345),
                        'id_role' => 3,
                        'role' => 'penilai',
                        'nama_lengkap' => $row['A'],
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_user'),
                    );
                    $query = $this->M_entitas->all_insert('user', $data);

                    $id = $this->db->insert_id();

                    $data_pass = array(
                        'id_user' => $id,
                        'username' => $username,
                        'password' => 12345,
                    );
                    $query_pass = $this->M_entitas->all_insert('another', $data_pass);

                    $nama_portal = $nama;
                    $nama_portal = strtolower($nama_portal);
                    $nama_portal = str_replace(" ", "-", $nama_portal);
                    $nama_portal = str_replace(",", "-", $nama_portal);
                    $nama_portal = str_replace(".", "-", $nama_portal);
                    $nama_portal = str_replace(":", "-", $nama_portal);
                    $nama_portal = str_replace("_", "-", $nama_portal);
                    $nama_portal = str_replace("!", "-", $nama_portal);
                    $nama_portal = str_replace("@", "-", $nama_portal);
                    $nama_portal = str_replace("#", "-", $nama_portal);
                    $nama_portal = str_replace("$", "-", $nama_portal);
                    $nama_portal = str_replace("%", "-", $nama_portal);
                    $nama_portal = str_replace("^", "-", $nama_portal);
                    $nama_portal = str_replace("&", "-", $nama_portal);
                    $nama_portal = str_replace("*", "-", $nama_portal);
                    $nama_portal = str_replace("(", "-", $nama_portal);
                    $nama_portal = str_replace(")", "-", $nama_portal);
                    $nama_portal = str_replace("/", "-", $nama_portal);
                    $nama_portal = str_replace("---", "-", $nama_portal);
                    $nama_portal = str_replace("--", "-", $nama_portal);

                    $data_penilai = array(
                        'id_user' => $id,
                        'nama_penilai' => $nama,
                        'is_penilaian' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_user'),
                    );
                    $query_penilai = $this->M_entitas->all_insert('penilai', $data_penilai);
                }
                
                //delete file from server
                unlink(realpath('agenda/perdata/upload/'.$file));

                //upload success
                $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
                //redirect halaman
                redirect('penilai');
            }
        }
    }
}