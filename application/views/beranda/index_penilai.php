<style type="text/css">
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
  .wrapper {
    max-width: 1080px;
    margin: 50px auto;
    padding: 0 20px;
    position: relative;
  }
  .wrapper .center-line {
    position: absolute;
    height: 100%;
    width: 4px;
    background: #fff;
    left: 50%;
    top: 20px;
    transform: translateX(-50%);
  }
  .wrapper .row {
    display: flex;
  }
  .wrapper .row-1 {
    justify-content: flex-start;
  }
  .wrapper .row-2 {
    justify-content: flex-end;
  }
  .wrapper .row section {
    background: #fff;
    border-radius: 5px;
    width: calc(50% - 40px);
    padding: 20px;
    position: relative;
  }
  .wrapper .row section::before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    background: #fff;
    top: 28px;
    z-index: -1;
    transform: rotate(45deg);
  }
  .row-1 section::before {
    right: -7px;
  }
  .row-2 section::before {
    left: -7px;
  }
  .row section .icon,
  .center-line .scroll-icon {
    position: absolute;
    background: #f2f2f2;
    height: 40px;
    width: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    color: #046ea3;
    font-size: 17px;
    box-shadow: 0 0 0 4px #fff, inset 0 2px 0 rgba(0, 0, 0, 0.08),
      0 3px 0 4px rgba(0, 0, 0, 0.05);
  }
  .center-line .scroll-icon {
    bottom: 0px;
    left: 50%;
    font-size: 25px;
    transform: translateX(-50%);
  }
  .row-1 section .icon {
    top: 15px;
    right: -60px;
  }
  .row-2 section .icon {
    top: 15px;
    left: -60px;
  }
  .row section .details,
  .row section .bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .row section .details .title {
    font-size: 22px;
    font-weight: 600;
  }
  .row section p {
    margin: 10px 0 17px 0;
  }
  .row section .bottom a {
    text-decoration: none;
    background: #046ea3;
    color: #fff;
    padding: 7px 15px;
    border-radius: 5px;
    /* font-size: 17px; */
    font-weight: 400;
    transition: all 0.3s ease;
  }
  .row section .bottom a:hover {
    transform: scale(0.97);
  }
  @media (max-width: 790px) {
    .wrapper .center-line {
      left: 40px;
    }
    .wrapper .row {
      margin: 30px 0 3px 60px;
    }
    .wrapper .row section {
      width: 100%;
    }
    .row-1 section::before {
      left: -7px;
    }
    .row-1 section .icon {
      left: -60px;
    }
  }
  @media (max-width: 440px) {
    .wrapper .center-line,
    .row section::before,
    .row section .icon {
      display: none;
    }
    .wrapper .row {
      margin: 10px 0;
    }
  }
</style>
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-calendar fa-sm text-white"></i> <?= tanggal_indo(date('Y-m-d')); ?></a>
  </div>

  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid orange!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: orange;">Jumlah Penilaian Berjalan</div>
              <div class="h5 mb-0 font-weight-bold"><?= $this->M_entitas->selectX('kurikulum', array('id_penilai' => $this->session->userdata('id_penilai'), 'status >= ' => 7, 'status <= ' => 8))->num_rows(); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-star fa-2x" style="color: orange;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid limegreen !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: limegreen;">Jumlah Penilaian Selesai</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $this->M_entitas->selectX('kurikulum', array('id_penilai' => $this->session->userdata('id_penilai'), 'status >= ' => 11))->num_rows(); ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-check-circle fa-2x" style="color: limegreen;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid blue !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: blue;">Jumlah Penilaian</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold"><?= $this->M_entitas->selectX('kurikulum', array('id_penilai' => $this->session->userdata('id_penilai')))->num_rows(); ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-book fa-2x" style="color: blue;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $get_penilaian_berjalan = $this->M_entitas->selectX('kurikulum', array('id_penilai' => $this->session->userdata('id_penilai'), 'status' => 7))->row(); ?>
  <?php if($get_penilaian_berjalan){ ?>
    <?php 
      $get_draft = $this->M_entitas->order_by_where('draft_kurikulum', array('id_kurikulum' => $get_penilaian_berjalan->id_kurikulum), 'id_draft_kurikulum', 'DESC')->result();
      if(count($get_draft) == 1)
      {
        $get_deadline = $this->M_entitas->get_deadline($get_penilaian_berjalan->pilih_penilai_at);
        $tgl = tanggal_indo($get_deadline);
      }
      else
      {
        $get_deadline = $this->M_entitas->get_deadline($get_draft[0]->created_at);
        $tgl = tanggal_indo($get_deadline);
      }
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-info" style="text-align: center; color: red; background-color: khaki;">
          <p style="font-size: 18px;"><b><i class="fa fa-star"></i> <b>Terdapat 1 Kurikulum Dalam Proses Penilaian</b></p>
          <p>Segera berikan penilaian sebelum tanggal <?= tanggal_indo($get_deadline); ?></p>
          <a href="<?= site_url('penilaian-penilai/'.bin2hex(base64_encode($get_penilaian_berjalan->id_kurikulum))); ?>" class = "btn btn-info" style = "background-color: #0e075c; border-color: #0e075c;" title = "Beri Penilaian"><b><i class="fa fa-star"></i> Berikan Penilaian</b></a>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #115656;">
          <h6 class="m-0 font-weight-bold text-primary" style="color: #fff !important">Tahapan Penilaian Kurikulum</h6>
        </div>
        <div class="card-body" style="background: #c7edeb">
          <div class="wrapper">
            <div class="center-line">
              <a href="#" class="scroll-icon"><i class="fas fa-caret-up"></i></a>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-hand-pointer" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">1. Pilih Penilai</span>
                </div>
                <p>Admin Ditmutu akan memilih penilai yang sesuai dengan Pengajuan Kurikulum yang telah diajukan oleh Institusi</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-star" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">2. Penilaian</span>
                </div>
                <p>Setelah pemilihan penilai, maka Kurikulum yang telah disusun sebelumnya oleh pj substansi dapat dinilai oleh penilainya. Silahkan menilai Kurikulum agar penyusunan kurikulum sesuai dengan pedoman. Penilaian Kurikulum dapat dilakukan selama 5 hari kerja.</p>
                <div class="bottom">
                  <a href="<?= site_url('kurikulum'); ?>" style = "background: #115656;">Penilaian Kurikulum</a>
                </div>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-spinner" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">3. Menunggu Perbaikan</span>
                </div>
                <p>Apabila kurikulum terdapat penilaian, maka penilaian tersebut akan dikirim ke pj substansi untuk dilakukan perbaikan sesuai dengan penilaian. </p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-star" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">4. Penilaian Kembali</span>
                </div>
                <p>Kurikulum yang telah diperbaiki oleh pj substansi akan dinilai kembali oleh Penilai. Apabila masih terdapat penilaian, maka proses ini akan terus berulang.</p>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-check-circle" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">5. Selesaikan Kurikulum</span>
                </div>
                <p>Kurikulum yang telah selesai penyusunannya dan sudah sesuai dengan pedoman yang ada sehingga tidak adanya lagi penilaian oleh Penilai, maka Penilai dapat menyelesaikan kurikulum tersebut. Selanjutnya pj substansi akan melanjutkan proses penyusunan seperti upload cover. Kemudian Kurikulum tersebut akan disahkan.</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-envelope" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">6. Surat Keterangan Menilai</span>
                </div>
                <p>Penilai yang telah menilai kurikulum akan mendapatkan Surat Keterangan Menilai sebagai bentuk apresiasi</p>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  function tanggal_indo($tanggal, $cetak_hari = false)
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
?>