<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Clients extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
        $this->is_admin_logged();
    }

    public function index(){
        $data['page_title']="Utilizadores";


        /* print_r($data); */
        $this->load_admin_views('backend/users/index',$data);
    }
    

    public function get_datatable(){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }


    
        $users=$this->Client_model->get_users();

        if(!empty($users)){

            foreach($users as $user){
                $id = $user['id'];
                $username = $user['username'];
                $email = $user['email'];
                $phone_number = $user['phone_number'];
                /* $birthday_date = $user['birthday_date']; */
                $role = $user['phone_number'];
                $store_id = $user['phone_number'];
                $role = $user['phone_number'];
                $created_date=$user['created_at'];
                $action='<button class="btn btn-md btn-warning" onclick="edit_user('.$id.')"><i class="fa fa-pencil"></i></button>';
                $action.='&nbsp<button class="btn btn-md btn-danger" onclick="suspend_user('.$id.')"><i class="fa fa-ban"></i></button>';

                $data[]=[
                    $id,
                    $username,
                    $email,
                    $phone_number,
                    /* $birthday_date, */
                    $role,
                    $store_id,
                    $created_date,
                    $action,
                ];
    
            } 
        
            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        }

    }
} 