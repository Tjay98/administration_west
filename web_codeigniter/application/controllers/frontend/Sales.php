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
        $this->load->library('cart');
        
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

        $cart_items = $this->cart->contents();
        $data['cartItems']=$cart_items;

        $this->load_views('frontend/cart', $data);

    }

    public function add_to_cart($id){

        $this->is_user_logged();

        $product=$this->Sale_model->get_product($id);

        $data=[
            'id'=>$product['id'],
            'qty'=>1,
            'price'=>$product['price'],
            'iva'=>$product['price_iva'],
            'name'=>$product['product_name'],
            'image'=>$product['image'],
        ];

        $this->cart->insert($data);
        
        return redirect('cart');
        
    }

    public function updateItemQty(){
        $this->is_user_logged();

        $update=0;

        $rowid=$this->input->get('rowid');
        $qty=$this->input->get('qty');

        if(!empty($rowid)&&!empty($qty)){
            $data=array(
                'rowid'=>$rowid,
                'qty'=>$qty,
            );

            $update=$this->cart->update($data);
        }
        echo $update?'ok':'err';
    }




    public function remove_from_cart($rowid){

        $this->is_user_logged();

        
        $remove=$this->cart->remove($rowid);
        return redirect('cart');
    }

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
            redirect(orderSuccess());
        } else{
            'error';
        }

    }

    public function placeOrder(){
        $this->is_user_logged();

        //dados do cliente
        $userId=$this->session->userdata('user_id');


        $ordData=[
            'user_id'=>$userId,
            'total_price'=>$this->cart->total(),
            //'total_iva'=>,
        ];

        $insertOrder=$this->Sale_model->insertOrder($userId, $ordData);

        if($insertOrder){
            $cartItems=$this->cart->contents();

            $ordItemData=[];
            $i=0;
            foreach($cartItems as $cartItem){
                $ordItemData[$i]['sales_group_id']=$insertOrder;
                $ordItemData[$i]['sale_product_id']=$cartItem['id'];
                $ordItemData[$i]['quantity']=$cartItem['qty'];
                $ordItemData[$i]['price']=$cartItem["subtotal"];
                $ordItemData[$i]['price_iva']=$cartItem['iva'];

                $i++;
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

        $this->load_views('frontend/checkout', $data);
    }

    public function ola_cart(){
        print_r($this->cart);
    }



}
