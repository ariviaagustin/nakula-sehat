<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <div class="box_judul" style="padding: 15px; border: 1px solid #c6c6c6; border-radius: 5px; background-color: antiquewhite;">
          <span style="font-size: 18px; font-weight: 600; color: #000;">Judul Kurikulum : <?= $kurikulum->judul; ?></span>
        </div>
      </div>
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
            </tr>
            <tr>
              <td>Mata Pelatihan</td>
              <td>:</td>
              <td><?= $key->materi; ?></td>
            </tr>
            <tr>
              <td>Deskripsi Mata pelatihan</td>
              <td>:</td>
              <td><?= $key->deskripsi; ?></td>
            </tr>
            <tr>
              <td>Hasil Belajar</td>
              <td>:</td>
              <td><?= $key->hasil_belajar; ?></td>
            </tr>
            <tr>
              <td>Waktu</td>
              <td>:</td>
              <td>
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
                        $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();
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
                      <ul style = 'margin-bottom: 0rem;'>
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
    </div>
  </div>
</body>
</html>