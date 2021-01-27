<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Clients extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Client_model');
        $this->load->model('Company_model');
        $this->is_admin_logged();
    }

    public function index(){
        $data['page_title']="Utilizadores";
        $data['companies']=$this->Company_model->get_companies();
        $data['roles']=$this->Client_model->get_roles();

        /* print_r($data); */
        $this->load_admin_views('backend/users/index',$data);
    }
    

    public function get_datatable(){
        if($this->session->userdata('role_id')==3){
            $admin=true;
        }


    
        $users=$this->Client_model->get_users();
        $companies=$this->Company_model->get_companies();
        

        if(!empty($users)){

            foreach($users as $user){
                $store='';
                if($user['store_id'] != ''){
                    foreach($companies as $company){
                        if($company['id'] == $user['store_id']){
                            $store=$company['company_name'];
                        }
                    }
                }


                $id = $user['id'];
                $username = $user['username'];
                $email = $user['email'];
                $phone_number = $user['phone_number'];
                /* $birthday_date = $user['birthday_date']; 
                $store_id = $user['phone_number']; */

                switch($user['role']){
                    case "user":
                        $role="Utilizador";
                    break;
                    
                    case "company":
                        $role="Empresa";
                    break;
                    
                    case "admin":
                        $role="Administrador";
                    break;

                    default:
                        $role=$user['role'];
                        break;

                }
                $created_date=$user['created_at'];
                $action='<button class="btn btn-md btn-warning" onclick="edit_user('.$id.')"><i class="fa fa-pencil"></i></button>';
                if($user['role_id']!=3){

                    $action.='&nbsp<button class="btn btn-md btn-danger" onclick="suspend_user('.$id.')"><i class="fa fa-ban"></i></button>';
                }


                $data[]=[
                    $id,
                    $username,
                    $email,
                    $phone_number,
                    /* $birthday_date, */
                    $role,
                    $store,
                    $created_date,
                    $action,
                ];
    
            } 
        
            $records=['data'=>$data];
            $records= json_encode($records);
            echo $records;
        }

    }
    
    public function user_add(){

    }

    public function user_edit($user_id){
        if(empty($this->input->post('username'))){
            $client=$this->Client_model->profile($user_id);
           /*  $client['birthday_date']=date('d/m/Y',strtotime($client['birthday_date'])); */
            echo json_encode($client);
        }else{

        }
    }

    public function user_delete($user_id){
        
    }
} 