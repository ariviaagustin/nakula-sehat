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

  <!-- <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12">
      <div class="alert alert-info alert-dismissible" style="background: #c7edeb">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        <span><img src="https://img.icons8.com/material-two-tone/20/000000/data-provider.png"/> Selamat Datang Di PPDB <?= date('Y'); ?></span>
      </div>
    </div>
  </div> -->

  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #115656;">
          <h6 class="m-0 font-weight-bold text-primary" style="color: #fff !important">Tahapan Pengajuan Pengembangan Kompetensi</h6>
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
                  <span class="title">1. Membuat Pengajuan</span>
                </div>
                <p>Silahkan pilih menu Kurikulum untuk membuat Pengajuan Kurikulum Baru.</p>
                <div class="bottom">
                  <a href="<?= site_url('Kurikulum'); ?>" style = "background: #115656;">Buat Pengajuan</a>
                </div>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-user" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">2. Pilih PJ</span>
                </div>
                <p>Saat membuat pengajuan, pastikan sudah memiliki PJ untuk membuat Kurikulum yang akan disusun setelah diverifikasi oleh Ditmutu. Silahkan cek data SDM Institusi terlebih dahulu pada menu SDM Institusi</p>
                <div class="bottom">
                  <a href="<?= site_url('sdm-institusi'); ?>" style = "background: #115656;">SDM Institusi</a>
                </div>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-file" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">3. Mengisikan Form Pengajuan</span>
                </div>
                <p>Silahkan isi form untuk membuat pengajuan. Pastikan form sudah terisi dengan benar dan tepat.</p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-spinner" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">4. Menunggu Verifikasi</span>
                </div>
                <p>Pengajuan yang telah diajukan akan terkirim secara otomatis oleh ke Admin Ditmutu untuk diverifikasi. Pengajuan akan dicek terlebih dahulu apakah pengajuan tersebut membutuhkan pelatihan atau tidak. Kemudian Pengajuan yang telah diajukan akan dicek ketersediaannya, apakah judul yang diajukan sudah tersedia pada Kurikulum sebelumnya. </p>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-envelope" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">5. Surat Keterangan</span>
                </div>
                <p>
                  Saat Verfiikasi Pengajuan, Pengajuan tersebut akan dicek mengenai dua hal, yaitu:
                  <br>
                  1. Kebutuhan Pelatihan<br>
                  2. Ketersediaan Kurikulum
                  <br>
                  Apabila pengajuan tidak membutuhkan pelatihan dan Pengajuan sudah tersedia, maka Institusi Pengaju akan mendapatkan Surat Keterangan.
                </p>
              </section>
            </div>
            <div class="row row-2">
              <section>
                <i class="icon fas fa-list" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">6. Penyusunan Kurikulum</span>
                </div>
                <p>Setelah pengajuan diverifikasi dan pengajuan diterima, maka pj substansi yang telah dipilih sebelumnya akan menyusun kurikulum.</p>
              </section>
            </div>
            <div class="row row-1">
              <section>
                <i class="icon fas fa-desktop" style="color: #115656;"></i>
                <div class="details">
                  <span class="title">7. Monitoring</span>
                </div>
                <p>Institusi dapat memonitoring penyusunan kurikulum yang dilakukan oleh pj substansi terpilih dan dapat melihat penilaian dari penyusunan kurikulum yang dilakukan oleh Tim Penilai yang telah dipilih untuk mendampingi penyusunan kurikulum.</p>
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