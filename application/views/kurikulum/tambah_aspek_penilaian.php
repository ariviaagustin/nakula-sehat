<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Tambah Aspek Penilaian Instrumen Evaluasi</h5>
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
        <form action="<?= site_url('Kurikulum/aksi_tambah_aspek_penilaian'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jenis Penilaian<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <!-- <input type="radio" name="jenis_penilaian" value="1" required=""> Instrumen Evaluasi Hasil Belajar Peserta
                            <br> -->
                            <input type="radio" name="jenis_penilaian" value="2" required=""> Instrumen Evaluasi Fasilitator
                            <br>
                            <input type="radio" name="jenis_penilaian" value="3" required=""> Instrumen Evaluasi Penyelenggara
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Aspek Penilaian<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="aspek_penilaian" required="">
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
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>