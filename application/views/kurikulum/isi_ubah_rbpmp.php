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
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Rancang Bangun Pembelajaran Mata Pelatihan (RBPMP)</h5>
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
                <?php if($materi->catatan_rbpmp){ ?>
                    <div class="box_penilaian" style="padding: 15px; border: 2px solid orange; border-radius: 5px; background-color: #ffce85;">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b><i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i> Penilaian <i class="fa fa-star" style="color: #ff5500; font-size: 25px;"></i></b></h5>
                                <p><?= $materi->catatan_rbpmp; ?></p>
                            </div>
                        </div>
                      </div>
                    <hr>
                <?php } ?>
                <table width="100%">
                    <tr>
                        <td style="width: 17%;">Nomor</td>
                        <td style="width: 1%;">:</td>
                        <td colspan="2">
                            <?php 
                                if($materi->jenis_materi == 1){ $a = "MPD"; }
                                else if($materi->jenis_materi == 2){ $a = "MPI";}
                                else if($materi->jenis_materi == 3){ $a = "MPP"; }

                                $cek = $this->M_entitas->selectX('materi', array('jenis_materi' => $materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

                                $id_materi = array();
                                foreach ($cek as $key)
                                {
                                    $id_materi[] = $key->id_materi;
                                }

                                $get_indeks = array_search($materi->id_materi, $id_materi);
                                $no = $get_indeks+1;
                                $nomor = $a.".".$no;
                                echo $nomor;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mata pelatihan</td>
                        <td>:</td>
                        <td colspan="2"><?= $materi->materi; ?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi Mata pelatihan</td>
                        <td>:</td>
                        <td><?= $materi->deskripsi; ?></td>
                        <td style="width: 15%;"><a href="<?= site_url('isi-deskripsi-mata-pelatihan-materi/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"> <i class="fa fa-pen"></i> <?php if($materi->deskripsi){ echo "Ubah Deskripsi"; } else { echo "Isi Deskripsi"; } ?></a></td>
                    </tr>
                    <tr>
                        <td>Hasil Belajar</td>
                        <td>:</td>
                        <td><?= $materi->hasil_belajar; ?></td>
                        <td style="width: 15%;">
                            <a href="<?= site_url('isi-hasil-belajar-materi/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-warning btn-sm" style = "color: #000;"> <i class="fa fa-pen"></i> <?php if($materi->hasil_belajar){ echo "Ubah Hasil Belajar"; } else { echo "Isi Hasil Belajar"; } ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td colspan="2">
                            <?php
                                $jpl = $materi->t + $materi->p + $materi->pl;
                                echo $jpl." JPL (T= ".$materi->t." JPL, P= ".$materi->p." JPL, PL= ".$materi->pl." JPL)";
                            ?>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="indikator_hasil_belajar">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: #000;"><b>A. Indikator Hasil Belajar, Materi dan Sub Materi Pokok</b></h5>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?= site_url('tambah-indikator-hasil-belajar/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table width="100%" border="1">
                                <tr>
                                    <th>Indikator Hasil Belajar</th>
                                    <th>Materi Pokok dan Sub Materi Pokok</th>
                                    <th style="width: 3%;"></th>
                                </tr>
                                <tr>
                                    <td colspan="3">Setelah mengikuti mata pelatihan ini, peserta mampu</td>
                                </tr>
                                <?php if($indikator_hasil_belajar){ ?>
                                    <?php $no = 1; foreach ($indikator_hasil_belajar as $key) { ?>
                                        <tr>
                                            <td><?= $no.". ".$key->indikator_hasil_belajar; ?></td>
                                            <td>
                                                <?= $no.". ".$key->materi_sub_materi_pokok; ?><br>
                                                <?php 
                                                    $get_materi_sub_materi_pokok = $this->M_entitas->selectX('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $key->id_indikator_hasil_belajar))->result();
                                                    if($get_materi_sub_materi_pokok)
                                                    { 
                                                        echo "<ol type='a'>";
                                                        foreach ($get_materi_sub_materi_pokok as $pokok_materi)
                                                        {
                                                            echo "<li>".$pokok_materi->isi_materi_sub_materi_pokok."</li>";
                                                        }
                                                        echo "</ol>";
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="<?= site_url('ubah-indikator-hasil-belajar/'.bin2hex(base64_encode($key->id_indikator_hasil_belajar))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                                <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_indikator_hasil_belajar)); ?>" class = "hapus_indikator_hasil_belajar btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
                                <?php } ?>
                                <?php if(!$indikator_hasil_belajar){ ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">Belum ada data</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="metode">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: #000;"><b>B. Metode & Media Alat Bantu</b></h5>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?= site_url('tambah-metode-materi/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Metode & Alat Bantu</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table width="100%" border="1">
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Metode</th>
                                    <th>Media & Alat Bantu</th>
                                    <th style="width: 3%;"></th>
                                </tr>
                                <?php if($metode){ ?>
                                    <?php $no = 1; foreach ($metode as $key) { ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no; ?>.</td>
                                            <td><?= $key->metode; ?></td>
                                            <td>
                                                <ul style = 'margin-bottom: 0rem;'>
                                                    <?php if($no == 1){ ?>
                                                        <li>Bahan Tayang</li>
                                                        <li>Modul</li>
                                                        <li>Lapotop</li>
                                                        <li>LCD</li>
                                                    <?php } ?>
                                                    <?php 
                                                        $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result();
                                                        if($get_media)
                                                        {
                                                            foreach ($get_media as $gm) 
                                                            {
                                                                echo "<li>".$gm->media_alat_bantu."</li>";
                                                            }

                                                        }
                                                    ?>
                                                </ul>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="<?= site_url('ubah-metode-materi/'.bin2hex(base64_encode($key->id_metode_materi))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                                <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_metode_materi)); ?>" class = "hapus_metode_materi btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
                                <?php } ?>
                                <?php if(!$metode){ ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">Belum ada data</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="media_alat_bantu">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: #000;"><b>C. Referensi</b></h5>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?= site_url('tambah-referensi-materi/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Referensi</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table width="100%" border="1">
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Referensi</th>
                                    <th style="width: 3%;"></th>
                                </tr>
                                <?php if($referensi){ ?>
                                    <?php $no = 1; foreach ($referensi as $key) { ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++; ?>.</td>
                                            <td><?= $key->referensi_materi; ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?= site_url('ubah-referensi-materi/'.bin2hex(base64_encode($key->id_referensi_materi))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                                <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_referensi_materi)); ?>" class = "hapus_referensi_materi btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(!$referensi){ ?>
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
                        <a href="<?= site_url('isi-subbab-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode(5))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="<?= site_url('aksi-isi-ubah-rbpmp/'.bin2hex(base64_encode($materi->id_materi))); ?>" class = "btn btn-info"><i class="fa fa-save"></i> Simpan</a>
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
    $(document).on('click','.hapus_indikator_hasil_belajar',function(e)

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
          url: '<?= site_url('hapus-indikator-hasil-belajar/'); ?>/'+id,
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
    $(document).on('click','.hapus_metode_materi',function(e)

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
          url: '<?= site_url('hapus-metode-materi/'); ?>/'+id,
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