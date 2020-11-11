<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model{
    public function register_client($registo_form){
        //recebe os dados e envia para a tabela user da base de dados
        $this->db->insert('user', $registo_form);
    }
}