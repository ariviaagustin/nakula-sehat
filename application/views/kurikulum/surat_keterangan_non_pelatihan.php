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
      <td style="width: 20%;"></td>
      <th style="width: 60%;"><span style="font-weight: bolder; font-size: 15px;">SURAT KETERANGAN PENGEMBANGAN KOMPETENSI</span></th>
      <td></td>
    </tr>
    <tr>
      <td style="text-align: right;"><b>Nomor.</b></td>
      <td colspan="2"></td>
    </tr>
  </table>
  <br>
  <span>Yth pj substansi <?= $kurikulum->nama_institusi; ?></span>
  <br>
  <p style="text-align: justify; text-indent: 70px; line-height: 25px; margin-bottom: 0px; padding-bottom: 0px;">
    Berdasarkan surat Saudara no <?php if($kurikulum->no_surat_pengantar){ echo $kurikulum->no_surat_pengantar; } ?> tanggal <?php if($kurikulum->tanggal_surat_pengantar){ echo tanggal_indo($kurikulum->tanggal_surat_pengantar); } ?> hal <?php if($kurikulum->perihal_surat_pengantar){ echo $kurikulum->perihal_surat_pengantar; } ?> Dengan ini kami infomasikan bahwa berdasarkan hasil verifikasi usulan pengesahan kurikulum pelatihan yang Saudara ajukan, maka usulan tidak dapat dilanjutkan dikarenakan kompetensi yang akan dikembangkan, tidak perlu dicapai dengan pelatihan. Pencapaian kompetensi tersebut dapat dilakukan melalui pengembangan kompetensi lainnya yaitu <b>(workshop/ seminar/ dll)</b>.
  </p>
  <p style="text-align: justify; text-indent: 70px; line-height: 25px; margin-top: 0px; padding-top: 0px;">
    Kegiatan pengembangan kompetensi lainnya dapat diajukan untuk registrasi dan pengajuan Satuan Kredit Profesi (SKP) melalui laman <a href="https://siaksi.kemkes.go.id/" target="_blank">https://siaksi.kemkes.go.id/</a>, untuk selanjutnya kegiatan pembelajaran sampai dengan penerbitan sertifikat dilakukan pada Platform Pembelajaran Digital Kesehatan (Plataran Sehat).
  </p>
  <p style="text-align: justify; text-indent: 70px; line-height: 25px;">
    Atas perhatian dan kerjasama Saudara, diucapkan terima kasih 
  </p>
  <table width="100%">
    <tr>
      <td style = "width: 50%;"></td>
      <td style="width: 15%">Ditetapkan di</td>
      <td style="width: 2%;">:</td>
      <td>Jakarta</td>
    </tr>
    <tr>
      <td></td>
      <td>Pada tanggal</td>
      <td>:</td>
      <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></td>
    </tr>
    <tr>
      <td style = "width: 50%;"></td>
      <td colspan="3"><?= $pengesah->jabatan; ?>,</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="3" style="text-align: center;">
        <img src="<?= base_url('agenda/perdata/pengesah/'.$pengesah->ttd); ?>">
      </td>
    </tr>
    <tr>
      <td style = "width: 50%;"></td>
      <td colspan="3"><b><?= $pengesah->nama; ?></b></td>
    </tr>
    <tr>
      <td style = "width: 50%;"></td>
      <td colspan="3">NIP <?= $pengesah->nip; ?></td>
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