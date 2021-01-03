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
        min-height:200px
    }
    .custom-boxes:hover {
        box-shadow: 0px 0px 30px rgba(73, 78, 92, 0.15);
        transform: translateY(-10px);
        -webkit-transform: translateY(-10px);
        -moz-transform: translateY(-10px);
	}

</style>
<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="background-custom-boxes">
        <h3 class="text-center mb-4">Empresas</h3>
        <div class="row">
            <?php 
                foreach ($companies as $companies): ?>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="custom-boxes">
                        <h4 class="text-center"> <?php echo $companies['company_name']; ?></h4>   
                        <p class="text-justify"> <?php echo $companies['description']; ?></p>  
                        <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="<?php echo base_url('uploads/companies/').$companies['image']; ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>