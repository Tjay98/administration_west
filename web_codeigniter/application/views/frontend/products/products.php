<style>
    .custom-boxes{
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        min-height:400px
    }
    .category a:hover{
        text-decoration:none;
    }

    .custom-boxes a {
		font-size: 15px;
        color:#2c3e50;
    }

    .custom-boxes-products{
        min-height:200px;
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
    }

    .custom-boxes-products a{
        font-size: 15px;
        color:#fff;
    }

    @media only screen and (min-width: 600px) {
        .filter_bar{
            position:fixed;
        }
    }

</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="custom-boxes filter_bar" >
                <h3 style="text-align:center;">Filtros</h3>
                <hr>
                <h4 class="text-center mt-1">Categorias</h4>
                <?php 
                    $url="products/";
                    if(!empty($this->input->get('product_name'))){
                        $product_name=$this->input->get('product_name');
                        $product_url='?product_name='.$product_name;

                        $url.=$product_url;
                    }

                    

                    if(!empty($this->input->get('category'))){
                        $category_search=$this->input->get('category');
                        if( (empty($product_name)) || (empty($this->input->get('company')))){
                            $category_url='?category='.$category_search;

                        }else{
                            $category_url='&category='.$category_search;
                            
                            
                        }
                        $url.=$category_url;
                    }else{
                        if( (empty($this->input->get('product_name'))) || (empty($this->input->get('company')))){
                            $category_url='?category=';
                            
                        }else{
                            $category_url='&category=';
                        }
                        /* $url.=$category_url; */
                    }

                    if(!empty($this->input->get('company'))){
                        $company_search=$this->input->get('company');
                        if( (empty($product_name)) && (empty($category))){
                            $company_url='?company='.$company_search;
                        }else{
                            $company_url='&company='.$company_search;
                        }
                        $url.=$company_url;
                    }else{
                        if( (empty($this->input->get('product_name'))) && (empty($this->input->get('category')))){
                            $empty_company_url='?company=';
                            $company_url=$empty_company_url;
                        }else{
                            $empty_company_url='&company=';
                            $company_url=$empty_company_url;
                        }
                    }

                    ?>
                    <p class="text-center category"> <a href="" onclick="search_by_category('')"> Todas </p>
                    <?php foreach ($categories as $category){ ?>  
                        <p class="text-center category"> <a href="" onclick="search_by_category(<?php echo $category['id'] ?>)"> <?php echo $category['category_name']; ?></a> </p>
                        
                <?php 
                    } 
                ?>
                <hr>
                <h4 class="text-center ">Empresas</h4>
                <?php 
                foreach ($companies as $company){ ?>
                    <!-- <p class="text-center category"> <a href="<?php echo base_url($url); ?>"> <?php echo $company['company_name']; ?></a> </p>    -->
                    <p class="text-center category"> <a href="" onclick="search_by_company(<?php echo $company['id'] ?>)"> <?php echo $company['company_name']; ?></a> </p>   
                <?php } ?>
            </div>
        </div>
        
        <div class="col-lg-9 col-md-8 col-sm-12">
            <!--class="custom-boxes" -->
            <div >
                <h3 class="text-center">Produtos</h3>
                <?php 
                foreach ($products as $product){ ?>
                    <div class="custom-boxes-products mb-3 product_box" category_id="<?php echo $product['category_id']; ?>" company_id="<?php echo $product['company_id']; ?>">
                        <div class="row">
                            <img class="image-products ml-3" style =" margin-top: auto; margin-bottom: auto; position: relative; max-width:120px; max-height:70px; " src="<?php echo base_url('uploads/products/').$product['image']; ?>" alt="Imagem <?php echo $product['product_name']; ?>">
                            <div class="col-lg-4 col-md-8 col-sm-12 ">
                                <h4 style="text-align: center;"><?php echo $product['product_name']; ?></h4>
                                <p class="text-center"><?php echo $product['category_name']; ?></p>
                                <p class="text-center"><?php echo $product['company_name']; ?></p>
                                <p class="text-right"><?php echo $product['price']." €"; ?></p>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12  ">
                                <h6 class="text-center"><b>Descrição</b></h6>
                                <p class="text-justify"><?php echo $product['small_description']; ?></p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-top: auto; margin-bottom: auto; text-align:center">
                                <button class="btn-primary mr-3" style="border-radius: 10px; padding:5px"> <a href="<?php echo base_url('products/').$product['id']; ?>" >Ver Detalhes do Produto</a> </button>
                                <button id="addToCart" class="btn-primary" style="border-radius: 10px; padding:5px"> <a href="<?php echo base_url('add/cart/').$product['id']; ?>" >Adicionar ao Carrinho</a> </button>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</div>  
<script>
    var search_category='';
    var search_company='';

    function search_by_category(category){
        event.preventDefault();
        if(category !=''){

            search_category=category;
            
        }else{
            search_category='';
            
        }
        search_products();
        
    }

    function search_by_company(company){
        event.preventDefault();
       
        if(company!=''){
            search_company=company;
            
        }else{
            search_company='';
        }
        search_products();
    }

    function clear_all_filters(){
        $('.product_box').show();
    }


    function search_products(){
        
        if(search_category != ''  && search_company.length != ''){
            
            $('.product_box').each(function(){
                if( $(this).attr('category_id') == search_category &&  $(this).attr('company_id') == search_company  ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
            
            
        }else if(search_category!='' && search_company.length == ''){
            
            $('.product_box').each(function(){
               
                 
                if( $(this).attr('category_id') == search_category ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })

        }else if(search_category.length == '' && search_company.length != '' ){

            $('.product_box').each(function(){
                
                if( $(this).attr('company_id') == search_company  ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })

        }else if(search_category.length == '' && search_company.length == ''){
           
            clear_all_filters();
        }
    }
</script>