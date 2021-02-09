<style>
    .text-order{
        list-style: none;
    }

</style>
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body table-responsive">
            <?php if(!empty($cartItems)) { $iva=0; $subtotal=0; $total=0;?>
                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço (unidade)</th>
                                <th>Iva (unidade)</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th>Total Iva</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            <?php foreach($cartItems as $item){ ?>
                            <tr class="text-center">
                                <th> <img class="image-products ml-3" style =" margin-top: auto; margin-bottom: auto; position: relative; max-width:120px; max-height:70px; " src="<?php echo base_url('uploads/products/').$item['image']; ?>" alt="Imagem <?php echo $item['product_name']; ?>"> </th>
                                <th> <?php echo $item['product_name']; ?> </th>
                                <th> <?php echo $item['price'] .' €'; ?> </th>
                                <th> <?php echo $item['price_iva']; ?> </th>
                                <th><input type="number" id="qty" value="<?php echo $item['quantity']; ?>" onchange="updateCartItem(this, <?php echo $item['product_id']; ?>)"></th>
                                <th><?php echo floatval($item["subtotal"]=($item['price']*$item['quantity'])).'  €';?></th>
                                <th> <?php echo $item['iva_total']=($item['price_iva']*$item['quantity']) .'  €'; ?> </th>
                                <th> <button class="btn btn-danger remove-products" onclick="return confirm('Tem a certeza que pretende apagar este item?')?window.location.href='<?php echo base_url('remove/cart/').$item['product_id']; ?>':false;">Remover  X</button> </th>
                            </tr>
                            <?php 
                                $iva+=floatval($item['iva_total']);
                                $total+=floatval($item["subtotal"]);
                                $subtotal+=(floatval($item["subtotal"])-floatval($item['iva_total']));
                            } ?>
                        <tr> 
                        <!-- <td colspan="8"><p>Carrinho vazio</p> </td> -->
                        </tr>
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="card-footer">
                        <ul>
                            <div class="d-flex">
                                <li class="text-order">Sub Total</li>
                                <div class="ml-auto font-weight-bold"><?php echo number_format($subtotal, 2, '.', '')." €"; ?></div>
                            </div>
                            <div class="d-flex">
                                <li class="text-order">IVA Total</li>
                                <div class="ml-auto font-weight-bold"><?php echo number_format($iva, 2, '.', '')." €"; ?></div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Total</h5>
                                <div class="ml-auto h5"><?php echo number_format($total, 2, '.', '')." €"; ?></div>
                            </div>
                            <hr> 
                        </ul> 
                        <a class="btn btn-warning" href="<?php echo base_url('products/') ?>" > Continuar a comprar </button>
                        <a href="<?php echo base_url('sales/checkout/') ?>" class="btn btn-success pull-right"> Concluir compra </a>
                    </div>

            <?php }else{?>
                    <h3 style="text-align:center;">Não tem produtos no carrinho.</h3>
                    <h3 style="text-align:center;">Para adicionar algo ao carrinho visite a nossa página de <a href="<?php echo base_url('products/') ?>">produtos</a>.</h3>
            <?php } ?>  
                </div>
            </div>
        </div>
      
    </div>
</div>
<script>
    // Update item quantity
    function updateCartItem(qty, product_id){
       // console.log(product_id);

        quantity=$('#qty').val();
       // console.log(quantity); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('update/cart/quantity/'); ?>"  + product_id,
            data: {product_id:product_id, quantity:quantity},
            success: function (response) {
               // console.log(response);
                 
                    location.reload();
               
            }
        });
    }
</script>