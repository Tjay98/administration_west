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
        $search=array();
        
        if(!empty($this->input->get('product_name'))){
            $search['product_name']=$this->input->get('product_name');
        }

        if(!empty($this->input->get('category'))){
            $search['category']=$this->input->get('category');
        }

        if(!empty($this->input->get('company'))){
            $search['company']=$this->input->get('company');
        }

        
        /* print_r($search);die; */
        $data['categories']=$this->Category_model->get_categories();
        $data['products']=$this->Product_model->search_product($search);
        $data['companies']=$this->Company_model->get_companies();
        

        $this->load_views('frontend/products/products', $data);
    }

    //para ir a procura de produtos
    public function search_product(){
        

        
        if(!empty($this->input->get('product_name'))){
            $search['product_name']=$this->input->get('product_name');
        }

        if(!empty($this->input->get('category'))){
            $search['category']=$this->input->get('category');
        }

        if(!empty($this->input->get('company'))){
            $search['company']=$this->input->get('company');
        }
        
        
        if(!empty($search['product_name'])){
            $this->db->like('product_name',$search['product_name']);
        }
        if(!empty($search['category'])){
            $this->db->like('categories.category_name',$search['category']);
        }
        if(!empty($search['company'])){
            $this->db->like('companies.company_name',$search['company']);
        }        
        $this->db->select('products.*,
                            categories.category_name, 
                            companies.company_name');
                            
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');

        $this->db->order_by('products.id','desc');
        $results=$this->db->get()->result_array();

        print_r($results);
        

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
        $this->load_views('frontend/products/companies', $data);
    }


    
}