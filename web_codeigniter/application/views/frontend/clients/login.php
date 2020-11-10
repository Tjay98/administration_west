    <form id="login_form" method="POST" action="<?php echo base_url('clients/login'); ?>"> 
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">LOGIN</h3>
                <div class="form-signin">
                    <input type="email" id="inputEmail" name="inputEmail" class="form-control-custom" placeholder="Email" required autofocus>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" required>
                    
                    <button class="btn btn-lg btn-primary btn-block btn-signin mt-4" type="submit">Login</button>
                </div><!-- /form -->
                <p>Não tem conta? <a href="<?php echo base_url('clients/register'); ?>" class="forgot-password">Registo</a></p>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </form>

    <script>
        $('#login_form').on('submit',function(){
            event.preventDefault();
            email=$('#inputEmail').val();
            password=$('#inputPassword').val();
            flag=true;
            if(flag==true){
                formdata=$('#login_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/login'); ?>",
                    data: formdata,
                    success: function (response) {
                        alert(response);
                    }
                });
                /* $('#login_form').submit(); */
            }

        })
    </script> 