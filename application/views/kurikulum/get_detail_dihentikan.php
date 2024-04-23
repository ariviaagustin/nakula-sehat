<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top;}
  h6{ margin-bottom: 2%; }
</style>
<body style="color: #000;">
  <?php
    if($kurikulum->dihentikan_oleh == 0){ $dihentikan_oleh = "Sistem"; }
    else
    {
      $cek_user = $this->M_entitas->selectX('user', array('id_user' => $kurikulum->dihentikan_oleh))->row();
      $dihentikan_oleh = $cek_user->role; 
    }
  ?>
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <h6><b>Informasi Penghentian Penyusunan Kurikulum</b></h6>
        <?php if($kurikulum->status_dihentikan == 1){ ?>
          <div class="alert alert-danger">
            <p style="text-align: justify;">
              <i class="fa fa-times-circle"></i> <b>Pengajuan Non Pelatihan</b>
              <br>
              Pengajuan Pengembangan Kompetensi Merupakan Kebutuhan Non Pelatihan
            </p>
          </div>
        <?php } ?>
        <?php if($kurikulum->status_dihentikan == 2){ ?>
          <div class="alert alert-success">
            <p style="text-align: justify;">
              <i class="fa fa-check-circle"></i> <b>Pengajuan Tersedia Di SIAKPEL</b>
              <br>
              Pengajuan Pengembangan Kompetensi Telah Tersedia Di SIAKPEL
            </p>
          </div>
        <?php } ?>
        <table width="100%">
          <tr>
            <td style="width: 25%;">Waktu Dihentikan</td>
            <td style="width: 1%">:</td>
            <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->waktu_dihentikan)))." ".date('H:i', strtotime($kurikulum->waktu_dihentikan)); ?></td>
          </tr>
          <tr>
            <td style="width: 25%;">Dihentikan Oleh</td>
            <td style="width: 1%">:</td>
            <td><?= $dihentikan_oleh; ?></td>
          </tr>
          <tr>
            <td style="width: 25%;">Alasan Dihentikan</td>
            <td style="width: 1%">:</td>
            <td><?= $kurikulum->alasan_dihentikan; ?></td>
          </tr>
          <tr>
            <td style="width: 25%;">Status Dihentikan</td>
            <td style="width: 1%">:</td>
            <td><?= $kurikulum->keterangan_status_dihentikan; ?></td>
          </tr>
          <?php if($kurikulum->status_dihentikan == 1){ ?>
            <tr>
              <td style="width: 25%;">Surat Keterangan</td>
              <td style="width: 1%">:</td>
              <td>
                <a href="<?= site_url('Kurikulum/surat_keterangan_non_pelatihan/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Keterangan</a>
                <!-- <a href="<?= base_url('agenda/perdata/surat_rekomendasi/non_pelatihan/'.$kurikulum->surat_rekomendasi); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Keterangan</a> -->
              </td>
            </tr>
          <?php } ?>
          <?php if($kurikulum->status_dihentikan == 2){ ?>
            <tr>
              <td style="width: 25%;">Surat Keterangan</td>
              <td style="width: 1%">:</td>
              <td>
                <a href="<?= site_url('Kurikulum/surat_keterangan_ketersediaan_kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Keterangan</a>
                <!-- <a href="<?= base_url('agenda/perdata/surat_rekomendasi/kurikulum_tersedia/'.$kurikulum->surat_rekomendasi); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Keterangan</a> -->
              </td>
            </tr>
          <?php } ?>
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