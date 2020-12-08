<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{

public function get_categories(){
        $results = $this->db->get('categories')->result_array();
        return $results;
    }
}