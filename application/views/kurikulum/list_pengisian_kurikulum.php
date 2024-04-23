<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; text-align:center; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: lightblue; border-color: lightblue;
   border-radius: 5px; text-align:center; color: #000; box-shadow :0 0 20px rgb(0 0 0 / 20%) } 
   .box:hover { border: 1px solid #1f3384;}
   a:hover{text-decoration:none; }
   .aktif{ background-color:coral; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">List Pengisian Kurikulum</h5>
        </div>
        <div class="col-md-6" style="text-align: right;">
          <?php if($kurikulum->status >= 7){ ?>
            <?php $cek_request = $this->M_entitas->selectX('request_hub_penilai', array('id_kurikulum' => $kurikulum->id_kurikulum))->result(); if($cek_request){ $rq = "disabled"; } else { $rq = ""; } ?>
            <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" class = "ajukan_request btn btn-info <?= $rq; ?>" title = "Ajukan Request" style="background-color: #4232d0; border-color: #4232d0; color: #fff;"><b><i class="fa fa-phone"></i> Request Hubungi Penilai</b></a>
          <?php } ?>
          <a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a>
        </div>
      </div>
    </div>
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <span style="background-color: blue; padding: 8px; border-radius: 5px; color: #fff;"><b>Status : <?= $kurikulum->keterangan_status; ?></b></span><br><br>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-info">
              <h5><b><i class="fa fa-exclamation-triangle"></i> Informasi Penyusunan Kurikulum</b></h5>
              <table width="100%">
                <tr>
                  <td style="padding: 5px;">1.</td>
                  <td style="padding: 5px;">Penyusunan kurikulum dilakukan selama <b>2 bulan</b>, termasuk dengan penilaian oleh tim penilai.</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">2.</td>
                  <td style="padding: 5px;"><b>Waktu penyusunan kurikulum</b> dimulai setelah pemilihan tim penilai.</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">3.</td>
                  <td style="padding: 5px;"><b>Tidak ada perpanjangan waktu penyusunan kurikulum.</b></td>
                </tr>
                <tr>
                  <td style="padding: 5px;">4.</td>
                  <td style="padding: 5px;">Penyusun dapat <b>mengirimkan draft kurikulum</b> setelah kurikulum <b>dilengkapi</b>.</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">5.</td>
                  <td style="padding: 5px;">Kurikulum yang <b>tidak lengkap / tidak sesuai</b> akan <b>dikirimkan kembali</b> ke penyusun untuk dilengkapi/disesuaikan.</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">6.</td>
                  <td style="padding: 5px;">Pengiriman draft kurikulum diberikan waktu selama <b>5 hari kerja</b> (sabtu, minggu dan tanggal merah tidak terhitung).</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">7.</td>
                  <td style="padding: 5px;">Apabila penyusun telat mengirimkan draft kurikulum, penyusun diberikan kesempatan untuk melanjutkan penyusunan kurikulum dengan memintan request kepada tim admin. <b>Kesempatan</b> hanya akan diberikan selama <b>5 hari kerja</b>.</td>
                </tr>
                <tr>
                  <td style="padding: 5px;">8.</td>
                  <td style="padding: 5px;">Penyusun dapat <b>membatalkan penyusunan kurikulum</b> apabila penyusun telat mengirimkan draft kurikulum dengan <b>memberikan konfirmasi</b> terlebih dahulu.</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <hr>
            <h5><b>Timeline Penyusunan Kurikulum</b></h5><br>
            <table width="100%" border="1">
              <tr>
                <th><b>Timeline</b></th>
                <th><b>Deadline</b></th>
                <th><b>Status</b></th>
                <th><b>Tanggal Pengiriman</b></th>
              </tr>
              <tr>
                <td>Pengajuan</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;"><i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i></td>
                <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></b></td>
              </tr>
              <tr>
                <td>Verifikasi Admin</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">
                  <?php if($kurikulum->status >= 3){ ?>
                    <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                  <?php } ?>
                </td>
                <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></b></td>
              </tr>
              <?php if($kurikulum->status >= 6){ ?>
                <tr>
                  <td>Penyusunan Kurikulum</td>
                  <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></b></td>
                  <td style="text-align: center;">
                    <?php if($kurikulum->status < 11){ ?>
                      <i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i>
                    <?php } ?>
                    <?php if($kurikulum->status >= 11){ ?>
                      <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                    <?php } ?>
                  </td>
                  <td style="text-align: center;">
                    <b><?php if($kurikulum->status >= 11){ echo tanggal_indo($kurikulum->tgl_pengesahan); } else { echo "-"; } ?></b>
                  </td>
                </tr>
              <?php } ?>
              <?php if($kurikulum->status == 3){ ?>
                <tr>
                  <td>Pengiriman Draft ke-1</td>
                  <td style="text-align: center; font-weight: bolder;">
                    <?php 
                      if($kurikulum->alasan_hentikan_sistem == 1)
                      {
                        if($kurikulum->tambahan_waktu)
                        {
                          $total_tambah_waktu = $kurikulum->tambahan_waktu * 7;
                          $tanggal_deadline_isi = date('Y-m-d', strtotime('+'.$total_tambah_waktu.' days', strtotime($kurikulum->verif_at)));
                        }
                        else
                        {
                          $tanggal_deadline_isi = $kurikulum->verif_at;
                        }
                      }
                      else
                      {
                        $tanggal_deadline_isi = $kurikulum->verif_at;
                      }
                      
                      $get_deadline = $this->M_entitas->get_deadline($tanggal_deadline_isi); 
                      echo tanggal_indo($get_deadline);
                    ?>    
                  </td>
                  <td style="text-align: center;"><i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i></td>
                  <td style="text-align: center; font-weight: bolder;">-</td>
                </tr>
              <?php } ?>
              <?php if($kurikulum->status > 3){ ?>
                <?php if($draft){ $jmlh_draft = 0; foreach ($draft as $key) { ?>
                  <tr>
                    <td>Pengiriman Draft Ke-<?= $key->draft_ke; ?></td>
                    <td style="text-align: center; font-weight: bolder;">
                      <?php
                        if($key->draft_ke == 1)
                        {
                          $get_deadline = $this->M_entitas->get_deadline($kurikulum->verif_at);
                          echo tanggal_indo($get_deadline);
                        }
                        else
                        {
                          $draft_sebelumnya = $jmlh_draft - 1;
                          $updated_at_sebelumnya = $draft[$draft_sebelumnya]->updated_at;
                          $get_deadline = $this->M_entitas->get_deadline($updated_at_sebelumnya);
                          echo tanggal_indo($get_deadline);
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                    </td>
                    <td style="text-align: center; font-weight: bold;">
                      <?= tanggal_indo(date('Y-m-d', strtotime($key->created_at))); ?>
                    </td>
                  </tr>
                <?php $jmlh_draft++; } } ?>
              <?php } ?>
              <?php if($kurikulum->status > 3 && $kurikulum->status < 6){ ?>
                <?php if($draft[$jumlah_draft-1]->status == 2){ ?>
                  <tr>
                    <td>Pengiriman Draft ke-<?= $jumlah_draft+1; ?></td>
                    <td style="text-align: center; font-weight: bolder;">
                      <?php 
                        $draft_sebelumnya = $draft[$jumlah_draft-1];
                        $updated_at_sebelumnya = $draft[$jumlah_draft-1]->updated_at;
                        $get_deadline = $this->M_entitas->get_deadline($updated_at_sebelumnya);
                        echo tanggal_indo($get_deadline);
                      ?>
                    </td>
                    <td style="text-align: center;"><i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i></td>
                    <td style="text-align: center; font-weight: bolder;">-</td>
                  </tr>
                <?php } ?>
              <?php } ?>
              <?php if($kurikulum->status == 8){ ?>
                <tr>
                  <td>Pengiriman Draft ke-<?= $jumlah_draft+1; ?></td>
                  <td style="text-align: center; font-weight: bolder;">
                    <?php 
                      $draft_sebelumnya = $draft[$jumlah_draft-1];
                      $updated_at_sebelumnya = $draft[$jumlah_draft-1]->updated_at;
                      $get_deadline = $this->M_entitas->get_deadline($updated_at_sebelumnya);
                      echo tanggal_indo($get_deadline);
                    ?>
                  </td>
                  <td style="text-align: center;"><i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i></td>
                  <td style="text-align: center; font-weight: bolder;">-</td>
                </tr>
              <?php } ?>
            </table>
            <br>
          </div>
          <div class="col-md-12">
            <hr>
            <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ ?>
              <div class="row">
                <div class="col-md-6">
                  <h5><b>Informasi Kurikulum</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <a href="<?= site_url('ubah-informasi-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Ubah</a>
                </div>
              </div>
            <?php } ?>
            <?php if($this->session->userdata('id_role') != 2 && $this->session->userdata('id_role') != 4){ ?>
              <h5><b>Informasi Kurikulum</b></h5>
            <?php } ?>
            <br>
            <table width="100%">
              <tr>
                <td style="width: 15%;">Judul Kurikulum</td>
                <td style="width: 1%;">:</td>
                <td><b><?= $kurikulum->judul; ?></b></td>
              </tr>
              <tr>
                <td>Institusi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_institusi; ?></b></td>
              </tr>
              <tr>
                <td>pj substansi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_sdm; ?></b></td>
              </tr>
              <tr>
                <td>JPL</td>
                <td>:</td>
                <td><b><?= $kurikulum->jumlah_jpl; ?></b></td>
              </tr>
              <tr>
                <td>KAK/TOR</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank">KAK TOR</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Surat Pengantar</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Pengantar</a>
                  <?php } ?>
                </td>
              </tr>
              <?php if($kurikulum->status >= 8){ ?>
                <tr>
                  <td>Penilai</td>
                  <td>:</td>
                  <td><b><?= $kurikulum->nama_penilai; ?></b></td>
                </tr>
              <?php } ?>
            </table>
            <hr>
          </div>
          <div class="col-md-12">
            <h5><b>Penyusunan Kurikulum</b></h5><br>
            <table border="1" width="100%">
              <tr style="background-color: burlywood;">
                <th style="width: 2%;">No.</th>
                <th style="width: 35%;">Bab & Sub Bab</th>
                <th>Proses</th>
                <th>Terakhir Di Update</th>
                <th>Status</th>
                <th>
                  <?php 
                    if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4){ echo "Aksi"; } 
                    else{ echo "Detail"; }
                  ?>
                </th>
                <th>Pengecekan & Penilaian</th>
              </tr>
              <?php $no = 1; foreach ($bab as $key) {  ?>
                <tr <?php if($key->is_isi == 0){ ?> style = "background-color: gainsboro;" <?php } ?>>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><b><?= $key->bab." ".$key->judul; ?></b></td>
                  <td style="text-align: center;">
                    <?php 
                      if($key->is_isi){
                        $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row();
                        if($cek_bab)
                        { 
                          echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>"; 
                        }
                        else
                        {
                          echo "<i class = 'fa fa-times-circle' style = 'color: red; font-size: 25px;'></i>";
                        }
                      }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <b>
                      <?php 
                        if($key->is_isi == 1)
                        {
                          $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row();
                          if($cek_bab)
                          { 
                            echo tanggal_indo(date('Y-m-d', strtotime($cek_bab->last_updated))); 
                          }
                        }
                      ?>
                    </b>
                  </td>
                  <td style="text-align: center;">
                    <?php 
                      $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row();
                      if($cek_bab)
                      {
                        if($cek_bab->status == 1){ echo "<span style='background-color: brown; color: #fff; padding: 5px 10px; border-radius: 5px;'><b>Draft</b></span>"; } 
                        else if($cek_bab->status == 2) { echo "<span style='background-color: #75f63e; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Terkirim</b></span>"; }
                        else if($cek_bab->status == 3) { echo "<span style='background-color: #ff6a6a; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Tidak Sesuai</b></span>"; }
                        else if($cek_bab->status == 4) { echo "<span style='background-color: #2bf5bf; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Sesuai</b></span>"; }
                        else if($cek_bab->status == 5) { echo "<span style='background-color: #baffaa; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Telah Diperbaiki</b></span>"; }
                        else if($cek_bab->status == 6) { echo "<span style='background-color: #ff6a6a; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Butuh Perbaikan</b></span>"; }
                        else if($cek_bab->status == 7) { echo "<span style='background-color: #2bf5bf; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Diterima</b></span>"; }
                        else if($cek_bab->status == 8) { echo "<span style='background-color: #baffaa; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Telah Diperbaiki</b></span>"; }
                        else if($cek_bab->status == 9) { echo "<span style='background-color: #75f63e; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Terkirim</b></span>"; }
                      }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <?php if($key->is_isi == 1){ ?>
                      <?php if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4){ ?>
                        <?php $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row(); ?>
                        <?php if(!$cek_bab){ ?>
                          <a href="<?= site_url('isi-bab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($key->id_bab))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Isi</a>
                        <?php } ?>
                        <?php if($cek_bab){ if($cek_bab->status == 1 || $cek_bab->status == 3 || $cek_bab->status == 5 || $cek_bab->status == 6 || $cek_bab->status == 8){ ?>
                          <a href="<?= site_url('isi-bab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($key->id_bab))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Ubah</a>
                        <?php } } ?>
                        <?php if($cek_bab){ if($cek_bab->status == 2 || $cek_bab->status == 4 || $cek_bab->status == 7 || $cek_bab->status == 9){ ?>
                          <a href="#" class="btn btn-info btn-sm btn-sasaran detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        <?php } } ?>
                      <?php } ?>
                      <?php if($this->session->userdata('id_role') != 1 && $this->session->userdata('id_role') != 4){ ?>
                        <a href="#" class="btn btn-info btn-sm btn-sasaran detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                      <?php } ?>
                    <?php } ?>
                  </td>
                  <td style="text-align: center;">
                    <?php if($kurikulum->status > 5){ ?>
                      <?php if($key->is_isi){ ?>
                        <?php 
                          $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row(); 
                          if($cek_bab)
                          {
                            $catatan_bab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_bab->id_list_pengerjaan_kurikulum))->num_rows();
                            if($catatan_bab)
                            {
                              echo "<a href='".site_url("list-penilaian/".bin2hex(base64_encode($cek_bab->id_list_pengerjaan_kurikulum)))."' class='btn btn-info btn-sm' style='background-color: blueviolet; border-color: blueviolet;'><i class='fa fa-star'></i> Lihat Catatan</a>";
                            }
                            else{ echo "Tidak ada catatan"; }
                          }
                        ?>
                      <?php } ?>
                    <?php } ?>
                  </td>
                </tr>
                <?php $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab, 'status' => 1))->result(); if($sub_bab){ $no_sb = "a"; foreach ($sub_bab as $sb) { ?>
                  <tr>
                    <td></td>
                    <td><?= $no_sb++.". ".$sb->sub_bab; ?></td>
                    <td style="text-align: center;">
                      <?php 
                        $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                        if($cek_subbab)
                        { 
                          echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>"; 
                        }
                        else
                        {
                          echo "<i class = 'fa fa-times-circle' style = 'color: red; font-size: 25px;'></i>";
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <b>
                        <?php 
                          $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                          if($cek_subbab)
                          { 
                            echo tanggal_indo(date('Y-m-d', strtotime($cek_subbab->last_updated))); 
                          }
                        ?>
                      </b>
                    </td>
                    <td style="text-align: center;">
                      <?php 
                        $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                        if($cek_subbab)
                        {
                          if($cek_subbab->status == 1){ echo "<span style='background-color: brown; color: #fff; padding: 5px 10px; border-radius: 5px;'><b>Draft</b></span>"; } 
                          else if($cek_subbab->status == 2) { echo "<span style='background-color: #75f63e; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Terkirim</b></span>"; }
                          else if($cek_subbab->status == 3) { echo "<span style='background-color: #ff6a6a; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Tidak Sesuai</b></span>"; }
                          else if($cek_subbab->status == 4) { echo "<span style='background-color: #2bf5bf; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Sesuai</b></span>"; }
                          else if($cek_subbab->status == 5) { echo "<span style='background-color: #baffaa; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Telah Diperbaiki</b></span>"; }
                          else if($cek_subbab->status == 6) { echo "<span style='background-color: #ff6a6a; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Butuh Perbaikan</b></span>"; }
                          else if($cek_subbab->status == 7) { echo "<span style='background-color: #2bf5bf; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Diterima</b></span>"; }
                          else if($cek_subbab->status == 8) { echo "<span style='background-color: #baffaa; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Telah Diperbaiki</b></span>"; }
                          else if($cek_subbab->status == 9) { echo "<span style='background-color: #75f63e; color: #000; padding: 5px 10px; border-radius: 5px;'><b>Terkirim</b></span>"; }
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4){ ?>
                        <?php $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row(); ?>
                        <?php if(!$cek_subbab){ ?>
                          <a href="<?= site_url('isi-subbab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($sb->id_sub_bab))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Isi</a>
                        <?php } ?>
                        <?php if($cek_subbab){ if($cek_subbab->status == 1 || $cek_subbab->status == 3 || $cek_subbab->status == 5  || $cek_subbab->status == 6 || $cek_subbab->status == 8){ ?>
                          <a href="<?= site_url('isi-subbab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($sb->id_sub_bab))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Ubah</a>
                        <?php } } ?>
                        <?php if($cek_subbab){ if($cek_subbab->status == 2 || $cek_subbab->status == 4 || $cek_subbab->status == 7 || $cek_subbab->status == 9){ ?>
                          <a href="#" class="btn btn-info btn-sm btn-sasaran detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        <?php } } ?>
                      <?php } ?>
                      <?php if($this->session->userdata('id_role') != 1 && $this->session->userdata('id_role') != 4){ ?>
                        <a href="#" class="btn btn-info btn-sm btn-sasaran detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                      <?php } ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if($kurikulum->status > 5){ ?>
                        <?php 
                          $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                          if($cek_subbab)
                          {
                            $catatan_subbab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_subbab->id_list_pengerjaan_kurikulum))->num_rows();
                            if($catatan_subbab)
                            {
                              echo "<a href='".site_url("list-penilaian/".bin2hex(base64_encode($cek_subbab->id_list_pengerjaan_kurikulum)))."' class='btn btn-info btn-sm' style='background-color: blueviolet; border-color: blueviolet;'><i class='fa fa-star'></i> Lihat Catatan</a>";
                            }
                            else{ echo "Tidak ada catatan"; }
                          }
                        ?>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } } ?>
              <?php } ?>
            </table>
          </div>
        </div>
        <?php if(date('Y-m-d') <= $get_deadline){ ?>
          <?php if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4){ ?>
            <?php if($kurikulum->status == 3 || $kurikulum->status == 5 || $kurikulum->status == 8){ ?>
              <?php $cek_perbaikan = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_pengecekan_penilaian' => 2, 'status' => 1))->num_rows(); ?>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-info alert-dismissible">
                    <b><i class="fa fa-info-circle"></i> <span>Cek kembali sebelum mengirimkan Kurikulum. Kurikulum yang sudah terkirim tidak dapat diubah selama proses pengecekan dan penilaian kurikulum.</span></b>
                  </div>
                </div>
                <div class="col-md-12" style="text-align: center;">
                  <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" class = "kirim_draft btn btn-info <?php if($cek_perbaikan > 0){ echo 'disabled'; } ?> " title = "Kirim Draft"><b><i class="fa fa-paper-plane"></i> Kirim Draft Kurikulum</b></a>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        <?php } ?>
        <?php if($kurikulum->status >= 8){ ?>
          <?php $get_request = $this->M_entitas->selectX('request_hub_penilai', array('id_kurikulum' => $kurikulum->id_kurikulum, 'status' => 2))->result(); if($get_request){ ?>
            <hr>
            <h5><b>Informasi Penilai</b></h5>
            <table width="100%">
              <tr>
                <td style="width: 20%;">Nama Penilai</td>
                <td style="width: 2%;">:</td>
                <td><?= $kurikulum->nama_penilai; ?></td>
              </tr>
              <tr>
                <td>Nomor Telp Penilai</td>
                <td>:</td>
                <td>
                  <?php 
                    $get_penilai = $this->M_entitas->selectX('penilai', array('id_penilai' => $kurikulum->id_penilai))->row();
                    echo $get_penilai->no_telp; 
                  ?>
                </td>
              </tr>
              <tr>
                <td>Email Penilai</td>
                <td>:</td>
                <td>
                  <?php 
                    $get_penilai = $this->M_entitas->selectX('penilai', array('id_penilai' => $kurikulum->id_penilai))->row();
                    echo $get_penilai->email; 
                  ?>
                </td>
              </tr>
            </table>
          <?php } ?>
        <?php } ?>
      </div>
    </div> 
  </div> 
</div> 
</div> 
<div class="modal fade" id="detail-bab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_bab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-subbab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_subbab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.kirim_draft',function(e)
  {
    swal({
      title: "Kirim Draft ?",
      text: "Apakah Anda yakin mengirim Draft Kurikulum ? Anda tidak dapat mengubah Kurikulum sampai Penilai melakukan penilaian terhadap Kurikulum Anda.",
      icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willSend) => {
      if (willSend) {
        var id = $(this).attr('data-id');
        swal("Data Terkirim", 
        {
          icon: "success",
          buttons: false
        });
        $.ajax({
          url: '<?= site_url('kirim-draft/'); ?>/'+id,
          success: function(data) {
            location.reload();
          }
        }); 
      } else {
        swal("Gagal Mengirim Draft");
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).on('click','.kirim_draft_perbaikan',function(e)
  {
    swal({
      title: "Kirim Draft ?",
      text: "Apakah Anda yakin mengirim Draft Kurikulum ? Anda tidak dapat mengubah Kurikulum sampai Penilai melakukan penilaian terhadap Kurikulum Anda.",
      icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willSend) => {
      if (willSend) {
        var id = $(this).attr('data-id');
        swal("Data Terkirim", 
        {
          icon: "success",
          buttons: false
        });
        $.ajax({
          url: '<?= site_url('kirim-draft-perbaikan-kurikulum/'); ?>/'+id,
          success: function(data) {
            location.reload();
          }
        }); 
      } else {
        swal("Gagal Mengirim Draft");
      }
    });
  });
</script>
<script type="text/javascript">
    $(document).on('click','.ajukan_request',function(e)
    {
        swal({
          title: "Ajukan Request ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Requested", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('request-hubungi-penilai/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal");
    }
});
    });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-bab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-bab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_bab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_bab: $(this).attr('data-bab'),},
        function (html) { $(".body_detail_bab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-subbab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-subbab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_subbab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_subbab: $(this).attr('data-subbab'),},
        function (html) { $(".body_detail_subbab_kurikulum").html(html); }
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