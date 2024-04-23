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
  <div>
    <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style="width: 900px; height: 1200px;">
    <!-- <div style="width: 2500px; height: 1590px;"></div> -->
  </div>
  <div style="page-break-after: always;"><br></div>
  <!-- <div style="page-break-after: always;"><br></div> -->
  <!-- <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt;"><b>PENGAJUAN KURIKULUM</b></h3>
    <br>
    <h3 style="text-align: center; font-size: 14pt"><b><?= $pengajuan->judul_kurikulum; ?></b></h3>
    <br>
    <p style="text-align: center; margin-bottom: 8%; font-size: 12pt"><?= $pengaju->nama_pengaju; ?></p>
    <center>
      <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>">
    </center>
    <table align="center" style="margin-top: 10%; margin-bottom: 10%">
      <tr>
        <td>Disusun Oleh:</td>
      </tr>
      <?php $tim = explode(";", $pengajuan->tim_penyusun); foreach ($tim as $key) { ?>
        <tr>
          <td><?= $key; ?></td>
        </tr>
      <?php } ?>
    </table>
    <h3 style="text-align: center; text-transform: uppercase; font-size: 12pt"><b><?= $pengajuan->lembaga; ?></b></h3>
    <h3 style="text-align: center; margin-bottom: 8%; font-size: 12pt"><?= $pengajuan->tahun; ?></h3>
  </div> -->
  <div style="page-break-after: always;"><br></div>
  <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt"><b>Kata Pengantar</b></h3>
    <p style="text-align: justify;"><?= $bagian[0]->isi_bagian_kurikulum; ?></p>
  </div>
  <div style="page-break-after: always;"><br></div>
  <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt"><b>Bab I</b></h3>
    <h3 style="text-align: center; font-size: 14pt"><b>Pendahuluan</b></h3>
    <br>
    <?php $no = 1; foreach ($bagian as $key) { ?>
      <?php if($key->id_bagian > 1 && $key->id_bagian < 4){ ?>
        <h3 style="font-size: 13pt">
          <?php 
            $kur = explode("-", $key->bagian_kurikulum); 
            $kur = substr($kur[1], 1);
            echo "1.".$no++.". ".$kur;
          ?>
        </h3>
        <p style="text-align: justify;"><?= $key->isi_bagian_kurikulum; ?></p>
        <br>
      <?php } ?>
    <?php } ?>
  </div>
  <div style="page-break-after: always;"><br></div>
  <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt"><b>Bab II</b></h3>
    <br>
    <?php $no = 1; foreach ($bagian as $key) { ?>
      <?php if($key->id_bagian > 3 && $key->id_bagian < 9){ ?>
        <h3 style="font-size: 13pt">
          <?php 
            $kur = explode("-", $key->bagian_kurikulum); 
            $kur = substr($kur[1], 1);
            echo "2.".$no++.". ".$kur;
          ?>
        </h3>
        <p style="text-align: justify;"><?= $key->isi_bagian_kurikulum; ?></p>
        <br>
      <?php } ?>
    <?php } ?>
  </div>
  <div style="page-break-after: always;"><br></div>
  <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt"><b>Bab III</b></h3>
    <br>
    <?php $no = 1; foreach ($bagian as $key) { ?>
      <?php if($key->id_bagian == 9){ ?>
        <h3 style="font-size: 13pt">
          <?php 
            $kur = explode("-", $key->bagian_kurikulum); 
            $kur = substr($kur[1], 1);
            echo "3.".$no++.". ".$kur;
          ?>
        </h3>
        <p style="text-align: justify;"><?= $key->isi_bagian_kurikulum; ?></p>
        <br>
      <?php } ?>
    <?php } ?>
  </div>
  <div style="page-break-after: always;"><br></div>
  <div style="margin: 76px 113px">
    <h3 style="text-align: center; font-size: 14pt"><b>Lampiran</b></h3>
    <br>
    <?php $no = 1; foreach ($bagian as $key) { ?>
      <?php if($key->id_bagian > 9){ ?>
        <h3 style="font-size: 13pt">
          <?php 
            $kur = explode("-", $key->bagian_kurikulum); 
            $kur = substr($kur[1], 1);
            echo "Lampiran ".$no++.". ".$kur;
          ?>
        </h3>
        <p style="text-align: justify;"><?= $key->isi_bagian_kurikulum; ?></p>
        <br>
      <?php } ?>
    <?php } ?>
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