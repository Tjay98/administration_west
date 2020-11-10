    <form id="registo_form" method="POST" action="<?php echo base_url('clients/register'); ?>"> 
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">REGISTO</h3>
                <div class="form-signin">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="text" id="inputUsername" name="inputUsername" class="form-control-custom" placeholder="Nome de utilizador" tabindex="1" required autofocus>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="email" id="inputEmail" name="inputEmail" class="form-control-custom" placeholder="Email" tabindex="2" required autofocus>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="nif">NIF</label> 
                            <input type="text" id="inputNif" name="inputNif" class="form-control-custom"  placeholder="NIF" tabindex="3" required autofocus>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="date">Data de nascimento</label>
                            <input type="date" id="inputDate" name="inputDate" class="form-control-custom" placeholder="Data de nascimento" tabindex="4" required autofocus>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" tabindex="5" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <input type="password" id="inputRepetirPassword" class="form-control-custom" placeholder="Repetir Password" tabindex="6" required>
                        </div>
                    </div> 
                <button class="btn btn-lg btn-primary btn-block btn-signin mt-4" type="submit" tabindex="7">Registo</button>
            </div>
            <p>Já tem uma conta? <a href="<?php echo base_url('clients/login'); ?>" class="forgot-password">Faça Login</a></p>
        </div><!-- /card-container -->
    </form>

    <script>
    $('#registo_form').on('submit', function () {
        if($('#inputPassword').val() != $('#inputRepetirPassword').val()){
            alert('Senhas diferentes');
            return false;
        } 
        else{
            if($('#inputPassword').val().length()>8 or $('#inputPassword').val().length()<25){
            alert('Senhas boa');
            return true;
        }else {
            alert('senha ma');
            return false;
        }
        }

       if($('#inputNif').val().length()==9){
            alert('NIf ok');
            return true;
        } else{
            alert('mau');
            return false;
        }  
    });

    </script>

    <script>
       /* $('#registo_form').on('submit',function(){
            event.preventDefault();
            username=$('#inputUsername').val();
            email=$('#inputEmail').val();
            nif=$('#inputNif').val();
            data=$('#inputDate').val();
            password=$('#inputPassword').val();
            flag=true;
            if(flag==true){
                formdata=$('#registo_form').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/register'); ?>",
                    data: formdata,
                    success: function (response) {
                        alert(response);
                    }
                });
            }

        })*/
    </script> 
