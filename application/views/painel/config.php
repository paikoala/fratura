<?php $this->load->view('painel/header'); ?>

<div class="divisoria">&nbsp;</div>

<div class="colunaConfig">
	<h2><?php echo $h2; ?></h2>
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
		echo form_label('Senha (Deixe em branco caso não queira alterar)', 'senha');
		echo form_password('senha');
		echo form_label('Repita senha', 'senha2');
		echo form_password('senha2');
		echo form_submit('enviar', 'Salvar dados', array('class' => 'botao'));
		echo form_close();
	?>
</div> 


<?php $this->load->view('painel/footer'); ?>