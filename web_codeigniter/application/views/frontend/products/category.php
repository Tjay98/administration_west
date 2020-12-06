<div class="container" style="margin-top:100px; margin-bottom:100px;">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12">
            <h3 class="text-center">Categorias</h3>
            <ul>
                <?php 
                foreach ($categories as $categories){ ?>
                <li>  <?php echo $categories['category_name']; ?></a> </li>   
                <?php } ?>
            </ul>
        </div>
    </div>
</div>