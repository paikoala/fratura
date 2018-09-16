
<section>	
<?php
	if($noticias = $this->noticia->get(6)):
		foreach ($noticias as $linha) :
			?>
			<li class="liNoticias">
				<div class="h1Header">
					<h1 class="h1Noticias"><?php echo to_html($linha->titulo); ?></h1>
				</div>
				<center><img class="imgNoticias" src="<?php echo base_url('uploads/'.$linha->imagem); ?>" alt="" /></center>
				<p class="pNoticias"><?php echo resumo_post($linha->conteudo); ?>...</p>
				
				<a class="abtn abtn-green" href="<?php echo base_url('post/'.$linha->id); ?>">Leia mais</a>
				
			</li> 

		<?php
		endforeach;
	else:
		echo '<p>Nenhuma notícia cadastrada!</p>';
	endif;
?>
	
</section>
