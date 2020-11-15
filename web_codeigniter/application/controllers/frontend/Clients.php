<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 * @last_update : 15 november 2020
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

            /* 
                O regex seguinte de validação de passwords é baseado num regex de validação encontrado no seguinte url
                https://stackoverflow.com/questions/22544250/php-password-validation
            */

            if(!preg_match("#[0-9]+#",$this->input->post('inputPassword'))) {
                echo "pass_number_error";
            }
            elseif(!preg_match("#[A-Z]+#",$this->input->post('inputPassword'))) {
                echo "pass_capital_letter";
            }
            elseif(!preg_match("#[a-z]+#",$this->input->post('inputPassword'))) {
                echo "pass_lower_letter";
            }
            elseif(!preg_match('@[^\w]@',$this->input->post('inputPassword'))) {
                echo "pass_special_caracter";
            }else{
                 //converter tudo para minusculo
                $user=strtolower($this->input->post('inputUsername'));
                $email=strtolower($this->input->post('inputEmail'));
            
                //converter apenas o primeiro elemento de cada palavra para maiusculo
                $username=ucwords($user);

                //preenche o array 
                $registo_form=[
                    'username'=>$username,
                    'email'=>$email,
                    'nif'=>$this->input->post('inputNif'),
                    'birthday_date'=>$this->input->post('inputDate'),
                    'password_hash'=>password_hash($this->input->post('inputPassword'),PASSWORD_DEFAULT),
                ];
                //vai enviar os dados para a função register_client do modelo Client_model 
                /* print_r($registo_form);die; */
                $validate=$this->Client_model->register_client($registo_form);
                if(empty($validate)){
                    //if register happens correctly
                    echo 'success';
                }else{
                    echo $validate;
                }
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
                'password'=>$this->input->post('inputPassword'),
            ];
            $validate=$this->Client_model->verify_login($login_form);
            if(empty($validate)){
                //if register happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
        }
    
    }


    public function logout(){
        //destroi a sessão
        $this->session->sess_destroy();
        redirect('');
    }


    public function profile(){
        print_r($this->session->userdata());
    }

    public function purchase_history(){
        echo "Historico de compra";
    }
    
}