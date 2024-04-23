<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: #e9e9e9; border-color: #c6c6c6; border-radius: 5px; }
  .btn-surat-pengantar{ background-color: darkgoldenrod; border-color: darkgoldenrod; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Konfirmasi Kelanjutan Penyusunan Kurikulum</h5>
        </div>
        <div class="card-body" style="padding: 10px; color: #000">
            <div class="card-body card-block">
                <h5><b>Informasi Kurikulum</b></h5>
                <table width="100%">
                    <tr>
                        <td style="width: 25%;">Judul Kurikulum</td>
                        <td style="width: 1%;">:</td>
                        <td><?= $kurikulum->judul; ?></td>
                    </tr>
                    <tr>
                        <td>Institusi</td>
                        <td>:</td>
                        <td><?= $kurikulum->nama_institusi; ?></td>
                    </tr>
                    <tr>
                        <td>pj substansi</td>
                        <td>:</td>
                        <td><?= $kurikulum->nama_sdm; ?></td>
                    </tr>
                    <tr>
                        <td>JPL</td>
                        <td>:</td>
                        <td><?= $kurikulum->jumlah_jpl; ?></td>
                    </tr>
                    <tr>
                        <td>KAK/TOR</td>
                        <td>:</td>
                        <td>
                        <?php if($kurikulum->kak_tor){ ?>
                            <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank">KAK TOR</a>
                        <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Surat Pengantar</td>
                        <td>:</td>
                        <td>
                            <?php if($kurikulum->kak_tor){ ?>
                                <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Pengantar</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Preview Kurikulum</td>
                        <td>:</td>
                        <td><a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><i class="fa fa-eye"></i> Preview Kurikulum</a></td>
                    </tr>
                    <?php if($kurikulum->status_sebelumnya >= 8){ ?>
                        <tr>
                            <td>Penilai</td>
                            <td>:</td>
                            <td><?= $kurikulum->nama_penilai; ?></td>
                            </tr>
                    <?php } ?>
                    <tr>
                        <td>Tanggal Pengajuan</td>
                        <td>:</td>
                        <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></td>
                    </tr>
                    <tr>
                    <td>Tanggal Verifikasi Administrator</td>
                        <td>:</td>
                        <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></td>
                    </tr>
                    <tr>
                        <td>Deadline Penyusunan Kurikulum</td>
                        <td>:</td>
                        <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?= $kurikulum->keterangan_status; ?></td>
                    </tr>
                    <tr>
                        <td>Alasan Dihentikan</td>
                        <td>:</td>
                        <td><?= $kurikulum->alasan_dihentikan; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Dihentikan</td>
                        <td>:</td>
                        <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->waktu_dihentikan))); ?></td>
                    </tr>
                    <tr>
                        <td>Status Sebelum Dihentikan</td>
                        <td>:</td>
                        <td><?= $kurikulum->keterangan_status_sebelumnya; ?></td>
                    </tr>
                </table>
                <hr>
                <div class="box">
                    <form action="<?= site_url('Kurikulum/aksi_konfirmasi_kelanjutan_penyusunan_kurikulum'); ?>" method = "post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <label><b>Lanjutkan Penyusunan Kurikulum</b></label>
                            </div>
                            <div class="col-md-8">
                                <input type="radio" name="status_dihentikan" value="4" required> Ya, Lanjutkan penyusunan kurikulum
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status_dihentikan" value="7" required> Tidak, Penyusunan kurikulum akan dihentikan
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1%;">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                                <input type="hidden" name="waktu_dihentikan" value="<?= $kurikulum->waktu_dihentikan; ?>">
                                <input type="hidden" name="dihentikan_oleh" value="<?= $kurikulum->dihentikan_oleh; ?>">
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