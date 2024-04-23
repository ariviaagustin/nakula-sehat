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
   .btn { color:#000; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Proses Draft Pertama</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <div class="row">  
          <div class="col-md-12"> 
            <div class="row"> 
              <?php $no = 1; foreach ($bab as $key) {  ?> 
                <div class="col-md-3" style="margin-bottom: 2%;"> 
                  <a href="<?= site_url('pengisian-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum)).'/'.bin2hex(base64_encode($key->id_bab))); ?>">
                    <div class="box h-100"> 
                      <b><?= $key->bab." ".$key->judul; ?></b>
                    </div> 
                  </a>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-md-12"> 
            <hr>
            <h5>Bab 1 - Pendahuluan</h5><br>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> 
              <div> 
                <div class="row form-group"> 
                  <div class="col-12 col-md-12">
                    <textarea class="form-control summernote" name="pendahuluan" required></textarea> 
                  </div>
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