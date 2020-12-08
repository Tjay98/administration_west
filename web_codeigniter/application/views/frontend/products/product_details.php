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
</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="custom-boxes">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 mt-5">
                <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="<?php echo $product['image']; ?>">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mt-5">
                <h4 style="text-align: center;"><?php echo $product['product_name']; ?></h4>
                <p class="text-center"><?php echo $product['category_name']; ?></p>
                <p class="text-center"><?php echo $product['company_name']; ?></p>
                <p class="text-right"><?php echo $product['price']." €"; ?></p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 mt-5">
                <h6>Descrição</h6>
                <p class="text-justify"><?php echo $product['big_description']; ?></p>
                <input type="number" placeholder="Quantidade">
            <button class="btn-primary" style="border-radius: 10px; padding:5px"> <a href="<?php echo base_url('products'); ?>" >Adicionar ao Carrinho</a> </button>
        </div>       
    </div>
</div>
