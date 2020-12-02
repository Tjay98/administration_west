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
        $id=$this->session->userdata('user_id');

        $data['sales']=$this->Sale_model->get_user_sales($id);
        
        foreach($data['sales'] as $sale){
            foreach($sale as $s){
                print_r($s);
            }

        }

        
        //shipping = morada envio
        //billing = morada faturação

        //mostrar produtos
    }
}
