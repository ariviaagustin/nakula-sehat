<html>
  <head>
    <style type="text/css">
      th{ text-align: center; padding: 8px; }
      td{ padding: 8px; }
    </style>
  </head>
  <body>
    <div style="padding: 10px;">
      <?php if($riwayat){ ?>
        <table border="1" width="100%">
          <tr>
            <th>No</th>
            <th>Tanggal Revisi</th>
            <th>Revisi</th>
          </tr>
          <?php $no = 1; foreach ($riwayat as $key) { ?>
            <tr>
              <td style="text-align: center; vertical-align: top"><?= $no++; ?>.</td>
              <td style="vertical-align: top"><?= indonesian_date($key->waktu_revisi); ?></td>
              <td><?= $key->isi_revisi; ?></td>
            </tr>
          <?php } ?>
        </table>
      <?php } ?>
      <?php if(!$riwayat){ ?>
        <table border="1" width="100%">
          <tr>
            <th>No</th>
            <th>Tanggal Revisi</th>
            <th>Revisi</th>
          </tr>
          <tr>
            <td colspan="3" style="text-align: center;">Tidak ada data</td>
          </tr>
        </table>
      <?php } ?>
    </div>
  </body>
</html>
<?php
  function indonesian_date ($timestamp = '', $date_format = 'd F Y ', $suffix = '') 
  {
    //$timestamp = '', $date_format = 'l, d F Y | H:i', $suffix = 'WIB'
    if (trim ($timestamp) == ''){ $timestamp = time (); }
    elseif (!ctype_digit ($timestamp)){ $timestamp = strtotime ($timestamp); }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
      '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
      '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
      '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
      '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
      '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
      '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
      '/April/','/June/','/July/','/August/','/September/','/October/',
      '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
      'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
      'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
      'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
      'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
  }
?>