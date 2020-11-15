<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 * @last_update : 15 november 2020
 */
class Clients extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    }

    public function index(){
        
    }
    
}