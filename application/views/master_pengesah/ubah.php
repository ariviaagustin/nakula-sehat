<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Master Pengesah</h5>
        </div>
        <form action="<?= site_url('Master_pengesah/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nama<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nama" required="" value="<?= $pengesah->nama; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">NIP<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nip" required="" value="<?= $pengesah->nip; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jabatan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="jabatan" required="" value="<?= $pengesah->jabatan; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">TTD<?php if(!$pengesah->ttd){ ?><span style="color: red">*</span><?php } ?></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <?php if($pengesah->ttd){ ?>
                                <img src="<?= base_url('agenda/perdata/pengesah/'.$pengesah->ttd); ?>" style = "width: 100px;">
                            <?php } ?>
                            <?php if(!$pengesah->ttd){ echo "belum ada ttd"; } ?>
                            <br><br>
                            <input type="file" class="form-control" name="ttd" <?php if(!$pengesah->ttd){ echo "required"; } ?>>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_master_pengesah" value="<?= $pengesah->id_master_pengesah; ?>">
                        <input type="hidden" name="ttd_old" value="<?= $pengesah->ttd; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>