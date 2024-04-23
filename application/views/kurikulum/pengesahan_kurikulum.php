<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; text-align:center; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pengesahan Kurikulum</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <div class="row">
          <div class="col-md-6" style="border-right: 1px solid #c6c6c6;">
            <h5><b>Informasi Kurikulum</b></h5>
            <table width="100%">
              <tr>
                <td>Judul Kurikulum</td>
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
              <tr>
                <td>Preview Kurikulum</td>
                <td>:</td>
                <td><a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a></td>
              </tr>
              <?php if($kurikulum->status >= 8){ ?>
                <tr>
                  <td>Penilai</td>
                  <td>:</td>
                  <td><b><?= $kurikulum->nama_penilai; ?></b></td>
                </tr>
              <?php } ?>
              <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></b></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Administrator</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></b></td>
              </tr>
              <tr>
                <td>Deadline Penyusunan Kurikulum</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></b></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Penilai</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_verifikasi_penilai))); ?></b></td>
              </tr>
              <?php if($kurikulum->status > 10){ ?>
                <tr>
                  <td style="width: 20%;">Kategori Pelatihan</td>
                  <td style="width: 2%;">:</td>
                  <td><?= $kurikulum->kategori_pelatihan_name; ?></td>
                </tr>
                <tr>
                  <td>Jenis Pelatihan</td>
                  <td>:</td>
                  <td><?= $kurikulum->jenis_pelatihan_name; ?></td>
                </tr>
                <tr>
                  <td>Nilai SKP</td>
                  <td>:</td>
                  <td><?= $kurikulum->nilai_skp; ?></td>
                </tr>
                <tr>
                  <td style="width: 20%;">Tanggal Pengesahan</td>
                  <td style="width: 2%;">:</td>
                  <td><?= tanggal_indo($kurikulum->tgl_pengesahan); ?></td>
                </tr>
                <tr>
                  <td style="width: 20%;">Pengesahan Oleh</td>
                  <td style="width: 2%;">:</td>
                  <td>
                    <?php 
                        $cek_user = $this->M_entitas->selectX('user', array('id_user' => $kurikulum->pengesahan_oleh))->row();
                        echo $cek_user->nama_lengkap;
                      ?>
                  </td>
                </tr>
                <tr>
                  <td>Surat Pengesahan</td>
                  <td>:</td>
                  <td>
                    <?php if($kurikulum->surat_pengesahan){ ?>
                      <a href="<?= base_url('agenda/perdata/surat_pengesahan/'.$kurikulum->surat_pengesahan); ?>" target = "_blank" class = "btn btn-info btn-sm"><i class="fa fa-file"></i> Surat Pengesahan</a>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td>Surat Keterangan Menilai</td>
                  <td>:</td>
                  <td>
                    <?php if($kurikulum->surat_keterangan_menilai){ ?>
                      <a href="<?= base_url('agenda/perdata/surat_keterangan_menilai/'.$kurikulum->surat_keterangan_menilai); ?>" target = "_blank" class = "btn btn-info btn-sm"><i class="fa fa-file"></i> Surat Keterangan Menilai</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              <?php if($kurikulum->status >= 12){ ?>
                <tr>
                  <td style="width: 20%;">Tanggal Kirim SIAKPEL</td>
                  <td style="width: 2%;">:</td>
                  <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->kirim_siakpel_at)))." ".date('H:i', strtotime($kurikulum->kirim_siakpel_at)); ?></td>
                </tr>
              <?php } ?>
            </table>
          </div>
          <div class="col-md-6">
            <h5><b>Penyusunan Kurikulum</b></h5>
            <table>
              <?php if($kurikulum->status >= 10){ ?>
                <tr>
                  <td><a href="<?= base_url('agenda/perdata/cover/'.$kurikulum->cover); ?>" target = "_blank">Cover</a></td>
                </tr>
                <tr>
                  <td>
                    <a href="#" class="detail-kata-pengantar" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>">Kata Pengantar</a>
                  </td>
                </tr>
              <?php } ?>
              <?php $no = 1; foreach ($bab as $key) { ?>
                <tr>
                  <td><?= $no++; ?>.
                    <?php if($key->is_isi == 1){ ?>
                      <a href="#" class="detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><?= $key->bab." ".$key->judul; ?></a>
                    <?php } ?>
                    <?php if($key->is_isi != 1){ echo $key->bab." ".$key->judul; } ?>
                  </td>
                </tr>
                <?php $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab, 'status' => 1))->result(); if($sub_bab){ $no_sb = "a"; foreach ($sub_bab as $sb) { ?>
                  <tr>
                    <td>
                      &nbsp;&nbsp;&nbsp;
                      <?= $no_sb++; ?>. <a href="#" class="detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><?= $sb->sub_bab; ?></a>
                    </td>
                  </tr>
                <?php } } ?>
              <?php } ?>
              <?php if($kurikulum->status >= 10){ ?>
                <tr>
                  <td>
                    <a href="#" class="detail-tim-penyusun" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>">Tim Penyusun</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <hr>
        <h5><b>Pengesahan Kurikulum<span style="color: red;">*</span></b></h5><br>
        <form action="<?= site_url('Kurikulum/aksi_pengesahan_kurikulum'); ?>" method = "post" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-3">
              <label><b>Kategori Pelatihan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9">
              <select name="kategori_pelatihan_id" class="form-control select2" required>
                <option value="">-- Pilih Kategori Pelatihan --</option>
                <?php foreach ($kategori as $key) { ?>
                  <option value="<?= $key->kategori_pelatihan_id; ?>"><?= $key->kategori_pelatihan_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-3" style="margin-top: 2%;">
              <label><b>Jenis Pelatihan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9" style="margin-top: 2%;">
              <select name="jenis_pelatihan_id" class="form-control select2" required>
                <option value="">-- Pilih Jenis Pelatihan --</option>
                <?php foreach ($jenis as $key) { ?>
                  <option value="<?= $key->jenis_pelatihan_id; ?>"><?= $key->jenis_pelatihan_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-3" style="margin-top: 2%;">
              <label><b>Nilai SKP</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9" style="margin-top: 2%;">
              <input type="text" name="nilai_skp" required class="form-control">
            </div>
            <div class="col-md-3" style="margin-top: 2%;">
              <label><b>Surat Keterangan Menilai Kurikulum</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9" style="margin-top: 2%;">
              <input type="file" name="surat_keterangan_menilai" required class="form-control">
            </div>
            <div class="col-md-3" style="margin-top: 2%;">
              <label><b>Tanggal Pengesahan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9" style="margin-top: 2%;">
              <input type="date" name="tgl_pengesahan" required class="form-control" value="<?= date('Y-m-d'); ?>">
            </div>
            <div class="col-md-3" style="margin-top: 2%;">
              <label><b>Tempat Pengesahan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-9" style="margin-top: 2%;">
              <input type="text" name="tempat_pengesahan" required class="form-control" value="Jakarta">
            </div>
            <div class="col-md-12" style="margin-top: 2%;">
              <label style="color: red;"><b>* Wajib diisi</b></span></label>
            </div>
            <div class="col-md-12" style="text-align: right; margin-top: 2%;">
              <input type="hidden" name="surat_pengesahan_old" value="<?= $kurikulum->surat_pengesahan; ?>">
              <input type="hidden" name="surat_keterangan_menilai_old" value="<?= $kurikulum->surat_keterangan_menilai; ?>">
              <input type="hidden" name="judul_portal" value="<?= $kurikulum->judul_portal; ?>">
              <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
              <button type="submit" class="btn btn-info">Simpan</button>
            </div>
          </div>
        </form>
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
<div class="modal fade" id="detail-kata-pengantar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_kata_pengantar"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-tim-penyusun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_tim_penyusun"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
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
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-kata-pengantar', function (e) {
      e.preventDefault();
      $("#detail-kata-pengantar").modal('show');
      $.post('<?= site_url('Kurikulum/detail_kata_pengantar');?>',
        {id: $(this).attr('data-id'),},
        function (html) { $(".body_detail_kata_pengantar").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-tim-penyusun', function (e) {
      e.preventDefault();
      $("#detail-tim-penyusun").modal('show');
      $.post('<?= site_url('Kurikulum/detail_tim_penyusun');?>',
        {id: $(this).attr('data-id'),},
        function (html) { $(".body_detail_tim_penyusun").html(html); }
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