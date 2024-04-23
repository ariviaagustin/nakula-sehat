<!DOCTYPE html>
<html>
<style type="text/css">
  h3{ font-family: Verdana, sans-serif; font-size: 14pt; font-weight: bold; text-align: center; }
  h4{ font-family: Verdana, sans-serif; font-size: 12pt; font-weight: bold; }
  .isi{ font-family: Verdana, sans-serif; font-size: 11pt; text-align: justify; font-weight:100; margin-top:5%; }
  th{ text-align:center; font-weight:bold; }
</style>
<body style="color: #000;">
  <?php if($kata_pengantar){ ?>
    <h3>Kata Pengantar</h3><br>
    <p class="isi"><?= $kata_pengantar->kata_pengantar; ?></p>
    <table width="100%">
      <tr>
        <td colspan="2"><br><br><br></td>
      </tr>
      <tr>
        <td style="width: 60%;"></td>
        <td class="isi" style="text-align: center; width: 40%;"><?= $kata_pengantar->kota.", ".tanggal_indo($kata_pengantar->tgl_kata_pengantar); ?></td>
      </tr>
      <tr>
        <td colspan="2"><br></td>
      </tr>
      <tr>
        <td></td>
        <td class="isi" style="text-align: center;"><?= $kata_pengantar->jabatan_ttd; ?></td>
      </tr>
      <tr>
        <td colspan="2"><br><br><br><br><br><br></td>
      </tr>
      <tr>
        <td></td>
        <td class="isi" style="text-align: center;"><?= $kata_pengantar->nama_ttd; ?></td>
      </tr>
    </table>
    <p style="page-break-before: always"></p>
  <?php } ?>
