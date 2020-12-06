<!DOCTYPE html>
<html lang="pt">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Log in</title>
		<!--CSS-->
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/adminlte.min.css'); ?>">
		<!--Font Awesome 4.7-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!--Scripts-->
		<!--Jquery-->
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<!-- overlayScrollbars -->
		<script src="<?php echo base_url('assets/js/OverlayScrollbars.min.js'); ?>"></script>
		<!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/js/adminlte.min.js'); ?>"></script>
    
  </head>
  
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="<?php echo base_url(''); ?>"><b>Administration West</b></a>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Entrar com as credenciais da empresa</p>
					<form action="<?php echo base_url('admin/login'); ?>" method="post" id="loginForm">
						<div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                            
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fa fa-envelope"></span>
								</div>
							</div>
                        </div>
                        <small class="text-danger" id="email_error"></small>
						<div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fa fa-lock"></span>
								</div>
							</div>
                        </div>
                        <small class="text-danger" id="password_error"></small>
						<div class="row">
							<!--           <div class="col-8">
								<div class="icheck-primary">
								  <input type="checkbox" id="remember">
								  <label for="remember">
								    Remember Me
								  </label>
								</div>
								</div> -->
							<!-- /.col -->
							<div class="col-12">
								<button type="submit" class="btn btn-primary btn-block" style="width:100%;">Login</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
					<p class="mb-1">
						<a href="#">Recuperar password</a>
					</p>
					<p class="mb-0">
						<a href="<?php echo base_url('') ?>" class="text-center">Efetuar pedido de registo</a>
					</p>
				</div>
				<!-- /.login-card-body -->
			</div>
		</div>
		<!-- /.login-box -->
	</body>
</html>
<script>
    $('#loginForm').submit(function(e){
        e.preventDefault();
        
        flag=true;
        email=$('#email').val();
        password=$('#password').val();

        if(email.length <=1){
            $('#email_error').text('Preencha o campo');
            flag=false;
        }

        if(password.length <=1){
            $('#password_error').text('Preencha o campo');
            flag=false;
        }
        if(flag==true){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/login') ?>",
                data: {'email':email,'password':password},
                success: function (response) {
                    alert(response);
                    if(response=='success'){
                        window.location.href="<?php echo base_url('admin/') ?>";
                    }else{
                        if(response=='error'){
                            $('#password_error').text('Dados incorretos');
                        }else if(response=='banned'){
                            $('#password_error').text('Não tem permissão de acesso');
                        }else if(response=='role invalid'){
                            $('#password_error').text('Não tem permissão de acesso');
                        }
                    }
                }
            });
        }
    })
</script>