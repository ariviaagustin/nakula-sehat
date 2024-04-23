<!DOCTYPE html>
<html>
<style type="text/css">
  h3{ font-family: Verdana, sans-serif; font-size: 14pt; font-weight: bold; text-align: center; }
  h4{ font-family: Verdana, sans-serif; font-size: 12pt; font-weight: bold; }
  .isi{ font-family: Verdana, sans-serif; font-size: 12pt; text-align: justify; font-weight:100; margin-top:5%; }
   .isi_rbpmp{ font-family: Verdana, sans-serif; font-size: 9pt; text-align: justify; font-weight:100; margin-top:5%; }
  th{ text-align:center; font-weight:bold; }
  ul, ol, li{ margin-top: 0px; padding-top: 0px; padding-left: -10px; }
</style>
<body style="color: #000;">
    <h4 style="text-align: left;">LAMPIRAN 1. RANCANG BANGUN PEMBELAJARAN MATA PELATIHAN (RBPMP)</h4>
    <br><br>
    <h4 style="text-align: left;">A. MATERI PELATIHAN DASAR</h4>
    <br><br>
    <?php foreach ($materi_dasar as $key) { ?>
      <table style="width: 100%; padding: 6px;">
        <tr>
          <td style="width: 23%;" class = "isi">Nomor</td>
          <td style="width: 3%;" class = "isi">:</td>
          <td style="width: 74%;" class = "isi">
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
          <td class = "isi">Mata Pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->materi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Deskripsi Mata pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->deskripsi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Hasil Belajar</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->hasil_belajar; ?></td>
        </tr>
        <tr>
          <td class = "isi">Waktu</td>
          <td class = "isi">:</td>
          <td class = "isi">
            <?php
              $jpl = $key->t + $key->p + $key->pl;
                echo $jpl." JPL (T= ".$key->t." JPL, P= ".$key->p." JPL, PL= ".$key->pl." JPL)";
            ?>
          </td>
        </tr>
      </table>
      <br><br><br>
      <table width="100%" border="1" style="padding: 6px;">
        <tr>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Indikator Hasil belajar</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Materi Pokok dan Sub Materi Pokok</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Metode</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Media dan Alat Bantu</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Referensi</b></th>
        </tr>
        <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $key->id_materi))->result(); $total_indikator = count($indikator); ?>
        <?php if($indikator){ ?>
          <tr>
            <td colspan="5" class="isi_rbpmp">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
          </tr>
          <?php $no = 1; foreach ($indikator as $indi) { ?>
            <tr>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="padding: 0px; width: 10%;"><?= $no; ?>.</td>
                    <td style="padding: 0px; width: 90%;"><?= $indi->indikator_hasil_belajar; ?></td>
                  </tr>
                </table>
              </td>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="padding: 0px; width: 10%;"><?= $no; ?>.</td>
                    <td style="padding: 0px; width: 90%;">
                      <?= $indi->materi_sub_materi_pokok; ?>
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
                  <ul style="margin-bottom: 0rem;">
                    <li>Bahan Tayang</li>
                    <li>Modul</li>
                    <li>Laptop</li>
                    <li>LCD</li>
                    <?php
                      $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();
                      if($metode)
                      {
                        foreach ($metode as $get_metode) 
                        {
                          $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $get_metode->id_metode))->result();
                          if($get_media)
                          {
                            foreach ($get_media as $get_med) 
                            {
                              echo "<li>".$get_med->media_alat_bantu."</li>";
                            }
                          }
                        }
                      }
                    ?>
                  </ul>
                </td>
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
            <td colspan="5" style="text-align: center;" class="isi_rbpmp">Belum ada data</td>
          </tr>
        <?php } ?>
      </table>
      <p style="page-break-before: always"></p>
    <?php } ?>
    <h4 style="text-align: left;">B. MATERI PELATIHAN INTI</h4>
    <br><br>
    <?php foreach ($materi_inti as $key) { ?>
      <table style="width: 100%; padding: 6px;">
        <tr>
          <td style="width: 23%;" class = "isi">Nomor</td>
          <td style="width: 3%;" class = "isi">:</td>
          <td style="width: 74%;" class = "isi">
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
          <td class = "isi">Mata Pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->materi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Deskripsi Mata pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->deskripsi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Hasil Belajar</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->hasil_belajar; ?></td>
        </tr>
        <tr>
          <td class = "isi">Waktu</td>
          <td class = "isi">:</td>
          <td class = "isi">
            <?php
              $jpl = $key->t + $key->p + $key->pl;
                echo $jpl." JPL (T= ".$key->t." JPL, P= ".$key->p." JPL, PL= ".$key->pl." JPL)";
            ?>
          </td>
        </tr>
      </table>
      <br><br><br>
      <table width="100%" border="1" style="padding: 6px;">
        <tr>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Indikator Hasil belajar</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Materi Pokok dan Sub Materi Pokok</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Metode</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Media dan Alat Bantu</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Referensi</b></th>
        </tr>
        <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $key->id_materi))->result(); $total_indikator = count($indikator); ?>
        <?php if($indikator){ ?>
          <tr>
            <td colspan="5" class="isi_rbpmp">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
          </tr>
          <?php $no = 1; foreach ($indikator as $indi) { ?>
            <tr>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="width: 10%;"><?= $no; ?>.</td>
                    <td style="width: 90%;"><?= $indi->indikator_hasil_belajar; ?></td>
                  </tr>
                </table>
              </td>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="width: 10%;"><?= $no; ?>.</td>
                    <td style="width: 90%;">
                      <?= $indi->materi_sub_materi_pokok; ?>
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
                  <ul style="margin-bottom: 0rem;">
                    <li>Bahan Tayang</li>
                    <li>Modul</li>
                    <li>Laptop</li>
                    <li>LCD</li>
                    <?php
                      $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi))->result();
                      if($metode)
                      {
                        foreach ($metode as $get_metode) 
                        {
                          $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $get_metode->id_metode))->result();
                          if($get_media)
                          {
                            foreach ($get_media as $get_med) 
                            {
                              echo "<li>".$get_med->media_alat_bantu."</li>";
                            }
                          }
                        }
                      }
                    ?>
                  </ul>
                </td>
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
            <td colspan="5" style="text-align: center;" class="isi_rbpmp">Belum ada data</td>
          </tr>
        <?php } ?>
      </table>
      <p style="page-break-before: always"></p>
    <?php } ?>
    <h4 style="text-align: left;">C. MATERI PELATIHAN PENUNJANG</h4>
    <br><br>
    <?php $jumlah_materi_penunjang = count($materi_penunjang); ?>
    <?php $abc = 1; foreach ($materi_penunjang as $key){ ?>
      <table style="width: 100%; padding: 6px;">
        <tr>
          <td style="width: 23%;" class = "isi">Nomor</td>
          <td style="width: 3%;" class = "isi">:</td>
          <td style="width: 74%;" class = "isi">
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
          <td class = "isi">Mata Pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->materi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Deskripsi Mata pelatihan</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->deskripsi; ?></td>
        </tr>
        <tr>
          <td class = "isi">Hasil Belajar</td>
          <td class = "isi">:</td>
          <td class = "isi"><?= $key->hasil_belajar; ?></td>
        </tr>
        <tr>
          <td class = "isi">Waktu</td>
          <td class = "isi">:</td>
          <td class = "isi">
            <?php
              $jpl = $key->t + $key->p + $key->pl;
                echo $jpl." JPL (T= ".$key->t." JPL, P= ".$key->p." JPL, PL= ".$key->pl." JPL)";
            ?>
          </td>
        </tr>
      </table>
      <br><br><br>
      <table width="100%" border="1" style="padding: 6px;">
        <tr>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Indikator Hasil belajar</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Materi Pokok dan Sub Materi Pokok</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Metode</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Media dan Alat Bantu</b></th>
          <th class="isi_rbpmp" style="width: 19%; text-align: center;"><b>Referensi</b></th>
        </tr>
        <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $key->id_materi))->result(); $total_indikator = count($indikator); ?>
        <?php if($indikator){ ?>
          <tr>
            <td colspan="5" class="isi_rbpmp">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
          </tr>
          <?php $no = 1; foreach ($indikator as $indi) { ?>
            <tr>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="width: 10%;"><?= $no; ?>.</td>
                    <td style="width: 90%;"><?= $indi->indikator_hasil_belajar; ?></td>
                  </tr>
                </table>
              </td>
              <td class="isi_rbpmp" style="text-align: left;">
                <table>
                  <tr>
                    <td style="width: 10%;"><?= $no; ?>.</td>
                    <td style="width: 90%;">
                      <?= $indi->materi_sub_materi_pokok; ?>
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
                  <ul style="margin-bottom: 0rem;">
                    <li>Bahan Tayang</li>
                    <li>Modul</li>
                    <li>Laptop</li>
                    <li>LCD</li>
                    <?php
                      $metode = $this->M_entitas->selectX('metode_materi', array('id_materi' => $key->id_materi))->result();
                      if($metode)
                      {
                        foreach ($metode as $get_metode) 
                        {
                          $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $get_metode->id_metode))->result();
                          if($get_media)
                          {
                            foreach ($get_media as $get_med) 
                            {
                              echo "<li>".$get_med->media_alat_bantu."</li>";
                            }
                          }
                        }
                      }
                    ?>
                  </ul>
                </td>
                <td rowspan="<?= $total_indikator; ?>" class="isi_rbpmp">
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
            <td colspan="6" style="text-align: center;" class="isi_rbpmp">Belum ada data</td>
          </tr>
        <?php } ?>
      </table>
      <?php if($abc < $jumlah_materi_penunjang){ ?>
        <p style="page-break-before: always"></p>
      <?php } ?>
    <?php $abc++; } ?>
</body>
</html>