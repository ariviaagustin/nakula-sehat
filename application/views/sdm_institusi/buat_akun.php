<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Buat Akun</h5>
                </div>
            </div>
        </div>
        <form action="<?= site_url('Sdm_institusi/aksi_buat_akun'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nama SDM<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <?= $sdm->nama_sdm; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Username<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Password<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" class="form-control" name="password" id="pass" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Konfirmasi Password<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" class="form-control" id="konfirm" required>
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
                            <input type="hidden" name="id_sdm_institusi" value="<?= $sdm->id_sdm_institusi; ?>">
                            <input type="hidden" name="id_sdm_siaksi" value="<?= $sdm->id_sdm_siaksi; ?>">
                            <input type="hidden" name="nama_lengkap" value="<?= $sdm->nama_sdm; ?>">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.onload = function () {
        document.getElementById("pass").onchange = validatePassword;
        document.getElementById("konfirm").onchange = validatePassword;
    }
    function validatePassword(){
        var pass2=document.getElementById("pass").value;
        var pass1=document.getElementById("konfirm").value;
        if(pass1!=pass2)
            document.getElementById("konfirm").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("konfirm").setCustomValidity('');
    }
</script>