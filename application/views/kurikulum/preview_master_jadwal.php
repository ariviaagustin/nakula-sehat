<!DOCTYPE html>
<html>
<style type="text/css">
  h3{ font-family: Verdana, sans-serif; font-size: 14pt; font-weight: bold; text-align: center; }
  h4{ font-family: Verdana, sans-serif; font-size: 12pt; font-weight: bold; }
  .isi{ font-family: Verdana, sans-serif; font-size: 12pt; text-align: justify; font-weight:100; margin-top:5%; }
   .isi_jadwal{ font-family: Verdana, sans-serif; font-size: 10pt; text-align: justify; font-weight:100; margin-top:5%; }
  th{ text-align:center; font-weight:bold; }
  ul, ol, li{ margin-top: 0px; padding-top: 0px; padding-left: -10px; }
</style>
<body style="color: #000;">
  <h4 style="text-align: left;">LAMPIRAN 2. MASTER JADWAL PELATIHAN</h4>
  <br><br>
  <?php if($master_jadwal){ ?>
    <div class="row">
      <div class="col-12 col-md-12">
        <table width="100%" border="1" style="padding: 10px;">
            <tr>
              <th style="width: 10%; font-weight: bold; text-align: center;" class="isi_jadwal">Hari</th>
              <th style="width: 15%; font-weight: bold; text-align: center;" class="isi_jadwal">Waktu</th>
              <th style="width: 10%; font-weight: bold; text-align: center;" class="isi_jadwal">Alokasi Waktu</th>
              <th style="width: 10%; font-weight: bold; text-align: center;" class="isi_jadwal">JPL</th>
              <th style="width: 55%; font-weight: bold; text-align: center;" class="isi_jadwal">Mata Pelatihan</th>
            </tr>
          <tbody>
            <?php foreach ($master_jadwal as $key) { ?>
              <tr>
                <td style="text-align: center; width: 10%;" class="isi_jadwal"><?= $key->hari_ke; ?></td>
                <td style="text-align: center; width: 15%;" class="isi_jadwal"><?= date('H:i', strtotime($key->waktu_awal))." - ".date('H:i', strtotime($key->waktu_akhir)); ?></td>
                <td style="text-align: center; width: 10%" class="isi_jadwal">
                  <?php 
                    if($key->t_p_pl_materi == 1){ echo "T"; }
                    else if($key->t_p_pl_materi == 2){ echo "P"; }
                    else if($key->t_p_pl_materi == 3){ echo "PL"; }
                  ?>
                </td>
                <td style="text-align: center; width: 10%" class="isi_jadwal"><?= $key->jpl; ?></td>
                <td style="width: 55%;" class="isi_jadwal"><?= $key->mata_pelatihan; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>
</body>
</html>