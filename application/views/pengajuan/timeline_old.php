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
                    <?php foreach ($kur as $key) { ?>
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
                    <?php } ?>
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