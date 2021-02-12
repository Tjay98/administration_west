<div class="container " style="margin-top:100px; margin-bottom:100px;">
    <h2 class="text-center">Contactos</h2>
    <p style="text-align:center;">Caso tenha alguma dúvida, problema, ou seja uma empresa que deseja utilizar o nosso serviço contacte-nos através dos métodos abaixo. </p>
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="form-responsive" >
                <form id="form-contact" action="<?php echo base_url('create_contact'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="contact[name]" id="name" class="form-control" placeholder="Nome">
                        <small class="text-danger" id="name_error"></small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="contact[email]" id="email" class="form-control" placeholder="Email">
                        <small class="text-danger" id="email_error"></small>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control mt-1" name="contact[type]" id="type">
                            <option value="">Selecione o tipo de contacto</option>
                            <option value="1">Utilizador</option>
                            <option value="2">Empresa</option>
                        </select>
                        <small class="text-danger" id="type_error"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="contact[subject]" id="subject" class="form-control mt-1" placeholder="Assunto">
                        <small class="text-danger" id="subject_error"></small>
                    </div>
                    <div class="form-group">
                        <textarea name="contact[message]" id="message" rows="5" class="form-control mt-1" placeholder="Mensagem"></textarea>
                        <small class="text-danger" id="message_error"></small>
                    </div>
                    
                    
                    <button class=" btn btn-primary" style="width:100%;" type="submit">Enviar mensagem</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="jumbotron" style="padding:10px">
                <div class="row">
                    <div class="col-lg-12">
                        <center><h4 style="font-weight:bold;">Outras formas de contacto</h4></center>
                        <hr>
                    </div>
                    <div class="col-lg-4" style="text-align:center;">
                        <h4>Localização</h4>
                        <p>Avenida 5 de outubro 2560-270 Torres Vedras</p>
                    </div>
                    <div class="col-lg-4" style="text-align:center;">
                        <h4>Telefone</h4>
                        <p>912 345 678</p>
                    </div>
                    <div class="col-lg-4" style="text-align:center;">
                        <h4>Email</h4>
                        <p>administration_west@gmail.com</p>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

</div>
<script>
    $('#form-contact').on('submit',function(){
        event.preventDefault();
        var flag=true;
        clear_errors();

        name=$('#name').val();
        email=$('#email').val();
        type=$('#type').val();
        subject=$('#subject').val();
        message=$('#message').val();

        if(name.length >255 || name.length < 2){
            flag=false;
            $('#name_error').text('Preencha o campo');
        }

        if(email.length >255 || email.length < 2){
            flag=false;
            $('#email_error').text('Preencha o campo');
        }

        if(type.length < 1){
            flag=false;
            $('#type_error').text('Selecione uma opção');
        }

        if(subject.length >255 || subject.length < 2){
            flag=false;
            $('#subject_error').text('Preencha o campo');
        }

        if(message.length < 2){
            flag=false;
            $('#message_error').text('Preencha o campo');
        }

        if(flag){
            /* this.submit(); */
            formdata=$('#form-contact').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('create_contact'); ?>",
                data: formdata,
                success: function (response) {
                    /* alert(response); */
                    Swal.fire({
                        icon: 'success',
                        title: 'Contacto submetido com sucesso',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    setTimeout(function() {
                        url="<?php echo base_url('')?>"
                        window.location.href= url;
                    }, 2000);
                }
            });
        }

    })

    function clear_errors(){
        $('#name_error').text('');
        $('#email_error').text('');
        $('#type_error').text('');
        $('#subject_error').text('');
        $('#message_error').text('');
    }
</script>