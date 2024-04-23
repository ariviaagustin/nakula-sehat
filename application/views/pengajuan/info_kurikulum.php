<html>
  <head>
    <style type="text/css">
      .space{ margin-bottom: 20px; }
    </style>
  </head>
  <body style="color: #000">
    <div class="row">
      <div class="col-md-4 col-lg-4 col-5 col-xs-5">
        <img src="<?= base_url('agenda/perdata/pengajuan/cover/'.$pengajuan->gambar_cover); ?>" style = "width: 100%; height: 50%">
      </div>
      <div class="col-md-8 col-lg-8 col-7 col-xs-7" style="color: #000">
        <div class="row">
          <div class="col-md-8">
            <div class="space">
              <h6 style="font-size: 15px"><b>Tahun :</b></h6>
              <span style="margin-left: 15px"><?= $pengajuan->tahun; ?></span>
            </div>
          </div>
          <div class="col-md-4" style="text-align: right;">
            <a href="<?= site_url('cetak-pengajuan/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>" class = "btn btn-primary btn-sm" target = "_blank"><i class="fa fa-print"></i> Cetak Kurikulum</a>
          </div>
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
          <h6 style="font-size: 15px"><b>Total JPL :</b></h6>
          <?php if($pengajuan->jpl){ ?>
            <span style="margin-left: 15px"><?= $pengajuan->jpl; ?></span>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-12 col-md-12 col-12 col-xs-12">
        <?php $kp = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => 1))->row(); if($kp){ ?>
          <div style="padding: 5px; margin-bottom: 20px; color: #000">
            <h6 style="font-size: 18px"><b>B. Kata Pengantar</b></h6><hr>
            <div class="row">
              <div class="col-md-12">
                <?= $kp->isi_bagian_kurikulum; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php  $bab_1 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian < ' => 4, 'id_bagian > ' => 1))->result(); if($bab_1){ ?>
          <div style="padding: 5px; margin-bottom: 20px; color: #000">
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
        <?php  $bab_2 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian < ' => 9, 'id_bagian > ' => 3))->result(); if($bab_2){ ?>
          <div style="padding: 5px; margin-bottom: 20px; color: #000">
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
        <?php $bab_3 = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian' => 9))->result(); if($bab_3){ ?>
          <div style="padding: 5px; margin-bottom: 20px; color: #000">
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
        <?php $lampiran = $this->M_entitas->selectX('bagian_kurikulum_pengaju', array('id_pengajuan' => $pengajuan->id_pengajuan, 'id_bagian >' => 9))->result(); if($lampiran){ ?>
          <div style="padding: 5px; color: #000">
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
      </div>
    </div>
    <!-- <hr>
    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <a href="<?= site_url('setujui-permohonan/'.bin2hex(base64_encode($pengajuan->id_pengajuan))); ?>" class = "btn btn-success btn-sm" title = "Setujui"><i class="fa fa-check-circle"></i> Setujui</a>
      </div>
    </div> -->
  </body>
</html>