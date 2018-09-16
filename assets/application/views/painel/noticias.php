<?php $this->load->view('painel/header'); ?>
<div class="divisoria">&nbsp;</div>
<div class="linha">
	<div class="colunaNoticias">
		<ul> 
			<li class="menuNoticias" onclick="parent.location='<?php echo base_url('noticia/cadastrar'); ?>'">INSERIR</li>
			<li class="menuNoticias" onclick="parent.location='<?php echo base_url('noticia/listar'); ?>'">LISTAR</li>
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
					if(isset($noticia) > 0):
						?>
						<table>
							<thead>
								<th align="left">Titulo</th>
								<th align="rigth">Ações</th>
							</thead>
							<tbody>
								<?php
									foreach ($noticia as $linha) :
								?>
										<tr>
											<td class="tituloNoticia"><?php echo $linha->titulo; ?></td>
											<td align="rigth" class="tituloNoticia"><?php echo anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?></td>
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
					echo form_label('Titulo', 'titulo');
					echo form_input('titulo', set_value('titulo'), array('class' => 'jqte' ));
					echo form_label('Conteudo:', 'conteudo');
					echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml' ));
					echo form_label('Imagem da noticia:', 'imagem');
					echo form_upload('imagem');
					echo form_submit('enviar', 'Salvar noticia', array('class' => 'botao'));
					echo form_close();
				break;

				case 'editar':
					echo form_open_multipart();
					echo form_label('Titulo', 'titulo');
					echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('class' => 'jqte' ));
					echo form_label('Conteudo:', 'conteudo');
					echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->titulo))), array('class' => 'editorhtml' ));
					echo form_label('Imagem da noticia:', 'imagem');
					echo form_upload('imagem');
					echo '<p><small>Imagem atual:</small><br /><img src="'.base_url('uploads/'.$noticia->imagem).'" class="thumb-edicao" /></p><br><br>';
					echo form_submit('enviar', 'Editar noticia', array('class' => 'botao'));
					echo form_close();
				break;

				case 'excluir':
					echo form_open_multipart();
					echo form_label('Titulo', 'titulo');
					echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('class' => 'jqte' ));
					echo form_label('Conteudo:', 'conteudo');
					echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->titulo))), array('class' => 'editorhtml' ));
					echo '<p><small>Imagem:</small><br /><img src="'.base_url('uploads/'.$noticia->imagem).'" class="thumb-edicao" /></p><br><br>';
					echo form_submit('excluir', 'Excluir noticia', array('class' => 'botao'));
					echo form_close();
				break;
			endswitch;
		?>
	</div> 
</div>

<?php $this->load->view('painel/footer'); ?>