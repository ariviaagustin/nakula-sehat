<style type="text/css">
  #content{ background-color: #fff; }
  .isian_multiple{ margin-left:-8px; }
  .judul{ font-weight: 600; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Indikator Hasil Belajar</h5>
        </div>
        <form action="<?= site_url('Kurikulum/aksi_tambah_indikator_hasil_belajar'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Indikator Hasil Belajar<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="indikator_hasil_belajar" required="" placeholder="Indikator Hasil Belajar">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3 judul">
                            <label for="text-input" class=" form-control-label">Materi Pokok dan Sub Materi Pokok<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" name="materi_sub_materi_pokok" required="" placeholder="Materi Pokok">
                        </div>
                    </div>
                    <div class="col-md-12 isian_multiple">
                        <div class="form-group multiple-form-group-upload">
                            <div class="form-group m-form__group">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" class="form-control" name="isi_materi_sub_materi_pokok[]" placeholder = "Sub Materi Pokok">
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
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                        <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
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
        const fileInput = document.getElementById("file_2");
        var filePath = $("#file").val();
        var allowedExtensions = ["jpg","jpeg", "png", "pdf"];
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