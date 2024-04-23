<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="<?= base_url('agenda/admin/summernote/summernote.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('agenda/admin/summernote/summernote.min.js'); ?>"></script>
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
        <form action="<?= site_url('Kurikulum/aksi_tambah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                        <option value="<?= $key->id_institusi; ?>"><?= $key->nama_institusi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">PJ Substansi<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control select2" name="id_sdm_institusi" required id="id_sdm_institusi">
                                    <option value="">-- Pilih pj substansi --</option>
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
                        <?php $get_sdm = $this->M_entitas->selectX('sdm_institusi', array('id_institusi_siaksi' => $this->session->userdata('id_institusi_siaksi')))->result(); ?>
                        <div class="row form-group">
                            <div class="col col-md-3 judul">
                                <label for="text-input" class=" form-control-label">PJ<span style="color: red">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control select2" name="id_sdm_institusi" required>
                                    <option value="">-- Pilih PJ --</option>
                                    <?php foreach ($get_sdm as $key) { ?>
                                        <option value="<?= $key->id_sdm_siaksi; ?>"><?= $key->nama_sdm; ?></option>
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
                            <input type="text" class="form-control" name="judul" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Tujuan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea class="form-control summernote" name="tujuan" required></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Kompetensi<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="kompetensi" required="" value="Setelah mengikuti pelatihan ini, peserta mampu">
                        </div>
                    </div>
                    <div class="col-md-12 isian_multiple">
                        <div class="form-group multiple-form-group-upload">
                            <div class="form-group m-form__group">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" class="form-control" name="isi_kompetensi[]" required placeholder = "(Kompetensi)">
                                        <span style="color: red;">- Jumlah Kompetensi <b>HARUS SAMA</b> dengan jumlah Materi Pelatihan Inti</span>
                                        <br>
                                        <span style="color: blue;">- Harap diisi satu persatu. Apabila isian lebih dari satu, dapat menambahkan kolom dengan klik tombol tambah disebelah kanan</span>
                                    </div>
                                </div>
                            </div>
                            <span class="input-group-btn">
                              <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                            </span>    
                            <div class="clearfix"></div>           
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <h5>Materi<span style="color: red">*</span></h5>
                            <hr>
                        </div>
                    </div>
                    <div style="margin-left: 2%;">
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="text-input" class=" form-control-label" style="font-weight: 600;">A. Materi Pelatihan Dasar<span style="color: red">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-12 isian_multiple">
                            <div class="form-group multiple-form-group-upload">
                                <div class="form-group m-form__group">
                                    <div class="row form-group">
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="materi_pelatihan_dasar[]" required>
                                            <span style="color: blue;">Harap diisi satu persatu. Apabila isian lebih dari satu, dapat menambahkan kolom dengan klik tombol tambah disebelah kanan</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="input-group-btn">
                                  <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                                </span>    
                                <div class="clearfix"></div>           
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="text-input" class=" form-control-label" style="font-weight: 600;">B. Materi Pelatihan Inti<span style="color: red">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-12 isian_multiple">
                            <div class="form-group multiple-form-group-upload">
                                <div class="form-group m-form__group">
                                    <div class="row form-group">
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="materi_pelatihan_inti[]" required>
                                            <span style="color: red;">- Jumlah Materi Pelatihan Inti <b>HARUS SAMA</b> dengan jumlah Kompetensi</span><br>
                                            <span style="color: blue;">- Harap diisi satu persatu. Apabila isian lebih dari satu, dapat menambahkan kolom dengan klik tombol tambah disebelah kanan</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="input-group-btn">
                                  <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                                </span>    
                                <div class="clearfix"></div>           
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="text-input" class=" form-control-label" style="font-weight: 600;">C. Materi Pelatihan Penunjang<span style="color: red">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-12 isian_multiple">
                            <div class="form-group multiple-form-group-upload">
                                <div class="form-group m-form__group">
                                    <div class="row form-group">
                                        <div class="col-12 col-md-12">
                                            <input type="text" class="form-control" name="materi_pelatihan_penunjang[]" required>
                                            <span style="color: blue;">Harap diisi satu persatu. Apabila isian lebih dari satu, dapat menambahkan kolom dengan klik tombol tambah disebelah kanan</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="input-group-btn">
                                  <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                                </span>    
                                <div class="clearfix"></div>           
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Jumlah JPL<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="jumlah_jpl" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Sasaran Peserta<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="sasaran_peserta" required="" value="Peserta terdiri dari :">
                        </div>
                    </div>
                    <div class="col-md-12 isian_multiple">
                        <div class="form-group multiple-form-group-upload">
                            <div class="form-group m-form__group">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" class="form-control" name="isi_peserta[]" required placeholder = "(Peserta)">
                                        <span style="color: blue;">Harap diisi satu persatu. Apabila isian lebih dari satu, dapat menambahkan kolom dengan klik tombol tambah disebelah kanan</span>
                                    </div>
                                </div>
                            </div>
                            <span class="input-group-btn">
                              <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                            </span>    
                            <div class="clearfix"></div>           
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">KAK/TOR<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" class="form-control" name="kak_tor" required="" id="file" onchange="fileValidation()" accept="application/pdf" style="margin-bottom: 5px;">
                            <span style="color: red;">**Tipe dokumen : pdf</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Nomor Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="no_surat_pengantar" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Tanggal Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date" class="form-control" name="tanggal_surat_pengantar" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Perihal Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="perihal_surat_pengantar" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Surat Pengantar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" class="form-control" name="surat_pengantar" required="" id="file_2" onchange="fileValidation_2()" accept="application/pdf" style="margin-bottom: 5px;">
                            <span style="color: red;">**Tipe dokumen : pdf</span>
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
                        <button type="submit" class="btn btn-info" style="color: #fff;">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview' ]]
        ]
    });
    $('.dropdown-toggle').dropdown();
