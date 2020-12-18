<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @since : 8 december 2020
 */
class Companies extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
        $this->load->model('Client_model');
        $this->is_admin_logged();
    }

    public function index(){
        $data['page_title']="Empresas";
        $this->load_admin_views('backend/companies/index',$data);
    }

    public function get_datatable(){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }


        if(!$admin){
            $user_id=$this->session->userdata('user_id');
            $company_id=$this->client_model->get_company_by_user($user_id); 
    
            $products=$this->product_model->products_by_company($company_id);
        }else{
            $products=$this->product_model->get_products();
        }




    }
}
