<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>COORDINATEUR</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url("assets/img/users.ico") ?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?= base_url("assets/font-awesome/css/font-awesome.css") ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssfonts/cssfonts-min.css">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<!--  <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>images/logo v.png" />
	 
	<link rel="stylesheet" type='text/css' href="<?=base_url()?>assets/css/font-awesome.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<link rel="stylesheet" type='text/css' href="<?=base_url()?>assets/css/bootstrap-theme.css">-->
	<link rel="stylesheet" type='text/css' href="<?=base_url()?>assets/css/style-responsive.css" >
	
	<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/css/theme.css'>
	<link rel="stylesheet" type='text/css' href="<?=base_url()?>assets/css/elegant-icons-style.css">
	
	<link rel="stylesheet" type='text/css' href="<?=base_url()?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type='text/css' href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link rel="stylesheet" type='text/css' href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" >

	<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/css/fullcalendar.css'>
	<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/css/fullcalendar.print.css'/>

	<script src=<?= base_url("assets/js/plugin/webfont/webfont.min.js") ?>>

	</script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["<?=base_url('assets/css/fonts.min.css')?>"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>">
	<?php if (isset($uri[1]) && ($uri[1] != 'authentification' || $uri[1] != 'authentification')) : ?>
		<link rel="stylesheet" href="<?= base_url("assets/css/atlantis.min.css") ?>">
		<link rel="stylesheet" href="<?= base_url("assets/css/demo.css") ?>">
	<?php else : ?>
		<link href="<?= base_url("assets/css/login.css") ?>" rel="stylesheet" type="text/css" />
	<?php endif ?>
</head>
<!-- <body data-background-color="dark"> -->

<body>