<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
  td{ font-weight:600; }
  .box
  {
    padding: 5px; text-align: center; color: #000; border-radius: 10px; margin-bottom: 10px;
  }
  .box:hover
  {
    color: #3321c7;
    background-color: #c7edeb;
  }
  .aktif
  {
    color: #fff;
    font-weight: 600;
    background-color: #205c5c !important;
  }
  .aktif:hover
  {
    color: #3321c7;
    background-color: #c7edeb !important;
  }
  a:hover
  {
    text-decoration: none;
  }
  .verifikasi
  {
    background-color: sandybrown;
  }
  .penyusunan
  {
    background-color: cornflowerblue; color: #fff;
  }
  .pengesahan
  {
    background-color: olive; color: #fff;
  }
  .selesai
  {
    background-color: lawngreen;
  }
  .siakpel
  {
    background-color: darkgreen; color: #fff;
  }
  .dihentikan
  {
    background-color: crimson; color: #fff;
  }
  .perbaikan
  {
    background-color: darkgrey;
  }
  .pilih_penilai
  {
    background-color: blueviolet; color: #fff;
  }
  .pengajuan
  {
    background-color: goldenrod; color: #fff;
  }
  .isi_kelengkapan
  {
    background-color: salmon;
  }
  .penilaian
  {
    background-color: orangered; color: #fff;
  }
  .upload_cover
  {
    background-color: rosybrown; color: #fff;
  }
  .jumlah_notif_status
  {
    background-color: #ff0000; 
    color: #fff; 
    border-radius: 100px; 
    padding: 3px 8px; 
    font-size: 10px;
  }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Kurikulum</h5>
        </div>
        <div class="col-md-6" style="text-align: right;">
          <?php if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2){ ?>
            <a href="<?= site_url('tambah-kurikulum'); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah</a>
          <?php } ?>
          <a href="#" data-toggle="modal" data-target="#filter" class="btn btn-warning btn-sm" title="Filter"><i class="fas fa-fw fa-filter"></i> Filter</a>
        </div>
      </div>
    </div>
    <div class="card-body" style="padding: 10px">
      <div class="row" style="border-bottom: 1px solid #e3e6f0;">
        <?php if($this->session->userdata('id_role') == 1){ ?>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=permohonan-pengajuan'); ?>" class = "aktif">
              <div class="box verifikasi <?php if($this->input->get('status') == 'permohonan-pengajuan'){ echo "aktif"; } ?>">
                Verifikasi <?php if($this->session->userdata('id_role') == 1){ if($permohonan_pengajuan > 0){ ?><span class="jumlah_notif_status"><?= $permohonan_pengajuan; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=penyusunan-kurikulum'); ?>" class = "aktif">
              <div class="box penyusunan <?php if($this->input->get('status') == 'penyusunan-kurikulum'){ echo "aktif"; } ?>">
                Penyusunan
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=pengesahan-kurikulum'); ?>" class = "aktif">
              <div class="box pengesahan <?php if($this->input->get('status') == 'pengesahan-kurikulum'){ echo "aktif"; } ?>">
                Pengesahan <?php if($this->session->userdata('id_role') == 1){ if($pengesahan_kurikulum > 0){ ?><span class="jumlah_notif_status"><?= $pengesahan_kurikulum; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=selesai'); ?>" class = "aktif">
              <div class="box selesai <?php if($this->input->get('status') == 'selesai'){ echo "aktif"; } ?>">
                Selesai
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=kirim-siakpel'); ?>" class = "aktif">
              <div class="box siakpel <?php if($this->input->get('status') == 'kirim-siakpel'){ echo "aktif"; } ?>">
                SIAKPEL
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=dihentikan'); ?>" class = "aktif">
              <div class="box dihentikan <?php if($this->input->get('status') == 'dihentikan'){ echo "aktif"; } ?>">
                Dihentikan
              </div>
            </a>
          </div>
        <?php } ?>
        <?php if($this->session->userdata('id_role') == 5){ ?>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=permohonan-pengajuan'); ?>" class = "aktif">
              <div class="box verifikasi <?php if($this->input->get('status') == 'permohonan-pengajuan'){ echo "aktif"; } ?>">
                Verifikasi <?php if($this->session->userdata('id_role') == 5){ if($verifikasi > 0){ ?><span class="jumlah_notif_status"><?= $verifikasi; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=penyusunan-kurikulum'); ?>" class = "aktif">
              <div class="box penyusunan <?php if($this->input->get('status') == 'penyusunan-kurikulum'){ echo "aktif"; } ?>">
                Penyusunan
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=selesai'); ?>" class = "aktif">
              <div class="box selesai <?php if($this->input->get('status') == 'selesai'){ echo "aktif"; } ?>">
                Selesai
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=dihentikan'); ?>" class = "aktif">
              <div class="box dihentikan <?php if($this->input->get('status') == 'dihentikan'){ echo "aktif"; } ?>">
                Dihentikan
              </div>
            </a>
          </div>
          <!-- <div class="col-md-4">
            <a href="<?= site_url('kurikulum/?status=verifikasi-kesesuaian'); ?>" class = "aktif">
              <div class="box verifikasi <?php if($this->input->get('status') == 'verifikasi-kesesuaian'){ echo "aktif"; } ?>">
                Verifikasi Kesesuaian <?php if($this->session->userdata('id_role') == 5){ if($verifikasi_kesesuaian > 0){ ?><span class="jumlah_notif_status"><?= $verifikasi_kesesuaian; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="<?= site_url('kurikulum/?status=perbaikan-kesesuaian'); ?>" class = "aktif">
              <div class="box perbaikan <?php if($this->input->get('status') == 'perbaikan-kesesuaian'){ echo "aktif"; } ?>">
                Perbaikan Kesesuaian
              </div>
            </a>
          </div> -->
        <?php } ?>
        <?php if($this->session->userdata('id_role') == 6){ ?>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=verifikasi-kesesuaian'); ?>" class = "aktif">
              <div class="box verifikasi <?php if($this->input->get('status') == 'verifikasi-kesesuaian'){ echo "aktif"; } ?>">
                Verifikasi Kesesuaian <?php if($this->session->userdata('id_role') == 6){ if($verifikasi_kesesuaian > 0){ ?><span class="jumlah_notif_status"><?= $verifikasi_kesesuaian; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=perbaikan-kesesuaian'); ?>" class = "aktif">
              <div class="box perbaikan <?php if($this->input->get('status') == 'perbaikan-kesesuaian'){ echo "aktif"; } ?>">
                Perbaikan Kesesuaian
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=pilih-penilai'); ?>" class = "aktif">
              <div class="box pilih_penilai <?php if($this->input->get('status') == 'pilih-penilai'){ echo "aktif"; } ?>">
                Pilih Penilai <?php if($this->session->userdata('id_role') == 6){ if($pilih_penilai > 0){ ?><span class="jumlah_notif_status"><?= $pilih_penilai; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=pengesahan-kurikulum'); ?>" class = "aktif">
              <div class="box pengesahan <?php if($this->input->get('status') == 'pengesahan-kurikulum'){ echo "aktif"; } ?>">
                Pengesahan <?php if($this->session->userdata('id_role') == 6){ if($pengesahan_kurikulum > 0){ ?><span class="jumlah_notif_status"><?= $pengesahan_kurikulum; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=selesai'); ?>" class = "aktif">
              <div class="box selesai <?php if($this->input->get('status') == 'selesai'){ echo "aktif"; } ?>">
                Selesai
              </div>
            </a>
          </div>
        <?php } ?>
        <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ ?>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=permohonan-pengajuan'); ?>" class = "aktif">
              <div class="box pengajuan <?php if($this->input->get('status') == 'permohonan-pengajuan'){ echo "aktif"; } ?>">
                Pengajuan
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=isi-kelengkapan'); ?>" class = "aktif">
              <div class="box isi_kelengkapan <?php if($this->input->get('status') == 'isi-kelengkapan'){ echo "aktif"; } ?>">
                Isi Kelengkapan <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ if($isi_kelengkapan > 0){ ?><span class="jumlah_notif_status"><?= $isi_kelengkapan; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=verifikasi-kesesuaian'); ?>" class = "aktif">
              <div class="box verifikasi <?php if($this->input->get('status') == 'verifikasi-kesesuaian'){ echo "aktif"; } ?>">
                Verifikasi Kelengkapan
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=penilaian-kurikulum'); ?>" class = "aktif">
              <div class="box penilaian <?php if($this->input->get('status') == 'penilaian-kurikulum'){ echo "aktif"; } ?>">
                Penilaian
              </div>
            </a>
          </div>
          <div class="col-md-2">
            <a href="<?= site_url('kurikulum/?status=perbaikan-kurikulum'); ?>" class = "aktif">
              <div class="box perbaikan <?php if($this->input->get('status') == 'perbaikan-kurikulum'){ echo "aktif"; } ?>">
                Perbaikan <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ if($perbaikan_kurikulum > 0){ ?><span class="jumlah_notif_status"><?= $perbaikan_kurikulum; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-12"><hr></div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=upload-cover'); ?>" class = "aktif">
              <div class="box upload_cover <?php if($this->input->get('status') == 'upload-cover'){ echo "aktif"; } ?>">
                Upload Cover <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ if($upload_cover > 0){ ?><span class="jumlah_notif_status"><?= $upload_cover; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=pengesahan-kurikulum'); ?>" class = "aktif">
              <div class="box pengesahan <?php if($this->input->get('status') == 'pengesahan-kurikulum'){ echo "aktif"; } ?>">
                Pengesahan
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=selesai'); ?>" class = "aktif">
              <div class="box selesai <?php if($this->input->get('status') == 'selesai'){ echo "aktif"; } ?>">
                Selesai & SIAKPEL
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=dihentikan'); ?>" class = "aktif">
              <div class="box dihentikan <?php if($this->input->get('status') == 'dihentikan'){ echo "aktif"; } ?>">
                Dihentikan
              </div>
            </a>
          </div>
        <?php } ?>
        <?php if($this->session->userdata('id_role') == 3){ ?>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=penilaian-kurikulum'); ?>" class = "aktif">
              <div class="box penilaian <?php if($this->input->get('status') == 'penilaian-kurikulum'){ echo "aktif"; } ?>">
                Penilaian <?php if($this->session->userdata('id_role') == 3){ if($penilaian_kurikulum > 0){ ?><span class="jumlah_notif_status"><?= $penilaian_kurikulum; ?></span><?php } } ?>
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=perbaikan-kurikulum'); ?>" class = "aktif">
              <div class="box perbaikan <?php if($this->input->get('status') == 'perbaikan-kurikulum'){ echo "aktif"; } ?>">
                Perbaikan
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=selesai'); ?>" class = "aktif">
              <div class="box selesai <?php if($this->input->get('status') == 'selesai'){ echo "aktif"; } ?>">
                Selesai & SIAKPEL
              </div>
            </a>
          </div>
          <div class="col-md-3">
            <a href="<?= site_url('kurikulum/?status=dihentikan'); ?>" class = "aktif">
              <div class="box dihentikan <?php if($this->input->get('status') == 'dihentikan'){ echo "aktif"; } ?>">
                Dihentikan
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
      <br>
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Status</th>
                <th>Institusi</th>
                <th>pj substansi</th>
                <th>Judul</th>
                <th>
                  <?php 
                    if($this->input->get('status') == 'dihentikan'){ echo "Keterangan"; }
                    else{ echo "Aksi"; }
                  ?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($kurikulum as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><?= $key->keterangan_status; ?></td>
                  <td><?= $key->nama_institusi; ?></td>
                  <td>
                    <?= $key->id_sdm_institusi; ?>
                    <?= $key->nama_sdm; ?>
                  </td>
                  <td><?= $key->judul; ?></td>
                  <td>
                    <?php 
                      if($key->status == 0)
                      {
                        if($key->dihentikan_oleh == 0){ $dihentikan_oleh = "Sistem"; }
                        else
                        {
                          $get_user = $this->M_entitas->selectX('user', array('id_user' => $key->dihentikan_oleh))->row();
                          $dihentikan_oleh = $get_user->role;
                        }
                        echo 
                        "<p style = 'text-align: left;'>Dihentikan Oleh : <b>".$dihentikan_oleh."</b></p>".
                        "<p style = 'text-align: left;'>Alasan dihentikan : <b>".$key->alasan_dihentikan."</b> <a href='#' data-id='".$key->id_kurikulum."' class = 'detail-dihentikan' style = 'color: red;'><i class='fa fa-info-circle'></i></a></p>";
                        if($key->status_dihentikan == 3)
                        {
                          if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4)
                          {
                            echo "<a href='".site_url("konfirmasi-kelanjutan-penyusunan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."' class = 'btn btn-info btn-sm'> Konfirmasi Kelanjutan Penyusunan Kurikulum</a>";
                          }
                        }
                        if($key->status_dihentikan == 4)
                        {
                          if($this->session->userdata('id_role') == 1)
                          {
                            echo "<a href='".site_url("verifikasi-permohonan-kelanjutan-penyusunan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."' class = 'btn btn-info btn-sm'> Verifikasi Permohonan Kelanjutan Penyusunan Kurikulum</a>";
                          }
                        }
                      }
                      else if($key->status == 1)
                      {
                        if($this->session->userdata('id_role') == 1)
                        {
                          echo "<a href='".site_url("verifikasi-kebutuhan-pelatihan/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: chocolate; border-color: chocolate;'"."><i class='fa fa-check-circle'></i> Verifikasi</a>";
                          echo "<br>";
                          echo "<a href='".site_url("ubah-pengajuan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-warning btn-sm'". "style='color: #000; margin-top: 10px;'"."><i class='fa fa-pen'></i> Ubah Pengajuan Kurikulum</a>";
                        }
                        else if($this->session->userdata('id_role') == 5)
                        {
                          echo "<a href='".site_url("verifikasi-kebutuhan-pelatihan/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: chocolate; border-color: chocolate;'"."><i class='fa fa-check-circle'></i> Verifikasi</a>";
                        }
                        else if($this->session->userdata('id_role') == 2)
                        {
                          echo "<a href='".site_url("ubah-pengajuan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-warning btn-sm'". "style='color: #000;'"."><i class='fa fa-pen'></i> Ubah Pengajuan Kurikulum</a>";
                        }
                      }
                      else if($key->status == 2)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5)
                        {
                          echo "<a href='".site_url("verifikasi-ketersediaan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: chocolate; border-color: chocolate;'"."><i class='fa fa-check-circle'></i> Verifikasi Ketersediaan Kurikulum</a>";
                        }
                      }
                      else if($key->status == 3)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                      }
                      else if($key->status == 4)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 6)
                        {
                          echo "<a href='".site_url("pengecekan-kesesuaian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: chocolate; border-color: chocolate;'"."><i class='fa fa-check-circle'></i> Cek Kesesuaian</a>";
                        }
                        else if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                      }
                      else if($key->status == 5)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                      }
                      else if($key->status == 6)
                      {
                        if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                        else if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 6)
                        {
                          echo "<a href='".site_url("pemilihan-penilai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: mediumorchid; border-color: mediumorchid;'"."><i class='fa fa-search'></i> Pilih Penilai</a>";
                          if($key->is_ubah_penilai == 1)
                          {
                            echo "<br>";
                            echo "<span style = 'color: red'>*</span>Penilai sebelumnya tidak melakukan penilaian sampai batas waktu yang telah diberikan";
                          }
                        }
                      }
                      else if($key->status == 7)
                      {
                        if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                        else if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 3)
                        {
                          echo "<a href='".site_url("penilaian-penilai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: orangered; border-color: orangered;'"."><i class='fa fa-star'></i> Beri Penilaian</a>";
                        }
                      }
                      else if($key->status == 8)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("list-pengisian-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: #9d4edf; border-color: #9d4edf;'"."><i class='fa fa-list'></i> List Pengisian Kurikulum</a>";
                        }
                        else if($this->session->userdata('id_role') == 3)
                        {
                          echo "<a href='".site_url("penilaian-penilai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: orangered; border-color: orangered;'"."><i class='fa fa-star'></i> Lihat Penilaian</a>";
                        }
                      }
                      else if($key->status == 9)
                      {
                        if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("upload-cover-kata-pengantar/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: peru; border-color: peru;'"."><i class='fa fa-upload'></i> Upload Cover dan Kata Pengantar</a>";
                        }
                        else if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3)
                        {
                          echo "<a href='".site_url("detail-kurikulum-selesai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: blue; border-color: blue;'"."><i class='fa fa-info-circle'></i> Detail</a>";
                        }
                      }
                      else if($key->status == 10)
                      {
                        if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4)
                        {
                          echo "<a href='".site_url("detail-kurikulum-selesai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: blue; border-color: blue;'"."><i class='fa fa-info-circle'></i> Detail</a>";
                          echo "<br>";
                          echo "<a href='".site_url("upload-cover-kata-pengantar/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: peru; border-color: peru; margin-top: 10px;'"."><i class='fa fa-upload'></i> Ubah Cover dan Kata Pengantar</a>";
                        }
                        else if($this->session->userdata('id_role') == 3)
                        {
                          echo "<a href='".site_url("detail-kurikulum-selesai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: blue; border-color: blue;'"."><i class='fa fa-info-circle'></i> Detail</a>";
                        }
                        else if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 6)
                        {
                          echo "<a href='".site_url("pengesahan-kurikulum/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: forestgreen; border-color: forestgreen;'"."><i class='fa fa-gavel'></i> Pengesahan Kurikulum</a>";
                        }
                      }
                      else if($key->status == 11)
                      {
                        echo "<a href='".site_url("detail-kurikulum-selesai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: blue; border-color: blue;'"."><i class='fa fa-info-circle'></i> Detail</a>";
                        if($this->session->userdata('id_role') == 1)
                        {
                          echo "<br>";
                          echo "<a href='#' data-id = '".bin2hex(base64_encode($key->id_kurikulum))."' class='kirim_kurikulum_siakpel btn btn-info btn-sm'". "style='margin-top: 10px;'"."><i class='fa fa-paper-plane'></i> Kirim Kurikulum Ke SIAKPEL</a>";
                        }
                      }
                      else if($key->status == 12)
                      {
                        echo "<a href='".site_url("detail-kurikulum-selesai/".bin2hex(base64_encode($key->id_kurikulum)))."'". "class='btn btn-info btn-sm'". "style='background-color: blue; border-color: blue;'"."><i class='fa fa-info-circle'></i> Detail</a>";
                      }
                    ?>
                    <?php if($this->session->userdata('is_admin_acp') == 1){ ?>
                      <br><br>
                      <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_kurikulum)); ?>" class = "hapus_kurikulum btn btn-danger btn-sm" title = "Delete"><i class="fa fa-trash"></i> Hapus</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div></div>
<div class="modal fade" id="detail-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Kurikulum</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="filter" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Filter</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="<?= site_url('kurikulum') ?>" method = "get" style = "color: #000;">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12" style="margin-bottom: 3%">
              <label>Tanggal Pengajuan</label>
              <input type="date" name="tgl_pengajuan" class="form-control" value="<?= $tgl_pengajuan_isi; ?>">
            </div>
            <?php if($this->session->userdata('id_role') == 1){ ?>
              <div class="col-sm-12" style="margin-bottom: 3%">
                <label>Institusi</label>
                <select name="id_institusi" class="form-control select2" style="width: 100%;">
                  <option value="">-- Pilih Institusi--</option>
                  <?php foreach ($institusi as $key) { ?>
                    <option value="<?= $key->id_institusi; ?>" <?php if($id_institusi_isi == $key->id_institusi){ echo "selected"; } ?>><?= $key->nama_institusi; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-12" style="margin-bottom: 3%">
                <label>Penilai</label>
                <select name="id_penilai" class="form-control select2" style="width: 100%;">
                  <option value="">-- Pilih Penilai--</option>
                  <?php foreach ($penilai as $key) { ?>
                    <option value="<?= $key->id_penilai; ?>" <?php if($id_penilai_isi == $key->id_penilai){ echo "selected"; } ?>><?= $key->nama_penilai; ?></option>
                  <?php } ?>
                </select>
              </div>
            <?php } ?>
            <div class="col-md-12">
              <label>Judul</label>
              <input type="text" name="judul" class="form-control" value="<?= $judul_isi; ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-sm-12 col-md-12 text-right">
            <span class="input-group-btn">
              <input type="hidden" name="status" value="<?= $this->input->get('status'); ?>">
              <button class="btn btn-warning pull-right btn-sm" type="submit" title="Filter"><i class="fa fa-filter fa-fw"></i> Filter</button>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-dihentikan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Dihentikan</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_dihentikan"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.hapus_kurikulum',function(e)

    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('Kurikulum/hapus_kurikulum/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
</script>
<script type="text/javascript">
    $(document).on('click','.kirim_kurikulum_siakpel',function(e)
    {
        swal({
          title: "Kirim Kurikulum ini Ke SiAkpel ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terkirim", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('kirim-kurikulum-siakpel/'); ?>/'+id,
          success: function(data) {
            window.location = "<?= site_url('kurikulum-sah'); ?>";
        }
    });
        
    } else {
        swal("Gagal Mengirim Kurikulum Ke SiAkpel");
    }
});
    });
</script>
<script type="text/javascript">
    $(document).on('click','.hapus',function(e)
    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('hapus-penilai/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.detail-kurikulum', function (e) {
            e.preventDefault();
            $("#detail-kurikulum").modal('show');
            $.post('<?= site_url('Kurikulum/get_detail_kurikulum');?>',
                {id: $(this).attr('data-id')},
                function (html) { $(".body_detail_kurikulum").html(html); }
            );
        });
    });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-dihentikan', function (e) {
      e.preventDefault();
      $("#detail-dihentikan").modal('show');
      $.post('<?= site_url('Kurikulum/get_detail_dihentikan');?>',
        {id: $(this).attr('data-id')},
        function (html) { $(".body_detail_dihentikan").html(html); }
      );
    });
  });
</script>
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