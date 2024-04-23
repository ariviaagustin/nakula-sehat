<html>
  <head></head>
  <body style="color: #000">
    <form action="<?= site_url('Pengajuan/aksi_ubah_jadwal'); ?>" method = "post">
      <div class="modal-body">
        <input type="hidden" name="id_timeline" value="<?= $jadwal->id_timeline; ?>">
        <input type="hidden" name="id_pengajuan" value="<?= $jadwal->id_pengajuan; ?>">
        <div class="row">
          <div class="row form-group">
            <div class="col col-md-12">
              <label for="text-input" class=" form-control-label"><?= $kur->nama_alias; ?></label>
            </div>
            <div class="col-5 col-md-5">
              <input type="date" name="waktu_mulai" class = "form-control" required style="width: 100%" value="<?= $jadwal->waktu_mulai; ?>">
            </div>
            <div class="col-2 col-md-2">
              <p style="text-align: center;"> sampai </p>
            </div>
            <div class="col-5 col-md-5">
              <input type="date" name="waktu_selesai" class = "form-control" required style="width: 100%" value="<?= $jadwal->waktu_selesai; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" style = "border-radius: 3px;">Simpan</button>
      </div>
    </form>
  </body>
</html>