    <form id="registo_form" method="POST" action="<?php echo base_url('clients/register'); ?>"> 
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">REGISTO</h3>
                <div class="form-signin">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputUsername">Nome</label> 
                            <input type="text" id="inputUsername" name="inputUsername" class="form-control-custom" placeholder="Nome de utilizador" tabindex="1" required autofocus>
                            <small class="text-danger" id="username_error"></small>
                            
                            
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputEmail">Email</label> 
                            <input type="email" id="inputEmail" name="inputEmail" class="form-control-custom" placeholder="Email" tabindex="2" required autofocus>
                            <small class="text-danger" id="email_error"></small>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputNif">NIF</label> 
                            <input type="text" id="inputNif" name="inputNif" class="form-control-custom"  placeholder="NIF" tabindex="3" required autofocus>
                            <small class="text-danger" id="nif_error"></small>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputDate">Data de nascimento</label>
                            <input type="date" id="inputDate" name="inputDate" class="form-control-custom" placeholder="Data de nascimento" tabindex="4" required autofocus>
                            <small class="text-danger" id="date_error"></small>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputPassword">Password</label> 
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" tabindex="5" required>
                            <small class="text-danger" id="password_error"></small>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputRepetirPassword">Repetir a password</label> 
                            <input type="password" id="inputRepetirPassword" class="form-control-custom" placeholder="Repetir Password" tabindex="6" required>
                            <small class="text-danger" id="repeat_error"></small>

                        </div>
                    </div> 
                <button class="btn btn-lg btn-primary btn-block btn-signin mt-4" type="submit" tabindex="7">Registo</button>
            </div>
            <p>Já tem uma conta? <a href="<?php echo base_url('clients/login'); ?>" class="forgot-password">Faça Login</a></p>
        </div><!-- /card-container -->
    </form>

    <script>
        $('#registo_form').on('submit', function () {
            event.preventDefault();

            //set variables from inputs
            username=$('#inputUsername').val();
            email=$('#inputEmail').val();
            nif=$('#inputNif').val();
            data=$('#inputDate').val();
            password=$('#inputPassword').val();
            repeat_password=$('#inputRepetirPassword').val();

            //clear errors
            $('#username_error').text('');
            $('#email_error').text('');
            $('#nif_error').text('');
            $('#date_error').text('');
            $('#password_error').text('');
            $('#repeat_error').text('');

            flag=true

            if(username.length < 5 || username.length > 255){
                $('#username_error').text('Preencha o seu nome');
                flag=false;
            }
            if(email.length < 5 || email.length > 255){
                $('#email_error').text('Preencha o seu nome');
                flag=false;
            }

            if(nif.length!=9){
                $('#nif_error').text('O nif é inválido');
                flag=false;
            }
            if(data<1){
                $('#date_error').text('Preencha a data de nascimento');
                flag=false;
            }
            if(password.length < 6 || password.length > 25){
                flag=false;
                $('#password_error').text('A password não corresponde ao tamanho permitido (6 caractéres a 25)');
            }
            if(repeat_password!=password){
                flag=false;
                $('#repeat_error').text('As passwords não correspondem');
                
            }

            if(flag==true){
                            
                formdata=$('#registo_form').serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('clients/register'); ?>",
                        data: formdata,
                        success: function (response) {
                            if(response=='success'){
                                window.location.href = '<?php echo base_url('clients/login') ?>';
                            }else{
                                if(response=='username_error'){
                                    $('#username_error').text('Este nome de utilizador já está em uso');
                                }
                                else if(response=='email_error'){
                                    $('#email_error').text('Este email já está em uso');
                                }else if(response=='nif_error'){
                                    $('#nif_error').text('Este nif já está em uso');
                                }else if(response=='pass_number_error'){
                                    $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                                }else if(response=='pass_capital_letter'){
                                    $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                                }else if(response=='pass_lower_letter'){
                                    $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                                }else if(response== 'pass_special_caracter'){
                                    $('#password_error').text('A password deve conter um número, letra maiúscula, letra minúscula e um caractere especial');
                                }else{
                                    $('#username_error').text(response);
                                }
                            }
                        }
                    });

            } 
               
           
        });
    </script>

