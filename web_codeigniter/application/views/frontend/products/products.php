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

</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="custom-boxes"  style="position:fixed;">
                <h3 class="text-center mt-1">Categorias</h3>
                <?php 
                foreach ($categories as $categories){ ?>
                <p class="text-center category"> <a href="<?php echo base_url('categories/').$categories['id']; ?>"> <?php echo $categories['category_name']; ?></a> </p>   
                <?php } ?>

                <h3 class="text-center mt-5">Empresas</h3>
                <?php 
                foreach ($companies as $companies){ ?>
                <p class="text-center category"> <a href="<?php echo base_url('companies/').$companies['id']; ?>"> <?php echo $companies['company_name']; ?></a> </p>   
                <?php } ?>
            </div>
        </div>
        
        <div class="col-lg-9 col-md-8 col-sm-12">
            <!--class="custom-boxes" -->
            <div >
                <h3 class="text-center">Produtos</h3>
                <?php 
                foreach ($products as $products){ ?>
                    <div class="custom-boxes-products mb-3">
                        <div class="row">
                            <img class="image-products ml-3" style =" margin-top: auto; margin-bottom: auto; position: relative; max-width:120px; max-height:70px; " src="<?php echo base_url('uploads/products/').$products['image']; ?>" alt="Imagem <?php echo $products['product_name']; ?>">
                            <div class="col-lg-4 col-md-8 col-sm-12 ">
                                <h4 style="text-align: center;"><?php echo $products['product_name']; ?></h4>
                                <p class="text-center"><?php echo $products['category_name']; ?></p>
                                <p class="text-center"><?php echo $products['company_name']; ?></p>
                                <p class="text-right"><?php echo $products['price']." €"; ?></p>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12  ">
                                <h6 class="text-center"><b>Descrição</b></h6>
                                <p class="text-justify"><?php echo $products['small_description']; ?></p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-top: auto; margin-bottom: auto; text-align:center">
                                <button class="btn-primary mr-3" style="border-radius: 10px; padding:5px"> <a href="<?php echo base_url('products/').$products['id']; ?>" >Ver Detalhes do Produto</a> </button>
                                <button id="addToCart" class="btn-primary" style="border-radius: 10px; padding:5px"> <a href="<?php echo base_url('add/cart/').$products['id']; ?>" >Adicionar ao Carrinho</a> </button>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</div>  
