<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Pagina extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('noticia_model', 'noticia'); 
		$this->load->model('randfrase_model', 'randfrase'); 
	}

	public function index(){
		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;       
                $data['autor'] = $linha->autor;  
            endforeach;
        else:
            return NULL;
        endif;

		$dados1['titulo1'] = 'Fratura Exposta';
		$this->load->view('header', $dados1);
		$this->load->view('home');
		$this->load->view('aside', $data);
		$this->load->view('footer');
	}

	public function origem(){
		$dados1['titulo1'] = 'Origem - Fratura Exposta';

		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;      
                $data['autor'] = $linha->autor;   
            endforeach;
        else:
            return NULL;
        endif;

		$this->load->view('header', $dados1);
		$this->load->view('origem');
		$this->load->view('aside', $data);
		$this->load->view('footer');
	}

	public function dicas(){
		$dados1['titulo1'] = 'Dicas - Fratura Exposta';

		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;      
                $data['autor'] = $linha->autor;   
            endforeach;
        else:
            return NULL;
        endif;

		$this->load->view('header', $dados1);
		$this->load->view('dicas');
		$this->load->view('aside', $data);
		$this->load->view('footer');
	}

	public function contato(){
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'email'));
		//Regras de validação Contato
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required');
		if($this->form_validation->run() == FALSE ):
			$dados1['form_error'] = validation_errors();
		else:
			$dados_form = $this->input->post();
			$this->email->from($dados_form['email'], $dados_form['nome']);
			$this->email->to('fraturaexpostahardcore@gmail.com');
			$this->email->message($dados_form['mensagem']);
			if($this->email->send()):
				$dados1['form_error'] = 'O recado foi enviado com sucesso.';
			else:
				$dados1['form_error'] = 'Erro ao enviar o recado. Favor tentar novamente em 5 min.';
			endif;
		endif;

		
		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;  
                $data['autor'] = $linha->autor;     
            endforeach;
        else:
            return NULL;
        endif;

		$dados1['titulo1'] = 'Contato - Fratura Exposta';
		$this->load->view('header', $dados1);
		$this->load->view('contato');
		$this->load->view('aside', $data);
		$this->load->view('footer');
	}

	public function galeria(){
		$dados1['titulo1'] = 'Galeria - Fratura Exposta';

		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;   
                $data['autor'] = $linha->autor;      
            endforeach;
        else:
            return NULL;
        endif;

		$this->load->view('header', $dados1);
		$this->load->view('galeria');
		$this->load->view('aside', $data);
		$this->load->view('footer');
	}

	public function post(){
		$dados1['titulo1'] = 'Fratura Exposta';

		if($frase = $this->randfrase->get_rand(1)):
            foreach ($frase as $linha) :
                $data['frase'] = $linha->frase;   
                $data['autor'] = $linha->autor;      
            endforeach;
        else:
            return NULL;
        endif;

		if(($id = $this->uri->segment(2)) > 0):
			if($noticia = $this->noticia->get_single($id)):
				$dados1['titulo'] = to_html($noticia->titulo).'- Fratura Exposta';
				$dados1['not_titulo'] = to_html($noticia->titulo);
				$dados1['not_conteudo'] = to_html($noticia->conteudo);
				$dados1['not_imagem'] = $noticia->imagem;
			else:
				$dados1['titulo'] = 'Pagina não encontrada!';
				$dados1['not_titulo'] = 'Noticia não encontrada';
				$dados1['not_conteudo'] = '<p>Nenhuma noticia foi encontrada!</p>';
				$dados1['not_imagem'] = '';
			endif;
		else:
			redirect(base_url(), 'refresh');
		endif;

		$this->load->view('header', $dados1);
		$this->load->view('post');
		$this->load->view('aside', $data);
		$this->load->view('footer');

	}
}