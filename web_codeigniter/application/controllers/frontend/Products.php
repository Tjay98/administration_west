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
    }

    //implementar
    public function index(){
        $this->load_views('frontend/products/products3');
    }

    public function search_product(){
        echo $this->input->post('search_bar');
    }


    public function categories_index(){
        echo "categorias";
    }

    public function companies_index(){
        echo "empresas";
    }
}