<style type="text/css">
  #content{ background-color: #fff; }
  td{ padding:10px; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Profil</h5>
                </div>
                <!-- <?php if($profil->is_dummy != 1){ ?>
                    <div class="col-md-6" style="text-align: right;">
                        <a href="<?= site_url('update-sdm-institusi'); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Update Data</a>
                    </div>
                <?php } ?> -->
            </div>
        </div>
        <div class="card-body" style="padding: 10px">
            <div class="card-body card-block" style="padding: 0px">
                <?php if($this->session->flashdata("msg-berhasil")){ ?>
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                      <span><?= $this->session->flashdata("msg-berhasil"); ?></span>
                    </div>
                <?php } ?>
                <table width="100%">
                    <tr>
                        <td style="width: 20%;">Nama pj substansi</td>
                        <td style="width: 1%;">:</td>
                        <td><?= $profil->nama_sdm; ?></td>
                    </tr>
                    <tr>
                        <td>Institusi</td>
                        <td>:</td>
                        <td><?= $profil->nama_institusi; ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td><?= $profil->nik; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $profil->email; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?= $profil->keterangan_status; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>