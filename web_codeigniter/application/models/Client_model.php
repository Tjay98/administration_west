<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model{

    public function register_client($registo_form){

        $this->db->where('email',$registo_form['email']);
        $validate_email=$this->db->get('user')->row_array();

        if(empty($validate_email)){
            $this->db->where('nif',$registo_form['nif']);
            $validate_nif=$this->db->get('user')->row_array();
            if(empty($validate_nif)){
                $this->db->insert('user',$registo_form);
            }else{
                return 'nif_error';
            }
        }else{
            return 'email_error';
        }
        //recebe os dados e envia para a tabela user da base de dados
       
    }

    public function verify_login($login_form){

        $this->db->where('password_hash', $login_form['password_hash']);
        $validate_pass=$this->db->get('user')->row_array();

        if(empty($validate_pass)){
            $this->db->get('user', $login_form);
        }else{
            return 'password_error';
        }
    }
}