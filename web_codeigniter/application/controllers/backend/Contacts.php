<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 


class Contacts extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Contact_model');
        $this->is_admin_logged();
    }


    public function index(){

        $data['total_count']=$this->Contact_model->count_by_status();
        $data['count_pending']=$this->Contact_model->count_by_status(1);
        $data['count_done']=$this->Contact_model->count_by_status(2);

        $data['page_title']="Lista de contactos";
        $this->load_admin_views('backend/contacts/index',$data);

    }

    public function get_datatable(){
        $contacts=$this->Contact_model->get_contacts();

        /* print_r($contacts);die; */
        foreach($contacts as $contact){
            $id=$contact['id'];
            $name=$contact['name'];
            $email=$contact['email'];
            $subject=$contact['subject'];

            $action='<button class="btn btn-md btn-warning btn_white_color" onclick="edit_contact('.$id.')"><i class="fa fa-pencil"></i></button>';

            switch($contact['status']){
                case 1:
                    $status='<button class="btn btn-md btn-warning btn_white_color this_100" onclick="confirm_edit('.$id.')">Recebido</button>';
                    $action.='&nbsp;<button class="btn btn-md btn-danger btn_white_color" onclick="delete_contact('.$id.')"><i class="fa fa-trash-o"></i></button>';
                break;

                case 2:
                    $status='<button class="btn btn-md btn-success this_100">Resolvido</button>';
                break;
            
                default:
                    $status=$contact['status'];
                    
                break;
            }

            switch($contact['type']){
                case 1:
                    $type='<button class="btn btn-md btn-info this_100">Utilizador</button>';
                break;

                case 2:
                    $type='<button class="btn btn-md btn-info this_100">Empresa</button>';
                break;

                default:
                    $type=$contact['type'];
                break;
            }

            $created_date=$contact['created_date'];

            $data[]=[
                $id,
                $name,
                $email,
                $subject,
                $status,
                $type,
                $created_date,
                $action,

            ];

        } 

        if(!empty($data)){
            $records=['data'=>$data];

        }else{
            $records=['data'=>[]];
        }
        $records= json_encode($records);
        echo $records;



    }

    public function edit($contact_id){
        if(empty($this->input->post('update_status'))){
            $contact=$this->Contact_model->get_contact_by_id($contact_id);
            echo json_encode($contact,JSON_PRETTY_PRINT);
        }else{
            $this->db->where('id',$contact_id);
            $this->db->set('status',2);
            $this->db->update('contact_form');
    
            echo 'success';
        }

    }

    public function delete($contact_id){
        $this->db->where('id',$contact_id);
        $this->db->set('status',3);
        $this->db->update('contact_form');

        echo 'success';
    }

}
