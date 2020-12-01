<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12">
            <h3 class="text-center">Categorias</h3>
            <ul>
                <?php 
                foreach ($categories as $categories){ ?>
                <li> <a href="<?php echo base_url('products'); ?>"> <?php echo $categories['category_name']; ?></a> </li>   
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="row">
            
                <?php 
                foreach ($products as $products){ ?>
                        
                    <div class="col-lg-2 col-md-3 col-sm-12 mt-5">
                        <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="https://img.ibxk.com.br/2015/07/23/23170425700729.jpg?w=328">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 mt-5">
                        <h4 style="text-align: center;"><?php echo $products['product_name']; ?></h4>
                        <p><?php echo $products['category_id']; ?></p>
                        <p><?php echo $products['company_id']; ?></p>
                        <p style="text-align: right;"><?php echo $products['price']; ?></p>
                    </div>
                    <div class="col-lg-7 col-md-5 col-sm-12 mt-5">
                        <h6>Descrição</h6>
                        <p><?php echo $products['small_description']; ?></p>
                        <a href="<?php echo base_url('products/').$products['id']; ?>" class="btn-primary">ver</a>
                        <a href="<?php echo base_url('products'); ?>" class="btn-primary">carrinho</a>
                    </div>

                <?php } ?> 
              
            </div>
        </div>
    </div>
</div>