<html>
  <head>
    <style type="text/css">
      .space{ margin-bottom: 20px; }
    </style>
  </head>
  <body style="color: #000">
    <form action="<?= site_url('Pengajuan/aksi_catatan'); ?>" method = "post">
      <div class="modal-body">
        <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
        <?php if($bagian == 0){ ?>
          <input type="hidden" name="bagian" value="0">
        <?php } ?>
        <?php if($bagian > 0){ ?>
          <input type="hidden" name="bagian" value="<?= $bagian; ?>">
        <?php } ?>
        <div class="row">
          <?php if($bagian == 0){ ?>
            <div class="col-md-12"><label>Catatan Judul</label></div>
          <?php } ?>
          <?php if($bagian > 0){ ?>
            <div class="col-md-12"><label>Catatan <?= $nama_bagian->nama_alias; ?></label></div>
          <?php } ?>
          <div class="col-md-12">
            <textarea name="catatan" class="form-control"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" style = "border-radius: 3px;">Simpan</button>
      </div>
    </form>
  </body>
</html>