<style type="text/css">
  #content{ background-color: #fff; }
  th, td{ padding: 10px; vertical-align: top; }
  th{ width: 15%; text-align:center; }
  .btn-kaktor{ background-color: blueviolet; border-color: blueviolet; }
  .btn-cek-kurikulum{ background-color: limegreen; border-color: limegreen; }
  .box{ padding: 15px; background-color: lightblue; border-color: lightblue;
   border-radius: 5px; text-align:center; color: #000; box-shadow :0 0 20px rgb(0 0 0 / 20%) } 
   .box:hover { border: 1px solid #1f3384;}
   a:hover{text-decoration:none; }
   .aktif{ background-color:coral; }
 </style> 
 <div class="container-fluid"> 
  <div class="card mb-4" style="border: 0px; padding: 0px;"> 
    <div class="card-header py-3" style="background-color: #fff; color: #000"> 
      <h5 class="m-0 font-weight-bold" style="font-size: 17px">Lampiran</h5> 
    </div> 
    <div class= "card-body" style="padding: 10px; color: #000"> 
      <div class="card-body card-block"> 
        <?php $id_sub_bab = base64_decode(hex2bin($this->uri->segment(3))); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
              <span style="font-size: 18px; font-weight: 600;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
            </div>
            <br>
            <h5>1. Rancang Bangun Pembelajaran Mata Pelatihan (RBPMP)</h5>
            <div class="alert alert-info">
              <span><b><i class="fa fa-info-circle"></i> Silahkan berikan penilaian terhadap Kurikulum yang telah diajukan.</b></span>
            </div>
            <hr>
            <?php foreach ($materi as $key) { ?>
              <div class="row">
                <div class="col-md-12">
                  <table width="100%">
                    <tr>
                      <td style="width: 17%;">Nomor</td>
                      <td style="width: 1%;">:</td>
                      <td>
                        <?php 
                          if($key->jenis_materi == 1){ $a = "MPD"; }
                          else if($key->jenis_materi == 2){ $a = "MPI";}
                          else if($key->jenis_materi == 3){ $a = "MPP"; }

                          $cek = $this->M_entitas->selectX('materi', array('jenis_materi' => $key->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

                          $id_materi = array();
                          foreach ($cek as $c)
                          {
                            $id_materi[] = $c->id_materi;
                          }

                          $get_indeks = array_search($key->id_materi, $id_materi);
                          $no = $get_indeks+1;
                          $nomor = $a.".".$no;
                          echo $nomor;
                        ?>
                      </td>
                      <td style="text-align: right;">
                        <a href="<?= site_url('penilaian-materi-rbpmp/'.bin2hex(base64_encode($key->id_materi)).'/'.bin2hex(base64_encode($list->id_list_pengerjaan_kurikulum))); ?>" class = "btn btn-warning btn-sm" <?php if($key->catatan_rbpmp){ if($key->status_penilaian_rbpmp == 1){ ?> style = "color: #fff; background-color: #7459ff; border-color: #7459ff;" <?php } } ?> style = "color: #000;">
                          <i class="fa fa-pen"></i> <?php if($key->catatan_rbpmp){ if($key->status_penilaian_rbpmp == 1){ echo "Ubah Penilaian"; } else if($key->status_penilaian_rbpmp == 2){ echo "Berikan Penilaian"; } } else { echo "Berikan Penilaian"; } ?></a>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>Mata Pelatihan</td>
                      <td>:</td>
                      <td colspan="2"><?= $key->materi; ?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi Mata pelatihan</td>
                      <td>:</td>
                      <td colspan="2"><?= $key->deskripsi; ?></td>
                    </tr>
                    <tr>
                      <td>Hasil Belajar</td>
                      <td>:</td>
                      <td colspan="2"><?= $key->hasil_belajar; ?></td>
                    </tr>
                    <tr>
                      <td>Waktu</td>
                      <td>:</td>
                      <td colspan="2">
                        <?php
                          $jpl = $key->t + $key->p + $key->pl;
                            echo $jpl." JPL (T= ".$key->t." JPL, P= ".$key->p." JPL, PL= ".$key->pl." JPL)";
                        ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <table width="100%" border="1">
                    <tr>
                      <th>Indikator Hasil belajar</th>
                      <th>Materi Pokok dan Sub Materi Pokok</th>
                      <th>Metode</th>
                      <th>Media dan Alat Bantu</th>
                      <th>Referensi</th>
                    </tr>
                    <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $key->id_materi))->result(); $total_indikator = count($indikator); ?>
                    <?php if($indikator){ ?>
                      <tr>
                        <td colspan="5">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
                      </tr>
                      <?php $no = 1; foreach ($indikator as $indi) { ?>
                        <tr>
                          <td>
                            <table>
                              <tr>
                                <td style="padding: 5px;"><?= $no; ?>.</td>
                                <td style="padding: 5px;"><?= $indi->indikator_hasil_belajar; ?></td>
                              </tr>
                            </table>
                          </td>
                          <td>
                            <table>
                              <tr>
                                <td style="padding: 5px;"><?= $no; ?>.</td>
                                <td style="padding: 5px;">
                                  <?= $indi->materi_sub_materi_pokok; ?><br>
                                  <?php 
                                    $get_materi_sub_materi_pokok = $this->M_entitas->selectX('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $indi->id_indikator_hasil_belajar))->result();
                                    if($get_materi_sub_materi_pokok)
                                    { 
                                      echo "<ol type='a'>";
                                      foreach ($get_materi_sub_materi_pokok as $pokok_materi)
                                      {
                                        echo "<li>".$pokok_materi->isi_materi_sub_materi_pokok."</li>";
                                      }
                                      echo "</ol>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </td>
                          <?php if($no == 1){ ?>
                            <td rowspan="<?= $total_indikator; ?>">
                              <?php 
                                $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi))->result();
                                if($metode)
                                {
                                  echo "<ul>";
                                  foreach ($metode as $get_metode) 
                                  {
                                    echo "<li>".$get_metode->metode."</li>";
                                  }
                                  echo "</ul>";
                                }
                              ?>
                            </td>
                            <td rowspan="<?= $total_indikator; ?>">
                              <ul style="margin-bottom: 0px;">
                                <li>Bahan Tayang</li>
                                <li>Modul</li>
                                <li>Laptop</li>
                                <li>LCD</li>
                              </ul>
                              <?php
                                $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();
                                if($metode)
                                {
                                  foreach ($metode as $get_metode) 
                                  {
                                    $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $get_metode->id_metode))->result();
                                    if($get_media)
                                    {
                                      echo "<ul style = 'margin-bottom: 0rem;'>";
                                      foreach ($get_media as $get_med) 
                                      {
                                        echo "<li>".$get_med->media_alat_bantu."</li>";
                                      }
                                      echo "</ul>";
                                    }
                                  }
                                }
                              ?>
                            </td>
                            <td rowspan="<?= $total_indikator; ?>">
                              <?php 
                                $referensi = $this->M_entitas->selectX('referensi_materi', array('id_materi' => $key->id_materi))->result();
                                if($referensi)
                                {
                                  echo "<ul>";
                                  foreach ($referensi as $get_referensi) 
                                  {
                                    echo "<li>".$get_referensi->referensi_materi."</li>";
                                  }
                                  echo "</ul>";
                                }
                              ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php $no++; } ?>
                    <?php } ?>
                    <?php if(!$indikator){ ?>
                      <tr>
                        <td colspan="6" style="text-align: center;">Belum ada data</td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <hr>
            <?php } ?>
            <hr>
            <form action="<?= site_url('Kurikulum/aksi_penilaian_kurikulum'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">  
              <div class="row form-group"> 
                <div class="col-12 col-md-12">
                  <label style="font-size: 17px;"><b>Berikan Penilaian:</b></h5></label><br>
                  <textarea rows="5" class="form-control" name="catatan" placeholder="Berikan Penilaian"></textarea>
                </div>
              </div>
              <div class="row form-group" style="margin-left: 1%;">
                <label><span style="color: red">* Wajib diisi</span></label>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <a href="<?= site_url('penilaian-penilai/'.bin2hex(base64_encode($kurikulum->id_kurikulum))); ?>" class = "btn btn-warning" style = "color: #000;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-10" style="text-align: right;">
                  <input type="hidden" name="id_kurikulum" value="<?= $kurikulum->id_kurikulum; ?>">
                  <input type="hidden" name="id_list_pengerjaan_kurikulum" value="<?= $list->id_list_pengerjaan_kurikulum; ?>">
                  <input type="hidden" name="keterangan" value="-">
                  <button type="submit" class="btn btn-info">Simpan</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>