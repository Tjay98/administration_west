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

    //enviar os productos para a página de produtos as categorias tambem estao lá
    public function index(){
        $data['categories']=$this->Product_model->get_categories();
        $data2['products']=$this->Product_model->get_products();
        $this->load_views('frontend/products/products', $data, $data2);
    }

    //para ir a procura de produtos
    public function search_product(){
        echo $this->input->post('search_bar');
    }

    // caso venhamos a ter uma página de categorias vamos usar esta função para enviar as categorias para a página
    public function categories_index(){
    }

    //para producar produtos com a mesma categoria
    public function get_products_by_category($category_id){  
    }

    //enviar produtos para a vista
    public function get_products($id){
        $products=$this->Product_model->get_detail_products($id);
        $this->load_views('frontend/products/products_details', $products);
    }

    //envia as informações das empresas para a página de empresas
    public function companies_index(){
        $data['companies']=$this->Product_model->get_companies();
        $this->load_views('frontend/companies', $data);
    }


    
}