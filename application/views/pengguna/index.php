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
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Pengguna</h5>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <a href="<?= site_url('tambah-pengguna'); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah Administrator</a>
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
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th style="width: 12%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($user as $key) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $key->nama_lengkap; ?></td>
                                    <td><?= $key->username; ?></td>
                                    <td><?= $key->role; ?></td>
                                    <td style="text-align: center;">
                                        <?php if($key->id_role != 2){ ?>
                                            <a href="<?= site_url('ubah-pengguna/'.bin2hex(base64_encode($key->id_user))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                            <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_user)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                                        <?php } ?>
                                        <?php if($this->session->userdata('is_admin_acp') == 1){ ?>
                                            <a href="#" class="btn btn-info btn-sm detail-akun" style="background-color: blue; border-color: blue;" data-id="<?= $key->id_user; ?>"><i class="fa fa-eye"></i></a>
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