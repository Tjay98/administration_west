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
        $user_id = $this->session->userdata('user_id');
        if(!empty($user_id)){
            $cartItems=$this->Sale_model->get_user_cart($user_id);
            

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

        
    /* $product_id=$this->input->post('product_id');
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
    echo $update?'ok':'err'; */


    public function updateItemQty($product_id){
        $this->is_user_logged();
        $user_id = $this->session->userdata('user_id');

        $quantity=$this->input->post('quantity');

        $cart = $this->Sale_model->get_cart_by_user_product_id($user_id, $product_id);

        /* print_r($this->input->post());die; */
        if(!empty($cart)){
          
            if( $quantity <= 0){
                //método para prevenir se a quantidade é inferior a 0, caso seja apaga o produto tal como o delete product
                $this->db->where('user_id',$user_id);
                $this->db->where('product_id',$product_id);
                $this->db->delete('user_cart');

                echo "Reduce";
            }elseif($quantity > 0){
                //verifica se a quantidade é superior a 0, caso seja atualiza
                $this->db->where('user_id',$user_id);
                $this->db->where('product_id',$product_id);
                $this->db->set('quantity',$quantity);
                $this->db->update('user_cart');

                echo "Increase";
            }
        }
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
    public function old_checkout (){
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

    public function checkout(){
        $this->is_user_logged();

        //dados do cliente
        $user_id=$this->session->userdata('user_id');

        if(!empty($user_id)){
            $data['shipping']=$this->Client_model->get_user_shipping($user_id);
            $data['billing']=$this->Client_model->get_user_billing($user_id);
            $data['cart_items']=$this->Sale_model->get_user_cart($user_id);
            $data['payment_methods']=$this->Sale_model->payment_methods();
            $this->load_views('frontend/sales/checkout', $data);
        }

    }

    public function create_sale(){
       
        
        /* print_r($this->input->post());die; */
        if (!empty($this->input->post('payment'))) {
            $user_id=$this->session->userdata('user_id');
            
            
            if(!empty($user_id)){
                $payment = $this->input->post('payment');

                $payment_method=$payment['payment_method']['payment_method_id'];
                $shipping_address = $this->Client_model->get_user_shipping($user_id);
                $billing_address = $this->Client_model->get_user_billing($user_id);

                $cart_products= $this->Sale_model->get_user_cart($user_id);

                if(empty($shipping_address['id'])){
                    $shipping_address=$payment['shipping'];
                    $shipping_address['user_id']=$user_id;

                    $this->db->insert('shipping_address',$shipping_address);
                    $shipping_address['id']=$this->db->insert_id();
                }else{
                    $this->db->where('user_id',$user_id);
                    $this->db->update('shipping_address',$payment['shipping']);
                }

                if(empty($billing_address['id'])){
                    $billing_address=$payment['billing'];
                    $billing_address['user_id']=$user_id;

                    $this->db->insert('billing_address',$billing_address);
                    $billing_address['id']=$this->db->insert_id();
                }else{
                    $this->db->where('user_id',$user_id);
                    $this->db->update('billing_address',$payment['billing']);
                }


                $sale_data=[
                    'user_id'=>$user_id,
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

                        $this->db->where('user_id',$user_id);
                        $this->db->delete('user_cart');
                        
                        /* echo 'Compra efetuada com sucesso'; */
                        echo "success";
                        exit;
                    }else{
                        //apagar o grupo quando falha
                        $this->db->where('id',$sale_group_id);
                        $this->db->delete('sales_group');

                        /* echo 'Quantidade de um dos produtos é insuficiente.Verifique o pedido'; */
                        echo "product_quantity_error";
                        exit;
                    }
                }else{
                    /* echo 'Alguma informação está errada'; */
                    echo "error";
                    exit;         
                }
            }
        }else {
            /* echo 'Alguma informação está errada'; */
            echo "error";
            exit;
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
