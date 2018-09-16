<?php
defined('BASEPATH') OR exit('No direct script acess allowed'); 

class Frase extends CI_Controller { 
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
		$this->load->model('frase_model', 'frase');
	}

	public function index(){
		redirect('frase/listar', 'refresh');
	}

	public function listar(){
		//verifica se o usuario esta logado
		verifica_login();

		//carrega view
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Listagem de frases';
		$dados['tela'] = 'listar';
		$dados['frase'] = $this->frase->get();
		$this->load->view('painel/frases', $dados);
	}

	public function cadastrar(){
		//verifica se o usuario esta logado
		verifica_login();

		//regras de validação
		$this->form_validation->set_rules('autor', 'AUTOR', 'trim|required');
		$this->form_validation->set_rules('frase', 'FRASE', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$this->load->library('upload', config_upload());
				//upload executado
				$dados_upload = $this->upload->data();
				$dados_form = $this->input->post();
				$dados_insert['autor'] = to_db($dados_form['autor']);
				$dados_insert['frase'] = to_db($dados_form['frase']);
				//salvar no BD
				if($id = $this->frase->salvar($dados_insert)):
					set_msg('<p>Frase cadastrada com sucesso!</p>');
					redirect('frase/editar/'.$id, 'refresh');
				else:
					set_msg('<p>Erro.Frase não cadastrada!</p>');
				endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Cadastro de Frases';
		$dados['h2'] = 'Cadastro de frases';
		$dados['tela'] = 'cadastrar';
		$this->load->view('painel/frases', $dados);
	}

	public function excluir(){
		//verifica se o usuario esta logado
		verifica_login();

		$id = $this->uri->segment(3);
		if($id > 0):
			//id informado, continuar com exclusão
			if($frases = $this->frase->get_single($id)):
				$dados['frase'] = $frases;
			else:
				set_msg('<p>Frase inexistente!');
				redirect('frase/listar', 'refresh');
			endif;
		else:
			//id não informado
			set_msg('<p>Você deve escolher uma frase para excluir!</p>');
			redirect('frase/listar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('excluir', 'EXCLUIR', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			if($this->frase->excluir($id)):
				set_msg('<p>frase excluida com sucesso!!!</p>');
				redirect('frase/listar', 'refresh');
			else:
				set_msg('<p>ERRO! Nenhuma frase foi excluida.</p>');
			endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Excluir Fraturas';
		$dados['h2'] = 'Exluisão de frases';
		$dados['tela'] = 'excluir';
		$this->load->view('painel/frases', $dados);
	}

	public function editar(){
		//verifica se o usuario esta logado
		verifica_login();

		$id = $this->uri->segment(3);
		if($id > 0):
			//id informado, continuar com edição
			if($frases = $this->frase->get_single($id)):
				$dados['frase'] = $frases;
				$dados_update['id'] = $frases->id;
			else:
				set_msg('<p>frase inexistente!');
				redirect('frase/listar', 'refresh');
			endif;
		else:
			//id não informado
			set_msg('<p>Você deve escolher uma frase para editar!</p>');
			redirect('frase/listar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('autor', 'AUTOR', 'trim|required');
		$this->form_validation->set_rules('frase', 'FRASE', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$this->load->library('upload', config_upload());
				$dados_form = $this->input->post();
				$dados_update['autor'] = to_db($dados_form['autor']);
				$dados_update['frase'] = to_db($dados_form['frase']);
				if($this->frase->salvar($dados_update)):
					set_msg('<p>frase alterada com sucesso!</p>');
				else:
					set_msg('<p>Nenhuma alterãção foi salva!</p>');
				endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Alteração Fraturas';
		$dados['h2'] = 'Alteração de frases';
		$dados['tela'] = 'editar';
		$this->load->view('painel/frases', $dados);
	}

} 