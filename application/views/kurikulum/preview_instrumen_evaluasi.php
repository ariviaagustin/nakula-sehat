<!DOCTYPE html>
<html>
<style type="text/css">
  h3{ font-family: Verdana, sans-serif; font-size: 14pt; font-weight: bold; text-align: center; }
  h4{ font-family: Verdana, sans-serif; font-size: 12pt; font-weight: bold; }
  .isi{ font-family: Verdana, sans-serif; font-size: 12pt; text-align: justify; font-weight:100; margin-top:5%; }
   .isi_instrumen_evaluasi{ font-family: Verdana, sans-serif; font-size: 9pt; text-align: justify; font-weight:100; margin-top:5%; }
  th{ text-align:center; font-weight:bold; }
  ul, ol, li{ margin-top: 0px; padding-top: 0px; padding-left: -10px; }
</style>
<body style="color: #000;">
  <h4 style="text-align: left;">LAMPIRAN 5. INSTRUMEN EVALUASI</h4>
  <br><br>
  <table width="100%" style="padding: 5px; width: 100%;">
    <tr>
      <td class="isi" style="width: 5%;"><b>a. </b></td>
      <td class="isi" style="width: 95%;"><b>Instrumen Evaluasi Fasilitator</b></td>
    </tr>
    <?php if($nilai_evaluasi_fasilitator || $evaluasi_fasilitator){ ?>
      <tr>
        <td></td>
        <table width="100%" border="1" style="padding: 5px;">
          <tr>
            <th class="isi_instrumen_evaluasi" style="text-align: center; width: 5%;" <?php if($nilai_evaluasi_fasilitator){ ?> rowspan="2" <?php } ?>><b>No.</b></th>
            <th style="width: 15%;" class="isi_instrumen_evaluasi" <?php if($nilai_evaluasi_fasilitator){ ?> rowspan="2" <?php } ?>><b>Aspek Penilaian</b></th>
            <th class="isi_instrumen_evaluasi" style="text-align: center;" <?php if($nilai_evaluasi_fasilitator){ ?> colspan = "<?= count($nilai_evaluasi_fasilitator); ?>" <?php } ?> ><b>Nilai</b></th>
          </tr>
          <?php if($nilai_evaluasi_fasilitator){ ?>
            <tr>
              <?php foreach ($nilai_evaluasi_fasilitator as $key) { ?>
                <th class="isi_instrumen_evaluasi" style="text-align: center;"><?= $key->nilai; ?></th>
              <?php } ?>
            </tr>
          <?php } ?>
          <?php if($evaluasi_fasilitator){ ?>
          <?php $no = 1; foreach ($evaluasi_fasilitator as $key) { ?>
            <tr>
              <td class="isi_instrumen_evaluasi" style="text-align: center;"><?= $no++; ?></td>
              <td class="isi_instrumen_evaluasi"><?= $key->aspek_penilaian; ?></td>
              <?php if($nilai_evaluasi_fasilitator){ ?>
                <?php foreach ($nilai_evaluasi_fasilitator as $nilai) { ?>
                  <td class="isi_instrumen_evaluasi"></td>
                <?php } ?>
              <?php } ?>
              <?php if(!$nilai_evaluasi_fasilitator){ ?>
                <td class="isi_instrumen_evaluasi"></td>
              <?php } ?>
            </tr>
          <?php } ?>
        <?php } ?>
        </table>
      </tr>
    <?php } ?>
  </table>
  <p style="page-break-before: always"></p>
  <table width="100%" style="padding: 5px; width: 100%;">
    <tr>
      <td class="isi" style="width: 5%;"><b>b. </b></td>
      <td class="isi" style="width: 95%;"><b>Instrumen Evaluasi Penyelenggara</b></td>
    </tr>
    <?php if($nilai_evaluasi_penyelenggara || $evaluasi_penyelenggara){ ?>
      <tr>
        <td></td>
        <table width="100%" border="1" style="padding: 5px;">
          <tr>
            <th class="isi_instrumen_evaluasi" style="text-align: center; width: 5%;" <?php if($nilai_evaluasi_penyelenggara){ ?> rowspan="2" <?php } ?>><b>No.</b></th>
            <th style="width: 15%;" class="isi_instrumen_evaluasi" <?php if($nilai_evaluasi_penyelenggara){ ?> rowspan="2" <?php } ?>><b>Aspek Penilaian</b></th>
            <th class="isi_instrumen_evaluasi" style="text-align: center;" <?php if($nilai_evaluasi_penyelenggara){ ?> colspan = "<?= count($nilai_evaluasi_penyelenggara); ?>" <?php } ?> ><b>Nilai</b></th>
          </tr>
          <?php if($nilai_evaluasi_penyelenggara){ ?>
            <tr>
              <?php foreach ($nilai_evaluasi_penyelenggara as $key) { ?>
                <th class="isi_instrumen_evaluasi" style="text-align: center;"><?= $key->nilai; ?></th>
              <?php } ?>
            </tr>
          <?php } ?>
          <?php if($evaluasi_penyelenggara){ ?>
          <?php $no = 1; foreach ($evaluasi_penyelenggara as $key) { ?>
            <tr>
              <td class="isi_instrumen_evaluasi" style="text-align: center;"><?= $no++; ?></td>
              <td class="isi_instrumen_evaluasi"><?= $key->aspek_penilaian; ?></td>
              <?php if($nilai_evaluasi_penyelenggara){ ?>
                <?php foreach ($nilai_evaluasi_penyelenggara as $nilai) { ?>
                  <td class="isi_instrumen_evaluasi"></td>
                <?php } ?>
              <?php } ?>
              <?php if(!$nilai_evaluasi_penyelenggara){ ?>
                <td class="isi_instrumen_evaluasi"></td>
              <?php } ?>
            </tr>
          <?php } ?>
        <?php } ?>
        </table>
      </tr>
    <?php } ?>
  </table>
</body>
</html>