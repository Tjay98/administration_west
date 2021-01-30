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
        $this->load->model('Product_model');
        $this->load->model('Client_model');

        
    }

    public function sale_history(){
        $this->is_user_logged();

        $id=$this->session->userdata('user_id');

        $data['sales']=$this->Sale_model->get_user_sales($id);
        
        $this->load_views('frontend/clients/purchase_history', $data);
        

        
        //shipping = morada envio
        //billing = morada faturação

        //mostrar produtos
    }

    public function sale_detail($sale_id){
        
        $this->is_user_logged();

        //$id=$this->session->userdata('user_id');


        $sale=$this->Sale_model->get_sale($sale_id);
       
        if($sale['user_id']==$this->session->userdata('user_id')){
            $data['sale']=$sale;
            $this->load_views('frontend/clients/purchase_history_details', $data);
        }else{
            return redirect('sales/history');
        }
    }

    public function cart(){
        $this->is_user_logged();
        $user_key = $this->session->userdata('user_id');
        if(!empty($user_key)){
            $cartItems=$this->Sale_model->get_user_cart($user_key);
            

            if(!empty($cartItems)){
                $data['cartItems']=$cartItems;
                $this->load_views('frontend/sales/cart', $data);

              
            }else{
                $this->load_views('frontend/sales/cart', $cartItems);

            }
        }
    }


    public function add_to_cart($id){

        $this->is_user_logged();
        $user_key = $this->session->userdata('user_id');

        $quantity= 1;

        // $product=$this->Product_model->get_detail_products($id);

        // $data=[
        //     'id'=>$product['id'],
        //     'quantity'=>1,
        //     'price'=>$product['price'],
        //     'iva'=>$product['price_iva'],
        //     'name'=>$product['product_name'],
        //     'image'=>$product['image'],
        // ];

        $cart = $this->Sale_model->get_cart_by_user_product_id($user_key, $id, $quantity);

        if(!empty($cart)){
            $old_quantity=$cart['quantity'];
            if( ($old_quantity + ($quantity)) <= 0){
                //método para prevenir se a quantidade é inferior a 0, caso seja apaga o produto tal como o delete product
                $this->db->where('user_id',$user_key);
                $this->db->where('product_id',$id);
                $this->db->delete('user_cart');

            }else{
                //verifica se a quantidade é superior a 0, caso seja atualiza
                $new_quantity = $old_quantity + $quantity;
                $this->db->where('user_id',$user_key);
                $this->db->where('product_id',$id);
                $this->db->set('quantity',$new_quantity);
                $this->db->update('user_cart');
            }
        }else{
            //adiciona o produto ao carrinho
            if($quantity > 0){
                $product_data= [
                    'user_id'=>$user_key,
                    'product_id'=>$id,
                    'quantity'=>$quantity,
                ];
                $this->db->insert('user_cart',$product_data);
                $insert_id=$this->db->insert_id();
            }
        }
        return redirect('cart');
    }

        
    

    public function updateItemQty(){
        $this->is_user_logged();
        $user_key = $this->session->userdata('user_id');

        $update=0;

        $product_id=$this->input->post('product_id');
        $quantity=$this->input->post('quantity');

        if(!empty($user_key) && !empty($product_id)&&!empty($quantity)){

            $data=[
                'product_id'=>$product_id,
                'quantity'=>$quantity,
                'user_id'=>$user_key,
            ];

            $update=$this->cart->update($data);

            $this->db->update('user_cart',$data);
            $update_id=$this->db->update_id();

        }
        echo $update?'ok':'err';
    }
    



    public function remove_from_cart($product_id){

        $this->is_user_logged();
        $user_key = $this->session->userdata('user_id');

        if( (!empty($product_id)) && !empty($user_key)){


            $this->db->where('user_id',$user_key);
            $this->db->where('product_id',$product_id);
            $this->db->delete('user_cart');

            echo('Produto apagado do carrinho');

        }else{
            
            echo('Alguma informação está errada');
        }
        
    
        return redirect('cart');
    }

    //mudar o botao esta dessatualizado
    public function checkout (){
        $this->is_user_logged();

        //dados do cliente
        $id=$this->session->userdata('user_id');

        if($this->cart->total_items()<=0){
            redirect('products');
        }

        //dados do carrinho
        $data['cartItems']=$this->cart->contents();

        $order=$this->placeOrder();

        if($order){
            $this->orderSuccess($order);    
        }else{
            'error';
        }

    }

    public function pagamento(){
        $this->is_user_logged();

        //dados do cliente
        $id=$this->session->userdata('user_id');
        $profile=$this->Client_model->profile($id)['unique_key'];

        if(!empty($profile)){
            $array['shipping']=$this->Client_model->get_shipping_address_by_key($profile);
            $array['billing']=$this->Client_model->get_billing_address_by_key($profile);
            $array['payments']=$this->Sale_model->payment_methods();

        } else{
            return 'error';
        }
        
        $this->load_views('frontend/sales/pagamento', $array);

    }

    public function create_sale(){
        $id=$this->session->userdata('user_id');
        $user_key=$this->Client_model->profile($id)['unique_key'];

        if ($this->input->post('REQUEST_METHOD') == 'POST') {

            $payment_method = $this->input->post('payment_id');
print_r($payment_method); die;
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
                        
                        return('Compra efetuada com sucesso');
                        $this->load_views('frontend/sales/checkout/');
                    }else{
                        //apagar o grupo quando falha
                        $this->db->where('id',$sale_group_id);
                        $this->db->delete('sales_group');

                        return('Quantidade de um dos produtos é insuficiente.Verifique o pedido');
                        $this->load_views('frontend/sales/cart');
                    }
                }else{
                    return('Alguma informação está errada');
                    $this->load_views('frontend/sales/cart');            
                }
            }
        }else {
            return('Alguma informação está errada');
            $this->load_views('frontend/sales/cart');   
        }
    }

    public function placeOrder(){
        $this->is_user_logged();

        //dados do cliente
        $userId=$this->session->userdata('user_id');

        $cart_items = $this->cart->contents();

        $ordData=[
            'user_id'=>$userId,
            'total_price'=>$this->cart->total(),
            //'total_iva'=>,
        ];

        $insertOrder=$this->Sale_model->insertOrder($userId, $ordData);

        if($insertOrder){

            foreach($cart_items as $cartItem){

                $ordItemData[]=[
                    'sale_group_id'=>$insertOrder,
                    'sale_product_id'=>$cartItem['id'],
                    'quantity'=>$cartItem['qty'],
                    'price'=>$cartItem["subtotal"],
                    'price_iva'=>$cartItem['iva'],
                ];

                
            }

            if(!empty($ordItemData)){
                $insertOrderItems=$this->Sale_model->insertOrderItems($ordItemData);
                if($insertOrderItems){
                    $this->cart->destroy();
                    return $insertOrder;
                }
            }
        }
        return false;
    }

    public function orderSuccess($ordId){
        $data['order']=$this->Sale_model->getOrder($ordId);

        $this->load_views('frontend/sales/checkout', $data);
    }

    public function ola_cart(){
        print_r($this->cart);
    }

    
}
