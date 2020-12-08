<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{

    public function get_companies(){
        $results = $this->db->get('companies')->result_array();
        return $results;
    }

    
}