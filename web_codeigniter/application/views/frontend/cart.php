<style>
    .text-order{
        list-style: none;
    }

</style>
<script>
// Update item quantity
function updateCartItem(obj, rowid){
    $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
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
                                <th> <img src=""> </th>
                                <th> <?php echo $item['name']; ?> </th>
                                <th> <?php echo $item['price'] .' €'; ?> </th>
                                <th> <?php echo $item['iva']; ?> </th>
                                <th><input type="number" value="<?php echo $item['qty']; ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"></th>
                                <th><?php echo $item["subtotal"].'  €';?></th>
                                <th> <?php echo $item['iva_total']=($item['iva']*$item['qty']) .'  €'; ?> </th>
                                <th> <button class="btn btn-danger remove-products" onclick="return confirm('Tem a certeza que pretende apagar este item?')?window.location.href='<?php echo base_url('remove/cart/').$item['rowid']; ?>':false;">Remover  X</button> </th>
                            </tr>
                            <?php 
                                $iva+=$item['iva_total'];
                                $total+=$item["subtotal"];
                                $subtotal+=($item["subtotal"]-$item['iva_total']);
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
                                <div class="ml-auto font-weight-bold"><?php echo $subtotal." €"; ?></div>
                            </div>
                            <div class="d-flex">
                                <li class="text-order">IVA Total</li>
                                <div class="ml-auto font-weight-bold"><?php echo $iva." €"; ?></div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Total</h5>
                                <div class="ml-auto h5"><?php echo $total." €"; ?></div>
                            </div>
                            <hr> 
                        </ul> 
                        <button class="btn btn-warning"> <a style="color: white" href="<?php echo base_url('products/') ?>" > Continuar a comprar </a> </button>
                        <button class="btn btn-success pull-right"> <a style="color: white" href="<?php echo base_url('checkout/') ?>" >Concluir compra </a> </button>
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
