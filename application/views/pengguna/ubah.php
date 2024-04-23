<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Ubah</h5>
                </div>
            </div>
        </div>
        <form action="<?= site_url('Pengguna/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Role<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <?= $user->role; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Username<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="username" value="<?= $user->username; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" class="form-control" name="password" id="pass">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Konfirmasi Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" class="form-control" id="konfirm">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Status<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="status" value="1" <?php if($user->status == 1){ echo "checked"; } ?>> Aktif
                            <input type="radio" name="status" value="0" <?php if($user->status == 0){ echo "checked"; } ?>> Tidak Aktif
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
                            <input type="hidden" name="id_user" value="<?= $user->id_user; ?>">
                            <input type="hidden" name="password_old" value="<?= $user->password; ?>">
                            <input type="hidden" name="pass_old" value="<?= $another->password; ?>">
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
<script type="text/javascript">
    function getSelectValue()
    {
        var role = document.getElementById("role").value;
        if(role == "")
        {
            $("#nama_pj").hide();
            $("#prodi").hide();
        }

        if(role == "1")
        {
            $("#nama_pj").hide();
            $("#prodi").hide();
        }
        if(role == "2")
        {
            $("#nama_pj").show();
            $("#prodi").show();
        }
        if(role == "3")
        {
            $("#nama_pj").hide();
            $("#prodi").hide();
        }
        return false;
    }
    getSelectValue();
</script>