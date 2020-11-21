<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();

    }

    public function index(){

        $this->load_views('frontend/home');

    }

    //implementar
    public function contactos(){
        $this->load_views('frontend/contacts');
    }

    
}