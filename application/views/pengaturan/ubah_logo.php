<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Ubah Logo</h5>
        </div>
        <form action="<?= site_url('Pengaturan/aksi_ubah_logo'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Logo<span style="color: red;">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <?php if($datalogo->logo){ ?>
                                <img src="<?= base_url('agenda/perdata/bg/'.$datalogo->logo); ?>" style = "width: 150px;"><br><br>
                            <?php } ?>
                            <?php if(!$datalogo->logo){ echo "Belum ada logo"; } ?>
                            <input type="file" class="form-control" name="logo" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <span style="color: red;">*) required</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_logo" value="<?= $datalogo->id_logo; ?>">
                        <input type="hidden" name="logo_old" value="<?= $datalogo->logo; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>