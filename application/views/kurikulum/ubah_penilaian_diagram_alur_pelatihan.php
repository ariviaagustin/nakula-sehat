<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="<?= base_url('agenda/admin/summernote/summernote.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('agenda/admin/summernote/summernote.min.js'); ?>"></script>
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
   .btn { color:#000; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Bab III Diagram Alur Proses Pelatihan</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <?php $id_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>Diagram alur proses pelatihan</h5>
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Silahkan berikan penilaian terhadap Kurikulum yang telah diajukan.</b></span>
            </div>
            <hr>
            <form action="<?= site_url('Kurikulum/aksi_ubah_penilaian_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <?php if($diagram){ if($diagram->diagram_alur_proses_pelatihan){ ?>
                <div class="row form-group">
                  <div class="col-12 col-md-12">
                    <img src="<?= base_url('agenda/perdata/diagram_alur_proses_pelatihan/'.$diagram->diagram_alur_proses_pelatihan); ?>" style = "width: 60%;">
                  </div>
                </div>
                <br>
              <?php } } ?>
              <div class="row form-group">
                <div class="col-12 col-md-12">
                  <textarea class="form-control summernote" name="catatan" required><?= $catatan->catatan; ?> </textarea>
                </div>
              </div>
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <label style="font-size: 17px;"><b>Berikan Keterangan Penilaian:</b></label>
                  <textarea rows="5" name="keterangan" class="form-control ubah" data-id="<?= $catatan->id_catatan;?>"><?= $catatan->keterangan; ?></textarea>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <a href="<?= site_url('penilaian-penilai/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_catatan" value="<?= $catatan->id_catatan; ?>">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_list_pengerjaan_kurikulum" value="<?= $list->id_list_pengerjaan_kurikulum; ?>">
                  <button type="submit" class="btn btn-info" style="color: #fff;">Simpan</button>
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
<script type="text/javascript">
  $('.ubah').change(function() {
    var id_catatan = $(this).attr('data-id');
    var nama = $(this).attr('name');
    var catatan = $(this).val();

    $.ajax({
      url : '<?= site_url("Kurikulum/ajax_ubah_penilaian_kurikulum");?>',
      type : 'POST',
      data : {id:id_catatan,parameter:nama,isi:catatan},
      success: function(data){
      }
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
<script type="text/javascript">
  function fileValidation_foto(id)
  {
    const fileInput = document.getElementById("file_foto");
    var filePath = $("#file_foto").val();
    var allowedExtensions = ["jpg","jpeg", "png"];
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