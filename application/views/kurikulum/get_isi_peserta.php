<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
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
</body>
</html>