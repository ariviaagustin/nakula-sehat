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
    <div class="row">
      <div class="col-md-12">
        <h5>4. Ketentuan Penyelenggaraan Pelatihan</h5><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table width="100%" border="1">
          <tr>
            <th style="width: 1%;">No.</th>
            <th>Kriteria Peserta</th>
          </tr>
          <?php if($peserta){ ?>
            <?php $no = 1; foreach ($peserta as $key) { ?>
              <tr>
                <td style="text-align: center;"><?= $no++; ?>.</td>
                <td><?= $key->isi_peserta; ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
          <?php if(!$peserta){ ?>
            <tr>
              <td colspan="2" style="text-align: center;">Belum ada data</td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>
    <div class="efektifitas_pelatihan">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>Efektifitas Pelatihan</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <table width="100%">
            <tr>
              <td style="width: 22%;">Jumlah peserta dalam satu kelas</td>
              <td style="width: 1%;">:</td>
              <?php if($kurikulum->jumlah_peserta){ ?>
                <td style="width: fit-content;"><?= $kurikulum->jumlah_peserta; ?></td>
              <?php } ?>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <hr>
    <div class="efektifitas_pelatihan">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>Pelatih (Fasilitator/ Instruktur)</b></h5>
        </div>
      </div>
      <br>
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="background-color: lemonchiffon;">
                <th style="width: 1%;">NO</th>
                <th>MATERI</th>
                <th>Kriteria Fasilitator</th>
              </tr>
            </thead>
            <tbody>
              <tr style="background-color: #d8d8d8;">
                <td><b>A.</b></td>
                <td colspan="3"><b>MATA PELATIHAN DASAR</b></td>
              </tr>
              <?php $no = 1; foreach($materi_dasar as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td><?= $key->kriteria_fasilitator; ?></td>
                </tr>
              <?php } ?>
              <tr style="background-color: #d8d8d8;">
                <td><b>B.</b></td>
                <td colspan="3"><b>MATA PELATIHAN INTI</b></td>
              </tr>
              <?php $no = 1; foreach($materi_inti as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td><?= $key->kriteria_fasilitator; ?></td>
                </tr>
              <?php } ?>
              <tr style="background-color: #d8d8d8;">
                <td><b>C.</b></td>
                <td colspan="3"><b>MATA PELATIHAN PENUNJANG</b></td>
              </tr>
              <?php $no = 1; foreach($materi_penunjang as $key) { ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td><?= $key->kriteria_fasilitator; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <hr>
    <div class="ketentuan_penyelenggara">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>Ketentuan Penyelenggara</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <?php if($kurikulum->ketentuan_penyelenggara){ echo $kurikulum->ketentuan_penyelenggara; } ?>
        </div>
      </div>
    </div>
    <hr>
    <div class="sertifikat">
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;"><b>Sertifikasi</b></h5>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <?php if($kurikulum->sertifikat){ echo $kurikulum->sertifikat; } ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>