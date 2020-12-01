<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    //enviar categorias
    public function get_categories(){
        $results = $this->db->get('categories')->result_array();
        return $results;
    }

    // enviar os produtos da mesma categoria
   /* public function get_products_by_categories(){
       // $results = $this->db->get('categories')->result_array();
        //return $results;
    }*/

    //enviar todos os produtos
    public function get_products(){
        $results = $this->db->get('products')->result_array();
        return $results;
    }

    //enviar detalhes do produto
    public function get_detail_products($id){
        $this->db->where('products.id',$id);
        $this->db->from('products');
        $this->db->join('companies','companies.id = products.company_id','LEFT');
        $this->db->join('categories','categories.id = products.category_id','LEFT');
        $result = $this->db->get()->row_array();
        return $result;
    }

    //eniviar empresas
    public function get_companies(){
        $results = $this->db->get('companies')->result_array();
        return $results;
    }


}