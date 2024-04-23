<style type="text/css">
    #content
    {
        background-color: #fff;
    }
    .space{ margin-bottom: 20px; }
    th{ text-align: center; }
</style>
<div class="container-fluid">
  <!-- DataTales Example -->
    <div class="card mb-4" style="border: 0px; padding: 0px">
        <div class="card-header" style="background-color: #fff; border: 0px">
            <h5 style="font-size: 17px; color: #000">Pengaju : <?= $nama_pengaju; ?></h5>
            <hr>
        </div>
        <div class="card-body" style="color: #000; padding-top: 0px">
            <div class="card-body card-block" style="padding-top: 0px">
                <div style="padding: 5px; margin-bottom: 20px">
                    <h6 style="font-size: 18px"><b>A. Judul Kurikulum yang Diajukan</b></h6><hr>
                    <div class="row">
                        <div class = "col-md-4">
                            <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style = "width: 100%;">
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
                                <span style="margin-left: 15px">
                                    <?php $get_pj = $this->M_entitas->selectX('pj_subtansi', array('id_pj_subtansi' => $pengajuan->pj_subtansi))->row(); echo $get_pj->nama_pj_subtansi; ?>
                                </span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Tim Penyusun :</b></h6>
                                <span style="margin-left: 15px"><?= $pengajuan->tim_penyusun; ?></span>
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>File Pengajuan :</b></h6>
                                <?php if($pengajuan->file_pengajuan){ ?>
                                    <a href="<?= base_url('agenda/perdata/pengajuan/permohonan/'.$pengajuan->file_pengajuan); ?>" class = "btn btn-info btn-sm" style="margin-left: 15px"><i class="fa fa-file"></i> Lihat File Pengajuan</a>
                                <?php } ?>
                                <?php if(!$pengajuan->file_pengajuan){ echo "<span style='margin-left: 15px'>Belum ada file</span>"; } ?>
                                <!-- <span style="margin-left: 15px"><?= $pengajuan->tim_penyusun; ?></span> -->
                            </div>
                            <div class="space">
                                <h6 style="font-size: 15px"><b>Total JPL :</b></h6>
                                <?php if($pengajuan->jpl){ ?>
                                    <span style="margin-left: 15px"><?= $pengajuan->jpl; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $kp = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 1))->row(); if($kp){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>B. Kata Pengantar</b></h6><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $kp->isi_bagian_kurikulum; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php  $bab_1 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); if($bab_1){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>C. Bab I</b></h6><hr>
                        
                        <div class="row">
                            <?php foreach ($bab_1 as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <h6 style="font-size: 15px"><b>
                                            <?php 
                                                foreach ($kur as $data) 
                                                { 
                                                    if($data->id_bagian ==  $key->id_bagian)
                                                    {
                                                        echo $data->nama_alias;
                                                    }
                                                }
                                            ?>
                                        </b></h6>
                                        <span style="margin-left: 15px"><?= $key->isi_bagian_kurikulum; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php  $bab_2 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); if($bab_2){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>D. Bab II</b></h6><hr>
                        
                        <div class="row">
                            <?php foreach ($bab_2 as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <h6 style="font-size: 15px"><b>
                                            <?php 
                                                foreach ($kur as $data) 
                                                { 
                                                    if($data->id_bagian ==  $key->id_bagian)
                                                    {
                                                        echo $data->nama_alias;
                                                    }
                                                }
                                            ?>
                                        </b></h6>
                                        <span style="margin-left: 15px"><?= $key->isi_bagian_kurikulum; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php $bab_3 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian' => 9))->result(); if($bab_3){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>E. Bab III</b></h6><hr>
                        <div class="row">
                            <?php foreach ($bab_3 as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <h6 style="font-size: 15px"><b>
                                            <?php 
                                                foreach ($kur as $data) 
                                                { 
                                                    if($data->id_bagian ==  $key->id_bagian)
                                                    {
                                                        echo $data->bagian_kurikulum;
                                                    }
                                                }
                                            ?>
                                        </b></h6>
                                        <span style="margin-left: 15px"><?= $key->isi_bagian_kurikulum; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php $lampiran = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $id, 'id_bagian >' => 9))->result(); if($lampiran){ ?>
                    <div style="padding: 5px; margin-bottom: 20px">
                        <h6 style="font-size: 18px"><b>F. Lampiran</b></h6><hr>
                        <div class="row">
                            <?php foreach ($lampiran as $key) { ?>
                                <div class="col-md-12">
                                    <div class="space">
                                        <h6 style="font-size: 15px"><b>
                                            <?php 
                                                foreach ($kur as $data) 
                                                { 
                                                    if($data->id_bagian ==  $key->id_bagian)
                                                    {
                                                        echo $data->nama_alias;
                                                    }
                                                }
                                            ?>
                                        </b></h6>
                                        <span style="margin-left: 15px"><?= $key->isi_bagian_kurikulum; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div style="padding: 5px; margin-bottom: 20px">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <a href="#" data-toggle="modal" data-target="#terima" class = "btn btn-success" style = "border-radius: 3px;">Terima Pengajuan</a>
                            <a href="#" data-toggle="modal" data-target="#tolak" id="btn_tolak" class = "btn btn-danger" style = "border-radius: 3px;">Tolak Pengajuan</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Rekapitulasi Penilaian Pengajuan</h5><br>
                            <div class="table-responsive">
                                <div style="overflow-x:auto;">
                                    <table class="table table-bordered" id="table_id" width="100%" cellspacing="0" style="color: #000;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Penilai</th>
                                                <th>Penilaian Berjalan</th>
                                                <th>Penilaian Selesai</th>
                                                <th>Penilaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($penilai as $key) {  ?>
                                                <tr>
                                                    <td style="text-align: center;"><?= $no++; ?>.</td>
                                                    <td><?= $key->nama_penilai; ?></td>
                                                    <td style="text-align: center; background-color: #ffd384;">
                                                        <?php 
                                                            $berjalan = $this->M_entitas->selectX('pengajuan', array('id_penilai' => $key->id_penilai, 'status > ' => 2, 'status < ' => 4))->num_rows();
                                                            echo $berjalan;
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center; background-color: #98ff7e;">
                                                        <?php 
                                                            $selesai = $this->M_entitas->selectX('pengajuan', array('id_penilai' => $key->id_penilai, 'status > ' => 3))->num_rows();
                                                            echo $selesai;
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center; background-color: #d3eaff;">
                                                        <?php 
                                                            $semua = $this->M_entitas->selectX('pengajuan', array('id_penilai' => $key->id_penilai))->num_rows();
                                                            echo $semua;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="terima" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title" id="myModalLabel" style = "color: #000">Pilih Penilai</h7>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form action="<?= site_url('Pengajuan/aksi_terima'); ?>" method = "post">
                <div class="modal-body">
                    <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                    <input type="hidden" name="status" value="2">
                    <div class="row">
                        <div class="col-md-3"><label>Pilih Penilai</label></div>
                        <div class="col-md-9">
                            <?php $penilai = $this->M_new->get_penilai($pengajuan->pengaju)->result(); ?>
                            <select class="form-control select2" name="id_penilai" style="width: 100%;">
                                <option>-- Pilih Penilai --</option>
                                <?php foreach ($penilai as $key) { ?>
                                    <?php $jumlah_pengajuan = $this->M_entitas->selectX('pengajuan', array('id_penilai' => $key->id_penilai, 'status < ' => 4))->num_rows(); ?>
                                    <option value="<?= $key->id_penilai; ?>"><?= $key->nama_penilai." - sedang mendampingi ".$jumlah_pengajuan." pengajuan"; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style = "border-radius: 3px;">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title" id="myModalLabel" style = "color: #000">Alasan</h7>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form action="<?= site_url('Pengajuan/aksi_tolak'); ?>" method = "post">
                <div class="modal-body">
                    <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                    <input type="hidden" name="status" value="100">
                    <div class="row">
                        <div class="col-md-2"><label>Alasan</label></div>
                        <div class="col-md-10">
                            <textarea name="alasan_tolak" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" style = "border-radius: 3px;">Tolak</button>
                </div>
            </form>
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
  $(document).ready( function () {
    $('#table_id').DataTable({
      // "ordering": false,
      "order": [[ 2, "desc" ]]
    }
      );
} );
</script>