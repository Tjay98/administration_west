<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Restful extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Client_model');
        $this->load->model('Category_model');
        $this->load->model('Company_model');
        $this->load->model('Sale_model');
    }
    /*
        ERROR MESSAGE TYPES
        200 Success - The request was well formed
        400 Bad Request — Client sent an invalid request — such as lacking required request body or parameter
        401 Unauthorized — Client failed to authenticate with the server
        403 Forbidden — Client authenticated but does not have permission to access the requested resource
        404 Not Found — The requested resource does not exist
        412 Precondition Failed — One or more conditions in the request header fields evaluated to false
        500 Internal Server Error — A generic error occurred on the server
        503 Service Unavailable — The requested service is not available

    */

    public function generate_error_message($type,$extra_message=''){

        $array['time'] = date("Y-m-d H:i:s");
        $array['status'] = $type;
        
        switch ($type) {
            case 200:

                $array['message']="Success";
                break;

            case 400:

                $array['message']="Bad Request";
                break;

            case 401:

                $array['message']="Unauthorized";
                break; 

            case 403:

                $array['message']="Forbidden";
                break;
                
            case 404:

                $array['message']="Not Found";
                break;

            case 412:

                $array['message']="Precondition Failed";
                break;

            case 500:

                $array['message']="Internal Server Error";
                break;

        }

        if(!empty($extra_message)){
            $array['detail'] = $extra_message;
        }
        
        return $array;
    }

    public function get_products(){
        $products=$this->Product_model->get_products();
        
        if(!empty($products)){
            /*foreach($products as $product){
                if($product['quantity']>0){
                    $data[]=$product;
                }
            }
            echo json_encode($data, JSON_PRETTY_PRINT); */
            echo json_encode($products, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_product($id){
        $product=$this->Product_model->get_detail_products($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    public function search_this_product($search){
        $products=$this->Product_model->search_product($search);

        if(!empty($products)){
            $array=$this->generate_error_message(200,"Produto encontrado para o pesquisado");
            $array['products']=$products;
            echo json_encode($array, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_products_by_company($id){
        $product=$this->Product_model->products_by_company($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    public function get_products_by_category($id){
        $product=$this->Product_model->get_products_by_categories($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    //funçao de login esta com problemas a validar a password. descobrir porquê

    public function login(){
        if( (!empty($this->input->post('email'))) && (!empty($this->input->post('password'))) ){
            $login_form=[
                'email'=>strtolower($this->input->post('email')),
                'password'=>$this->input->post('password'),
            ];
            $validate=$this->Client_model->verify_login($login_form);
            /*print_R(json_encode($validate));
            die; */
            if(!empty($validate['unique'])){
                $array=$this->generate_error_message(200,"Login successful");
                $array['key']=$validate['unique'];
            }else{
                $array=$this->generate_error_message(401,"Invalid login");
            }
        }else{
            $array=$this->generate_error_message(400,'Invalid method');
        }

        echo json_encode($array, JSON_PRETTY_PRINT);
        /* print_R($this->input->post()); */
    }

    public function register(){
        /* print_r($this->input->post()); */
        if( (!empty($this->input->post('username'))) && (!empty($this->input->post('email'))) && (!empty($this->input->post('password'))) && (!empty($this->input->post('phone_number'))) && (!empty($this->input->post('birthday')))){
            $user=strtolower($this->input->post('username'));
            $email=strtolower($this->input->post('email'));
        
            //converter apenas o primeiro elemento de cada palavra para maiusculo
            $username=ucwords($user);

            //preenche o array 
            $registo_form=[
                'username'=>$username,
                'email'=>$email,
                'role_id'=>1,
                'phone_number'=>$this->input->post('phone_number'),
                'birthday_date'=>date("Y-m-d",strtotime($this->input->post('birthday'))),
                'password_hash'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            ];
            

            $validate=$this->Client_model->register_client($registo_form);
            if(empty($validate)){
                $array=$this->generate_error_message(200,"Register successful");
            }else{
                $array=$this->generate_error_message(401,'The credentials are already in use');
            }

           
        }else{
            $array=$this->generate_error_message(400,'Invalid method');
        }
        echo json_encode($array, JSON_PRETTY_PRINT);
    }

    public function get_categories(){
        $categories=$this->Category_model->get_categories();
        if(!empty($categories)){
            echo json_encode($categories, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_category($id){
        $category=$this->Category_model->get_category_by_id($id);
        if(!empty($category)){
            echo json_encode($category, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_companies(){
        $companies=$this->Company_model->get_companies();
        if(!empty($companies)){
            echo json_encode($companies, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_company($id){
        $company=$this->Company_model->get_company_by_id($id);
        if(!empty($company)){
            echo json_encode($company, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }


    public function get_profile(){
        if(!empty($this->input->post('profile_key'))){
            $profile_key= $this->input->post('profile_key');
            $check_profile=$this->Client_model->get_profile_by_key($profile_key);

            if( (!empty($check_profile['user_id'])) && (!empty($check_profile['username'])) && (!empty($check_profile['email'])) && (!empty($check_profile['phone_number'])) && (!empty($check_profile['birthday_date']))){
                $array=$this->generate_error_message(200);
                $array['profile']=$check_profile;
            }else{
                $array=$this->generate_error_message(404);
            }
        }else{
            $array=$this->generate_error_message(404);
        }
        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    public function change_password(){
        if(!empty($this->input->post('profile_key'))){
            $profile_key= $this->input->post('profile_key');
            $old_password= $this->input->post('old_password');
            $new_password= $this->input->post('new_password');

            //se nao estiver vazio
            if(!empty($this->input->post('old_password'))){
                $password_form=[
                    'old_password'=>$this->input->post('old_password'),
                    'password_hash'=>password_hash($this->input->post('new_password'),PASSWORD_DEFAULT),
                ];
                $validate=$this->Client_model->new_password_by_key($password_form, $profile_key);
                if(empty($validate)){
                    //if change password happens correctly
                    $array=$this->generate_error_message(200,"Change password successful");
                }else{
                    $array=$this->generate_error_message(401,'Alguma coisa errada');
                }
            }else{
                //se estiver vazio
                $array=$this->generate_error_message(404);
            }
        } else{
            $array=$this->generate_error_message(400,'Invalid method');
        }
        echo json_encode($array, JSON_PRETTY_PRINT);
    }

    public function get_shipping_address(){

        if(!empty($this->input->post('profile_key'))){
            $profile_key= $this->input->post('profile_key');
            $check_shipping=$this->Client_model->get_shipping_address_by_key($profile_key);
            
            if( (!empty($check_shipping['user_id'])) && (!empty($check_shipping['name'])) ){
                $array=$this->generate_error_message(200);
                $array['shipping_address']=$check_shipping;
            }else{
                $array=$this->generate_error_message(404);
                
            }
            
        }else{
            $array=$this->generate_error_message(404);
        }
        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    
    public function get_billing_address(){
        if(!empty($this->input->post('profile_key'))){
            $profile_key= $this->input->post('profile_key');
            $check_billing=$this->Client_model->get_billing_address_by_key($profile_key);

            if( (!empty($check_billing['user_id'])) && (!empty($check_billing['name'])) ){
                $array=$this->generate_error_message(200);
                $array['billing_address']=$check_billing;
            }else{
                $array=$this->generate_error_message(404);
                
            }
            
            
        }else{
            $array=$this->generate_error_message(404);
        }
        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    public function edit_profile(){
        if(!empty($this->input->post('profile_info'))){
            $profile=$this->input->post('profile_info');

            
        }
    }

    public function show_payment_methods(){
        $methods=$this->Sale_model->payment_methods();
        echo json_encode($methods, JSON_PRETTY_PRINT);
    }

    public function create_sale(){
        if(!empty($this->input->post('sales'))){
            $sales=$this->input->post('sales');
            $user_info=$this->input->post('user_info');
            $payment_method=$this->input->post('payment_method');


            $profile=$this->Client_model->get_profile_by_key($user_info['profile_key']);


            $this->db->where('user_id',$profile['user_id']);
            $billing_address=$this->db->get('billing_address')->row_array();
            if(!empty($billing_address)){
                $this->db->where('user_id',$profile['user_id']);
                $this->db->update('billing_address',$user_info['billing_address']);
            }else{
                $this->db->where('user_id',$profile['user_id']);
                $this->db->insert('billing_address',$user_info['billing_address']);
            }
            

            $this->db->where('user_id',$profile['user_id']);
            $shipping_address=$this->db->get('shipping_address')->row_array();
            if(!empty($billing_address)){
                $this->db->where('user_id',$profile['user_id']);
                $this->db->update('shipping_address',$user_info['shipping_address']);
            }else{
                $this->db->where('user_id',$profile['user_id']);
                $this->db->insert('shipping_address',$user_info['shipping_address']);
            }

            $sale_data=[
                'user_id'=>$client_id,
                'billing_address_id'=>$user_info['billing_address']['id'],
                'shipping_address_id'=>$user_info['shipping_address']['id'],
                'payment_method_id'=>$payment_method,
                'total_price'=>$total_price,
                'total_iva'=>$total_price_iva,

            ];
            $this->db->insert('sales_group',$sale_data);
            $sale_group_id=$this->db->insert_id();
            if(!empty($sale_group_id)){
                $total_price = 0;
                $total_iva = 0;
                foreach($sales as $sale){
                    $sale_products[]=[
                        'sale_group_id'=>$sale_group_id,
                        'sale_product_id'=>$sale['id'],
                        'quantity'=>$sale['quantity'],
                        'price'=>$sale['price'],
                        'price_iva'=>$sale['iva'],
                    ];
                }

                $reduce= $this->Sale_model->reduce_stock($sale_products);
                if($reduce=="success"){
                    $this->db->insert_batch('sales_product',$sale_product);
                    $array=$this->generate_error_message(200,'Compra efetuada com sucesso');
                    echo json_encode($array,JSON_PRETTY_PRINT);
                }else{
                    $this->db->where('id',$sale_group_id);
                    $this->db->delete('sales_group');

                    $array=$this->generate_error_message(412,'Quantidade de um dos produtos é insuficiente.Verifique o pedido');
                    echo json_encode($array,JSON_PRETTY_PRINT);
                }
            }else{
                $array=$this->generate_error_message(404,'Alguma informação está errada');
                echo json_encode($array,JSON_PRETTY_PRINT);
            }

        }
    }

    public function new_create_sale(){
        $user_key=$this->input->post('profile_key');
        $payment_method = $this->input->post('payment_id');

        if(!empty($user_key) && !empty($payment_method)){
            $profile = $this->Client_model->get_profile_by_key($user_key);
            $shipping_address = $this->Client_model->get_shipping_address_by_key($user_key);
            $billing_address = $this->Client_model->get_billing_address_by_key($user_key);

            $cart_products= $this->Sale_model->get_user_cart($profile['user_id']);

            $sale_data=[
                'user_id'=>$profile['user_id'],
                'billing_address_id'=>$shipping_address['id'],
                'shipping_address_id'=>$billing_address['id'],
                'payment_method_id'=>$payment_method,
                'total_price'=>0,
                'total_iva'=>0,

            ];
            $this->db->insert('sales_group',$sale_data);
            $sale_group_id=$this->db->insert_id();
            if(!empty($sale_group_id)){

                $total_price = 0;
                $total_iva = 0;

                foreach($cart_products as $cart){

                    $price = $cart['price'] * $cart['quantity'];
                    $price_iva = $cart['price_iva'] * $cart['quantity'];
                    
                    $total_price+=$price;
                    $total_iva+=$price_iva;

                    $sale_products[]=[
                        'sale_group_id'=>$sale_group_id,
                        'sale_product_id'=>$cart['product_id'],
                        'quantity'=>$cart['quantity'],
                        'price'=>$price,
                        'price_iva'=>$price_iva,
                    ];
                }

                $reduce=$this->Sale_model->reduce_stock($sale_products);
                if($reduce=="success"){
                    $this->db->insert_batch('sales_product',$sale_products);

                    $this->db->where('id',$sale_group_id);
                    $this->db->set('total_price',$total_price);
                    $this->db->set('total_iva',$total_iva);
                    $this->db->update('sales_group');

                    $this->db->where('user_id',$profile['user_id']);
                    $this->db->delete('user_cart');
                    
                    $array=$this->generate_error_message(200,'Compra efetuada com sucesso');
                    echo json_encode($array,JSON_PRETTY_PRINT);
                }else{
                    //apagar o grupo quando falha
                    $this->db->where('id',$sale_group_id);
                    $this->db->delete('sales_group');

                    $array=$this->generate_error_message(412,'Quantidade de um dos produtos é insuficiente.Verifique o pedido');
                    echo json_encode($array,JSON_PRETTY_PRINT);
                }
            }else{
                $array=$this->generate_error_message(404,'Alguma informação está errada');
                echo json_encode($array,JSON_PRETTY_PRINT);
            }
        }
    }

    public function add_product_cart(){
       /*  session_destroy(); */
        $product_id= $this->input->post('product');
        $quantity= $this->input->post('quantity');
        $user_key=$this->input->post('profile_key');

        if( (!empty($product_id)) && (!empty($quantity))  && !empty($user_key)){

            $profile=$this->Client_model->get_profile_by_key($user_key);

            $cart = $this->Sale_model->get_cart_by_user_product_id($profile['user_id'],$product_id);


            if(!empty($cart)){
                $old_quantity=$cart['quantity'];
                if( ($old_quantity + ($quantity)) <= 0){
                    //método para prevenir se a quantidade é inferior a 0, caso seja apaga o produto tal como o delete product
                    $this->db->where('user_id',$profile['user_id']);
                    $this->db->where('product_id',$product_id);
                    $this->db->delete('user_cart');
                    $array=$this->generate_error_message(200,'Produto apagado do carrinho');
                }else{
                    //verifica se a quantidade é superior a 0, caso seja atualiza
                    $new_quantity = $old_quantity + $quantity;
                    $this->db->where('user_id',$profile['user_id']);
                    $this->db->where('product_id',$product_id);
                    $this->db->set('quantity',$new_quantity);
                    $this->db->update('user_cart');
                    $array=$this->generate_error_message(200,'Produto atualizado');
                }

            }else{
                //adiciona o produto ao carrinho
                if($quantity > 0){
                    $product_data= [
                        'user_id'=>$profile['user_id'],
                        'product_id'=>$product_id,
                        'quantity'=>$quantity,
                    ];
                    
                    $this->db->insert(' user_cart',$product_data);
                    $insert_id=$this->db->insert_id();

                    $array=$this->generate_error_message(200,'Produto inserido com sucesso');
                }

            }

        }else{
            $array=$this->generate_error_message(404,'Alguma informação está errada');
        }


        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    public function delete_product_cart(){
        $product_id= $this->input->post('product');
        $user_key=$this->input->post('profile_key');

        if( (!empty($product_id)) && !empty($user_key)){

            $profile=$this->Client_model->get_profile_by_key($user_key);

            $this->db->where('user_id',$profile['user_id']);
            $this->db->where('product_id',$product_id);
            $this->db->delete('user_cart');

            $array=$this->generate_error_message(200,'Produto apagado do carrinho');

        }else{
            
            $array=$this->generate_error_message(404,'Alguma informação está errada');
        }
        
        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    public function view_cart(){
        $user_key=$this->input->post('profile_key');

        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);

            $cart= $this->Sale_model->get_user_cart($profile['user_id']);
            /* print_r($cart); */
            if(!empty($cart)){
                $array=$this->generate_error_message(200);
                $array['cart']=$cart;
    
                
            }else{
                $array=$this->generate_error_message(404,'Carrinho vazio');
               
            }
            echo json_encode($array,JSON_PRETTY_PRINT);


        }
    }

    public function create_shipping_address(){
        $user_key=$this->input->post('profile_key');

        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);
            $shipping_address=$this->Client_model->get_shipping_address_by_key($user_key);
           
            $name=$this->input->post('name');
            $nif=$this->input->post('nif');
            $contact=$this->input->post('contact');
            $city=$this->input->post('city');
            $address=$this->input->post('address');
            $zip=$this->input->post('zip');
            
            if( $name && $nif && $contact && $city && $address && $zip){
                    $data=[
                        'user_id'=>$profile['user_id'],
                        'name'=>$name,
                        'nif'=>$nif,
                        'contact_number'=>$contact,
                        'city'=>$city,
                        'address'=>$address,
                        'zip_code'=>$zip,
                        
                    ];
                /* print_r($shipping_address); */
                if(empty($shipping_address['id'])){
                    $this->db->insert('shipping_address',$data);
                    $update = $this->db->insert_id();
                   /*  print_r($update);die; */
                }else{
                    $data['modified_date']=date('Y-m-d H:i:s');
                    $this->db->where('id',$shipping_address['id']);
                    $update=$this->db->update('shipping_address',$data);
                }

                if($update){
                    $array=$this->generate_error_message(200);
                }

            }else{
                $array=$this->generate_error_message(404,'Alguma informação está em falta');
            }

        }else{
            $array=$this->generate_error_message(404,'Alguma informação está em falta');
        }
        echo json_encode($array,JSON_PRETTY_PRINT);
    }



    public function create_billing_address(){
        $user_key=$this->input->post('profile_key');
        

        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);
            $billing_address=$this->Client_model->get_billing_address_by_key($user_key);

            $name=$this->input->post('name');
            $nif=$this->input->post('nif');
            $contact=$this->input->post('contact');
            $city=$this->input->post('city');
            $address=$this->input->post('address');
            $zip=$this->input->post('zip');
            
            if( $name && $nif && $contact && $city && $address && $zip){
                $data=[
                    'user_id'=>$profile['user_id'],
                    'name'=>$name,
                    'nif'=>$nif,
                    'contact_number'=>$contact,
                    'city'=>$city,
                    'address'=>$address,
                    'zip_code'=>$zip,
                    
                ];

                if(empty($billing_address['id'])){
                    $this->db->insert('billing_address',$data);
                    $update = $this->db->insert_id();
                }else{
                    $data['modified_date']=date('Y-m-d H:i:s');
                    $this->db->where('id',$billing_address['id']);
                    $update=$this->db->update('billing_address',$data);
                }

                if($update){
                    $array=$this->generate_error_message(200);
                }
            }else{
                $array=$this->generate_error_message(404,'Alguma informação está em falta');
            }
            
        }else{
            $array=$this->generate_error_message(404,'Alguma informação está em falta');
        }
        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    public function show_user_purchases(){

        $user_key=$this->input->post('profile_key');
    
        if(!empty($user_key)){
            $profile=$this->Client_model->get_profile_by_key($user_key);

            if(!empty($profile)){
                $sales=$this->Sale_model->get_user_sales($profile['user_id']);

                $array=$this->generate_error_message(200);
                $array['sales']=$sales;
            }else{
                $array=$this->generate_error_message(400,'Alguma informação está errada');
            }
            
        }else{
            $array=$this->generate_error_message(404,'Alguma informação está em falta');
        }

        echo json_encode($array,JSON_PRETTY_PRINT);
    }

    

}
