<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <h3 style="text-align: center;">Permohonan</h3>
  <h5 style="text-align: center;">Periode : <?= $periode; ?></h5>
  <table>
    <tr>
      <td>Status</td>
      <td> : </td>
      <td><?= $status; ?></td>
    </tr>
  </table>
  <br>
  <table border="1" width="100%">
    <thead>
      <tr>
        <th style="vertical-align: middle;">No.</th>
        <th style="vertical-align: middle;">Tahun</th>
        <th style="vertical-align: middle;">Judul</th>
        <th style="vertical-align: middle;">Pengaju</th>
        <th style="vertical-align: middle;">Penilai</th>
        <th style="vertical-align: middle;">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($permohonan as $key) { ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $key->tahun; ?></td>
          <td><?= $key->judul_kurikulum; ?></td>
          <td>
            <?php 
              foreach ($pengaju as $data) 
              {
                if($data->id_pengaju == $key->pengaju)
                {
                  echo $data->nama_pengaju;
                }
              }
            ?>
          </td>
          <td>
            <?php  
              if($key->status > 1)
              {
                foreach ($penilai as $data) 
                {
                  if($data->id_penilai == $key->id_penilai)
                  {
                    echo $data->nama_penilai;
                  }
                }
              }
              else{ echo ""; }
            ?>
          </td>
          <td style="width: 15%; text-align: center;">
            <?php 
              if($key->status == 5){ echo "Permohonan Pengajuan"; }
              else if($key->status == 6){ echo "Sudah Disetujui"; }
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
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
<script type="text/javascript">
    window.print();
</script>