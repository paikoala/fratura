<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class Randfrase_model extends CI_Model { 

    function __construct(){
        parent::__construct();
    }

    public function get_rand(){

            
            $frase = $this->db->query("SELECT * FROM frases ORDER BY RAND() LIMIT 1");
            if($frase->num_rows() > 0):
                return $frase->result();
            else:
                return NULL;
            endif;

    }
}

