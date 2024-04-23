<?php
    $tgl = date('YmdHis');
    $filename ="Permohonan".$tgl.".xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
?>
<table>
  <tr>
    <td colspan="6" class="text-center"><center>Permohonan</center></td>
  </tr>
  <tr>
    <td colspan="6" class="text-center"><center>Periode : <?= $periode; ?></center></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>
</table>
<table>
  <tr>
    <td>Status</td>
    <td style="text-align: center;"> : </td>
    <td><?= $status; ?></td>
  </tr>
  <tr>
    <td colspan="7"></td>
  </tr>
</table>
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
