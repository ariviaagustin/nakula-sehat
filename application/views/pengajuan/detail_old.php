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
                <div class="col-md-6" style="text-align: right;">
                    <?php if($this->session->userdata('role') == 2 || $this->session->userdata('role') == 4){ ?>
                        <?php if($pengajuan->status < 4){ ?>
                            <?php if($pengajuan->kelengkapan >= 15){ ?>
                                <a href="<?= site_url('selesai-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($is_pmbg))); ?>" class = "btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Pengajuan Selesai</a>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if($pengajuan->status >= 4 && $pengajuan->status < 100){ ?>
                        <a href="<?= site_url('cetak-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>" class = "btn btn-primary btn-sm" target = "_blank"><i class="fa fa-print"></i> Cetak Kurikulum</a>
                    <?php } ?>
                    <?php if($this->session->userdata('role') != 1){ ?>
                        <?php if($pengajuan->status == 4){ ?>
                            <a href="<?= site_url('ajukan-permohonan/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>" class = "btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Ajukan Pengesahan</a>
                        <?php } ?>
                    <?php } ?>
                    <?php if($pengajuan->status > 2 && $pengajuan->status < 100){ ?>
                        <a href="<?= site_url('riwayat-revisi/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-history"></i> Riwayat Perbaikan</a>
                    <?php } ?>
                </div>
            </div>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding-top: 0px">
            <div class="card-body card-block" style="padding-top: 0px">
                <?php if($pengajuan->status == 0){ ?>
                    <div class="alert alert-warning">
                        <span><i class="fa fa-info-circle" aria-hidden="true"></i> Proses Pengajuan</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 1){ ?>
                    <div class="alert alert-warning">
                        <span><i class="fa fa-info-circle" aria-hidden="true"></i> Menunggu Verifikasi Pengajuan</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 2){ ?>
                    <div class="alert alert-warning">
                        <span><i class="fa fa-info-circle" aria-hidden="true"></i> Proses Pembuatan Timline</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 3){ ?>
                    <div class="alert alert-info">
                        <span><i class="fa fa-info-circle" aria-hidden="true"></i> Dalam Proses</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 4){ ?>
                    <div class="alert alert-success">
                        <span><i class="fa fa-check-circle" aria-hidden="true"></i> Selesai</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 5){ ?>
                    <div class="alert alert-info">
                        <span><i class="fa fa-info-circle" aria-hidden="true"></i> Pengajuan Pengesahan Kurikulum</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 6){ ?>
                    <div class="alert alert-success">
                        <span><i class="fa fa-check-circle" aria-hidden="true"></i> Pengajuan Pengesahan Kurikulum Disetujui</span>
                    </div>
                <?php } ?>
                <?php if($pengajuan->status == 100){ ?>
                    <div class="alert alert-danger">
                        <span><i class="fa fa-times-circle" aria-hidden="true"></i> Pengajuan Ditolak</span>
                        <br>
                        <p>Alasan : <?= $pengajuan->alasan_tolak; ?></p>
                    </div>
                <?php } ?>
                <?php if($is_pmbg == 1){ ?>
                    <?php if($new_update){ ?>
                        <p style="font-size: 15px;"><b>Update :</b></p>
                        <?php 
                            $no = 1;
                            foreach ($new_update as $key) 
                            {
                                if($key->id_bagian == 0){ echo $no.". Judul<br>"; }
                                foreach ($kur as $b) 
                                {
                                    if($key->id_bagian == $b->id_bagian)
                                    {
                                        echo $no.". ".$b->nama_alias."<br>";
                                    }
                                }
                            $no++; }
                        ?>
                        <br>
                    <?php } ?>
                <?php } ?>
                <div style="padding: 5px; margin-bottom: 20px">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 style="font-size: 18px"><b>Judul Kurikulum yang Diajukan</b></h6>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                <?php if($pengajuan->status < 4){ ?>
                                    <?php if($pengajuan->is_catatan != 1){ ?>
                                        <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="0"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <?php if($pengajuan->is_catatan == 1){ ?>
                                <a href="#" class="btn btn-success btn-sm lihat_catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-pmbg = "<?= $is_pmbg; ?>" data-bagian="0"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                            <?php } ?>
                            <?php if($this->session->userdata('role') == 4){ ?>
                                <?php if($is_pmbg == 0){ ?>
                                    <?php if($pengajuan->status_judul == 0){ ?>
                                        <?php if($pengajuan->status < 4){ ?>
                                            <a href="<?= site_url('judul-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class="btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
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
                        </div>
                    </div>
                </div>

                <?php $kp = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); if($kp){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 style="font-size: 18px"><b>Kata Pengantar</b></h6>
                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); ?>
                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                        <?php if($pengajuan->status == 3){ ?>
                                            <a href="#" data-id = "<?= $jadwal->id_timeline; ?>" class = "ubah_jadwal" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                <div class="col-md-6" style="text-align: right;">
                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                        <?php if($kp->is_catatan != 1){ ?>
                                            <?php if($pengajuan->status < 4){ ?>
                                                <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                    <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $kp->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($kp->is_catatan == 1){ ?>
                                        <a href="#" class="btn btn-success btn-sm lihat_catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-pmbg = "<?= $is_pmbg; ?>" data-bagian="<?= $kp->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                                    <?php } ?>
                                    <?php if($this->session->userdata('role') == 4){ ?>
                                        <?php if($is_pmbg == 0){ ?>
                                            <?php if($kp->status == 0){ ?>
                                                <?php if($pengajuan->status < 4){ ?>
                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                        <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <?= $kp->isi_bagian_kurikulum; ?>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <?php 
                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, 1)->row();
                                    if($cek_revisi){ 
                                        if($kp->is_revisi && $kp->status_revisi == 0){
                                ?>
                                        <span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>
                                <?php } } ?>
                                <!-- <?php 
                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, 1)->row();
                                    if($cek_revisi){ echo "<span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>"; }
                                ?> -->
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
                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); ?>
                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                        <?php if($pengajuan->status == 3){ ?>
                                            <a href="#" data-id = "<?= $jadwal->id_timeline; ?>" class = "ubah_jadwal" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php if($this->session->userdata('role') == 4){ ?>
                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); ?>
                                <?php if($is_pmbg == 0){ ?>
                                    <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                        <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                            <div class="col-md-6" style="text-align: right;">
                                                <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="margin-left: 15px;">Tidak ada Data</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php $bab_1 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); if($bab_1){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); ?>
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3){ ?>
                                                            <a href="#" data-id = "<?= $jadwal->id_timeline; ?>" class = "ubah_jadwal" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <?php $bab1a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($bab1a){ ?>
                                                            <?php if($bab1a->is_catatan != 1){ ?>
                                                                <?php if($pengajuan->status < 4){ ?>
                                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                        <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab1a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if($bab1a){ ?>
                                                        <?php if($bab1a->is_catatan == 1){ ?>
                                                            <a href="#" class="btn btn-success btn-sm lihat_catatan" data-pmbg = "<?= $is_pmbg; ?>" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab1a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                                                        <?php } ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if($bab1a->status == 0){ ?>
                                                                    <?php if($pengajuan->status < 4){ ?>
                                                                        <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                            <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if(!$bab1a){ ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span style="margin-left: 15px">
                                                    <?php $bab1a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab1a){ echo $bab1a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2" style="text-align: right;">
                                                <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ 
                                                        if($bab1a->is_revisi && $bab1a->status_revisi == 0){
                                                ?>
                                                        <span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>
                                                <?php } } ?>
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php if($this->session->userdata('role') == 4){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($jadwal){ ?>
                                                        <?php if($is_pmbg == 0){ ?>
                                                            <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                <div class="col-md-6" style="text-align: right;">
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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

                <?php $bab_2 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); if($bab_2){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); ?>
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <?php $bab2a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($bab2a){ ?>
                                                            <?php if($bab2a->is_catatan != 1){ ?>
                                                                <?php if($pengajuan->status < 4){ ?>
                                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                        <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab2a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if($bab2a){ ?>
                                                        <?php if($bab2a->is_catatan == 1){ ?>
                                                            <a href="#" class="btn btn-success btn-sm lihat_catatan" data-pmbg = "<?= $is_pmbg; ?>" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab2a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                                                        <?php } ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if($bab2a->status == 0){ ?>
                                                                    <?php if($jadwal){ ?>
                                                                        <?php if($pengajuan->status < 4){ ?>
                                                                            <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                                <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if(!$bab2a){ ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($jadwal){ ?>
                                                                <?php if($is_pmbg == 0){ ?>
                                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                        <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span style="margin-left: 15px">
                                                    <?php $bab2a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab2a){ echo $bab2a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2" style="text-align: right;">
                                                <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ 
                                                        if($bab2a->is_revisi && $bab2a->status_revisi == 0){
                                                ?>
                                                        <span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>
                                                <?php } } ?>
                                                <!-- <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ echo "<span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>"; }
                                                ?> -->
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php if($this->session->userdata('role') == 4){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($jadwal){ ?>
                                                        <?php if($is_pmbg == 0){ ?>
                                                            <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                <div class="col-md-6" style="text-align: right;">
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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

                <?php $bab_3 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 9))->result(); if($bab_3){ ?>
                    <?php $get_kur = $this->M_entitas->selectX('entitas__bagian_kurikulum', array('id_bagian' => 9))->result(); ?>
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <?php $bab3a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($bab3a){ ?>
                                                            <?php if($bab3a->is_catatan != 1){ ?>
                                                                <?php if($pengajuan->status < 4){ ?>
                                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                        <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab3a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if($bab3a){ ?>
                                                        <?php if($bab3a->is_catatan == 1){ ?>
                                                            <a href="#" class="btn btn-success btn-sm lihat_catatan" data-pmbg = "<?= $is_pmbg; ?>" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $bab3a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                                                        <?php } ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if($bab3a->status == 0){ ?>
                                                                    <?php if($pengajuan->status < 4){ ?>
                                                                        <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                            <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if(!$bab3a){ ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span style="margin-left: 15px">
                                                    <?php $bab3a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($bab3a){ echo $bab3a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>

                                            </div>
                                            <div class="col-md-2" style="text-align: right;">
                                                <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ 
                                                        if($bab3a->is_revisi && $bab3a->status_revisi == 0){
                                                ?>
                                                        <span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>
                                                <?php } } ?>
                                                <!-- <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ echo "<span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>"; }
                                                ?> -->
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php if($this->session->userdata('role') == 4){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($jadwal){ ?>
                                                        <?php if($is_pmbg == 0){ ?>
                                                            <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                <div class="col-md-6" style="text-align: right;">
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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
                                <div class="col-md-12">
                                    <div class="space">
                                        <div class="row">
                                            <div class="col-md-6">     
                                                <h6 style="font-size: 15px"><b><?= "Lampiran ".$no++.". ".$key->nama_alias; ?></b></h6>
                                                <?php if($pengajuan->status < 100 && $pengajuan->status > 2){ ?>
                                                    <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <span style="font-size: 10pt">Waktu Pengerjaan : <?= indonesian_date($jadwal->waktu_mulai)." - ".indonesian_date($jadwal->waktu_selesai); ?></span>
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <?php $lampiran_a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($lampiran_a){ ?>
                                                            <?php if($lampiran_a->is_catatan != 1){ ?>
                                                                <?php if($pengajuan->status < 4){ ?>
                                                                    <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                        <a href="#" class="btn btn-info btn-sm catatan" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $lampiran_a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-pen" aria-hidden="true"></i> Beri Catatan</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if($lampiran_a){ ?>
                                                        <?php if($lampiran_a->is_catatan == 1){ ?>
                                                            <a href="#" class="btn btn-success btn-sm lihat_catatan" data-pmbg = "<?= $is_pmbg; ?>" data-id="<?= $pengajuan->id_pengajuan ?>" data-bagian="<?= $lampiran_a->id_bag_kurikulum_pengaju; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Catatan</a>
                                                        <?php } ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if($lampiran_a->status == 0){ ?>
                                                                    <?php if($pengajuan->status < 4){ ?>
                                                                        <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                            <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-warning btn-sm"><i class="fa fa-pen"></i> Ubah</a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if(!$lampiran_a){ ?>
                                                        <?php if($this->session->userdata('role') == 4){ ?>
                                                            <?php if($is_pmbg == 0){ ?>
                                                                <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span style="margin-left: 15px">
                                                    <?php $lampiran_a = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                    <?php  
                                                        if($lampiran_a){ echo $lampiran_a->isi_bagian_kurikulum; }
                                                        else{ echo "Tidak ada data"; }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2" style="text-align: right;">
                                                <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ 
                                                        if($lampiran_a->is_revisi && $lampiran_a->status_revisi == 0){
                                                ?>
                                                        <span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>
                                                <?php } } ?>
                                                <!-- <?php 
                                                    $cek_revisi = $this->M_new->get_riwayat_bagian_notif($id, $key->id_bagian)->row();
                                                    if($cek_revisi){ echo "<span style = 'color: red;'><i class = 'fa fa-bell' style = 'color: red;'></i> Revisi</span>"; }
                                                ?> -->
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
                                                    <?php if($this->session->userdata('role') == 2 || $is_pmbg == 1){ ?>
                                                        <?php if($pengajuan->status == 3 && $pengajuan->status > 1){ ?>
                                                            <a href="#" class = "ubah_jadwal" data-id = "<?= $jadwal->id_timeline; ?>" style="color: orangered; font-size: 12px;"><i class="fa fa-pen"></i> Ubah</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if($pengajuan->status < 100){ ?>
                                                <?php $jadwal = $this->M_entitas->selectX('timeline_pengajuan', array('id_pengajuan' => $id, 'id_bagian' => $key->id_bagian))->row(); ?>
                                                <?php if($jadwal){ ?>
                                                    <?php if($this->session->userdata('role') == 4){ ?>
                                                        <?php if($is_pmbg == 0){ ?>
                                                            <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ ?>
                                                                <div class="col-md-6" style="text-align: right;">
                                                                    <a href="<?= site_url('isi-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($key->id_bagian)).'/'.bin2hex(base64_encode(2)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class = "btn btn-info btn-sm"><i class="fa fa-pen"></i> Isi</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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