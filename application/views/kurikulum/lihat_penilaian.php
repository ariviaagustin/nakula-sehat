<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; vertical-align:top; }
  th, td{ padding:10px; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-10">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">
            Catatan
            <?php 
              if($is_bab_subbab == 1){ echo $bab_subbab->bab." ".$bab_subbab->judul; }
              else if($is_bab_subbab == 2){ echo $bab_subbab->sub_bab; }
            ?>
          </h5>
        </div>
      </div>
    </div>
    <div class="card-body" style="padding: 10px; color: #000;">
      <table width="100%">
        <tr>
          <td style="width: 20%;">Tanggal</td>
          <td style="width: 1%;">:</td>
          <td><?= tanggal_indo(date('Y-m-d', strtotime($catatan->created_at)))." ".date('H:i:s', strtotime($catatan->created_at)); ?></td>
        </tr>
        <tr>
          <td>Dicek / Dinilai oleh</td>
          <td>:</td>
          <td>
            <?php 
              $get_user = $this->M_entitas->selectX('user', array('id_user' => $catatan->created_by))->row();
              echo $get_user->role;
            ?>
          </td>
        </tr>
        <tr>
          <td>Status</td>
          <td>:</td>
          <td>
            <?php 
              if($catatan->status == 1){ echo "Belum ada perbaikan"; }
              else if($catatan->status == 2){ echo "Telah Diperbaiki"; } 
            ?>
          </td>
        </tr>
      </table>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <h5><b>Catatan</b></h5>
          <p><?= $catatan->catatan; ?></p>
          <hr><br>
          <h5><b>Keterangan</b></h5>
          <br>
          <p><?php if($catatan->keterangan){ echo $catatan->keterangan; } else { echo "Tidak ada"; } ?></p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <a href="<?= site_url('list-penilaian/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
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