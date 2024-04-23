<style type="text/css">
  th{ text-align: center; }
  #content{ background-color: #fff; }
  .satu /*tunggu verif - oren*/
  {
    border-radius: 5px;
    background-color: #d98e00;
    color: #fff;
    padding: 5px;
    font-size: 10px;
  }
  .dua /*verif penilai - coklat */
  {
    border-radius: 5px;
    background-color: brown;
    color: #fff;
    padding: 5px;
    font-size: 10px;
  }
  .tiga /*dalam proses - abu */
  {
    border-radius: 5px;
    background-color: grey;
    color: #fff;
    padding: 5px;
    font-size: 10px;
  }
  .empat /*selesai - hijau */
  {
    border-radius: 5px;
    background-color: green;
    color: #fff;
    padding: 5px;
    font-size: 10px;
  }
  .lima /*ditolak - merah */
  {
    border-radius: 5px;
    background-color: red;
    color: #fff;
    padding: 5px;
    font-size: 10px;
  }
  .notif_update
  {
    background-color: #ff0000;
    color: #fff;
    border-radius: 100px;
    padding: 3px 8px;
  }
  .ket_notif /*selesai - hijau */
  {
    border-radius: 5px;
    background-color: #5cd120;
    color: #fff;
    padding: 5px;
    font-size: 10px;
    margin-top: 10px;
    margin-bottom: 0px;
  }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px">
    <div class="card-header py-3" style="background-color: #fff; border: 0px">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="color: #000; font-size: 17px">Pengajuan</h5>
        </div>
        <div class="col-md-6" style="text-align: right;">
          <a href="#" data-toggle = "modal" data-target = "#cari" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-filter"></i> Filter</a>
          <?php
            if($this->session->userdata('role') == 1){ $pend = $this->input->get('id_penilai');}
            else { $pend = $this->session->userdata('id_penilai'); }
          ?>
          <a href="<?= site_url('export-pdf-pengajuan?pengaju='.$this->input->get("pengaju").'&judul_kurikulum='.$this->input->get("judul_kurikulum").'&status='.$this->input->get("status").'&kelengkapan='.$this->input->get("kelengkapan").'&tanggal_awal='.$this->input->get("tanggal_awal").'&tanggal_akhir='.$this->input->get("tanggal_akhir").'&id_penilai='.$pend); ?>" class = "btn btn-danger btn-sm" target = "_blank"><i class="fas fa-fw fa-file-pdf"></i> PDF</a>
          <a href="<?= site_url('export-excel-pengajuan?pengaju='.$this->input->get("pengaju").'&judul_kurikulum='.$this->input->get("judul_kurikulum").'&status='.$this->input->get("status").'&kelengkapan='.$this->input->get("kelengkapan").'&tanggal_awal='.$this->input->get("tanggal_awal").'&tanggal_akhir='.$this->input->get("tanggal_akhir").'&id_penilai='.$pend); ?>" class = "btn btn-success btn-sm"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
        </div>
      </div>
    </div>
    <hr>
    <div class="card-body" style="padding: 0px">
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <?php if($this->session->userdata('role') == 1){ ?>
                  <th>Aktif</th>
                <?php } ?>
                <?php if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 4){ ?>
                  <th>Update</th>
                <?php } ?>
                <th>Tahun</th>
                <th>Judul Pengajuan</th>
                <th>Kelengkapan</th>
                <th>Pengaju</th>
                <?php if($this->session->userdata('role') == 1){ ?>
                  <th>Penilai</th>
                <?php } ?>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pengajuan as $key) {  ?>
                <tr <?php if($this->session->userdata('role') == 1){ if($key->status == 1){ echo "style='background-color: #ffdbd7; color: #000;'"; } } else if($this->session->userdata('role') == 2){ if($key->status == 2){ echo "style='background-color: #ffdbd7; color: #000;'"; } } ?>>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <?php if($this->session->userdata('role') == 1){ ?>
                    <td style="text-align: center;">
                      <?php if($key->is_aktif == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?>
                    </td>
                  <?php } ?>
                  <?php if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 4){ ?>
                    <td style="text-align: center;">
                      <?php 
                        $jum = $this->M_new->get_update($key->id_pengajuan)->result();
                        if(count($jum) > 0){ 
                      ?>
                        <span class = "notif_update"><?= count($jum); ?></span>
                        <?php foreach ($jum as $j) { ?>
                          <?php if($j->id_bagian == 0){ ?>
                            <p class = 'ket_notif'>Judul</p>
                          <?php } ?>
                          <?php if($j->id_bagian > 0){ ?>
                            <?php foreach ($bagian as $bag) { ?>
                              <?php if($bag->id_bagian == $j->id_bagian){ ?>
                                <p class = 'ket_notif'><?= $bag->nama_alias; ?></p>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    </td>
                  <?php } ?>
                  <td style="text-align: center;"><?= $key->tahun; ?></td>
                  <td><?= $key->judul_kurikulum; ?></td>
                  <td>
                    <?php
                      if($key->kelengkapan == 1){ echo "Judul"; }
                      else if($key->kelengkapan < 15){ echo "Belum Lengkap"; }
                      else{ echo "Lengkap"; }
                    ?>
                  </td>
                  <td>
                    <?php 
                      foreach ($pengaju as $data) 
                      {
                        if($data->id_pengaju == $key->pengaju)
                        {
                          echo $data->nama_pengaju;
                        }
                      }
                    ?>
                  </td>
                  <?php if($this->session->userdata('role') == 1){ ?>
                    <td>
                      <?php  
                        if($key->status > 1)
                        {
                          foreach ($penilai as $data) 
                          {
                            if($data->id_penilai == $key->id_penilai)
                            {
                              echo $data->nama_penilai;
                            }
                          }
                        }
                        else{ echo ""; }
                      ?>
                    </td>
                  <?php } ?>
                  <td style="width: 15%; text-align: center;">
                    <?php 
                      if($key->status == 1){ echo "<span class = 'satu'>Menunggu Verifikasi</span>"; }
                      else if($key->status == 2){ echo "<span class = 'dua'>Proses Timeline</span>"; }
                      else if($key->status == 3){ echo "<span class = 'tiga'>Dalam Proses</span>"; }
                      else if($key->status == 4){ echo "<span class = 'empat'>Selesai</span>"; }
                      else if($key->status == 100){ echo "<span class = 'lima'>Pengajuan Ditolak</span>"; }

                      if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 4){ if($key->status > 4){ echo "<span class = 'empat'>Selesai</span>"; } }
                    ?>
                  </td>
                  <td style="text-align: center;">
                    <?php if($this->session->userdata('role') == 1){ ?>
                      <?php if($key->status == 1){ ?>
                        <a href="<?= site_url('verifikasi-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-warning btn-sm" title = "Verifikasi"><i class="fa fa-spinner"></i> Verifikasi</a>
                      <?php } ?>
                      <?php if($key->status > 1){ ?>
                        <?php if($key->is_aktif == 1){ ?>
                          <a href="<?= site_url('detail-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm" title = "Detail"><i class="fa fa-search"></i> Lihat Pengajuan</a>
                        <?php } ?>
                        <?php if($key->is_aktif == 0){ ?>
                          <a href="<?= site_url('detail-pengajuan-non-aktif/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm" title = "Detail"><i class="fa fa-search"></i> Lihat Pengajuan</a>
                        <?php } ?>
                        <?php if($key->is_aktif == 1){ ?>
                          <br>
                          <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_pengajuan)); ?>" class = "non_aktif btn btn-danger btn-sm" title = "Non Aktifkan" style = "margin-top: 10px;"><i class="fa fa-circle"></i> Non Aktifkan</a>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                    <?php if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 4){ ?>
                      <?php if($key->status == 2){ ?>
                        <a href="#" class = "btn btn-info btn-sm info-pengajuan" title = "Info" data-id="<?= $key->id_pengajuan ?>" style = "margin-bottom: 5px;"><i class="fa fa-info-circle"></i> Lihat Pengajuan</a>
                        <br>
                        <a href="<?= site_url('timeline/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-warning btn-sm" title = "isi Timeline" style = "margin-bottom: 5px;"><i class="fa fa-clock"></i> Isi Timeline</a>
                        <br>
                        <!-- <a href="<?= site_url('setujui-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-success btn-sm" title = "Setujui" style = "margin-bottom: 5px;"><i class="fa fa-check-circle"></i></a>
                        <br>
                        <a href="<?= site_url('tolak-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan))); ?>" class = "btn btn-danger btn-sm" title = "Tolak" style = "margin-bottom: 5px;"><i class="fa fa-times-circle"></i></a> -->
                      <?php } ?>
                      <?php if($key->status > 2){ ?>
                        <?php if($this->session->userdata('role') == 1){ $is_pmbg = 0; } else { $is_pmbg = $this->session->userdata('is_penilai'); } ?>
                        <?php if($key->is_aktif == 1){ ?>
                          <a href="<?= site_url('detail-pengajuan/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode($is_pmbg))); ?>" class = "btn btn-info btn-sm" title = "Detail"><i class="fa fa-search"></i> Lihat Pengajuan</a>
                        <?php } ?>
                        <?php if($key->is_aktif == 0){ ?>
                          <a href="<?= site_url('detail-pengajuan-non-aktif/'.bin2hex(base64_encode($key->id_pengajuan)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm" title = "Detail"><i class="fa fa-search"></i> Lihat Pengajuan</a>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                    <?php if($this->session->userdata('admin_acp') == 1){ ?>
                      <br>
                      <a href="#" data-id = "<?= bin2hex(base64_encode($key->id_pengajuan)); ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus" style = "margin-top: 5px;"><i class="fa fa-trash"></i> Hapus</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Info Pengajuan</b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="cari" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Filter</b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <form action="<?= site_url('Pengajuan'); ?>" method = "get">
        <div class="modal-body" style="color: #000">
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
            <?php if($this->session->userdata('role') == 1){ ?>
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
            <?php } ?>
            <div class="col-md-12">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Pengaju</label>
                </div>
                <div class="col-md-9">
                  <select name="pengaju" class="form-control select2" style="width: 100%">
                    <option value="">--  Pilih Pengaju --</option>
                    <?php foreach ($pengaju as $key) { ?>
                      <option value="<?= $key->id_pengaju; ?>" <?php if($pengaju_isi == $key->id_pengaju){ echo "selected"; } ?>><?= $key->nama_pengaju; ?></option>
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
                    <?php if($this->session->userdata('role') == 1){ ?>
                      <div class="col-md-6" style="margin-bottom: 10px">
                        <input type="radio" name="status" value="1" <?php if($status_isi == 1){ echo "checked"; } ?>> Menunggu Verifikasi Judul
                      </div>
                    <?php } ?>
                    <div class="col-md-6" style="margin-bottom: 10px">
                      <input type="radio" name="status" value="2" <?php if($status_isi == 2){ echo "checked"; } ?>> Menunggu Verifikasi Penilai
                    </div>
                    <div class="<?php if($this->session->userdata('role') == 1){ echo 'col-md-6'; } else { echo 'col-md-3'; } ?>" style="margin-bottom: 10px">
                      <input type="radio" name="status" value="3" <?php if($status_isi == 3){ echo "checked"; } ?>> Dalam Proses
                    </div>
                    <div class="<?php if($this->session->userdata('role') == 1){ echo 'col-md-6'; } else { echo 'col-md-3'; } ?>">
                      <input type="radio" name="status" value="4" <?php if($status_isi == 4){ echo "checked"; } ?>> Selesai
                    </div>
                    <?php if($this->session->userdata('role') == 1){ ?>
                      <div class="col-md-6">
                        <input type="radio" name="status" value="100" <?php if($status_isi == 100){ echo "checked"; } ?>> Ditolak
                      </div>
                    <?php } ?>
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
                  <label for="text-input" class=" form-control-label">Periode Pengajuan</label>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-5">
                      <input type="date" name="tanggal_awal" class = "form-control" style="width: 100%" value="<?= $tanggal_awal_isi; ?>">
                    </div>
                    <div class="col-md-1" style="text-align: center;"> - </div>
                    <div class="col-md-5">
                      <input type="date" name="tanggal_akhir" class = "form-control" style="width: 100%" value="<?= $tanggal_akhir_isi; ?>">
                    </div>
                  </div>
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
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.non_aktif',function(e)
    {
      swal({
        title: "Non Aktifkan Pengajuan ?",
        text: "",
        icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Pengajuan Tidak Aktif", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?= site_url('Pengajuan/non_aktif/'); ?>/'+id,
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
      if (willDelete) 
      {
        var id = $(this).attr('data-id');
        swal("Data Terhapus", 
        {
          icon: "success",
          buttons: false
        });
        $.ajax({
          url: '<?= site_url('Pengajuan/hapus_dari_admin/'); ?>/'+id,
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
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.info-pengajuan', function (e) {
      e.preventDefault();
      $("#myModal").modal('show');
      $.post('<?php echo site_url('Pengajuan/info_pengajuan');?>',
        {id: $(this).attr('data-id')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<?php
  function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array ( 1 =>    'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu',
      'Minggu'
    );

    $bulan = array (1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }
?>