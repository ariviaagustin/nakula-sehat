<style type="text/css">
  #content { background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Timeline</h5>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding: 0px">
            <div class="card-body card-block" style="padding: 0px">
                <h6><b>Kurikulum : <?= $pengajuan->judul_kurikulum; ?></b></h6>
                <hr>
                <form action="<?= site_url('Pengajuan/aksi_timeline'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="kata_pengantar" value = "1">
                    <div class="row form-group">
                        <div class="col col-md-5">
                            <label for="text-input" class=" form-control-label">Kata Pengantar</label>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_mulai_kp" class = "form-control" required>
                        </div>
                        <div class="col-1 col-md-1">
                            <p style="text-align: center;"> sampai </p>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_selesai_kp" class = "form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="bab_satu" value = "2">
                    <div class="row form-group">
                        <div class="col col-md-5">
                            <label for="text-input" class=" form-control-label">Bab 1 <a href="#" data-toggle="modal" data-target="#bab_satu"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 14px; color: #444"></i></a></label>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_mulai_babsatu" class = "form-control" required>
                        </div>
                        <div class="col-1 col-md-1">
                            <p style="text-align: center;"> sampai </p>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_selesai_babsatu" class = "form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="bab_dua" value = "3">
                    <div class="row form-group">
                        <div class="col col-md-5">
                            <label for="text-input" class=" form-control-label">Bab 2 <a href="#" data-toggle="modal" data-target="#bab_dua"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 14px; color: #444"></i></a></label>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_mulai_babdua" class = "form-control" required>
                        </div>
                        <div class="col-1 col-md-1">
                            <p style="text-align: center;"> sampai </p>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_selesai_babdua" class = "form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="bab_tiga" value = "4">
                    <div class="row form-group">
                        <div class="col col-md-5">
                            <label for="text-input" class=" form-control-label">Bab 3 <a href="#" data-toggle="modal" data-target="#bab_tiga"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 14px; color: #444"></i></a></label>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_mulai_babtiga" class = "form-control" required>
                        </div>
                        <div class="col-1 col-md-1">
                            <p style="text-align: center;"> sampai </p>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_selesai_babtiga" class = "form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="lampiran" value = "4">
                    <div class="row form-group">
                        <div class="col col-md-5">
                            <label for="text-input" class=" form-control-label">Lampiran <a href="#" data-toggle="modal" data-target="#lampiran"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 14px; color: #444"></i></a></label>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_mulai_lampiran" class = "form-control" required>
                        </div>
                        <div class="col-1 col-md-1">
                            <p style="text-align: center;"> sampai </p>
                        </div>
                        <div class="col-3 col-md-3">
                            <input type="date" name="waktu_selesai_lampiran" class = "form-control" required>
                        </div>
                    </div>
                    <!-- <?php foreach ($kur as $key) { ?>
                        <input type="hidden" name="id_bagian<?= $key->id_bagian; ?>" value = "<?= $key->id_bagian; ?>">
                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="text-input" class=" form-control-label"><?= $key->nama_alias; ?></label>
                            </div>
                            <div class="col-3 col-md-3">
                                <input type="date" name="waktu_mulai<?= $key->id_bagian; ?>" class = "form-control" required>
                            </div>
                            <div class="col-1 col-md-1">
                                <p style="text-align: center;"> sampai </p>
                            </div>
                            <div class="col-3 col-md-3">
                                <input type="date" name="waktu_selesai<?= $key->id_bagian; ?>" class = "form-control" required>
                            </div>
                        </div>
                    <?php } ?> -->
                    <hr>
                    <div class="row form-group">
                        <div class="col col-md-12" style="text-align: right;">
                            <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                            <input type="hidden" name="penilai" value="<?= $pengajuan->id_penilai; ?>">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="bab_satu" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" style="color: #000"><b>Bab 1</b></h6>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="color: #000">
            <ul>
                <?php foreach ($kur as $key) { ?>
                    <?php if($key->id_bagian == 2 || $key->id_bagian == 3){ ?>
                        <li><?= $key->nama_alias; ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="bab_dua" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" style="color: #000"><b>Bab 2</b></h6>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="color: #000">
            <ul>
                <?php foreach ($kur as $key) { ?>
                    <?php if($key->id_bagian > 3 && $key->id_bagian < 9){ ?>
                        <li><?= $key->nama_alias; ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="bab_tiga" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" style="color: #000"><b>Bab 3</b></h6>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="color: #000">
            <ul>
                <?php foreach ($kur as $key) { ?>
                    <?php if($key->id_bagian == 9){ ?>
                        <li><?= $key->nama_alias; ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="lampiran" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" style="color: #000"><b>Lampiran</b></h6>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" style="color: #000">
            <ul>
                <?php foreach ($kur as $key) { ?>
                    <?php if($key->id_bagian > 9){ ?>
                        <li><?= $key->nama_alias; ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>