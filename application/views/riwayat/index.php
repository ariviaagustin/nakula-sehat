<style type="text/css">
  #content { background-color: #fff; }
  a:hover{ text-decoration: none; }
</style>
<div class="container-fluid">
  <div class="row" style="margin-bottom: 1%">
    <div class="col-md-6">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 17px">Riwayat</h1>
      </div>
    </div>
    <div class="col-md-6" style="text-align: right;">
      <a href="#" data-target = "#cari" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Cari</a>
    </div>
  </div>
  <div class="row">
    <?php if($pengajuan){ ?>
      <?php foreach ($pengajuan as $key) { ?>
        <div class="col-md-4 col-12 col-sm-12 col-xs-12">
          <div class="card mb-4" style="background: #fff; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important; color: #000; padding: 0px;">
            <div class="card-body" style="padding: 10px">
              <?php if($key->status >= 1){ ?>
                <a href="<?= site_url('detail-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode(0))); ?>" style = "color: #000;">
              <?php } ?>
              <?php if($key->status == 0){ ?>
                <a href="<?= site_url('detail-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode(0))); ?>" style = "color: #000;">
              <?php } ?>
                <div class="row">
                  <div class="col-md-12 col-12 col-sm-12 col-xs-12" style="text-align: right;">
                    <span style="font-size: 15px;">
                      <!-- <b><?php if($key->jenis_ajuan == 1){ echo "Pengajuan"; } else if($key->jenis_ajuan == 2){ echo "Pengesahan"; } ?></b> -->
                      <?= indonesian_date(date('Y-m-d', strtotime($key->created_at))); ?>
                    </span>
                  </div>
                  <!-- <div class="col-md-6 col-6 col-sm-6 col-xs-6" style="text-align: right;">
                    <span><b><?= $key->tahun; ?></b></span>
                  </div> -->
                </div>
                <hr style="margin-top: 5px;">
                <div class="row" style="margin-top: 5%">
                  <div class="col-md-4 col-12 col-sm-12 col-xs-12">
                    <?php if($key->gambar_cover){ ?>
                      <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$key->gambar_cover); ?>" style = "width: 100%; height: 85px;">
                    <?php } ?>
                    <?php if(!$key->gambar_cover){ echo "<div style = 'height: 85px;'><p style = 'font-size: 10px;'>Belum ada gambar</p></div>"; } ?>
                  </div>
                  <div class="col-md-8 col-12 col-sm-12 col-xs-12">
                    <h5 style="font-size: 16px; margin-top: 5px"><b>
                      <?php 
                        if(strlen($key->judul_kurikulum) > 45){ echo substr($key->judul_kurikulum, 0,40)."..."; }
                        else { echo $key->judul_kurikulum; }
                      ?>                        
                    </b></h5>
                  </div>
                </div>
                <div class="row" style="margin-top: 5%">
                  <div class="col-md-12 col-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2">
                        <i class="fa fa-info-circle" style="font-size: 14px; color: #018E87"></i>
                      </div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 13px"> <b>Status</b></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2"></div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <?php 
                          if($key->status == 0){ echo "<span style='background-color: black; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 1){ echo "<span style='background-color: #d98e00; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 2){ echo "<span style='background-color: brown; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 3){ echo "<span style='background-color: grey; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 4){ echo "<span style='background-color: green; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 5){ echo "<span style='background-color: #ff4700; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 6){ echo "<span style='background-color: #3ebf1e; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                          else if($key->status == 100){ echo "<span style='background-color: red; border-radius: 100%; padding: 0px 9px'>&nbsp;</span>"; }
                        ?>
                        <span style="font-size: 14px">
                          <?php 
                            if($key->status == 0){ echo "Proses Pengajuan"; }
                            else if($key->status == 1){ echo "Menunggu Verifikasi"; }
                            else if($key->status == 2){ echo "Proses Pembuatan Timeline"; }
                            else if($key->status == 3){ echo "Dalam Proses"; }
                            else if($key->status == 4){ echo "Selesai"; }
                            else if($key->status == 5){ echo "Pengajuan Permohonan Kurikulum"; }
                            else if($key->status == 6){ echo "Permohonan Kurikulum Disetujui"; }
                            else if($key->status == 100){ echo "Pengajuan Ditolak"; }
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 5%">
                  <div class="col-md-12 col-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2">
                        <i class="fa fa-check-square" style="font-size: 14px; color: #018E87"></i>
                      </div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 13px"> <b>Kelengkapan</b></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2"></div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 14px">
                          <?php
                            if($key->kelengkapan == 1){ echo "Judul"; }
                            else if($key->kelengkapan < 15){ echo "Belum Lengkap"; }
                            else{ echo "Lengkap"; }
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 5%">
                  <div class="col-md-12 col-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2">
                        <i class="fa fa-address-card" style="font-size: 14px; color: #018E87"></i>
                      </div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 13px"> <b>Penanggung Jawab</b></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2"></div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 14px">
                          <?php
                            foreach ($peje as $pejee) 
                            {
                              if($pejee->id_pj_subtansi == $key->pj_subtansi)
                              {
                                echo $pejee->nama_pj_subtansi;
                              }
                            }
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 5%">
                  <div class="col-md-12 col-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2">
                        <i class="fa fa-male" style="font-size: 14px; color: #018E87"></i>
                      </div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 13px"> <b>Penilai</b></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1 col-lg-1 col-sm-2 col-2 col-xs-2"></div>
                      <div class="col-md-10 col-10 col-xs-10 col-sm-10" style="padding-left: 5px">
                        <span style="font-size: 14px">
                          <?php
                            if($key->id_penilai)
                            {
                              foreach ($penilai as $pend) 
                              {
                                if($pend->id_penilai == $key->id_penilai)
                                {
                                  echo $pend->nama_penilai;
                                }
                              }
                            }
                            else
                            {
                              echo "Belum ada penilai";
                            }
                          ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <?php if($this->session->userdata('role') == 3){ ?>
                <hr style="margin-bottom: 10px">
                <?php if($key->status < 2){ ?>
                  <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 col-xs-12" style="text-align: center;">
                      <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_pengajuan)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><i class="fa fa-trash"></i> Hapus</a>
                    </div>
                  </div>
                <?php } ?>
                <?php if($key->status > 1){ ?>
                  <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 col-xs-12" style="text-align: center;">
                      <div style="margin-top: 10px;"><br></div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="col-md-12" style="text-align: center;">
        <?php echo $this->pagination->create_links(); ?>
      </div>
    <?php } ?>
    <?php if(!$pengajuan){ ?>
      <div class="col-md-12">
        <p>Tidak ada Data</p>
      </div>
    <?php } ?>
  </div>
</div>
</div>
<div class="modal fade" id="cari" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Cari</b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <form action="<?= site_url('Riwayat'); ?>" method = "get">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Judul Kurikulum</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="judul_kurikulum" class = "form-control" style="width: 100%" value="<?= $judul_kurikulum_isi; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Penilai</label>
                </div>
                <div class="col-md-9">
                  <select name="id_penilai" class="form-control select2" style="width: 100%">
                    <option value="">--  Pilih Penilai --</option>
                    <?php foreach ($penilai as $key) { ?>
                      <option value="<?= $key->id_penilai; ?>" <?php if($id_penilai_isi == $key->id_penilai){ echo "selected"; } ?>><?= $key->nama_penilai; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Status</label>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px">
                      <input type="radio" name="status" value="1" <?php if($status_isi == 1){ echo "checked"; } ?>> Menunggu Verifikasi Judul
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px">
                      <input type="radio" name="status" value="2" <?php if($status_isi == 2){ echo "checked"; } ?>> Proses Pembuatan Timeline
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px">
                      <input type="radio" name="status" value="3" <?php if($status_isi == 3){ echo "checked"; } ?>> Dalam Proses
                    </div>
                    <div class="col-md-6">
                      <input type="radio" name="status" value="4" <?php if($status_isi == 4){ echo "checked"; } ?>> Selesai
                    </div>
                    <div class="col-md-6">
                      <input type="radio" name="status" value="100" <?php if($status_isi == 100){ echo "checked"; } ?>> Ditolak
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Kelengkapan</label>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-4">
                      <input type="radio" name="kelengkapan" value="1" <?php if($kelengkapan_isi == 1){ echo "checked"; } ?>> Judul
                    </div>
                    <div class="col-md-4">
                      <input type="radio" name="kelengkapan" value="2" <?php if($kelengkapan_isi == 2){ echo "checked"; } ?>> Belum Lengkap
                    </div>
                    <div class="col-md-4">
                      <input type="radio" name="kelengkapan" value="3" <?php if($kelengkapan_isi == 3){ echo "checked"; } ?>> Lengkap
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Bulan</label>
                </div>
                <div class="col-md-9">
                  <select name="bulan" class="form-control select2" style="width: 100%">
                    <option value="">-- Pilih Bulan --</option>
                    <?php foreach ($bulan as $key) { ?>
                      <option value="<?= $key->id_bulan; ?>" <?php if($bulan_isi == $key->id_bulan){ echo "selected"; } ?>><?= $key->nama_bulan; ?></option>
                    <?php } ?>
                  </select>
                  <!-- <input type="month" name="bulan" class = "form-control" style="width: 100%" value=""> -->
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Tahun</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="tahun" class = "form-control" style="width: 100%" value="<?= $tahun_isi; ?>" maxlength = "4">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" style = "border-radius: 3px;">Cari</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script type="text/javascript">
    $(document).on('click','.hapus',function(e)

    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('Pengajuan/hapus/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
</script>
<?php
  function indonesian_date ($timestamp = '', $date_format = 'd F Y ', $suffix = '') 
  {
    //$timestamp = '', $date_format = 'l, d F Y | H:i', $suffix = 'WIB'
    if (trim ($timestamp) == ''){ $timestamp = time (); }
    elseif (!ctype_digit ($timestamp)){ $timestamp = strtotime ($timestamp); }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
      '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
      '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
      '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
      '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
      '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
      '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
      '/April/','/June/','/July/','/August/','/September/','/October/',
      '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
      'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
      'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
      'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
      'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
  }
?>