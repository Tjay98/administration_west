<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    public function get_categories(){
        $query = $this->db->get('categories');
        $return=array();

        foreach($query->result() as $category){
            $return[$category->category_name]=$category;
        }
        return $return;
        }

    public function get_products(){
        $query = $this->db->get('products');
        $return=array();

        foreach($query->result() as $product){
            $return[$product->product_name]=$product;
            $return[$product->small_description]=$product;
            $return[$product->category_id]=$product;
            $return[$product->company_id]=$product;
            $return[$product->price]=$product;
            $return[$product->image]=$product;
        }
    return $return;
    }

    public function get_detail_products(){
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