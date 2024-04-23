<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">SDM Institusi</h5>
        </div>
        <!-- <?php if($this->session->userdata('is_admin_acp') == 1){ ?> 
          <div class="col-md-6" style="text-align: right;">
            <a href="<?= site_url('tarik-sdm-institusi'); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-link"></i> Tarik SDM Institusi</a>
          </div>
        <?php } ?> -->
        <?php if($this->session->userdata('id_role') == 2){ ?> 
          <div class="col-md-6" style="text-align: right;">
            <a href="<?= site_url('tarik-sdm-by-institusi-institusi/'.bin2hex(base64_encode($this->session->userdata('id_institusi_siaksi')))); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-link"></i> Tarik SDM Institusi</a>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="card-body" style="padding: 10px">
      <?php if($this->session->userdata('id_role') == 1){ ?>
        <div class="alert alert-info">
          <span><b><i class="fa fa-info-circle"></i> Apabila SDM Instansi tidak tersedia, silahkan cari SDM Instansi dengan menggunakan fitur ini menggunakan Nama Instansi.</b></span>
        </div>
      <?php } ?>
      <?php if($this->session->flashdata('msg-berhasil')){ ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
          <span><b><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('msg-berhasil'); ?>.</b></span>
        </div>
      <?php } ?>
      <?php if($this->session->flashdata('msg-gagal')){ ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
          <span><b><i class="fa fa-times-circle"></i> <?= $this->session->flashdata('msg-gagal'); ?>.</b></span>
        </div>
      <?php } ?>
      <?php if($this->session->userdata('id_role') == 1){ ?>
        <div class="row">
          <div class="col-md-12">
            <h5 style="color: #000;">Cari SDM Institusi</h5>
          </div>
        </div>
        <form action="<?= site_url('tarik-sdm-by-institusi'); ?>" method = "post">
          <div class="row">
            <div class="col-md-10">
              <select class="form-control select2" required name="id_institusi_siaksi">
                <option value="">-- Pilih Institusi --</option>
                <?php foreach ($institusi as $key) { ?>
                  <option value="<?= $key->id_institusi_siaksi; ?>"><?= $key->nama_institusi; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-info">Cari</button>
            </div>
          </div>
        </form>
        <hr><br>
      <?php } ?>
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama SDM</th>
                <th>Nama Institusi</th>
                <!-- <th>Status</th> -->
                <th style="width: 20%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($sdm as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><?= $key->nik; ?></td>
                  <td><?= $key->nama_sdm; ?></td>
                  <td><?= $key->nama_institusi; ?></td>
                  <!-- <td><?= $key->keterangan_status; ?></td> -->
                  <td style="text-align: center;">
                    <?php if($key->id_user){ $cek = $this->M_entitas->selectX('user', array('id_user' => $key->id_user))->row(); if($cek){ ?>
                      <a href="#" class="btn btn-info btn-sm detail-akun" style="background-color: blue; border-color: blue;" data-id="<?= $key->id_user; ?>"><i class="fa fa-eye"></i> Lihat Akun</a>
                      <a href="<?= site_url('ubah-pengguna/'.bin2hex(base64_encode($key->id_user))); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><i class="fa fa-pen"></i> Ubah</a>
                    <?php } } ?>
                    <?php if(!$key->id_user){ ?>
                      <a href="<?= site_url('buat-akun-sdm/'.bin2hex(base64_encode($key->id_sdm_institusi))); ?>" class = "btn btn-info btn-sm" title = "Ubah"><i class="fa fa-user"></i> Buat Akun</a>
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
<div class="modal fade" id="detail-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-s">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail Akun</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_akun"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.detail-akun', function (e) {
            e.preventDefault();
            $("#detail-akun").modal('show');
            $.post('<?= site_url('Pengguna/get_detail_akun');?>',
                {id: $(this).attr('data-id')},
                function (html) { $(".body_detail_akun").html(html); }
            );
        });
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