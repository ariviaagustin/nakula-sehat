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
            <h5>Materi : <?= $materi->materi; ?></h5><br>
            <form action="<?= site_url('Kurikulum/aksi_ubah_metode_materi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group">
                <div class="col-md-3">
                  <h6>Metode<span style="color: red;">*</span></h6>
                </div>
                <div class="col-9 col-md-9">
                  <select name="id_metode" class="form-control select2" required style="width: 100%;">
                    <option value="">-- Pilih Metode --</option>
                    <?php foreach ($metode as $key) { ?>
                      <option value="<?= $key->id_metode; ?>" <?php if($key->id_metode == $metode_materi->id_metode){ echo "selected"; } ?>><?= $key->metode; ?></option>
                    <?php } ?>
                  </select>
                  <!-- <input type="text" class="form-control" name="metode" required="" value="<?= $metode_materi->metode; ?>"> -->
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12" style="text-align: right;">
                  <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_metode_materi" value="<?= $metode_materi->id_metode_materi; ?>">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12">
                <h6><b>Informasi Metode</b></h6>
                <p>Metode yang dipilih akan menentukan media dan alat bantu serta pembuatan panduan penugasan</p>
                <table border="1" width="50%">
                  <tr>
                    <th style="width: 15%; text-align: center;">Metode</th>
                    <th style="width: 20%; text-align: center;">Media Alat Bantu</th>
                    <th style="width: 15%; text-align: center;">Pengisian Panduan Penugasan</th>
                  </tr>
                  <?php $no = 1; foreach ($metode as $key) { ?>
                    <tr <?php if($no % 2 == 1){ ?> style = "background-color: #e5e5e5;" <?php } ?>>
                      <td><?= $key->metode; ?></td>
                      <td>
                        <?php 
                          $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result();
                          if($get_media)
                          {
                            echo "<ul>";
                            foreach ($get_media as $gm) 
                            {
                              echo "<li>".$gm->media_alat_bantu."</li>";
                            }
                            echo "</ul>";
                          }
                          else { echo "Tidak ada media & alat bantu"; }
                        ?>
                      </td>
                      <td style="text-align: center;">
                        <?php
                          if($key->is_penugasan == 1){ echo "Ya"; }
                          else if($key->is_penugasan == 0){ echo "Tidak"; }
                        ?>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </table>
              </div>
            </div>
          </div> 
        </div> 
      </div>
    </div> 
  </div> 
</div> 
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>