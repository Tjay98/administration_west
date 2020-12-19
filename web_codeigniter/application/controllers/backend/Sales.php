<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @since : 8 december 2020
 */
class Sales extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
        $this->load->model('Client_model');
        $this->load->model('Sale_model');
        $this->is_admin_logged();
    }

    public function index(){
        
        $data['page_title']="Vendas";
        $data['categories']=$this->Category_model->get_categories();
        $data['companies']=$this->Company_model->get_companies();
        $this->load_admin_views('backend/sales/index',$data);

    }


    public function get_datatable(){
       
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }else{
            $admin=false;
        }


        if(!$admin){
            $user_id=$this->session->userdata('user_id');
            $company_id=$this->Client_model->get_company_by_user($user_id); 
    
            $sales=$this->Sale_model->get_sale_by_company($company_id);
        }else{  
            $sales=$this->Sale_model->get_all_sold_products();

            
        }

        if(!empty($sales)){
            foreach($sales as $sale){
                $id=$sale['id'];

                
                $product_name=$sale['product_name'];
                $client='';
                $company='';
                $address='';
                $status='';
                $payment='';
                $total='';
                $created_date=$sale['created_date'];

                
                $button1="<button class='btn btn-md btn-warning btn_white_color' onclick='edit_sale(".$id.")' ><i class='fa fa-pencil'></i></button>";
                $button2="<button class='btn btn-md btn-danger btn_white_color' onclick='delete_sale(".$id.")' ><i class='fa fa-trash-o'></i></button>";


                $actions=$button1.$button2;
                

                if($admin){
                    $data[]=[
                        $id,
                        $product_name,
                        $client,
                        $company,
                        $address,
                        $status,
                        $payment,
                        $total,
                        $created_date,
                        $actions,

                    ];
                }else{
                    $data[]=[
                        $id,
                        $product_name,
                        $client,
                        //$company,
                        $address,
                        $status,
                        $payment,
                        $total,
                        $created_date,
                        $actions,

                    ];
                }
            } 

            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        }    
    }

}