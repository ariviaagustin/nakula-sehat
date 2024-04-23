<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 15px; vertical-align: top; }
  th{ width: 15%; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: #e9e9e9; border-color: #c6c6c6; border-radius: 5px; }
  .btn-surat-pengantar{ background-color: darkgoldenrod; border-color: darkgoldenrod; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Verifikasi Pengajuan Pengembangan Kompetensi</h5>
        </div>
        <div class="card-body" style="padding: 10px; color: #000">
            <div class="card-body card-block">
                <table width="100%">
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>:</td>
                        <td><?= tanggal_indo($kurikulum->tgl_pengajuan); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Institusi</th>
                        <td>:</td>
                        <td><?= $kurikulum->nama_institusi; ?></td>
                    </tr>
                    <tr>
                        <th>Judul Kurikulum</th>
                        <td>:</td>
                        <td><?= $kurikulum->judul; ?></td>
                    </tr>
                    <tr>
                        <th>Tujuan</th>
                        <td>:</td>
                        <td><?= $kurikulum->tujuan; ?></td>
                    </tr>
                    <tr>
                        <th>Kompetensi</th>
                        <td>:</td>
                        <td>
                            <?= $kurikulum->kompetensi; ?>
                            <br>
                            <?php 
                                if($kompetensi)
                                {
                                    $no = 1;
                                    foreach ($kompetensi as $key) 
                                    {
                                        echo $no++.". ".$key->isi_kompetensi."<br>";
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Materi</th>
                        <td>:</td>
                        <td>
                            <?php if($materi){ ?>
                                <table width="100%" border="1">
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; padding: 5px;">No</td></td>
                                        <td style="text-align: center; font-weight: 700; padding: 5px;">Materi</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; padding: 5px;">A.</td>
                                        <td style="font-weight: 700; padding: 5px;">MATERI PELATIHAN DASAR</td>
                                    </tr>
                                    <?php if($materi_dasar){ ?>
                                        <?php $no = 1; foreach ($materi_dasar as $key) { ?>
                                            <tr>
                                                <td style="text-align: center; padding: 5px;"><?= $no++; ?></td>
                                                <td style="padding: 5px;"><?= $key->materi; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; padding: 5px;">B.</td>
                                        <td style="font-weight: 700; padding: 5px;">MATERI PELATIHAN INTI</td>
                                    </tr>
                                    <?php if($materi_inti){ ?>
                                        <?php $no = 1; foreach ($materi_inti as $key) { ?>
                                            <tr>
                                                <td style="text-align: center; padding: 5px;"><?= $no++; ?></td>
                                                <td style="padding: 5px;"><?= $key->materi; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; padding: 5px;">C.</td>
                                        <td style="font-weight: 700; padding: 5px;">MATERI PELATIHAN PENUNJANG</td>
                                    </tr>
                                    <?php if($materi_penunjang){ ?>
                                        <?php $no = 1; foreach ($materi_penunjang as $key) { ?>
                                            <tr>
                                                <td style="text-align: center; padding: 5px;"><?= $no++; ?></td>
                                                <td style="padding: 5px;"><?= $key->materi; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah JPL</th>
                        <td>:</td>
                        <td><?= $kurikulum->jumlah_jpl; ?></td>
                    </tr>
                    <tr>
                        <th>Sasaran Peserta</th>
                        <td>:</td>
                        <td>
                            <?= $kurikulum->sasaran_peserta; ?>
                            <br>
                            <?php 
                                if($peserta)
                                {
                                    $no = 1;
                                    foreach ($peserta as $key) 
                                    {
                                        echo $no++.". ".$key->isi_peserta."<br>";
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>KAK/TOR</th>
                        <td>:</td>
                        <td>
                            <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm btn-kaktor" target = "_blank">KAK/TOR</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Pengantar</th>
                        <td>:</td>
                        <td>
                            <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm btn-surat-pengantar" target = "_blank">Surat Pengantar</a>
                        </td>
                    </tr>
                </table>
                <hr>
                <h6><b>Verifikasi Kurikulum</b></h6>
                <br>
                <div class="alert alert-<?= $alert; ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <span><b><i class="<?= $icon; ?>"></i> <?= $msg; ?></b></span>
                    <br>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $ket; ?></span>
                </div>
                <form action="<?= site_url('verifikasi-kebutuhan-pelatihan/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" method = "get">
                    <div class="row">
                        <div class="col-md-12">
                            <label><b>Judul Kurikulum</b></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="judul" value="<?= $judul_isi; ?>" class = "form-control" required placeholder = "Judul Kurikulum, Kata Kunci, Materi, dll">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-sm btn-cek-kurikulum"><b>Cek Kurikulum</b></button>
                        </div>
                    </div>
                </form>
                <?php if($ketersediaan_kurikulum == 1){ ?>
                    <br>
                    <h6><b>Kurikulum Terkait</b></h6>
                    <ol>
                        <?php foreach ($kurikulum_tersedia as $key) { ?>
                            <?php 
                                $a = kurikulum_siakpel_helper($key['pelatihan_id']);
                                $b = json_decode($a,true);
                                $get_data = $b['data'];
                                $get_data = $get_data[0];
                            ?>
                            <li><a href="<?= $get_data['url_file'].$get_data['f_kurikulum']; ?>" target = "_blank"><?= $key['pelatihan_name']; ?></a></li>
                        <?php } ?>
                    </ol>
                <?php } ?>
                <br>
                <div class="box">
                    <form action="<?= site_url('aksi-verifikasi-ketersediaan-kurikulum'); ?>" method = "post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label><b>Verifikasi Pengajuan Pengembangan Kompetensi</b></label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label><b>Ketersediaan Kurikulum</b></label>
                            </div>
                            <div class="col-md-8">
                                <input type="radio" name="ketersediaan_kurikulum" value="1" required id="tersedia"> Tersedia
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="ketersediaan_kurikulum" value="2" required id="tidak_tersedia"> Tidak Tersedia
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div id="verif_kebutuhan" style="display: none; margin-top: 1%;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><b>Kebutuhan Pengembangan Kompetensi</b></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="radio" name="kebutuhan_pelatihan" value="1" id="pelatihan"> Pelatihan
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="kebutuhan_pelatihan" value="2" id="non_pelatihan"> Non Pelatihan
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1%;">
                            <div class="col-md-12" style="text-align: right;">
                                <hr>
                                <?php if(!$this->input->get('judul')){ ?>
                                    <input type="hidden" name="kata_kunci" value="<?= $kurikulum->judul; ?>">
                                <?php } ?>
                                <?php if($this->input->get('judul')){ ?>
                                    <input type="hidden" name="kata_kunci" value="<?= $this->input->get('judul'); ?>">
                                <?php } ?>
                                <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                                <input type="hidden" name="judul_portal" value="<?= $kurikulum->judul_portal; ?>">
                                <button type="submit" class="btn btn-info btn-sm btn-cek-kurikulum"><b>Simpan</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    $('#tersedia').change(function(){
        $("#verif_kebutuhan").hide();
    });
    $('#tidak_tersedia').change(function(){
        $("#verif_kebutuhan").show();
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