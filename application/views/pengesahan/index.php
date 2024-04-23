<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-handshake"></i> Pengesahan</h1>
  <br>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
              <h5 class="m-0 font-weight-bold text-primary">Pengesahan</h5>
            </div>
            <div class="col-md-6" style="text-align: right;">
              <a href="#" class = "btn btn-danger btn-sm"><i class="fas fa-fw fa-file-pdf"></i> PDF</a>
              <a href="#" class = "btn btn-success btn-sm"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tahun</th>
                <th>Judul Pengajuan</th>
                <th>Kelengkapan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pengesahan as $key) {  ?>
                <tr>
                  <td><?= $no++; ?>.</td>
                  <td><?= $key->tahun; ?></td>
                  <td></td>
                  <td><?= $key->status; ?></td>
                  <td>
                      <a href="<?= site_url('detail-pengesahan/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-info btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                      <a href="<?= site_url('verifikasi-pengesahan/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-warning btn-sm" title = "Verifikasi"><li class="fa fa-spinner"></li></a>
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