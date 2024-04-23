<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center !important; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px">
    <div class="card-header py-3" style="background-color: #fff">
      <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Riwayat Revisi <?= $pengajuan->judul_kurikulum; ?></h5>
    </div>
    <div class="card-body" style="padding: 10px">
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Bagian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($riwayat as $key) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $key->nama_alias; ?></td>
                  <td style="text-align: center;">
                    <a href="<?= site_url('riwayat-bagian/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian))); ?>" class = "btn btn-info btn-sm" title = "Lihat"><li class="fa fa-eye"></li></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div></div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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