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
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab II Komponen Kurikulum</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <?php $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>c. Struktur Kurikulum</h5>
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Silahkan berikan penilaian terhadap Kurikulum yang telah diajukan.</b></span>
            </div>
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="background-color: lemonchiffon;">
                  <th rowspan="2" style="width: 1%;">NO</th>
                  <th rowspan="2" style="width: 45%;">MATERI</th>
                  <th colspan="3">WAKTU</th>
                  <th rowspan="2">JPL</th>
                  <th rowspan="2">Penilaian</th>
                </tr>
                <tr style="background-color: lemonchiffon;">
                  <th style="width: 10%;">T</th>
                  <th style="width: 10%;">P</th>
                  <th style="width: 10%;">PL</th>
                </tr>
              </thead>
              <tbody>
                <tr style="background-color: #d8d8d8;">
                  <td><b>A.</b></td>
                  <td colspan="6"><b>MATA PELATIHAN DASAR</b></td>
                </tr>
                <?php $no = 1; $t_d = 0; $p_d = 0; $pl_d = 0; $tot_jpl_d = 0; foreach ($materi_dasar as $key) { $t_d += $key->t; $p_d += $key->p; $pl_d += $key->pl;  ?>
                  <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><?= $key->materi; ?></td>
                    <td style="text-align: center;"><?= $key->t; ?></td>
                    <td style="text-align: center;"><?= $key->p; ?></td>
                    <td style="text-align: center;"><?= $key->pl; ?></td>
                    <td style="text-align: center;">
                      <?php 
                        $jpl = $key->t + $key->p + $key->pl;
                        echo $jpl;
                        $tot_jpl_d += $jpl;
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <a href="<?= site_url('penilaian-materi/'.bin2hex(base64_encode($key->id_materi)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" <?php if($key->catatan){ if($key->status_penilaian == 1){ ?> style = "color: #fff; background-color: #7459ff; border-color: #7459ff;" <?php } } ?> style = "color: #000;">
                        <i class="fa fa-pen"></i> <?php if($key->catatan){ if($key->status_penilaian == 1){ echo "Ubah Penilaian"; } else if($key->status_penilaian == 2){ echo "Berikan Penilaian"; } } else { echo "Berikan Penilaian"; } ?>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                  <td style="text-align: center;"><b><?= $t_d; ?></b></td>
                  <td style="text-align: center;"><b><?= $p_d; ?></b></td>
                  <td style="text-align: center;"><b><?= $pl_d; ?></b></td>
                  <td style="text-align: center;"><b><?= $tot_jpl_d; ?></b></td>
                  <td></td>
                </tr>
                </tr>
                <tr style="background-color: #d8d8d8;">
                  <td><b>B.</b></td>
                  <td colspan="6"><b>MATA PELATIHAN INTI</b></td>
                </tr>
                <?php $no = 1; $t_i = 0; $p_i = 0; $pl_i = 0; $tot_jpl_i = 0; foreach ($materi_inti as $key) { $t_i += $key->t; $p_i += $key->p; $pl_i += $key->pl; ?>
                  <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><?= $key->materi; ?></td>
                    <td style="text-align: center;"><?= $key->t; ?></td>
                    <td style="text-align: center;"><?= $key->p; ?></td>
                    <td style="text-align: center;"><?= $key->pl; ?></td>
                    <td style="text-align: center;">
                      <?php 
                        $jpl = $key->t + $key->p + $key->pl;
                        echo $jpl;
                        $tot_jpl_i += $jpl;
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <a href="<?= site_url('penilaian-materi/'.bin2hex(base64_encode($key->id_materi)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" <?php if($key->catatan){ if($key->status_penilaian == 1){ ?> style = "color: #fff; background-color: #7459ff; border-color: #7459ff;" <?php } } ?> style = "color: #000;">
                        <i class="fa fa-pen"></i> <?php if($key->catatan){ if($key->status_penilaian == 1){ echo "Ubah Penilaian"; } else if($key->status_penilaian == 2){ echo "Berikan Penilaian"; } } else { echo "Berikan Penilaian"; } ?>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                  <td style="text-align: center;"><b><?= $t_i; ?></b></td>
                  <td style="text-align: center;"><b><?= $p_i; ?></b></td>
                  <td style="text-align: center;"><b><?= $pl_i; ?></b></td>
                  <td style="text-align: center;"><b><?= $tot_jpl_i; ?></b></td>
                  <td></td>
                </tr>
                <tr style="background-color: #d8d8d8;">
                  <td><b>C.</b></td>
                  <td colspan="6"><b>MATA PELATIHAN PENUNJANG</b></td>
                </tr>
                <?php $no = 1; $t_p = 0; $p_p = 0; $pl_p = 0; $tot_jpl_p = 0; foreach ($materi_penunjang as $key) { $t_p += $key->t; $pl_p += $key->p; $pl_p += $key->pl; ?>
                  <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><?= $key->materi; ?></td>
                    <td style="text-align: center;"><?= $key->t; ?></td>
                    <td style="text-align: center;"><?= $key->p; ?></td>
                    <td style="text-align: center;"><?= $key->pl; ?></td>
                    <td style="text-align: center;">
                      <?php 
                        $jpl = $key->t + $key->p + $key->pl;
                        echo $jpl;
                        $tot_jpl_p += $jpl;
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <a href="<?= site_url('penilaian-materi/'.bin2hex(base64_encode($key->id_materi)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" <?php if($key->catatan){ if($key->status_penilaian == 1){ ?> style = "color: #fff; background-color: #7459ff; border-color: #7459ff;" <?php } } ?> style = "color: #000;">
                        <i class="fa fa-pen"></i> <?php if($key->catatan){ if($key->status_penilaian == 1){ echo "Ubah Penilaian"; } else if($key->status_penilaian == 2){ echo "Berikan Penilaian"; } } else { echo "Berikan Penilaian"; } ?>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                  <td style="text-align: center;"><b><?= $t_p; ?></b></td>
                  <td style="text-align: center;"><b><?= $p_p; ?></b></td>
                  <td style="text-align: center;"><b><?= $pl_p; ?></b></td>
                  <td style="text-align: center;"><b><?= $tot_jpl_p; ?></b></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: center;"><b>JUMLAH</b></td>
                  <td style="text-align: center;">
                    <b>
                      <?php 
                        $jumlah_t = $t_d + $t_i + $t_p;
                        echo $jumlah_t;
                      ?>
                    </b>
                  </td>
                  <td style="text-align: center;">
                    <b>
                      <?php 
                        $jumlah_p = $p_d + $p_i + $p_p;
                        echo $jumlah_p;
                      ?>
                    </b>
                  </td>
                  <td style="text-align: center;">
                    <b>
                      <?php 
                        $jumlah_pl = $pl_d + $pl_i + $pl_p;
                        echo $jumlah_pl;
                      ?>
                    </b>
                  </td>
                  <td style="text-align: center;">
                    <b>
                      <?php 
                        $jumlah_total = $tot_jpl_d + $tot_jpl_i + $tot_jpl_p;
                        echo $jumlah_total;
                      ?>
                    </b>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <hr>
            <form action="<?= site_url('Kurikulum/aksi_penilaian_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">  
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <label style="font-size: 17px;"><b>Berikan Catatan:</b><span style="color: red;">*</span></h5></label><br><br>
                  <textarea rows="5" class="form-control" name="catatan" placeholder="Berikan Catatan Penilaian"></textarea>
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <a href="<?= site_url('penilaian-penilai/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_list_pengerjaan_kurikulum" value="<?= $list->id_list_pengerjaan_kurikulum; ?>">
                  <input type="hidden" name="keterangan" value="-">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </div>
            </form>
          </div> 
        </div> 
      </div>
    </div> 
  </div> 
</div> 
</div> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>