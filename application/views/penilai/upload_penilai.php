<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Penilai</h5>
        </div>
        <form action="<?= site_url('penilai/aksi_upload'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Upload</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" class="form-control" name="file" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    function fileValidation(){
        const fileInput = document.getElementById("file");
        var filePath = $("#file").val();
        var allowedExtensions = ["jpg","jpeg", "png"];
        var aux = filePath.split('.');
        var extension = aux[aux.length -1].toLowerCase();
        console.log(extension);
        if(allowedExtensions.indexOf(extension) > -1){
        //alert("file sesuai");
        if (fileInput.files.length > 0) { 
            for (const i = 0; i <= fileInput.files.length - 1; i++) 
            {  
                const fsize = fileInput.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 2048) { 
                    alert( 
                      "Ukuran File terlalu besar"); 
                    fileInput.value = '';
                    return false;
                }
            } 
        }
    }else{
        alert("file tidak sesuai");
        fileInput.value = '';
        return false;
    }
}
</script>