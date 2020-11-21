<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Products extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');

    }

    //implementar
    public function index(){
        $data['categories']=$this->Product_model->get_categories();
        $data2['products']=$this->Product_model->get_products();
        $this->load_views('frontend/products/products', $data, $data2);
    }

    public function search_product(){
        echo $this->input->post('search_bar');
    }

    public function categories_index(){
    }

    public function companies_index(){
        $data['companies']=$this->Product_model->get_companies();
        $this->load_views('frontend/companies', $data);

    }


    
}