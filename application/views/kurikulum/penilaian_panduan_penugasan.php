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
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Lampiran</h5> 
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
            <h5>3. Panduan Penugasan</h5>
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Silahkan berikan penilaian terhadap Kurikulum yang telah diajukan.</b></span>
            </div>
            <hr>
            <div class="row">
              <?php if($penugasan_materi){ foreach ($penugasan_materi as $key) { ?>
                <div class="col-md-12">
                  <?php $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $key->id_materi))->row(); ?>
                  <?php 
                    if($get_materi->jenis_materi == 1){ $a = "Dasar"; }
                    else if($get_materi->jenis_materi == 2){ $a = "Inti";}
                    else if($get_materi->jenis_materi == 3){ $a = "Penunjang"; }

                    $get_jenis_materi = $this->M_entitas->selectX('materi', array('jenis_materi' => $get_materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

                    $id_materi = array();
                    foreach ($get_jenis_materi as $gjm)
                    {
                      $id_materi[] = $gjm->id_materi;
                    }

                    $get_indeks = array_search($get_materi->id_materi, $id_materi);
                    $no = $get_indeks+1;
                  ?>
                  <table width="100%">
                    <tr>
                      <td><b>Mata Pelatihan <?= $a." ".$no; ?></b></td>
                      <td style="text-align: right;">
                        <a href="<?= site_url('penilaian-panduan-penugasan-metode-materi/'.bin2hex(base64_encode($key->id_metode_materi)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" <?php if($key->catatan_penilaian){ if($key->status_penilaian == 1){ ?> style = "color: #fff; background-color: #7459ff; border-color: #7459ff;" <?php } } ?> style = "color: #000;">
                          <i class="fa fa-pen"></i> <?php if($key->catatan_penilaian){ if($key->status_penilaian == 1){ echo "Ubah Penilaian"; } else if($key->status_penilaian == 2){ echo "Berikan Penilaian"; } } else { echo "Berikan Penilaian"; } ?></a>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><?= $get_materi->materi; ?></td>
                    </tr>
                    <tr>
                      <td style="text-align: center;" colspan="2">
                        <h5 style="font-size: 18px;">
                          <b>
                            PANDUAN <?= strtoupper($key->metode); ?>
                          </b>
                        </h5>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><b><u>Indikator Hasil Belajar:</u></b></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $get_materi->id_materi))->result(); ?>
                        <?php if($indikator){ ?>
                          Setelah mengikuti mata pelatihan ini, peserta mampu:<br>
                          <ol style="margin-bottom: 0px !important">
                            <?php 
                              foreach ($indikator as $indi) 
                              {
                                echo "<li>".$indi->indikator_hasil_belajar."</li>";
                              }
                            ?>
                          </ol>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><b><u>Alat dan Bahan:</u></b></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <?php $media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result(); ?>
                        <?php if($media){ ?>
                          <ol style="margin-bottom: 0px !important">
                            <?php 
                              foreach ($media as $mede) 
                              {
                                echo "<li>".$mede->media_alat_bantu."</li>";
                              }
                              $media_tambahan = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $key->id_metode_materi))->result();
                              if($media_tambahan)
                              {
                                foreach ($media_tambahan as $mt) 
                                {
                                  echo "<li>".$mt->media_alat_bantu."</li>";
                                }
                              }
                            ?>
                          </ol>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <b><u>Waktu:</u></b>
                        <?php 
                          $jpl = $get_materi->p;
                          $total_jpl = $jpl * 45;
                          echo $jpl." JPL x 45 menit = ".$total_jpl." menit";
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><b><u>Petunjuk:</u></b></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <?php $petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $key->id_metode_materi))->result(); ?>
                        <?php if($petunjuk){ ?>
                          <ol>
                            <?php foreach ($petunjuk as $p) { ?>
                              <li><?= $p->petunjuk_panduan_penugasan; ?></li>
                            <?php } ?>
                          </ol>
                        <?php } ?>
                        <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
                      </td>
                    </tr>
                  </table>
                  <hr>
                </div>
              <?php } } ?>
              <?php if($penugasan_pl){ ?>
                <div class="col-md-12">
                  <table width="100%">
                    <tr>
                      <td style="text-align: right;"><h5 style="font-size: 18px;"><b>PANDUAN PRAKTIK LAPANG</b></h5></td>
                      <td style="text-align: right;">
                        <?php $get_cat_pl = $this->M_entitas->selectX('catatan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->row(); ?>
                        <?php if(!$get_cat_pl){ ?>
                          <a href="<?= site_url('penilaian-panduan-penugasan-praktik-lapang/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                        <?php } ?>
                        <?php if($get_cat_pl){ ?>
                          <a href="<?= site_url('ubah-penilaian-panduan-penugasan-praktik-lapang/'.bin2hex(base64_encode($get_cat_pl->id_catatan_praktik_lapang)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;">
                          <i class="fa fa-pen"></i> Ubah Penilaian</a>
                        <?php } ?>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <b><u>Waktu:</u></b>
                        <?php 
                          $jpl = 0;
                          foreach ($penugasan_pl as $key) 
                          {
                            $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $key->id_materi))->row();
                            $jpl += $get_materi->pl;
                          }
                          $total_jpl = $jpl * 60;
                          echo $jpl." JPL x 60 menit = ".$total_jpl." menit";
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><b><u>Petunjuk:</u></b></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <?php $petunjuk = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result(); ?>
                        <?php if($petunjuk){ ?>
                          <ol>
                            <?php foreach ($petunjuk as $key) { ?>
                              <li><?= $key->panduan_penugasan; ?></li>
                            <?php } ?>
                          </ol>
                        <?php } ?>
                        <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
                      </td>
                    </tr>
                  </table>
                </div>
              <?php } ?>
            </div>
            <br><hr>
            <form action="<?= site_url('Kurikulum/aksi_penilaian_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">  
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <label style="font-size: 17px;"><b>Berikan Penilaian:</b></h5></label><br>
                  <textarea class="form-control" rows="5" name="catatan" placeholder="Berikan Penilaian"></textarea>
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