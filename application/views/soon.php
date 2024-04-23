<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>TITLE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	
	
	<!-- Font -->
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CPoppins:400,500" rel="stylesheet">
	
	
	<link href="<?= base_url(); ?>agenda/soon/common-css/ionicons.css" rel="stylesheet">
	
	
	<link rel="stylesheet" href="<?= base_url(); ?>agenda/soon/common-css/jquery.classycountdown.css" />
		
	<link href="<?= base_url(); ?>agenda/soon/css/styles.css" rel="stylesheet">
	
	<link href="<?= base_url(); ?>agenda/soon/css/responsive.css" rel="stylesheet">
	<style type="text/css">
		.main-area:after {
    background: linear-gradient(-9deg, #ffffff 0%, #ffffff 40%, #ffffff 100%);
}
	</style>
</head>
<body>
	
	<div class="main-area center-text" style="background-image:url(<?= base_url(); ?>agenda/soon/images/bg_2.jpg); margin-top: -50px" >
		
		<div class="display-table">
			<div class="display-table-cell">
				
				<h1 class="title"><b style="color: #000000">Comming Soon</b></h1>
				<!-- <p class="desc font-white">Our website is currently undergoing scheduled maintenance.
					We Should be back shortly. Thank you for your patience.</p> -->
				
				<div class="email-input-area">
					<!-- <form method="post"> -->
						<!-- <input class="email-input" name="email" type="text" placeholder="Enter your email"/> -->
						<a href="<?= site_url(); ?>" style = "background-color: blue; padding: 15px; border-radius: 20px"><b>Kembali ke halaman Utama</b></a>
					<!-- </form> -->
				</div><!-- email-input-area -->
							
				<!-- <div id="normal-countdown" data-date="2018/01/01"></div>
				
				<ul class="social-btn">
					<li class="list-heading">Follow us for update</li>
					<li><a href="#"><i class="ion-social-facebook"></i></a></li>
					<li><a href="#"><i class="ion-social-twitter"></i></a></li>
					<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
					<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
					<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
				</ul> -->
				
			</div><!-- display-table -->
		</div><!-- display-table-cell -->
	</div><!-- main-area -->
	
	
	<!-- SCIPTS -->
	
	<script src="<?= base_url(); ?>agenda/soon/common-js/jquery-3.1.1.min.js"></script>
	
	<script src="<?= base_url(); ?>agenda/soon/common-js/jquery.countdown.min.js"></script>
	
	<script src="<?= base_url(); ?>agenda/soon/common-js/scripts.js"></script>
	
</body>
</html>