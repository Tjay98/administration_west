<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{

    public function get_all_companies(){
        $companies = $this->db->get('companies')->result_array();
        return $companies;
    }

    public function get_companies(){
        $this->db->where('status',1);
        $companies = $this->db->get('companies')->result_array();
        return $companies;
    }

    public function get_company_by_id($company_id){
        $this->db->where('id',$company_id);
        $company = $this->db->get('companies')->row_array();

        return $company;
    }
    
}