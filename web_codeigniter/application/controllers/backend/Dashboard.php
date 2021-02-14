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
        $this->load->model('Company_model');
    }

    public function index(){
        $this->is_admin_logged();
        
        $data['page_title']="Dashboard";

        $user_id=$this->session->userdata('user_id');
        $company_id=$this->Client_model->get_company_by_user($user_id); 

        $data['companies']=$this->Company_model->get_companies();
        $data['client_count']=$this->Client_model->count_clients();
        if($this->session->userdata('role_id')==2){
            $data['all_products']=$this->Product_model->products_by_company($company_id);
            $data['products_sold']=$this->Sale_model->get_sale_by_company($company_id);
            $data['all_sales']=$this->Sale_model->get_company_sale_groups($company_id);
        }else{
            $data['all_products']=$this->Product_model->get_products();
            $data['all_sales']=$this->Sale_model->get_all_sale_groups();
            $data['products_sold']=$this->Sale_model->get_all_sold_products();
        }

       // print_R($data);die;
        $this->load_admin_views('backend/dashboard',$data);
        
    }

    public function login(){
        if( (empty($this->input->post('email'))) ){
            $this->already_logged();
            $this->load->view('backend/login');
        }else{
            $email=strtolower($this->input->post('email'));
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

    public function logout(){
        $this->is_admin_logged();
        
        //destroi a sessão
        $this->session->sess_destroy();
        redirect('admin');
    }
    

    
}