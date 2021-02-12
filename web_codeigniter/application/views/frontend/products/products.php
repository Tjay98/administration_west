<style>
    .custom-boxes{
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        min-height:400px
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
    
    .active_url{
        font-weight:bold;
        padding:2px;
    }

    @media only screen and (min-width: 600px) {
        .filter_bar{
            position:fixed;
        }
    }
    .pointer{
        cursor:pointer;
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

                    $product_name='';
                    if(!empty($this->input->get('product_name'))){
                        $product_name=$this->input->get('product_name');
                    }

                    if(!empty($this->input->get('category'))){
                        $category_search=$this->input->get('category');
                    }

                    if(!empty($this->input->get('company'))){
                        $company_search=$this->input->get('company');
                    }
                    
                    ?>
                    <p class="pointer text-center" id="category_url" onclick="search_by_category('')"> Todas </p>
                    <?php foreach ($categories as $category){ 
                            if(!empty($category['id'])){?>  
                        <p class="pointer text-center category_url" id="category_url<?php echo $category['id'] ?>" onclick="search_by_category(<?php echo $category['id'] ?>)"> <?php echo $category['category_name']; ?> </p>
                        
                <?php }
                    } 
                ?>
                <hr>
                <h4 class="text-center ">Empresas</h4>
                <p class="pointer text-center" id="company_url" onclick="search_by_company('')"> Todas </p>
                <?php 
                foreach ($companies as $company){ ?>
                    <!-- <p class="text-center category"> <a href="<?php echo base_url($url); ?>"> <?php echo $company['company_name']; ?></a> </p>    -->
                    <p class="pointer text-center company_url" id="company_url<?php echo $company['id'] ?>"   onclick="search_by_company(<?php echo $company['id'] ?>)"> <?php echo $company['company_name']; ?> </p>   
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <!--class="custom-boxes" -->
            <div >
                
                <h3 class="text-center">Produtos</h3>
                <input type="search" class="form-control" id="search_product_input" placeholder="Pesquisar produto" value="<?php echo $product_name; ?>">
                <hr>
                <?php 
                foreach ($products as $product){ ?>

                    <div class="row mt-2 p-2 bg-white border product_box" category_id="<?php echo $product['category_id']; ?>" company_id="<?php echo $product['company_id']; ?>" product_name="<?php echo strtolower($product['product_name']); ?>">
                        <div class="col-md-3 mt-1"><img style =" margin-top: auto; margin-bottom: auto; position: relative; max-width:200px;max-height:200px; " src="<?php echo base_url('uploads/products/').$product['image']; ?>" alt="Imagem <?php echo $product['product_name']; ?>"></div>
                        <div class="col-md-6 mt-1">
                            <h4 style="font-weight:bold;"><?php echo $product['product_name']; ?></h4>
                            <p>
                                <b>Empresa:</b>
                                <?php echo $product['company_name']; ?>
                            <p>
                            <p>
                                <b>Categoria:</b>
                                <?php echo $product['category_name']; ?>
                            <p>
                            <p class="text-justify text-truncate para mb-0">
                                <b>Descrição:</b>
                                <?php echo $product['small_description']; ?>
                            </p>

                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1"><?php echo $product['price']." €" ?></h4>
                            </div>
                            <div class="d-flex flex-column mt-4">
                                <a href="<?php echo base_url('products/').$product['id']; ?>" class="btn btn-primary btn-sm" type="button">Detalhes</a>
                                <a href="<?php echo base_url('add/cart/').$product['id']; ?>" class="btn btn-outline-primary btn-sm mt-2" type="button">Adicionar ao carrinho</a>
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
    var search_product='';

    $(document).ready(function(){
        <?php if(!empty($product_name)){?>
            $('#search_product_input').trigger('change');
        <?php } ?>

        <?php if(!empty($category_search)){?>
            search_by_category(<?php echo $category_search; ?>);
        <?php } ?>

        <?php if(!empty($company_search)){?>
            search_by_company(<?php echo $company_search; ?>);
        <?php } ?>
    })

    function search_by_category(category){
        /* event.preventDefault(); */
        if(category !=''){

            search_category=category;
            
        }else{
            search_category='';
            
        }
        search_products();
        
        $('.category_url').each(function(){
            this_id=$(this).attr('id');
            this_id=this_id.replace('category_url','');

            
            if(this_id == category){
                $(this).addClass('active_url');
            }else{
                $(this).removeClass('active_url');
            }
            /* if(this_id == ''){
                
            } */
            
        })
    }

    function search_by_company(company){
       /*  event.preventDefault(); */
       
        if(company!=''){
            search_company=company;
            
        }else{
            search_company='';
        }
        search_products();

        $('.company_url').each(function(){
            this_id=$(this).attr('id');
            this_id=this_id.replace('company_url','');

            
            if(this_id == company){
                $(this).addClass('active_url');
            }else{
                $(this).removeClass('active_url');
            }
            /* if(this_id == ''){
                
            } */
            
        })
    }

    $('#search_product_input').on('change',function(){
        this_value=$(this).val();

        search_by_product(this_value);
    })

    function search_by_product(search){
        if(search!=''){
            search_product=search.toLowerCase();
            
        }else{
            search_product='';
        }
        
        search_products();
    }


    function search_products(){
        //todos preenchidos
        if(search_category != ''  && search_company != '' && search_product!=''){
            
            $('.product_box').each(function(){
                if( $(this).attr('category_id') == search_category &&  $(this).attr('company_id') == search_company  && $(this).attr('product_name').indexOf( search_product ) != -1){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
            
        //apenas categoria
        }else if(search_category!='' && search_company == '' && search_product == ''){
            
            $('.product_box').each(function(){
               
                 
                if( $(this).attr('category_id') == search_category ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
        //apenas empresa
        }else if(search_category == '' && search_company != ''  && search_product == ''){

            $('.product_box').each(function(){
                
                if( $(this).attr('company_id') == search_company  ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
        //apenas produtos
        }else if(search_category == '' && search_company == ''  && search_product != ''){
            $('.product_box').each(function(){
                
                if( $(this).attr('product_name').indexOf( search_product ) != -1){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
        // categorias e empresas preenchido
        }else if(search_category !='' && search_company != '' && search_product == ''){
            $('.product_box').each(function(){
                if( $(this).attr('category_id') == search_category &&  $(this).attr('company_id') == search_company){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
        //categorias e produtos preenchido
        }else if(search_category != '' && search_company == '' && search_product !=''){
            $('.product_box').each(function(){
                if( $(this).attr('category_id') == search_category && $(this).attr('product_name').indexOf( search_product ) != -1){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
        //empresas e produtos preenchido
        }else if(search_category == '' && search_company != '' && search_product !=''){
            $('.product_box').each(function(){
                if( $(this).attr('company_id') == search_company && $(this).attr('product_name').indexOf( search_product ) != -1){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })

        }else if(search_category == '' && search_company == '' && search_product == ''){
           
            clear_all_filters();
        }

        
        

    }

    function clear_all_filters(){
        $('.product_box').show();
    }
</script>