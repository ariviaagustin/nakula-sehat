<script src="<?= base_url(); ?>agenda/texteditor/ckeditor/ckeditor.js"></script>
<script src="<?= base_url(); ?>agenda/texteditor/ckfinder/ckfinder.js"></script>
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
</style>
<div class="container-fluid">
  <!-- DataTales Example -->
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Pengajuan</h5>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding: 0px">
            <div class="card-body card-block" style="padding: 0px">
                <div class="row">
                    <div class="col-md-4">
                        <table border="1">
                            <tr>
                                <td style="padding: 8px 10px; font-size: 11pt"><a href="<?= site_url('Pengajuan/pengajuan_pj/'.bin2hex(base64_encode($id_p))); ?>" style="color: #000">Judul</a> <i class="fa fa-check" aria-hidden="true"></i></td>
                            </tr>
                            <?php foreach ($kur as $key){ ?>
                                <tr>
                                    <td style="padding: 8px 10px; font-size: 11pt" class="<?php if($this->uri->segment(1) == $key->link){ echo 'aktif'; } ?>"><a href="<?= site_url($key->link.'/'.bin2hex(base64_encode($id_p))); ?>">
                                        <?= $key->nama_alias; ?></a>
                                        <?php 
                                            $tes = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id_p, 'id_bagian' => $key->id_bagian))->num_rows();
                                            if($tes >= 1){ ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php
                                            if($key->link == $this->uri->segment(1))
                                            { 
                                                $id = $key->id_bagian; 
                                                $nama = $key->nama_alias; 
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <?php 
                        $cek = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id_p, 'id_bagian' => $id));
                        if($cek->num_rows >= 1){ $kp = $cek->row(); $is_kp = 1; }
                        else{ $is_kp = 0; }
                    ?>
                    <div class="col-md-8">
                        <div id="latar_belakang">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6>G. Bab II - Struktur Kurikulum</h6>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="#" data-id = "<?= $id; ?>" class="btn btn-info btn-sm petunjuk"><i class="fa fa-info-circle" aria-hidden="true"></i> Pentunjuk</a>
                                </div>
                            </div>
                            <hr>
                            <form action="<?= site_url('Pengajuan/aksi_sk'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Struktur Kurikulum</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <textarea name="isi_bagian_kurikulum" id="txtEditor" rows="10" cols="80">
                                            <?php if($is_kp == 1){ echo $kp->isi_bagian_kurikulum; } ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12" style="text-align: center;">
                                        <?php if($is_kp == 1){ ?>
                                            <input type="hidden" name="id_bag_kurikulum_pengaju" value="<?= $kp->id_bag_kurikulum_pengaju; ?>">
                                            <input type="hidden" name="add" value="0">
                                        <?php } ?>
                                        <?php if($is_kp == 0){ ?>
                                            <input type="hidden" name="add" value="1">
                                        <?php } ?>
                                        <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                                        <input type="hidden" name="id_pengaju" value="<?= $pengajuan->pengaju; ?>">
                                        <input type="hidden" name="id_bagian" value="<?= $id; ?>">
                                        <button type="submit" value="1" name="aksi" class="btn btn-info">Simpan dan Lanjut</button>
                                        <button type="submit" value="2" name="aksi" class="btn btn-info">Simpan dan Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Petunjuk <?= $nama; ?></b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.petunjuk', function (e) {
      e.preventDefault();
      $("#myModal").modal('show');
      $.post('<?= site_url('Pengajuan/petunjuk');?>',
        {id: $(this).attr('data-id')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script>
    var editor = CKEDITOR.replace( 'txtEditor' );
    CKFinder.setupCKEditor( editor );
</script>