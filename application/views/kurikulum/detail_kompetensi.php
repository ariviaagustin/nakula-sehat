<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
          <span style="font-size: 18px; font-weight: 600; color: #000;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
        </div>
      </div>
    </div>
    <hr>
    <?php if($kurikulum->kompetensi){ ?>
      <div class="row">
        <div class="col-12 col-md-12">
          <h5>b. Kompetensi</h5>
          <p><?= $kurikulum->kompetensi; ?></p>
          <?php 
            if($kompetensi)
            { 
              echo "<ol>";
              foreach ($kompetensi as $key) 
              {
                echo "<li style = 'margin: 10px;'>".$key->isi_kompetensi."</li>";
              }
              echo "</ol>";
            }
          ?>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>