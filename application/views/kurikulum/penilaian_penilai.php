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
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Penilaian Penilai</h5> 
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
          <div class="col-md-12">
            <h5><b>Timeline Penyusunan Kurikulum</b></h5><br>
            <table width="100%" border="1">
              <tr>
                <th><b>Timeline</b></th>
                <th><b>Deadline</b></th>
                <th><b>Status</b></th>
                <th><b>Tanggal Pengiriman</b></th>
              </tr>
              <tr>
                <td>Pengajuan</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;"><i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i></td>
                <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></b></td>
              </tr>
              <tr>
                <td>Verifikasi Admin</td>
                <td style="text-align: center;">-</td>
                <td style="text-align: center;">
                  <?php if($kurikulum->status >= 3){ ?>
                    <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                  <?php } ?>
                </td>
                <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></b></td>
              </tr>
              <tr>
                <td>Penyusunan Kurikulum</td>
                <td style="text-align: center;"><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></b></td>
                <td style="text-align: center;">
                  <?php if($kurikulum->status < 11){ ?>
                    <i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i>
                  <?php } ?>
                  <?php if($kurikulum->status >= 11){ ?>
                    <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                  <?php } ?>
                </td>
                <td style="text-align: center;">
                  <b><?php if($kurikulum->status >= 11){ echo tanggal_indo($kurikulum->tgl_pengesahan); } else { echo "-"; } ?></b>
                </td>
              </tr>
              <?php if($kurikulum->status >= 7){ ?>
                <?php $no = 1; foreach ($draft as $key) { ?>
                  <tr>
                    <td>Pengiriman Penilaian Ke <?= $no; ?></td>
                    <td style="text-align: center; font-weight: bolder;">
                      <?php 
                        if($no == 1)
                        {
                          $get_deadline = $this->M_entitas->get_deadline($kurikulum->pilih_penilai_at);
                          echo tanggal_indo($get_deadline);
                        }
                        else
                        {
                          $get_deadline = $this->M_entitas->get_deadline($key->created_at);
                          echo tanggal_indo($get_deadline);
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if(!$key->updated_at){ ?>
                        <i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i>
                      <?php } ?>
                      <?php if($key->updated_at){ ?>
                        <?php if(count($draft) == 1){ ?>
                          <i class = 'fa fa-spinner' style = 'color: #ffbe09; font-size: 25px;'></i>
                        <?php } ?>
                        <?php if(count($draft) > 1){ ?>
                          <i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>
                        <?php } ?>
                      <?php } ?>
                    </td>
                    <td style="text-align: center; font-weight: bolder;">
                      <?php 
                        if(count($draft) == 1)
                        {
                          echo "-";
                        }
                        else
                        {
                          if($key->updated_at){ echo tanggal_indo(date('Y-m-d', strtotime($key->updated_at))); } else { echo "-"; }
                        }
                      ?>
                    </td>
                  </tr>
                <?php $no++; } ?>
              <?php } ?>
            </table>
            <br>
            <hr>
          </div>
          <div class="col-md-12">
            <h5><b>Penilaian Kurikulum</b></h5><br>
            <table border="1" width="100%">
              <tr style="background-color: burlywood;">
                <th style="width: 2%;">No.</th>
                <th style="width: 35%;">Bab & Sub Bab</th>
                <th>Status Pengerjaan</th>
                <th>Detail</th>
                <th>Penilaian</th>
                <th>Aksi</th>
              </tr>
              <?php $no = 1; foreach ($bab as $key) {  ?>
                <tr <?php if($key->is_isi == 0){ ?> style = "background-color: gainsboro;" <?php } ?>>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><b><?= $key->bab." ".$key->judul; ?></b></td>
                  <td style="text-align: center;">
                    <?php 
                      $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row();
                      if($key->is_isi){
                        if($cek_bab)
                        { 
                          echo "<i class = 'fa fa-check-circle' style = 'color: green; font-size: 25px;'></i>"; 
                        }
                        else
                        {
                          echo "<i class = 'fa fa-times-circle' style = 'color: red; font-size: 25px;'></i>"; 
                        }
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
                    <?php if($key->is_isi){ ?>
                      <?php 
                        $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row(); 
                        if($cek_bab)
                        {
                          $catatan_bab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_bab->id_list_pengerjaan_kurikulum, 'is_pengecekan_penilaian' => 2))->num_rows();
                          if($catatan_bab)
                          {
                            echo "<a href='".site_url("list-penilaian/".bin2hex(base64_encode($cek_bab->id_list_pengerjaan_kurikulum)))."' class='btn btn-info btn-sm' style='background-color: blueviolet; border-color: blueviolet;'><i class='fa fa-star'></i> Lihat Catatan</a>";
                          }
                          else{ echo "Tidak ada catatan"; }
                        }
                      ?>
                    <?php } ?>
                  </td>
                  <td style="text-align: center;">
                    <?php $cek_bab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 1, 'id_bab_subbab' => $key->id_bab))->row(); if($cek_bab){ ?>
                      <?php if($key->is_isi){ ?>
                        <?php if($cek_bab->status == 4 || $cek_bab->status == 9){ ?>
                          <?php $catatan_bab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_bab->id_list_pengerjaan_kurikulum, 'is_pengecekan_penilaian' => 2, 'status' => 1))->row(); if(!$catatan_bab){ ?>
                            <a href="<?= site_url('beri-penilaian-bab/'.bin2hex(base64_encode($cek_bab->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                          <?php } ?>
                          <?php if($catatan_bab){ ?>
                            <a href="<?= site_url('ubah-penilaian-bab/'.bin2hex(base64_encode($catatan_bab->id_catatan))); ?>" class = "btn btn-warning btn-sm" style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                          <?php } ?>
                        <?php } ?>
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
                      <?php 
                        $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row();
                        if($cek_subbab)
                        {
                          $catatan_subbab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_subbab->id_list_pengerjaan_kurikulum, 'is_pengecekan_penilaian' => 2))->num_rows();
                          if($catatan_subbab)
                          {
                            echo "<a href='".site_url("list-penilaian/".bin2hex(base64_encode($cek_subbab->id_list_pengerjaan_kurikulum)))."' class='btn btn-info btn-sm' style='background-color: blueviolet; border-color: blueviolet;'><i class='fa fa-star'></i> Lihat Catatan</a>";
                          }
                          else{ echo "Tidak ada catatan"; }
                        }
                      ?>
                    </td>
                    <td style="text-align: center;">
                      <?php $cek_subbab = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_bab_subbab' => 2, 'id_bab_subbab' => $sb->id_sub_bab))->row(); if($cek_subbab){ ?>
                        <?php if($cek_subbab->status == 4 || $cek_subbab->status == 9){ ?>
                          <?php $catatan_subbab = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_list_pengerjaan_kurikulum' => $cek_subbab->id_list_pengerjaan_kurikulum, 'is_pengecekan_penilaian' => 2, 'status' => 1))->row(); if(!$catatan_subbab){ ?>
                            <a href="<?= site_url('beri-penilaian-subbab/'.bin2hex(base64_encode($cek_subbab->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"><i class="fa fa-pen"></i> Berikan Penilaian</a>
                          <?php } ?>
                          <?php if($catatan_subbab){ ?>
                            <a href="<?= site_url('ubah-penilaian-subbab/'.bin2hex(base64_encode($catatan_subbab->id_catatan))); ?>" class = "btn btn-warning btn-sm"  style = "color: #fff; background-color: #7459ff; border-color: #7459ff;"><i class="fa fa-pen"></i> Ubah Penilaian</a>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                  </td>
                  </tr>
                <?php } } ?>
              <?php } ?>
            </table>
          </div>
        </div>
        <?php if($kurikulum->status == 7){ ?>
          <hr>
          <?php $get_penilaian = $this->M_entitas->selectX('catatan_pengecekan_penilaian', array('id_kurikulum' => $kurikulum->id_kurikulum, 'is_pengecekan_penilaian' => 2, 'status' => 1))->num_rows(); ?>
          <table width="100%">
            <tr>
              <td colspan="3">
                <div class="alert alert-info" style="text-align: center; color: #0e075c;">
                  <p style="font-size: 18px;"><b><i class="fa fa-info-circle"></i> <b>Kirim penilaian kurikulum ke pj substansi</b></p>
                  <p>Kurikulum akan dikirim kembali ke pj substansi untuk diperbaiki sesuai dengan penilaian yang diberikan oleh Tim Penilai</p>
                  <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-draft = "<?= bin2hex(base64_encode($last_draft->id_draft_kurikulum)); ?>" class = "kirim_penilaian btn btn-info <?php if($get_penilaian == 0){ echo 'disabled'; } ?> " style = "background-color: #0e075c; border-color: #0e075c;" title = "Kirim Penilaian Kurikulum Ke pj substansi"><b><i class="fa fa-paper-plane"></i> Kirim Penilaian Kurikulum Ke pj substansi</b></a>
                </div>
              </td>
            </tr>
            <?php if($get_penilaian == 0){ ?>
              <tr>
                <td><hr></td>
                <td style="width: 1%;"><b>ATAU</b></td>
                <td><hr></td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="alert alert-success" style="text-align: center; color: #1e542b;">
                    <p style="font-size: 18px;"><b><i class="fa fa-check-circle"></i> Kirim penilaian kurikulum ke Admin Pusat</b></p><p><b>Apabila Kurikulum telah sesuai, silahkan kirim kurikulum ke Admin Pusat untuk disahkan.</b></p>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" class = "selesaikan_kurikulum btn btn-success" style = "background-color: #0b8d04; border-color: #0b8d04;" title = "Kirim Kurikulum Ke Admin"><b><i class="fa fa-check-circle"></i> Kirim Kurikulum Ke Admin</b></a>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </table>
        <?php } ?>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.kirim_penilaian',function(e)
  {
    swal({
      title: "Kirim Penilaian ?",
      text: "",
      icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willSend) => {
      if (willSend) {
        var id = $(this).attr('data-id');
        var draft = $(this).attr('data-draft');
        swal("Data Terkirim", 
        {
          icon: "success",
          buttons: false
        });
        $.ajax({
          url: '<?= site_url('kirim-penilaian-kurikulum/'); ?>/'+id+'/'+draft,
          success: function(data) {
            window.location = "<?= site_url('kurikulum/?status=perbaikan-kurikulum'); ?>";
          }
        }); 
      } else {
        swal("Gagal Mengirim Kurikulum");
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).on('click','.selesaikan_kurikulum',function(e)
  {
    swal({
      title: "Apakah anda yakin menyelesaikan penyusunan kurikulum ?",
      text: "",
      icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willSend) => {
      if (willSend) {
        var id = $(this).attr('data-id');
        swal("Data Terkirim", 
        {
          icon: "success",
          buttons: false
        });
        $.ajax({
          url: '<?= site_url('selesaikan-kurikulum/'); ?>/'+id,
          success: function(data) {
            window.location = "<?= site_url('kurikulum/?status=selesai'); ?>";
          }
        }); 
      } else {
        swal("Gagal");
      }
    });
  });
</script>
<script type="text/javascript">
  function myFunction() {
    var x = document.getElementById("tampil_penilaian_menyeluruh");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.detail-pj-substansi', function (e) {
            e.preventDefault();
            $("#detail-pj-substansi").modal('show');
            $.post('<?= site_url('Kurikulum/get_detail_pj_substansi');?>',
                {id: $(this).attr('data-id')},
                function (html) { $(".body_detail_pj_substansi").html(html); }
            );
        });
    });
</script>
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