<style type="text/css">
  #content{ background-color: #fff; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pemilihan Ketentuan Kurikulum</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <table width="100%">
          <tr>
            <td style="width: 17%; vertical-align: top;"><h5><b>Detail Kurikulum</b></h5><br></td>
            <td style="width: 2%; vertical-align: top;">:</td>
            <td style="vertical-align:top;"><a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a></td>
          </tr>
        </table>
        <hr>
        <h5><b>Pilih Ketentuan<span style="color: red;">*</span></b></h5><br>
        <form action="<?= site_url('Kurikulum/aksi_pemilihan_ketentuan_kurikulum'); ?>" method = "post">
          <div class="row">
            <div class="col-md-2">
              <label><b>Kategori Pelatihan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10">
              <select name="kategori_pelatihan_id" class="form-control" required>
                <option value="">-- Pilih Kategori Pelatihan --</option>
                <?php foreach ($kategori as $key) { ?>
                  <option value="<?= $key->kategori_pelatihan_id; ?>"><?= $key->kategori_pelatihan_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Jenis Pelatihan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <select name="jenis_pelatihan_id" class="form-control" required>
                <option value="">-- Pilih Jenis Pelatihan --</option>
                <?php foreach ($jenis as $key) { ?>
                  <option value="<?= $key->jenis_pelatihan_id; ?>"><?= $key->jenis_pelatihan_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Nilai SKP</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <input type="text" name="nilai_skp" required class="form-control">
            </div>
            <div class="col-md-12" style="margin-top: 2%;">
              <label style="color: red;"><b>* Wajib diisi</b></span></label>
            </div>
            <div class="col-md-12" style="text-align: right; margin-top: 2%;">
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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