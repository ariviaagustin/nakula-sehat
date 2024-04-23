<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Ubah Bab</h5>
        </div>
        <form action="<?= site_url('bab_dan_sub_bab/aksi_ubah_bab'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Bab<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="bab" required="" value="<?= $bab->bab; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Judul<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="judul" required="" value="<?= $bab->judul; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Status<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="status" value="1" required="" <?php if($bab->status == 1){ echo "checked"; } ?>> Aktif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="2" <?php if($bab->status == 2){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_bab" value="<?= $bab->id_bab; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div></div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>