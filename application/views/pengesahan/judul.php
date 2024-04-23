<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<style type="text/css">
    #content
    {
        background-color: #fff;
    }
    table
    {
        border: 1px solid #d6d6d6;
    }
    .aktif
    {
        background-color: #32bacf;
        color: #fff;
    }
    .aktif a
    {
        color: #fff !important;
        font-weight: 600;
    }
    a{ color: #000; }
    a.disabled
    {
        pointer-events: none;
    cursor: default;
    opacity: .65;
    }
</style>
<div class="container-fluid">
  <!-- DataTales Example -->
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Pengesahan</h5>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding: 0px">
            <div class="card-body card-block" style="padding: 0px">
                <div class="row">
                    <div class="col-md-4">
                        <table border="1">
                            <tr>
                                <td style="padding: 8px 10px; font-size: 11pt" class="aktif"><a href="#" style="color: #000">Judul</a><?php if($is_p == 1){ ?> <i class="fa fa-check" aria-hidden="true"></i> <?php } ?></td>
                            </tr>
                            <?php foreach ($kur as $key){ ?>
                                <tr>
                                    <td style="padding: 8px 10px; font-size: 11pt" class="<?php if($this->uri->segment(1) == $key->link){ echo 'aktif'; } ?>">
                                        <?php if($is_p == 1){ ?>
                                            <a href="<?= site_url($key->link.'/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>">
                                            <?= $key->bagian_kurikulum; ?></a>
                                            <?php 
                                                $cek = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => $key->id_bagian))->num_rows();
                                                if($cek >= 1){ ?>
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if($is_p == 0){ ?>
                                            <a href="<?= site_url($key->link); ?>" class = "disabled">
                                            <?= $key->bagian_kurikulum; ?></a>
                                        <?php } ?>
                                        <?php if($key->link == $this->uri->segment(1)){ $id = $key->id_bagian; } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div id="judul">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>A. Judul Kurikulum yang Diajukan</h6>
                                </div>
                                <!-- <div class="col-md-4" style="text-align: right;">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-info-circle" aria-hidden="true"></i> Pentunjuk</a>
                                </div> -->
                            </div>
                            <hr>
                            <form action="<?= site_url('Pengajuan/aksi_judul'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Tahun</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="tahun" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->tahun; ?>" <?php } ?>>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Judul Kurikulum</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="judul_kurikulum" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->judul_kurikulum; ?>" <?php } ?>>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Gambar Cover</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <?php if($is_p == 1){ ?>
                                            <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style = "width: 120px; margin-bottom: 10px">
                                            <br>
                                            <input type="hidden" name="gambar_cover_old" value="<?= $pengajuan->gambar_cover; ?>">
                                        <?php } ?>
                                        <input type="file" class="form-control" name="gambar_cover" <?php if($is_p == 0){ echo "required=''"; } ?>>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Lembaga / Badan</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="lembaga" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->lembaga; ?>" <?php } ?>>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Tim Penyusun</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="tim_penyusun" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->tim_penyusun; ?>" <?php } ?>>
                                        <span style="color: red">* Gunakan tanda koma (,)</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">PJ Substansi</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="pj_subtansi" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->pj_subtansi; ?>" <?php } ?>>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12" style="text-align: right;">
                                        <?php if($is_p == 1){ ?>
                                            <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                                            <input type="hidden" name="add" value="0">
                                        <?php } ?>
                                        <?php if($is_p == 0){ ?>
                                            <input type="hidden" name="add" value="1">
                                        <?php } ?>
                                        <button type="submit" class="btn btn-info">Selanjutnya</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>