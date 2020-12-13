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
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstwatch.min.css'); ?>">
        <!--Font Awesome 4.7-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!--Scripts-->
        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>


        <!--Bootstrap Jquery-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

                

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
                <?php if(empty($this->session->userdata('username'))){ ?>
                    <li class="nav-item">
                        <b><a class="nav-link" href="<?php echo base_url('clients/login'); ?>">Entrar</a></b>
                    </li>
                        
                <?php }else{?>
                    <li class="nav-item">
                        <b><a class="nav-link" href="<?php echo base_url('cart'); ?>">Carrinho <i class="fa fa-shopping-cart"><?php echo $count_cart; ?></i></a></b>
                    </li>
<!--                     <li class="nav-item">
                        <b><a class="nav-link" href="<?php echo base_url('clients/profile'); ?>"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username'); ?></a></b>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->session->userdata('username'); ?> <i class="fa fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo base_url('clients/profile'); ?>">Perfil</a>
                            <a class="dropdown-item" href="<?php echo base_url('sales/history'); ?>">Histórico de pedidos</a>
                                <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('clients/logout'); ?>">Sair</a>
                            </div>
                        </div>
                    </li>
                <?php }?>
                
            </ul>

        </div>
    </nav>
<!-- </body> -->