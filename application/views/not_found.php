<head>
		<title><?php echo $this->uri->segment(2) ;?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo agenda_url('images/icon1.png');?>" type="image/x-icon"/>
			<link type="text/css" href="<?php echo agenda_url('css/bootstrap.min.css');?>" rel="stylesheet"/>
			<link rel="stylesheet" type="text/css" href="<?php echo agenda_url('css/font-awesome.min.css');?>"/>
			<link rel="stylesheet" type="text/css" href="<?php echo agenda_url('css/ionicons.min.css');?>"/>
			<link rel="stylesheet" type="text/css" href="<?php echo agenda_url('css/animate.min.css');?>">					
			<link rel="stylesheet" type="text/css" href="<?PHP echo agenda_url( 'css/simplify.min.css');?>" />	
			
			<!-- JS -->
			<script type="text/javascript" src="<?php echo agenda_url('js/jquery-1.11.1.min.js');?>"></script>
			<script type="text/javascript" src="<?php echo agenda_url('js/bootstrap.min.js');?>"></script>		
			<script type="text/javascript" src="<?PHP echo agenda_url('js/jquery.slimscroll.min.js');?>"></script>
			<script type="text/javascript" src="<?PHP echo agenda_url('js/jquery.popupoverlay.min.js');?>"></script>
			<script type="text/javascript" src="<?PHP echo agenda_url('js/modernizr.min.js');?>"></script>
			<script type="text/javascript" src="<?PHP echo agenda_url('js/simplify/simplify.js');?>"></script>
				
	</head>
	<body class="overflow-hidden light-background">
		<div class="wrapper no-navigation preload">
			<div class="error-wrapper">
				<div class="error-inner">
					<div class="error-type">404</div>
					<h1>Page Not Found</h1>
					<p>Look like the page you're looking for isn't here anymore.
						Try typing the address again or start over from the home page.</p>
					<div class="m-top-md">
						<a href="<?php echo site_url();?>" class="btn btn-default btn-lg text-upper">Back to Home</a>
					</div>
				</div><!-- ./error-inner -->
			</div><!-- ./error-wrapper -->
		</div><!-- /wrapper -->
	</body>
<script type="text/javascript">
	$(function()	{
		setTimeout(function() {
			$('.error-type').addClass('animated');
		},100);
	});
</script>
	