<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top !important; }
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
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Lampiran</h5>
        </div>
      </div>
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <?php if($get_catatan){ ?>
          <div class="box_penilaian" style="padding: 15px; border: 2px solid orange; border-radius: 5px; background-color: #ffce85;">
            <div class="row">
              <div class="col-md-12">
                <h5><b><i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i> Penilaian <i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i></b></h5>
                <p><?= $get_catatan->catatan; ?></p>
                <?php if($get_catatan->keterangan){ ?>
                  <h5><b>Catatan</b></h5>
                  <p><?php if($get_catatan->keterangan){ echo $get_catatan->keterangan; } else { echo "Tidak ada catatan"; } ?></p>
                <?php } ?>
              </div>
            </div>
          </div>
          <hr>
        <?php } ?>
        <div class="row">
          <div class="col-md-12">
            <h5><b>4. Ketentuan Penyelenggaraan Pelatihan<span style="color: red;">*</span></b></h5><br>
          </div>
          <div class="col-md-12">
            <div class="kriteria_peserta">
              <div class="row">
                <div class="col-md-6">
                    <h5 style="color: #000;"><b>Kriteria Peserta</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $get_catatan_penilaian = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 1))->row(); if($get_catatan_penilaian){ if($get_catatan_penilaian->status == 1){ ?>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-jenis = "<?= bin2hex(base64_encode(1)); ?>" class="btn btn-info btn-sm penilaian-ketentuan-penyelenggara-pelatihan" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Catatan</a>
                  <?php } } ?>
                  <a href="<?= site_url('tambah-kriteria-peserta/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Kriteria Peserta</a>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <table width="100%" border="1">
                    <tr>
                      <th style="width: 1%;">No.</th>
                      <th>Kriteria Peserta</th>
                      <th style="width: 3%;"></th>
                    </tr>
                    <?php if($peserta){ ?>
                      <?php $no = 1; foreach ($peserta as $key) { ?>
                        <tr>
                          <td style="text-align: center;"><?= $no++; ?>.</td>
                          <td><?= $key->isi_peserta; ?></td>
                          <td style="text-align: center;">
                            <a href="<?= site_url('ubah-kriteria-peserta/'.bin2hex(base64_encode($key->id_isi_peserta))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                            <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_isi_peserta)); ?>" class = "hapus_kriteria_peserta btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>
                    <?php if(!$peserta){ ?>
                      <tr>
                        <td colspan="3" style="text-align: center;">Belum ada data</td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            <hr>
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
                      <td>
                        <?php $get_catatan_penilaian = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 2))->row(); if($get_catatan_penilaian){ if($get_catatan_penilaian->status == 1){ ?>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-jenis = "<?= bin2hex(base64_encode(2)); ?>" class="btn btn-info btn-sm penilaian-ketentuan-penyelenggara-pelatihan" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Catatan</a>
                        <?php } } ?>
                        <a href="<?= site_url('isi-ubah-jumlah-peserta/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"> <i class="fa fa-pen"></i> <?php if($kurikulum->jumlah_peserta){ echo "Ubah Jumlah Peserta"; } else { echo "Isi Jumlah Peserta"; } ?></a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <hr>
            <div class="efektifitas_pelatihan">
              <div class="row">
                <div class="col-md-6">
                  <h5 style="color: #000;"><b>Pelatih (Fasilitator/ Instruktur)</b></h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <?php $get_catatan_penilaian = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 3))->row(); if($get_catatan_penilaian){ if($get_catatan_penilaian->status == 1){ ?>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-jenis = "<?= bin2hex(base64_encode(3)); ?>" class="btn btn-info btn-sm penilaian-ketentuan-penyelenggara-pelatihan" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Catatan</a>
                  <?php } } ?>
                </div>
              </div>
              <br>
              <div class="table-responsive">
                <div style="overflow-x:auto;">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr style="background-color: lemonchiffon;">
                        <th style="width: 1%;">NO</th>
                        <th style="width: 45%;">MATERI</th>
                        <th>Kriteria Fasilitator</th>
                        <th>Isi / Ubah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr style="background-color: #d8d8d8;">
                        <td><b>A.</b></td>
                        <td colspan="4"><b>MATA PELATIHAN DASAR</b></td>
                      </tr>
                      <?php $no = 1; foreach($materi_dasar as $key) { ?>
                        <tr>
                          <td style="text-align: center;"><?= $no++; ?></td>
                          <td><?= $key->materi; ?></td>
                          <td><?= $key->kriteria_fasilitator; ?></td>
                          <td style="text-align: center;">
                            <a href="<?= site_url('isi-ubah-kriteria-fasilitator/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                          </td>
                        </tr>
                      <?php } ?>
                      <tr style="background-color: #d8d8d8;">
                        <td><b>B.</b></td>
                        <td colspan="4"><b>MATA PELATIHAN INTI</b></td>
                      </tr>
                      <?php $no = 1; foreach($materi_inti as $key) { ?>
                        <tr>
                          <td style="text-align: center;"><?= $no++; ?></td>
                          <td><?= $key->materi; ?></td>
                          <td><?= $key->kriteria_fasilitator; ?></td>
                          <td style="text-align: center;">
                            <a href="<?= site_url('isi-ubah-kriteria-fasilitator/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                          </td>
                        </tr>
                      <?php } ?>
                      <tr style="background-color: #d8d8d8;">
                        <td><b>C.</b></td>
                        <td colspan="4"><b>MATA PELATIHAN PENUNJANG</b></td>
                      </tr>
                      <?php $no = 1; foreach($materi_penunjang as $key) { ?>
                        <tr>
                          <td style="text-align: center;"><?= $no++; ?></td>
                          <td><?= $key->materi; ?></td>
                          <td><?= $key->kriteria_fasilitator; ?></td>
                          <td style="text-align: center;">
                            <a href="<?= site_url('isi-ubah-kriteria-fasilitator/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                          </td>
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
                  <?php $get_catatan_penilaian = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 4))->row(); if($get_catatan_penilaian){ if($get_catatan_penilaian->status == 1){ ?>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-jenis = "<?= bin2hex(base64_encode(4)); ?>" class="btn btn-info btn-sm penilaian-ketentuan-penyelenggara-pelatihan" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Catatan</a>
                  <?php } } ?>
                  <a href="<?= site_url('isi-ubah-ketentuan-penyelenggara/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000"><i class="fa fa-pen"></i> <?php if($kurikulum->ketentuan_penyelenggara){ echo "Ubah Ketentuan Penyelenggara"; } else { echo "Isi Ketentuan Penyelenggara"; } ?></a>
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
                  <?php $get_catatan_penilaian = $this->M_entitas->selectX('catatan_ketentuan_penyelenggara_pelatihan', array('id_kurikulum' => $kurikulum->id_kurikulum, 'jenis' => 5))->row(); if($get_catatan_penilaian){ if($get_catatan_penilaian->status == 1){ ?>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-jenis = "<?= bin2hex(base64_encode(5)); ?>" class="btn btn-info btn-sm penilaian-ketentuan-penyelenggara-pelatihan" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Catatan</a>
                  <?php } } ?>
                  <a href="<?= site_url('isi-ubah-sertifikat/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000"><i class="fa fa-pen"></i> <?php if($kurikulum->sertifikat){ echo "Ubah sertifikasi"; } else { echo "Isi sertifikasi"; } ?></a>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <?php if($kurikulum->sertifikat){ echo $kurikulum->sertifikat; } ?>
                </div>
              </div>
            </div>
            <form action="<?= site_url('Kurikulum/aksi_isi_subbab_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <?php if($catatan > 0){ ?>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                      <span><i class="fa fa fa-info-circle"></i> Anda memiliki catatan penilaian untuk diperbaiki. Apabila catatan penilaian sudah diperbaiki, silahkan pilih "Ya"</span>
                    </div>
                    <h6>Apakah sudah diperbaiki ?</h6>
                    <input type="radio" name="is_perbaikan" value="1"> Ya
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="is_perbaikan" value="2"> Tidak
                  </div>
                </div>
              <?php } ?>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
                  <?php if($list){ ?>
                    <input type="hidden" name="id_list_pengerjaan_kurikulum" value="<?= $list->id_list_pengerjaan_kurikulum; ?>">
                  <?php } ?>
                  <?php if($list == NULl){ ?>
                    <input type="hidden" name="id_list_pengerjaan_kurikulum" value="0">
                  <?php } ?>
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
<div class="modal fade" id="penilaian-ketentuan-penyelenggara-pelatihan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Penilaian</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_lihat_penilaian_ketentuan_penyelenggara_pelatihan"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.hapus_kriteria_peserta',function(e)
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
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('hapus-kriteria-peserta/'); ?>/'+id,
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
  $(function () {
    $(document).on('click', '.penilaian-ketentuan-penyelenggara-pelatihan', function (e) {
      e.preventDefault();
      $("#penilaian-ketentuan-penyelenggara-pelatihan").modal('show');
      $.post('<?= site_url('Kurikulum/lihat_penilaian_ketentuan_penyelenggara_pelatihan');?>',
        {id_kurikukum: $(this).attr('data-id'), jenis: $(this).attr('data-jenis'),},
        function (html) { $(".body_lihat_penilaian_ketentuan_penyelenggara_pelatihan").html(html); }
      );
    });
  });
</script>