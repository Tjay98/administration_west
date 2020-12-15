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
        $this->is_admin_logged();
    }

    public function index(){
        
        $data['page_title']="Produtos";
        $data['categories']=$this->Category_model->get_categories();
        $data['companies']=$this->Company_model->get_companies();

        /* print_r($data); */
        $this->load_admin_views('backend/products/index',$data);
    }

    public function get_datatable(){
       
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
        if(!empty($this->input->post('product_name'))){
            $config['upload_path']          = base_url('/uploads/products');
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('product_image')){
                    $error = array('error' => $this->upload->display_errors());
                    $imagem='';

            }else{
                    $image_data = array('upload_data' => $this->upload->data());
                    $imagem=$image_data['file_name'];
                    
            }

            $category_id=$this->input->post('product_category');
            $price=$this->input->post('product_price');

            $category_info=$this->Category_model->get_category_by_id($category_id);

            if(!empty($category_info)){
                $iva=$category_info['iva']/100;
                
            }else{
                $iva=0.23;
            }
            
            $value_iva=round($price*$iva,2);
            $price_without_iva=round($price-$value_iva);

            $data=[
                'product_name'=>$this->input->post('product_name'),
                'image'=>$imagem,
                'small_description'=>$this->input->post('product_small_description'),
                'big_description'=>$this->input->post('product_big_description'),
                'category_id'=>$category_id,
                'company_id'=>$this->input->post('product_company'),
                'quantity_in_stock'=>$this->input->post('product_quantity'),
                'price'=>$price,
                'price_without_iva'=>$price_without_iva,
                'price_iva'=>$value_iva,
            ];
            $this->db->insert('products',$data);
        }
    }

    public function edit($product_id){
        if(!empty($this->input->post('product_name'))){
            
            $config['upload_path']          = './uploads/products';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('product_image')){
                    $error = array('error' => $this->upload->display_errors());
                    $imagem='';
                    print_R($error);die;


            }else{
                    $image_data = array('upload_data' => $this->upload->data());
                    $imagem=$image_data['file_name'];
                    
            }

            $category_id=$this->input->post('product_category');
            $price=$this->input->post('product_price');

            $category_info=$this->Category_model->get_category_by_id($category_id);

            if(!empty($category_info)){
                $iva=$category_info['iva']/100;
                
            }else{
                $iva=0.23;
            }
            
            $value_iva=round($price*$iva,2);
            $price_without_iva=round($price-$value_iva);

            $data=[
                'product_name'=>$this->input->post('product_name'),
                'image'=>$imagem,
                'small_description'=>$this->input->post('product_small_description'),
                'big_description'=>$this->input->post('product_big_description'),
                'category_id'=>$category_id,
                'company_id'=>$this->input->post('product_company'),
                'quantity_in_stock'=>$this->input->post('product_quantity'),
                'price'=>$price,
                'price_without_iva'=>$price_without_iva,
                'price_iva'=>$value_iva,
                
            ];

            $this->db->where('id',$product_id);
            $this->db->update('products',$data);
        }
    }

    public function delete($product_id){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }

        if($admin){
            $this->db->where('id',$product_id);
            $this->db->set('status','0');
            $this->db->update('products');
            echo "success";
        }else{
            $store_id=$this->session->userdata('store_id');
            $this->db->where('id',$product_id);
            $this->db->where('company_id',$store_id);
            $product_check=$this->db->get('products');
            if(empty($product_check)){
                echo "error";
            }else{
                $this->db->where('id',$product_id);
                $this->db->set('status','0');
                $this->db->update('products');
                echo "success";
            }
        }
    }

    public function test_ola(){
        $price=98;
        $value_iva=round($price*0.23,2);
        print_r($value_iva);
    }
}
