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
    <?php if($penugasan_materi){ foreach ($penugasan_materi as $key) { ?>
      <div class="col-md-12">
        <?php $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $key->id_materi))->row(); ?>
        <?php 
          if($get_materi->jenis_materi == 1){ $a = "Dasar"; }
          else if($get_materi->jenis_materi == 2){ $a = "Inti";}
          else if($get_materi->jenis_materi == 3){ $a = "Penunjang"; }

          $get_jenis_materi = $this->M_entitas->selectX('materi', array('jenis_materi' => $get_materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

          $id_materi = array();
          foreach ($get_jenis_materi as $gjm)
          {
            $id_materi[] = $gjm->id_materi;
          }

          $get_indeks = array_search($get_materi->id_materi, $id_materi);
          $no = $get_indeks+1;
        ?>
        <table width="100%">
          <tr>
            <td><b>Mata Pelatihan <?= $a." ".$no; ?></b></td>
          </tr>
          <tr>
            <td><?= $get_materi->materi; ?></td>
          </tr>
          <tr>
            <td style="text-align: center;">
              <b>
                Panduan <?= $key->metode; ?>
              </b>
            </td>
          </tr>
          <tr>
            <td><b><u>Indikator Hasil Belajar:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php $indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $get_materi->id_materi))->result(); ?>
              <?php if($indikator){ ?>
                Setelah mengikuti mata pelatihan ini, peserta mampu:<br>
                <ol style="margin-bottom: 0px !important">
                  <?php 
                    foreach ($indikator as $indi) 
                    {
                      echo "<li>".$indi->indikator_hasil_belajar."</li>";
                    }
                  ?>
                </ol>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><b><u>Alat dan Bahan:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php $media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result(); ?>
              <?php if($media){ ?>
                <ol style="margin-bottom: 0px !important">
                  <?php 
                    foreach ($media as $mede) 
                    {
                      echo "<li>".$mede->media_alat_bantu."</li>";
                    }
                    $media_tambahan = $this->M_entitas->selectX('media_alat_bantu_tambahan', array('id_metode_materi' => $key->id_metode_materi))->result();
                    if($media_tambahan)
                    {
                      foreach ($media_tambahan as $mt) 
                      {
                        echo "<li>".$mt->media_alat_bantu."</li>";
                      }
                    }
                  ?>
                </ol>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td>
              <b><u>Waktu:</u></b>
              <?php 
                $jpl = $get_materi->t + $get_materi->p + $get_materi->pl;
                $total_jpl = $jpl * 45;
                echo $jpl." JPL x 45 menit = ".$total_jpl." menit";
              ?>
            </td>
          </tr>
          <tr>
            <td><b><u>Petunjuk:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php $petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $key->id_metode_materi))->result(); ?>
              <?php if($petunjuk){ ?>
                <ol>
                  <?php foreach ($petunjuk as $p) { ?>
                    <li><?= $p->petunjuk_panduan_penugasan; ?></li>
                  <?php } ?>
                </ol>
              <?php } ?>
              <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
            </td>
          </tr>
        </table>
        <hr>
      </div>
    <?php } } ?>
    <?php if($penugasan_pl){ ?>
      <div class="col-md-12">
        <table width="100%">
          <tr>
            <td style="text-align: center;"><h5 style="font-size: 18px;"><b>PANDUAN PRAKTIK LAPANG</b></h5></td>
          </tr>
          <tr>
            <td>
              <b><u>Waktu:</u></b>
              <?php 
                $jpl = 0;
                foreach ($penugasan_pl as $key) 
                {
                  $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $key->id_materi))->row();
                  $jpl += $get_materi->pl;
                }
                $total_jpl = $jpl * 60;
                echo $jpl." JPL x 60 menit = ".$total_jpl." menit";
              ?>
            </td>
          </tr>
          <tr>
            <td><b><u>Petunjuk:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php $petunjuk = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result(); ?>
              <?php if($petunjuk){ ?>
                <ol>
                  <?php foreach ($petunjuk as $key) { ?>
                    <li><?= $key->panduan_penugasan; ?></li>
                  <?php } ?>
                </ol>
              <?php } ?>
              <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
            </td>
          </tr>
        </table>
      </div>
    <?php } ?>
    </div>
  </div>
</body>
</html>