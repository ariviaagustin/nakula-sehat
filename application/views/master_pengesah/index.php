<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-12">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Master Pengesah</h5>
        </div>
      </div>
    </div>
    <div class="card-body" style="padding: 10px">
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>TTD</th>
                <th>Last Updated</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pengesah as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><?= $key->nip; ?></td>
                  <td><?= $key->nama; ?></td>
                  <td><?= $key->jabatan; ?></td>
                  <td>
                    <?php if($key->ttd){ ?>
                      <img src="<?= base_url('agenda/perdata/pengesah/'.$key->ttd); ?>" style = "width: 50%;">
                    <?php } ?>
                  </td>
                  <td><?= tanggal_indo(date('Y-m-d', strtotime($key->updated_at)))." ".date('H:i', strtotime($key->updated_at)); ?></td>
                  <td>
                    <a href="<?= site_url('ubah-master-pengesah/'.bin2hex(base64_encode($key->id_master_pengesah))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
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