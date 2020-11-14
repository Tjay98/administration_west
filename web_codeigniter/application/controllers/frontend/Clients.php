<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Clients extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    }

    //implementar
    public function register(){
       //se estiver vazio volta a mostrar a pagina
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/register');
        }else{
                //preenche o array 
                $registo_form=[
                    'username'=>$this->input->post('inputUsername'),
                    'email'=>$this->input->post('inputEmail'),
                    'nif'=>$this->input->post('inputNif'),
                    'birthday_date'=>$this->input->post('inputDate'),
                    'password_hash'=>password_hash($this->input->post('inputPassword'),PASSWORD_DEFAULT),
                    'created_at'=>date("Y-m-d_H:i:s"),
                    'updated_at'=>date("Y-m-d_H:i:s"),  
                ];
                //vai enviar os dados para a função register_client do modelo Client_model 
                $validate=$this->Client_model->register_client($registo_form);
                if(empty($validate)){
                    //if register happens correctly
                    echo 'success';
                }else{
                    echo $validate;
                }
            }
        }
    
     

    public function login(){
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/login');
        }else{
            //login validation here
            $login_form=[
                'email'=>$this->input->post('inputEmail'),
                'password_hash'=>password_hash($this->input->post('inputPassword'),PASSWORD_DEFAULT),
            ];
            $validate=$this->Client_model->verify_login($login_form);
            if(empty($validate)){
                //if register happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
           
            
           
        }
       

        //$nome=$this->input->post('');

    
    }

    
}