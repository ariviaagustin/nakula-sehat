<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 15px; vertical-align: top; }
  th{ width: 15%; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: #e9e9e9; border-color: #c6c6c6; border-radius: 5px; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pencarian Penilai Baru</h5>
        </div>
        <div class="card-body" style="padding: 10px; color: #000">
            <div class="card-body card-block">
                <div class="box">
                    <form action="<?= site_url('get-verifikasi-kurikulum'); ?>" method = "post">
                        <div class="row">
                            <div class="col-md-2">
                                <label><b>Pilih Penilai</b><span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <select name="id_penilai" required class="form-control select2">
                                    <option value="">-- Pilih Penilai --</option>
                                    <?php foreach ($penilai as $key) { ?>
                                        <option value="<?= $key->id_penilai; ?>"><?= $key->nama_penilai; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                                <button type="submit" class="btn btn-info btn-sm"><b><i class  = "fa fa-save"></i> Simpan</b></button>
                            </div>
                            <div class="col-md-12">
                                <label><span style="color: red">* Wajib diisi</span></label>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <table width="100%">
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
                                        <td style="text-align: center; font-weight: 700;">No</td></td>
                                        <td style="text-align: center; font-weight: 700;">Materi</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700;">A.</td>
                                        <td style="font-weight: 700;">MATERI PELATIHAN DASAR</td>
                                    </tr>
                                    <?php if($materi_dasar){ ?>
                                        <?php $no = 1; foreach ($materi_dasar as $key) { ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++; ?></td>
                                                <td><?= $key->materi; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700;">B.</td>
                                        <td style="font-weight: 700;">MATERI PELATIHAN INTI</td>
                                    </tr>
                                    <?php if($materi_inti){ ?>
                                        <?php $no = 1; foreach ($materi_inti as $key) { ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++; ?></td>
                                                <td><?= $key->materi; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: center; font-weight: 700;">C.</td>
                                        <td style="font-weight: 700;">MATERI PELATIHAN PENUNJANG</td>
                                    </tr>
                                    <?php if($materi_penunjang){ ?>
                                        <?php $no = 1; foreach ($materi_penunjang as $key) { ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++; ?></td>
                                                <td><?= $key->materi; ?></td>
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
                </table>
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