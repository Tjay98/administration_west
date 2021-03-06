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
        setlocale(LC_TIME, 'Portuguese_Portugal');
        /* $this->load->library('cart'); */
        $this->load->model('Client_model');
    }

    function load_views($viewName, $pageInfo = NULL, $headerInfo = NULL, $footerInfo = NULL){
        if(!empty($this->session->userdata('user_id'))){
            $count_cart_items = $this->Client_model->count_user_cart($this->session->userdata('user_id'));
        }else{
            $count_cart_items=0;
        }
        
        
        $headerInfo['count_cart']=$count_cart_items;

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
            return redirect('admin/login');
        }else{
            $user_permissions=$this->Client_model->get_user_permission($this->session->userdata('user_id'));
            $controller=$this->uri->segment(2);
            $controller=strtolower($controller);
            
            $has_permission=false;
            if($controller!='' && $controller!='login' && $controller !='logout'){
                if(!empty($user_permissions)){
                    foreach($user_permissions as $permission){
                        if($permission['controller'] == $controller){
                            $has_permission=true;
                        }
    
                    }
    
    
                    if($has_permission==false){
                        /* $controller=$this->uri->segment(2);
                        $controller=strtolower($controller);
                        print_r($controller);
                        die; */
                        return redirect('admin/');
                    }
                }else{
                    return redirect('admin/');
                }
            }

        }
    }

    function already_logged(){
        if(!empty($this->session->userdata('username'))){

            if($this->session->userdata('role_id') <=1){
                return redirect('');
            }elseif($this->session->userdata('role_id')>1){
                return redirect('admin/');
            }
        }
    }
    
    

    /*      
        metodo de ver os segmentos do url \/   
        $segmento_url=$this->uri->segment_array(); 
        print_r($segmento_url); */
}