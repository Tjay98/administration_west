<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                        <small class="text-danger" id="payment_method_error"></small>
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

        $('.text-danger').text('');

        //shipping address
        name_shipping=$('#shipping_name').val();
        number_shipping=$('#shipping_contact_number').val();
        nif_shipping=$('#shipping_nif').val();
        city_shipping=$('#shipping_city').val();
        code_shipping=$('#shipping_zip_code').val();
        address_shipping=$('#shipping_address').val();

        //billing address
        name_billing=$('#billing_name').val();
        number_billing=$('#billing_contact_number').val();
        nif_billing=$('#billing_nif').val();
        city_billing=$('#billing_city').val();
        code_billing=$('#billing_zip_code').val();
        address_billing=$('#billing_address').val(); 

        //payment_method
        payment_method=$('input[name="payment[payment_method][payment_method_id]"]:checked').val();

       

        flag=true

        //shipping address
        if(name_shipping.length < 5 || name_shipping.length > 255){
            $('#shipping_name_error').text('Preencha o seu nome');
            flag=false;
        }
        if(number_shipping.length!=9){
            $('#shipping_contact_number_error').text('O número de telemóvel é inválido');
            flag=false;
        }
        if(nif_shipping.length!=9){
            $('#shipping_nif_error').text('O NIF é inválido');
            flag=false;
        }
        if(city_shipping.length < 5 || city_shipping.length > 255){
            $('#shipping_city_error').text('Preencha o nome da sua cidade');
            flag=false;
        }
        if(code_shipping.length >10 ){
            $('#shipping_zip_code_error').text('O código postal é inválido');
            flag=false;
        }
        if(address_shipping.length < 5 || address_shipping.length > 255){
            $('#shipping_address_error').text('Preencha a sua morada');
            flag=false;
        }
        
        //billing address
        if(name_billing.length < 5 || name_billing.length > 255){
            $('#billing_name_error').text('Preencha o seu nome');
            flag=false;
        }
        if(number_billing.length!=9){
            $('#billing_contact_number_error').text('O número de telemóvel é inválido');
            flag=false;
        }
        if(nif_billing.length!=9){
            $('#billing_nif_error').text('O NIF é inválido');
            flag=false;
        }
        if(city_billing.length < 5 || city_billing.length > 255){
            $('#billing_city_error').text('Preencha o nome da sua cidade');
            flag=false;
        }
        if(code_billing.length > 10){
            $('#billing_zip_code_error').text('O código postal é inválido');
            flag=false;
        }
        if(address_billing.length < 5 || address_billing.length > 255){
            $('#billing_address_error').text('Preencha a sua morada');
            flag=false;
        }
        /* alert(payment_method); */
        if(payment_method =='undefined' || !payment_method){
            flag=false;
            $('#payment_method_error').text('Selecione uma opção');
        }

        if(flag==true){
            form = $('#payment').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('sales/create_sale') ?>",
                data: form,
                success: function (response) {
                    //console.log(response);
                    if(response=='success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Venda criada com sucesso',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        setTimeout(function() {
                            url="<?php echo base_url('sales/history')?>"
                            window.location.href= url;
                        }, 2000);
                    }else if(response="product_quantity_error"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Algum dos produtos já não está em stock',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        setTimeout(function() {
                            url="<?php echo base_url('cart')?>"
                            window.location.href= url;
                        }, 2000);
                    }else if(response=='error'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocorreu um erro inesperado, porfavor contacte-nos',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                
                }
            });
        }
    }
</script>