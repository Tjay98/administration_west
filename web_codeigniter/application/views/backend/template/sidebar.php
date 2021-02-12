<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url('admin') ?>" class="brand-link">
	<img src="<?php echo base_url('assets/images/logo_admin_white.png') ?>" alt="AdministrationWest-LOGO" class="brand-image" style="opacity: .8">
	<span class="brand-text font-weight-light"><!-- AdministrationWest -->&nbsp;</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png" class="img-circle elevation-2" alt="User Image">
				<!--Image credits to wikipedia-->
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?></a><a class="d-block" href="<?php echo base_url('admin/logout'); ?>">Sair <i class="fa fa-sign-out"></i></a>
			</div>
		</div>
		<!-- SidebarSearch Form -->
		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fa fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="#" class="nav-link">
          				<i class="fa fa-shopping-cart"></i>
						<p>
							Ponto de venda
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('admin/products'); ?>" class="nav-link">
                				<i class="fa fa-barcode"></i>
								<p>Produtos</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('admin/sales'); ?>" class="nav-link">
                			<i class="fa fa-money"></i>
								<p>Vendas</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('admin/categories'); ?>" class="nav-link">
                			<i class="fa fa-align-left"></i>
								<p> Categorias</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fa fa-users"></i>
						<p>
							Zona administrativa
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('admin/users'); ?>" class="nav-link">
								<i class="fa fa-user"></i>
								<p>Utilizadores</p>
							</a>
						</li>
						<?php if($this->session->userdata('role_id') == 3){?>
							<li class="nav-item">
								<a href="<?php echo base_url('admin/companies'); ?>" class="nav-link">
									<i class="fa fa-building-o"></i>
									<p>Empresas</p>
								</a>
							</li>
						<?php }else{?>
							<li class="nav-item">
								<a href="<?php echo base_url('admin/companies/edit/'.$this->session->userdata('store_id')); ?>" class="nav-link">
									<i class="fa fa-building-o"></i>
									<p>Empresas</p>
								</a>
							</li>
						<?php }?>
					</ul>
				</li>


			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


