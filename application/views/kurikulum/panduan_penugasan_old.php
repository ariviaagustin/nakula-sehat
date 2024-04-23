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
            <div class="row">
              <div class="col-md-12">
                <h5>3. Panduan Penugasan<span style="color: red;">*</span></h5><br>
              </div>
            </div>
            <div class="table-responsive">
              <div style="overflow-x:auto;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="background-color: lemonchiffon;">
                      <th style="width: 1%;">NO</th>
                      <th style="width: 45%;">MATERI</th>
                      <th>Proses</th>
                      <th>Detail</th>
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
                        <td style="text-align: center;">
                          <?php
                            if($key->status_panduan_penugasan == 1)
                            {
                              echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>";
                            }
                          ?>
                        </td>
                        <td style="text-align: center;">
                          <a href="#" class="btn btn-info btn-sm detail-panduan-penugasan" data-id="<?= $key->id_materi; ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        </td>
                        <td style="text-align: center;">
                          <a href="<?= site_url('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
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
                        <td style="text-align: center;">
                          <?php
                            if($key->status_panduan_penugasan == 1)
                            {
                              echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>";
                            }
                          ?>
                        </td>
                        <td style="text-align: center;">
                          <a href="#" class="btn btn-info btn-sm detail-panduan-penugasan" data-id="<?= $key->id_materi; ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        </td>
                        <td style="text-align: center;">
                          <a href="<?= site_url('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
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
                        <td style="text-align: center;">
                          <?php
                            if($key->status_panduan_penugasan == 1)
                            {
                              echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>";
                            }
                          ?>
                        </td>
                        <td style="text-align: center;">
                          <a href="#" class="btn btn-info btn-sm detail-panduan-penugasan" data-id="<?= $key->id_materi; ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        </td>
                        <td style="text-align: center;">
                          <a href="<?= site_url('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($key->id_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-2">
                <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
              <div class="col-md-10" style="text-align: right;">
                <form action="<?= site_url('Kurikulum/aksi_isi_subbab_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
                  <input type="hidden" name="judul" value="<?= $kurikulum->judul; ?>">
                  <button type="submit" class="btn btn-info" <?php if($status_materi == 0){ echo "disabled"; } ?>>Simpan</button>
                </form>

              </div>
            </div>
          </div> 
        </div> 
      </div>
    </div> 
  </div> 
</div> 
</div> 
<div class="modal fade" id="detail-panduan-penugasan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Panduan Penugasan</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_panduan_penugasan"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-panduan-penugasan', function (e) {
      e.preventDefault();
      $("#detail-panduan-penugasan").modal('show');
      $.post('<?= site_url('Kurikulum/detail_panduan_penugasan');?>',
        {id: $(this).attr('data-id')},
        function (html) { $(".body_detail_panduan_penugasan").html(html); }
      );
    });
  });
</script>