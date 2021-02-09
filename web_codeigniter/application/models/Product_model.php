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

        $this->db->order_by('products.id','desc');
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
        $this->db->select('products.*,
                            categories.category_name,
                            companies.company_name,  ');
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');
        $this->db->order_by('products.id','desc');
        $this->db->where('products.category_id', $id);
        $results = $this->db->get()->result_array();
        return $results;
    }


    public function products_by_company($company_id){
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
        $this->db->order_by('products.id','desc');
        $products=$this->db->get()->result_array();

        return $products;
    }
    
    
    public function search_product($search){
/*         if($this->session->userdata('role_id')!=3){
            $this->db->where('products.status',1);
        } */

        if(!empty($search['product_name'])){
            $this->db->like('product_name',$search['product_name']);
        }
        if(!empty($search['category'])){
            $this->db->like('categories.id',$search['category']);
        }
        if(!empty($search['company'])){
            $this->db->like('companies.id',$search['company']);
        }        
        $this->db->select('products.*,
                            categories.id as category_id,
                            categories.category_name, 
                            companies.id as company_id,
                            companies.company_name');
                            
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');

        $this->db->order_by('products.id','desc');
        $results=$this->db->get()->result_array();

        return $results;

    }

}