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
                            baddress.contact_number as billingg_contact,
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
                $data[$i]['sale']=$result;

                $this->db->select('product.product_name, product.image');
                $this->db->where('sale_group_id',$result['id']);
                $this->db->join('products as product','sproduct.sale_product_id=product.id','LEFT');
                $this->db->from('sales_product as sproduct');
                $products=$this->db->get('sales_product')->result_array();
                if(!empty($products)){
                    $data[$i]['sale_products']=$products;
                }
    
                $i++;
            }
        }
        return $data;
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
                            baddress.contact_number as billingg_contact,
                            baddress.city as billing_city,
                            baddress.address as billing_address,
                            baddress.zip_code as billing_zip
                            ');
        $this->db->where('sgroup.id',$id);
        $this->db->from('sales_group as sgroup');
        $this->db->join('shipping_address as saddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $this->db->join('billing_address as baddress','saddress.id=sgroup.shipping_address_id','LEFT');
        $results=$this->db->get()->row_array();
        if(!empty($results)){

                $data['sale']=$results;
                $this->db->select('product.product_name, product.image');
                $this->db->where('sale_group_id',$result['id']);
                $this->db->join('products as product','sproduct.sale_product_id=product.id','LEFT');
                $this->db->from('sales_product as sproduct');
                $products=$this->db->get()->result_array();

                if(!empty($products)){

                    $data['sale_products']=$products;
                }

        }
        return $data;
    }

    public function get_all_sales(){
        $this->db->select('sgroup.*, user.username,user.nif');
        $this->db->from('sales_group as sgroup');
        $this->db->join('user','user.id=sgroup.user_id');
        $results=$this->db->get()->result_array();

        return $results;
    }
}