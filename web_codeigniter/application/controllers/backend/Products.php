<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @since : 8 december 2020
 */
class Products extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
        $this->load->model('Client_model');
    }

    public function index(){
        $this->is_admin_logged();
        $data['page_title']="Produtos";
        $data['categories']=$this->Category_model->get_categories();
        $data['companies']=$this->Company_model->get_companies();

        /* print_r($data); */
        $this->load_admin_views('backend/products/index',$data);
    }

    public function get_datatable(){
        $this->is_admin_logged();
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }


        if(!$admin){
            $user_id=$this->session->userdata('user_id');
            $company_id=$this->Client_model->get_company_by_user($user_id); 
    
            $products=$this->Product_model->products_by_company($company_id);
        }else{  
            $products=$this->Product_model->get_products();

            
        }

        if(!empty($products)){
            foreach($products as $product){
                $id=$product['id'];
                if(!empty($product['image'])){
                    $image='<img alt="imagem '.$product['product_name'].'" src="'.base_url('uploads/products/'.$product['image']).'" width="100" >';/* $product['image']; */
                }else{
                    $image='Não tem';
                }
                
                $product_name=$product['product_name'];
                $stock=$product['quantity_in_stock'];
                $category=$product['category_name'];
                $company=$product['company_name'];
                $price=$product['price'];
                $price_without_iva=$product['price_without_iva'];
                $iva_value=$product['price_iva'];
                $created_date=$product['created_date'];

                
                $button1="<button class='btn btn-md btn-warning btn_white_color' onclick='show_edit_product(".$id.")' ><i class='fa fa-pencil'></i></button>";


                $actions=$button1;
                


                $data[]=[
                    $id,
                    $image,
                    $product_name,
                    $stock,
                    $category,
                    $company,
                    $price,
                    $price_without_iva,
                    $iva_value,
                    $created_date,
                    $actions,

                ];
            } 

            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        }    
    }

    public function show_product($id){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }
        $product=$this->Product_model->get_detail_products($id);


        if(!$admin){
            if($product['store_id']==$this->session->userdata('store_id')){
                echo json_encode($product);
            }
        }else{
            echo json_encode($product);
        }
        /* print_r($product); */
    }

    public function add(){

    }

    public function edit(){

    }
}
