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

        $data['count_total']=$this->Client_model->count_users_by_role();
        $data['count_users']=$this->Client_model->count_users_by_role(1);
        $data['count_companies']=$this->Client_model->count_users_by_role(2);
        $data['count_admins']=$this->Client_model->count_users_by_role(3);

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
               
                if($user['role_id']!=3 && $this->session->userdata('role_id') == 3){
                    $action='<button class="btn btn-md btn-warning" onclick="edit_user('.$id.')"><i class="fa fa-pencil"></i></button>';
                    $action.='&nbsp<button class="btn btn-md btn-danger" onclick="suspend_user('.$id.')"><i class="fa fa-ban"></i></button>';
                }else{
                    $action='<button class="btn btn-md btn-light" onclick="edit_user('.$id.')"><i class="fa fa-eye"></i></button>';
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
        if(!empty($this->input->post('username')) && $this->session->userdata('role_id')==3){
            $username=$this->input->post('username');
            $email=$this->input->post('email');
            $phone_number=$this->input->post('phone_number');
            $birthday_date=$this->input->post('birthday_date');
            $store_id=$this->input->post('store_id');
            $role_id=$this->input->post('role_id');
            $password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            

            //limpeza
            $username=ucwords(strtolower($username));
            $email=strtolower($email);

            
            //preenche o array 
            $data=[
                'username'=>$username,
                'email'=>$email,
                'phone_number'=>$phone_number,
                'birthday_date'=>$birthday_date,
                'store_id'=>$store_id,
                'role_id'=>$role_id,
                'password_hash'=>$password,
            ];
            //vai enviar os dados para a função register_client do modelo Client_model 
            $validate=$this->Client_model->register_client($data);
            if(empty($validate)){
                //if register happens correctly
                echo 'success';
            }else{
                echo $validate;
            }
            /* print_r($this->input->post()); */
        }
    }

    public function user_edit($user_id){
        if( empty($this->input->post('username')) ){
            $client=$this->Client_model->profile($user_id);
           /*  $client['birthday_date']=date('d/m/Y',strtotime($client['birthday_date'])); */
            echo json_encode($client);
        }else{
            if($this->session->userdata('role_id')==3){

                $username=$this->input->post('username');
                $email=$this->input->post('email');
                $phone_number=$this->input->post('phone_number');
                $birthday_date=$this->input->post('birthday_date');
                $store_id=$this->input->post('store_id');
                $role_id=$this->input->post('role_id');
                
                if(!empty($this->input->post('password'))){
                    $password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
                }
                

                //limpeza
                $username=ucwords(strtolower($username));
                $email=strtolower($email);

                $data=[
                    'id'=>$user_id,
                    'username'=>$username,
                    'email'=>$email,
                    'phone_number'=>$phone_number,
                    'birthday_date'=>$birthday_date,
                    'store_id'=>$store_id,
                    'role_id'=>$role_id,
                    
                ];
                
                if(!empty($password)){
                    $data['password_hash']=$password;
                }

                $validate=$this->Client_model->validate_edit_client($data);
                if(empty($validate)){
                    //if register happens correctly
                    echo 'success';
                }else{
                    echo $validate;
                }
            }else{
                echo "Sem permissão";
                exit;
            }

        }
    }

    public function user_delete($user_id){
        $verify_admin=$this->Client_model->profile($id);
        if(empty($verify_admin) && $this->session->userdata('role_id')==3){
            $this->db->where('id',$user_id);
            $this->db->set('status',2);
            $update=$this->db->update('user');
            if($update){
                echo "success";
            }
        }else{
            echo "error";
            exit;
        }
    }
} 