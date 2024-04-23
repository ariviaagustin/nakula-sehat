<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">PJ Substansi</h5>
        </div>
        <form action="<?= site_url('Pj_substansi/aksi_tambah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">NIK PJ Substansi</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nik_pj_subtansi" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nama PJ Substansi</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nama_pj_subtansi" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Email Aktif</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="email" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nomor Telepon</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="no_telp" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jenis Kelamin PJ Substansi</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="jk_pj_subtansi" required="" value="1"> Laki-laki
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="jk_pj_subtansi" required="" value="2"> Perempuan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script> -->