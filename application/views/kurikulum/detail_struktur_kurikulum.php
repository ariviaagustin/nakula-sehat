<!DOCTYPE html>
<html>
<style type="text/css">
  td{ padding: 5px; border: 0px; vertical-align: top; }
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
    <?php if($kurikulum->kompetensi){ ?>
      <div class="row">
        <div class="col-12 col-md-12">
          <h5>c. Struktur Kurikulum</h5><br>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="background-color: lemonchiffon;">
                <th rowspan="2" style="width: 1%;">NO</th>
                <th rowspan="2" style="width: 45%;">MATERI</th>
                <th colspan="3">WAKTU</th>
                <th rowspan="2">JPL</th>
              </tr>
              <tr style="background-color: lemonchiffon;">
                <th style="width: 10%;">T</th>
                <th style="width: 10%;">P</th>
                <th style="width: 10%;">PL</th>
              </tr>
            </thead>
            <tbody>
              <tr style="background-color: #d8d8d8;">
                <td><b>A.</b></td>
                <td colspan="5"><b>MATA PELATIHAN DASAR</b></td>
              </tr>
              <?php $no = 1; $t_d = 0; $p_d = 0; $pl_d = 0; $tot_jpl_d = 0; foreach ($materi_dasar as $key) { $t_d += $key->t; $p_d += $key->p; $pl_d += $key->pl;  ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td style="text-align: center;"><?= $key->t; ?></td>
                  <td style="text-align: center;"><?= $key->p; ?></td>
                  <td style="text-align: center;"><?= $key->pl; ?></td>
                  <td style="text-align: center;">
                    <?php 
                      $jpl = $key->t + $key->p + $key->pl;
                      echo $jpl;
                      $tot_jpl_d += $jpl;
                    ?>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                <td style="text-align: center;"><b><?= $t_d; ?></b></td>
                <td style="text-align: center;"><b><?= $p_d; ?></b></td>
                <td style="text-align: center;"><b><?= $pl_d; ?></b></td>
                <td style="text-align: center;"><b><?= $tot_jpl_d; ?></b></td>
              </tr>
              <tr style="background-color: #d8d8d8;">
                <td><b>B.</b></td>
                <td colspan="5"><b>MATA PELATIHAN INTI</b></td>
              </tr>
              <?php $no = 1; $t_i = 0; $p_i = 0; $pl_i = 0; $tot_jpl_i = 0; foreach ($materi_inti as $key) { $t_i += $key->t; $p_i += $key->p; $pl_i += $key->pl; ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td style="text-align: center;"><?= $key->t; ?></td>
                  <td style="text-align: center;"><?= $key->p; ?></td>
                  <td style="text-align: center;"><?= $key->pl; ?></td>
                  <td style="text-align: center;">
                    <?php 
                      $jpl = $key->t + $key->p + $key->pl;
                      echo $jpl;
                      $tot_jpl_i += $jpl;
                    ?>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                <td style="text-align: center;"><b><?= $t_i; ?></b></td>
                <td style="text-align: center;"><b><?= $p_i; ?></b></td>
                <td style="text-align: center;"><b><?= $pl_i; ?></b></td>
                <td style="text-align: center;"><b><?= $tot_jpl_i; ?></b></td>
              </tr>
              <tr style="background-color: #d8d8d8;">
                <td><b>C.</b></td>
                <td colspan="5"><b>MATA PELATIHAN PENUNJANG</b></td>
              </tr>
              <?php $no = 1; $t_p = 0; $p_p = 0; $pl_p = 0; $tot_jpl_p = 0; foreach ($materi_penunjang as $key) { $t_p += $key->t; $pl_p += $key->p; $pl_p += $key->pl; ?>
                <tr>
                  <td style="text-align: center;"><?= $no++; ?></td>
                  <td><?= $key->materi; ?></td>
                  <td style="text-align: center;"><?= $key->t; ?></td>
                  <td style="text-align: center;"><?= $key->p; ?></td>
                  <td style="text-align: center;"><?= $key->pl; ?></td>
                  <td style="text-align: center;">
                    <?php 
                      $jpl = $key->t + $key->p + $key->pl;
                      echo $jpl;
                      $tot_jpl_p += $jpl;
                    ?>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2" style="text-align: right;"><b>Subtotal</b></td>
                <td style="text-align: center;"><b><?= $t_p; ?></b></td>
                <td style="text-align: center;"><b><?= $p_p; ?></b></td>
                <td style="text-align: center;"><b><?= $pl_p; ?></b></td>
                <td style="text-align: center;"><b><?= $tot_jpl_p; ?></b></td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;"><b>JUMLAH</b></td>
                <td style="text-align: center;">
                  <b>
                    <?php 
                      $jumlah_t = $t_d + $t_i + $t_p;
                      echo $jumlah_t;
                    ?>
                  </b>
                </td>
                <td style="text-align: center;">
                  <b>
                    <?php 
                      $jumlah_p = $p_d + $p_i + $p_p;
                      echo $jumlah_p;
                    ?>
                  </b>
                </td>
                <td style="text-align: center;">
                  <b>
                    <?php 
                      $jumlah_pl = $pl_d + $pl_i + $pl_p;
                      echo $jumlah_pl;
                    ?>
                  </b>
                </td>
                <td style="text-align: center;">
                  <b>
                    <?php 
                      $jumlah_total = $tot_jpl_d + $tot_jpl_i + $tot_jpl_p;
                      echo $jumlah_total;
                    ?>
                  </b>
                </td>
              </tr>
            </tbody>
          </table>
          <br>
          <div class="row">
            <div class="col-md-12">
              <p>
                Keterangan:<br>
                  • T = teori<br>
                  • P = penugasan (studi kasus, latihan, dll)<br>
                  • PL = praktek lapangan/observasi lapangan<br>
                  • 1 JPL (jam pelajaran) teori atau penugasan = 45 menit<br>
                  • 1 JPL (jam pelajaran) praktek lapangan/observasi lapangan = 60 menit<br>
                  • Untuk mata pelatihan dengan praktek lapangan/observasi lapangan dilaksanakan dengan instruktur 1 orang setiap kelas.<br>
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>