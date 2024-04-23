<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
  .btn-kompetensi{ background-color: crimson; border-color:crimson; }
  .btn-materi{ background-color: darkblue; border-color: darkblue; }
  .btn-sasaran{ background-color: forestgreen; border-color: forestgreen; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-surat-rekomendasi{ background-color: coral; border-color: coral; }
  .btn-surat-pengantar{ background-color: darkgoldenrod; border-color: darkgoldenrod; }
  .btn-waktu-pengerjaan{ background-color: brown; border-color: brown; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <h6><b>Tujuan</b></h6>
        <p><?= $kurikulum->tujuan; ?>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h6><b>Kompetensi</b></h6>
        <table width="100%" border="0">
          <tr>
            <td colspan="2"><?= $kurikulum->kompetensi; ?></td>
          </tr>
          <?php $no = 1; foreach ($isi_kompetensi as $key) { ?>
            <tr>
              <td><?= $no++; ?>.</td>
              <td><?= $key->isi_kompetensi; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h6><b>Materi</b></h6><br>
        <table width="100%" border="1">
          <tr>
            <th style="border: 1px solid;">No</th>
            <th style="border: 1px solid;">Materi</th>
          </tr>
          <tr style="background-color: #cacaca;">
            <td style="border: 1px solid; text-align: center;">A.</td>
            <th style="text-align: left; border: 1px solid;">MATERI PELATIHAN DASAR</th>
          </tr>
          <?php $no = 1; foreach ($materi_dasar as $key) { ?>
            <tr>
              <td style="text-align: center; border: 1px solid;"><?= $no++; ?>.</td>
              <td style="border: 1px solid;"><?= $key->materi; ?></td>
            </tr>
          <?php } ?>
          <tr style="background-color: #cacaca;">
            <td style="border: 1px solid; text-align: center;">B.</td>
            <th style="text-align: left; border: 1px solid;">MATERI PELATIHAN INTI</th>
          </tr>
          <?php $no = 1; foreach ($materi_inti as $key) { ?>
            <tr>
              <td style="text-align: center; border: 1px solid;"><?= $no++; ?>.</td>
              <td style="border: 1px solid;"><?= $key->materi; ?></td>
            </tr>
          <?php } ?>
          <tr style="background-color: #cacaca;">
            <td style="border: 1px solid; text-align: center;">C.</td>
            <th style="text-align: left; border: 1px solid;">MATERI PELATIHAN PENUNJANG</th>
          </tr>
          <?php $no = 1; foreach ($materi_penunjang as $key) { ?>
            <tr>
              <td style="text-align: center; border: 1px solid;"><?= $no++; ?>.</td>
              <td style="border: 1px solid;"><?= $key->materi; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <table>
          <tr>
            <td><h6><b>Jumlah JPL</b></h6></td>
            <td>:</td>
            <td><?= $kurikulum->jumlah_jpl; ?></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h6><b>Sasaran Peserta</b></h6>
        <table width="100%" >
          <tr>
            <td colspan="2"><?= $kurikulum->sasaran_peserta; ?></td>
          </tr>
          <?php $no = 1; foreach ($isi_peserta as $key) { ?>
            <tr>
              <td><?= $no++; ?>.</td>
              <td><?= $key->isi_peserta; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <table>
          <tr>
            <td><h6><b>KAK / TOR</b></h6></td>
            <td>:</td>
            <td><a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class="btn btn-info btn-sm btn-kaktor" target = "_blank">KAK/TOR</a></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <table>
          <tr>
            <td><h6><b>Surat Pengantar</b></h6></td>
            <td>:</td>
            <td><a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class="btn btn-info btn-sm btn-surat-pengantar" target = "_blank">Surat Pengantar</a></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <?php if($kurikulum->status == 2){ ?>
      <div class="row">
        <div class="col-md-12">
          <table>
            <tr>
              <td><h6><b>Surat Keterangan</b></h6></td>
              <td>:</td>
              <td><a href="<?= base_url('agenda/perdata/surat_rekomendasi/non_pelatihan/'.$kurikulum->surat_rekomendasi); ?>" class="btn btn-info btn-sm btn-surat-rekomendasi" target = "_blank">Surat Keterangan</a></td>
            </tr>
          </table>
        </div>
      </div>
      <hr>
    <?php } ?>
    <?php if($kurikulum->status >= 2){ ?>
      <div class="row">
        <div class="col-md-12">
          <table>
            <tr>
              <td><h6><b>Kebutuhan Pelatihan</b></h6></td>
              <td>:</td>
              <td><?= $kurikulum->keterangan_kebutuhan_pelatihan; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <hr>
    <?php } ?>
    <?php if($kurikulum->status == 4){ ?>
      <div class="row">
        <div class="col-md-12">
          <table>
            <tr>
              <td><h6><b>Surat Keterangan</b></h6></td>
              <td>:</td>
              <td><a href="<?= base_url('agenda/perdata/surat_rekomendasi/kurikulum_tersedia/'.$kurikulum->surat_rekomendasi); ?>" class="btn btn-info btn-sm btn-surat-rekomendasi" target = "_blank">Surat Keterangan</a></td>
            </tr>
          </table>
        </div>
      </div>
      <hr>
    <?php } ?>
  </div>
</body>
</html>