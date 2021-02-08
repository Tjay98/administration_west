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

    public function login($email, $password){
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

    public function password($user_id, $old_password, $password_hash, $repeat_password){
        $id=$user_id;
            $password_form=[
                'old_password'=>$old_password,
                'password_hash'=>password_hash($password_hash,PASSWORD_DEFAULT),
                'repeat_password'=>password_hash($repeat_password,PASSWORD_DEFAULT),
            ];
        $validate=$this->Client_model->new_password_client($password_form, $id);
        if(empty($validate)){
            return true;            
        }else{
            echo $validate;
        }        
    }
 
    public function add_to_cart($user_id, $product_id){

        $quantity= 1;

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

    public function index(){

        // Função de login
        $test = $this->login('rodolfo-barreira@hotmail.com', '123-Password');
        $expected_result = 'success';
        $test_name = 'Login sucessful';
        echo $this->unit->run($test, $expected_result, $test_name);


         // Função de mudar password
         $test = $this->password(3, 'Password', '123-Password', '123-Password');
         $expected_result = true;
         $test_name = 'Mudar a password';
         echo $this->unit->run($test, $expected_result, $test_name);

         
         //Função de Carrinho
        //  $test = $this->add_to_cart(4, 2);
        //  $expected_result =true;
        //  $test_name = 'Carrinho';
        //  echo $this->unit->run($test, $expected_result, $test_name);
 
 

    }    
}
