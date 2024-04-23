<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; vertical-align: top; }
</style>
<body style="color: #000;">
  <div style="color: #000;">
    <div class="row">
      <div class="col-md-12">
        <?php 
          if($materi->jenis_materi == 1){ $a = "Dasar"; }
          else if($materi->jenis_materi == 2){ $a = "Inti";}
          else if($materi->jenis_materi == 3){ $a = "Penunjang"; }

          $cek = $this->M_entitas->selectX('materi', array('jenis_materi' => $materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

          $id_materi = array();
          foreach ($cek as $key)
          {
            $id_materi[] = $key->id_materi;
          }

          $get_indeks = array_search($materi->id_materi, $id_materi);
          $no = $get_indeks+1;
        ?>
        <table width="100%">
          <tr>
            <td><b>Mata Pelatihan <?= $a." ".$no; ?></b></td>
          </tr>
          <tr>
            <td><b><?= $materi->materi; ?></b></td>
          </tr>
        </table>
        <br>
        <table width="100%">
          <tr>
            <td style="text-align: center;">
              <h5 style="font-size: 18px;">
                <b>
                  Panduan <?= $metode_materi->metode; ?>
                </b>
              </h5>
            </td>
          </tr>
        </table>
        <table width="100%">
          <tr>
            <td><b><u>Indikator Hasil Belajar:</u></b></td>
          </tr>
          <tr>
            <td>
              <?php if($indikator){ ?>
                Setelah mengikuti mata pelatihan ini, peserta mampu:<br>
                <ol style="margin-bottom: 0px !important">
                  <?php 
                    foreach ($indikator as $key) 
                    {
                      echo "<li>".$key->indikator_hasil_belajar."</li>";
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
              <?php if($media){ ?>
                <ol style="margin-bottom: 0px !important">
                  <?php 
                    foreach ($media as $key) 
                    {
                      echo "<li>".$key->media_alat_bantu."</li>";
                    }
                    if($media_tambahan)
                    {
                      foreach ($media_tambahan as $key) 
                      {
                        echo "<li>".$key->media_alat_bantu."</li>";
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
                $jpl = $materi->p;
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
              <?php if($petunjuk){ ?>
                <ol>
                  <?php foreach ($petunjuk as $key) { ?>
                    <li><?= $key->petunjuk_panduan_penugasan; ?></li>
                  <?php } ?>
                </ol>
              <?php } ?>
              <?php if(!$petunjuk){ echo "Belum ada petunjuk"; } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>