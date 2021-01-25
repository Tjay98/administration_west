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
        $this->load->model('Category_model');
        $this->load->model('Company_model');
    }

    //implementar

    //enviar os productos para a página de produtos as categorias tambem estao lá
    public function index(){
        $data['categories']=$this->Category_model->get_categories();
        $data['products']=$this->Product_model->get_products();
        $data['companies']=$this->Company_model->get_companies();

        $this->load_views('frontend/products/products', $data);
    }

    //para ir a procura de produtos
    public function search_product($search){
        $search=$this->input->post('search_bar');
        $data['products']=$this->Product_model->search_product($search);
        if(!empty($products)){
            $this->load_views('frontend/products/products', $data);
        } else {
            print_r($data);
        }

    }

    public function categories_index(){
        $data['categories']=$this->Category_model->get_categories();
        $this->load_views('frontend/products/category', $data);
    }

    public function products_by_category($id){
        $data['categories']=$this->Category_model->get_categories();
        $data['products']=$this->Product_model->get_products_by_categories($id);
        $data['companies']=$this->Company_model->get_companies();

        $this->load_views('frontend/products/products', $data);
    }
 
    public function products_by_company($id){
        $data['categories']=$this->Category_model->get_categories();
        $data['products']=$this->Product_model->products_by_company($id);
        $data['companies']=$this->Company_model->get_companies();

        $this->load_views('frontend/products/products', $data);
    }
 
    //enviar produtos para a vista
    public function get_products($id){
        $products['product']=$this->Product_model->get_detail_products($id);
        $this->load_views('frontend/products/product_details', $products);
    }


    //envia as informações das empresas para a página de empresas
    public function companies_index(){
        $data['companies']=$this->Company_model->get_companies();
        $this->load_views('frontend/companies', $data);
    }


    
}