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

        $payment_methods=$this->Sale_model->payment_methods();
        if(!$admin){
            $user_id=$this->session->userdata('user_id');
            $company_id=$this->Client_model->get_company_by_user($user_id); 
    
            $sales=$this->Sale_model->get_company_sale_groups($company_id);
        }else{  
            $sales=$this->Sale_model->get_all_sale_groups();

            
        }

        if(!empty($sales)){
            /* print_R($sales);die; */
            foreach($sales as $sale){
                $id=$sale['id'];

                
                $client=$sale['username'];
                $address='<button class="btn btn-md btn-info" onclick="show_address('.$sale['id'].')">Ver moradas</button>';

                if($sale['status']==0){
                    $status="<button class='btn btn-md btn-info'>Por processar</button>";
                }elseif($sale['status']==1){
                    $status="<button class='btn btn-md btn-warning' disabled>Enviado</button>";
                }elseif($sale['status']==2){
                    $status="<button class='btn btn-md btn-info'>Cancelado</button>";
                }else{
                    $status='';
                }

                $payment='';
                foreach($payment_methods as $payments){
                    if($sale['payment_method_id']==$payments['id']){
                        $payment= $payments['name'];
                    }
                }

                $total=$sale['total_price'];
                $created_date=$sale['created_date'];

                
                $button1="<button class='btn btn-md btn-warning btn_white_color' onclick='edit_sale(".$id.")' ><i class='fa fa-pencil'></i></button>";
                $button2="<button class='btn btn-md btn-danger btn_white_color' onclick='delete_sale(".$id.")' ><i class='fa fa-trash-o'></i></button>";


                $actions=$button1.$button2;

                    $data[]=[
                        $id,
                        $client,
                        $address,
                        $status,
                        $payment,
                        $total,
                        $created_date,
                        $actions,

                    ];

            } 

            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        }    
    }

    public function add(){
        if(empty($this->input->post())){
            if($this->session->userdata('role_id')==3){
                $admin=true;
            }else{
                $admin=false;
            }
    
            if(!$admin){
                $user_id=$this->session->userdata('user_id');
                $company_id=$this->Client_model->get_company_by_user($user_id); 
                $data['products']=$this->Product_model->products_by_company($company_id);
            }else{
                $data['products']=$this->Product_model->get_products();
            }
    
            $data['page_title']="Criar venda";
            $data['clients']=$this->Client_model->get_clients();
            
            
            $data['categories']=$this->Category_model->get_categories();
            $data['companies']=$this->Company_model->get_companies();
            $this->load_admin_views('backend/sales/crud',$data);
        }else{

        }
    }

    public function client_address(){
        if(!empty($this->input->post('user_id'))){
            $client_id=$this->input->post('user_id');
            $addresses=$this->Client_model->get_client_addresses($client_id);

            echo json_encode($addresses);
        }
        
    }
}