<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Request Hubungi Penilai</h5>
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
                <th>Kurikulum</th>
                <th>Institusi</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($get_request as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td>
                    <?php 
                      $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $key->id_kurikulum))->row();
                      echo $get_kurikulum->judul;
                    ?>
                  </td>
                  <td>
                    <?php 
                      $get_kurikulum = $this->M_entitas->selectX('kurikulum', array('id_kurikulum' => $key->id_kurikulum))->row();
                      echo $get_kurikulum->nama_institusi;
                    ?>
                  </td>
                  <td>
                    <?php 
                      if($key->status == 1)
                      {
                        echo "Request Hubungi Penilai";
                      }
                    ?>
                  </td>
                  <td>
                    <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_request_hub_penilai)); ?>" class = "setujui btn btn-success btn-sm" title = "Setujui Request"><i class="fa fa-check-circle"></i> Setujui Request</a>
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
    $(document).on('click','.setujui',function(e)
    {
        swal({
          title: "Setujui Request ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Request Disetujui", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('setujui-request/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal");
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