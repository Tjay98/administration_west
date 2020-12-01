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

    function load_admin_views($viewName, $data = NULL){
        $this->load->view('backend/template/header',$data);
        $this->load->view('backend/template/sidebar');
        $this->load->view($viewName);
        $this->load->view('backend/template/footer');
    }


    //return admin url
    function admin_url(){
        $admin_url=$this->config->item('admin_url');

        return $admin_url;
    }

    function is_user_logged(){
        if(empty($this->session->userdata('role_id'))){
            return redirect('');
        }
    }

    function is_admin_logged(){
        if($this->session->userdata('role_id') <= 1){
            return redirect('/admin');
        }
    }

    /*      
        metodo de ver os segmentos do url \/   
        $segmento_url=$this->uri->segment_array(); 
        print_r($segmento_url); */
}