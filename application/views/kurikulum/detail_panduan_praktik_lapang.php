<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tr>
            <td style="text-align: center;"><h5 style="font-size: 18px;"><b>PANDUAN PRAKTIK LAPANG</b></h5></td>
          </tr>
        </table>
        <table width="100%">
          <tr>
            <td>
              <b><u>Waktu:</u></b>
              <?php 
                $total_jpl = $jpl * 60;
                echo $jpl." JPL x 60 menit = ".$total_jpl." menit";
              ?>
            </td>
          </tr>
          <tr>
            <td><b><u>Petunjuk:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php if($petunjuk){ ?>
                <ol>
                  <?php foreach ($petunjuk as $key) { ?>
                    <li><?= $key->panduan_penugasan; ?></li>
                  <?php } ?>
                </ol>
              <?php } ?>
              <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>