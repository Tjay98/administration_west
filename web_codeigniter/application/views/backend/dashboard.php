<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<?php 

//count variables
$company_count=count($companies);
$products_count=count($all_products);
$sales_count=count($products_sold);

$sales=array_slice($all_sales, 0, 5);

$products=array_slice($all_products, 0, 5);
/* 
print_r($sales); */

?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<a href="<?php echo base_url('admin/companies'); ?>">
					<div class="info-box">
						<span class="info-box-icon bg-info elevation-1"><i class="fa fa-building-o"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Empresas</span>
							<span class="info-box-number"><?php if(!empty($company_count)){echo $company_count;}else{echo 0;}  ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<a href="<?php echo base_url('admin/products'); ?>">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-product-hunt"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Produtos</span>
							<span class="info-box-number"><?php if(!empty($products_count)){ echo $products_count; }else{ echo 0;} ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<!-- fix for small devices only -->
			<div class="clearfix hidden-md-up"></div>
			<div class="col-12 col-sm-6 col-md-3">
				<a href="<?php echo base_url('admin/sales'); ?>">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Vendas</span>
							<span class="info-box-number"><?php if(!empty($sales_count)){ echo $sales_count;}else{echo 0;} ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<a href="<?php echo base_url('/admin/users'); ?>">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Clientes</span>
							<span class="info-box-number"><?php if(!empty($client_count)){ echo $client_count;}else{echo 0;} ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
				</a>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<div class="col-md-8">
				<?php /* print_r($sales); */ ?>
				<!-- TABLE: LATEST ORDERS -->
				<div class="card">
					<div class="card-header border-transparent">
						<h3 class="card-title">Últimos pedidos</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table m-0">
								<thead>
									<tr>
										<th>ID</th>
										<!-- <th>Produto</th>
										<th>Cliente</th>
										<th>Quantidade</th> -->
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($sales as $sale){ 

										if(empty($sale['sale_group_id'])){
											$sale['sale_group_id']=$sale['id'];
										}

										if($sale['status']==0){
											$status='<button type="button" class="btn btn-md btn-warning">Por processar</button>';
										}elseif($sale['status']==1){
											$status='<button type="button" class="btn btn-md btn-warning" style="background-color:#fd7e14;border-color:#fd7e14;">Processado</button>';
										}elseif($sale['status']==2){
											$status='<button type="button" class="btn btn-md btn-success">Enviado</button>';
										}elseif($sale['status']==3){
											$status='<button type="button" class="btn btn-md btn-danger">Cancelado</button>';
										}?>
										
									<tr>
										<td><a class="btn btn-md btn-info" href="<?php echo base_url('admin/sales/?sale_id=').$sale['sale_group_id']; ?>">Venda #<?php echo $sale['sale_group_id']; ?></a></td>
										<!-- <td><?php echo $sale['product_name']; ?></td>

										<th><?php echo $sale['quantity']; ?></th> -->
										<td><?php echo $status; ?></td>
									</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<a href="<?php echo base_url('admin/sales/add'); ?>" class="btn btn-sm btn-info float-left">Criar nova venda</a>
						<a href="<?php echo base_url('admin/sales/'); ?>" class="btn btn-sm btn-secondary float-right">Ver todas as vendas</a>
					</div>
					<!-- /.card-footer -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
			<div class="col-md-4">

				<!-- PRODUCT LIST -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Últimos produtos adicionados</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<ul class="products-list product-list-in-card pl-2 pr-2">
							<?php if(!empty($products)){ 
									foreach($products as $product){?>
									<li class="item">
										<div class="product-img">
											<img src="<?php echo base_url('uploads/products/'.$product['image']); ?>" alt="Product Image" class="img-size-50">
										</div>
										<div class="product-info">
											<p class="product-title"><?php echo $product['product_name']; ?>
											<span class="badge badge-warning float-right"><?php echo $product['price']."€"; ?></span></p>
											<span class="product-description">
											<?php echo $product['small_description']; ?>
											</span>
										</div>
									</li>
							<?php }
								}?>
							<!-- /.item -->
<!-- 							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Bicycle
									<span class="badge badge-info float-right">$700</span></a>
									<span class="product-description">
									26" Mongoose Dolomite Men's 7-speed, Navy Blue.
									</span>
								</div>
							</li> -->
							<!-- /.item -->
						</ul>
					</div>
					<!-- /.card-body -->
					<div class="card-footer text-center">
						<a href="<?php echo base_url('admin/products/'); ?>" class="uppercase">Ver todos os produtos</a>
					</div>
					<!-- /.card-footer -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!--/. container-fluid -->
</section>
<!-- /.content -->