<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Metode</h5>
        </div>
        <div class="col-md-6" style="text-align: right;">
          <a href="<?= site_url('tambah-metode'); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah</a>
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
                <th>Metode</th>
                <th>Penugasan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($metode as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><?= $key->metode; ?></td>
                  <td>
                    <?php
                      if($key->is_penugasan == 1){ echo "Penugasan"; }
                      else { echo "Bukan Penugasan"; }
                    ?>
                  </td>
                  <td>
                    <?php
                      if($key->status == 1){ echo "Aktif"; }
                      else { echo "Tidak Aktif"; }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <a href="<?= site_url('ubah-metode/'.bin2hex(base64_encode($key->id_metode))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_metode)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.hapus',function(e)

    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('hapus-metode/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
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