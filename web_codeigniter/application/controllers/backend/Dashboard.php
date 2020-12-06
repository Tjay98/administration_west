<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Dashboard extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
        $this->load->model('Sale_model');
        $this->load->model('Product_model');
    }

    public function index(){
        $this->is_admin_logged();
    
        $this->load_admin_views('backend/dashboard');
        
    }

    public function login(){
        if( (empty($this->input->post('email'))) ){
            $this->already_logged();
            $this->load->view('backend/login');
        }else{
            $email=$this->input->post('email');
            $password=$this->input->post('password');

            $login_form=[
                'email'=>$email,
                'password'=>$password,
            ];

            $validate=$this->Client_model->admin_verification($login_form);
            if(empty($validate)){
                //if register happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
        }
    }
    

    
}