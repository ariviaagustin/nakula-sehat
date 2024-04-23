<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">ubah Materi</h5>
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
        <form action="<?= site_url('Kurikulum/aksi_ubah_materi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jenis Materi<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="jenis_materi" value="1" required="" <?php if($materi->jenis_materi == 1){ echo "checked"; } ?>> Materi Dasar
                            <br>
                            <input type="radio" name="jenis_materi" value="2" required="" <?php if($materi->jenis_materi == 2){ echo "checked"; } ?>> Materi Inti
                            <br>
                            <input type="radio" name="jenis_materi" value="3" required="" <?php if($materi->jenis_materi == 3){ echo "checked"; } ?>> Materi Penunjang
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Materi<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="materi" required="" value="<?= $materi->materi; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jumlah Teori<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" class="form-control" name="t" required="" value="<?= $materi->t; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jumlah Penugasan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" class="form-control" name="p" required="" value="<?= $materi->p; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jumlah Praktik Lapangan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" class="form-control" name="pl" required="" value="<?= $materi->pl; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                            <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>