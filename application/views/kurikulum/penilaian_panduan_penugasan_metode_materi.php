<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; }
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
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>3. Panduan Penugasan</h5><br>
            <form action="<?= site_url('Kurikulum/aksi_penilaian_panduan_penugasan_metode_materi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group"> 
                <div class="col-md-12">
                  <?php 
                    if($materi->jenis_materi == 1){ $a = "Dasar"; }
                    else if($materi->jenis_materi == 2){ $a = "Inti";}
                    else if($materi->jenis_materi == 3){ $a = "Penunjang"; }

                    $get_jenis_materi = $this->M_entitas->selectX('materi', array('jenis_materi' => $materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

                    $id_materi = array();
                    foreach ($get_jenis_materi as $gjm)
                    {
                      $id_materi[] = $gjm->id_materi;
                    }

                    $get_indeks = array_search($materi->id_materi, $id_materi);
                    $no = $get_indeks+1;
                  ?>
                  <table width="100%">
                    <tr>
                      <td><b>Mata Pelatihan <?= $a." ".$no; ?></b></td>
                    </tr>
                    <tr>
                      <td><?= $materi->materi; ?></td>
                    </tr>
                    <tr>
                      <td style="text-align: center;">
                        <h5 style="font-size: 18px;">
                          <b>
                            PANDUAN <?= strtoupper($metode_materi->metode); ?>
                          </b>
                        </h5>
                      </td>
                    </tr>
                    <tr>
                      <td><b><u>Indikator Hasil Belajar:</u></b></td>
                    </tr>
                    <tr>
                      <td>
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
                      <td><b><u>Alat dan Bahan:</u></b></td>
                    </tr>
                    <tr>
                      <td>
                        <?php if($media){ ?>
                          <ol style="margin-bottom: 0px !important">
                            <?php 
                              foreach ($media as $mede) 
                              {
                                echo "<li>".$mede->media_alat_bantu."</li>";
                              }
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
                      <td>
                        <b><u>Waktu:</u></b>
                        <?php 
                          $jpl = $materi->p;
                          $total_jpl = $jpl * 45;
                          echo $jpl." JPL x 45 menit = ".$total_jpl." menit";
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b><u>Petunjuk:</u></b></td>
                    </tr>
                    <tr>
                      <td>
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
                  <br>
                  <label style="font-size: 17px;"><b>Berikan Catatan Penilaian:</b><span style="color: red;">*</span></label>
                  <?php if($metode_materi->catatan_penilaian){ ?>
                    <p>Catatan Sebelumnya : <?= $metode_materi->catatan_penilaian; ?></p>
                  <?php } ?>
                  <textarea rows="5" name="catatan_penilaian" required class="form-control ubah" data-id="<?= $metode_materi->id_metode_materi;?>"><?= $metode_materi->catatan_penilaian; ?></textarea>
                  <hr>
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <?php
                    $cek = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $id_list))->row();
                    if(!$cek){ 
                  ?>
                    <a href="<?= site_url('beri-penilaian-subbab/'.bin2hex(base64_encode($id_list))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                  <?php } ?>
                  <?php if($cek){ ?>
                    <a href="<?= site_url('ubah-penilaian-subbab/'.bin2hex(base64_encode($cek->id_catatan))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                  <?php } ?>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                  <input type="hidden" name="id_metode_materi" value="<?= $metode_materi->id_metode_materi; ?>">
                  <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
                  <input type="hidden" name="id_list" value="<?= $id_list; ?>">
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
<script type="text/javascript">
  $('.ubah').change(function() {
    var id_materi = $(this).attr('data-id');
    var nama = $(this).attr('name');
    var catatan = $(this).val();

    $.ajax({
      url : '<?= site_url("Kurikulum/ajax_ubah_penilaian_panduan_penugasan_metode_materi");?>',
      type : 'POST',
      data : {id:id_materi,parameter:nama,isi:catatan},
      success: function(data){
      }
    });
  });
</script>