<!--   <?php if($kurikulum->status > 9){ ?>
    <h3>DAFTAR ISI</h3><br><br>
    <table width="100%" cellpadding="10px">
      <tr>
        <td class="isi" style="width: 90%;"><b>KATA PENGANTAR</b></td>
        <td class="isi" style="text-align: right; width: 10%;">i</td>
      </tr>
      <tr>
        <td class="isi" style="font-weight: bold;">DAFTAR ISI</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($kata_pengantar->kata_pengantar);
            if($jmlh_kata < 3000){ echo "ii"; }
            else { echo "iii"; }
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi" style="font-weight: bold;">BAB I PENDAHULUAN</td>
        <td class="isi" style="text-align: right;">1</td>
      </tr>
      <tr>
        <td class="isi" style="font-weight: bold;">BAB II KOMPONEN KURIKULUM</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($bab_satu_pendahuluan);
            if($jmlh_kata < 3000){ $hal_bab_2 = "2"; }
            else { $hal_bab_2 =  "3"; }
            echo $hal_bab_2;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Tujuan</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($bab_satu_pendahuluan);
            if($jmlh_kata < 3000){ $hal_tujuan = "2"; }
            else { $hal_tujuan = "3"; }
            echo $hal_tujuan;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Kompetensi</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($tujuan);
            if($jmlh_kata < 3000)
            { 
              $hal_kompetensi = $hal_tujuan;
            }
            else 
            { 
              $hal_kompetensi = $hal_tujuan + 1; 
            }
            echo $hal_kompetensi;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Struktur Kurikulum</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jml_kompetensi = 0;
            foreach ($isi_kompetensi as $key) 
            {
              $jml_kompetensi += strlen($key->isi_kompetensi);
            }

            if($jml_kompetensi < 3000)
            { 
              $hal_struktur_kurikulum = $hal_kompetensi;
            }
            else 
            { 
              $hal_struktur_kurikulum = $hal_kompetensi + 1; 
            }
            echo $hal_struktur_kurikulum;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D. Evaluasi Hasil Belajar</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jumlah_materi = count($materi);
            if($jumlah_materi < 12)
            { 
              $hal_evaluasi_hasil_belajar = $hal_struktur_kurikulum;
            }
            else 
            { 
              $hal_evaluasi_hasil_belajar = $hal_struktur_kurikulum + 1; 
            }
            echo $hal_evaluasi_hasil_belajar;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi" style="font-weight: bold;">BAB III DIAGRAM ALUR PROSES PELATIHAN</td>
        <td class="isi" style="text-align: right;">
          <?php echo $hal_bab_tiga = $hal_evaluasi_hasil_belajar + 1; ?>
        </td>
      </tr>
      <tr>
        <td class="isi" style="font-weight: bold;">LAMPIRAN:</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($diagram->keterangan);
            if($jmlh_kata < 3000)
            { 
              $hal_lampiran = $hal_bab_tiga + 1;
            }
            else 
            { 
              $hal_lampiran = $hal_bab_tiga + 2; 
            }
            echo $hal_lampiran;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">1. Rancang Bangun Pembelajaran Mata Pelatihan (RBPMP)</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jmlh_kata = strlen($diagram->keterangan);
            if($jmlh_kata < 3000)
            { 
              $hal_rbpmp = $hal_bab_tiga + 1;
            }
            else 
            { 
              $hal_rbpmp = $hal_bab_tiga + 2; 
            }
            echo $hal_rbpmp;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">2. Master Jadwal</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jumlah_materi = count($materi);
            echo $hal_master_jadwal = $hal_rbpmp + $jumlah_materi;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">3. Panduan Penugasan</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jumlah_master_jadwal = count($master_jadwal);
            if($jumlah_master_jadwal <= 10)
            {
              $hal_panduan_penugasan = $hal_master_jadwal + 1;
            }
            else
            {
              for ($i=$hal_master_jadwal; $i <= $jumlah_master_jadwal; $i=$i+10) 
              {
                echo $hal_panduan_penugasan += 1; 
              }
              $hal_panduan_penugasan = $hal_panduan_penugasan;
            }
            echo $hal_panduan_penugasan;
          ?>
        </td>
      </tr>
      <tr>
        <td class="isi">4. Ketentuan Penyelenggaraan Pelatihan</td>
        <td class="isi" style="text-align: right;">
          <?php
            $jumlah_metode_materi = count($metode_materi);
            $hal_ketentuan_penyelenggara_pelatihan = $hal_panduan_penugasan + $jumlah_metode_materi;
            if($metode_praktik_lapang)
            { 
              $hal_ketentuan_penyelenggara_pelatihan += 1;
            }
            echo $hal_ketentuan_penyelenggara_pelatihan;
          ?>
        </td>
      </tr>
    </table>
    <p style="page-break-before: always"></p>
  <?php } ?> -->
  <h3>BAB I</h3>
  <h3>Pendahuluan</h3>
  <table width="100%">
    <tr><td colspan="2"></td></tr>
    <tr>
      <td style="width: 5%;"><h4>A.</h4></td>
      <td style="width: 95%;"><h4>Latar Belakang</h4></td>
    </tr>
    <tr>
      <td></td>
      <td class = "isi"><?php if($bab_satu_pendahuluan){ echo $bab_satu_pendahuluan; } ?></td>
    </tr>
  </table>
  <p style="page-break-before: always"></p>
  <h3>BAB II</h3>
  <h3>Komponen Kurikulum</h3>
  <table width="100%">
    <tr><td colspan="2"><br></td></tr>
    <tr>
      <td style="width: 5%;"><h4>a.</h4></td>
      <td style="width: 95%;"><h4>Tujuan</h4></td>
    </tr>
    <tr>
      <td></td>
      <td class = "isi"><?php if($tujuan){ echo $tujuan; } ?></td>
    </tr>
    <tr><td colspan="2"><br></td></tr>
    <tr>
      <td style="width: 5%;"><h4>b.</h4></td>
      <td style="width: 95%;"><h4>Kompetensi</h4></td>
    </tr>
    <tr>
      <td></td>
      <td class = "isi"><?php if($kompetensi){ echo $kompetensi; } ?></td>
    </tr>
    <tr>
      <td></td>
      <td class="isi">
        <?php 
          if($isi_kompetensi)
          {
            echo "<ol>";
            foreach ($isi_kompetensi as $key) 
            {
              echo "<li>".$key->isi_kompetensi."</li>";
            }
            echo "</ol>";
          }
        ?>
      </td>
    </tr>
    <tr><td colspan="2"><br><br></td></tr>
    <tr>
      <td style="width: 5%;"><h4>c.</h4></td>
      <td style="width: 95%;"><h4>Struktur Kurikulum</h4></td>
    </tr>
    <?php if($materi_dasar || $materi_inti || $materi_penunjang){ ?>
      <tr><td colspan="2"><br></td></tr>
      <tr>
        <td></td>
        <td class="isi">
          <table border="1" width="100%" style="padding: 5px;">
            <tr>
              <th rowspan="2" style="width: 8%;">No</th>
              <th rowspan="2" style="width: 52%;">Materi</th>
              <th colspan="3" style="width: 30%;">Waktu</th>
              <th rowspan="2" style="width: 10%;">JPL</th>
            </tr>
            <tr>
              <th style="width: 10%;">T</th>
              <th style="width: 10%;">P</th>
              <th style="width: 10%;">PL</th>
            </tr>
            <tr>
              <td style="text-align: center;"><b>A.</b></td>
              <td colspan="5"><b>MATA PELATIHAN DASAR</b></td>
            </tr>
            <?php $no = 1; $t_d = 0; $p_d = 0; $pl_d = 0; $tot_jpl_d = 0; foreach ($materi_dasar as $key) { $t_d += $key->t; $p_d += $key->p; $pl_d += $key->pl; ?>
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
            <tr>
              <td style="text-align: center;"><b>B.</b></td>
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
            <tr>
              <td style="text-align: center;"><b>C.</b></td>
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
          </table>
        </td>
      </tr>
      <tr><td colspan="2"><br></td></tr>
      <tr>
        <td></td>
        <td class="isi"><p>Keterangan:</p></td>
      </tr>
      <tr>
        <td></td>
        <td class="isi">
          <ul style="margin-left: 0px;">
            <li>T = teori</li>
            <li>P = penugasan (studi kasus, latihan, dll)</li>
            <li>PL = praktek lapangan/observasi lapangan</li>
            <li>1 JPL (jam pelajaran) teori atau penugasan = 45 menit</li>
            <li>1 JPL (jam pelajaran) praktek lapangan/observasi lapangan = 60 menit</li>
            <li>Untuk mata pelatihan dengan praktek lapangan/observasi lapangan dilaksanakan dengan instruktur 1 orang setiap kelas.</li>
          </ul>
        </td>
      </tr>
    <?php } ?>
    <tr><td><br></td></tr>
    <tr>
      <td style="width: 5%;"><h4>d.</h4></td>
      <td style="width: 95%;"><h4>Evaluasi Hasil Belajar</h4></td>
    </tr>
    <tr>
      <td></td>
      <td class = "isi"><?php if($evaluasi_hasil_belajar){ echo $evaluasi_hasil_belajar; } ?></td>
    </tr>
    <tr>
      <td></td>
      <td class="isi">
        <?php 
          if($isi_evaluasi_hasil_belajar)
          {
            echo "<ol>";
            foreach ($isi_evaluasi_hasil_belajar as $key) 
            {
              echo "<li>".$key->isi_evaluasi_hasil_belajar."</li>";
            }
            echo "</ol>";
          }
        ?>
      </td>
    </tr>
  </table>
  <p style="page-break-before: always"></p>
  <h3>BAB III</h3>
  <h3>Diagram alur proses pelatihan</h3>
  <?php if($diagram){ ?>
    <table width="100%">
      <tr>
        <td><br><br></td>
      </tr>
      <tr>
        <td style="width: 100%; text-align: center;">
          <img src="<?= (FCPATH.'agenda/perdata/diagram_alur_proses_pelatihan/'.$diagram->diagram_alur_proses_pelatihan); ?>">
        </td>
      </tr>
    </table>
    <p class="isi"><?= $diagram->keterangan; ?></p>
  <?php } ?>
</body>
</html>
<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
  $hari = array ( 1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
);

  $bulan = array (1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
}
return $tgl_indo;
}
?>