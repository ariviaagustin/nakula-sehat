<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-12">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab & Sub Bab</h5>
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
                <th>Bab & Sub Bab</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($bab as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><b><?= $key->bab." ".$key->judul; ?></b></td>
                  <td><?php if($key->status == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></td>
                  <td style="text-align: center;">
                    <a href="<?= site_url('ubah-bab/'.bin2hex(base64_encode($key->id_bab))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                  </td>
                </tr>
                <?php $no_sub_bab = "a"; $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab))->result(); if($sub_bab){ foreach ($sub_bab as $sb) { ?>
                  <tr>
                    <td></td>
                    <td><?= $no_sub_bab++.". ".$sb->sub_bab; ?></td>
                    <td><?php if($sb->status == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></td>
                    <td style="text-align: center;">
                      <a href="<?= site_url('ubah-sub-bab/'.bin2hex(base64_encode($sb->id_sub_bab))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                    </td>
                  </tr>
                <?php } } ?>
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
  $(document).ready( function () {
    $('#dataTable').DataTable({
      "ordering": false,
      "lengthMenu": [[20, 50, -1], [20, 50, "All"]],
       "columnDefs": [
      {
        "targets": [ 0 ], //first column / numbering column
        "orderable": false, //set not orderable
      },
      ],
    }

      );
} );
</script>
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
          url: '<?= site_url('hapus-penilai/'); ?>/'+id,
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