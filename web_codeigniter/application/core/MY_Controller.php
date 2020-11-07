<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : MY_Controller
 * Base Controller to control over all the classes
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */

class MY_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function load_views($viewName, $pageInfo = NULL, $headerInfo = NULL, $footerInfo = NULL){
        $this->load->view('frontend/template/new_header',$headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('frontend/template/new_footer', $footerInfo);
    }

    function load_admin_views($viewName, $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){
        //implement later
    }


    //return admin url
    function admin_url(){
        $admin_url=$this->config->item('admin_url');

        return $admin_url;
    }
    
}