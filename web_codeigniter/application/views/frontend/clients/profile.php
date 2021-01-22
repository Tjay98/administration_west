        <div class="container">
            <!-- IMPLEMENTAR UM NOVO FORMULÁRIO PARA EDITAR OS DADOS ABAIXO E COLOCAR NO FORM, FAZER TAMBÉM COM QUE TENHA VALIDAÇÕES-->
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">Perfil</h3>
                <div class="form-signin">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputUsername">Nome</label> 
                            <label   class="form-control-custom" readonly ><?php echo $user['username'];?></label>                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputEmail">Email</label> 
                            <label   class="form-control-custom" readonly><?php echo $user['email'];?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputPhoneNumber">Número de telemóvel</label> 
                            <label   class="form-control-custom" readonly ><?php echo $user['phone_number'];?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputDate">Data de nascimento</label>
                            <label   class="form-control-custom"readonly ><?php echo $user['birthday_date'];?></label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top:20px;">
                            <button type="submit" onclick="open_edit_moradas_entrega()" class="btn btn-success" style="width:100%;">Moradas de entrega</button>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top:20px;">
                            <button type="submit" onclick="open_edit_moradas_fatura()" class="btn btn-success" style="width:100%;">Moradas de fatura</button>
                        </div>
                    </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top:20px;">
                            <button type="button"  onclick="open_edit_password()" class="btn btn-success" style="width:100%;">Mudar a Password</button>
                    </div>
            </div>
        </div><!-- /card-container -->
 
                        
<!-- Modal -->
 
<!--Password-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="passwordModalLabel" style="font-weight:bold;">Alterar password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="pasword_form" method="POST" action="<?php echo base_url('clients/password'); ?>"> 
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="inputPassword">Password antiga</label> 
                                    <input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control-custom" placeholder="Password antiga" tabindex="5" required>
                                    <small class="text-danger" id="password_error"></small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label for="inputPassword">Nova Password</label> 
                                    <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" tabindex="5" required>
                                    <small class="text-danger" id="password_error"></small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label for="inputRepetirPassword">Repetir a password</label> 
                                    <input type="password" id="inputRepetirPassword" class="form-control-custom" placeholder="Repetir Password" tabindex="6" required>
                                    <small class="text-danger" id="repeat_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" style="width:100%;">Alterar password</button>
                        </div>
                    </form>
                </div>
            </div>
           
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

    function open_edit_password(){
        $('#passwordModal').modal('show');
        
        $('#password_form').on('submit', function () {
            event.preventDefault();
 
            old_password=$('#inputOldPassword').val();
            password_hash=$('#inputPassword').val();
            repeat_password=$('#inputRepetirPassword').val();
           
            $('#password_error').text('');
            $('#repeat_error').text('');
 
            flag=true
 
            if(password.length < 6 || password.length > 25){
                flag=false;
                $('#password_error').text('A password não corresponde ao tamanho permitido (6 caractéres a 25)');
            }
            if(repeat_password!=password){
                flag=false;
                $('#repeat_error').text('As passwords não correspondem'); 
            }
 
            if(flag==true){
                            
            formdata=$('#password_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/password'); ?>",
                    data: formdata,
                    success: function (response) {
                        if(response=='success'){
                            window.location.href = '<?php echo base_url('clients/profile') ?>';
                        } else {
                            if(response=='pass_number_error'){
                                $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                            }else if(response=='pass_capital_letter'){
                                $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                            }else if(response=='pass_lower_letter'){
                                $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                            }else if(response== 'pass_special_caracter'){
                                $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                            }
                        }
                    }
                }); 
            }
        });

    }

    


</script>
