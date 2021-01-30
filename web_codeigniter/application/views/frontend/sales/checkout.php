<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span >Carrinho</span>
                    <span class="badge badge-secondary badge-pill">
                        <?php if(!empty($cart_items)){
                            $count_cart=0;
                            foreach($cart_items as $item){
                                $count_cart+=$item['quantity'];
                            }
                            echo $count_cart;
                        } ?>
                    </span>
                </h4>
                <ul class="list-group mb-3" >
                    <?php 
                    if(!empty($cart_items)){ 

                        $iva=0;
                        $subtotal=0;
                        $total=0;

                        foreach($cart_items as $cart){?>

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $cart['product_name']; ?></h6>
                                    <small class="text-muted">Quantidade: <?php echo $cart['quantity']; ?></small>
                                </div>
                                <span class="text-muted">
                                    <!-- <?php echo $cart['price']*$cart['quantity']; ?> € -->
                                    <?php echo number_format($cart['price']*$cart['quantity'], 2, '.', '')." €"; ?>
                                </span>
                            </li>      
                            
                        <?php 
                            $iva+=floatval($cart['price_iva']*$cart['quantity']);
                            $total+=floatval($cart['price']*$cart['quantity']);
                        }?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong><?php echo number_format($total, 2, '.', '')." €"; ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>IVA</span>
                            <strong><?php echo number_format($iva, 2, '.', '')." €"; ?></strong>
                        </li>                        
                        <li class="list-group-item d-flex justify-content-between">
                            <button class="btn btn-primary btn-md btn-block" id="submit_sale_button" onclick="submit_sale_button()" type="button">Terminar a compra</button>
                        </li>
                    <?php }else{?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Não tem produtos no carrinho</span>

                        </li>
                    <?php } ?>



                </ul>

            </div>
            <div class="col-md-8 order-md-1">

                <form id="payment"  method="post" enctype="multipart/form-data">
                    <h4 class="mb-3"  style="font-weight:bold;">Morada de envio</h4>
                    <div class="row">
                        <div class="col-md-12 mb-6">
                            <label for="shipping_name">Nome</label>
                            <input type="text" class="form-control" name="payment[shipping][name]"  id="shipping_name" placeholder="Nome" value="<?php if(!empty($shipping['name'])){ echo $shipping['name']; }?>" required="">
                            <small class="text-danger" id="shipping_name_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="shipping_contact_number">Contacto</label>
                            <input type="text" class="form-control" name="payment[shipping][contact_number]" id="shipping_contact_number" placeholder="Nº de telemóvel" value="<?php if(!empty($shipping['contact_number'])){  echo $shipping['contact_number']; }?>" required="">
                            <small class="text-danger" id="shipping_contact_number_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="shipping_nif">Nif</label>
                            <input type="text" class="form-control" name="payment[shipping][nif]" id="shipping_nif" placeholder="NIF" value="<?php  if(!empty($shipping['nif'])){  echo $shipping['nif']; } ?>" required="">
                            <small class="text-danger" id="shipping_nif_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="shipping_city">Cidade</label>
                            <input type="text" class="form-control" name="payment[shipping][city]" id="shipping_city" placeholder="Cidade" value="<?php  if(!empty($shipping['city'])){  echo $shipping['city']; } ?>" required="">
                            <small class="text-danger" id="shipping_city_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="shipping_zip_code">Código postal</label>
                            <input type="text" class="form-control" name="payment[shipping][zip_code]" id="shipping_zip_code" placeholder="Código postal" value="<?php  if(!empty($shipping['zip_code'])){  echo $shipping['zip_code']; } ?>" required="">
                            <small class="text-danger" id="shipping_zip_code_error"></small>
                        </div>                        
                        <div class="col-md-12 mb-6">
                            <label for="shipping_address">Morada</label>
                            <input type="text" class="form-control" name="payment[shipping][address]" id="shipping_address" placeholder="Morada" value="<?php  if(!empty($shipping['address'])){  echo $shipping['address']; } ?>" required="">
                            <small class="text-danger" id="shipping_address_error"></small>
                        </div>                   

                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3" style="font-weight:bold;">Morada de faturação</h4>
                    <div class="row">
                        <div class="col-md-12 mb-6">
                            <label for="billing_name">Nome</label>
                            <input type="text" class="form-control" name="payment[billing][name]" id="billing_name" placeholder="Nome" value="<?php if(!empty($billing['name'])){ echo $billing['name']; }?>" required="">
                            <small class="text-danger" id="billing_name_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="billing_contact_number">Contacto</label>
                            <input type="text" class="form-control"  name="payment[billing][contact_number]" id="billing_contact_number" placeholder="Nº de telemóvel" value="<?php if(!empty($billing['contact_number'])){  echo $billing['contact_number']; }?>" required="">
                            <small class="text-danger" id="billing_contact_number_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="billing_nif">Nif</label>
                            <input type="text" class="form-control" name="payment[billing][nif]" id="billing_nif" placeholder="NIF" value="<?php  if(!empty($billing['nif'])){  echo $billing['nif']; } ?>" required="">
                            <small class="text-danger" id="billing_nif_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="billing_city">Cidade</label>
                            <input type="text" class="form-control" name="payment[billing][city]" id="billing_city" placeholder="Cidade" value="<?php  if(!empty($billing['city'])){  echo $billing['city']; } ?>" required="">
                            <small class="text-danger" id="billing_city_error"></small>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="billing_zip_code">Código postal</label>
                            <input type="text" class="form-control" name="payment[billing][zip_code]" id="billing_zip_code" placeholder="Código postal" value="<?php  if(!empty($billing['zip_code'])){  echo $billing['zip_code']; } ?>" required="">
                            <small class="text-danger" id="billing_zip_code_error"></small>
                        </div>                        
                        <div class="col-md-12 mb-6">
                            <label for="billing_address">Morada</label>
                            <input type="text" class="form-control" name="payment[billing][address]" id="billing_address" placeholder="Morada" value="<?php  if(!empty($billing['address'])){  echo $billing['address']; } ?>" required="">
                            <small class="text-danger" id="billing_address_error"></small>
                        </div>                   

                    </div>

                    <?php if(!empty($payment_methods)){ ?>

                        <hr class="mb-4">
                        <h4 class="mb-3"  style="font-weight:bold;">Método de pagamento</h4>
                        <div class="d-block my-3">
                            <?php foreach($payment_methods as $payment){ ?>
                                <div class="custom-control custom-radio">
                                    <input id="<?php echo "method_".strtolower($payment['name']); ?>" name="payment[payment_method][payment_method_id]" type="radio" class="custom-control-input payment_methods" value="<?php echo $payment['id'] ?>" required="">
                                    <label class="custom-control-label" for="method_<?php echo strtolower($payment['name']); ?>"><?php echo $payment['name'] ?></label>
                                </div>
                            <?php }?>
                        </div>
                    <?php }?>
                </form>
            </div>
        </div>

    </div>
</section>
<script>
    $(document).ready(function(){
        
    })
    function submit_sale_button(){
        form = $('#payment').serialize();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('sales/create_sale') ?>",
            data: form,
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>