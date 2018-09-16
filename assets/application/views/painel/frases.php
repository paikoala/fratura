<?php $this->load->view('painel/header'); ?>
<div class="divisoria">&nbsp;</div>
<div class="linha">
	<div class="colunaNoticias">
		<ul> 
			<li class="menuNoticias" onclick="parent.location='<?php echo base_url('frase/cadastrar'); ?>'">INSERIR</li>
			<li class="menuNoticias" onclick="parent.location='<?php echo base_url('frase/listar'); ?>'">LISTAR</li>
		</ul>
	</div>
	<div class="colunaNoticias2">
		<h2><?php echo $h2; ?></h2>
		<?php 
			if($msg = get_msg()):
				echo '<div class="msg-box">'.$msg.'</div>';
			endif;

			switch ($tela) :
				case 'listar':
					if(isset($frase) > 0):
						?>
						<table>
							<thead>
								<th align="left">Frase</th>
								<th align="rigth">Ações</th>
							</thead>
							<tbody>
								<?php
									foreach ($frase as $linha) :
								?>
										<tr>
											<td class="tituloNoticia"><?php echo $linha->frase; ?><br><?php echo $linha->autor; ?></td>
											<td align="rigth" class="tituloNoticia"><?php echo anchor('frase/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('frase/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?></td>
										</tr>
								<?php
									endforeach;
								?>
							</tbody>
						</table>
						<?php
					else:
						echo '<div class="msg-box"><p>Nenhuma notícia cadastrada!</p></div>';
					endif;
				break;

				case 'cadastrar':
					echo form_open_multipart();
					echo form_label('Autor', 'autor');
					echo form_input('autor', set_value('autor'), array('class' => 'jqte' ));
					echo form_label('Frase:', 'frase');
					echo form_textarea('frase', to_html(set_value('frase')), array('class' => 'editorhtml' ));
					echo form_submit('enviar', 'Salvar frase', array('class' => 'botao'));
					echo form_close();
				break;

				case 'editar':
					echo form_open_multipart();
					echo form_label('Autor', 'autor');
					echo form_input('autor', set_value('autor', to_html($frase->autor)), array('class' => 'jqte' ));
					echo form_label('Frase:', 'frase');
					echo form_textarea('frase', to_html(set_value('frase', to_html($frase->frase))), array('class' => 'editorhtml' ));
					echo form_submit('enviar', 'Editar frase', array('class' => 'botao'));
					echo form_close();
				break;

				case 'excluir':
					echo form_open_multipart();
					echo form_label('Autor', 'autor');
					echo form_input('autor', set_value('autor', to_html($frase->autor)), array('class' => 'jqte' ));
					echo form_label('Frase:', 'frase');
					echo form_textarea('frase', to_html(set_value('frase', to_html($frase->autor))), array('class' => 'editorhtml' ));
					echo form_submit('excluir', 'Excluir frase', array('class' => 'botao'));
					echo form_close();
				break;
			endswitch;
		?>
	</div> 
</div>

<?php $this->load->view('painel/footer'); ?>