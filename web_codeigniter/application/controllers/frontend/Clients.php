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
       
        if(empty($this->input->post('inputEmail'))){
            $this->load_views('frontend/clients/register');
        }else{
            //register validation here
            print_r($this->input->post(''));            
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