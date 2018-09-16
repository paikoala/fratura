<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $titulo1; ?></title>
		<meta name="author" content="PKWD">
		<meta name="description" content="Rock em Foz Do Iguaçu">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/_css/painel.css'); ?>">
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/caveira2.png'); ?>"> <!-- Icone da pagina -->
		<style>
			input, label{
				margin-left: 21%;
				width: 50%;
			}
			input.botao{
				font-size: 20pt;
				margin-left: 40%;
			}
			input{
				font-size: 15pt;
			}
			label{
				font-size: 20pt;
			}

		</style>
	</head>

	<body>
		<h2 class="h2Instalar"><?php echo $h2; ?></h2>
		<?php 
			if($msg = get_msg()):
				echo '<div class="msg-box">'.$msg.'</div>';
			endif;
			echo form_open();
			echo form_label('Nome para login', 'login');
			echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
			echo form_label('Alcunha do ADM', 'alcunha');
			echo form_input('alcunha', set_value('alcunha'));
			echo form_label('Email do ADM', 'email');
			echo form_input('email', set_value('email'));
			echo form_label('Senha', 'senha');
			echo form_password('senha', set_value('senha'));
			echo form_label('Repita senha', 'senha2');
			echo form_password('senha2', set_value('senha2'));
			echo form_submit('enviar', 'Salvar dados', array('class' => 'botao'));
			echo form_close();
		?>
	</body>
</html>