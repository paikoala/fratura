<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class Setup extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
	}

	public function index(){
		if($this->option->get_option('setup_executado') == 1):
			//setup ok
			redirect('setup/alterar', 'refresh');
		else:
			//nao intalado
			redirect('setup/instalar', 'refresh');
		endif;
	}

	public function instalar(){
		if($this->option->get_option('setup_executado') == 1):
			//setup ok
			redirect('setup/alterar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('alcunha', 'ALCUNHA', 'trim|required');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[senha]');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$dados_form = $this->input->post();
			$this->option->update_option('user_login', $dados_form['login']);
			$this->option->update_option('user_alcunha', $dados_form['alcunha']);
			$this->option->update_option('user_email', $dados_form['email']);
			$this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
			$inserido = $this->option->update_option('setup_executado', 1);
			if($inserido):
				set_msg('<p>Sistema instalado com sucesso!</p>');
				redirect('setup/login', 'refresh');
			endif;


			set_msg('<p>validação ok</p>');
		endif;

		//carrega view
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Setup do sistema';
		$this->load->view('painel/setup', $dados);
	}

	public function login(){
		if($this->option->get_option('setup_executado') != 1):
			//setup ok
			redirect('setup/instalar', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('login', 'LOGIN', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$dados_form = $this->input->post();
			if($this->option->get_option('user_login') == $dados_form['login']):

				//usuario existe
				if(password_verify($dados_form['senha'], $this->option->get_option('user_pass'))):

					//senha ok, fazer login
					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata('user_login', $dados_form['login']);
					$this->session->set_userdata('user_email', $this->option->get_option('user_email'));

					//fazer redirect para home do painel
					redirect('setup/welcome', 'refresh');

				else:
					//senha incoreta
					set_msg('<p>Senha incorreta!</p>');

				endif;
			else:
				//usuario não existe
				set_msg('<p>Usuario incorreto!</p>');
			endif;
		endif;

		//carrega view
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Sistema Fraturado';
		$this->load->view('painel/login', $dados);
	}

	public function welcome(){
		//verifica o login do usuario
		verifica_login();

		//carrega view
		$_POST['alcunha'] = $this->option->get_option('user_alcunha');
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Sistema Fraturado';
		$this->load->view('painel/welcome', $dados);
	}

	public function alterar(){
		//verifica o login do usuario
		verifica_login();

		//regras de validação
		$this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('alcunha', 'ALCUNHA', 'trim');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|min_length[6]');
		if(isset($_POST['senha']) && $_POST['senha'] != ''):
			$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[senha]');
		endif;

		//verifica a validação
		if($this->form_validation->run() == FALSE):
			if(validation_errors()):
				set_msg(validation_errors());
			endif;
		else:
			$dados_form = $this->input->post();
			$this->option->update_option('user_login', $dados_form['login']);
			$this->option->update_option('user_alcunha', $dados_form['alcunha']);
			$this->option->update_option('user_email', $dados_form['email']);
			if(isset($dados_form['senha']) && $dados_form['senha'] != ''):
				$this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
			endif;
			set_msg('<p>Dados alterado com sucesso!</p>');
		endif;

		//carrega view
		$_POST['login'] = $this->option->get_option('user_login');
		$_POST['alcunha'] = $this->option->get_option('user_alcunha');
		$_POST['email'] = $this->option->get_option('user_email');
		$dados['titulo1'] = 'Sistema Fraturado';
		$dados['h2'] = 'Alterar informações basicas';
		$this->load->view('painel/config', $dados);
	}

	public function logout(){
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('user_email');
		set_msg('<p>Você saiu do sistema!</p>');
		redirect('setup/login', 'refresh');
	}

}