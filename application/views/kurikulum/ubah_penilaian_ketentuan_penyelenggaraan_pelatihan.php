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
            <h5>4. Ketentuan Penyelenggaraan Pelatihan</h5>
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Silahkan berikan penilaian terhadap Kurikulum yang telah diajukan.</b></span>
            </div>
            <hr>
            <div class="kriteria_peserta">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class = "col-md-6">
                      <h5 style="color: #000;"><b>Kriteria Peserta</b></h5>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                      <?php $cek_catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 1))->row(); ?> 
                      <?php if(!$cek_catatan){ ?>
                        <a href="<?= site_url('penilaian-ketentuan-penyelenggara-pelatihan-item/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                      <?php } ?>
                      <?php if($cek_catatan){ ?>
                        <?php if($cek_catatan->status == 1){ ?>
                          <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                        <?php } ?>
                        <?php if($cek_catatan->status == 2){ ?>
                          <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                        <?php } ?>
                      <?php } ?>
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
            <div class="efektifitas_pelatihan">
              <div class="row">
                <div class="col-md-6">
                  <h5 style="color: #000;"><b>Efektifitas Pelatihan</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $cek_catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 2))->row(); ?> 
                  <?php if(!$cek_catatan){ ?>
                    <a href="<?= site_url('penilaian-ketentuan-penyelenggara-pelatihan-item/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                  <?php } ?>
                  <?php if($cek_catatan){ ?>
                    <?php if($cek_catatan->status == 1){ ?>
                    <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                    <?php } ?>
                    <?php if($cek_catatan->status == 2){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                    <?php } ?>
                  <?php } ?>
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
            <div class="pelatih">
              <div class="row">
                <div class="col-md-6">
                  <h5 style="color: #000;"><b>Pelatih (Fasilitator/ Instruktur)</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $cek_catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 3))->row(); ?> 
                  <?php if(!$cek_catatan){ ?>
                    <a href="<?= site_url('penilaian-ketentuan-penyelenggara-pelatihan-item/'.bin2hex(base64_encode(3)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                  <?php } ?>
                  <?php if($cek_catatan){ ?>
                      <?php if($cek_catatan->status == 1){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                    <?php } ?>
                    <?php if($cek_catatan->status == 2){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                    <?php } ?>
                  <?php } ?>
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
            <div class="ketentuan_penyelenggara">
              <div class="row">
                <div class="col-md-6">
                  <h5 style="color: #000;"><b>Ketentuan Penyelenggara</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $cek_catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 4))->row(); ?> 
                  <?php if(!$cek_catatan){ ?>
                    <a href="<?= site_url('penilaian-ketentuan-penyelenggara-pelatihan-item/'.bin2hex(base64_encode(4)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                  <?php } ?>
                  <?php if($cek_catatan){ ?>
                    <?php if($cek_catatan->status == 1){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                    <?php } ?>
                    <?php if($cek_catatan->status == 2){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                    <?php } ?>
                  <?php } ?>
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
            <div class="sertifikat">
              <div class="row">
                <div class="col-md-6">
                  <h5 style="color: #000;"><b>Sertifikasi</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $cek_catatan = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 5))->row(); ?> 
                  <?php if(!$cek_catatan){ ?>
                    <a href="<?= site_url('penilaian-ketentuan-penyelenggara-pelatihan-item/'.bin2hex(base64_encode(5)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                  <?php } ?>
                  <?php if($cek_catatan){ ?>
                    <?php if($cek_catatan->status == 1){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                    <?php } ?>
                    <?php if($cek_catatan->status == 2){ ?>
                      <a href="<?= site_url('ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/'.bin2hex(base64_encode($cek_catatan->id_catatan_ketentuan_penyelenggara_pelatihan)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                    <?php } ?>
                  <?php } ?>
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
            <form action="<?= site_url('Kurikulum/aksi_ubah_penilaian_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">  
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <label style="font-size: 17px;"><b>Berikan Penilaian:</b></h5></label><br><br>
                  <textarea rows="5" class="form-control ubah" name="catatan" placeholder="Berikan Penilaian" data-id = "<?= $catatan->id_catatan; ?>"><?= $catatan->catatan; ?></textarea>
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
                  <input type="hidden" name="id_catatan" value="<?= $catatan->id_catatan; ?>">
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
<script type="text/javascript">
  $('.ubah').change(function() {
    var id_catatan = $(this).attr('data-id');
    var nama = $(this).attr('name');
    var catatan = $(this).val();

    $.ajax({
      url : '<?= site_url("Kurikulum/ajax_ubah_penilaian_kurikulum");?>',
      type : 'POST',
      data : {id:id_catatan,parameter:nama,isi:catatan},
      success: function(data){
      }
    });
  });
</script>