<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @since : 8 december 2020
 */
class Categories extends MY_Controller {

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
        $data['page_title']="Categorias";
        $this->load_admin_views('backend/categories/index',$data);
    }

    public function get_datatable(){
        $categories= $this->Category_model->get_categories();
        if(!empty($categories)){
            foreach($categories as $category){
                $id=$category['id'];
                $name=$category['category_name'];
                $iva=$category['iva']."%";
                $buttons="<button class='btn btn-md btn-warning' onclick='edit_category(".$id.")'><i class='fa fa-pencil'></i></button>";
                $data[]=[
                    $id,
                    $name,
                    $iva,
                    $buttons,
                ];
            }
            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        } 
    }

    public function add(){
        if(!empty($this->input->post('category_name')) && $this->session->userdata('role_id')==3 ){
          $data=[
              'category_name'=>$this->input->post('category_name'),
              'iva'=>$this->input->post('category_iva'),
          ];
          $this->db->insert('categories',$data);
          $id=$this->db->insert_id();
          if($id){
              echo "success";
          }
        }
    }

    public function edit($category_id){
        if(!empty($this->input->post('category_name')) && $this->session->userdata('role_id')==3  ){
            $data=[
                'category_name'=>$this->input->post('category_name'),
                'iva'=>$this->input->post('category_iva'),
            ];
            $this->db->where('id',$category_id);
            $this->db->update('categories',$data);

            echo "success";
        }else{
            $category=$this->Category_model->get_category_by_id($category_id);
            
            echo json_encode($category);
        }
    }
    
  
}