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

    public function get_all_sales(){
        $this->db->select('sgroup.*, user.username,user.nif');
        $this->db->from('sales_group as sgroup');
        $this->db->join('user','user.id=sgroup.user_id');
        $results=$this->db->get()->result_array();

        return $results;
    }

    

    
    public function get_sale_by_company($company_id){
        $this->db->where('company_id',$company_id);
        $products=$this->db->get('products')->result_array();

        return $products;
        
    }

    public function get_all_sold_products(){
        $products=$this->db->get('sales_product')->result_array();
        return $products;
    }
    

    public function get_product($id){
        $this->db->select('products.id,
                            products.product_name,
                            products.image,
                            products.small_description,
                            products.price,
                            products.price_iva,
                            products.company_id,
                            products.category_id,
                            categories.category_name, 
                            companies.company_name');
                            
        $this->db->from('products');
        $this->db->join('categories','categories.id=products.category_id','LEFT');
        $this->db->join('companies','companies.id=products.company_id','LEFT');
        $this->db->where('products.id', $id);
        
        $results=$this->db->get()->row_array();

        return !empty($results)?$results:false;

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

        $this->db->select(' shipping_address.id,
                            shipping_address.user_id,
                            billing_address.id,
                            billing_address.user_id');
        $shipping_user=$this->db->where('shipping_address.user_id', $userId);
        $billing_user=$this->db->where('billing_address.user_id', $userId);

        $data=[
            'user_id'=>$ordData['user_id'],
            'billing_address_id'=>$shipping_user,
            'shipping_address_id'=>$billing_user,
            'payment_method_id'=>$ordData['birthday_date'],
            'total_price'=>$ordData['total_price'],
            'total_iva'=>$ordData['total_iva'],
            'created_at'=>date("Y-m-d_H:i:s"),
            'status'=>0,  
        ];
        $insert=$this->db->insert('sales_group', $data);

        return $insert;
    }

    public function insertOrderItems($ordItemData){

        $insert=$this->db->insert('sales_product',$ordItemData);

        return $insert;
    }


    public function getOrder($ordId){
        $this->db->select('sales_group.*,
                            user.id,
                            user.email as user_email,
                            user.nif,
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
        products.* ');
        $this->db->from('sales_product');
        $this->db->join('products', 'products.id = sales_product.sale_product_id');
        //$this->db->where('sales_product.sale_product_id', $id);
        $result=$this->db->get()->result_array();

        return !empty($result)?$result:false;
    }



}