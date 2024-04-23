<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tr>
            <td style="width: 17%;">Nomor</td>
            <td style="width: 1%;">:</td>
            <td>
              <?php 
                if($materi->jenis_materi == 1){ $a = "MPD"; }
                else if($materi->jenis_materi == 2){ $a = "MPI";}
                else if($materi->jenis_materi == 3){ $a = "MPP"; }

                $cek = $this->M_entitas->selectX('materi', array('jenis_materi' => $materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

                $id_materi = array();
                foreach ($cek as $key)
                {
                  $id_materi[] = $key->id_materi;
                }

                $get_indeks = array_search($materi->id_materi, $id_materi);
                $no = $get_indeks+1;
                $nomor = $a.".".$no;
                echo $nomor;
              ?>
            </td>
          </tr>
          <tr>
            <td>Mata Pelatihan</td>
            <td>:</td>
            <td><?= $materi->materi; ?></td>
          </tr>
          <tr>
            <td>Deskripsi Mata pelatihan</td>
            <td>:</td>
            <td><?= $materi->deskripsi; ?></td>
          </tr>
          <tr>
            <td>Hasil Belajar</td>
            <td>:</td>
            <td><?= $materi->hasil_belajar; ?></td>
          </tr>
          <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>
              <?php
                $jpl = $materi->t + $materi->p + $materi->pl;
                  echo $jpl." JPL (T= ".$materi->t." JPL, P= ".$materi->p." JPL, PL= ".$materi->pl." JPL)";
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
          <?php if($indikator){ ?>
            <tr>
              <td colspan="5">Setelah mengikuti mata pelatihan ini, peserta mampu:</td>
            </tr>
            <?php $no = 1; foreach ($indikator as $key) { ?>
              <tr>
                <td>
                  <table>
                    <tr>
                      <td style="padding: 5px;"><?= $no; ?>.</td>
                      <td style="padding: 5px;"><?= $key->indikator_hasil_belajar; ?></td>
                    </tr>
                  </table>
                </td>
                <td>
                  <table>
                    <tr>
                      <td style="padding: 5px;"><?= $no; ?>.</td>
                      <td style="padding: 5px;">
                        <?= $key->materi_sub_materi_pokok; ?><br>
                        <?php 
                          $get_materi_sub_materi_pokok = $this->M_entitas->selectX('isi_materi_sub_materi_pokok', array('id_indikator_hasil_belajar' => $key->id_indikator_hasil_belajar))->result();
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
                    <ul style = "margin-bottom: 0rem;">
                      <li>Bahan Tayang</li>
                      <li>Modul</li>
                      <li>Laptop</li>
                      <li>LCD</li>
                      <?php 
                        if($metode)
                        {
                          foreach ($metode as $key) 
                          {
                            $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result();
                            if($get_media)
                            {
                              foreach ($get_media as $g_media) 
                              {
                                echo "<li>".$g_media->media_alat_bantu."</li>";
                              }
                            }
                          }
                        }
                      ?>
                    </ul>
                  </td>
                  <td rowspan="<?= $total_indikator; ?>">
                    <?php 
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
  </div>
</body>
</html>