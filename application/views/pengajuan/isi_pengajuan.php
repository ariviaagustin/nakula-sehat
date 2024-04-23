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
<?php $tes = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id_p, 'id_bagian' => $id))->row(); ?>
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
                                <td style="padding: 8px 10px; font-size: 11pt"><a href="<?= site_url('judul-pengajuan/'.bin2hex(base64_encode($id_p)).'/'.bin2hex(base64_encode($asal)).'/'.bin2hex(base64_encode($is_pmbg))); ?>" style="color: #000">Judul</a> <i class="fa fa-check" aria-hidden="true"></i></td>
                            </tr>
                            <?php foreach ($kur as $key){ ?>
                                <tr>
                                    <td style="padding: 8px 10px; font-size: 11pt" <?php if($this->uri->segment(3) == bin2hex(base64_encode($key->id_bagian))){ echo "class = 'aktif'"; } ?>>
                                        <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode($asal)).'/'.bin2hex(base64_encode($is_pmbg))); ?>">
                                            <?= $key->nama_alias; ?>
                                            <?php $wtk = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => $key->id_bagian))->row(); ?>
                                            <?php if($wtk){ ?>
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php } ?>
                                        </a>
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
                        <div id="kata_pengantar">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6><?= $nama->bagian_kurikulum; ?></h6>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="#" data-id = "<?= $id_p; ?>" data-bag = "<?= $id; ?>" class="btn btn-primary btn-sm riwayat"><i class="fa fa-history" aria-hidden="true"></i> Riwayat</a>
                                    <a href="#" data-id = "<?= $id; ?>" class="btn btn-info btn-sm petunjuk"><i class="fa fa-info-circle" aria-hidden="true"></i> Pentunjuk</a>
                                </div>
                            </div>
                            <hr>
                            <form action="<?= site_url('Pengajuan/aksi_isi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id = "form1">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Isi <?= $nama->bagian_kurikulum; ?></label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <!-- <textarea class="form-control" id="summernote" name="isi_bagian_kurikulum" required=""><?php if($tes){ echo $tes->isi_bagian_kurikulum; } ?></textarea> -->
                                        <textarea name="isi_bagian_kurikulum" id="txtEditor" rows="10" cols="80" required="">
                                            <?php if($tes){ echo $tes->isi_bagian_kurikulum; } ?>
                                        </textarea>
                                        <?php if($this->session->userdata('is_penilai') == 1){ ?>
                                            <span style="color: red">Notes: Silahkan gunakan warna atau tools yang tersedia untuk melakukan revisi</span>
                                        <?php } ?>
                                        <input type="hidden" name="id_pengajuan" value="<?= $pengajuan->id_pengajuan; ?>">
                                        <input type="hidden" name="id_pengaju" value="<?= $pengajuan->pengaju; ?>">
                                        <input type="hidden" name="id_bagian" value="<?= $id; ?>">
                                        <?php if($tes){ ?>
                                            <input type="hidden" name = "add" value="0">
                                            <input type="hidden" name = "id_bag_kurikulum_pengaju" value="<?= $tes->id_bag_kurikulum_pengaju; ?>">
                                        <?php } ?>
                                        <?php if(!$tes){ ?>
                                            <input type="hidden" name = "add" value="1">
                                        <?php } ?>
                                        <input type="hidden" name="asal" value="<?= $asal; ?>">
                                        <input type="hidden" name="is_pmbg" value="<?= $is_pmbg; ?>">
                                        <input type="hidden" name="id_penilai" value="<?= $pengajuan->id_penilai; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12"><hr></div>
                                    <div class="col-md-6" style="text-align: left;">
                                        <?php if($id != 14){ ?>
                                            <button type="submit" value="1" name="aksi" class="btn btn-info"><i class="fa fa-clock"></i> Teruskan Pengisian</button>
                                        <?php } ?>
                                    </div>
                                    <div class="col col-md-6" style="text-align: right;">
                                        <button type="submit" value="2" name="aksi" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Petunjuk <?= $nama->bagian_kurikulum; ?></b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="m_riwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Riwayat <?= $nama->bagian_kurikulum; ?></b></h7>
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
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.riwayat', function (e) {
      e.preventDefault();
      $("#m_riwayat").modal('show');
      $.post('<?= site_url('Pengajuan/riwayat');?>',
        {id: $(this).attr('data-id'), bag: $(this).attr('data-bag')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script>
    var editor = CKEDITOR.replace( 'txtEditor' );
    CKFinder.setupCKEditor( editor );
</script>
<script type="text/javascript">
    $('#form1').one('submit', function() {
        $(this).find('button[type="submit"]').attr('disabled','disabled');
    });
</script>