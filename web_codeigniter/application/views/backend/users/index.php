<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>

			</div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <?php if($this->session->userdata('role_id')==3){ ?>
                        <div class="dropleft ">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cogs"></i>
                            </button>
                            
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" onclick="create_user()"><i class="fa fa-plus"></i> Criar utilizador para empresa</a>
                                <a class="dropdown-item"  id="export_pdf_button" href="#"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
                                <a class="dropdown-item" id="export_excel_button" href="#"><i class="fa fa-file-excel-o"></i> Exportar Excel da tabela</a>
                            </div>
                        </div>
                    </div>  
                    <?php }?>
            </div>
            <?php if($this->session->userdata('role_id')==3){
                $admin=true;
             }else{
                $admin=false;
             }?>

		</div>

        
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">

                <div class="info-box status_button" onclick="change_table_status('')">
					<span class="info-box-icon bg-primary elevation-1"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total</span>
						<span class="info-box-number"><?php if(!empty($count_total)){echo $count_total;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <div class="info-box status_button" onclick="change_table_status('Utilizador')" id="status_button_pending">
					<span class="info-box-icon bg-info elevation-1"><i class="fa fa-user"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Utilizadores</span>
						<span class="info-box-number"><?php if(!empty($count_users)){echo $count_users;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            <?php if($this->session->userdata('role_id') == 3){?>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <div class="info-box status_button" onclick="change_table_status('Empresa')">
					<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-building-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Gestores de empresas</span>
						<span class="info-box-number"><?php if(!empty($count_companies)){echo $count_companies;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6">

                <div class="info-box status_button" onclick="change_table_status('Admin')">
					<span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-secret"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Admins</span>
						<span class="info-box-number"><?php if(!empty($count_admins)){echo $count_admins;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            <?php }?>
        </div>
		<!-- Info boxes -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="info-box">
                    <div class="box-body table-responsive" >
                        <table class="table table-striped table-bordered table-hover" id="table-users" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telemóvel</th>
<!--                                     <th>Data de nascimento</th> -->
                                    <th>Cargo</th>
                                    <th>Loja</th>
                                    <th>Data criado</th>
                                    <th>&nbsp;</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal user -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalLabel">Criar utilizador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Nome do utilizador</label>
                            <input type="text" class="form-control" id="username" placeholder="Nome do utilizador" <?php if(!$admin){echo 'disabled';} ?>>
                            <small class="text-danger form_error" id="username_error"></small>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" <?php if(!$admin){echo 'disabled';} ?>>
                            <small class="text-danger form_error" id="email_error"></small>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nº de telemóvel</label>
                            <input type="number" class="form-control" id="phone_number" placeholder="Nº de telemóvel" <?php if(!$admin){echo 'disabled';} ?>>
                            <small class="text-danger form_error" id="phone_number_error"></small>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Data de nascimento</label>
                            <input type="date" id="birthday" class="form-control" placeholder="Data de nascimento" <?php if(!$admin){echo 'disabled';} ?>>
                            <small class="text-danger form_error" id="birthday_error"></small>

                        </div>
                    </div>
                    <?php if($admin){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Cargo</label>
                            <select class="form-control" id="role_id" <?php if(!$admin){echo 'disabled';} ?>>
                                <option value="">Selecione uma opção</option>
                                <?php foreach($roles as $role){?>
                                    <option value="<?php echo $role['id'] ?>"><?php echo $role['name']; ?></option>
                                <?php } ?>
                            </select>
                            <small class="text-danger form_error" id="role_id_error"></small>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Loja</label>
                            <select class="form-control"  id="store_id" <?php if(!$admin){echo 'disabled';} ?>>
                                <option value="">Nenhuma</option>
                                <?php foreach($companies as $company){?>
                                    <option value="<?php echo $company['id'] ?>"><?php echo $company['company_name']; ?></option>
                                <?php } ?>
                            </select>
                            <small class="text-danger form_error" id="store_id_error"></small>

                        </div>
                    </div> 
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                            <small class="text-danger form_error" id="password_error"></small>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Repetir password</label>
                            <input type="password" class="form-control" id="repeat_password" placeholder="Repetir password">
                            <small class="text-danger form_error" id="repeat_password_error"></small>

                        </div>
                    </div>
                    <?php }?>


                    
                </div>
            </div>
            <?php if($admin){ ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" style="width:100%;" id="create_user_button">Criar</button>
            </div>
            <?php }?>
        </div>
    </div>
</div>


<script type="text/javascript">
    var table

    $(document).ready(function() {  

        //datatable
       table=$('#table-users').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/users/user_table') ?>",
                type : 'POST',
            },
            stateSave: false,
            "order": [[0,"desc"]],
            responsive: false,
            "autoWidth": false,
            //plugins

            fixedHeader: true,
            select: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', text: 'Exportar excel',title:'Utilizadores_<?php echo date('Y-m-d');?>'},
                { extend: 'pdf', text: 'Exportar pdf' ,title:'Utilizadores_<?php echo date('Y-m-d');?>'},

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ resultados por página",
                "zeroRecords": "Não há dados",
                "info": "A mostrar _TOTAL_ resultados",
                "infoEmpty": "Não há dados",
                "loadingRecords": "A carregar...",
                "infoFiltered": "(_MAX_ no total)",
                "search":"Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior",
                },

            },
            "pageLength": 25,

        });

        $('#export_pdf_button').on('click',function(){
            $('#pdfButton').click();
        })
        $('#export_excel_button').on('click',function(){
            $('#excelButton').click();
        })
    });

    function change_table_status(status){
        table
            .column(4)
            .search(status)
            .draw()
    }
    
    function create_user(){
        $('#create_user_button').attr('onclick','submit_create_user()');
        $('#create_user_button').text('Criar');
        $('#userModalLabel').html('Criar utilizador');
        $('#userModal').modal('show');
    }

    function submit_create_user(){
        clear_errors();
        var validation=true;
        
        username=$('#username').val();
        email=$('#email').val();
        phone_number=$('#phone_number').val();
        birthday=$('#birthday').val();
        role_id=$('#role_id').val();
        store_id=$('#store_id').val();
        password=$('#password').val();
        repeat_password=$('#repeat_password').val();

        if(username.length <= 0 || username.length > 255){
            $('#username_error').text('Preencha o campo');
            validation=false;
        }

        if(email.length <= 0 || email.length > 255){
            $('#email_error').text('Preencha o campo');
            validation=false;
        }
        if(phone_number.length !=9){
            $('#phone_number_error').text('Preencha o campo (9 digitos)');
            validation=false;
        }
        if(birthday.length <= 0 ){
            $('#birthday_error').text('Preencha o campo');
            validation=false;
        }
        if(role_id.length <= 0 ){
            $('#role_id_error').text('Selecione uma opção');
            validation=false;
        }
/*         if(store_id.length <= 0 ){
            $('#username_error').text('Preencha o campo');
            validation=false;
        } */

        if(password.length < 8 || password.length > 25){
            $('#password_error').text('Preencha o campo (8 a 25 digitos)');
            validation=false;
        }

        if(repeat_password != password){
            $('#repeat_password_error').text('O campo de password não coincide');
            validation=false;
        }

        if(validation){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/users/add') ?>",
                data: {
                        'username':username,
                        'email':email,
                        'phone_number':phone_number,
                        'birthday_date':birthday,
                        'password':password,
                        'store_id':store_id,
                        'role_id':role_id,
                    },
                success: function (response) {
                    
                    if(response == 'success'){ 
                        alert('Sucesso');
                        $('#userModal').modal('hide');
                        table.ajax.reload();
                    }else if(response=='email_error'){
                        $('#email_error').text('Já existe um email igual registado');
                    }else if(response=='phone_error'){
                        $('#phone_number_error').text('Já existe um nº de telemóvel igual registado');
                    }else{
                        alert(response);
                    }
                }
            });
        }
    }

    function edit_user(user_id){
        
        clear_errors();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/users/edit/'); ?>"+user_id,
            data: '',
            success: function (response) {
                /* alert(response); */
                var user_obj=JSON.parse(response);
                if(user_obj){
                    //definir variaveis atraves do json
                    username=user_obj.username;
                    email=user_obj.email;
                    phone_number=user_obj.phone_number;
                    birthday_date=user_obj.birthday_date;
                    role_id=user_obj.role_id;
                    store_id=user_obj.store_id;
                    status=user_obj.status;

/*                     birthday_date= new Date(birthday_date);
                    var day = ("0" + birthday_date.getDate()).slice(-2);
                    var month = ("0" + (birthday_date.getMonth() + 1)).slice(-2);
                    var date = birthday_date.getFullYear()+"-"+(month)+"-"+(day) ; */
                    <?php if($admin){ ?>
                        message_title='Editar utilizador - '+username;
                    <?php }else{?>
                        message_title='Visualizar utilizador - '+username;
                    <?php }?>
                    $('#username').val(username);
                    $('#email').val(email);
                    $('#phone_number').val(phone_number);
                    $('#birthday').val(birthday_date);
                    $('#role_id').val(role_id);
                    $('#store_id').val(store_id);
                    
                    if(role_id==3){
                        $('#create_user_button').hide();
                    }else{
                        $('#create_user_button').attr('onclick','submit_edit_user('+user_id+')');
                        $('#create_user_button').text('Editar');
                        $('#create_user_button').show();
                    }
                    
                    $('#userModalLabel').html(message_title);
                    
                    $('#userModal').modal('show');
                }
                

                
            }
        });
    }

    function submit_edit_user(user_id){
        clear_errors();
        var validation=true;
        
        username=$('#username').val();
        email=$('#email').val();
        phone_number=$('#phone_number').val();
        birthday=$('#birthday').val();
        role_id=$('#role_id').val();
        store_id=$('#store_id').val();
        password=$('#password').val();
        repeat_password=$('#repeat_password').val();

        if(username.length <= 0 || username.length > 255){
            $('#username_error').text('Preencha o campo');
            validation=false;
        }

        if(email.length <= 0 || email.length > 255){
            $('#email_error').text('Preencha o campo');
            validation=false;
        }
        if(phone_number.length !=9){
            $('#phone_number_error').text('Preencha o campo (9 digitos)');
            validation=false;
        }
        if(birthday.length <= 0 ){
            $('#birthday_error').text('Preencha o campo');
            validation=false;
        }
        if(role_id.length <= 0 ){
            $('#role_id_error').text('Selecione uma opção');
            validation=false;
        }
/*         if(store_id.length <= 0 ){
            $('#username_error').text('Preencha o campo');
            validation=false;
        } */

/*         if(password.length < 8 || password.length > 25){
            $('#password_error').text('Preencha o campo (8 a 25 digitos)');
            validation=false;
        } */

        if(repeat_password != password){
            $('#repeat_password_error').text('O campo de password não coincide');
            validation=false;
        }

        if(validation){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/users/edit/'); ?>"+user_id,
                data: {
                        'username':username,
                        'email':email,
                        'phone_number':phone_number,
                        'birthday_date':birthday,
                        'password':password,
                        'store_id':store_id,
                        'role_id':role_id,
                    },
                success: function (response) {
                    if(response == 'success'){ 
                        alert('Sucesso');
                        $('#userModal').modal('hide');
                        table.ajax.reload();
                    }else if(response=='email_error'){
                        $('#email_error').text('Já existe um email igual registado');
                    }else if(response=='phone_error'){
                        $('#phone_number_error').text('Já existe um nº de telemóvel igual registado');
                    }else{
                        alert(response);
                    }
                }
            });
        }
    }

    function suspend_user(user_id){
        confirmation=confirm('Deseja suspender o utilizador?');
        if(confirmation){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/users/delete/'); ?>"+user_id,
                data: '',
                success: function (response) {
                    if(response=='success'){

                        $('#userModal').modal('hide');
                        table.ajax.reload();
                    }else{
                        alert('Ocorreu algum erro ou não tem permissão');
                    }
                    
                }
            });
        }
    }

    function clear_errors(){
        $('.form_error').text('');
    }

    $('#userModal').on('hidden.bs.modal', function () {

        $('#username').val('');
        $('#email').val('');
        $('#phone_number').val('');
        $('#birthday').val('');
        $('#role_id').val('');
        $('#store_id').val('');
        clear_errors();

    })
    
</script>