<style type="text/css">
    #content{ background-color: #fff; }
    th, td{ padding: 5px; vertical-align: top; }
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
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Lampiran</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
                    <span style="font-size: 18px; font-weight: 600; color: #000;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body card-block">
                <?php $catatan_praktik_lapang = $this->M_entitas->selectX('catatan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->row(); if($catatan_praktik_lapang){ if($catatan_praktik_lapang->catatan){ ?>
                    <div class="box_penilaian" style="padding: 15px; border: 2px solid orange; border-radius: 5px; background-color: #ffce85;">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b><i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i> Penilaian <i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i></b></h5>
                                <p><?= $catatan_praktik_lapang->catatan; ?></p>
                            </div>
                        </div>
                    </div>
                  <hr>
                <?php } } ?>
                <h5>Materi yang menggunakan metode Praktik Lapang:</h5>
                <ol>
                    <?php foreach ($materi_pl as $key) { ?>
                        <li><?= $key->materi; ?></li>
                    <?php } ?>
                </ol>
                <table width="100%">
                    <tr>
                        <td style="text-align: center;"><h5 style="font-size: 18px;"><b>PANDUAN PRAKTIK LAPANG</b></h5></td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td>
                            <b><u>Waktu:</u></b>
                            <?php 
                                $total_jpl = $jpl * 60;
                                echo $jpl." JPL x 60 menit = ".$total_jpl." menit";
                            ?>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="petunjuk">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: #000;"><b>Petunjuk</b></h5>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?= site_url('tambah-petunjuk-panduan-praktik-lapang/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Petunjuk Panduan Praktik Lapang</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table width="100%" border="1">
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Petunjuk</th>
                                    <th style="width: 3%;"></th>
                                </tr>
                                <?php if($petunjuk){ ?>
                                    <?php $no = 1; foreach ($petunjuk as $key) { ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++; ?>.</td>
                                            <td><?= $key->panduan_penugasan; ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?= site_url('ubah-petunjuk-panduan-praktik-lapang/'.bin2hex(base64_encode($key->id_panduan_praktik_lapang))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                                <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_panduan_praktik_lapang)); ?>" class = "hapus_petunjuk_panduan_praktik_lapang btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(!$petunjuk){ ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">Belum ada data</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?= site_url('isi-subbab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode(7))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="<?= site_url('aksi-isi-ubah-panduan-praktik-lapang/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-info"><i class="fa fa-save"></i> Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.hapus_petunjuk_panduan_praktik_lapang',function(e)

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
          url: '<?= site_url('hapus-petunjuk-panduan-praktik-lapang/'); ?>/'+id,
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