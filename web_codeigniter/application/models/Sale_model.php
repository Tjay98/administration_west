<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sale_model extends CI_Model{
    public function get_user_sales($id){
        $this->db->select('sgroup.*,
                            saddress.name as shipping_name,
                            saddress.nif as shipping_nif,
                            saddress.contact_number as shipping_contact,
                            saddress.city as shipping_city,
                            saddress.address as shipping_address,
                            saddress.zip_code as shipping_zip,

                            baddress.name as billing_name,
                            baddress.nif as billing_nif,
                            baddress.contact_number as billing_contact,
                            baddress.city as billing_city,
                            baddress.address as billing_address,
                            baddress.zip_code as billing_zip
                            ');
        $this->db->where('sgroup.user_id',$id);
        $this->db->from('sales_group as sgroup');
        $this->db->join('shipping_address as saddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $this->db->join('billing_address as baddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $this->db->order_by('sgroup.id','desc');
        $results=$this->db->get()->result_array();
        if(!empty($results)){
            $i=0;
            foreach($results as $result){

                $this->db->select('product.product_name');
                $this->db->where('sproduct.sale_group_id',$result['id']);
                $this->db->join('products as product','sproduct.sale_product_id=product.id','LEFT');
                $this->db->from('sales_product as sproduct');
                $products=$this->db->get('sales_product')->result_array();
                if(!empty($products)){
                    $results[$i]['sale_products']=$products;
                }
    
                $i++;
            }
        }
        if(!empty($results)){
            return $results;
        }
        
    }

    public function get_sale($sale_id){

        $this->db->select('sgroup.*,
                            saddress.name as shipping_name,
                            saddress.nif as shipping_nif,
                            saddress.contact_number as shipping_contact,
                            saddress.city as shipping_city,
                            saddress.address as shipping_address,
                            saddress.zip_code as shipping_zip,

                            baddress.name as billing_name,
                            baddress.nif as billing_nif,
                            baddress.contact_number as billing_contact,
                            baddress.city as billing_city,
                            baddress.address as billing_address,
                            baddress.zip_code as billing_zip
                            ');
        $this->db->where('sgroup.id',$sale_id);
        $this->db->from('sales_group as sgroup');
        $this->db->join('shipping_address as saddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $this->db->join('billing_address as baddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $results=$this->db->get()->row_array();
        if(!empty($results)){

                
                $this->db->select('product.id, product.product_name, sproduct.quantity, sproduct.price,sproduct.price_iva');
                $this->db->where('sale_group_id',$results['id']);
                $this->db->join('products as product','sproduct.sale_product_id=product.id','LEFT');
                $this->db->from('sales_product as sproduct');
                $products=$this->db->get()->result_array();

                if(!empty($products)){

                    $results['sale_products']=$products;
                }

        }
        return $results;
    }

    public function get_all_sale_groups(){
        $this->db->select('sgroup.*, user.username,user.phone_number,count(sproduct.id) as product_quantity');
        $this->db->from('sales_group as sgroup');
        $this->db->join('sales_product as sproduct','sproduct.sale_group_id=sgroup.id');
        $this->db->join('user','user.id=sgroup.user_id');
        $this->db->order_by('sgroup.id','desc');
        $this->db->group_by('sgroup.id');
        $results=$this->db->get()->result_array();

        return $results;
    }
    public function get_company_sale_groups($company_id){
        
        $this->db->select('sgroup.*, user.username,user.phone_number, count(sproduct.id) as product_quantity');
        $this->db->where('product.company_id',$company_id);
        $this->db->from('sales_group as sgroup');
        $this->db->join('user','user.id=sgroup.user_id');
        $this->db->join('sales_product as sproduct','sproduct.sale_group_id=sgroup.id');
        $this->db->join('products as product','product.id=sproduct.sale_product_id');
        $this->db->order_by('sgroup.id','desc');
        $this->db->group_by('sgroup.id');
        $results=$this->db->get()->result_array();

        return $results;
    }
    

    
    public function get_sale_by_company($company_id){
        $this->db->select('sale_product.*,products.product_name');
        $this->db->where('company_id',$company_id);
        $this->db->from('sales_product as sale_product');
        $this->db->order_by('sale_product.id','desc');
        $this->db->join('products','products.id=sale_product.sale_product_id');
        $this->db->join('user','user.id=sale_product.sale_product_id');
        $products=$this->db->get()->result_array();

        return $products;
        
    }

    public function get_all_sold_products(){
        $this->db->select('sale_product.*,products.product_name');
        $this->db->from('sales_product as sale_product');
        $this->db->join('products','products.id=sale_product.sale_product_id');
        $this->db->order_by('sale_product.id','desc');
        $products=$this->db->get()->result_array();
        return $products;
    }
    

    public function send_sales($userId){
        $this->db->select('
        shipping_address.id,
        shipping_address.user_id,
        billing_address.id,
        billing_address.user_id
        ');

        $this->db->where('shipping_address.user_id', $userId);
        $this->db->where('billing_address.user_id', $userId);
        $results=$this->db->get()->row_array();

        
        if(!empty($results)){
            return $results;
        } else{
            return false;
        }
    }

    public function insertOrder($userId, $ordData){

        $data=[
            'user_id'=>$ordData['user_id'],
            'billing_address_id'=>1 /*Preencher bem*/,
            'shipping_address_id'=>1 /*Preencher bem*/,
            'payment_method_id'=>1 ,
            'total_price'=>$ordData['total_price'],
            'total_iva'=>1,
            'created_date'=>date("Y-m-d H:i:s"),
            'status'=>0,  
        ];
        $this->db->insert('sales_group', $data);
        $insert_id=$this->db->insert_id();
        return $insert_id;
    }

    public function insertOrderItems($ordItemData){

        $insert=$this->db->insert_batch('sales_product',$ordItemData);

        return $insert;
    }


    public function getOrder($ordId){
        $this->db->select('sales_group.*,
                            user.id,
                            user.email as user_email,
                            user.phone_number,

                            shipping_address.id,
                            shipping_address.name as shipping_name,
                            shipping_address.contact_number as shipping_contact_number,
                            shipping_address.address as shipping_address,
                            shipping_address.zip_code as shipping_zip_code,

                            billing_address.id,
                            billing_address.name as billing_name,
                            billing_address.contact_number as billing_contact_number,
                            billing_address.address as billing_address,
                            billing_address.zip_code as billing_zip_code');

        $this->db->from('sales_group');
        $this->db->join('user','user.id = sales_group.user_id', 'LEFT');
        $this->db->join('shipping_address','shipping_address.id = sales_group.shipping_address_id','LEFT');
        $this->db->join('billing_address','billing_address.id = sales_group.billing_address_id','LEFT');
        $this->db->where('sales_group.id', $ordId);
        $result=$this->db->get()->row_array();


        $this->db->select('sales_product.*, 
                            products.product_name,
                            products.image ');
        $this->db->from('sales_product');
        $this->db->join('products', 'products.id = sales_product.sale_product_id');
        $products=$this->db->get()->result_array();

        $data['products']=$products;

       
        return $result;
    }


    public function reduce_stock($products){

        $validate_reduce=true;
        
        $i=0;
        foreach($products as $product){
            $product_id=$product['sale_product_id']; 
            $quantity = $product['quantity'];
            $this->db->where('id',$product_id);
            $product=$this->db->get('products')->row_array();
            
            if($product['quantity_in_stock']<$quantity){
                $validate_reduce=false;

               
            }else{
                $products[$i]['quantity_in_stock']=$product['quantity_in_stock'];
            }

            $i++;
        }

        if($validate_reduce == true) {
            foreach($products as $product){

                $product_id=$product['sale_product_id']; 
                $quantity = $product['quantity'];

                $new_quantity=$product['quantity_in_stock']-$quantity;
           
                $this->db->where('id',$product_id);
                $this->db->set('quantity_in_stock',$new_quantity);
                $this->db->update('products');
            }
            return "success";

        }else{
            return "error";
        }
    }

    public function payment_methods(){
        $payment_methods=$this->db->get('payment_methods')->result_array();

        return $payment_methods;
    }


    public function get_sale_products($sale_id){
        $this->db->select('sproduct.id as sale_product_id, product.id, product.company_id, product.product_name, sproduct.quantity, sproduct.price,sproduct.price_iva,sproduct.status');
        $this->db->where('sale_group_id',$sale_id);
        $this->db->join('products as product','sproduct.sale_product_id=product.id','LEFT');
        $this->db->from('sales_product as sproduct');
        $products=$this->db->get()->result_array();


        return $products;
    }
}