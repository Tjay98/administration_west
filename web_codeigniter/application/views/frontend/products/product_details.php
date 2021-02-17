<style>
     .custom-boxes{
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        min-height:300px
    }

    .custom-boxes a{
        font-size: 15px;
        color:#fff;
    }

    .custom-boxes a:hover{
        text-decoration:none;
    }
    @media (max-width: 768px) {
        .image-products{
            max-width:200px; 
            max-height:200px;
            width: auto;
            height: auto;
        }
        .description{
            overflow:scroll;
        }
    }
    @media (min-width: 768px) {
    .image-products{
        max-width:400px; 
        max-height:400px;
        width: auto;
        height: auto;
    }
}
    
</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="custom-boxes">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mt-5  text-center" >
                <img class="image-products"  src="<?php echo base_url('uploads/products/')?><?php echo $product['image']; ?>">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mt-5">
                <h2 style="text-align: center;"><b><?php echo $product['product_name']; ?></b></h2>
                <p class="text-center"><b>Categoria: </b> <i> <?php echo $product['category_name']; ?> </i> </p>
                <p class="text-center"><b>Empresa: </b> <u> <?php echo $product['company_name']; ?> </u> </p>
                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <p class="text-center" style="font-size:30px"><b><?php echo $product['price']." €"; ?></b></p>
                        </div>       
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <a class="btn btn-primary" style="border-radius: 10px; padding:5px" href="<?php echo base_url('add/cart/').$product['id']; ?>" >Adicionar ao Carrinho </a>
                </div>   
                </div>       
    

            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <h5 class="text-center"><b>Descrição:</b></h5>
                <p class="text-justify description"><?php echo $product['big_description']; ?></p>
        </div>       
    </div>
</div>
