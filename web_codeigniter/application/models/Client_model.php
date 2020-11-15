<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model{

    public function register_client($registo_form){

        $this->db->where('email',$registo_form['email']);
        $validate_email=$this->db->get('user')->row_array();
        
        if(empty($validate_email)){
            $this->db->where('nif',$registo_form['nif']);
            $validate_nif=$this->db->get('user')->row_array();
            //print_r($registo_form);die;
            if(empty($validate_nif)){
                $data=[
                    'username'=>$registo_form['username'],
                    'email'=>$registo_form['email'],
                    'nif'=>$registo_form['nif'],
                    'birthday_date'=>$registo_form['birthday_date'],
                    'password_hash'=>$registo_form['password_hash'],
                    'role_id'=>1,
                    'status'=>1,
                    'created_at'=>date("Y-m-d_H:i:s"),
                    'updated_at'=>date("Y-m-d_H:i:s"),  
                ];
                /* print_R($data);die; */
                $this->db->insert('user',$data);
            }else{
                return 'nif_error';
            }
        }else{
            return 'email_error';
        }
        //recebe os dados e envia para a tabela user da base de dados
       
    }

    public function verify_login($login_form){
        $this->db->select('password_hash , status');
        $this->db->where('email', $login_form['email']);
        $validation=$this->db->get('user')->row_array();

        if(!empty($validation)){
            if($validation['status']==1){
                if (password_verify($login_form['password'], $validation['password_hash'])) {
                    $this->db->select('id , username , status, role_id');
                    $this->db->where('email', $login_form['email']);
                    $user=$this->db->get('user')->row_array();
                    $data=[
                        'user_id'=>$user['id'],
                        'username'=>$user['username'],
                        'status'=>$user['status'],
                        'role_id'=>$user['role_id'],

                    ];
                    $this->session->set_userdata($data);
                }else{
                    return 'error';
                }
            }else{
                return 'banned';
            }

        }else{
            return 'error';
        }
    }

    public function admin_verification($user_id){
        $this->db->where('id',$user_id);
        $user_check=$this->db->get('user')->row_array();


        if(empty($user_check)){

        }
    }
}