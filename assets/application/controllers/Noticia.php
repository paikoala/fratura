<?php
defined('BASEPATH') OR exit('No direct script acess allowed'); 

class Noticia extends CI_Controller { 
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
		$this->load->model('noticia_model', 'noticias');
	}

	public function index(){
		redirect('noticia/listar', 'refresh');
	}

	public function listar(){
		//verifica se o usuario esta logado
		verifica_login();

		//carrega view
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Listagem de Noticias';
		$dados['tela'] = 'listar';
		$dados['noticia'] = $this->noticias->get();
		$this->load->view('painel/noticias', $dados);
	}

	public function cadastrar(){
		//verifica se o usuario esta logado
		verifica_login();

		//regras de validação
		$this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
		$this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$this->load->library('upload', config_upload());
			if($this->upload->do_upload('imagem')):
				//upload executado
				$dados_upload = $this->upload->data();
				$dados_form = $this->input->post();
				$dados_insert['titulo'] = to_db($dados_form['titulo']);
				$dados_insert['conteudo'] = to_db($dados_form['conteudo']);
				$dados_insert['imagem'] = $dados_upload['file_name'];
				//salvar no BD
				if($id = $this->noticias->salvar($dados_insert)):
					set_msg('<p>Noticia cadastrada com sucesso!</p>');
					redirect('noticia/editar/'.$id, 'refresh');
				else:
					set_msg('<p>Erro.Noticia não cadastrada!</p>');
				endif;
			else:
				//erro de upload
				$msg = '<p>São permitidos somente imagens em JPG|PNG de até 512Kb.</p>';
				set_msg($msg);
			endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Cadastro de Fraturas';
		$dados['h2'] = 'Cadastro de Noticias';
		$dados['tela'] = 'cadastrar';
		$this->load->view('painel/noticias', $dados);
	}

	public function excluir(){
		//verifica se o usuario esta logado
		verifica_login();

		$id = $this->uri->segment(3);
		if($id > 0):
			//id informado, continuar com exclusão
			if($noticias = $this->noticias->get_single($id)):
				$dados['noticia'] = $noticias;
			else:
				set_msg('<p>Noticia inexistente!');
				redirect('noticia/listar', 'refresh');
			endif;
		else:
			//id não informado
			set_msg('<p>Você deve escolher uma noticia para excluir!</p>');
			redirect('noticia/listar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('excluir', 'EXCLUIR', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$imagem = 'uploads/'.$noticias->imagem;
			if($this->noticias->excluir($id)):
				unlink($imagem);
				set_msg('<p>Noticia excluida com sucesso!!!</p>');
				redirect('noticia/listar', 'refresh');
			else:
				set_msg('<p>ERRO! Nenhuma noticia foi excluida.</p>');
			endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Excluir Fraturas';
		$dados['h2'] = 'Exluisão de Noticias';
		$dados['tela'] = 'excluir';
		$this->load->view('painel/noticias', $dados);
	}

	public function editar(){
		//verifica se o usuario esta logado
		verifica_login();

		$id = $this->uri->segment(3);
		if($id > 0):
			//id informado, continuar com edição
			if($noticias = $this->noticias->get_single($id)):
				$dados['noticia'] = $noticias;
				$dados_update['id'] = $noticias->id;
			else:
				set_msg('<p>Noticia inexistente!');
				redirect('noticia/listar', 'refresh');
			endif;
		else:
			//id não informado
			set_msg('<p>Você deve escolher uma noticia para editar!</p>');
			redirect('noticia/listar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
		$this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$this->load->library('upload', config_upload());
			if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''):
				//foi enviada uma imagem, devo fazer o upload
				if($this->upload->do_upload('imagem')):
					$imagem_antiga = 'upload/'.$noticia->imagem;
					$dados_upload = $this->upload->data();
					$dados_form = $this->input->post();
					$dados_update['titulo'] = to_db($dados_form['titulo']);
					$dados_update['conteudo'] = to_db($dados_form['conteudo']);
					$dados_update['imagem'] = $dados_upload['imagem'];
					if($this->noticias->salvar($dados_update)):
						unlink($imagem_antiga);
						set_msg('<p>Noticia alterada com sucesso!</p>');
						$dados['noticia']->imagem = $dados_update['imagem'];
					else:
						set_msg('<p>Nenhuma alterãção foi salva!</p>');
					endif;
				else:
					//erro de upload
					$msg = '<p>São permitidos somente imagens em JPG|PNG de até 512Kb.</p>';
					set_msg($msg);
				endif;
			else:
				//não foi enviado uma imagem
				$dados_form = $this->input->post();
				$dados_update['titulo'] = to_db($dados_form['titulo']);
				$dados_update['conteudo'] = to_db($dados_form['conteudo']);
				if($this->noticias->salvar($dados_update)):
					set_msg('<p>Noticia alterada com sucesso!</p>');
				else:
					set_msg('<p>Nenhuma alterãção foi salva!</p>');
				endif;
			endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Alteração Fraturas';
		$dados['h2'] = 'Alteração de Noticias';
		$dados['tela'] = 'editar';
		$this->load->view('painel/noticias', $dados);
	}

} 