<!DOCTYPE html>
<html>
<style type="text/css">
  h3{ font-family: Verdana, sans-serif; font-size: 14pt; font-weight: bold; text-align: center; }
  h4{ font-family: Verdana, sans-serif; font-size: 12pt; font-weight: bold; }
  .isi{ font-family: Verdana, sans-serif; font-size: 12pt; text-align: justify; font-weight:100; margin-top:5%; }
   .isi_penyelenggara{ font-family: Verdana, sans-serif; font-size: 9pt; text-align: justify; font-weight:100; margin-top:5%; }
  th{ text-align:center; font-weight:bold; }
  ul, ol, li{ margin-top: 0px; padding-top: 0px; padding-left: -10px; }
</style>
<body style="color: #000;">
  <h4 style="text-align: left;">LAMPIRAN 4. KETENTUAN PENYELENGGARAAN PELATIHAN</h4>
  <br><br>
  <table width="100%" style="padding: 5px; width: 100%;">
    <tr>
      <td class="isi" style="width: 5%;"><b>1. </b></td>
      <td class="isi" style="width: 95%;"><b>Peserta Pelatihan</b></td>
    </tr>
    <tr>
      <td></td>
      <td class="isi">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
    </tr>
    <tr>
      <td></td>
      <td class="isi">
        <?php if($peserta){ ?>
          <ol style="margin-bottom: 0px !important">
            <?php 
              foreach ($peserta as $key) 
              {
                echo "<li>".$key->isi_peserta."</li>";
              }
            ?>
          </ol>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td colspan="2"><br></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"><b>2. </b></td>
      <td class="isi" style="width: 95%;"><b>Jumlah peserta dalam satu kelas</b> maksimal <?= $kurikulum->jumlah_peserta; ?> orang</td>
    </tr>
    <tr>
      <td colspan="2"><br></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"><b>3. </b></td>
      <td class="isi" style="width: 95%;"><b>Pelatih/Fasilitator</b></td>
    </tr>
    <?php if($materi_dasar || $materi_inti || $materi_penunjang){ ?>
      <tr>
        <td></td>
        <td class="isi_penyelenggara">
          <table border="1" width="100%" style="padding: 5px;">
            <tr>
              <th style="width: 10%; text-align: center; font-weight: bold;" class="isi_penyelenggara">No</th>
              <th style="width: 40%; text-align: center; font-weight: bold;" class="isi_penyelenggara">Materi</th>
              <th style="width: 50%; text-align: center; font-weight: bold;" class="isi_penyelenggara">Kriteria Fasilitator</th>
            </tr>
            <tr>
              <td style="text-align: center;" class="isi_penyelenggara"><b>A.</b></td>
              <td colspan="3" class="isi_penyelenggara"><b>MATA PELATIHAN DASAR</b></td>
            </tr>
            <?php $no = 1; foreach ($materi_dasar as $key) { ?>
              <tr>
                <td style="text-align: center;" class="isi_penyelenggara"><?= $no++; ?></td>
                <td class="isi_penyelenggara"><?= $key->materi; ?></td>
                <td class="isi_penyelenggara"><?= $key->kriteria_fasilitator; ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td style="text-align: center;" class="isi_penyelenggara"><b>B.</b></td>
              <td colspan="3" class="isi_penyelenggara"><b>MATA PELATIHAN INTI</b></td>
            </tr>
            <?php $no = 1; foreach ($materi_inti as $key) { ?>
              <tr>
                <td style="text-align: center;" class="isi_penyelenggara"><?= $no++; ?></td>
                <td class="isi_penyelenggara"><?= $key->materi; ?></td>
                <td class="isi_penyelenggara"><?= $key->kriteria_fasilitator; ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td style="text-align: center;" class="isi_penyelenggara"><b>C.</b></td>
              <td colspan="3" class="isi_penyelenggara"><b>MATA PELATIHAN PENUNJANG</b></td>
            </tr>
            <?php $no = 1; foreach ($materi_penunjang as $key) { ?>
              <tr>
                <td style="text-align: center;" class="isi_penyelenggara"><?= $no++; ?></td>
                <td class="isi_penyelenggara"><?= $key->materi; ?></td>
                <td class="isi_penyelenggara"><?= $key->kriteria_fasilitator; ?></td>
              </tr>
            <?php } ?>
          </table>
        </td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="2"><br></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"><b>4. </b></td>
      <td class="isi" style="width: 95%;"><b>Ketentuan Penyelenggara</b></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"></td>
      <td class="isi" style="width: 95%;"><?= $kurikulum->ketentuan_penyelenggara; ?></td>
    </tr>
    <tr>
      <td colspan="2"><br></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"><b>5. </b></td>
      <td class="isi" style="width: 95%;"><b>Sertifikasi</b></td>
    </tr>
    <tr>
      <td class="isi" style="width: 5%;"></td>
      <td class="isi" style="width: 95%;"><?= $kurikulum->sertifikat; ?></td>
    </tr>
  </table>
  <p style="page-break-before: always"></p>
  <table width="100%" style="padding: 5px; width: 100%;">
    <tr>
      <td class="isi" style="width: 100%; text-align: center;"><b>Tim Penyusun</b></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td class="isi" style="text-align: center;">
        <?php $tim_penyusun = $this->M_entitas->selectX('tim_penyusun', array('id_kurikulum' => $kurikulum->id_kurikulum))->result(); ?>
        <?php if($tim_penyusun){ ?>
            <?php 
              foreach ($tim_penyusun as $key) 
              {
                echo $key->nama_penyusun." - ".$kurikulum->nama_institusi."<br>";
              }
            ?>
        <?php } ?>
      </td>
    </tr>
  </table>
</body>
</html>