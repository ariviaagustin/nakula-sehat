<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Penilai</h5>
        </div>
        <form action="<?= site_url('penilai/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <?php if($this->session->flashdata("msg")){ ?>
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                          <span><?= $this->session->flashdata("msg"); ?></span>
                        </div>
                    <?php } ?>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nama Penilai<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nama_penilai" required="" value="<?= $penilai->nama_penilai; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">NIK<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nik" required="" value="<?= $penilai->nik; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Email<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="email" required="" value="<?= $penilai->email; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nomor Telepon</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="no_telp" value="<?= $penilai->no_telp; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Jenis Kelamin<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="jenis_kelamin" value="1" required="" <?php if($penilai->jenis_kelamin == 1){ echo "checked"; } ?>> Laki-laki
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="jenis_kelamin" value="2" <?php if($penilai->jenis_kelamin == 2){ echo "checked"; } ?>> Perempuan
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">NIP</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="nip" value="<?= $penilai->nip; ?>">
                            <span style="color: red">** Jika Ada</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_penilai" value="<?= $penilai->id_penilai; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>