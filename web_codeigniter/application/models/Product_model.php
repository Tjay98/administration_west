<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    public function get_categories(){
        $results = $this->db->get('categories')->result_array();

        return $results;
    }

    public function get_products(){
        $results = $this->db->get('products')->result_array();

        return $results;
    }

    public function get_detail_products($id){
        $this->db->where('products.id',$id);
        $this->db->from('products');
        $this->db->join('companies','companies.id = products.company_id','LEFT');
        $this->db->join('categories','categories.id = products.category_id','LEFT');
        $result = $this->db->get()->row_array();

        return $result;

    }

    public function get_companies(){
        $query=$this->db->get('companies');
        $return=array();
        foreach($query->result() as $company){
            $return[$company->company_name]=$company;
            $return[$company->image]=$company;
            $return[$company->description]=$company;
            //$return[$company->status]=$company;
        }
        return $return;
        }


}