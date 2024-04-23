<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
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
<?php 
    $tes = $this->M_entitas->selectX('pengajuan', array('pengaju' => $this->session->userdata('id_pengaju'), 'kelengkapan < ' => 15, 'status' => 0))->num_rows();
?>
<div class="container-fluid">
  <!-- DataTales Example -->
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Pengajuan</h5>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding: 0px">
            <div class="card-body card-block" style="padding: 0px">
                <?php if($this->session->flashdata("msg")){ ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                        <span><i class="fa fa-check" aria-hidden="true"></i> <?= $this->session->flashdata("msg"); ?></span>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-4">
                        <table border="1">
                            <tr>
                                <td style="padding: 8px 10px; font-size: 11pt" class="aktif"><a href="#" style="color: #000">Judul</a><?php if($is_p == 1){ if($tes <= 1){ ?> <i class="fa fa-check" aria-hidden="true"></i> <?php } } ?></td>
                            </tr>
                            <?php foreach ($kur as $key){ ?>
                                <tr>
                                    <td style="padding: 8px 10px; font-size: 11pt" class="<?php if($this->uri->segment(1) == $key->link){ echo 'aktif'; } ?>">
                                        <?php if($is_p == 1){ ?>
                                            <?php if($tes <= 1){ ?>
                                                <a href="<?= site_url($key->link.'/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>">
                                                <?= $key->nama_alias; ?></a>
                                                <?php 
                                                    $cek = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => $key->id_bagian))->num_rows();
                                                    if($cek >= 1){ ?>
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if($tes > 1){ ?>
                                                <a href="<?= site_url($key->link); ?>" class = "disabled"><?= $key->nama_alias; ?></a>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if($is_p == 0){ ?>
                                            <a href="<?= site_url($key->link); ?>" class = "disabled">
                                            <?= $key->nama_alias; ?></a>
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
                            <?php if($tes <= 1){ ?>
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
                                            <input type="text" class="form-control" name="lembaga" required="" <?php if($is_p == 1){ ?> value="<?= $pengajuan->lembaga; ?>" <?php } ?> <?php if($is_p != 1){ ?> value="<?= $this->session->userdata('nama_pengaju'); ?>" <?php } ?>>
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
                                    <?php if($this->session->userdata('role') == 3){ ?>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <label for="text-input" class=" form-control-label">PJ Substansi</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <?php if($is_p == 1){ ?>
                                                    <select name="pj_subtansi" class="form-control select2" required="">
                                                        <option value="">-- Pilih PJ</option>
                                                        <?php foreach ($pj as $key) { ?>
                                                            <option value="<?= $key->id_pj_subtansi; ?>" <?php if($pengajuan->pj_subtansi == $key->id_pj_subtansi){ echo "selected"; } ?>><?= $key->nama_pj_subtansi; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                                <?php if($is_p != 1){ ?>
                                                    <select name="pj_subtansi" class="form-control select2" required="">
                                                        <option value="">-- Pilih PJ</option>
                                                        <?php foreach ($pj as $key) { ?>
                                                            <option value="<?= $key->id_pj_subtansi; ?>"><?= $key->nama_pj_subtansi; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($this->session->userdata('role') == 4){ ?>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <label for="text-input" class=" form-control-label">PJ Substansi</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" name="" value="<?= $pj->nama_pj_subtansi; ?>" readonly class = "form-control">
                                                <input type="hidden" name="pj_subtansi" value="<?= $pj->id_pj_subtansi; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Jenis Pembelajaran</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <?php $jp = $this->M_entitas->selectSemua('jenis_pembelajaran')->result(); ?>
                                            <?php if($is_p == 1){ $jpp = $this->M_entitas->selectX('jenis_pembelajaran_pengajuan', array('id_pengajuan' => $pengajuan->id_pengajuan))->result(); } ?>
                                            <select name="id_jenis_pembelajaran[]" class="form-control select2" required="" multiple="">
                                                <?php foreach ($jp as $key) { ?>
                                                    <option value="<?= $key->id_jenis_pembelajaran; ?>" <?php if($is_p == 1){ if($jpp){ foreach ($jpp as $jepepe){ if($jepepe->id_jenis_pembelajaran == $key->id_jenis_pembelajaran){ echo "selected"; } } } } ?>><?= $key->jenis_pembelajaran; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12" style="text-align: center;">
                                            <?php if($is_p == 1){ ?>
                                                <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                                                <input type="hidden" name="add" value="0">
                                            <?php } ?>
                                            <?php if($is_p == 0){ ?>
                                                <input type="hidden" name="add" value="1">
                                            <?php } ?>
                                            <button type="submit" value="1" name="aksi" class="btn btn-info">Simpan dan Lanjut</button>
                                            <button type="submit" value="2" name="aksi" class="btn btn-info">Simpan dan Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                            <?php if($tes > 1){ ?>
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Tahun</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="tahun" disabled="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Judul Kurikulum</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="judul_kurikulum" disabled="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Gambar Cover</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="file" class="form-control" name="gambar_cover" disabled="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Lembaga / Badan</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="lembaga" disabled="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Tim Penyusun</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="tim_penyusun" disabled="">
                                            <span style="color: red">* Gunakan tanda koma (,)</span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">PJ Substansi</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="pj_subtansi" disabled="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">Jenis Pembelajaran</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <?php $jp = $this->M_entitas->selectSemua('jenis_pembelajaran')->result(); ?>
                                            <select name="id_jenis_pembelajaran[]" class="form-control select2" required="" multiple="">
                                                <?php foreach ($jp as $key) { ?>
                                                    <option value="<?= $key->id_jenis_pembelajaran; ?>"><?= $key->jenis_pembelajaran; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12" style="text-align: center;">
                                            <button type="submit" value="1" name="aksi" class="btn btn-info" disabled="">Simpan dan Lanjut</button>
                                            <button type="submit" value="2" name="aksi" class="btn btn-info" disabled="">Simpan dan Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>