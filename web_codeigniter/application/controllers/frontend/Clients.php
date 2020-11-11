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
    }

    //implementar
    public function register(){
       //se estiver vazio volta a mostrar a pagina
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/register');
        }else{
            //register validation here
            //print_r($this->input->post());

          /*  $this->load->library('form_validation');
            $this->form_validation->set_rules('username',  'required');
            $this->form_validation->set_rules('email', 'required');
            //$this->form_validation->set_rules('inputNif', 'NIF', 'required | unique'');
            //$this->form_validation->set_rules('inputDate', 'Data de nascimento', 'required');
            $this->form_validation->set_rules('password_hash', 'required | min_length[8]|max_length[25]');

         /*   if ($this->form_validation->run() == FALSE) { 
                $this->load_views('frontend/clients/register');
            } else {*/

                //carrega o modelo 
                $this->load->model('Client_model');
                //preenche o array 
                $registo_form=array(
                'username'=>$this->input->post('inputUsername'),
                'email'=>$this->input->post('inputEmail'),
                //'nif'=>$this->input->post('inputNif'),
                //'data_nascimento'=>$this->input->post('inputDate'),
                'auth_key'=>12,
                'password_hash'=>password_hash($this->input->post('inputPassword'),PASSWORD_DEFAULT),
                'created_at'=>date("Y-m-d_H:i:s"),
                'updated_at'=>date("Y-m-d_H:i:s"),
                );
                //vai enviar os dados para a função register_client do modelo Client_model 
                $this->Client_model->register_client($registo_form);
            }
        }
    
     

    public function login(){
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/login');
        }else{
            //login validation here
            print_r($this->input->post());
            
           
        }
       

        //$nome=$this->input->post('');

    
    }

    
}