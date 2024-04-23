<?php
    $tgl = date('YmdHis');
    $filename ="Pengajuan".$tgl.".xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
?>
<table>
  <tr>
    <td colspan="7" class="text-center"><center>Pengajuan</center></td>
  </tr>
  <tr>
    <td colspan="7" class="text-center"><center>Periode : <?= $periode; ?></center></td>
  </tr>
  <tr>
    <td colspan="7"></td>
  </tr>
</table>
<table>
  <tr>
    <td>Status</td>
    <td style="text-align: center;"> : </td>
    <td><?= $status; ?></td>
  </tr>
  <tr>
    <td>Kelengkapan</td>
    <td style="text-align: center;"> : </td>
    <td><?= $kelengkapan; ?></td>
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
      <th style="vertical-align: middle;">Kelengkapan</th>
      <th style="vertical-align: middle;">Pengaju</th>
      <?php if($this->session->userdata('role') == 1){ ?>
        <th style="vertical-align: middle;">Penilai</th>
      <?php } ?>
      <th style="vertical-align: middle;">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach ($pengajuan as $key) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $key->tahun; ?></td>
        <td><?= $key->judul_kurikulum; ?></td>
        <td>
          <?php
            if($key->kelengkapan == 1){ echo "Judul"; }
            else if($key->kelengkapan < 15){ echo "Belum Lengkap"; }
            else{ echo "Lengkap"; }
          ?>
        </td>
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
        <?php if($this->session->userdata('role') == 1){ ?>
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
        <?php } ?>
        <td style="width: 15%; text-align: center;">
          <?php 
            if($key->status == 1){ echo "Menunggu Verifikasi"; }
            else if($key->status == 2){ echo "Verifikasi Penilai"; }
            else if($key->status == 3){ echo "Dalam Proses"; }
            else if($key->status == 4){ echo "Selesai"; }
            else if($key->status == 100){ echo "Pengajuan Ditolak"; }
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
