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
    <?php if($master_jadwal){ ?>
      <div class="row">
        <div class="col-12 col-md-12">
          <h5>2. Master Jadwal</h5><br>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="background-color: lemonchiffon;">
                <th style="width: 5%;">Hari</th>
                <th>Waktu</th>
                <th style="width: 5%;">JPL</th>
                <th style="width: 35%;">Mata Pelatihan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($master_jadwal as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $key->hari_ke; ?></td>
                  <td style="text-align: center;"><?= date('H:i', strtotime($key->waktu_awal))." - ".date('H:i', strtotime($key->waktu_akhir)); ?></td>
                  <td style="text-align: center;"><?= $key->jpl; ?></td>
                  <td><?= $key->mata_pelatihan; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>