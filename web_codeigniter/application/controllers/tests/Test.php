<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Test extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //Todos os modelos
        $this->load->model('Product_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
        $this->load->model('Client_model');
        $this->load->model('Contact_model');
        $this->load->model('Sale_model');

        //Biblioteca para usar o unit test
        $this->load->library("unit_test");

    }

    private function login($email, $password){
        $login_form=[
            'email'=>strtolower($email),
            'password'=>$password,
        ];
        $validate=$this->Client_model->verify_login($login_form);
        if(!empty($validate['unique'])){
            return 'success';
        }else{
            return $validate;
        }    
    }

    private function password($user_id, $old_password, $password_hash){
        $id=$user_id;
            $password_form=[
                'old_password'=>$old_password,
                'password_hash'=>password_hash($password_hash,PASSWORD_DEFAULT),
            ];
        $validate=$this->Client_model->new_password_client($password_form, $id);
        if(empty($validate)){
            return true;            
        }else{
            echo $validate;
        }        
    }
 
    private function add_to_cart($user_id, $product_id,$quantity){


        $cart = $this->Sale_model->get_cart_by_user_product_id($user_id, $product_id, $quantity);
        if(!empty($cart)){
            $old_quantity=$cart['quantity'];
            if( ($old_quantity + ($quantity)) <= 0){
                //método para prevenir se a quantidade é inferior a 0, caso seja apaga o produto tal como o delete product
                $this->db->where('user_id',$user_id);
                $this->db->where('product_id',$product_id);
                $this->db->delete('user_cart');
                return true; 

            }else{
                //verifica se a quantidade é superior a 0, caso seja atualiza
                $new_quantity = $old_quantity + $quantity;
                $this->db->where('user_id',$user_id);
                $this->db->where('product_id',$product_id);
                $this->db->set('quantity',$new_quantity);
                $this->db->update('user_cart');
                return true; 

            }
        }else{
            //adiciona o produto ao carrinho
            if($quantity > 0){
                $product_data= [
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'quantity'=>$quantity,
                ];
                $this->db->insert('user_cart',$product_data);
                $insert_id=$this->db->insert_id();
                return true; 
            }
         }
         return false;
    }

    private function finish_sale($user_id,$payment_method){
        $addresses=$this->Client_model->get_client_addresses($user_id);

        $cart_products= $this->Sale_model->get_user_cart($user_id);

        $sale_data=[
            'user_id'=>$user_id,
            'billing_address_id'=>$addresses['billing_address']['id'],
            'shipping_address_id'=>$addresses['shipping_address']['id'],
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

                $this->db->where('user_id',$user_id);
                $this->db->delete('user_cart');
                
                return true;
            }else{
                return false;
            }
        }
    }

    private function change_sale_status($user_id){
        $this->db->select('id');
        $this->db->where('user_id',$user_id);
        $sale_group=$this->db->get('sales_group')->row_array();

        if(!empty($sale_group)){
            $sale_group_id=$sale_group['id'];

            $this->db->where('sale_group_id',$sale_group_id);
            $this->db->set('status',1);
            $update=$this->db->update('sales_product');

            if($update){
                $this->db->where('id',$sale_group_id);
                $this->db->set('status',2);
                $sale_group_update=$this->db->update('sales_group');

                if($sale_group_update){
                    return true;
                }
            }
        }

    }

    public function index(){

        // Função de mudar password
        $test = $this->password(1, 'Password-123', 'Not_fail_123');
        $expected_result = true;
        $test_name = 'Mudar a password';
        echo $this->unit->run($test, $expected_result, $test_name);
        
        //Função para propositadamente falhar o login
        $test = $this->login('rodolfo-barreira@hotmail.com', 'Fail');
        $expected_result = 'success';
        $test_name = 'Login Fail';
        echo $this->unit->run($test, $expected_result, $test_name);

        // Função de login
        $test = $this->login('rodolfo-barreira@hotmail.com', 'Not_fail_123');
        $expected_result = 'success';
        $test_name = 'Login sucessful';
        echo $this->unit->run($test, $expected_result, $test_name);

        // Função para dar reset à password
        $test = $this->password(1, 'Not_fail_123', 'Password-123');
        $expected_result = true;
        $test_name = 'Reset Password';
        echo $this->unit->run($test, $expected_result, $test_name);
         
        //Função de Carrinho
        $test = $this->add_to_cart(1, 3 , 2);
        $expected_result =true;
        $test_name = 'Add product to cart';
        echo $this->unit->run($test, $expected_result, $test_name);

        //Função para criar venda
        $test=$this->finish_sale(1,1);
        $expected_result=true; 
        $test_name="Create sale";
        echo $this->unit->run($test,$expected_result,$test_name);

        //Função para criar produto backend
        $test=$this->change_sale_status(1);
        $expected_result=true; 
        $test_name="Change sale status";
        echo $this->unit->run($test,$expected_result,$test_name);

        //Função para apagar produto backend
    }    
}
