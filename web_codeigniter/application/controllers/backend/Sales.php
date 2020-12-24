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
/*         $company_id=1;
        $sales=$this->Sale_model->get_company_sale_groups($company_id); */

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
                    $status="<button class='btn btn-md btn-warning' onclick='show_status(".$sale['id'].",".$sale['status'].")'>Por processar</button>";
                }elseif($sale['status']==1){
                    $status="<button class='btn btn-md btn-warning' style='background-color:#fd7e14;border-color:#fd7e14;' onclick='show_status(".$sale['id'].",".$sale['status'].")'>Processado</button>";
                }elseif($sale['status']==2){
                    $status="<button class='btn btn-md btn-info'  onclick='show_status(".$sale['id'].",".$sale['status'].")'>Enviado</button>";
                }elseif($sale['status']==3){
                    $status="<button class='btn btn-md btn-danger'' onclick='show_status(".$sale['id'].",".$sale['status'].")'>Cancelado</button>";
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
                $quantity=$sale['product_quantity'];
                
                /* $button1="<button class='btn btn-md btn-warning btn_white_color' onclick='edit_sale(".$id.")' ><i class='fa fa-pencil'></i></button>&nbsp;"; */

                if($sale['status']==0){
                    $button2="<a class='btn btn-md btn-danger btn_white_color' href='".base_url('admin/sales/delete/').$sale['id']."' ><i class='fa fa-trash-o'></i></a>";
                }else{
                    $button2='';
                }


                /* $actions=$button1.$button2; */

                    $data[]=[
                        $id,
                        $client,
                        $address,
                        $quantity,
                        $payment,
                        $total,
                        $created_date,
                        $status,
                        $button2,

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
            $sale=$this->input->post('sale');
            $client_id=$sale['user_info']['client_id'];
            $addresses=$this->Client_model->get_client_addresses($client_id);
            /* print_r($sale);die; */

            //inserções das moradas
            if(!empty($addresses['shipping_address'])){
                $this->db->where('user_id',$client_id);
                $this->db->update('shipping_address',$sale['shipping_address']);
                $shipping_address_id=$addresses['shipping_address']['id'];
            }else{
                $sale['shipping_address']['user_id']=$client_id;
                $this->db->insert('shipping_address',$sale['shipping_address']);
                $shipping_address_id=$this->db->insert_id();
            }

            if(!empty($addresses['billing_address'])){
                $this->db->where('user_id',$client_id);
                $this->db->update('billing_address',$sale['billing_address']);
                $billing_address_id=$addresses['billing_address']['id'];
            }else{
                $sale['billing_address']['user_id']=$client_id;
                $this->db->insert('billing_address',$sale['billing_address']);
                $billing_address_id=$this->db->insert_id();
            }

            if( (empty($addresses['billing_address'])) && (empty($sale['billing_address']))){

                $this->db->insert('billing_address',$sale['shipping_address']);
                $billing_address_id=$this->db->insert_id();
            }

            $total_price=0;
            $total_price_iva=0;
            foreach($sale['product'] as $product){
                $total_price+=$product['price'];
                $total_price_iva+=$product['iva'];
            }


            //implementar venda
            $sale_data=[
                'user_id'=>$client_id,
                'billing_address_id'=>$billing_address_id,
                'shipping_address_id'=>$shipping_address_id,
                'payment_method_id'=>1, //implementar melhor
                'total_price'=>$total_price,
                'total_iva'=>$total_price_iva,

            ];
            $this->db->insert('sales_group',$sale_data);
            $sale_group_id=$this->db->insert_id();

            if($sale_group_id){
                foreach($sale['product'] as $product){
                    $sale_product[]=[
                        'sale_group_id'=>$sale_group_id,
                        'sale_product_id'=>$product['id'],
                        'quantity'=>$product['quantity'],
                        'price'=>$product['price'],
                        'price_iva'=>$product['iva'],
                    ];
                    $this->Sale_model->reduce_stock($product['id'],$product['quantity']);
                }
                $this->db->insert_batch('sales_product',$sale_product);
            }
            redirect('admin/sales');
        }
    }

    public function client_address(){
        if(!empty($this->input->post('user_id'))){
            $client_id=$this->input->post('user_id');
            $addresses=$this->Client_model->get_client_addresses($client_id);

            echo json_encode($addresses);
        }

        if(!empty($this->input->post('sale_id'))){
            $sale_id=$this->input->post('sale_id');

            $this->db->select('user_id');
            $this->db->where('id',$sale_id);
            $sale=$this->db->get('sales_group')->row_array();


            $addresses=$this->Client_model->get_client_addresses($sale['user_id']);

            echo json_encode($addresses);

        }
        
    }

    public function edit($sale_id){

        if(!empty($this->input->post('product'))){
            $sales_products=$this->input->post('product');
            
            foreach($sales_products as $sale_product){
                //$this->db->where('')
                $sale_group_id=$sale_product['sale_group_id'];
                $this->db->where('id',$sale_product['sale_product_id']);
                $this->db->set('status',$sale_product['status']);
                $this->db->update('sales_product');
            }
            $this->db->select('count(sale_group_id) as still_processing');
            $this->db->where('sale_group_id',$sale_group_id);
            $this->db->where('status',0);
            $this->db->group_by('sale_group_id');
            $processing=$this->db->get('sales_product')->row_array();

            if(empty($processing)){
                $this->db->where('id',$sale_group_id);
                $this->db->set('status',1);
                $this->db->update('sales_group');
                echo "O estado da encomenda passou a estar tudo disponível para envio";
            }else{
                echo "Estado dos produtos selecionados foi alterado";
            }
            
        }else{
            
            $products=$this->Sale_model->get_sale_products($sale_id);
            if($this->session->userdata('role_id')==2){
                foreach($products as $product){
                    if($product['company_id']==$this->session->userdata('store_id')){
                        $data[]=$product;
                    }
                }
            }else{
                $data=$products;
            }
            
            echo json_encode($products, JSON_PRETTY_PRINT);
        }
    }

    public function delete($sale_id){
        $this->db->where('id',$sale_id);
        $this->db->set('status',3);
        $this->db->update('sales_group');
        redirect('admin/sales');
    }
    public function update_send_status($sale_id){
        $this->db->where('id',$sale_id);
        $this->db->set('status',2);
        $this->db->update('sales_group');
        echo "success";
    }
}