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
  <h4 style="text-align: left;">LAMPIRAN 3. PANDUAN PENUGASAN</h4>
  <br><br>
  <?php if($metode_materi){ ?>
    <?php $jumlah_metode_materi = count($metode_materi); ?>
    <?php $abc = 1; foreach ($metode_materi as $key) { ?>
      <?php
        $get_materi = $this->M_entitas->selectX('materi', array('id_materi' => $key->id_materi))->row();
        $get_indikator = $this->M_entitas->selectX('indikator_hasil_belajar', array('id_materi' => $key->id_materi))->result();
        $get_media = $this->M_entitas->selectX('entitas__media_alat_bantu', array('id_metode' => $key->id_metode))->result();
        $get_petunjuk = $this->M_entitas->selectX('petunjuk_panduan_penugasan', array('id_metode_materi' => $key->id_metode_materi))->result();

        if($get_materi->jenis_materi == 1){ $a = "Dasar"; }
        else if($get_materi->jenis_materi == 2){ $a = "Inti";}
        else if($get_materi->jenis_materi == 3){ $a = "Penunjang"; }

        $cek = $this->M_entitas->selectX('materi', array('jenis_materi' => $get_materi->jenis_materi, 'id_kurikulum' => $kurikulum->id_kurikulum))->result();

        $id_materi = array();
        foreach ($cek as $c)
        {
          $id_materi[] = $c->id_materi;
        }

        $get_indeks = array_search($get_materi->id_materi, $id_materi);
        $no = $get_indeks+1;
      ?>
      <table width="100%" style="padding: 5px;">
        <tr>
          <td class="isi"><b>Mata Pelatihan <?= $a." ".$no; ?></b></td>
        </tr>
        <tr>
          <td class="isi"><b><?= $get_materi->materi; ?></b></td>
        </tr>
      </table>
      <br><br><br>
      <table width="100%">
        <tr>
          <td style="text-align: center;"><h4>PANDUAN <?= strtoupper($key->metode); ?></h4></td>
        </tr>
      </table>
      <br><br><br>
      <table width="100%" style="padding: 5px;">
        <tr>
          <td class="isi"><b><u>Indikator Hasil Belajar:</u></b></td>
        </tr>
        <tr>
          <td class="isi">
            <?php if($get_indikator){ ?>
              Setelah mengikuti mata pelatihan ini, peserta mampu:
              <ol style="margin-bottom: 0px !important">
                <?php 
                  foreach ($get_indikator as $gi) 
                  {
                    echo "<li>".$gi->indikator_hasil_belajar."</li>";
                  }
                ?>
              </ol>
            <?php } ?>
          </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
          <td class="isi"><b><u>Alat dan Bahan:</u></b></td>
        </tr>
        <tr>
          <td class="isi">
            <?php if($get_media){ ?>
              <ol style="margin-bottom: 0px !important">
                <?php 
                  foreach ($get_media as $gm) 
                  {
                    echo "<li>".$gm->media_alat_bantu."</li>";
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
        <tr><td><br></td></tr>
        <tr>
          <td class="isi">
            <b><u>Waktu:</u></b>
            <?php 
              $jpl = $get_materi->p;
              $total_jpl = $jpl * 45;
              echo $jpl." JPL x 45 menit = ".$total_jpl." menit";
            ?>
          </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
          <td class="isi"><b><u>Petunjuk:</u></b></td>
        </tr>
        <tr>
          <td class="isi">
            <?php if($get_petunjuk){ ?>
              <ol>
                <?php foreach ($get_petunjuk as $gp) { ?>
                  <li><?= $gp->petunjuk_panduan_penugasan; ?></li>
                <?php } ?>
              </ol>
            <?php } ?>
            <?php if(!$get_petunjuk){ echo "Belum ada petunjuk"; } ?>
          </td>
        </tr>
      </table>
      <?php if($abc < $jumlah_metode_materi){ ?>
        <p style="page-break-before: always"></p>
      <?php } ?>
    <?php $abc++; } ?>
  <?php } ?>
  <?php if($metode_praktik_lapang){ ?>
    <p style="page-break-before: always"></p>
    <table width="100%">
      <tr>
        <td style="text-align: center;"><h4>PANDUAN PRAKTIK LAPANG</h4></td>
      </tr>
    </table>
    <br><br><br>
    <table width="100%" style="padding: 5px;">
      <tr>
        <td class="isi">
          <b><u>Waktu:</u></b>
          <?php 
            $get_materi_pl = $this->M_view->get_all_materi_pl($kurikulum->id_kurikulum)->result();

            $get_jpl = 0;
            foreach ($get_materi_pl as $gmpl) 
            {
              $get_jpl += $gmpl->pl;
            }
            $jpl = $get_jpl; 
            $total_jpl = $jpl * 60;
            echo $jpl." JPL x 60 menit = ".$total_jpl." menit";
          ?>
        </td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td class="isi"><b><u>Petunjuk:</u></b></td>
      </tr>
      <tr>
        <td class="isi">
          <?php $panduan_praktik_lapang = $this->M_entitas->selectX('panduan_praktik_lapang', array('id_kurikulum' => $kurikulum->id_kurikulum))->result(); ?>
          <?php if($panduan_praktik_lapang){ ?>
            <ol>
              <?php foreach ($panduan_praktik_lapang as $ppl) { ?>
                <li><?= $ppl->panduan_penugasan; ?></li>
              <?php } ?>
            </ol>
          <?php } ?>
          <?php if(!$panduan_praktik_lapang){ echo "Belum ada petunjuk"; } ?>
        </td>
      </tr>
    </table>
  <?php } ?>
</body>
</html>