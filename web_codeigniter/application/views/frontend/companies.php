<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <h3 class="text-center">Empresas</h3>
    <div class="row">
        <ul>
            <?php 
                foreach ($companies as $company): 
            ?>
                <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="<?php echo $company->image; ?>">
                <li> <?php echo $company->company_name; ?></li>   
                <li> <?php echo $company->description; ?></li>  
            <?php 
                endforeach;
            ?>
        </ul>
    </div>
</div>