</script>
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
<script>
    $(function () {
        if($(this).attr("data-awal") == 1){
            $(".awal").show();
        }else{
            var addFormGroup = function (event) {
                event.preventDefault();

                var $formGroup = $(this).closest('.form-group');
                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
                var newIndex = $('.multiple-form-group').length+1;
                var $formGroupClone = $formGroup.first().clone().find('input').attr('name', function(idx, attrVal){
                    return attrVal.replace(/\d+/, newIndex);
                }).end().insertBefore(this);

                $(this)
                .toggleClass('btn-success btn-add btn-danger btn-remove')
                .html('–');
                $formGroupClone.find('input').val('');
                $formGroupClone.insertAfter($formGroup);

                var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                    $lastFormGroupLast.find('.btn-add').attr('disabled', true);
                }
            };

            var removeFormGroup = function (event) {
                event.preventDefault();

                var $formGroup = $(this).closest('.form-group');
                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

                var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                    $lastFormGroupLast.find('.btn-add').attr('disabled', false);
                }

                $formGroup.remove();
            };

            var countFormGroup = function ($form) {
                return $form.find('.form-group').length;
            };

            $(document).on('click', '.btn-add', addFormGroup);
            $(document).on('click', '.btn-remove', removeFormGroup);


        }
    });
</script>
<script type="text/javascript">
    function fileValidation()
    {
        const fileInput = document.getElementById("file");
        var filePath = $("#file").val();
        var allowedExtensions = ["pdf"];
        var aux = filePath.split('.');
        var extension = aux[aux.length -1].toLowerCase();
        console.log(extension);
        if(allowedExtensions.indexOf(extension) > -1)
        {
            if (fileInput.files.length > 0) 
            { 
                for (const i = 0; i <= fileInput.files.length - 1; i++) 
                {  
                    const fsize = fileInput.files.item(i).size; 
                    const file = Math.round((fsize / 1024));
                } 
            }
        }
        else
        {
            alert("file tidak sesuai");
            fileInput.value = '';
            return false;
        }
    }
</script>
<script type="text/javascript">
    function fileValidation_2()
    {
        const fileInput = document.getElementById("file_2");
        var filePath = $("#file_2").val();
        var allowedExtensions = ["pdf"];
        var aux = filePath.split('.');
        var extension = aux[aux.length -1].toLowerCase();
        console.log(extension);
        if(allowedExtensions.indexOf(extension) > -1)
        {
            if (fileInput.files.length > 0) 
            { 
                for (const i = 0; i <= fileInput.files.length - 1; i++) 
                {  
                    const fsize = fileInput.files.item(i).size; 
                    const file = Math.round((fsize / 1024));
                } 
            }
        }
        else
        {
            alert("file tidak sesuai");
            fileInput.value = '';
            return false;
        }
    }
</script>