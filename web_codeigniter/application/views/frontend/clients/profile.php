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
                    <!-- <form id="pasword_form" method="POST" action="<?php echo base_url('clients/password'); ?>">  -->
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
                            <button type="button" id="change_password_button" class="btn btn-warning" style="width:100%;">Alterar password</button>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
           
        </div>
    </div>
</div>


<script>
 
   
    function open_edit_password(){
        $('#passwordModal').modal('show');
    }
        
    $('#change_password_button').on('click', function (e) {
            e.preventDefault();
 
            old_password=$('#inputOldPassword').val();
            password_hash=$('#inputPassword').val();
            repeat_password=$('#inputRepetirPassword').val();
           
            $('#password_error').text('');
            $('#repeat_error').text('');
 
            flag=true;
 
            if(password_hash.length < 6 || password_hash.length > 25){
                flag=false;
                $('#password_error').text('A password não corresponde ao tamanho permitido (6 caractéres a 25)');

            }
            if(repeat_password!=password_hash){
                flag=false;
                $('#repeat_error').text('As passwords não correspondem'); 

            }
 
            if(flag==true){
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('clients/password'); ?>",
                    data: {'inputPassword':password_hash,'inputOldPassword':old_password},
                    success: function (response) {
                        /* alert(response); */
                        if(response=='success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Password mudada com sucesso',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                url="<?php echo base_url('clients/profile')?>"
                                window.location.href= url;
                            }, 2000);

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

    

    


</script>
