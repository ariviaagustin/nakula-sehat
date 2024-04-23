<style type="text/css">
    #content{ background-color: #fff; }
    th, td{ padding: 10px; vertical-align: top; }
    th{ width: 15%; text-align:center; }
    .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
    .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
    .box{ padding: 15px; background-color: lightblue; border-color: lightblue; border-radius: 5px; text-align:center; color: #000; box-shadow :0 0 20px rgb(0 0 0 / 20%) } 
    .box:hover { border: 1px solid #1f3384;}
    a:hover{text-decoration:none; }
   .aktif{ background-color:coral; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Instrumen Evaluasi</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body card-block">
                <?php if($get_catatan){ ?>
                    <div class="box_penilaian" style="padding: 15px; border: 2px solid orange; border-radius: 5px; background-color: #ffce85;">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b><i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i> Penilaian <i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i></b></h5>
                                <p><?= $get_catatan->catatan; ?></p>
                                <?php if($get_catatan->keterangan){ ?>
                                    <h5><b>Catatan</b></h5>
                                    <p><?php if($get_catatan->keterangan){ echo $get_catatan->keterangan; } else { echo "Tidak ada catatan"; } ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
                <div class="peserta">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="color: #000;"><b>Instrumen Evaluasi Hasil Belajar Peserta</b></h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible">
                                <span><b><i class="fa fa-info-circle"></i> Silahkan upload instrumen evaluasi peserta berupa file. Instrumen evaluasi peserta dapat berupa soal, dll. </b></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= site_url('Kurikulum/aksi_isi_instrumen_evaluasi_peserta'); ?>" method = "post" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                                <table width="100%">
                                    <tr>
                                        <td style="width: 10%;"><b>Upload file</b></td>
                                        <td><input type="file" name="instrumen_evaluasi_peserta" class="form-control" required id="file" onchange="fileValidation()" accept="application/pdf"></td>
                                        <td>
                                            <input type="hidden" name="instrumen_evaluasi_peserta_old" value="<?= $kurikulum->instrumen_evaluasi_peserta; ?>" required="">
                                            <input type="hidden" name="judul_portal" value="<?= $kurikulum->judul_portal; ?>">
                                            <button type="submit" class="btn btn-info">Simpan</button>
                                        </td>
                                    </tr>
                                    <?php if($kurikulum->instrumen_evaluasi_peserta){ ?>
                                        <tr>
                                            <td><b>File</b></td>
                                            <td colspan="2">
                                                <a href="<?= base_url('agenda/perdata/instrumen_evaluasi_peserta/'.$kurikulum->instrumen_evaluasi_peserta); ?>" target = "_blank" class = "btn btn-info btn-sm">Instrumen Evaluasi Peserta</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <form action="<?= site_url('Kurikulum/aksi_isi_subbab_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <?php if($catatan > 0){ ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <span><i class="fa fa fa-info-circle"></i> Anda memiliki catatan penilaian untuk diperbaiki. Apabila catatan penilaian sudah diperbaiki, silahkan pilih "Ya"</span>
                                </div>
                                <h6>Apakah sudah diperbaiki ?</h6>
                                <input type="radio" name="is_perbaikan" value="1"> Ya
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="is_perbaikan" value="2"> Tidak
                            </div>
                        </div>
                    <?php } ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-10" style="text-align: right;">
                            <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                            <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
                            <?php if($list){ ?>
                                <input type="hidden" name="id_list_pengerjaan_kurikulum" value="<?= $list->id_list_pengerjaan_kurikulum; ?>">
                            <?php } ?>
                            <?php if($list == NULl){ ?>
                                <input type="hidden" name="id_list_pengerjaan_kurikulum" value="0">
                            <?php } ?>
                            <button type="submit" class="btn btn-info" <?php if(!$kurikulum->instrumen_evaluasi_peserta){ echo "disabled"; } ?>>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    function fileValidation()
    {
        const fileInput = document.getElementById("file");
        var filePath = $("#file").val();
        var allowedExtensions = ["pdf"];
        var aux = filePath.split('.');
        var extension = aux[aux.length -1].toLowerCase();
        console.log(extension);
        if(allowedExtensions.indexOf(extension) > -1)
        {
            if (fileInput.files.length > 0) 
            { 
                for (const i = 0; i <= fileInput.files.length - 1; i++) 
                {  
                    const fsize = fileInput.files.item(i).size; 
                    const file = Math.round((fsize / 1024));
                } 
            }
        }
        else
        {
            alert("file tidak sesuai");
            fileInput.value = '';
            return false;
        }
    }
</script>
<script type="text/javascript">
    $(document).on('click','.hapus_nilai_instrumen_evaluasi',function(e)

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
          url: '<?= site_url('hapus-nilai-instrumen-evaluasi/'); ?>/'+id,
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
    $(document).on('click','.hapus_aspek_penilaian',function(e)

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
          url: '<?= site_url('hapus-aspek-penilaian/'); ?>/'+id,
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
    $(document).on('click','.hapus_media_alat_bantu_materi',function(e)

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
          url: '<?= site_url('hapus-media-alat-bantu-materi/'); ?>/'+id,
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
    $(document).on('click','.hapus_referensi_materi',function(e)

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
          url: '<?= site_url('hapus-referensi-materi/'); ?>/'+id,
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