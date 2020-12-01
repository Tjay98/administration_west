
<form id="registo_form" method="POST" action="<?php echo base_url(''); ?>"> 
        <div class="container">
            <!-- IMPLEMENTAR UM NOVO FORMULÁRIO PARA EDITAR OS DADOS ABAIXO E COLOCAR NO FORM, FAZER TAMBÉM COM QUE TENHA VALIDAÇÕES-->
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <h3 class="text-center">Perfil</h3>
                <div class="form-signin">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputUsername">Nome</label> 
                            <label   class="form-control-custom" ><?php echo $user['username'];?></label>                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="inputEmail">Email</label> 
                            <label   class="form-control-custom" ><?php echo $user['email'];?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputNif">NIF</label> 
                            <label   class="form-control-custom"  ><?php echo $user['nif'];?></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="inputDate">Data de nascimento</label>
                            <label   class="form-control-custom" ><?php echo $user['birthday_date'];?></label>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top:20px;">
                            <button type="submit" class="btn btn-success" style="width:100%;">Editar</button>
                        </div>
                    </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top:20px;">
                            <button type="button"  onclick="open_edit_password()" class="btn btn-success" style="width:100%;">BOTAO TEMPORARIO QUE ABRE PARA MUDAR A PASSWORD</button>
                    </div>
            </div>
        </div><!-- /card-container -->
    </form>

                        
<!-- Modal -->
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="inputPassword">Password antiga</label> 
                        <input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control-custom" placeholder="Password antiga" tabindex="5" required>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" style="width:100%;">Editar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function open_edit_password(){
        $('#passwordModal').modal('show');
    }
</script>