<section>
	<h1>Contato</h1><br><br>
	<article>
		Seja muito bem vindo a pagina de comentarios do site FRATURA EXPOSTA. Preencha os campos a baixo para entrar em contato.<br>
		Contenos de algum erro ou bug no site, indique uma bandas, dê dicas, conte sobre aquilo que aflinge seu coraçãozinho, estamos a total disposição. Caso nescessario entraremos em contato o quanto antes. 
	</article><br><br>

	<?php
		if($form_error):
			echo '<p>'.$form_error.'</p>';
		endif;
		echo form_open('pagina/contato');
		echo form_label('Nome:', 'nome', array('class' =>'labelNome')).'<br>';
		echo form_input('nome', set_value('nome'), array('class' =>'formNome')).'<br><br>';
		echo form_label('Email:', 'email', array('class' =>'labelEmail')).'<br>';
		echo form_input('email', set_value('comentario'), array('class' =>'formEmail')).'<br><br>';
		echo form_label('Mensagem:', 'mensagem', array('class' =>'labelMsg')).'<br>';
		echo form_textarea('mensagem', set_value('mensagem'), array('class' =>'formMsg')).'<br><br>';
		echo form_submit('enviar', 'Enviar', array('class' =>'btnContato'));
		echo form_close();
	?> 
	</form><br><br>
</section>