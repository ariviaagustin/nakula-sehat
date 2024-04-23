<style type="text/css">
  #content{ background-color: #fff; }
  .isian_multiple{ margin-left:-8px; }
  .judul{ font-weight: 600; }
  .btn { color:#000; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pengajuan Kurikulum Baru</h5>
        </div>
        <form action="<?= site_url('Kurikulum/aksi_ubah_informasi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <?php if($this->session->userdata('id_role') == 1){ ?>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">Institusi<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control select2" name="id_institusi" required id="id_institusi" onchange="myFunction()">
                                    <option value="">-- Pilih Institusi --</option>
                                    <?php foreach ($institusi as $key) { ?>
                                        <option value="<?= $key->id_institusi; ?>" <?php if($kurikulum->id_institusi == $key->id_institusi){ echo "selected"; } ?>><?= $key->nama_institusi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">pj substansi<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control select2" name="id_sdm_institusi" required id="id_sdm_institusi">
                                    <option value="">-- Pilih pj substansi --</option>
                                    <?php foreach ($sdm_institusi as $key) { ?>
                                        <option value="<?= $key->id_sdm_siaksi; ?>" <?php if($kurikulum->id_sdm_institusi == $key->id_sdm_siaksi){ echo "selected"; } ?>><?= $key->nama_sdm; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($this->session->userdata('id_role') == 2){ ?>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">Institusi<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <?= $this->session->userdata('nama_institusi'); ?>
                                <input type="hidden" name="id_institusi" value="<?= $this->session->userdata('id_institusi'); ?>">
                            </div>
                        </div>
                        <?php $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_institusi' => $this->session->userdata('id_institusi')))->result(); ?>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">PJ<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control select2" name="id_sdm_institusi" required>
                                    <option value="">-- Pilih PJ --</option>
                                    <?php foreach ($get_sdm as $key) { ?>
                                        <option value="<?= $key->id_sdm_siaksi; ?>" <?php if($kurikulum->id_sdm_institusi == $key->id_sdm_siaksi){ echo "selected"; } ?>><?= $key->nama_sdm; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Judul<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="judul" required="" value="<?= $kurikulum->judul; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Jumlah JPL<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="jumlah_jpl" required="" value="<?= $kurikulum->jumlah_jpl; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">KAK/TOR<?php if(!$kurikulum->kak_tor){ ?><span style="color: red">*</span><?php } ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="file" class="form-control" name="kak_tor" <?php if(!$kurikulum->kak_tor){ echo "required"; } ?> id="file" onchange="fileValidation()" accept="application/pdf" style="margin-bottom: 5px;">
                            <span style="color: red;">**Tipe dokumen : pdf</span>
                        </div>
                        <div class="col-md-3">
                            <?php if($kurikulum->kak_tor){ ?>
                                <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank"><i class="fa fa-file"></i> KAK / TOR sebelumnya</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Nomor Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="no_surat_pengantar" required="" value="<?= $kurikulum->no_surat_pengantar; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Tanggal Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date" class="form-control" name="tanggal_surat_pengantar" required="" value="<?= $kurikulum->tanggal_surat_pengantar; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Perihal Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="perihal_surat_pengantar" required="" value="<?= $kurikulum->perihal_surat_pengantar; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Surat Pengantar<?php if(!$kurikulum->surat_pengantar){ ?><span style="color: red">*</span><?php } ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="file" class="form-control" name="surat_pengantar" <?php if(!$kurikulum->surat_pengantar){ echo "required"; } ?> id="file_2" onchange="fileValidation_2()" accept="application/pdf" style="margin-bottom: 5px;">
                            <span style="color: red;">**Tipe dokumen : pdf</span>
                        </div>
                        <div class="col-md-3">
                            <?php if($kurikulum->surat_pengantar){ ?>
                                <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank"><i class="fa fa-file"></i> Surat Pengantar sebelumnya</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                        <input type="hidden" name="kak_tor_lama" value="<?= $kurikulum->kak_tor; ?>">
                        <input type="hidden" name="surat_pengantar_old" value="<?= $kurikulum->surat_pengantar; ?>">
                        <button type="submit" class="btn btn-info" style="color: #fff;">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
  function myFunction() 
  {
    var id_institusi = document.getElementById("id_institusi").value;
    var url = "<?php echo site_url('All/get_pj_institusi');?>/"+id_institusi;
    $('#id_sdm_institusi').load(url);
    return false;
  }
</script>