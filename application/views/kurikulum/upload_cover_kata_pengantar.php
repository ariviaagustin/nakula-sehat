<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="<?= base_url('agenda/admin/summernote/summernote.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('agenda/admin/summernote/summernote.min.js'); ?>"></script>
<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; text-align:center; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: lightblue; border-color: lightblue;
   border-radius: 5px; text-align:center; color: #000; box-shadow :0 0 20px rgb(0 0 0 / 20%) } 
   .box:hover { border: 1px solid #1f3384;}
   a:hover{text-decoration:none; }
   .aktif{ background-color:coral; }
   .btn { color:#000; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <div class="row">
        <div class="col-md-12">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Upload Cover dan Kata Pengantar</h5>
        </div>
      </div>
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <div class="row">
          <div class="col-md-6" style="border-right: 1px solid #c6c6c6;">
            <h5>Informasi Kurikulum</h5>
            <table width="100%">
              <tr>
                <td>Judul Kurikulum</td>
                <td style="width: 1%;">:</td>
                <td><b><?= $kurikulum->judul; ?></b></td>
              </tr>
              <tr>
                <td>Institusi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_institusi; ?></b></td>
              </tr>
              <tr>
                <td>pj substansi</td>
                <td>:</td>
                <td><b><?= $kurikulum->nama_sdm; ?></b></td>
              </tr>
              <tr>
                <td>JPL</td>
                <td>:</td>
                <td><b><?= $kurikulum->jumlah_jpl; ?></b></td>
              </tr>
              <tr>
                <td>KAK/TOR</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank">KAK TOR</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Surat Pengantar</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Pengantar</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Preview Kurikulum</td>
                <td>:</td>
                <td><a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><b><i class="fa fa-eye"></i> Preview Kurikulum</b></a></td>
              </tr>
              <?php if($kurikulum->status >= 8){ ?>
                <tr>
                  <td>Penilai</td>
                  <td>:</td>
                  <td><b><?= $kurikulum->nama_penilai; ?></b></td>
                </tr>
              <?php } ?>
              <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></b></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Administrator</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></b></td>
              </tr>
              <tr>
                <td>Deadline Penyusunan Kurikulum</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></b></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Penilai</td>
                <td>:</td>
                <td><b><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_verifikasi_penilai))); ?></b></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <h5>Penyusunan Kurikulum</h5>
            <table>
              <?php if($kurikulum->status >= 10){ ?>
                <tr>
                  <td><a href="<?= base_url('agenda/perdata/cover/'.$kurikulum->cover); ?>" target = "_blank">Cover</a></td>
                </tr>
                <tr>
                  <td>
                    <a href="#" class="detail-kata-pengantar" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>">Kata Pengantar</a>
                  </td>
                </tr>
              <?php } ?>
              <?php $no = 1; foreach ($bab as $key) { ?>
                <tr>
                  <td><?= $no++; ?>.
                    <?php if($key->is_isi == 1){ ?>
                      <a href="#" class="detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><?= $key->bab." ".$key->judul; ?></a>
                    <?php } ?>
                    <?php if($key->is_isi != 1){ echo $key->bab." ".$key->judul; } ?>
                  </td>
                </tr>
                <?php $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab, 'status' => 1))->result(); if($sub_bab){ $no_sb = "a"; foreach ($sub_bab as $sb) { ?>
                  <tr>
                    <td>
                      &nbsp;&nbsp;&nbsp;
                      <?= $no_sb++; ?>. <a href="#" class="detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><?= $sb->sub_bab; ?></a>
                    </td>
                  </tr>
                <?php } } ?>
              <?php } ?>
            </table>
          </div>
        </div>
        <hr>
        <br>
        <h5>Cover dan Kata Pengantar Kurikulum</h5><br>
        <form action="<?= site_url('Kurikulum/aksi_upload_cover_kata_pengantar'); ?>" method = "post" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-2">
              <label><b>Upload Cover</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-8">
              <input type="file" name="cover" <?php if(!$kurikulum->cover){ echo "required"; } ?> class="form-control" accept = "image/jpg, image/jpeg, image/png" id="file" onchange="fileValidation()">
              <span style="color: red;">Format cover : JPG/JPEG/PNG</span>
              <br>
              <span style="color: red;">Maksimal ukuran file : 1MB</span>
            </div>
            <div class="col-md-2">
              <?php if($kurikulum->cover){ ?>
                <a href="<?= base_url('agenda/perdata/cover/'.$kurikulum->cover); ?>" target = "_blank" class = "btn btn-info btn-sm">Lihat Cover</a>
              <?php } ?>
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Kata Pengantar</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <textarea class="form-control summernote" name="kata_pengantar" required><?php if($kata_pengantar){ echo $kata_pengantar->kata_pengantar; } ?></textarea> 
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Kota</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <input type="text" name="kota" required class="form-control" value="<?php if($kata_pengantar){ echo $kata_pengantar->kota; } ?>">
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Tanggal</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <input type="date" name="tgl_kata_pengantar" required class="form-control" value="<?php if($kata_pengantar){ echo $kata_pengantar->tgl_kata_pengantar; } ?>">
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Jabatan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <input type="text" name="jabatan_ttd" required class="form-control" value="<?php if($kata_pengantar){ echo $kata_pengantar->jabatan_ttd; } ?>">
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Nama Pemilik Jabatan</b><span style="color: red;">*</span></label>
            </div>
            <div class="col-md-10" style="margin-top: 2%;">
              <input type="text" name="nama_ttd" required class="form-control" value="<?php if($kata_pengantar){ echo $kata_pengantar->nama_ttd; } ?>">
            </div>
            <div class="col-md-2" style="margin-top: 2%;">
              <label><b>Tim Penyusun</b><span style="color: red;">*</span></label>
            </div>
            <?php $total_tim_penyusun = count($tim_penyusun); ?>
              <?php if($total_tim_penyusun == 0){ ?>
                <div class="col-md-12 isian_multiple" style="margin-top: -3%;">
                  <div class="form-group multiple-form-group-upload">
                    <div class="form-group m-form__group">
                      <div class="row form-group">
                        <div class="col col-md-2">
                        </div>
                        <div class="col-10 col-md-10">
                          <input type="text" class="form-control" name="nama_penyusun[]" required placeholder = "(Nama Tim Penyusun)">
                        </div>
                      </div>
                    </div>
                    <span class="input-group-btn">
                      <button type="button"  class="btn btn-success btn-add" data-awal="1" style="float: right;">+</button>
                    </span>    
                    <div class="clearfix"></div>           
                  </div>
                </div>
              <?php } ?>
              <?php if($total_tim_penyusun >= 1){ $ds = 1; foreach ($tim_penyusun as $val) { ?>
                <div class="col-md-12 isian_multiple">
                  <input type="hidden" name="id_tim_penyusun[]" value="<?= $val->id_tim_penyusun; ?>">
                  <div class="form-group multiple-form-group-upload">
                    <div class="form-group m-form__group">
                      <div class="row form-group">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="nama_penyusun[]" value="<?= $val->nama_penyusun; ?>" required placeholder = "(Nama Penyusun)">
                        </div>
                      </div>
                      <span class="input-group-btn">
                        <button type="button"  class="btn btn-<?= ($ds-1 < $total_tim_penyusun-1) ? 'danger btn-remove hapus-multiple' : 'success btn-add'?>" data-title="d" data-awal="1" data-id="<?=$val->id_tim_penyusun; ?>" style="float: right;"><?= ($ds-1 < $total_tim_penyusun-1) ? '-' : '+'?></button>
                      </span>    
                      <div class="clearfix"></div>           
                    </div>
                  </div>
              </div>
            <?php $ds++; } } ?>
            <div class="col-md-12" style="text-align: right; margin-top: 2%;">
              <input type="hidden" name="cover_old" value="<?= $kurikulum->cover; ?>">
              <input type="hidden" name="judul_portal" value="<?= $kurikulum->judul_portal; ?>">
              <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
              <button type="submit" class="btn btn-info" style="color: #fff;">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div> 
  </div> 
</div> 
</div>
<div class="modal fade" id="detail-bab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_bab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-subbab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_subbab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-kata-pengantar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_kata_pengantar"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-bab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-bab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_bab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_bab: $(this).attr('data-bab'),},
        function (html) { $(".body_detail_bab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-subbab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-subbab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_subbab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_subbab: $(this).attr('data-subbab'),},
        function (html) { $(".body_detail_subbab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-kata-pengantar', function (e) {
      e.preventDefault();
      $("#detail-kata-pengantar").modal('show');
      $.post('<?= site_url('Kurikulum/detail_kata_pengantar');?>',
        {id: $(this).attr('data-id'),},
        function (html) { $(".body_detail_kata_pengantar").html(html); }
      );
    });
  });
</script>
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
        var allowedExtensions = ["jpg", "jpeg", "png"];
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
<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
  $hari = array ( 1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
);

  $bulan = array (1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
}
return $tgl_indo;
}
?>