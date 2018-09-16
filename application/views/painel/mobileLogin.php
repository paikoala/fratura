<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $titulo1; ?></title>
		<meta name="author" content="PKWD">
		<meta name="description" content="Rock em Foz Do Iguaçu">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/style.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/loginMobile.css'); ?>">
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/caveira2.png'); ?>"> <!-- Icone da pagina -->

	</head>

	<body class="bodyLogin">
		<h2 class="h2Login"><?php echo $h2; ?></h2>
		<?php 
			if($msg = get_msg()):
				echo '<div class="msg-box">'.$msg.'</div>';
			endif;
			echo form_open();
			echo form_label('Usuário', 'login');
			echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
			echo form_label('Senha', 'senha');
			echo form_password('senha');
			echo form_submit('enviar', 'Login', array('class' => 'botao'));
			echo form_close();
		?>
	</body>
</html>