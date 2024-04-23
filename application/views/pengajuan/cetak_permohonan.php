<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    .kepala
    {
      width: 100%;
    }
    .isi
    {
      width: 100%;
    }
    .isi th, td
    {
      padding: 5px;
    }
  </style>
</head>
<body style="margin: 30px 50px;">
  <table class="kepala">
    <tr>
      <td style="width: 15%; padding: 5px;" rowspan="3">
        <img src="<?= base_url('agenda/perdata/logo/logo.png'); ?>" style = "width: 100%;">
      </td>
      <td style="text-align: center; padding: 0px 2px;">
        <h3 style="margin: 0px; text-align: center; font-weight: 800;">KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</h3>
      </td>
      <td style="width: 15%; padding: 5px;" rowspan="3">
        <img src="<?= base_url('agenda/perdata/logo/logogermas.png'); ?>" style = "width: 100%;">
      </td>
    </tr>
    <tr>
      <td style="text-align: center; padding: 0px 3px;">
        <h4 style="margin: 0px; font-weight: 600; text-align: center;">DIREKTORAT JENDERAL TENAGA KESEHATAN</h4>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;">
        <p style="text-align: center; margin: 0px 20px; font-size: 12px;">
          Jalan Hang Jebat III Blok F3 Kebayoran Baru Jakarta Selatan 12120
          <br>
          Telepon : (021)7245517 - 7279 7308 Faksimile : (021) 7279 7508
          <br>
          Laman www.bppsdmk.depkes.go.id
        </p>
      </td>
    </tr>
  </table>
  <hr style="margin-bottom: 5px; border-color: #000;"><hr style="margin-top: 0px; border-color: #000;">
  <h4 style="text-align: center; margin-bottom: 10px; font-weight: 600;"><u>SURAT KETERANGAN PENGESAHAN KURIKULUM</u></h4>
  <p style="margin: 0px; text-align: center; font-weight: 600;">Nomor : <?= $total; ?> / H / Banglat / V / <?= date('Y'); ?></p>
  <br><br>
  <div style="margin: 0px 70px;">
    <p style="text-align: justify;">Berdasarkan keputusan Tim Kurikulum Pusat, menyatakan bahwa kurikulum pelatihan ini sudah :</p>
    <br>
    <h2 style="text-align: center;">"TERDAFTAR"</h2>
    <br>
    <p style="text-align: justify;">Dan dapat digunakan untuk :</p>
  </div>
  <table border="1" class="isi" cellspacing ="0">
    <tr>
      <td style="width: 25%;">Nama Pelatihan</td>
      <td style="width: 3%; text-align: center;">:</td>
      <td><?= $pengajuan->judul_kurikulum; ?></td>
    </tr>
    <tr>
      <td>Jenis Pelatihan</td>
      <td style="width: 3%; text-align: center;">:</td>
      <td>
        <?php 
          $no = 1;
          foreach ($jenis_pembelajaran_pengajuan as $key) 
          {
            foreach ($jenis_pembelajaran as $jp) 
            {
              if($key->id_jenis_pembelajaran == $jp->id_jenis_pembelajaran)
              {
                echo $no++.". ".$jp->jenis_pembelajaran."<br>";
              }
            }
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Jumlah Jpl</td>
      <td style="width: 3%; text-align: center;">:</td>
      <td><?= $pengajuan->jpl; ?></td>
    </tr>
    <tr>
      <td>Jumlah Peserta</td>
      <td style="width: 3%; text-align: center;">:</td>
      <td></td>
    </tr>
  </table>
  <div style="margin: 0px 70px;">
    <p style="text-align: justify;">Dan dilanjutkan untuk pengajuan akreditasi pelatihannya</p>
  </div>
  <br><br>
  <div style="margin: 0px 70px;">
    <table align="right">
      <tr>
        <td>Ditetapkan di</td>
        <td>:</td>
        <td>Jakarta</td>
      </tr>
      <tr>
        <td>Pada Tanggal</td>
        <td>:</td>
        <td><?= tanggal_indo(date('Y-m-d')); ?></td>
      </tr>
      <tr>
        <td colspan="3">
          <p style="margin: 2px;">Direktur Peningkatan Mutu Tenaga Kesehatan</p>
        </td>
      </tr>
      <tr>
        <td colspan="3"><br><br></td>
      </tr>
      <tr>
        <td><b>Doddy Izwardy</b></td>
      </tr>
    </table>
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
<script type="text/javascript">
    window.print();
</script>