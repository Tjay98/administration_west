<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12 mt-5">
            <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="<?php echo $product['image']; ?>">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 mt-5">
            <h4 style="text-align: center;"><?php echo $product['product_name']; ?></h4>
            <p><?php echo $product['category_id']; ?></p>
            <p><?php echo $product['company_id']; ?></p>
            <p style="text-align: right;"><?php echo $product['price']; ?></p>
        </div>
        <div class="col-lg-7 col-md-5 col-sm-12 mt-5">
            <h6>Descrição</h6>
            <p><?php echo $product['big_description']; ?></p>
        </div>
    </div>
</div>
