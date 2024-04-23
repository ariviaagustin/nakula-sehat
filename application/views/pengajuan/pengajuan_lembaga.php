<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<style type="text/css">
    #content
    {
        background-color: #fff;
    }
    table
    {
        border: 1px solid #d6d6d6;
    }
    .aktif
    {
        background-color: #32bacf;
        color: #fff;
    }
    .aktif a
    {
        color: #fff !important;
        font-weight: 600;
    }
    a{ color: #000; }
    a.disabled
    {
        pointer-events: none;
    cursor: default;
    opacity: .65;
    }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Pengajuan</h5>
            <hr style="margin-bottom: 0px;">
        </div>
        <div class="card-body" style="color: #000; padding: 10px">
            <div class="card-body card-block" style="padding: 10px">
                <form action="<?= site_url('Pengajuan/aksi_pengajuan_lembaga'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="text-input" class=" form-control-label">Tahun</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <input type="text" class="form-control" name="tahun" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="text-input" class=" form-control-label">Judul Kurikulum</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <input type="text" class="form-control" name="judul_kurikulum" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="text-input" class=" form-control-label">PJ Substansi</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <select name="pj_subtansi" class="form-control select2" required="">
                                <option value="">-- Pilih PJ</option>
                                <?php foreach ($pj as $key) { ?>
                                    <option value="<?= $key->id_pj_subtansi; ?>"><?= $key->nama_pj_subtansi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="text-input" class=" form-control-label">File Pengajuan</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <input type="file" class="form-control" name="file_pengajuan" required="" accept="image/jpg, image/jpeg, image/png, application/pdf" id = "file" onchange="fileValidation()">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-12" style="text-align: right;">
                            <hr>
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script type="text/javascript">
  function fileValidation()
  {
    const fileInput = document.getElementById("file");
    var filePath = $("#file").val();
    var allowedExtensions = ["jpg","jpeg", "png", "pdf"];
    var aux = filePath.split('.');
    var extension = aux[aux.length -1].toLowerCase();
    console.log(extension);
    if(allowedExtensions.indexOf(extension) > -1)
    {
      if (fileInput.files.length > 0) 
      { 
        for (const i = 0; i <= fileInput.files.length - 1; i++) 
        {  
          const fsize = fileInput.files.item(i).size; 
          const file = Math.round((fsize / 1024));
          if (file >= 2048) 
          { 
            alert("Ukuran File terlalu besar"); 
            fileInput.value = '';
            return false;
          }
        } 
      }
    }
    else
    {
      alert("file tidak sesuai");
      fileInput.value = '';
      return false;
    }
  }
</script>