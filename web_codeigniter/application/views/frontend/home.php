<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Administration West</h1>
        <p class="lead text-muted">Somos uma empresa criada com o objetivo de vender produtos de empreasas locais.</p>
        <p>
            <p class="lead text-muted">És uma empresa local e queres vender os teus produtos na nossa plataforma? Contacta-nos através do seguinte botão.</p>
            <a href="<?php echo base_url('contacts'); ?>" class="btn btn-primary my-2">Contacta-nos</a>
        </p>
    </div>
</section>
<section class="text-center" style="min-height:600px">
    <h1 class="jumbotron-heading">Categorias</h1>
        <?php 
            foreach ($categories as $categories){ ?>
                <p> <a href="<?php echo base_url('products'); ?>"> <?php echo $categories['category_name']; ?></a> </p>   
        <?php } ?>
</section>

<section class="text-center" style="min-height:600px">
    <h1 class="jumbotron-heading">Empresas</h1>
    <ul>
        <?php 
            foreach ($companies as $companies): 
        ?>
        <div class="">
            <img class="image-products" style =" max-width:150px; max-height:150px;width: auto;height: auto;" src="<?php echo $companies['image']; ?>">
            <li> <?php echo $companies['company_name']; ?></li>   
            <li> <?php echo $companies['description']; ?></li> 
        </div> 
        <?php  endforeach; ?>
    </ul>
</section>
