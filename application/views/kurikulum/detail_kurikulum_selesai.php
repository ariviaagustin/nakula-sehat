<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; text-align:center; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Detail Kurikulum</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block">
        <div class="row">
          <div class="col-md-6" style="border-right: 1px solid #c6c6c6;">
            <h5><b>Informasi Kurikulum</b></h5>
            <table width="100%">
              <tr>
                <td style="width: 35%;">Judul Kurikulum</td>
                <td style="width: 1%;">:</td>
                <td><?= $kurikulum->judul; ?></td>
              </tr>
              <tr>
                <td>Institusi</td>
                <td>:</td>
                <td><?= $kurikulum->nama_institusi; ?></td>
              </tr>
              <tr>
                <td>pj substansi</td>
                <td>:</td>
                <td><?= $kurikulum->nama_sdm; ?></td>
              </tr>
              <tr>
                <td>JPL</td>
                <td>:</td>
                <td><?= $kurikulum->jumlah_jpl; ?></td>
              </tr>
              <tr>
                <td>KAK/TOR</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/kak_tor/'.$kurikulum->kak_tor); ?>" class = "btn btn-info btn-sm" target = "_blank">KAK TOR</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Surat Pengantar</td>
                <td>:</td>
                <td>
                  <?php if($kurikulum->kak_tor){ ?>
                    <a href="<?= base_url('agenda/perdata/surat_pengantar/'.$kurikulum->surat_pengantar); ?>" class = "btn btn-info btn-sm" target = "_blank">Surat Pengantar</a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>Preview Kurikulum</td>
                <td>:</td>
                <td><a href="<?= site_url('preview-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class="btn btn-info btn-sm" target = "_blank" style="background-color: #32d05a; border-color: #32d05a; color: #fff;"><i class="fa fa-eye"></i> Preview Kurikulum</a></td>
              </tr>
              <?php if($kurikulum->status >= 8){ ?>
                <tr>
                  <td>Penilai</td>
                  <td>:</td>
                  <td><?= $kurikulum->nama_penilai; ?></td>
                </tr>
              <?php } ?>
              <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_pengajuan))); ?></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Administrator</td>
                <td>:</td>
                <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->verif_at))); ?></td>
              </tr>
              <tr>
                <td>Deadline Penyusunan Kurikulum</td>
                <td>:</td>
                <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->deadline))); ?></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Penilai</td>
                <td>:</td>
                <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->tgl_verifikasi_penilai))); ?></td>
              </tr>
              <?php if($kurikulum->status > 10){ ?>
                <tr>
                  <td style="width: 20%;">Tanggal Pengesahan</td>
                  <td style="width: 2%;">:</td>
                  <td><?= tanggal_indo($kurikulum->tgl_pengesahan); ?></td>
                </tr>
                <tr>
                  <td style="width: 20%;">Kategori Pelatihan</td>
                  <td style="width: 2%;">:</td>
                  <td><?= $kurikulum->kategori_pelatihan_name; ?></td>
                </tr>
                <tr>
                  <td>Jenis Pelatihan</td>
                  <td>:</td>
                  <td><?= $kurikulum->jenis_pelatihan_name; ?></td>
                </tr>
                <tr>
                  <td>Nilai SKP</td>
                  <td>:</td>
                  <td><?= $kurikulum->nilai_skp; ?></td>
                </tr>
                <tr>
                  <td>Surat Pengesahan</td>
                  <td>:</td>
                  <td>
                    <a href="<?= site_url('surat-pengesahan-kurikulum/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" target = "_blank" class = "btn btn-info btn-sm"><i class="fa fa-file"></i> Surat Pengesahan</a>
                  </td>
                </tr>
                <tr>
                  <td>Surat Keterangan Menilai</td>
                  <td>:</td>
                  <td>
                    <?php if($kurikulum->surat_keterangan_menilai){ ?>
                      <a href="<?= base_url('agenda/perdata/surat_keterangan_menilai/'.$kurikulum->surat_keterangan_menilai); ?>" target = "_blank" class = "btn btn-info btn-sm"><i class="fa fa-file"></i> Surat Keterangan Menilai</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              <?php if($kurikulum->status >= 12){ ?>
                <tr>
                  <td style="width: 20%;">Tanggal Kirim SIAKPEL</td>
                  <td style="width: 2%;">:</td>
                  <td><?= tanggal_indo(date('Y-m-d', strtotime($kurikulum->kirim_siakpel_at)))." ".date('H:i', strtotime($kurikulum->kirim_siakpel_at)); ?></td>
                </tr>
              <?php } ?>
            </table>
          </div>
          <div class="col-md-6">
            <h5><b>Penyusunan Kurikulum</b></h5>
            <table>
              <?php if($kurikulum->status >= 10){ ?>
                <tr>
                  <td><a href="<?= base_url('agenda/perdata/cover/'.$kurikulum->cover); ?>" target = "_blank">Cover</a></td>
                </tr>
                <tr>
                  <td>
                    <a href="#" class="detail-kata-pengantar" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>">Kata Pengantar</a>
                  </td>
                </tr>
              <?php } ?>
              <?php $no = 1; foreach ($bab as $key) { ?>
                <tr>
                  <td><?= $no++; ?>.
                    <?php if($key->is_isi == 1){ ?>
                      <a href="#" class="detail-bab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-bab = "<?= bin2hex(base64_encode($key->id_bab)); ?>"><?= $key->bab." ".$key->judul; ?></a>
                    <?php } ?>
                    <?php if($key->is_isi != 1){ echo $key->bab." ".$key->judul; } ?>
                  </td>
                </tr>
                <?php $sub_bab = $this->M_entitas->selectX('sub_bab', array('id_bab' => $key->id_bab, 'status' => 1))->result(); if($sub_bab){ $no_sb = "a"; foreach ($sub_bab as $sb) { ?>
                  <tr>
                    <td>
                      &nbsp;&nbsp;&nbsp;
                      <?= $no_sb++; ?>. <a href="#" class="detail-subbab-kurikulum" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>" data-subbab = "<?= bin2hex(base64_encode($sb->id_sub_bab)); ?>"><?= $sb->sub_bab; ?></a>
                    </td>
                  </tr>
                <?php } } ?>
              <?php } ?>
              <?php if($kurikulum->status >= 10){ ?>
                <tr>
                  <td>
                    <a href="#" class="detail-tim-penyusun" data-id="<?= bin2hex(base64_encode($kurikulum->id_kurikulum)); ?>">Tim Penyusun</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <hr>
        <h5><b>Draft Penyusunan Kurikulum</b></h5><br>
        <table width="100%" border="1">
          <tr>
            <th style="width: 2%;">No</th>
            <th style="width: 10%;">Draft Ke</th>
            <th>Pengirim</th>
            <th>Waktu Kirim</th>
            <th>Status</th>
          </tr>
          <?php $no = 1; foreach ($draft as $key) { ?>
            <tr>
              <td style="text-align: center;"><?= $no++; ?></td>
              <td style="text-align: center;"><?= $key->draft_ke; ?></td>
              <td>
                <?php 
                  $cek_user = $this->M_entitas->selectX('user', array('id_user' => $key->created_by))->row();
                  echo $cek_user->nama_lengkap;
                ?>
              </td>
              <td style="text-align: center;"><?= tanggal_indo(date('Y-m-d', strtotime($key->created_at)))." ".date('H:i', strtotime($key->created_at)); ?></td>
              <td style="text-align: center;"><?php if($key->status == 2){ echo "Telah Diperbaiki"; } else { "Butuh Perbaikan"; } ?></td>
            </tr>
          <?php } ?>
        </table>
        <hr>
        <h5><b>Penilaian Kurikulum</b></h5><br>
        <table width="100%" border="1">
          <tr>
            <th style="width: 2%;">No</th>
            <th style="width: 10%;">Bab / Sub Bab</th>
            <th>Kategori</th>
            <th style="width: 35%;">Penilaian</th>
            <th>Keterangan Penilian</th>
            <th>Waktu Penilaian</th>
            <th>Status</th>
          </tr>
          <?php $no = 1; foreach ($catatan as $key) { ?>
            <tr>
              <td style="text-align: center;"><?= $no++; ?></td>
              <td>
                <?php $get_list = $this->M_entitas->selectX('list_pengerjaan_kurikulum', array('id_list_pengerjaan_kurikulum' => $key->id_list_pengerjaan_kurikulum))->row(); ?>
                <?php 
                  if($get_list->is_bab_subbab == 1)
                  {
                    $get_bab = $this->M_entitas->selectX('bab', array('id_bab' => $get_list->id_bab_subbab))->row();
                    echo $get_bab->bab." ".$get_bab->judul;
                  }
                  else if($get_list->is_bab_subbab == 2)
                  {
                    $get_sub_bab = $this->M_entitas->selectX('sub_bab', array('id_sub_bab' => $get_list->id_bab_subbab))->row();
                    echo $get_sub_bab->sub_bab;
                  }
                ?>
              </td>
              <td><?php if($key->is_pengecekan_penilaian == 1){ echo "Pengecekan"; } else { echo "Penilaian"; } ?></td>
              <td><?= $key->catatan; ?></td>
              <td><?= $key->keterangan; ?></td>
              <td style="text-align: center;"><?= tanggal_indo(date('Y-m-d', strtotime($key->created_at)))." ".date('H:i', strtotime($key->created_at)); ?></td>
              <td style="text-align: center;"><?php if($key->status == 2){ echo "Telah Diperbaiki"; } else { "Butuh Perbaikan"; } ?></td>
            </tr>
          <?php } ?>
        </table>
        <hr>
        <h5><b>Riwayat Dihentikan</b></h5><br>
        <?php if($riwayat_hentikan){ ?>
          <table width="100%" border="1">
            <tr>
              <th style="width: 2%;">No</th>
              <th>Alasan</th>
              <th>Dihentikan</th>
              <th>Permohonan Pengajuan</th>
              <th>Diaktifkan Kembali</th>
              <th>Status</th>
            </tr>
            <?php $no = 1; foreach ($riwayat_hentikan as $key) { ?>
              <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td><?= $key->keterangan_alasan; ?></td>
                <td>
                  Tanggal : <?= tanggal_indo(date('Y-m-d', strtotime($key->hentikan_at)))." ".date('H:i:s', strtotime($key->hentikan_at)); ?>
                  <br>
                  Oleh : <?php if($key->hentikan_by == 0){ echo "Sistem"; } else { $get_role = $this->M_entitas->selectX('user', array('id_user' => $key->hentikan_by))->row(); echo $get_role->role; } ?>
                </td>
                <td>
                  <?php
                    if($key->ajukan_at)
                    {

                      $get_role = $this->M_entitas->selectX('user', array('id_user' => $key->ajukan_by))->row();
                      echo "Tanggal : ".tanggal_indo(date('Y-m-d', strtotime($key->ajukan_at)))." ".date('H:i:s', strtotime($key->ajukan_at));
                      echo "<br>";
                      echo "Oleh : ".$get_role->role;
                    }
                    else
                    {
                      echo "-";
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if($key->aktifkan_at)
                    {
                      $get_role = $this->M_entitas->selectX('user', array('id_user' => $key->aktifkan_by))->row(); 
                      echo "Tanggal : ".tanggal_indo(date('Y-m-d', strtotime($key->aktifkan_at)))." ".date('H:i:s', strtotime($key->aktifkan_at));
                      echo "<br>";
                      echo "Oleh : ".$get_role->role;
                    }
                    else
                    {
                      echo "-";
                    }
                  ?>
                </td>
                <td style="text-align: center;">
                  <?php 
                    if($key->status == 1){ echo "Dihentikan"; }
                    else if($key->status == 2){ echo "Permohonan Pengajuan"; }
                    else if($key->status == 3){ echo "Permohonan Pengajuan Diterima"; }
                    else if($key->status == 0){ echo "Permohonan Pengajuan Ditolak"; }
                  ?>
                </td>
              </tr>
            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$riwayat_hentikan){ echo "Tidak ada riwayat"; } ?>
        <hr>
        <h5><b>Riwayat Ubah Penilai</b></h5><br>
        <?php if($riwayat_ubah_penilai){ ?>
          <table width="100%" border="1">
            <tr>
              <th style="width: 2%;">No</th>
              <th>Nama Penilai</th>
              <th>Tanggal Ubah Penilai</th>
            </tr>
            <?php $no = 1; foreach ($riwayat_ubah_penilai as $key) { ?>
              <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td><?= $key->nama_penilai; ?></td>
                <td><?= tanggal_indo(date('Y-m-d', strtotime($key->ubah_penilai_at)))." ".date('H:i:s', strtotime($key->ubah_penilai_at)); ?></td>
              </tr>
            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$riwayat_ubah_penilai){ echo "Tidak ada riwayat"; } ?>
      </div>
    </div> 
  </div> 
</div> 
</div>
<div class="modal fade" id="detail-bab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_bab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-subbab-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_subbab_kurikulum"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-kata-pengantar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_kata_pengantar"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detail-tim-penyusun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="color: #000;">Detail</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body body_detail_tim_penyusun"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-bab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-bab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_bab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_bab: $(this).attr('data-bab'),},
        function (html) { $(".body_detail_bab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-subbab-kurikulum', function (e) {
      e.preventDefault();
      $("#detail-subbab-kurikulum").modal('show');
      $.post('<?= site_url('Kurikulum/detail_subbab_kurikulum');?>',
        {id: $(this).attr('data-id'), id_subbab: $(this).attr('data-subbab'),},
        function (html) { $(".body_detail_subbab_kurikulum").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-kata-pengantar', function (e) {
      e.preventDefault();
      $("#detail-kata-pengantar").modal('show');
      $.post('<?= site_url('Kurikulum/detail_kata_pengantar');?>',
        {id: $(this).attr('data-id'),},
        function (html) { $(".body_detail_kata_pengantar").html(html); }
      );
    });
  });
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.detail-tim-penyusun', function (e) {
      e.preventDefault();
      $("#detail-tim-penyusun").modal('show');
      $.post('<?= site_url('Kurikulum/detail_tim_penyusun');?>',
        {id: $(this).attr('data-id'),},
        function (html) { $(".body_detail_tim_penyusun").html(html); }
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