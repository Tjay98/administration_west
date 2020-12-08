<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Company_model');
    }

    public function index(){
        
        $data['categories']=$this->Category_model->get_categories();
        $data2['companies']=$this->Company_model->get_companies();
        $this->load_views('frontend/home', $data, $data2);

    }

    //implementar
    public function contactos(){
        $this->load_views('frontend/contacts');
    }

    
}