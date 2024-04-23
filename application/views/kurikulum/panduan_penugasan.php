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
      <div class="col-md-6">
        <h5 class="m-0 font-weight-bold" style="font-size: 17px">Lampiran</h5> 
      </div>
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <?php $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
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
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Setiap metode dibawah diharuskan memiliki panduan penugasan</b></span>
            </div>
            <table width="100%" border="1">
              <tr style="background-color: lemonchiffon;">
                <th style="width: 1%;">No</th>
                <th>Materi & Metode</th>
                <th>Proses</th>
                <th>Detail</th>
                <?php if($kurikulum->status >= 8){ ?>
                  <th>Penilaian</th>
                <?php } ?>
                <th>Isi / Ubah</th>
              </tr>
              <?php $no = 1; foreach ($materi_metode as $key) { ?>
                <tr style="background-color: blanchedalmond;">
                  <td style="text-align: center;"><b><?= $no; ?></b></td>
                  <td <?php if($kurikulum->status < 8){ echo "colspan='4'"; } else if($kurikulum->status >= 8){ echo "colspan='5'"; } ?>><b><?= $key->materi; ?></b></td>
                </tr>
                <?php $get_metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi, 'id_kurikulum' => $key->id_kurikulum, 'is_penugasan' => 1, 'id_metode != ' => 4))->result(); if($get_metode) { $no_metode = "a"; foreach ($get_metode as $get_met){ ?>
                  <tr>
                    <td style="text-align: center;"><?= $no_metode++; ?>.</td>
                    <td><?= $get_met->metode; ?></td>
                    <td style="text-align: center;">
                      <?php
                        if($get_met->status_penugasan == 1)
                        {
                          echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>";
                        }
                        else
                        {
                          echo "<i class = 'fa fa-times-circle' style = 'color: red; font-size: 25px;'></i>";
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <a href="#" class="btn btn-info btn-sm detail-panduan-penugasan" data-id="<?= $get_met->id_metode_materi; ?>"><i class="fa fa-info-circle"></i> Detail</a>
                    </td>
                    <?php if($kurikulum->status >= 8){ ?>
                      <td style="text-align: center;">
                        <?php if($get_met->status_penilaian == 1){ if($get_met->catatan_penilaian){ echo $key->catatan_penilaian; } else { echo "-"; } } else { echo "-"; } ?>
                      </td>
                    <?php } ?>
                    <td style="text-align: center;">
                      <a href="<?= site_url('isi-ubah-panduan-penugasan/'.bin2hex(base64_encode($get_met->id_metode_materi))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                    </td>
                  </tr>
                <?php } } ?>
              <?php $no++; } ?>
              <?php $no_a = $no; if($ada_pl == 1){ ?>
                <tr style="background-color: blanchedalmond;">
                  <td style="text-align: center;"><b><?= $no_a; ?></b></td>
                  <td><b>Praktik Lapangan</b></td>
                  <td style="text-align: center;">
                    <?php 
                      $get_panduan_praktik_lapang = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
                      if($get_panduan_praktik_lapang)
                      {
                        echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>";
                      }
                      else
                      {
                        echo "<i class = 'fa fa-times-circle' style = 'color: red; font-size: 25px;'></i>";
                      }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <?php 
                      $get_panduan_praktik_lapang = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result();
                      if($get_panduan_praktik_lapang){ ?>
                        <a href="#" class="btn btn-info btn-sm detail-panduan-praktik-lapang" data-id="<?= $kurikulum->id_kurikulum; ?>"><i class="fa fa-info-circle"></i> Detail</a>
                      <?php } ?>
                      <?php if(!$get_panduan_praktik_lapang){ echo "Belum ada detail"; } ?>
                  </td>
                  <?php if($kurikulum->status >= 8){ ?>
                    <?php $get_catatan_pl = $this->M_entitas->selectX('catatan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->row(); ?>
                    <td style="text-align: center;">
                      <?php if($get_catatan_pl){ echo $get_catatan_pl->catatan; } else { echo "-"; } ?>
                    </td>
                  <?php } ?>
                  <td style="text-align: center;">
                    <a href="<?= site_url('isi-ubah-panduan-praktik-lapang/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning btn-sm" title = "Isi / Ubah" style = "color: #000;"><li class="fa fa-pen"></li> Isi / Ubah</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
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
<div class="modal fade" id="detail-panduan-praktik-lapang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Panduan Praktik Lapang</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_panduan_lapang"></div>
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
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-panduan-praktik-lapang', function (e) {
      e.preventDefault();
      $("#detail-panduan-praktik-lapang").modal('show');
      $.post('<?= site_url('Kurikulum/detail_panduan_praktik_lapang');?>',
        {id: $(this).attr('data-id')},
        function (html) { $(".body_detail_panduan_lapang").html(html); }
      );
    });
  });
</script>