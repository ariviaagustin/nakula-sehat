<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <h6>Kompetensi</h6>
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
</body>
</html>