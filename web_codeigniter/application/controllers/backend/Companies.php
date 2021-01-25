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


        if($admin){
    
            $companies=$this->Company_model->get_companies();
        }


    }
}
