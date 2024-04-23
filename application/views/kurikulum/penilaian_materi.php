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
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab II Stuktur Kurikulum</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>c. Struktur Kurikulum</h5><br>
            <form action="<?= site_url('Kurikulum/aksi_penilaian_materi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <table width="100%">
                    <tr>
                      <td style="width: 20%;">Jenis Materi</td>
                      <td style="width: 1%;">:</td>
                      <td>
                        <?php 
                          if($materi->jenis_materi == 1){ echo "Materi Pelatihan Dasar"; }
                          else if($materi->jenis_materi == 2){ echo "Materi Pelatihan Inti"; }
                          else if($materi->jenis_materi == 3){ echo "Materi Pelatihan Penunjang"; }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Materi</td>
                      <td>:</td>
                      <td><?= $materi->materi; ?></td>
                    </tr>
                    <tr>
                      <td>Teori</td>
                      <td>:</td>
                      <td><?= $materi->t; ?></td>
                    </tr>
                    <tr>
                      <td>Penugasan</td>
                      <td>:</td>
                      <td><?= $materi->p; ?></td>
                    </tr>
                    <tr>
                      <td>Praktik Lapang</td>
                      <td>:</td>
                      <td><?= $materi->pl; ?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi</td>
                      <td>:</td>
                      <td><?= $materi->deskripsi; ?></td>
                    </tr>
                    <tr>
                      <td>Hasil Belajar</td>
                      <td>:</td>
                      <td><?= $materi->hasil_belajar; ?></td>
                    </tr>
                    <tr>
                      <td>Kriteria Fasilitator</td>
                      <td>:</td>
                      <td><?= $materi->kriteria_fasilitator; ?></td>
                    </tr>
                  </table>
                  <br>
                  <label style="font-size: 17px;"><b>Berikan Catatan Penilaian:</b></label>
                  <?php if($materi->catatan){ ?>
                    <p>Catatan Sebelumnya : <?= $materi->catatan; ?></p>
                  <?php } ?>
                  <textarea name="catatan" class="form-control ubah" data-id="<?= $materi->id_materi;?>"><?= $materi->catatan; ?></textarea>
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
      url : '<?= site_url("Kurikulum/ajax_ubah_penilaian_materi");?>',
      type : 'POST',
      data : {id:id_materi,parameter:nama,isi:catatan},
      success: function(data){
      }
    });
  });
</script>