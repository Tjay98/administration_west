<style>
    .accordion_open_hand{
        cursor: pointer;
    }
</style>

<div class="container" style="margin-top:100px; margin-bottom:100px">
	<div class="card">
        
		<h3><u>Detalhes da compra #<?php echo $sale['id']; ?></u> <small class="pull-right"><?php echo strftime('%d de %B de %Y', strtotime($sale['created_date'])); ?></small></h3>
		<div id="accordion_1">
			<div class="card">
				<div class="accordion_open_hand" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   <h5 style="font-weight:bold;">Dados de envio </h5>
				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_1">
					<div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <p><b>Nome:</b> <?php echo $sale['shipping_name']; ?></p>
                                <p><b>Contacto:</b> <?php echo $sale['shipping_nif']; ?></p>
                                <p><b>Nif:</b> <?php echo $sale['shipping_contact']; ?></p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <p><b>Morada:</b> <?php echo $sale['shipping_address']; ?></p>
                                <p><b>Cidade:</b> <?php echo $sale['shipping_city']; ?></p>
                                <p><b>Código postal:</b> <?php echo $sale['shipping_zip']; ?></p>
                            </div>

                        </div>

					</div>
				</div>
			</div>
        </div>

        <div id="accordion_2">
			<div class="card">
				<div class="accordion_open_hand" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <h5 style="font-weight:bold;">Dados de faturação </h5>
				</div>
				<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion_2">
					<div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <p><b>Nome:</b> <?php echo $sale['billing_name']; ?></p>
                                <p><b>Contacto:</b> <?php echo $sale['billing_nif']; ?></p>
                                <p><b>Nif:</b> <?php echo $sale['billing_contact']; ?></p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <p><b>Morada:</b> <?php echo $sale['billing_address']; ?></p>
                                <p><b>Cidade:</b> <?php echo $sale['billing_city']; ?></p>
                                <p><b>Código postal:</b> <?php echo $sale['billing_zip']; ?></p>
                            </div>
                        </div>
					</div>
				</div>
			</div>
        </div>

        <div id="accordion_3">
			<div class="card">
				<div class="accordion_open_hand" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <h5 style="font-weight:bold;">Produtos (<?php echo count($sale['sale_products']); ?>)</h5>
				</div>
				<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion_3">
					<div class="card-body table-responsive text-center">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço (IVA incluído)</th>
                                    <th>Valor do iva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sale['sale_products'] as $product){?>
                                    <tr>
                                        <td><?php echo $product['id']; ?></td>
                                        <td><a href="<?php echo base_url('products/').$product['id']; ?>" target="_blank" class="btn btn-info btn-sm" style="width:100%;"><?php echo $product['product_name']; ?></a></td>
                                        <td><?php echo $product['quantity']; ?></td>
                                        <td><?php echo $product['price']."€"; ?></td>
                                        <td><?php echo $product['price_iva']."€"; ?></td>
                                    </tr>
                                <?php } ?>

                                    <tr>
                                        <td colspan="3" ><b>Total</b></td>
                                        <td><?php echo $sale['total_price']."€"; ?></td>
                                        <td><?php echo $sale['total_iva']."€"; ?></td>
                                    </tr>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>