<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Media & Alat Bantu</h5>
        </div>
        <form action="<?= site_url('Media_alat_bantu/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Metode<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="id_metode" class="form-control" required>
                                <option value="">-- Pilih Metode --</option>
                                <?php foreach ($metode as $key) { ?>
                                    <option value="<?= $key->id_metode; ?>" <?php if($key->id_metode == $media_alat_bantu->id_metode){ echo "selected"; } ?>><?= $key->metode; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Media & Alat Bantu<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="media_alat_bantu" required="" value="<?= $media_alat_bantu->media_alat_bantu; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Status<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="status" required="" value="1" <?php if($media_alat_bantu->status == 1){ echo "checked"; } ?>> Aktif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" required="" value="0" <?php if($media_alat_bantu->status == 0){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_media_alat_bantu" value="<?= $media_alat_bantu->id_media_alat_bantu; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>