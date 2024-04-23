<html>
  <head></head>
  <body>
    <div style="padding: 10px;">
      <?php 
        if($petunjuk){ echo $petunjuk->isi_panduan; } 
        else{ echo "Belum ada petunjuk"; }
      ?>
    </div>
  </body>
</html>