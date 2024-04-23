<html>
  <head>
    <style type="text/css">
      .space{ margin-bottom: 20px; }
      a.disabled {
        pointer-events: none;
        cursor: default;
        opacity: .65;
      }
    </style>
  </head>
  <body style="color: #000">
    <div class="row">
      <div class="col-md-12">
        <p style="padding: 5px; color: #000">
          <?php 
            if($bagian == 0){ echo $pengajuan->catatan; }
            else if($bagian > 0){ echo $get_bagian->catatan;}
          ?>
        </p>
      </div>
    </div>
    <?php if($this->session->userdata('role') == 4){ ?>
      <?php if($is_pmbg == 0){ ?>
        <hr>
        <div class="row">
          <div class="col-md-12" style="text-align: center;">
            <?php if($bagian == 0){ ?>
              <?php if($pengajuan->status_judul == 0){ ?>
                <a href="<?= site_url('forum-diskusi/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0))); ?>" class="btn btn-info"><i class="fa fa-comments" aria-hidden="true"></i> Diskusikan</a>
              <?php } ?>
            <?php } ?>
            <?php if($bagian > 0){ ?>
              <?php if(date('Y-m-d') >= $jadwal->waktu_mulai && date('Y-m-d') <= $jadwal->waktu_selesai){ $d = ""; } else{ $d = "disabled"; } ?>
              <?php if($get_bagian->status == 0){ ?>
                <a href="<?= site_url('forum-diskusi/'.bin2hex(base64_encode($pengajuan->id_pengajuan)).'/'.bin2hex(base64_encode($bagian)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(0)).'/'.bin2hex(base64_encode(1)).'/'.bin2hex(base64_encode(0))); ?>" class="btn btn-info <?= $d; ?>"><i class="fa fa-comments" aria-hidden="true"></i> Diskusikan</a>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </body>
</html>