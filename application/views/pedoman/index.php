<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pedoman Penyusunan Kurikulum</h5>
        </div>
        <?php if($this->session->userdata('id_role') == 1){ ?>
          <div class="col-md-6" style="text-align: right;">
            <a href="<?= site_url('ubah-pedoman'); ?>" class = "btn btn-warning"><i class="fas fa-fw fa-pen"></i> Ubah</a>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="card-body" style="padding: 10px; color: #000">
      <?php if($this->session->flashdata("msg")){ ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
          <span><?= $this->session->flashdata("msg"); ?></span>
        </div>
      <?php } ?>
      <?php if($pedoman){ ?>
        <iframe src="<?= base_url('agenda/perdata/pedoman/'.$pedoman->pedoman); ?>" style = "width: 100%; height: 1000px;"></iframe>
      <?php } ?>
      <?php if(!$pedoman){ echo "Belum ada pedoman"; } ?>
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
          url: '<?= site_url('hapus-pedoman/'); ?>/'+id,
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