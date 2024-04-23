<!DOCTYPE html>
<html>
<body style="color: #000;">
  <table width="100%">
    <tr>
      <th  style="width: 15%;"><img src="<?= base_url('agenda/perdata/logo/kop_surat.png'); ?>" style = "width: 100%;"></th>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <th style="width: 100%; text-align: center;"><span style="font-weight: bolder; font-size: 15px;">SURAT KETERANGAN PENGESAHAN KURIKULUM</span></th>
    </tr>
    <tr>
      <td style="text-align: center;">NOMOR : PL.02.01/F.V/<?= $jumlah_kurikulum; ?>/<?= date('Y'); ?></td>
    </tr>
  </table>
  <br>
  <table width="100%">
    <tr>
      <td colspan="3">Yang bertanda tangan di bawah ini</td>
    </tr>
    <tr>
      <td colspan="3"><br></td>
    </tr>
    <tr>
      <td style="padding-left: 70px; width: 21%;">nama</td>
      <td style="width: 1%;">:</td>
      <td><?= $master_pengesah->nama; ?></td>
    </tr>
    <tr>
      <td style="padding-left: 70px;">NIP</td>
      <td>:</td>
      <td><?= $master_pengesah->nip; ?></td>
    </tr>
    <tr>
      <td style="padding-left: 70px;">jabatan</td>
      <td>:</td>
      <td><?= $master_pengesah->jabatan; ?></td>
    </tr>
  </table>
  <br>
  <p style="text-align: justify;">
    dengan ini menerangkan bahwa berdasarkan keputusan Tim Penilai Kurikulum. Kurikulum Pelatihan  <?= $kurikulum->judul; ?> :
  </p>
  <h2 style="text-align: center;"><b>"TERDAFTAR"</b></h2>
  <table width="100%">
    <tr>
      <td colspan="3">dan dapat digunakan sebagai acuan dalam penyelenggaraan pelatihan :</td>
    </tr>
    <tr>
      <td colspan="3"><br></td>
    </tr>
    <tr>
      <td style="padding-left: 20px; width: 21%;">Nama Pelatihan</td>
      <td style="width: 1%;">:</td>
      <td><?= $kurikulum->judul; ?></td>
    </tr>
    <tr>
      <td style="padding-left: 20px;">Jenis Pelatihan</td>
      <td>:</td>
      <td><?= $kurikulum->jenis_pelatihan_name; ?></td>
    </tr>
    <tr>
      <td style="padding-left: 20px;">Jumlah Jpl</td>
      <td>:</td>
      <td><?= $kurikulum->jumlah_jpl; ?> JPL</td>
    </tr>
    <tr>
      <td style="padding-left: 20px;">Jumlah SKP</td>
      <td>:</td>
      <td><?= $kurikulum->nilai_skp; ?> SKP</td>
    </tr>
    <tr>
      <td style="padding-left: 20px;">Jumlah Peserta</td>
      <td>:</td>
      <td><?= $kurikulum->jumlah_peserta; ?></td>
    </tr>
    <tr>
      <td style="padding-left: 20px;">Instansi</td>
      <td>:</td>
      <td><?= $kurikulum->nama_institusi; ?></td>
    </tr>
  </table>
  <p style="text-indent: 70px; text-align: justify;">
    Kurikulum yang sudah disahkan ini dapat di perbaharui sewaktu – waktu, sesuai dengan perkembangan ilmu pengetahuan dan teknologi terbaru. <br> Demikian surat keterangan ini dibuat untuk digunakan dalam pengajuan penyelengggaraan pelatihan.
  </p>
  <p style="page-break-before: always"></p>
  <table width="100%">
    <tr>
      <td style = "width: 50%;"></td>
      <td style="width: 15%">Ditetapkan di</td>
      <td style="width: 2%;">:</td>
      <td><?= $kurikulum->tempat_pengesahan; ?></td>
    </tr>
    <tr>
      <td></td>
      <td>Pada tanggal</td>
      <td>:</td>
      <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengesahan))); ?></td>
    </tr>
    <tr>
      <td style = "width: 50%;"></td>
      <td colspan="3"><?= $master_pengesah->jabatan; ?>,</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3" style="text-align: left;">
        <img src="<?= base_url('agenda/perdata/pengesah/'.$master_pengesah->ttd); ?>">
      </td>
    </tr>
    <tr>
      <td style = "width: 50%;"></td>
      <td colspan="3"><b><?= $master_pengesah->nama; ?></b></td>
    </tr>
  </table>
  <br>
  <table border="1" cellspacing="0">
    <tr>
      <td style="text-align: center;">
        <span style="font-size: 12px">
          Kementerian Kesehatan tidak menerima suap dan/atau gratifikasi dalam bentuk apapun. Jika terdapat potensi suap atau gratifikasi silahkan laporkan melalui HALO KEMENKES 1500567 dan <a href="https://wbs.kemkes.go.id" target="_blank">https://wbs.kemkes.go.id</a>. Untuk verifikasi keaslian tanda tangan elektronik, silahkan unggah dokumen pada laman <a href="https://tte.kominfo.go.id/verifyPDF" target="_blank">https://tte.kominfo.go.id/verifyPDF</a>.
        </span>
      </td>
    </tr>
  </table>
</body>
</html>
<script type="text/javascript">
    window.print();
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