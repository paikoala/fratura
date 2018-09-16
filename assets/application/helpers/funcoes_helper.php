<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

if(!function_exists('set_msg')):
	//seta uma mensagem via session para ser lida posteriormente
	function set_msg($msg=NULL){
		$ci = & get_instance();
		$ci->session->set_userdata('aviso', $msg);
	}
endif; 

if(!function_exists('get_msg')):
	//retorna uma mensagem definida pela função set_msg
	function get_msg($destroy=TRUE){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso');
		if($destroy) $ci->session->unset_userdata('aviso');
		return $retorno;
	}
endif;

if(!function_exists('verifica_login')):
	//verifica se o usuario está logado, caso não esteja redireciona para outra página
	function verifica_login($redirect='setup/login'){
		$ci = & get_instance();
		if($ci->session->userdata('logged') != TRUE):
			set_msg('<p>Você não possue autorização para realizar esta execução</p><br><p>Favor identificar-se na area de login!</p>');
			redirect($redirect, 'refresh');
		endif;
	}
endif; 

if(!function_exists('config_upload')):
	//verifica se o usuario está logado, caso não esteja redireciona para outra página
	function config_upload($path='./uploads/', $types='jpg|png', $size=10000){
		$config['upload_path'] = $path;
		$config['allowed_types'] = $types;
		$config['max_size'] = $size;
		return $config;
		
	}
endif; 

if(!function_exists('to_db')):
	//codifica o html para salvar no DATABASE
	function to_db($string=NULL){
		return htmlentities($string);
	}
endif;

if(!function_exists('to_html')):
	//codifica o html para salvar no DATABASE
	function to_html($string=NULL){
		return html_entity_decode($string);
	}
endif;

if(!function_exists('resumo_post')):
	//gerador de resumo para noticias
	function resumo_post($string=NULL, $tamanho=350){
		$string = to_html($string);
		$string = strip_tags($string);
		$string = substr($string, 0, $tamanho);
		return $string;
	}
endif;