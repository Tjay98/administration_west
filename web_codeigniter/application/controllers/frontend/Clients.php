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
        $this->already_logged();
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
                    'email'=>strtolower($email),
                    'phone_number'=>$this->input->post('inputPhone'),
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
        $this->already_logged();
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/login');
        }else{
            //login validation here
            $login_form=[
                'email'=>strtolower($this->input->post('inputEmail')),
                'password'=>$this->input->post('inputPassword'),
            ];
            $validate=$this->Client_model->verify_login($login_form);
            if(!empty($validate['unique'])){
                //if login happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
        }
    
    }


    public function logout(){
        $this->is_user_logged();
        
        //destroi a sessão
        $this->session->sess_destroy();
        redirect('');
    }


    public function profile(){
        $this->is_user_logged();

        $id=$this->session->userdata('user_id');
        
        $data['user']=$this->Client_model->profile($id);

        $this->load_views('frontend/clients/profile', $data);
        
    }

    public function password(){

        $this->is_user_logged();

        $id=$this->session->userdata('user_id');


        if(empty($this->input->post('inputOldPassword'))){
            $this->load_views('frontend/clients/profile');
        }else{
            $password_form=[
                'old_password'=>$this->input->post('inputOldPassword'),
                'password_hash'=>password_hash($this->input->post('inputPassword'),PASSWORD_DEFAULT),
                'repeat_password'=>password_hash($this->input->post('inputRepetirPassword'),PASSWORD_DEFAULT),
            ];
            $validate=$this->Client_model->new_password_client($password_form, $id);
            if(empty($validate)){
                //if register happens correctly
                 redirect('clients/profile');            
            }else{

                echo $validate;

            }

        }
    }
 
   /*  public function moradas(){
        if(empty($this->input->post('inputMoradaPrincipal'))){
            $this->load_views('frontend/clients/profile');
        }else{
            $registo_address_form=[
                'morada_principal'=>$this->input->post('inputMoradaPrincipal'),
                'morada_secundaria'=>$this->input->post('inputMoradaSecundaria'),
                'morada_fiscal'=>$this->input->post('inputMoradaFiscal'),
            ];

                    //vai enviar os dados para a função register_client do modelo Client_model 
            /* print_r($registo_form);die; */
           /* $validate=$this->Client_model->register_address_client($registo_address_form);
            if(empty($validate)){
                //if register happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
        }
    } */

    public function morada_shipping(){
        $this->is_user_logged();

        $user_key=$this->session->userdata('unique_key');

        print_r($user_key); die;
        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);
            $shipping_address=$this->Client_model->get_shipping_address_by_key($user_key);
           
            $name=$this->input->post('inputNomeClienteEntrega');
            $nif=$this->input->post('inputNifEntrega');
            $contact=$this->input->post('inputTelemovelEntrega');
            $city=$this->input->post('inputCidadeEntrega');
            $address=$this->input->post('inputMoradaEntrega');
            $zip=$this->input->post('inputCodPostalEntrega');
            
            if( $name && $nif && $contact && $city && $address && $zip){
                    $data=[
                        'user_id'=>$profile['user_id'],
                        'name'=>$name,
                        'nif'=>$nif,
                        'contact_number'=>$contact,
                        'city'=>$city,
                        'address'=>$address,
                        'zip_code'=>$zip,
                    ];
                print_r($shipping_address); 
                if(empty($shipping_address['id'])){
                    $this->db->insert('shipping_address',$data);
                    $update = $this->db->insert_id();
                }else{
                    $data['modified_date']=date('Y-m-d H:i:s');
                    $this->db->where('id',$shipping_address['id']);
                    $update=$this->db->update('shipping_address',$data);
                }

                if($update){
                    echo ('Sucesso');
                }

            }else{
                echo('Alguma informação está em falta');
            }

        }else{
            echo('Alguma informação está em falta');
        }

    }

    public function morada_billing(){
        $this->is_user_logged();

        $user_key=$this->session->userdata('unique_key');
        print_r($user_key); die;

        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);
            $shipping_address=$this->Client_model->get_shipping_address_by_key($user_key);

            $name=$this->input->post('inputNomeFaturacao');
            $nif=$this->input->post('inputNifFaturacao');
            $contact=$this->input->post('inputTelemovelFaturacao');
            $city=$this->input->post('inputCidadeFaturacao');
            $address=$this->input->post('inputMoradaFaturacao');
            $zip=$this->input->post('inputCodPostalFaturacao');
            
            if( $name && $nif && $contact && $city && $address && $zip){
                    $data=[
                        'user_id'=>$profile['user_id'],
                        'name'=>$name,
                        'nif'=>$nif,
                        'contact_number'=>$contact,
                        'city'=>$city,
                        'address'=>$address,
                        'zip_code'=>$zip,
                    ];
                if(empty($shipping_address['id'])){
                    $this->db->insert('shipping_address',$data);
                    $update = $this->db->insert_id();
                }else{
                    $data['modified_date']=date('Y-m-d H:i:s');
                    $this->db->where('id',$shipping_address['id']);
                    $update=$this->db->update('shipping_address',$data);
                }

                if($update){
                    echo ('Sucesso');
                }

            }else{
                echo('Alguma informação está em falta');
            }

        }else{
            echo('Alguma informação está em falta');
        }
    }


    public function purchase_history(){
        echo "Historico de compra";
    }
    
}