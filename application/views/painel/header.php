<!DOCTYPE HTML>
<html lang="pt-br">
	<head> 
		<meta charset="UTF-8">
		<title><?php echo $titulo1; ?></title>
		<meta name="author" content="PKWD">
		<meta name="description" content="Rock em Foz Do Iguaçu">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/fonte.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/style.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/painel.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/jquery-te-1.4.0.css'); ?>">
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-te-1.4.0.min.js'); ?>"></script>
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/caveira2.png'); ?>"> <!-- Icone da pagina --> 
	</head>

	<body>
	<div class="principal">
		<header class="logo">Painel Fraturado</header>
		<nav>
			<ul>
				<li onclick="window.open('<?php echo base_url(" "); ?>', '_blank')">SITE</li>
				<li onclick="parent.location='<?php echo base_url('noticia'); ?>'">NOTICIA</li>
				<li onclick="parent.location='<?php echo base_url('frase'); ?>'">FRASES</li>
				<li onclick="parent.location='<?php echo base_url('setup'); ?>'">CONFIG.</li>
				<li onclick="parent.location='<?php echo base_url('setup/logout'); ?>'">SAIR</li>
			</ul>
		</nav>