<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * @author : Rodolfo Barreira
 * @version : 1.0
 * @since : 7 november 2020
 */
class Restful extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Client_model');
        $this->load->model('Category_model');
        $this->load->model('Company_model');
        $this->load->model('Sale_model');
    }
    /*
        ERROR MESSAGE TYPES
        200 Success - The request was well formed
        400 Bad Request — Client sent an invalid request — such as lacking required request body or parameter
        401 Unauthorized — Client failed to authenticate with the server
        403 Forbidden — Client authenticated but does not have permission to access the requested resource
        404 Not Found — The requested resource does not exist
        412 Precondition Failed — One or more conditions in the request header fields evaluated to false
        500 Internal Server Error — A generic error occurred on the server
        503 Service Unavailable — The requested service is not available

    */

    public function generate_error_message($type,$extra_message=''){

        $array['time'] = date("Y-m-d H:i:s");
        $array['status'] = $type;
        
        switch ($type) {
            case 200:

                $array['message']="Success";
                break;

            case 400:

                $array['message']="Bad Request";
                break;

            case 401:

                $array['message']="Unauthorized";
                break; 

            case 403:

                $array['message']="Forbidden";
                break;
                
            case 404:

                $array['message']="Not Found";
                break;

            case 412:

                $array['message']="Precondition Failed";
                break;

            case 500:

                $array['message']="Internal Server Error";
                break;

        }

        if(!empty($extra_message)){
            $array['detail'] = $extra_message;
        }
        
        return $array;
    }

    public function get_products(){
        $products=$this->Product_model->get_products();
        if(!empty($products)){
            echo json_encode($products, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_product($id){
        $product=$this->Product_model->get_detail_products($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    
    public function get_products_by_company($id){
        $product=$this->Product_model->products_by_company($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    public function get_products_by_category($id){
        $product=$this->Product_model->get_products_by_categories($id);
        if(!empty($product)){
            echo json_encode($product, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }
    //funçao de login esta com problemas a validar a password. descobrir porquê

    public function login(){
        if( (!empty($this->input->post('email'))) && (!empty($this->input->post('password'))) ){
            $login_form=[
                'email'=>$this->input->post('email'),
                'password'=>$this->input->post('password'),
            ];
            $validate=$this->Client_model->verify_login($login_form);
            if(empty($validate)){
                $array=$this->generate_error_message(200,"Login successful");
            }else{
                $array=$this->generate_error_message(401,"Invalid login");
            }
        }else{
            $array=$this->generate_error_message(400,'Invalid method');
        }

        echo json_encode($array, JSON_PRETTY_PRINT);
        /* print_R($this->input->post()); */
    }

    public function register(){
        /* print_r($this->input->post()); */
        if( (!empty($this->input->post('username'))) && (!empty($this->input->post('email'))) && (!empty($this->input->post('password'))) && (!empty($this->input->post('nif'))) && (!empty($this->input->post('birthday')))){
            $user=strtolower($this->input->post('username'));
            $email=strtolower($this->input->post('email'));
        
            //converter apenas o primeiro elemento de cada palavra para maiusculo
            $username=ucwords($user);

            //preenche o array 
            $registo_form=[
                'username'=>$username,
                'email'=>$email,
                'nif'=>$this->input->post('nif'),
                'birthday_date'=>$this->input->post('birthday'),
                'password_hash'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            ];


            $validate=$this->Client_model->register_client($registo_form);
            if(empty($validate)){
                $array=$this->generate_error_message(200,"Register successful");
            }else{
                $array=$this->generate_error_message(401,'The credentials are already in use');
            }

           
        }else{
            $array=$this->generate_error_message(400,'Invalid method');
        }
        echo json_encode($array, JSON_PRETTY_PRINT);
    }

    public function get_categories(){
        $categories=$this->Category_model->get_categories();
        if(!empty($categories)){
            echo json_encode($categories, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_category($id){
        $category=$this->Category_model->get_category_by_id($id);
        if(!empty($category)){
            echo json_encode($category, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_companies(){
        $companies=$this->Company_model->get_companies();
        if(!empty($companies)){
            echo json_encode($companies, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }

    public function get_company($id){
        $company=$this->Company_model->get_company_by_id($id);
        if(!empty($company)){
            echo json_encode($company, JSON_PRETTY_PRINT);
        }else{
            $array=$this->generate_error_message(404);
            echo json_encode($array);
        }
    }


    public function create_sale(){
        if(!empty($this->input->post('sales'))){
            $sales=$this->input->post('sales');
            foreach($sales as $sale){
                //criar metodo de criar venda e validação
            }
        }
    }

    public function edit_profile(){
        if(!empty($this->input->post('profile_info'))){
            $profile=$this->input->post('profile_info');
        }
    }


}
