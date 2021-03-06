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
        padding: 20px;
        box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);
        background: #fff;
        transition: 0.4s;
        border-radius: 10px;
        text-align: center;
        font-size: 18px;
        color:#2c3e50;
    }
   
    .custom-boxes:hover {
        box-shadow: 0px 0px 30px rgba(73, 78, 92, 0.15);
        transform: translateY(-10px);
        -webkit-transform: translateY(-10px);
        -moz-transform: translateY(-10px);
        color:#000;
        text-decoration:none;
	}
    
</style>
<section class="content" style="margin-top:60px">
    
        

            <section class="jumbotron text-center" style="width:100%">
                <div class="container">
                    <h1 class="jumbotron-heading">Administration West</h1>
                    <p class="lead text-muted">Somos uma empresa criada com o objetivo de vender produtos de empreasas locais.</p>
                    <p>
                        <p class="lead text-muted">És uma empresa local e queres vender os teus produtos na nossa plataforma? Contacta-nos através do seguinte botão.</p>
                        <a href="<?php echo base_url('contacts'); ?>" class="btn btn-primary my-2">Contacta-nos</a>
                    </p>
                </div>
            </section>
    <div class="container">
        <div class="row">
            <section class="text-center mt-5" style="width:100%;">
                <div class="container">
                    <!-- <div class="background-custom-boxes"> -->
                        <h1 class="jumbotron-heading">Empresas</h1>
                        <div class="container">
                            <div class="row">
                            <?php 
                            foreach ($companies as $company){ 
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-2 mb-5 ">
                                    <a style="text-decoration:none;" href="<?php echo base_url('products/?company='.$company['id']); ?>" >
                                    <div class="custom-boxes" style="min-height:200px">
                                        <div class="row">
                                            <img class="image-products mr-4" style =" max-width:100px; max-height:50px; width: auto;height: auto;" src="<?php echo base_url('uploads/companies/').$company['image']; ?>">
                                            <h4><b> <?php echo $company['company_name']; ?> </b> </h4> 
                                        </div>  
                                        <p class="text-justify"> <?php echo $company['description']; ?></p> 
                                    </div> 
                                    </a>
                                </div> 
                            <?php  } ?>
                        </div>
                    <!-- </div> -->
                </div>
            </section>
            <section class="text-center"  style="width:100%;">
                <div class="container">
                    <!-- <div class="background-custom-boxes"> -->
                        <h1 class="jumbotron-heading mb-5">Categorias</h1>
                        <div class="row">
                        <?php 
                            foreach ($categories as $category){ ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 mt-2 mb-5">
                                <a class="custom-boxes" href="<?php echo base_url('products/?category=').$category['id']; ?>"> <?php echo $category['category_name']; ?></a> 
                            </div>          
                        <?php } ?>
                        </div>
                    <!-- </div> -->
                </div>
            </section>


        </div>
    </div>
</section>
