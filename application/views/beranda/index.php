<style type="text/css">
  .highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    margin: 1em auto;
  }

  .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }
  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }
  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }
  .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
  }
  .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }
  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
  .highcharts-stack-labels{ display: none; }
</style>
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-calendar fa-sm text-white-100"></i> <?= indonesian_date(date('Y-m-d')); ?></a>
  </div>
  <?php if($this->session->userdata('id_role') == 1){ ?>
    <div class="row">
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid blue!important;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-uppercase mb-1" style="color: blue;">Jumlah Institusi</div>
                <div class="h5 mb-0 font-weight-bold"><?= $this->M_entitas->selectSemua('institusi')->num_rows(); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-university fa-2x" style="color: blue;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid limegreen !important;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-uppercase mb-1" style="color: limegreen;">Jumlah SDM Institusi</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $this->M_entitas->selectSemua('sdm_institusi')->num_rows(); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x" style="color: limegreen;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid orange !important;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-uppercase mb-1" style="color: orange;">Jumlah Penilai</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold"><?= $this->M_entitas->selectSemua('penilai')->num_rows(); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-star fa-2x" style="color: orange;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-12">
        <figure class="highcharts-figure">
          <div id="jenis_pelatihan"></div>
        </figure>
      </div>
      <div class="col-xl-6 col-lg-12">
        <figure class="highcharts-figure">
          <div id="kategori_pelatihan"></div>
        </figure>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <figure class="highcharts-figure">
          <div id="status_kurikulum"></div>
        </figure>
      </div>
      <div class="col-md-12">
        <figure class="highcharts-figure">
          <div id="institusi_kurikulum"></div>
        </figure>
      </div>
    </div>
  <?php } ?>
</div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script type="text/javascript">
  Highcharts.chart('status_kurikulum', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Jumlah Kurikulum Berdasarkan Status Kurikulum',
      align: 'center'
    },
    xAxis: {
        categories: [
          'Dihentikan',
          'Pengajuan Pengembangan Kompetensi', 
          'Verifikasi Ketersediaan Kurikulum', 
          'Proses Pengisian Kurikulum', 
          'Proses Pengecekan Kesesuaian',
          'Perbaikan Kesesuaian',
          'Proses Pemilihan Penilai',
          'Proses Penilaian',
          'Proses Perbaikan Kurikulum',
          'Upload Cover dan Kata Pengantar',
          'Pengesahan Kurikulum',
          'Selesai',
          'Kurikulum Telah Dikirim ke Siakpel'
        ],
        crosshair: true,
        accessibility: {
            description: 'Status'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Kurikulum'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
          name: 'Kurikulum',
          data: <?= $get_kurikulum_status; ?>
        }
    ]
  });
</script>
<script type="text/javascript">
  Highcharts.chart('jenis_pelatihan', 
  {
    chart: {
      type: 'pie'
    },
    title: {
      text: 'Jumlah Kurikulum Berdasarkan Jenis Pelatihan'
    },
    accessibility: {
      announceNewData: {
        enabled: true
      },
      point: {
        valueSuffix: ''
      }
    },
    plotOptions: {
      series: {
        dataLabels: {
          enabled: true,
          format: '{point.name}: {point.y:.f}'
        }
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b><br/>'
    },
    series: [{
      name: "Kurikulum per Jenis Pelatihan",
      colorByPoint: true,
      data: [<?php foreach ($jenis_pelatihan as $key) { ?> {
        name: "<?= $key->jenis_pelatihan_name; ?>",
        y: <?= $this->M_entitas->selectX('kurikulum', array('jenis_pelatihan_id' => $key->jenis_pelatihan_id))->num_rows(); ?>
      },
      <?php } ?>
    ]}
  ]});
</script>
<script type="text/javascript">
  Highcharts.chart('kategori_pelatihan', 
  {
    chart: {
      type: 'pie'
    },
    title: {
      text: 'Jumlah Kurikulum Per Kategori Pelatihan'
    },
    accessibility: {
      announceNewData: {
        enabled: true
      },
      point: {
        valueSuffix: ''
      }
    },
    plotOptions: {
      series: {
        dataLabels: {
          enabled: true,
          format: '{point.name}: {point.y:.f}'
        }
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b><br/>'
    },
    series: [{
      name: "Kurikulum Berdasarkan Kategori Pelatihan",
      colorByPoint: true,
      data: [<?php foreach ($kategori_pelatihan as $key) { ?> {
        name: "<?= $key->kategori_pelatihan_name; ?>",
        y: <?= $this->M_entitas->selectX('kurikulum', array('kategori_pelatihan_id' => $key->kategori_pelatihan_id))->num_rows(); ?>
      },
      <?php } ?>
    ]}
  ]});
</script>
<script type="text/javascript">
  Highcharts.chart('institusi_kurikulum', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Jumlah Institusi Yang Mengajukan Kurikulum',
      align: 'center'
    },
    xAxis: {
        categories: <?= $get_nama_institusi_kurikulum; ?>,
        crosshair: true,
        accessibility: {
            description: 'Institusi'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Kurikulum'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
          name: 'Kurikulum',
          data: <?= $get_jumlah_kurikulum_institusi; ?>
        }
    ]
  });
</script>
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