<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top; }
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
    <h5>Instrumen Evaluasi</h5>
    <br>
    <div class="row">
      <div class="col-md-12">
        <?php if($kurikulum->instrumen_evaluasi_peserta){ ?>
          <a href="<?= base_url('agenda/perdata/instrumen_evaluasi_peserta/'.$kurikulum->instrumen_evaluasi_peserta); ?>" target = "_blank" class = "btn btn-info" style = "width: 50%;">Instrumen Evaluasi Peserta</a>
        <?php } ?>
      </div>
    </div>
    <!-- <div class="peserta">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>a. Instrumen Evaluasi Hasil Belajar Peserta</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <table width="100%" border="1">
            <tr>
              <th style="width: 1%;" <?php if($nilai_evaluasi_peserta){ ?> rowspan="2" <?php } ?>>No.</th>
              <th <?php if($nilai_evaluasi_peserta){ ?> rowspan="2" <?php } ?>>Aspek Penilaian</th>
              <th <?php if($nilai_evaluasi_peserta){ ?> colspan = "<?= count($nilai_evaluasi_peserta); ?>" <?php } ?> >Nilai</th>
            </tr>
            <?php if($nilai_evaluasi_peserta){ ?>
              <tr>
                <?php foreach ($nilai_evaluasi_peserta as $key) { ?>
                  <th style="width: 3%;"><?= $key->nilai; ?></th>
                <?php } ?>
              </tr>
            <?php } ?>
            <?php if($evaluasi_peserta){ ?>
              <?php $no = 1; foreach ($evaluasi_peserta as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->aspek_penilaian; ?></td>
                  <?php if($nilai_evaluasi_peserta){ ?>
                    <?php foreach ($nilai_evaluasi_peserta as $nilai) { ?>
                      <td></td>
                    <?php } ?>
                  <?php } ?>
                  <?php if(!$nilai_evaluasi_peserta){ ?>
                    <td></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            <?php } ?>
            <?php if(!$evaluasi_peserta){ ?>
              <?php if($nilai_evaluasi_peserta){ $colspan = count($nilai_evaluasi_peserta) + 2; } else { $colspan = 3; } ?>
              <th colspan="<?= $colspan; ?>">Belum ada data</th>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <br>
    <hr> -->
    <!-- <div class="fasilitator">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>a. Instrumen Evaluasi Fasilitator</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <table width="100%" border="1">
            <tr>
              <th style="width: 1%;" <?php if($nilai_evaluasi_fasilitator){ ?> rowspan="2" <?php } ?>>No.</th>
              <th <?php if($nilai_evaluasi_fasilitator){ ?> rowspan="2" <?php } ?>>Aspek Penilaian</th>
              <th <?php if($nilai_evaluasi_fasilitator){ ?> colspan = "<?= count($nilai_evaluasi_fasilitator); ?>" <?php } ?> >Nilai</th>
            </tr>
            <?php if($nilai_evaluasi_fasilitator){ ?>
              <tr>
                <?php foreach ($nilai_evaluasi_fasilitator as $key) { ?>
                  <th style="width: 3%;"><?= $key->nilai; ?></th>
                <?php } ?>
              </tr>
            <?php } ?>
            <?php if($evaluasi_fasilitator){ ?>
              <?php $no = 1; foreach ($evaluasi_fasilitator as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->aspek_penilaian; ?></td>
                  <?php if($nilai_evaluasi_fasilitator){ ?>
                    <?php foreach ($nilai_evaluasi_fasilitator as $nilai) { ?>
                      <td></td>
                    <?php } ?>
                  <?php } ?>
                  <?php if(!$nilai_evaluasi_fasilitator){ ?>
                    <td></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            <?php } ?>
            <?php if(!$evaluasi_fasilitator){ ?>
              <?php if($nilai_evaluasi_fasilitator){ $colspan = count($nilai_evaluasi_fasilitator) + 2; } else { $colspan = 3; } ?>
              <th colspan="<?= $colspan; ?>">Belum ada data</th>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <br>
    <hr>
    <div class="penyelenggara">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>b. Instrumen Evaluasi Penyelenggara</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <table width="100%" border="1">
            <tr>
              <th style="width: 1%;" <?php if($nilai_evaluasi_penyelenggara){ ?> rowspan="2" <?php } ?>>No.</th>
              <th <?php if($nilai_evaluasi_penyelenggara){ ?> rowspan="2" <?php } ?>>Aspek Penilaian</th>
              <th <?php if($nilai_evaluasi_penyelenggara){ ?> colspan = "<?= count($nilai_evaluasi_penyelenggara); ?>" <?php } ?> >Nilai</th>
            </tr>
            <?php if($nilai_evaluasi_penyelenggara){ ?>
              <tr>
                <?php foreach ($nilai_evaluasi_penyelenggara as $key) { ?>
                  <th style="width: 3%;"><?= $key->nilai; ?></th>
                <?php } ?>
              </tr>
            <?php } ?>
            <?php if($evaluasi_penyelenggara){ ?>
              <?php $no = 1; foreach ($evaluasi_penyelenggara as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->aspek_penilaian; ?></td>
                  <?php if($nilai_evaluasi_penyelenggara){ ?>
                    <?php foreach ($nilai_evaluasi_penyelenggara as $nilai) { ?>
                      <td></td>
                    <?php } ?>
                  <?php } ?>
                  <?php if(!$nilai_evaluasi_penyelenggara){ ?>
                    <td></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            <?php } ?>
            <?php if(!$evaluasi_penyelenggara){ ?>
              <?php if($nilai_evaluasi_penyelenggara){ $colspan = count($nilai_evaluasi_penyelenggara) + 2; } else { $colspan = 3; } ?>
              <th colspan="<?= $colspan; ?>">Belum ada data</th>
            <?php } ?>
          </table>
        </div>
      </div>
    </div> -->
    <!-- <hr> -->
  </div>
</body>
</html>