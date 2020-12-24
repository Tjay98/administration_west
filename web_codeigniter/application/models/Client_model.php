<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model{

    public function register_client($registo_form){

        $this->db->where('email',$registo_form['email']);
        $validate_email=$this->db->get('user')->row_array();
        
        if(empty($validate_email)){
            $this->db->where('phone_number',$registo_form['phone_number']);
            $validate_phone_number=$this->db->get('user')->row_array();
            //print_r($registo_form);die;
            if(empty($validate_phone_number)){
                $data=[
                    'username'=>$registo_form['username'],
                    'email'=>$registo_form['email'],
                    'phone_number'=>$registo_form['phone_number'],
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
                return 'phone_number_error';
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
                    $this->db->select('id , username, email, status, role_id');
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

    public function admin_verification($login_form){
        $this->db->select('password_hash , status , role_id');
        $this->db->where('email', $login_form['email']);
        $validation=$this->db->get('user')->row_array();

        if(!empty($validation)){
            if($validation['role_id'] > 1){

                if($validation['status']==1){
                    if (password_verify($login_form['password'], $validation['password_hash'])) {
                        $this->db->select('id , username, email, status, role_id , store_id');
                        $this->db->where('email', $login_form['email']);
                        $user=$this->db->get('user')->row_array();
                        $data=[
                            'user_id'=>$user['id'],
                            'username'=>$user['username'],
                            'status'=>$user['status'],
                            'role_id'=>$user['role_id'],
                            'store_id'=>$user['store_id'],

                        ];
                        $this->session->set_userdata($data);
                    }else{
                        return 'error';
                    }
                }else{
                    return 'banned';
                }
            }else{
                return 'role invalid';
            }


        }else{
            return 'error';
        }
    }

    public function profile($id){
        $this->db->select('id, username, email, phone_number, birthday_date, status, role_id');
        $this->db->where('user.id',$id);
        $data=$this->db->get('user')->row_array();

        return $data;
    }


    public function new_password_client($password_form, $id){

        $this->db->select('id, password_hash');
        $this->db->where('user.id', $id);
        $this->db->where('user.password_hash', $password_form['old_password']);

        $data=$this->db->get('user')->row_array();

        if($data->num_rows()>0){
            $dados=$data->row();
            if($dados->id==$this->session->userdata('id')){
                $data=[
                    'password_hash'=>$password_form['password_hash'],
                ];
                if($this->db->update('user',$data)){
                    return "Password mudada com sucesso!";
                } else {
                    return "Alguma coisa esta errada.";
                }
            } else {
                return "Alguma coisa esta errada! Password não foi mudada com sucesso";
            }
        } else {
            return "Password antiga errada!";
        }
    }

    public function get_company_by_user($user_id){
        $this->db->select('store_id');
        $this->db->where('id',$user_id);
        $user=$this->db->get('user')->row_array();

        return $user['store_id'];
    }


    public function count_clients(){
        $this->db->select('id');
        $this->db->where('role_id',1);
        $clients=$this->db->get('user')->result_array();
        if(!empty($clients)){
            $clients_count=count($clients); 
            return $clients_count;
        }
        

        
    }

    public function get_clients(){
        $this->db->select('id,username,email,phone_number');
        $this->db->where('role_id',1);
        $clients=$this->db->get('user')->result_array();

        return $clients;
    }

    public function get_client_addresses($user_id){
        $this->db->where('user_id',$user_id);
        $billing= $this->db->get('billing_address')->row_array();
        if(!empty($billing)){
            $data['billing_address']=$billing;
        }

        $this->db->where('user_id',$user_id);
        $shipping= $this->db->get('shipping_address')->row_array();
        if(!empty($shipping)){
            $data['shipping_address']=$shipping;
        }

        if(!empty($data)){
            return $data;
        }

    }
}
