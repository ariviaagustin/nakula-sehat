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
        <div class="col-md-12">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab II Komponen Kurikulum</h5> 
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
              <div class="col-md-6">
                <h5>c. Struktur Kurikulum<span style="color: red;">*</span></h5><br>
              </div>
              <div class="col-md-6" style="text-align: right;">
                <a href="<?= site_url('tambah-materi/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah</a>
              </div>
            </div>
            <div class="alert alert-info">
              <b><i class="fa fa-exclamation-triangle"></i> Jumlah MATERI PELATIHAN INTI harus sama dengan jumlah KOMPETENSI</b> 
            </div>
            <div class="table-responsive">
              <div style="overflow-x:auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color: lemonchiffon;">
                      <th rowspan="2" style="width: 1%;">NO</th>
                      <th rowspan="2" style="width: 45%;">MATERI</th>
                      <th colspan="3">WAKTU</th>
                      <th rowspan="2">JPL</th>
                      <?php if($kurikulum->status >= 8){ ?>
                        <th rowspan="2">Penilaian</th>
                      <?php } ?>
                      <th rowspan="2"></th>
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
                      <td <?php if($kurikulum->status < 8){ echo "colspan='6'"; } else if($kurikulum->status >= 8){ echo "colspan='7'"; } ?>><b>MATA PELATIHAN DASAR</b></td>
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
                        <?php if($kurikulum->status >= 8){ ?>
                          <td>
                            <?php if($key->status_penilaian == 1){ if($key->catatan){ echo $key->catatan; } else { echo "-"; } } else { echo "-"; } ?>
                          </td>
                        <?php } ?>
                        <td>
                          <a href="<?= site_url('ubah-materi/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_materi)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                      <td style="text-align: center;"><b><?= $t_d; ?></b></td>
                      <td style="text-align: center;"><b><?= $p_d; ?></b></td>
                      <td style="text-align: center;"><b><?= $pl_d; ?></b></td>
                      <td style="text-align: center;"><b><?= $tot_jpl_d; ?></b></td>
                      <?php if($kurikulum->status >= 8){ ?>
                        <td></td>
                      <?php } ?>
                      <td></td>
                    </tr>
                    <tr style="background-color: #d8d8d8;">
                      <td><b>B.</b></td>
                      <td <?php if($kurikulum->status < 8){ echo "colspan='6'"; } else if($kurikulum->status >= 8){ echo "colspan='7'"; } ?>><b>MATA PELATIHAN INTI</b></td>
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
                        <?php if($kurikulum->status >= 8){ ?>
                          <td>
                            <?php if($key->status_penilaian == 1){ if($key->catatan){ echo $key->catatan; } else { echo "-"; } } else { echo "-"; } ?>
                          </td>
                        <?php } ?>
                        <td>
                          <a href="<?= site_url('ubah-materi/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_materi)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                      <td style="text-align: center;"><b><?= $t_i; ?></b></td>
                      <td style="text-align: center;"><b><?= $p_i; ?></b></td>
                      <td style="text-align: center;"><b><?= $pl_i; ?></b></td>
                      <td style="text-align: center;"><b><?= $tot_jpl_i; ?></b></td>
                      <?php if($kurikulum->status >= 8){ ?>
                        <td></td>
                      <?php } ?>
                      <td></td>
                    </tr>
                    <tr style="background-color: #d8d8d8;">
                      <td><b>C.</b></td>
                      <td <?php if($kurikulum->status < 8){ echo "colspan='6'"; } else if($kurikulum->status >= 8){ echo "colspan='7'"; } ?>><b>MATA PELATIHAN PENUNJANG</b></td>
                    </tr>
                    <?php $no = 1; $t_p = 0; $p_p = 0; $pl_p = 0; $tot_jpl_p = 0; foreach ($materi_penunjang as $key) { $t_p += $key->t; $p_p += $key->p; $pl_p += $key->pl; ?>
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
                        <?php if($kurikulum->status >= 8){ ?>
                          <td>
                            <?php if($key->status_penilaian == 1){ if($key->catatan){ echo $key->catatan; } else { echo "-"; } } else { echo "-"; } ?>
                          </td>
                        <?php } ?>
                        <td>
                          <a href="<?= site_url('ubah-materi/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_materi)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                      <td style="text-align: center;"><b><?= $t_p; ?></b></td>
                      <td style="text-align: center;"><b><?= $p_p; ?></b></td>
                      <td style="text-align: center;"><b><?= $pl_p; ?></b></td>
                      <td style="text-align: center;"><b><?= $tot_jpl_p; ?></b></td>
                      <?php if($kurikulum->status >= 8){ ?>
                        <td></td>
                      <?php } ?>
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
                      <?php if($kurikulum->status >= 8){ ?>
                        <td></td>
                      <?php } ?>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <p>
                  Keterangan:<br>
                    • T = teori<br>
                    • P = penugasan (studi kasus, latihan, dll)<br>
                    • PL = praktek lapangan/observasi lapangan<br>
                    • 1 JPL (jam pelajaran) teori atau penugasan = 45 menit<br>
                    • 1 JPL (jam pelajaran) praktek lapangan/observasi lapangan = 60 menit<br>
                    • Untuk mata pelatihan dengan praktek lapangan/observasi lapangan dilaksanakan dengan instruktur 1 orang setiap kelas.<br>
                </p>
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
          url: '<?= site_url('Kurikulum/hapus_materi/'); ?>/'+id,
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
<script>
  $(function () {
    if($(this).attr("data-awal") == 1){
      $(".awal").show();
    }else{
      var addFormGroup = function (event) {
        event.preventDefault();

        var $formGroup = $(this).closest('.form-group');
        var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
        var newIndex = $('.multiple-form-group').length+1;
        var $formGroupClone = $formGroup.first().clone().find('input').attr('name', function(idx, attrVal){
            return attrVal.replace(/\d+/, newIndex);
        }).end().insertBefore(this);

        $(this)
        .toggleClass('btn-success btn-add btn-danger btn-remove')
        .html('–');
        $formGroupClone.insertAfter($formGroup);

        var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
        if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
            $lastFormGroupLast.find('.btn-add').attr('disabled', true);
        }
      };

      var removeFormGroup = function (event) {
        event.preventDefault();

        var $formGroup = $(this).closest('.form-group');
        var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

        var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
        if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
            $lastFormGroupLast.find('.btn-add').attr('disabled', false);
        }

        $formGroup.remove();
      };

      var countFormGroup = function ($form) {
        return $form.find('.form-group').length;
      };

      $(document).on('click', '.btn-add', addFormGroup);
      $(document).on('click', '.btn-remove', removeFormGroup);
    }
  });
</script>