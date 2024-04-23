<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center !important; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px">
    <div class="card-header py-3" style="background-color: #fff">
      <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Riwayat Revisi</h5>
    </div>
    <div class="card-body" style="padding: 10px">
      <table width="100%">
        <tr>
          <td style="width: 17%"><h5 style="font-size: 17px; color: #000">Kurikulum</h5></td>
          <td style="width: 2%"><h5 style="font-size: 17px; color: #000"> : </h5></td>
          <td><h5 style="font-size: 17px; color: #000"><?= $pengajuan->judul_kurikulum; ?></h5></td>
        </tr>
        <tr>
          <td style="width: 17%"><h5 style="font-size: 17px; color: #000">Bagian</h5></td>
          <td style="width: 2%"><h5 style="font-size: 17px; color: #000"> : </h5></td>
          <td><h5 style="font-size: 17px; color: #000"><?= $bagian->nama_alias; ?></h5></td>
        </tr>
        <tr>
          <td style="width: 17%"><h5 style="font-size: 17px; color: #000">Tanggal Revisi</h5></td>
          <td style="width: 2%"><h5 style="font-size: 17px; color: #000"> : </h5></td>
          <td><h5 style="font-size: 17px; color: #000"><?= tanggal_indo($riwayat->waktu_revisi); ?></h5></td>
        </tr>
      </table>
      <hr>
      <p><?= $riwayat->isi_revisi; ?></p>
    </div>
  </div>
</div></div>
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