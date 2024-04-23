<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <?php 
    $get_logo = $this->M_entitas->selectSemua('logo')->row(); 
    $logo = $get_logo->logo;    
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="Nakula Sehat">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Nakula Sehat">
  <meta name="author" content="">

  <title>Nakula Sehat || <?= $this->uri->segment(1); ?></title>

  <!-- Custom fonts for this template-->
  <link rel="icon" href="<?= base_url('agenda/perdata/bg/'.$logo); ?>">
  <link href="<?= base_url(); ?>agenda/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>agenda/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>agenda/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>agenda/admin/select2/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url(); ?>agenda/owlcarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>agenda/owlcarousel/owl.theme.default.min.css">

  <style type="text/css">
    .card{ color: #000; }
    table{ color: #000; }
    th{ color: #000; }
    td{ color: #000; }
    .sidebar-dark .nav-item .nav-link:hover {
      background-color: #018e87;
    }
    .sidebar-dark .sidebar-brand {
      color: #32BACF;
      background-image: linear-gradient(to right, #ffffff 10%, #C7EDEB);
    }
    .bg-gradient-primary {
      background-color: #32BACF;
      background-size: cover;
    }
    .sidebar-dark .nav-item .nav-link 
    {
      color: #F3F7C1;
    }
    .sidebar .nav-item .nav-link span 
    {
        font-weight: 900;
    }
    .sidebar-dark .nav-item .nav-link i 
    {
      color: #F3F7C1;
      font-weight: 900;
    }
    .sidebar-dark .nav-item.active .nav-link i {
      color: #015050;
    }
    .sidebar-dark .nav-item.active .nav-link {
      color: #015050;
      background-color: #C7EDEB;
    }
    .jum_pengajuan
    {
      background-color: #ff0000;
      color: #fff;
      border-radius: 100px;
      padding: 3px 8px;
      float: right;
    }
    .sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar .nav-item .collapsing .collapse-inner .collapse-item {
      color: #F3F7C1;
    }
    .sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
      background-color: #015050;
    }
    .form-control{ color: #000; }
    form{ color: #000; }
    .sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar .nav-item .collapsing .collapse-inner .collapse-item {
      color: #000000;
    }
    .sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
      background-color: #c7edeb;
    }
  </style>

</head>
<?php $this->M_entitas->input_log($this->uri->segment(1)); ?>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-image: linear-gradient(#015050, #7F7F7F);">
      <div class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text">
          <img src="<?= base_url('agenda/perdata/bg/'.$logo); ?>" width = "100%">
        </div>
      </div>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?php if($this->uri->segment(1) ==  'beranda'){ echo "active"; } ?>">
        <a class="nav-link" href="<?= site_url('beranda'); ?>">
          <i class="fa fa-share"></i>
          <span>Beranda</span></a>
      </li>
      <li class="nav-item <?php if($this->uri->segment(1) ==  'pedoman' || $this->uri->segment(1) ==  'ubah-pedoman'){ echo "active"; } ?>">
        <a class="nav-link" href="<?= site_url('pedoman'); ?>">
          <i class="fa fa-share"></i>
          <span>Pedoman Penyusunan</span></a>
      </li>
      <?php if($this->session->userdata('id_role') == 1){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'institusi'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('institusi'); ?>">
            <i class="fa fa-share"></i>
            <span>Institusi</span></a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'penilai' || $this->uri->segment(1) ==  'tambah-penilai' || $this->uri->segment(1) ==  'ubah-penilai'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('penilai'); ?>">
            <i class="fa fa-share"></i>
            <span>Penilai</span></a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum' || $this->uri->segment(1) ==  'tambah-kurikulum' || $this->uri->segment(1) ==  'verifikasi-pengajuan' || $this->uri->segment(1) ==  'verifikasi-penilai' || $this->uri->segment(1) ==  'tolak-pengajuan-by-penilai' || $this->uri->segment(1) ==  'terima-pengajuan-by-penilai' || $this->uri->segment(1) ==  'pencarian-penilai-baru'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=permohonan-pengajuan'); ?>">
            <i class="fa fa-share"></i>
            <span>Penyusunan Kurikulum</span></a>
        </li>
        <!-- <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum-sah'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum-sah'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li> -->
        <li class="nav-item <?php if($this->uri->segment(1) ==  'request-hubungi-penilai-institusi'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('request-hubungi-penilai-institusi'); ?>">
            <i class="fa fa-share"></i>
            <span>Request</span></a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'bab-dan-sub-bab' || $this->uri->segment(1) ==  'ubah-bab' || $this->uri->segment(1) ==  'ubah-sub-bab'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('bab-dan-sub-bab'); ?>">
            <i class="fa fa-share"></i>
            <span>Master Bab & Sub Bab</span></a>
        </li>
        <?php if($this->session->userdata('is_admin_acp') == 1){ ?>
          <li class="nav-item <?php if($this->uri->segment(1) ==  'sdm-institusi' || $this->uri->segment(1) ==  'tarik-sdm-institusi'){ echo "active"; } ?>">
            <a class="nav-link" href="<?= site_url('sdm-institusi'); ?>">
              <i class="fa fa-share"></i>
              <span>SDM Institusi</span></a>
          </li>
        <?php } ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'metode' || $this->uri->segment(1) ==  'tambah-metode' || $this->uri->segment(1) ==  'ubah-metode' || $this->uri->segment(1) ==  'media-alat-bantu' || $this->uri->segment(1) ==  'tambah-media-alat-bantu' || $this->uri->segment(1) ==  'ubah-media-alat-bantu' || $this->uri->segment(1) ==  'jenis-pelatihan' || $this->uri->segment(1) ==  'tambah-jenis-pelatihan' || $this->uri->segment(1) ==  'ubah-jenis-pelatihan' || $this->uri->segment(1) ==  'kategori-pelatihan' || $this->uri->segment(1) ==  'tambah-kategori-pelatihan' || $this->uri->segment(1) ==  'ubah-kategori-pelatihan'){ echo "active"; } ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-share"></i>
            <span>Master Data</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?= site_url('metode'); ?>">Metode</a>
              <a class="collapse-item" href="<?= site_url('media-alat-bantu'); ?>">Media & Alat Bantu</a>
              <a class="collapse-item" href="<?= site_url('jenis-pelatihan'); ?>">Jenis Pelatihan</a>
              <a class="collapse-item" href="<?= site_url('kategori-pelatihan'); ?>">Kategori Pelatihan</a>
              <a class="collapse-item" href="<?= site_url('master-data-panduan'); ?>">Panduan Aplikasi</a>
              <a class="collapse-item" href="<?= site_url('tanggal-merah'); ?>">Tanggal Merah</a>
              <a class="collapse-item" href="<?= site_url('master-pengesah'); ?>">Master Pengesah</a>
            </div>
          </div>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'pengguna' || $this->uri->segment(1) ==  'tambah-pengguna' || $this->uri->segment(1) ==  'ubah-pengguna'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('pengguna'); ?>">
            <i class="fa fa-share"></i>
            <span>Pengguna </span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 2){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum' || $this->uri->segment(1) ==  'tambah-kurikulum' || $this->uri->segment(1) ==  'verifikasi-pengajuan' || $this->uri->segment(1) ==  'verifikasi-penilai' || $this->uri->segment(1) ==  'tolak-pengajuan-by-penilai' || $this->uri->segment(1) ==  'terima-pengajuan-by-penilai' || $this->uri->segment(1) ==  'pencarian-penilai-baru'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=isi-kelengkapan'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'sdm-institusi'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('sdm-institusi'); ?>">
            <i class="fa fa-share"></i>
            <span>SDM Institusi</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 3){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum' || $this->uri->segment(1) ==  'tambah-kurikulum' || $this->uri->segment(1) ==  'verifikasi-pengajuan' || $this->uri->segment(1) ==  'verifikasi-penilai' || $this->uri->segment(1) ==  'tolak-pengajuan-by-penilai' || $this->uri->segment(1) ==  'terima-pengajuan-by-penilai' || $this->uri->segment(1) ==  'pencarian-penilai-baru'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=penilaian-kurikulum'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 4){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum' || $this->uri->segment(1) ==  'tambah-kurikulum' || $this->uri->segment(1) ==  'verifikasi-pengajuan' || $this->uri->segment(1) ==  'verifikasi-penilai' || $this->uri->segment(1) ==  'tolak-pengajuan-by-penilai' || $this->uri->segment(1) ==  'terima-pengajuan-by-penilai' || $this->uri->segment(1) ==  'pencarian-penilai-baru'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=isi-kelengkapan'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 5){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=permohonan-pengajuan'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 6){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'kurikulum'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('kurikulum/?status=verifikasi-kesesuaian'); ?>">
            <i class="fa fa-share"></i>
            <span>Kurikulum</span></a>
        </li>
      <?php } ?>
      <?php $cek_panduan_role = $this->M_entitas->selectX('panduan', array('id_role' => $this->session->userdata('id_role')))->row(); if($cek_panduan_role){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'panduan'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('panduan'); ?>">
            <i class="fa fa-share"></i>
            <span>Panduan Aplikasi</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 1){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'pengaturan-logo'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('pengaturan-logo'); ?>">
            <i class="fa fa-share"></i>
            <span>Pengaturan Logo</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'informasi-profil'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('informasi-profil'); ?>">
            <i class="fa fa-share"></i>
            <span>Informasi Profil</span></a>
        </li>
      <?php } ?>
      <?php if($this->session->userdata('id_role') != 2){ ?>
        <li class="nav-item <?php if($this->uri->segment(1) ==  'pengaturan-akun'){ echo "active"; } ?>">
          <a class="nav-link" href="<?= site_url('pengaturan-akun'); ?>">
            <i class="fa fa-share"></i>
            <span>Pengaturan Akun</span></a>
        </li>
      <?php } ?>
      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-image: linear-gradient(to right, #C7EDEB 10%, #015050);">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-sm-none">
              <div class="nav-link" role="button" aria-haspopup="true" aria-expanded="false">
                <?= $this->session->userdata('nama_user'); ?>
              </div>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small" style="font-weight: 700; color: white"><?= $this->session->userdata('nama_user'); ?></span>
                <i class="fas fa-angle-down fa-sm fa-fw mr-2" style="font-weight: 700; color: white"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= site_url('Login/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>