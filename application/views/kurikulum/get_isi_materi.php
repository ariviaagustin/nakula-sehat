<!DOCTYPE html>
<html>
<style type="text/css">
  td, th{ padding: 5px; border: 1px solid; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <table width="100%" >
      <tr>
        <th>No</th>
        <th>Materi</th>
      </tr>
      <tr>
        <td>A.</td>
        <th style="text-align: left;">MATERI PELATIHAN DASAR</th>
      </tr>
      <?php $no = 1; foreach ($materi_dasar as $key) { ?>
        <tr>
          <td style="text-align: center;"><?= $no++; ?>.</td>
          <td><?= $key->materi; ?></td>
        </tr>
      <?php } ?>
      <tr>
        <td>B.</td>
        <th style="text-align: left;">MATERI PELATIHAN INTI</th>
      </tr>
      <?php $no = 1; foreach ($materi_inti as $key) { ?>
        <tr>
          <td style="text-align: center;"><?= $no++; ?>.</td>
          <td><?= $key->materi; ?></td>
        </tr>
      <?php } ?>
      <tr>
        <td>B.</td>
        <th style="text-align: left;">MATERI PELATIHAN PENUNJANG</th>
      </tr>
      <?php $no = 1; foreach ($materi_penunjang as $key) { ?>
        <tr>
          <td style="text-align: center;"><?= $no++; ?>.</td>
          <td><?= $key->materi; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>