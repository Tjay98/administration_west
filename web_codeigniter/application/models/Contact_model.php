<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{

    public function get_contacts(){
        $this->db->where('status !=',3);
        $contacts = $this->db->get('contact_form')->result_array();
        return $contacts;
    }

    public function get_contact_by_id($contact_id){
        $this->db->where('id',$contact_id);
        $contact = $this->db->get('contact_form')->row_array();

        return $contact;
    }
    

    public function count_by_status($status=''){
        if(!empty($status)){
            $this->db->where('status',$status);

        }else{
            $this->db->where('status != ',3);
        }
        $count=$this->db->get('contact_form')->num_rows();

        return $count;
    }
}