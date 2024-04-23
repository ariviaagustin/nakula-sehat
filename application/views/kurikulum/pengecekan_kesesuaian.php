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
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Cek Kesesuaian Kurikulum</h5> 
        </div>
        <div class="col-md-6" style="text-align: right;">
          <a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a>
        </div>
      </div>
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <div class="row">
          <div class="col-md-12">
            <h5><b>Informasi Kurikulum</b></h5><br>
            <table width="100%">
              <tr>
                <td style="width: 15%;">Judul Kurikulum</td>
                <td style="width: 1%;">:</td>
                <td><b><?= $kurikulum->judul; ?></b></td>
              </tr>
              <tr>
                <td>Institusi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_institusi; ?></b></td>
              </tr>
              <tr>
                <td>pj substansi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_sdm; ?></b></td>
              </tr>
              <tr>
                <td>JPL</td>
                <td>:</td>
                <td><b><?= $kurikulum->jumlah_jpl; ?></b></td>
              </tr>
              <tr>
                <td>KAK/TOR</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank">KAK TOR</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Surat Pengantar</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Pengantar</a>
                  <?php } ?>
                </td>
              </tr>
              <?php if($kurikulum->status >= 8){ ?>
                <tr>
                  <td>Penilai</td>
                  <td>:</td>
                  <td><b><?= $kurikulum->nama_penilai; ?></b></td>
                </tr>
              <?php } ?>
            </table>
            <hr>
          </div>
          <div class="col-md-12" style="margin-top: 2%;">
            <form action="<?= site_url('Kurikulum/aksi_pengecekan_kesesuaian'); ?>" method = "post">
              <h5><b>Pengecekan Kurikulum</b></h5><br>
              <table border="1" width="100%">
                <tr style="background-color: burlywood;">
                  <th rowspan="2" style="width: 2%;">No.</th>
                  <th rowspan="2" style="width: 35%;">Bab & Sub Bab</th>
                  <th rowspan="2">Status Pengerjaan</th>
                  <th rowspan="2">Detail</th>
                  <th colspan="3">Kesesuaian</th>
                </tr>
                <tr style="background-color: burlywood;">
                  <th>Sesuai</th>
                  <th>Tidak Sesuai</th>
                  <th>Catatan</th>
                </tr>
                <?php $no = 1; foreach ($bab as $key) {  ?>
                  <tr <?php if($key->is_isi == 0){ ?> style = "background-color: gainsboro;" <?php } ?>>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><b><?= $key->bab." ".$key->judul; ?></b></td>
                    <td style="text-align: center;">
                      <?php 
                        $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row();
                        if($cek_bab)
                        { 
                          echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>"; 
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if($key->is_isi == 1){ ?>
                        <?php $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row(); ?>
                        <?php if($cek_bab){ ?>
                          <a href="#" class="btn btn-info btn-sm btn-sasaran detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        <?php } ?>
                      <?php } ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if($key->is_isi == 1){ ?>
                        <?php if($cek_bab->status == 2 || $cek_bab->status == 5){ ?>
                          <input type="radio" name="status<?= $cek_bab->id_list_pengerjaan_kurikulum; ?>" value = "4" required>
                        <?php } ?>
                      <?php } ?>
                      <?php if($key->is_isi == 1){ ?>
                        <?php if($cek_bab->status == 4){ ?>
                          <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                        <?php } ?>
                      <?php } ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if($key->is_isi == 1){ ?>
                        <?php if($cek_bab->status == 2 || $cek_bab->status == 5){ ?>
                          <input type="radio" name="status<?= $cek_bab->id_list_pengerjaan_kurikulum; ?>" value = "3" required>
                        <?php } ?>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($key->is_isi == 1){ ?>
                        <?php if($cek_bab->status == 2 || $cek_bab->status == 5){ ?>
                          <textarea name="catatan<?= $cek_bab->id_list_pengerjaan_kurikulum; ?>" class=""></textarea>
                        <?php } ?>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab))->result(); if($sub_bab){ $no_sb = "a"; foreach ($sub_bab as $sb) { ?>
                    <tr>
                      <td></td>
                      <td><?= $no_sb++.". ".$sb->sub_bab; ?></td>
                      <td style="text-align: center;">
                        <?php 
                          $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                          if($cek_subbab)
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
                        <?php $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row(); ?>
                        <?php if($cek_subbab){ ?>
                          <a href="#" class="btn btn-info btn-sm btn-sasaran detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        <?php } ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if($cek_subbab->status == 2 || $cek_subbab->status == 5){ ?>
                          <input type="radio" name="status<?= $cek_subbab->id_list_pengerjaan_kurikulum; ?>" value = "4" required>
                        <?php } ?>
                        <?php if($cek_subbab->status == 4){ ?>
                          <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                        <?php } ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if($cek_subbab->status == 2 || $cek_subbab->status == 5){ ?>
                          <input type="radio" name="status<?= $cek_subbab->id_list_pengerjaan_kurikulum; ?>" value = "3" required>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($cek_subbab->status == 2 || $cek_subbab->status == 5){ ?>
                          <textarea name="catatan<?= $cek_subbab->id_list_pengerjaan_kurikulum; ?>" class=""></textarea>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } } ?>
                <?php } ?>
              </table>
              <br>
              <!-- <h6><b>Verifikasi Kesesuaian Kurikulum</b></h6>
              <input type="radio" name="kesesuaian" value="1"> Sesuai
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="kesesuaian" value="0"> Tidak Sesuai
              <br><hr> -->
              <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
              <input type="hidden" name="id_draft_kurikulum" value="<?= $id_draft_kurikulum; ?>">
              <button type="submit" class="btn btn-info">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div> 
</div> 
</div> 
<div class="modal fade" id="detail-bab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_bab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-subbab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_subbab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-bab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-bab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_bab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_bab: $(this).attr('data-bab'),},
        function (html) { $(".body_detail_bab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-subbab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-subbab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_subbab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_subbab: $(this).attr('data-subbab'),},
        function (html) { $(".body_detail_subbab_kurikulum").html(html); }
      );
    });
  });
</script>
<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
  $hari = array ( 1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
);

  $bulan = array (1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
}
return $tgl_indo;
}
?>