<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 19 december 2020
 */
class Contacts extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
        $this->load->model('Sale_model');
        $this->load->model('Product_model');
        $this->load->model('Company_model');
    }


    public function index(){
        
        $data['page_title']="Lista de contactos";
        $this->load_admin_views('backend/contacts/index',$data);

    }
}