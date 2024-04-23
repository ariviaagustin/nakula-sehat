<style type="text/css">
  #content{ background-color: #fff; }
  th{ text-align: center; }
</style>
<div class="container-fluid">
  <div class="card mb-4" style="border: 0px; padding: 0px;">
    <div class="card-header py-3" style="background-color: #fff; color: #000">
      <div class="row">
        <div class="col-md-6">
          <h5 class="m-0 font-weight-bold" style="font-size: 17px">Institusi</h5>
        </div>
        <?php if($this->session->userdata('is_admin_acp') == 1){ ?> 
          <div class="col-md-6" style="text-align: right;">
            <a href="<?= site_url('tarik-institusi'); ?>" class = "btn btn-info btn-sm"><i class="fas fa-fw fa-link"></i> Tarik Institusi</a>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="card-body" style="padding: 10px">
      <div class="alert alert-info">
        <span><b><i class="fa fa-info-circle"></i> Apabila Instansi tidak tersedia, silahkan cari Instansi dengan menggunakan fitur ini menggunakan email Instansi.</b></span>
      </div>
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
      <div class="row">
        <div class="col-md-12">
          <h5 style="color: #000;">Cari Institusi By Email</h5>
        </div>
      </div>
      <form action="<?= site_url('tarik-institusi-by-email'); ?>" method = "post">
        <div class="row">
          <div class="col-md-10">
            <input type="text" name="email" class="form-control" required>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-info">Cari</button>
          </div>
        </div>
      </form>
      <hr><br>
      <div class="table-responsive">
        <div style="overflow-x:auto;">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Institusi</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Status Akreditasi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($institusi as $key) {  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?>.</td>
                  <td><?= $key->nama_institusi; ?></td>
                  <td><?= $key->email; ?></td>
                  <td>
                    <?php 
                      if($key->lokasi_prov)
                      {
                        $get_prov = $this->M_entitas->selectX('entitas__provinsi', array('provinsi_id' => $key->lokasi_prov))->row();
                        $nama_prov = $get_prov->master_province_name;
                      }
                      else{ $nama_prov = "-"; }

                      if($key->lokasi_kab)
                      {
                        $get_kab = $this->M_entitas->selectX('entitas__kabupaten', array('kabupaten_id' => $key->lokasi_kab))->row();
                        $nama_kab = $get_kab->kabupaten_name;
                      }
                      else{ $nama_kab = "-"; }

                      if($key->lokasi_kec)
                      {
                        $get_kec = $this->M_entitas->selectX('entitas__kecamatan', array('kecamatan_id' => $key->lokasi_kec))->row();
                        $nama_kec = $get_kec->kecamatan_name;
                      }
                      else{ $nama_kec = "-"; }

                      if($key->lokasi_kel)
                      {
                        $get_kel = $this->M_entitas->selectX('entitas__kelurahan', array('kelurahan_id' => $key->lokasi_kel))->row();
                        $nama_kel = $get_kel->kelurahan_name;
                      }
                      else{ $nama_kel = "-"; }
                    ?>
                    <table width="100%">
                      <tr>
                        <td style="width: 5%; border: 0px;">Provinsi</td>
                        <td style="width: 1%; border: 0px;">:</td>
                        <td style="border: 0px;"><?php if($nama_prov){ echo $nama_prov; } else { echo "-"; } ?></td>
                      </tr>
                      <tr>
                        <td style="border: 0px;">Kabupaten</td>
                        <td style="border: 0px;">:</td>
                        <td style="border: 0px;"><?php if($nama_kab){ echo $nama_kab; } else { echo "-"; } ?></td>
                      </tr>
                      <tr>
                        <td style="border: 0px;">Kecamatan</td>
                        <td style="border: 0px;">:</td>
                        <td style="border: 0px;"><?php if($nama_kec){ echo $nama_kec; } else { echo "-"; } ?></td>
                      </tr>
                      <tr>
                        <td style="border: 0px;">Kelurahan</td>
                        <td style="border: 0px;">:</td>
                        <td style="border: 0px;"><?php if($nama_kel){ echo $nama_kel; } else { echo "-"; } ?></td>
                      </tr>
                      <tr>
                        <td style="border: 0px;">Alamat</td>
                        <td style="border: 0px;">:</td>
                        <td style="border: 0px;"><?php if($key->alamat){ echo $key->alamat; } else { echo "-"; } ?></td>
                      </tr>
                    </table>
                  </td>
                  <td><?= $key->keterangan_akreditasi; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div></div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          url: '<?= site_url('Lembaga/hapus/'); ?>/'+id,
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