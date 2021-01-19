<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:100px; margin-bottom:100px" >
    <div class="card box-body  dataTables_wrapper dt-bootstrap4 no-footer">
        <?php if(!empty($sales)){ ?>
            <center><h3>Pedidos</h3></center>
            <div class="table-responsive">
            <table class="table   table-bordered table-hover dataTable no-footer" 
            style="width:100%;" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Envio</th>
                        <th>NIF</th>
                        <th>Data da compra</th>
                        <th>Número de telemóvel</th>
                        <th>Estado</th>
                        <th>Preço total</th>
                        <th>Iva total</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sales as $sale){?>
                        <tr>
                            <td><?php echo $sale['id'] ?></td>
                            <td><?php echo $sale['shipping_name'] ?></td>
                            <td><?php echo $sale['shipping_nif'] ?></td>
                            <td><?php echo strftime('%d de %B de %Y', strtotime($sale['created_date'])); ?></td>
                            <td><?php echo $sale['shipping_contact']; ?></td>
                            <td>
                                <?php if($sale['status']==0){
                                    echo "Em processamento";
                                }elseif($sale['status']==1){
                                    echo "Enviado";
                                }elseif($sale['status']==2){
                                    echo "Cancelado";
                                }?>
                            </td>
                            <td><?php echo $sale['total_price']."€"; ?></td>
                            <td><?php echo $sale['total_iva']."€"; ?></td>
                            <td><a class="btn btn-info btn-sm" style="border-radius:8px;" href="<?php echo base_url('sales/history/').$sale['id']; ?>">Ver detalhes</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{?>
            <h3 style="text-align:center;">Ainda não tem vendas.</h3>
            <h4 style="text-align:center;">Visite a nossa página de <a href="<?php echo base_url('products/') ?>">produtos</a></h4>
        <?php }?>
    </div>
    </div>
</div>
</div>


