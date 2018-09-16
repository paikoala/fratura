<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $titulo1; ?></title>
		<meta name="author" content="PKWD">
		<meta name="description" content="Rock em Foz Do Iguaçu">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/fonte.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/style.css'); ?>">
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/caveira2.png'); ?>"> <!-- Icone da pagina -->
		<script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-85542157-1', 'auto');
  			ga('send', 'pageview');
		</script> <!-- Script Google Analytics -->
	</head>

	<body>
	<div class="principal">
		<header class="logo">FRATURA EXPOSTA</header>
		<nav>
			<ul>
				<li onclick="parent.location='<?php echo base_url(''); ?>'">INICIO</li>
				<li onclick="parent.location='<?php echo base_url('origem'); ?>'">ORIGEM</li>
				<li onclick="parent.location='<?php echo base_url('dicas'); ?>'">DICAS</li>
				<li onclick="parent.location='<?php echo base_url('contato'); ?>'">CONTATO</li>
				<li onclick="parent.location='<?php echo base_url('galeria'); ?>'">GALERIA</li>
			</ul>
		</nav>