<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
    $get_logo = $this->M_entitas->selectSemua('logo')->row(); 
    $logo = $get_logo->logo;    
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="APLIKASI SIMDIKLAT KEMENTERIAN KESEHATAN RI">
  <meta name="keywords" content="Nakula Sehat">
  <meta name="author" content="">

  <title>Nakula Sehat - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>agenda/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link rel="icon" href="<?= base_url('agenda/perdata/bg/'.$logo); ?>">
  <link href="<?= base_url(); ?>agenda/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css">
    body
    {
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body style="background-image: url('<?= base_url('agenda/perdata/bg/bg_3.jpg'); ?>');">
  <!-- <div class="bg-image"></div> -->
  <!-- <div class="bg-text"> -->
    <div class="container" style="margin-top: 2%;">
      <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div style="padding: 15px 35px; text-align: center;">
                    <a href="<?= site_url(); ?>">
                      <img src="<?= base_url('agenda/perdata/bg/'.$logo); ?>" style = "width: 30%;">
                    </a>
                  </div>
                  <hr style="margin-top: 0px">
                </div>
                <div class="col-lg-6" style="text-align: center;">
                  <img src="<?= base_url('agenda/perdata/bg/coba_bg.png'); ?>" style = "width: 85%; margin-top: -3%;">
                </div>
                <div class="col-lg-6">
                  <div style="padding: 0px 3rem 3rem">
                    <div class="text-center">
                      <br>
                      <h1 class="h4 text-gray-900 mb-4" style="color: #32BACF !important"><b>SIGN IN</b></h1>
                    </div>
                    <br>
                    <?php if($this->session->flashdata("msg")){ ?>
                      <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                        <span><?= $this->session->flashdata("msg"); ?></span>
                      </div>
                    <?php } ?>
                    <form action="<?= site_url('Login/aksi_login'); ?>" method = "post">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" placeholder="Username" name="username">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                      </div>
                      <div class="form-group">
                        <?= $script; ?>
                        <?= $widget; ?>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    </form>
                  </div>
                </div>
                <div class="col-lg-12" style="border-top: 1px solid rgba(0,0,0,.1);">
                  <p style="text-align: center; margin-top: 10px; font-size: 11px; margin-bottom: 5px">Copyright &copy; Nakula Sehat <?= date('Y'); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url(); ?>agenda/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>agenda/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url(); ?>agenda/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url(); ?>agenda/admin/js/sb-admin-2.min.js"></script>

  <script>
    function goBack() { window.history.back(); }
 </script>
</body>
<!-- <div style="z-index: 1; bottom: 0; margin-bottom: 0; width: 100%; position: fixed;">
  <footer style="background-color: #fff;">
    <div class="container" style="padding: 12px;">
      <div class="row">
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="<?= site_url(''); ?>">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/home.png'); ?>" style = "width: 20%;">
              </div>
            </div>
          </a>
        </div>
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="<?= site_url(''); ?>">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/pengajuan.png'); ?>" style = "width: 20%;">
              </div>
            </div>
          </a>
        </div>
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="<?= site_url(''); ?>">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/instansi.png'); ?>" style = "width: 20%;">
              </div>
            </div>
          </a>
        </div>
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="<?= site_url('Login/penilai'); ?>">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/penilai_2.png'); ?>" style = "width: 25%;">
              </div>
            </div>
          </a>
        </div>
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="<?= site_url('Login/login'); ?>">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/login.png'); ?>" style = "width: 20%;">
              </div>
            </div>
          </a>
        </div>
        <div class="col-2 col-md-2 col-xl-2 col-lg-2" style="text-align: center;">
          <a href="#" onclick="goBack()">
            <div class="row">
              <div class="col-md-12 col-xs-2">
                <img src="<?= base_url('agenda/perdata/bg/back.png'); ?>" style = "width: 20%;">
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </footer>
</div> -->

</html>
