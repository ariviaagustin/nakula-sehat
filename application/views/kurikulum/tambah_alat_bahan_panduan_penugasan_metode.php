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
        <?php $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <table width="100%">
              <tr>
                <td style="width: 5%;"><b>Materi</b></td>
                <td style="width: 1%;"><b>:</b></td>
                <td><b><?= $materi->materi; ?></b></td>
              </tr>
              <tr>
                <td><b>Metode</b></td>
                <td><b>:</b></td>
                <td><b><?= $metode_materi->metode; ?></b></td>
              </tr>
            </table>
            <br>
            <h6>Alat & Bahan<span style="color: red;">*</span></h6>
            <form action="<?= site_url('Kurikulum/aksi_tambah_alat_bahan_panduan_penugasan_metode'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group">
                <div class="col-12 col-md-12">
                  <input type="text" class="form-control" name="media_alat_bantu" required="">
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12" style="text-align: right;">
                  <input type="hidden" name="id_metode_materi" value="<?= $metode_materi->id_metode_materi; ?>">
                  <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                  <input type="hidden" name="materi" value="<?= $materi->materi; ?>">
                  <input type="hidden" name="id_metode" value="<?= $metode_materi->id_metode; ?>">
                  <input type="hidden" name="metode" value="<?= $metode_materi->metode; ?>">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
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