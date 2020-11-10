<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Site Metas -->
    <title>Administration West</title>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">


    <!--CSS-->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Site CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
        <!--Bootswatch-->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <!--Font Awesome 4.7-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        
        <!-- Datatables CSS --> 





    <!--Javascript-->

        <!--Jquery-->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        
        <!--Bootstrap Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="<?php echo base_url(''); ?>">Administration West</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
<!--                 <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url(''); ?>">Página inicial
                    <span class="sr-only">(current)</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('products/'); ?>">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('categories'); ?>">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('companies'); ?>">Empresas</a>
                </li>
                <form class="form-inline my-2 my-lg-0 form-group" style="padding-left:10px;" method="POST" action="<?php echo base_url('products/search_product');?>">
                    <div class="input-group">
                        <input class="form-control" name="search_bar" id="search_bar" type="text" placeholder="Procurar produto">
                        <div class="input-group-append">
                            <Button class="input-group-text btn" onclick="search_bar_submit()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
    
            </ul>
            <ul class="navbar-nav ">
                 <li class="nav-item">
                    <b><a class="nav-link" href="<?php echo base_url('clients/login'); ?>">Entrar</a></b>
                </li>
            </ul>

        </div>
    </nav>
<!-- </body> -->