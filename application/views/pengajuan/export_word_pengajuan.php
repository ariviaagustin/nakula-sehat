<?php
    $tgl = date('YmdHis');
    $filename ="Pengajuan".$tgl.".docx";
    header('Content-type: application/ms-word');
    header('Content-Disposition: attachment; filename='.$filename);
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <style type="text/css">
      #divid
      { 
        padding: 0px;
        background-image: url(<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>);
        background-size: 100%;
        background-repeat: no-repeat;
        margin: 0px;
      }
    </style>
  </head>
  <body style="margin: 0px;">
    <table>
      <tr>
        <td colspan="6" class="text-center"><center>Pengajuan</center></td>
      </tr>
      <tr>
        <td colspan="6" class="text-center"><center><?= $pengajuan->judul_kurikulum; ?></center></td>
      </tr>
    </table>
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
