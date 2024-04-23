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
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pemilihan Penilai</h5> 
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
              <tr>
                <td>Preview Kurikulum</td>
                <td>:</td>
                <td>
                  <a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a>
                </td>
              </tr>
            </table>
            <hr>
          </div>
          <div class="col-md-12">
            <h5><b>Pilih Penilai<span style="color: red;">*</span></b></h5><br>
            <form action="<?= site_url('Kurikulum/aksi_pemilihan_penilai'); ?>" method = "post">
              <div class="row">
                <div class="col-md-12">
                  <select name="id_penilai" class="form-control select2" required>
                    <option value="">-- Pilih Penilai</option>
                    <?php foreach ($penilai as $key) { ?>
                      <option value="<?= $key->id_penilai; ?>"><?= $key->nama_penilai; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-12"><hr><span style="color: red;">*) Wajib diisi</span></div>
                <div class="col-md-12" style="text-align: right;">
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
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