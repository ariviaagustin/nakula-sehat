<style type="text/css">
    th
    {
        text-align: center;
        vertical-align: top;
    }
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Master Data Panduan</h5>
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
                                <th>Role</th>
                                <th>Panduan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($panduan as $key) { ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td>
                                        <?php 
                                            if($key->id_role == 1){ echo "Administrator"; }
                                            else if($key->id_role == 2){ echo "Institusi"; }
                                            else if($key->id_role == 3){ echo "Penilai"; }
                                            else if($key->id_role == 4){ echo "pj substansi"; }
                                        ?>       
                                    </td>
                                    <td>
                                        <?php if($key->panduan){ ?>
                                            <a href="<?= base_url('agenda/perdata/panduan/'.$key->panduan); ?>" class = "btn btn-info btn-sm" target = "_blank"><i class="fa fa-file"></i> Lihat Panduan</a>
                                        <?php } ?>
                                        <?php if(!$key->panduan){ echo "Belum ada panduan"; } ?>
                                    </td>
                                    <td>
                                        <?php if($key->panduan){ ?>
                                            <a href="<?= site_url('ubah-panduan/'.bin2hex(base64_encode($key->id_panduan))); ?>" class = "btn btn-warning btn-sm" title = "Ubah">
                                                <i class="fa fa-pen"></i> Ubah Panduan
                                            </a>
                                        <?php } ?>
                                        <?php if(!$key->panduan){ ?>
                                            <a href="<?= site_url('ubah-panduan/'.bin2hex(base64_encode($key->id_panduan))); ?>" class = "btn btn-info btn-sm" title = "Ubah">
                                                <i class="fa fa-plus"></i> Tambah Panduan
                                            </a>
                                        <?php } ?>
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
<div class="modal fade" id="detail-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-s">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Akun</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_akun"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
          url: '<?= site_url('hapus-pengguna/'); ?>/'+id,
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
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.detail-akun', function (e) {
            e.preventDefault();
            $("#detail-akun").modal('show');
            $.post('<?= site_url('Pengguna/get_detail_akun');?>',
                {id: $(this).attr('data-id')},
                function (html) { $(".body_detail_akun").html(html); }
            );
        });
    });
</script>