<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
          <span style="font-size: 18px; font-weight: 600; color: #000;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h5 style="text-align: center;">Kata Pengantar</h5>
        <p style="text-align: justify-all;"><?php if($kata_pengantar){ echo $kata_pengantar->kata_pengantar; } ?></p>
        <table width="100%">
          <tr>
            <td style="width: 60%;"></td>
            <td class="isi" style="text-align: center; width: 40%;"><?= $kata_pengantar->kota.", ".tanggal_indo($kata_pengantar->tgl_kata_pengantar); ?></td>
          </tr>
          <tr>
            <td></td>
            <td class="isi" style="text-align: center;"><?= $kata_pengantar->jabatan_ttd; ?></td>
          </tr>
          <tr>
            <td colspan="2"><br><br></td>
          </tr>
          <tr>
            <td></td>
            <td class="isi" style="text-align: center;"><?= $kata_pengantar->nama_ttd; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
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