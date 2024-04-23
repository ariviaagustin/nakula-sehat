<style type="text/css">
    th{ width: 20%; }
    th, td{ padding: 15px; border-bottom: 1px solid #e5e5e5; }
</style>
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-book"></i> Panduan</h1>
  <br>
  <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body" style="color: #000">
            <div class="card-body card-block">
                <center>
                    <h4>Panduan <?= $panduan->bagian_kurikulum; ?> Tahun <?= $panduan->tahun; ?></h4>
                    <span><?php if($panduan->status == 1){ echo "Aktif"; } else { echo "Tidak Aktif"; } ?></span>
                </center>
                <br>
                <?= $panduan->isi_panduan; ?>
            </div>
        </div>
    </div>
</div>
</div>