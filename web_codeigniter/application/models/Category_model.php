<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{

    public function get_categories(){
        $results = $this->db->get('categories')->result_array();
        return $results;
    }

    public function get_category_by_id($category_id){
        $this->db->where('id',$category_id);
        $category=$this->db->get('categories')->row_array();

        return $category;
    }
}