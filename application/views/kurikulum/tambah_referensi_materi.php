<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: lightblue; border-color: lightblue;
   border-radius: 5px; text-align:center; color: #000; box-shadow :0 0 20px rgb(0 0 0 / 20%) } 
   .box:hover { border: 1px solid #1f3384;}
   a:hover{text-decoration:none; }
   .aktif{ background-color:coral; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Lampiran</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <?php $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>Materi : <?= $materi->materi; ?></h5><br>
            <h6>Referensi<span style="color: red;">*</span></h6>
            <form action="<?= site_url('Kurikulum/aksi_tambah_referensi_materi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group">
                <div class="col-12 col-md-12">
                  <div class="col-md-12 isian_multiple">
                    <div class="form-group multiple-form-group-upload">
                      <div class="form-group m-form__group">
                        <div class="row form-group">
                          <div class="col-12 col-md-12">
                            <input type="text" class="form-control" name="referensi_materi[]" required placeholder = "(Referensi)">
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
                  <!-- <input type="text" class="form-control" name="referensi_materi" required=""> -->
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12" style="text-align: right;">
                  <input type="hidden" name="id_materi" value="<?= $materi->id_materi; ?>">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <button type="submit" class="btn btn-info">Simpan</button>
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