<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
  .btn-kompetensi{ background-color: crimson; border-color:crimson; }
  .btn-materi{ background-color: darkblue; border-color: darkblue; }
  .btn-sasaran{ background-color: forestgreen; border-color: forestgreen; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-surat-rekomendasi{ background-color: coral; border-color: coral; }
  .btn-waktu-pengerjaan{ background-color: brown; border-color: brown; }
  td{ font-weight:600; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">
            <?php 
              if($list->is_bab_subbab == 1)
              {
                echo "List Catatan ".$bab_subbab->bab." - ".$bab_subbab->judul;
              }
              else
              {
                echo "List Catatan ".$bab_subbab->bab." - ".$bab_subbab->sub_bab;
              }
            ?>
          </h5>
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
                <th>Tanggal</th>
                <th>Penilai</th>
                <th>Status</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($catatan as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td style="text-align: center;"><?= tanggal_indo(date('Y-m-d', strtotime($key->created_at)))." ".date('H:i:s', strtotime($key->created_at)); ?></td>
                  <td>
                    <?php 
                      $get_user = $this->M_entitas->selectX('user', array('id_user' => $key->created_by))->row();
                      echo $get_user->role;
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <?php 
                      if($key->status == 1){ echo "Belum ada perbaikan"; }
                      else if($key->status == 2){ echo "Telah Diperbaiki"; }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <a href="<?= site_url('lihat-penilaian/'.bin2hex(base64_encode($key->id_catatan))); ?>" class="btn btn-info btn-sm" style="background-color: blueviolet; border-color: blueviolet;"><i class="fa fa-star"></i> Lihat Penilaian</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <?php if($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 4){ ?>
            <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
          <?php } ?>
          <?php if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 3){ ?>
            <a href="<?= site_url('penilaian-penilai/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
          <?php } ?>
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