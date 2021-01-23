//aqui metodos de pagamento e escolher as moradas e os botoes das moradas aqui tambem
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <h1>Compra quase a acabar</h1>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h3>Método de pagamento</h3>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h3>Moradas</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top:20px;">
                    <button type="submit" onclick="open_edit_moradas_entrega()" class="btn btn-success" style="width:100%;">Mudar morada de entrega</button>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top:20px;">
                    <button type="submit" onclick="open_edit_moradas_fatura()" class="btn btn-success" style="width:100%;">Mudar morada de faturação</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 text-center mt-5">
            <a href="<?php echo base_url('checkout/') ?>" class="btn btn-success"> Concluir compra </a>
        </div>
    </div>
</div>

 
<!--Morada de entrega-->
<div class="modal fade" id="moradaEntregaModal" tabindex="0" role="dialog" aria-labelledby="moradaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="moradaModalLabel" style="font-weight:bold;">Morada de entrega</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="morada_entrega_form" method="POST" action="<?php echo base_url('clients/morada_shipping'); ?>"> 
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputNome">Nome do cliente</label> 
                            <input type="text" id="inputNomeClienteEntrega" class="form-control-custom" placeholder="Nome do cliente" tabindex="1" required>
                            <small class="text-danger" id="nome_error"></small>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="inputTelemovel">Número de telemóvel</label> 
                                        <input type="text" id="inputTelemovelEntrega" class="form-control-custom" placeholder="Número de telemóvel" tabindex="2" required>
                                        <small class="text-danger" id="telemovel_error"></small>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="inputNif">NIF</label> 
                                        <input type="text" id="inputNifEntrega" class="form-control-custom" placeholder="Número de telemóvel" tabindex="2" required>
                                        <small class="text-danger" id="nif_error"></small>
                                    </div>
                                </div>
                        
                            <label for="inputMorada">Morada</label> 
                            <input type="text" id="inputMoradaEntrega" class="form-control-custom" placeholder="Morada" tabindex="4" required>
                            <small class="text-danger" id="morada_error"></small>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <label for="inputCodPostal">Código postal</label> 
                                    <input type="text" id="inputCodPostalEntrega" class="form-control-custom" placeholder="Código postal" tabindex="5" required>
                                    <small class="text-danger" id="postal_error"></small>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <label for="inputCidade">Cidade</label> 
                                    <input type="text" id="inputCidadeEntrega" class="form-control-custom" placeholder="Cidade" tabindex="3" required>
                                    <small class="text-danger" id="cidade_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" style="width:100%;" tabindex="4">Concluído</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Morada de faturaçao-->
<div class="modal fade" id="moradaFaturaModal" tabindex="0" role="dialog" aria-labelledby="moradaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="moradaModalLabel" style="font-weight:bold;">Morada de faturação</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="morada_fatura_form" method="POST" action="<?php echo base_url('clients/morada_billing'); ?>"> 
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputNome">Nome do cliente</label> 
                            <input type="text" id="inputNomeFaturacao" class="form-control-custom" placeholder="Nome do cliente" tabindex="1" required>
                            <small class="text-danger" id="nome_error"></small>

                            <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="inputTelemovel">Número de telemóvel</label> 
                                        <input type="text" id="inputTelemovelFaturacao" class="form-control-custom" placeholder="Número de telemóvel" tabindex="2" required>
                                        <small class="text-danger" id="telemovel_error"></small>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="inputNif">NIF</label> 
                                        <input type="text" id="inputNifFaturacao" class="form-control-custom" placeholder="Número de telemóvel" tabindex="2" required>
                                        <small class="text-danger" id="nif_error"></small>
                                    </div>
                                </div>

                            <label for="inputMorada">Morada</label> 
                            <input type="text" id="inputMoradaFaturacao" class="form-control-custom" placeholder="Morada" tabindex="4" required>
                            <small class="text-danger" id="morada_error"></small>

                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <label for="inputCodPostal">Código postal</label> 
                                    <input type="text" id="inputCodPostalFaturacao" class="form-control-custom" placeholder="Código postal" tabindex="5" required>
                                    <small class="text-danger" id="postal_error"></small>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <label for="inputCidade">Cidade</label> 
                                    <input type="text" id="inputCidadeFaturacao" class="form-control-custom" placeholder="Cidade" tabindex="3" required>
                                    <small class="text-danger" id="cidade_error"></small>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" style="width:100%;" tabindex="4">Concluído</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 
    function open_edit_moradas_entrega(){
        $('#moradaEntregaModal').modal('show');

        $('#morada_entrega_form').on('submit', function () {
            event.preventDefault();
 
            nome_cliente_entrega=$('#inputNomeClienteEntrega').val();
            telemovel_entrega=$('#inputTelemovelEntrega').val();
            nif_entrega=$('#inputNifEntrega').val();
            morada_entrega=$('#inputMoradaEntrega').val();
            cod_postal_entrega=$('#inputCodPostalEntrega').val();
            cidade_entrega=$('#inputCidadeEntrega').val();
           
            flag=true
 
            if(flag==true){
                            
            formdata=$('#morada_entrega_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/morada_shipping'); ?>",
                    data: formdata,
                    success: function (response) {
                        if(response=='success'){
                            window.location.href = '<?php echo base_url('clients/profile') ?>';
                        }
                    }
                });
            }
        });
    }

    function open_edit_moradas_fatura(){
        $('#moradaFaturaModal').modal('show');

        $('#morada_fatura_form').on('submit', function () {
            event.preventDefault();
 
            nome_fatura=$('#inputNomeFaturacao').val();
            telemovel_fatura=$('#inputTelemovelFaturacao').val();
            nif_fatura=$('#inputNifFaturacao').val();
            morada_fatura=$('#inputMoradaFaturacao').val();
            cod_postal_fatura=$('#inputCodPostalFaturacao').val();
            cidade_fatura=$('#inputCidadeFaturacao').val();
           
            flag=true
 
            if(flag==true){
                            
            formdata=$('#morada_fatura_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/morada_billing'); ?>",
                    data: formdata,
                    success: function (response) {
                        if(response=='success'){
                            window.location.href = '<?php echo base_url('clients/profile') ?>';
                        }
                    }
                });
            }
        });
    }
</script>
