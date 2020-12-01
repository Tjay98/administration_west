<form id="registo_form" method="POST" action="<?php echo base_url('clients/register'); ?>"> 
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">Perfil</h3>
                <div class="form-signin">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputUsername">Nome</label> 
                            <label   class="form-control-custom" ><?php echo $this->session->userdata('username');?></label>                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputEmail">Email</label> 
                            <label   class="form-control-custom" ><?php echo  $this->session->userdata('email'); ?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputNif">NIF</label> 
                            <label   class="form-control-custom"  ><?php echo   $this->session->userdata('nif')?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputDate">Data de nascimento</label>
                            <label   class="form-control-custom" ><?php echo  $this->session->userdata('birthday_date')?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputPassword">Password</label> 
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control-custom" placeholder="Password" tabindex="5" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputRepetirPassword">Repetir a password</label> 
                            <input type="password" id="inputRepetirPassword" class="form-control-custom" placeholder="Repetir Password" tabindex="6" required>
                        </div>
                    </div> 
            </div>
        </div><!-- /card-container -->
    </form>

