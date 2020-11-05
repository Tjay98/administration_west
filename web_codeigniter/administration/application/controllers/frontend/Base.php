<?php

class Base extends CI_Controller {
    public function home(){
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/template/footer');
    }
    public function shop(){
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/shop');
        $this->load->view('frontend/template/footer');
    }
    public function shop_detail(){
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/shop-detail');
        $this->load->view('frontend/template/footer');
    }
    public function cart(){
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/cart');
        $this->load->view('frontend/template/fotter');
    }
    public function checkout(){
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/checkout');
        $this->load->view('frontend/template/footer');
    }
}