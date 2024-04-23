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
            <h5>4. Ketentuan Penyelenggaraan Pelatihan</h5><br>
            <form action="<?= site_url('Kurikulum/aksi_ubah_penilaian_ketentuan_penyelenggara_pelatihan_item'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <?php if($jenis == 1){ ?>
                <div class="kriteria_peserta">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class = "col-md-12">
                          <h5 style="color: #000;"><b>Kriteria Peserta</b></h5>
                        </div>
                      </div>
                      <br>
                      <table width="100%" border="1">
                        <tr>
                          <th style="width: 1%;">No.</th>
                          <th>Kriteria Peserta</th>
                        </tr>
                        <?php if($peserta){ ?>
                          <?php $no = 1; foreach ($peserta as $key) { ?>
                            <tr>
                              <td style="text-align: center;"><?= $no++; ?>.</td>
                              <td><?= $key->isi_peserta; ?></td>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                        <?php if(!$peserta){ ?>
                          <tr>
                            <td colspan="2" style="text-align: center;">Belum ada data</td>
                          </tr>
                        <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
              <?php } ?>
              <?php if($jenis == 2){ ?>
                <div class="efektifitas_pelatihan">
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;"><b>Efektifitas Pelatihan</b></h5>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <table width="100%">
                        <tr>
                          <td style="width: 22%;">Jumlah peserta dalam satu kelas</td>
                          <td style="width: 1%;">:</td>
                          <?php if($kurikulum->jumlah_peserta){ ?>
                            <td style="width: fit-content;"><?= $kurikulum->jumlah_peserta; ?></td>
                          <?php } ?>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
              <?php } ?>
              <?php if($jenis == 3){ ?>
                <div class="pelatih">
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;"><b>Pelatih (Fasilitator/ Instruktur)</b></h5>
                    </div>
                  </div>
                  <br>
                  <div class="table-responsive">
                    <div style="overflow-x:auto;">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr style="background-color: lemonchiffon;">
                            <th style="width: 1%;">NO</th>
                            <th>MATERI</th>
                            <th>Kriteria Fasilitator</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr style="background-color: #d8d8d8;">
                            <td><b>A.</b></td>
                            <td colspan="3"><b>MATA PELATIHAN DASAR</b></td>
                          </tr>
                          <?php $no = 1; foreach($materi_dasar as $key) { ?>
                            <tr>
                              <td style="text-align: center;"><?= $no++; ?></td>
                              <td><?= $key->materi; ?></td>
                              <td><?= $key->kriteria_fasilitator; ?></td>
                            </tr>
                          <?php } ?>
                          <tr style="background-color: #d8d8d8;">
                            <td><b>B.</b></td>
                            <td colspan="3"><b>MATA PELATIHAN INTI</b></td>
                          </tr>
                          <?php $no = 1; foreach($materi_inti as $key) { ?>
                            <tr>
                              <td style="text-align: center;"><?= $no++; ?></td>
                              <td><?= $key->materi; ?></td>
                              <td><?= $key->kriteria_fasilitator; ?></td>
                            </tr>
                          <?php } ?>
                          <tr style="background-color: #d8d8d8;">
                            <td><b>C.</b></td>
                            <td colspan="3"><b>MATA PELATIHAN PENUNJANG</b></td>
                          </tr>
                          <?php $no = 1; foreach($materi_penunjang as $key) { ?>
                            <tr>
                              <td style="text-align: center;"><?= $no++; ?></td>
                              <td><?= $key->materi; ?></td>
                              <td><?= $key->kriteria_fasilitator; ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
              <?php } ?>
              <?php if($jenis == 4){ ?>
                <div class="ketentuan_penyelenggara">
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;"><b>Ketentuan Penyelenggara</b></h5>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if($kurikulum->ketentuan_penyelenggara){ echo $kurikulum->ketentuan_penyelenggara; } ?>
                    </div>
                  </div>
                </div>
                <hr>
              <?php } ?>
              <?php if($jenis == 5){ ?>
                <div class="sertifikat">
                  <div class="row">
                    <div class="col-md-12">
                      <h5 style="color: #000;"><b>Sertifikasi</b></h5>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if($kurikulum->sertifikat){ echo $kurikulum->sertifikat; } ?>
                    </div>
                  </div>
                </div>
                <hr>
              <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <br>
                  <label style="font-size: 17px;"><b>Berikan Catatan Penilaian:</b><span style="color: red;">*</span></label>
                  <?php if($catatan->catatan){ ?>
                    <p>Catatan Sebelumnya : <?= $catatan->catatan; ?></p>
                  <?php } ?>
                  <textarea rows="5" name="catatan" required class="form-control ubah" data-id = "<?= $catatan->id_catatan_ketentuan_penyelenggara_pelatihan; ?>"><?= $catatan->catatan; ?></textarea>
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
                  <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
                  <input type="hidden" name="id_list" value="<?= $id_list; ?>">
                  <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                  <input type="hidden" name="id_catatan_ketentuan_penyelenggara_pelatihan" value="<?= $catatan->id_catatan_ketentuan_penyelenggara_pelatihan; ?>">
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
    var id_catatan = $(this).attr('data-id');
    var nama = $(this).attr('name');
    var catatan = $(this).val();

    $.ajax({
      url : '<?= site_url("Kurikulum/ajax_ubah_penilaian_ketentuan_penyelenggara_pelatihan_item");?>',
      type : 'POST',
      data : {id:id_catatan,parameter:nama,isi:catatan},
      success: function(data){
      }
    });
  });
</script>