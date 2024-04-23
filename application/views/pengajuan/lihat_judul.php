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
                                <td style="padding: 8px 10px; font-size: 11pt" class="aktif"><a href="#" style="color: #000">Judul</a> <i class="fa fa-check" aria-hidden="true"></i></td>
                            </tr>
                            <?php foreach ($kur as $key){ ?>
                                <tr>
                                    <td style="padding: 8px 10px; font-size: 11pt">
                                        <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode($asal)).'/'.bin2hex(base64_encode($is_pmbg))); ?>">
                                            <?= $key->nama_alias; ?>
                                            <?php $wtk = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => $key->id_bagian))->row(); ?>
                                            <?php if($wtk){ ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php } ?>
                                        </a>
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
                            </div>
                            <hr>
                            <form action="<?= site_url('Pengajuan/aksi_ubah_judul'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id = "form1">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Tahun</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="tahun" value="<?= $pengajuan->tahun; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Judul Kurikulum</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="judul_kurikulum" value="<?= $pengajuan->judul_kurikulum; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Gambar Cover</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <?php if($pengajuan->gambar_cover){ ?>
                                            <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style = "width: 120px; margin-bottom: 10px">
                                        <?php } ?>
                                        <?php if(!$pengajuan->gambar_cover){ echo "Belum ada gambar<br><br>"; } ?>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="file" class="form-control" name="gambar_cover">
                                        <input type="hidden" name="gambar_cover_old" value="<?= $pengajuan->gambar_cover; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Lembaga / Badan</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="lembaga" value="<?= $pengajuan->lembaga; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Tim Penyusun</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="tim_penyusun" value="<?= $pengajuan->tim_penyusun; ?>">
                                        <span style="color: red">* Gunakan tanda titik koma (;)</span>
                                    </div>
                                </div>
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="text-input" class=" form-control-label">PJ Substansi</label>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <select name="pj_subtansi" class="form-control select2" required="">
                                                <option value="">-- Pilih PJ</option>
                                                <?php foreach ($pj as $key) { ?>
                                                    <option value="<?= $key->id_pj_subtansi; ?>" <?php if($pengajuan->pj_subtansi == $key->id_pj_subtansi){ echo "selected"; } ?>><?= $key->nama_pj_subtansi; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Jenis Pembelajaran</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <?php $jp = $this->M_entitas->selectSemua('jenis_pembelajaran')->result(); ?>
                                        <?php $jpp = $this->M_entitas->selectX('jenis_pembelajaran_pengajuan', array('id_pengajuan' => $pengajuan->id_pengajuan))->result(); ?>
                                        <select name="id_jenis_pembelajaran[]" class="form-control select2" required="" multiple="">
                                            <?php foreach ($jp as $key) { ?>
                                                <option value="<?= $key->id_jenis_pembelajaran; ?>" <?php if($jpp){ foreach ($jpp as $jepepe){ if($jepepe->id_jenis_pembelajaran == $key->id_jenis_pembelajaran){ echo "selected"; } } } ?>><?= $key->jenis_pembelajaran; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                                        <input type="hidden" name="asal" value="<?= $asal; ?>">
                                        <input type="hidden" name="is_pmbg" value="<?= $is_pmbg; ?>">
                                        <input type="hidden" name="status" value="<?= $pengajuan->status; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Total JPL</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input type="text" class="form-control" name="jpl" value="<?= $pengajuan->jpl; ?>" onkeyup="validAngka(this)">
                                        <span style="color: red">* Hanya angka</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12"><hr></div>
                                    <div class="col-md-6" style="text-align: left;">
                                        <button type="submit" value="1" name="aksi" class="btn btn-info"><i class="fa fa-clock"></i> Teruskan Pengisian</button>
                                    </div>
                                    <div class="col col-md-6" style="text-align: right;">
                                        <button type="submit" value="2" name="aksi" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script type="text/javascript">
    function validAngka(a)
    {
        if(!/^[0-9.]+$/.test(a.value))
        {
            a.value = a.value.substring(0,a.value.length-10);
            var valid = /^d{0,15}(.d{0,2})?$/.test(this.value),
            val = this.value;
        }
        if(!valid)
        {
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    }
</script>
<!-- <script type="text/javascript">
    $('#form1').one('submit', function() {
        $(this).find('button[type="submit"]').attr('disabled','disabled');
    });
</script> -->