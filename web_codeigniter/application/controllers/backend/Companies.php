<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira && Cidália Pinto
 * @since : 28 january 2020
 */
class Companies extends MY_Controller {

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
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }

        if($admin){

            $data['page_title']="Empresas";
            $this->load_admin_views('backend/companies/index',$data);
        }else{
            redirect('admin/companies/edit/'.$this->session->userdata('company_id'));
        }

    }

    public function get_datatable(){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }


        if($admin){
    
            $companies=$this->Company_model->get_all_companies();

            if(!empty($companies)){
                foreach($companies as $company){

                    $id=$company['id'];
                    $company_name=$company['company_name'];
                    $created_date=$company['created_date'];

                    $image_url=$company['image'];
                    $image="<image src='".base_url('uploads/companies/'.$image_url)."' alt='Logo ".$company_name."' style='max-width:80px; max-height:80px'>";

                    switch($company['status']){
                        case 0:
                            $status="<button class='btn btn-md btn-warning btn_white_color this_100' onclick='enable_company(".$id.")'>Inativo</button>";
                        break;

                        case 1:
                            $status="<button class='btn btn-md btn-success this_100' onclick='disable_company(".$id.")'>Ativo</button>";
                        break;

                        default:
                            $status="<button class='btn btn-md btn-default this_100' disabled>".$company['status']."</button>";
                        break;
                    }
                    

                    $action="<a class='btn btn-md btn-warning btn_white_color' href='".base_url('admin/companies/edit/'.$id)."'><i class='fa fa-pencil'></i></a>";

                    $data[]=[
                        $id,
                        $image,
                        $company_name,
                        $created_date,
                        $status,
                        $action,
                    ];
                }

                if(!empty($data)){
                    $records=['data'=>$data];
                    echo json_encode($records);
                    
                }
            }
        }


    }

    public function add(){
        if($this->session->userdata('role_id')==3){
            //implementar criação
            if(!empty($this->input->post())){

            }else{
                $data['page_title']="Criar empresa";
                $this->load_admin_views('backend/companies/crud',$data);
            }
        }else{
            redirect('admin/companies/edit/'.$this->session->userdata('company_id'));
        }
    }
    
    public function edit($company_id){
        if($this->session->userdata('company_id') == $company_id || $this->session->userdata('role_id')==3){
            //implementar edição
            if(!empty($this->input->post())){

            }else{
                $data['company']=$this->Company_model->get_company_by_id($company_id);
                $data['page_title']="Editar empresa";
                $this->load_admin_views('backend/companies/crud',$data);
            }
        }
    }

    public function delete($company_id,$new_status){
        if($this->session->userdata('role_id')==3){
            $company=$this->Company_model->get_company_by_id($company_id);
            
            if(!empty($company)){
                $this->db->where('id',$company_id);
                $this->db->set('status',$new_status);
                $this->db->update('companies');
            }


        }else{
            redirect('admin/companies/edit/'.$this->session->userdata('company_id'));
        }
    }
}
