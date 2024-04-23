<html>
  <head></head>
  <body>
    <div style="padding: 10px;">
      <?php if($petunjuk){ 
        echo $petunjuk->isi_panduan."<br>"; 
        if($petunjuk->file) 
        {
          $ex = substr($petunjuk->file,-3); 
          if($ex == 'pdf' || $ex == 'PDF') { ?>
            <embed src="<?php echo base_url('agenda/perdata/panduan/'.$petunjuk->file);?>" type='application/pdf' width='100%' height='700px'/>
          <?php } ?>
          <?php if($ex == "jpg" || $ex == "JPG" || $ex == "jpeg" || $ex == "JPEG" || $ex == "PNG" || $ex == "png"){ ?>
            <img src="<?php echo base_url('agenda/perdata/panduan/'.$petunjuk->file);?>" type='application/pdf' width='100%' height='700px'/>
            <center><a href="<?= base_url('agenda/perdata/panduan/'.$petunjuk->file); ?>" class = "btn btn-danger" download><i class="lni lni-download"></i> Unduh File</a></center>
          <?php } ?>
          <?php if($ex == "xls" || $ex == "XLS" || $ex == "lsx" || $ex == "LSX"){ ?>
            <center><a href="<?= base_url('agenda/perdata/panduan/'.$petunjuk->file); ?>" class = "btn btn-danger" download><i class="lni lni-download"></i> Unduh File</a></center>
          <?php } ?>
          <?php if($ex == "avi" || $ex == "AVI" || $ex == "mp4" || $ex == "MP4" || $ex == "mpg" || $ex == "MPG" || $ex == "mkv" || $ex == "MKV" || $ex == "wav" || $ex == "wv" || $ex == "m4a" || $ex == "m4b" || $ex =="m4p" || $ex =="mp3"){ ?>
            <center><iframe src="<?= base_url('agenda/perdata/panduan/'.$petunjuk->file); ?>" width='100%' height='500px'></iframe>
            <br>
            <a href="<?= base_url('agenda/perdata/panduan/'.$petunjuk->file); ?>" class = "btn btn-danger" download><i class="lni lni-download"></i> Unduh File</a></center><br>
          <?php } ?>
        <?php } ?>
      <?php } ?> 
      <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
    </div>
  </body>
</html>