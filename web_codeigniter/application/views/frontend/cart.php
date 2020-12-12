<style>
    .text-order{
        list-style: none;
    }
    .remove-products{
        color:#ff0000;
        
    }
    .remove-products:hover{
        color: #a95e5e;
        text-decoration:none;
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
            <table>
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
                <?php if($this->cart->total_items()>0) { 
                    foreach($cartItems as $item){ ?>
                    <tr class="text-center">
                        <th> <img src=""> </th>
                        <th> <?php echo $item['name']; ?> </th>
                        <th> <?php echo $item['price'] .' €'; ?> </th>
                        <th> <?php echo $item['iva']; ?> </th>
                        <th><input type="number" value="<?php echo $item['qty']; ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"></th>
                        <th><?php echo $item["subtotal"].'  €';?></th>
                        <th> <?php echo $item['iva_total']=($item['iva']*$item['qty']) .'  €'; ?> </th>
                        <th> <button class="remove-products" onclick="return confirm('Tem a certeza que pretende apagar este item?')?window.location.href='<?php echo base_url('remove/cart/').$item['rowid']; ?>':false;">X</button> </th>
                    </tr>
                    <?php }
                } else { ?>
                <tr> 
                <td colspan="6"><p>Carrinho vazio</p> </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <button class="btn-primary"> <a style="color: white" href="<?php echo base_url('products/') ?>" > Continuar a comprar </a> </button>
            <button class="btn-primary"> <a style="color: white" href="<?php echo base_url('checkout/') ?>" >Fechar compra </a> </button>
        </div>
      
    </div>
</div>
<div class="container mt-5" style="margin-bottom:100px">
    <div class="row">
        <div class="col-lg-8 col-sm-12"></div>
        <div class="col-lg-4 col-sm-12">
            <div class="order-box">
                <h5 class="text-center">Order summary</h5>
                <ul>
                    <div class="d-flex">
                        <li class="text-order">Sub Total</li>
                        <div class="ml-auto font-weight-bold"> <?php echo $this->cart->total().' €'; ?>  </div>
                    </div>
                    <div class="d-flex">
                        <li class="text-order">IVA Total</li>
                        <div class="ml-auto font-weight-bold">  total do iva</div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <li class="text-order">Coupon Discount</li>
                        <div class="ml-auto font-weight-bold"> </div>
                    </div>
                    <div class="d-flex">
                        <li class="text-order">Tax</li>
                        <div class="ml-auto font-weight-bold">  </div>
                    </div>
                    <div class="d-flex">
                        <li class="text-order">Shipping Cost</li>
                        <div class="ml-auto font-weight-bold">  </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5">  </div>
                    </div>
                    <hr> 
                </ul>   
            </div>
        </div>
    </div>
</div>