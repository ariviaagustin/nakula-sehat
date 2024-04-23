<style type="text/css">
    #content{ background-color: #fff; }
    .space{ margin-bottom: 20px; }
    a.disabled {
        pointer-events: none;
        cursor: default;
        opacity: .65;
    }
</style>
<div class="container-fluid">
  <!-- DataTales Example -->
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px; padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="font-size: 17px; color: #000">Pengaju : <?= $nama_pengaju; ?></h5>
                </div>
            </div>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding-top: 0px">
            <div class="card-body card-block" style="padding-top: 0px">
                <div class="alert alert-danger">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i> Tidak Aktif</span>
                </div>
                <!-- Judul -->
                <div style="padding: 5px; margin-bottom: 20px">
                    <div class="row">
                        <div class = "col-md-4">
                            <?php if($pengajuan->gambar_cover){ ?>
                                <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style = "width: 100%;">
                            <?php } ?>
                            <?php if(!$pengajuan->gambar_cover){ echo 'Belum ada gambar'; } ?>
                        </div>
                        <div class="col-md-8">
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Tahun :</b></h6>
                                <span style="margin-left: 15px"><?= $pengajuan->tahun; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Judul :</b></h6>
                                <span style="margin-left: 15px"><?= $pengajuan->judul_kurikulum; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Lembaga / Badan :</b></h6>
                                <span style="margin-left: 15px"><?= $pengajuan->lembaga; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>PJ Substansi :</b></h6>
                                <span style="margin-left: 15px"><?= $pj->nama_pj_subtansi; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Tim Penyusun :</b></h6>
                                <span style="margin-left: 15px"><?= $pengajuan->tim_penyusun; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Jenis Pembelajaran :</b></h6>
                                <span style="margin-left: 15px">
                                    <?php 
                                        $get_jenis_p = $this->M_entitas->selectX('jenis_pembelajaran_pengajuan', array('id_pengajuan' => $pengajuan->id_pengajuan))->result();
                                        $jp = $this->M_entitas->selectSemua('jenis_pembelajaran')->result();
                                        if($get_jenis_p)
                                        {
                                            $no = 1;
                                            foreach ($get_jenis_p as $key) 
                                            {
                                                foreach ($jp as $d) 
                                                {
                                                    if($d->id_jenis_pembelajaran == $key->id_jenis_pembelajaran)
                                                    {
                                                        echo $d->jenis_pembelajaran.", ";
                                                    }
                                                }
                                            }
                                        }
                                        else { echo " - "; }
                                    ?>  
                                </span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>File Pengajuan :</b></h6>
                                <?php if($pengajuan->file_pengajuan){ ?>
                                    <a href="<?= base_url('agenda/perdata/pengajuan/permohonan/'.$pengajuan->file_pengajuan); ?>" class = "btn btn-info btn-sm" style="margin-left: 15px"><i class="fa fa-file"></i> Lihat File Pengajuan</a>
                                <?php } ?>
                                <?php if(!$pengajuan->file_pengajuan){ echo "<span style='margin-left: 15px'>Belum ada file</span>"; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Judul -->

                <!-- Kata Pengantar -->
                <?php $kp = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); if($kp){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 style="font-size: 18px"><b>Kata Pengantar</b></h6>
                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $kp->isi_bagian_kurikulum; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$kp){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 style="font-size: 18px"><b>Kata Pengantar</b></h6>
                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="margin-left: 15px;">Tidak ada Data</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- End Kata Pengantar -->

                <!-- Bab 1 -->
                <?php $bab_1 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); if($bab_1){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab I - Pendahuluan</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <?php $bab1a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "1.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span style="margin-left: 15px">
                                                    <?php $bab1a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab1a){ echo $bab1a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$bab_1){ $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 4, 'id_bagian > '=> 1))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab I - Pendahuluan</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "1.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="margin-left: 15px;">Tidak ada Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- End Bab 1 -->

                <!-- Bab 2 -->
                <?php $bab_2 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); if($bab_2){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab II</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <?php $bab2a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "2.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span style="margin-left: 15px">
                                                    <?php $bab2a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab2a){ echo $bab2a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$bab_2){ $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 9, 'id_bagian > '=> 3))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab II</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "2.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="margin-left: 15px;">Tidak ada Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- End Bab 2 -->

                <?php $bab_3 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 9))->result(); if($bab_3){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian' => 9))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab III</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <?php $bab3a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "3.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span style="margin-left: 15px">
                                                    <?php $bab3a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab3a){ echo $bab3a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$bab_3){ $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian' => 9))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Bab III</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "3.".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="margin-left: 15px;">Tidak ada Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <?php $lampiran = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian >' => 9))->result(); if($lampiran){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian >' => 9))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Lampiran</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <?php $lampiran_a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "Lampiran ".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span style="margin-left: 15px">
                                                    <?php $lampiran_a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($lampiran_a){ echo $lampiran_a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$lampiran){ $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian >' => 9))->result(); ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>Lampiran</b></h6><hr>
                        <div class="row">
                            <?php $no = 1; foreach ($get_kur as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "Lampiran ".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="margin-left: 15px;">Tidak ada Data</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Catatan</b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="get_catatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b>Catatan</b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="get_isi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b><?= $pengajuan->judul_kurikulum; ?></b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div id="summernote">Hello Summernote 1</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="get_ubah_jadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h7 class="modal-title" id="myModalLabel" style = "color: #000"><b><?= $pengajuan->judul_kurikulum; ?></b></h7>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px"></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.catatan', function (e) {
      e.preventDefault();
      $("#myModal").modal('show');
      $.post('<?php echo site_url('Pengajuan/catatan');?>',
        {id: $(this).attr('data-id'), bagian: $(this).attr('data-bagian')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.lihat_catatan', function (e) {
      e.preventDefault();
      $("#get_catatan").modal('show');
      $.post('<?php echo site_url('Pengajuan/lihat_catatan');?>',
        {id: $(this).attr('data-id'), bagian: $(this).attr('data-bagian'), pmbg: $(this).attr('data-pmbg')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.isi_pengajuan', function (e) {
      e.preventDefault();
      $("#get_isi").modal('show');
      $.post('<?php echo site_url('Pengajuan/isi_pengajuan');?>',
        {id: $(this).attr('data-id'), bagian: $(this).attr('data-bagian'), pengaju: $(this).attr('data-pengaju')},
        function (html) { $(".modal-body").html(html); }
      );
    });
  }); 
</script>
<script type="text/javascript">
  $(function () {
    $(document).on('click', '.ubah_jadwal', function (e) {
      e.preventDefault();
      $("#get_ubah_jadwal").modal('show');
      $.post('<?php echo site_url('Pengajuan/ubah_jadwal');?>',
        {id: $(this).attr('data-id'), bagian: $(this).attr('data-bagian'), pengaju: $(this).attr('data-pengaju')},
        function (html) { $(".modal-body").html(html); }
      );
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
      'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
      'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
  }
?>