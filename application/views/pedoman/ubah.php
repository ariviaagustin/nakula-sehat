<style type="text/css">
  #content{ background-color: #fff; }
</style>
<div class="container-fluid">
    <div class="card mb-4" style="border: 0px; padding: 0px;">
        <div class="card-header py-3" style="background-color: #fff; color: #000">
            <h5 class="m-0 font-weight-bold" style="font-size: 17px">Pedoman</h5>
        </div>
        <form action="<?= site_url('Pedoman/aksi_ubah'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body" style="padding: 10px; color: #000">
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Pedoman</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="pedoman" required>
                                </div>
                                <div class="col-md-4">
                                    <?php if($pedoman->pedoman){ ?>
                                        <a href="<?= base_url('agenda/perdata/pedoman/'.$pedoman->pedoman); ?>" target = "_blank" class = "btn btn-info btn-sm"> Lihat pedoman</a>
                                    <?php } ?>
                                    <?php if(!$pedoman->pedoman){ echo "Belum ada pedoman"; } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background-color: #fff">
                <div class="row form-group">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="hidden" name="id_pedoman" value="<?= $pedoman->id_pedoman; ?>">
                        <input type="hidden" name="pedoman_old" value="<?= $pedoman->pedoman; ?>">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    var editor = CKEDITOR.replace( 'txtEditor' );
    CKFinder.setupCKEditor( editor );
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>