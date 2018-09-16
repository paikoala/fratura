<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class Frase_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function salvar($dados){
		if(isset($dados['id']) && $dados['id'] > 0):
			//noticia ja existe, editar
			$this->db->where('id', $dados['id']);
			unset($dados['id']);
			$this->db->update('frases', $dados);
			return $this->db->affected_rows();
		else:
			//noticia não exite, inserir
			$this->db->insert('frases', $dados);
			return $this->db->insert_id();
		endif;

	}

	public function get($limit=0, $offset=0){
		if($limit == 0):
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('frases', 'autor');
			if($query->num_rows() > 0):
				return $query->result();
			else:
				return NULL;
			endif;
		else:
			$this->db->order_by('id', $id);
			$query = $this->db->get('frases', $limit);
			if($query->num_rows() > 0):
				return $query->result();
			else:
				return NULL;
			endif;
		endif;
	} 

		public function get_single($id=0){
		$this->db->where('id', $id);
		$query = $this->db->get('frases', 1);
		if($query->num_rows() == 1):
			$row = $query->row();
			return $row;
		else:
			return NULL;
		endif;
	}


	public function excluir($id=0){
		$this->db->where('id', $id);
		$this->db->delete('frases');
		return $this->db->affected_rows();
	}
} 