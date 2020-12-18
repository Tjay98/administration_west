<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{


    //enviar todos os produtos
    public function get_products(){
        if($this->session->userdata('role_id')!=3){
            $this->db->where('products.status',1);
        }
        $this->db->select('products.*,
                            categories.category_name, 
                            companies.company_name');
                            
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');

        
        $results=$this->db->get()->result_array();

        return $results;

    }

    
    //enviar detalhes do produto
    public function get_detail_products($id){
        $this->db->where('products.id',$id);
        $this->db->select('products.*,
                            categories.category_name,
                            companies.company_name, ');
    $this->db->from('products');
    $this->db->join('categories','categories.id=products.category_id','RIGHT');
    $this->db->join('companies','companies.id=products.company_id','RIGHT');

        $result = $this->db->get()->row_array();
        return $result;
    }


    public function get_products_by_categories($id){
        if($this->session->userdata('role_id')!=3){
            $this->db->where('products.status',1);
        }
        $this->db->select('products.id,
                            products.product_name, 
                            products.image, 
                            products.small_description, 
                            products.price,
                            products.category_id,
                            products.company_id,
                            categories.category_name,
                            companies.company_name,  ');
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');

        $this->db->where('products.category_id', $id);
        $results = $this->db->get()->result_array();
        return $results;
    }


    function products_by_company($company_id){
        if($this->session->userdata('role_id')!=3){
            $this->db->where('products.status',1);
        }
        $this->db->select('products.*,
                            categories.category_name,
                            companies.company_name,  ');
        $this->db->where('company_id',$company_id);
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');
        $products=$this->db->get()->result_array();

        return $products;
    }
    
    


}