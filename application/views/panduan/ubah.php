<style type="text/css">
    #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header py-3" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Panduan</h5>
                </div>
            </div>
        </div>
        <form action="<?= site_url('Panduan/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Role<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <?php 
                                if($panduan->id_role == 1){ echo "Administrator"; }
                                 else if($panduan->id_role == 2){ echo "Institusi"; }
                                else if($panduan->id_role == 3){ echo "Penilai"; }
                                else if($panduan->id_role == 4){ echo "pj substansi"; }
                            ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Panduan<span style="color: red">*</span></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="file" class="form-control" name="panduan" required id="file" onchange="fileValidation()" accept="application/pdf">
                            <span style="color: red;">**Tipe dokumen : pdf</span>
                        </div>
                        <div class="col-md-3">
                            <?php if($panduan->panduan){ ?>
                                <a href="<?= base_url('agenda/perdata/panduan/'.$panduan->panduan); ?>" target = "_blank" class = "btn btn-info btn-sm"><i class="fa fa-file"></i> Lihat Panduan</a>
                            <?php } ?>
                            <?php if(!$panduan->panduan){ echo "Belum ada panduan"; } ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label><span style="color: red">* Wajib diisi</span></label>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <input type="hidden" name="id_panduan" value="<?= $panduan->id_panduan; ?>">
                            <input type="hidden" name="panduan_old" value="<?= $panduan->panduan; ?>">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    function fileValidation()
    {
        const fileInput = document.getElementById("file");
        var filePath = $("#file").val();
        var allowedExtensions = ["pdf"];
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