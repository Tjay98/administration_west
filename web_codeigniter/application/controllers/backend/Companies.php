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
            $data['count_total']=$this->Company_model->count_company_by_status('all');
            $data['count_invactive']=$this->Company_model->count_company_by_status('0');
            $data['count_active']=$this->Company_model->count_company_by_status('1');
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
                            $status="<button class='btn btn-md btn-warning btn_white_color this_100' onclick='enable_company(".$id.")'>Inativa</button>";
                        break;

                        case 1:
                            $status="<button class='btn btn-md btn-success this_100' onclick='disable_company(".$id.")'>Ativa</button>";
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

                $config['upload_path']          = './uploads/companies';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['overwrite']            = true;
                $config['file_name']            = $this->input->post('company_name')."_LOGO";
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('company_image')){
                        $error = array('error' => $this->upload->display_errors());
                        $imagem='';

                }else{
                        $image_data = $this->upload->data();
                        $imagem=$image_data['file_name'];
                        
                }

                $company_name=$this->input->post('company_name');
                $description=$this->input->post('description');

                $data=[
                    'company_name'=>$company_name,
                    'image'=>$imagem,
                    'status'=>1,
                    'description'=>$description,
                ];
                
                $this->db->insert('companies',$data);
                redirect('admin/companies');


            }else{
                $data['page_title']="Criar empresa";
                $this->load_admin_views('backend/companies/add',$data);
            }
        }else{
            redirect('admin/companies/edit/'.$this->session->userdata('company_id'));
        }
    }
    
    public function edit($company_id){
        if($this->session->userdata('company_id') == $company_id || $this->session->userdata('role_id')==3){
            //implementar edição
            if(!empty($this->input->post())){
                $this_company=$this->Company_model->get_company_by_id($company_id);

                $config['upload_path']          = './uploads/companies';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['overwrite']            = true;
                $config['file_name']            = $this_company['company_name']."_LOGO";
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('company_image')){
                        $error = array('error' => $this->upload->display_errors());
                        $imagem=$this_company['image'];

                }else{
                        $image_data = $this->upload->data();
                        $imagem=$image_data['file_name'];
                        
                }
                /* print_r($error);die; */
                $company_name=$this->input->post('company_name');
                $description=$this->input->post('description');

                $data=[
                    'image'=>$imagem,
                    'description'=>$description,
                ];

                if(!empty($company_name)){
                    $data['company_name']=$company_name;
                }

                $this->db->where('id',$company_id);
                $this->db->update('companies',$data);
                redirect('admin/companies');
            }else{
                $data['company']=$this->Company_model->get_company_by_id($company_id);
                
                $data['page_title']="Editar empresa";
                $this->load_admin_views('backend/companies/edit',$data);
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
