<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-book"></i> Panduan</h1>
  <br>
  <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="<?= site_url('Panduan/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="color: #000">
                <div class="card-body card-block">
                    <?php if($this->session->flashdata("msg")){ ?>
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                          <span><?= $this->session->flashdata("msg"); ?></span>
                        </div>
                    <?php } ?>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Tahun</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="tahun" required="" value="<?= $panduan->tahun; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Bagian Kurikulum</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="id_bagian" class="form-control select2" required="">
                                <option value="">-- Pilih Bagian --</option>
                                <?php foreach ($kur as $key) { ?>
                                    <option value="<?= $key->id_bagian; ?>" <?php if($key->id_bagian == $panduan->id_bagian){ echo "selected"; } ?>><?= $key->bagian_kurikulum; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Status</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="radio" name="status" value="1" <?php if($panduan->status == 1){ echo "checked"; } ?>> Aktif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="2" <?php if($panduan->status == 2){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Isi Panduan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea class="form-control" name="isi_panduan" id="summernote"><?= $panduan->isi_panduan; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id" value="<?= $panduan->id_panduan; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
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
<script>
    $('#summernote').summernote({
        placeholder: 'Isi Panduan',
        tabsize: 2,
        height: 200,
        toolbar: [    
            ['edit',['undo','redo']],
            ['headline', ['style']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['fontface', ['fontname']],
            ['textsize', ['fontsize']],
            ['fontclr', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link','picture','video','hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
          ]
    });
</script>