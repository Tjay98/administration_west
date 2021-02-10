<style>
    .background-custom-boxes{
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        min-height:400px
    }
     .custom-boxes{
         margin-top:10px;
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        text-align: center;
    }
    .custom-boxes:hover {
        box-shadow: 0px 0px 30px rgba(73, 78, 92, 0.15);
        transform: translateY(-10px);
        -webkit-transform: translateY(-10px);
        -moz-transform: translateY(-10px);
	}

    .custom-boxes a{
        font-size: 15px;
        color:#000;
    }

    .custom-boxes a:hover{
        text-decoration:none;
    }
</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div >
        <h3 class="text-center mb-4">Categorias</h3>
        <div class="row">
            <?php 
            foreach ($categories as $category){ ?>
                <a style="text-decoration:none;color:black;" class="col-lg-2 col-md-3 col-sm-12" href="<?php echo base_url('products/?category=').$category['id']; ?>">
                    
                        <div class="custom-boxes">
                            <?php echo $category['category_name']; ?>
                        </div>
                    
                </a> 
            <?php } ?>
        </div>
    </div>
</div>
