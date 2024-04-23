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
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab II Komponen Kurikulum</h5> 
        </div>
      </div>  
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <div class="row">
          <div class="col-md-12">
            <h5>b. Kompetensi<span style="color: red;">*</span></h5><br>
            <form action="<?= site_url('Kurikulum/aksi_isi_subbab_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">  
              <div class="row form-group">
                <div class="col-12 col-md-12">
                  <h5><b>Kompetensi<span style="color: red;">*</span></b></h5><br>
                  <input type="text" class="form-control" name="kompetensi" required="">
                </div>
              </div>
              <div class="col-md-12 isian_multiple">
                <div class="form-group multiple-form-group-upload">
                  <div class="form-group m-form__group">
                    <div class="row form-group">
                      <div class="col-12 col-md-12">
                        <input type="text" class="form-control" name="isi_kompetensi[]" required placeholder = "(Kompetensi)">
                      </div>
                    </div>
                  </div>
                  <span class="input-group-btn">
                    <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                  </span>    
                  <div class="clearfix"></div>           
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <a href="<?= site_url('list-pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_list_pengerjaan_kurikulum" value="0">
                  <input type="hidden" name="id_sub_bab" value="<?= $id_sub_bab; ?>">
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