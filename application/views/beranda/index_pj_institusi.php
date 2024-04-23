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
    <div class="col-md-3 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid coral!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: coral;">Jumlah Penyusunan Berjalan</div>
              <div class="h5 mb-0 font-weight-bold"><?= $this->M_entitas->selectX('kurikulum', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi'), 'status >= ' => 3, 'status <= ' => 9))->num_rows(); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-spinner fa-2x" style="color: coral;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid limegreen !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: limegreen;">Jumlah Penyusunan Selesai</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $this->M_entitas->selectX('kurikulum', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi'), 'status >= ' => 11))->num_rows(); ?></div>
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
    <div class="col-md-3 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid blue !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: blue;">Jumlah Penyusunan Kurikulum</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold"><?= $this->M_entitas->selectX('kurikulum', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi')))->num_rows(); ?></div>
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
    <div class="col-md-3 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid red !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="font-weight-bold text-uppercase mb-1" style="color: red;">Jumlah Penyusunan Dihentikan</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold"><?= $this->M_entitas->selectX('kurikulum', array('id_sdm_institusi' => $this->session->userdata('id_sdm_institusi'), 'status' => 0))->num_rows(); ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-times-circle fa-2x" style="color: red;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $get_pengisian = $this->M_view->get_proses_kurikulum_pj_institusi($this->session->userdata('id_sdm_institusi'))->row(); ?>
  <?php if($get_pengisian){ ?>
    <?php 
      if($get_pengisian->status == 3)
      {
        if($get_pengisian->alasan_hentikan_sistem == 1)
        {
          if($get_pengisian->tambahan_waktu)
          {
            $total_tambah_waktu = $get_pengisian->tambahan_waktu * 7;
            $tanggal_deadline_isi = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($get_pengisian->verif_at)));
          }
          else
          {
            $tanggal_deadline_isi = $get_pengisian->verif_at;
          }
        }
        else
        {
          $tanggal_deadline_isi = $get_pengisian->verif_at;
        }
        $get_deadline = $this->M_entitas->get_deadline($tanggal_deadline_isi); 
      }
      else
      {
        $get_draft = $this->M_entitas->order_by_where('draft_kurikulum', array('id_kurikulum' => $get_pengisian->id_kurikulum), 'id_draft_kurikulum', 'DESC')->result();

        if(count($get_draft) == 1)
        {
          $get_deadline = $this->M_entitas->get_deadline($get_pengisian->pengecekan_kesesuaian_at);
          $tgl = tanggal_indo($get_deadline);
        }
        else
        {
          $get_deadline = $this->M_entitas->get_deadline($get_draft[0]->created_at);
          $tgl = tanggal_indo($get_deadline);
        }
      }
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-info" style="text-align: center; color: #0e075c;">
          <p style="font-size: 18px;"><b><i class="fa fa-star"></i> <b>Terdapat 1 Kurikulum Dalam Proses Penyusunan</b></p>
          <p>Segera kirimkan penyusunan / perbaikan sebelum tanggal <?= tanggal_indo($get_deadline); ?></p>
          <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($get_pengisian->id_kurikulum))); ?>" class = "btn btn-info" style = "background-color: #9d4edf; border-color: #9d4edf;" title = "Penyusunan Kurikulum"><b><i class="fa fa-list"></i> Penyusunan Kurikulum</b></a>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #115656;">
          <h6 class="m-0 font-weight-bold text-primary" style="color: #fff !important">Tahapan Penyusunan Kurikulum</h6>
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
                  <span class="title">1. Pemilihan pj substansi</span>
                </div>
                <p>Dalam Pengajuan Kurikulum, Pemilihan pj substansi menjadi salah satu syarat pengisian form. pj substansi yang terpilih berkewajiban untuk melakukan penyusunan Kurikulum yang diajukan oleh Institusi</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-list" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">2. Penyusunan Kurikulum</span>
                </div>
                <p>Setelah pengajuan kurikulum diverifikasi, pj substansi mulai melakukan penyusunan Kurikulum. Setiap penyusunan dapat disusun selama maksimal 5 hari kerja.</p>
                <div class="bottom">
                  <a href="<?= site_url('kurikulum'); ?>" style = "background: #115656;">Penyusunan Kurikulum</a>
                </div>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-archive" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">3. Kirim Draft Kurikulum</span>
                </div>
                <p>Kurikulum yang telah disusun dapat dikirim untuk dinilai oleh penilai.</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-star" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">4. Penilaian Penilai</span>
                </div>
                <p>Setelah draft kurikulum pertama dikirim dan akan dipilih Penilai untuk mendampingi penyusunan Kurikulum. Kurikulum yang telah disusun tersebut akan dinilai oleh Penilai.</p>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-list" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">5. Proses Perbaikan</span>
                </div>
                <p>Setelah dilakukan penilaian oleh Penilai, maka Kurikulum yang memiliki penilaian akan dilakukan perbaikan oleh pj substansi. Kemudian perbaikan akan dikirim kembali dan ke Penilai untuk dilakukan penilaian kembali. Proses ini akan terus berulang sampai tidak adanya penilaian dari Penilai. Pastikan penyusunan kurikulum sesuai.</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-upload" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">6. Upload Cover dan Kata Pengantar</span>
                </div>
                <p>Setelah Kurilukum telah sesuai dengan pedoman dan tidak adanya lagi penilaian oleh Pendmaping. Penilai dapat menyelesaikan Kurikulum. Setelah itu pj substansi dapat melanjutkan ke proses selanjutnya yaitu Upload Cover dan membuat Kata Pengantar. Pastikan Cover dan Kata Pengantar sudah terisi dengan benar.</p>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-gavel" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">7. Pemilihan Kategori dan Pengesahan Kurikulum</span>
                </div>
                <p>Setelah pengisian Cover dan Kata Pengantar, Kurikulum akan dipilih Kategori Pelatihan yang sesuai dan selanjutnya akan disahkan.</p>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Sekolah Terdaftar Di Sekitar Anda</h6>
        </div>
        <div class="card-body">
          <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
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