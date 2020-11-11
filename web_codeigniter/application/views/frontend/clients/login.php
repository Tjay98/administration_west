    <form id="login_form" method="POST" action="<?php echo base_url('clients/login'); ?>"> 
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">LOGIN</h3>
                <div class="form-signin">
                    <label for="inputEmail">Email</label>
                    <input type="email" id="inputEmail" name="inputEmail" class="form-control-custom" placeholder="Email" required autofocus>
                    <small class="text-danger" id="email_error"></small>

                    <label for="inputPassword">Password</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" required>
                    <small class="text-danger" id="password_error"><?Php echo $this->session->flashdata('error'); ?></small>
                    
                    <button class="btn btn-lg btn-primary btn-block btn-signin mt-4" type="submit">Login</button>
                </div><!-- /form -->
                <p>Não tem conta? <a href="<?php echo base_url('clients/register'); ?>" class="forgot-password">Registo</a></p>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </form>

    <script>
        $('#login_form').on('submit',function(){
            event.preventDefault();

            //set values from inputs
            email=$('#inputEmail').val();
            password=$('#inputPassword').val();

            //clear errors
            $('#email_error').text('');
            $('#password_error').text('');
            
            flag=true;

            if(email.length < 1 || email.length > 255){
                flag=false;
                $('#email_error').text('O email não corresponde ao tamanho permitido (6 caractéres a 25)');
            }

            if(password.length < 6 || password.length > 25){
                flag=false;
                $('#password_error').text('A password não corresponde ao tamanho permitido (6 caractéres a 25)');
            }

            if(flag==true){
                formdata=$('#login_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/login'); ?>",
                    data: formdata,
                    success: function (response) {
                        if(response=='success'){
                            location.href="<?php echo base_url(''); ?>"
                        }else{
                            if(response=='error'){
                                $('#password_error').text('Verifique se as credenciais que escreveu estão corretas');
                            }else if(response=='banned'){
                                $('#password_error').text('A sua conta foi desabilitada, contacte-nos caso acha que tenha sido um erro');
                            }
                        }
                    }
                });
                
            }

        })
    </script> 