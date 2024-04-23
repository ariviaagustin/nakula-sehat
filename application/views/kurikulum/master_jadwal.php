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
        <div class="row">
          <div class="col-md-12">
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
                <h5><b>2. Master Jadwal<span style="color: red;">*</span></b></h5>
              </div>
            </div>
            <br>
            <div style="border: .1em solid #6d6b6b; background-color: #e5e5e5; border-radius: 10px; padding: 10px;">
              <form action="<?= site_url('Kurikulum/aksi_isi_hari_jadwal'); ?>" method = "post">
                <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                <table width="100%">
                  <tr>
                    <td style="width: 10%;"><b>Jumlah hari</b></td>
                    <td><input type="number" name="jumlah_hari_pelatihan" class="form-control" required value="<?= $kurikulum->jumlah_hari_pelatihan; ?>"></td>
                    <td><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
                </table>
              </form>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                  <span><b><i class="fa fa-info-circle"></i> Harap teliti terlebih dahulu sebelum melakukan tambah jadwal. Jadwal yang sudah terisi tidak dapat diubah / dihapus.</b></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <a href="<?= site_url('tambah-master-jadwal/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Jadwal</a>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <div style="overflow-x:auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color: lemonchiffon;">
                      <th style="width: 5%;">Hari</th>
                      <th>Waktu</th>
                      <th>Alokasi Waktu</th>
                      <th style="width: 5%;">JPL</th>
                      <th style="width: 35%;">Mata Pelatihan</th>
                      <!-- <th style="width: 10%;"></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($master_jadwal as $key) { ?>
                      <tr>
                        <td style="text-align: center;"><?= $key->hari_ke; ?></td>
                        <td style="text-align: center;"><?= date('H:i', strtotime($key->waktu_awal))." - ".date('H:i', strtotime($key->waktu_akhir)); ?></td>
                        <td style="text-align: center;">
                          <?php 
                            if($key->t_p_pl_materi == 1){ echo "T"; }
                            else if($key->t_p_pl_materi == 2){ echo "P"; }
                            else if($key->t_p_pl_materi == 3){ echo "P L"; }
                          ?>
                        </td>
                        <td style="text-align: center;"><?= $key->jpl; ?></td>
                        <td><?= $key->mata_pelatihan; ?></td>
                        <!-- <td style="text-align: center;">
                          <a href="<?= site_url('ubah-master-jadwal/'.bin2hex(base64_encode($key->id_master_jadwal))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_master_jadwal)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        </td> -->
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.hapus',function(e)

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
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('hapus-master-jadwal/'); ?>/'+id,
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