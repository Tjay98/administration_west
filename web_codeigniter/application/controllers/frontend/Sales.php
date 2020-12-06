<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 02 december 2020
 */
class Sales extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Sale_model');
    }

    function sale_history(){
        $this->is_user_logged();

        $id=$this->session->userdata('user_id');

        $data['sales']=$this->Sale_model->get_user_sales($id);
        
        $this->load_views('frontend/clients/historico', $data);
        

        
        //shipping = morada envio
        //billing = morada faturação

        //mostrar produtos
    }

    function sale_detail($sale_id){
        
        $this->is_user_logged();

        //$id=$this->session->userdata('user_id');


        $data['sales']=$this->Sale_model->get_sale($sale_id);
        
       
               // print_r($data);
            
        $this->load_views('frontend/clients/history_details', $data);
    }
}
