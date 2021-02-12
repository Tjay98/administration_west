<?php 
    if($this->session->userdata('role_id')==3){
        $admin=true;
    }else{
        $admin=false;
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>

			</div>
            <div class="col-sm-6">
                <div class="pull-right">
                        <div class="dropleft ">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cogs"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo base_url('admin/sales/add') ?>"><i class="fa fa-plus"></i> Criar venda</a>
                                <a class="dropdown-item"  id="export_pdf_button" href="#"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
                                <a class="dropdown-item" id="export_excel_button" href="#"><i class="fa fa-file-excel-o"></i> Exportar Excel da tabela</a>
                            </div>
                        </div>
                    </div>  
            </div>


		</div>

        
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4">

                <div class="info-box status_button" onclick="change_table_status('')">
					<span class="info-box-icon bg-primary elevation-1"><i class="fa fa-shopping-cart"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total</span>
						<span class="info-box-number"><?php if(!empty($count_total)){echo $count_total;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-4">

                <div class="info-box status_button" onclick="change_table_status('Por processar')" id="status_button_pending">
					<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-hourglass-start"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Por processar</span>
						<span class="info-box-number"><?php if(!empty($count_processing)){echo $count_processing;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">

                <div class="info-box status_button" onclick="change_table_status('Processada')">
					<span class="info-box-icon elevation-1" style="background-color:#fd7e14;border-color:#fd7e14;"><i class="fa fa-hourglass-end"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Processadas</span>
						<span class="info-box-number"><?php if(!empty($count_processed)){echo $count_processed;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-4">

                <div class="info-box status_button" onclick="change_table_status('Enviada')">
					<span class="info-box-icon bg-success elevation-1"><i class="fa fa-paper-plane-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Enviadas</span>
						<span class="info-box-number"><?php if(!empty($count_sent)){echo $count_sent;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">

                <div class="info-box status_button" onclick="change_table_status('Cancelada')">
					<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-times"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Canceladas</span>
						<span class="info-box-number"><?php if(!empty($count_canceled)){echo $count_canceled;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
        </div>
		<!-- Info boxes -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="info-box">
                    
                    <div class="box-body table-responsive" >
                        <table class="table table-striped table-bordered table-hover" id="table-sales" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Morada</th>
                                    <th>Quantidade de produtos</th>
                                    <th>Método de pagamento</th>
                                    <th>Total</th>
                                    <th>Data pedido</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
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


<!-- Modal address -->
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="shippingModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4>Morada de envio</h4>
                        <div class="form-group">
                            <label>Nome do utilizador</label>
                            <input type="text" class="form-control" id="shipping_address_name" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>NIF</label>
                            <input type="text" class="form-control" id="shipping_address_nif" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nº de telemóvel</label>
                            <input type="text" class="form-control" id="shipping_address_contact_number" disabled>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" class="form-control" id="shipping_address_city" disabled>
                        </div>
                    </div>  
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Código postal</label>
                            <input type="text" class="form-control" id="shipping_address_zip_code" disabled>
                        </div>
                    </div>    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Morada</label>
                            <input type="text" class="form-control" id="shipping_address_address" disabled>
                        </div>
                    </div>                 
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4>Morada de faturação</h4>
                        <div class="form-group">
                            <label>Nome do utilizador</label>
                            <input type="text" class="form-control" id="billing_address_name" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>NIF</label>
                            <input type="text" class="form-control" id="billing_address_nif" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nº de telemóvel</label>
                            <input type="text" class="form-control" id="billing_address_contact_number" disabled>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" class="form-control" id="billing_address_city" disabled>
                        </div>
                    </div>  
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Código postal</label>
                            <input type="text" class="form-control" id="billing_address_zip_code" disabled>
                        </div>
                    </div>    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Morada</label>
                            <input type="text" class="form-control" id="billing_address_address" disabled>
                        </div>
                    </div>    
                  
                </div>
                
            </div>
            <div class="modal-footer" style="border-color:transparent;">
            </div>
        </div>
    </div>
</div>

<!-- Modal Status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="input_hidden_product_id">
                <h5 class="modal-title" id="statusModalLabel"></h5>
                &nbsp;
                <button class="btn btn-sm btn-warning" id="delivery_button_modal" onclick="update_sent_status()" style="display:none;">Definir como enviado</button>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <form id="form_product_status" action="<?php echo base_url('admin/sales/edit/') ?>" method="post" enctype="multipart/form-data">
                <table class="table table-striped table-bordered table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Nome do produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>IVA</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="product_status">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" >
                <button class="btn btn-info" id="update_status_button" type="submit" style="width:100%;">Atualizar estado</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    $(document).ready(function() {  

        //datatable
        table=$('#table-sales').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/sales/sales_table') ?>",
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
                { extend: 'excel', text: 'Exportar excel', title:'Vendas_<?php echo date('Y-m-d');?>', attr: { id: 'excelButton'} },
                { extend: 'pdf', text: 'Exportar pdf', title:'Vendas_<?php echo date('Y-m-d');?>', attr: { id: 'pdfButton'} },
                
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
            "pageLength": 20,

        });

        $('#export_pdf_button').on('click',function(){
            $('#pdfButton').click();
        })
        $('#export_excel_button').on('click',function(){
            $('#excelButton').click();
        })


        $('#form_product_status').on('submit',function(){
            event.preventDefault();
            sale_id=$('#input_hidden_product_id').val();
            form = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/sales/edit/'); ?>"+sale_id,
                data: form,
                success: function (response) {
                    alert(response);
                }
            });
        })
       
    });

    function change_table_status(status){
        table
            .column(7)
            .search(status)
            .draw()
    }

    function show_address(sale_id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/sales/client_address') ?>",
            data: {'sale_id':sale_id},
            success: function (response) {
                if(response){
                    obj=JSON.parse(response);

                    if(obj){
                        if(obj.shipping_address){
                            shipping_address=obj.shipping_address;
                            $('#shipping_address_name').val(shipping_address.name);
                            $('#shipping_address_nif').val(shipping_address.nif);
                            $('#shipping_address_contact_number').val(shipping_address.contact_number);
                            $('#shipping_address_city').val(shipping_address.city);
                            $('#shipping_address_address').val(shipping_address.address);
                            $('#shipping_address_zip_code').val(shipping_address.zip_code);

                        }
                        if(obj.billing_address){
                            
                            billing_address=obj.billing_address;
                            $('#billing_address_name').val(billing_address.name);
                            $('#billing_address_nif').val(billing_address.nif);
                            $('#billing_address_contact_number').val(billing_address.contact_number);
                            $('#billing_address_city').val(billing_address.city);
                            $('#billing_address_address').val(billing_address.address);
                            $('#billing_address_zip_code').val(billing_address.zip_code);
                        }
                        
                    }

                    $('#shippingModalLabel').text('Moradas da venda #'+sale_id);
                    $('#shippingModal').modal('show');
                }

                
            }
        });
      
    }

    function show_status(sale_id,status){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/sales/edit/'); ?>"+sale_id,
            data: {'sale_id':sale_id},
            success: function (response) {
                /* alert(response); */
                if(response){
                    obj=JSON.parse(response);
                   
                    if(obj){
                        html='';
                        i=0;
                        obj.forEach(function(product) {
                            html+='<tr>';
                            html+='<td><input type="hidden" name="product['+i+'][sale_group_id]" value="'+sale_id+'"><input type="hidden" name="product['+i+'][sale_product_id]" value="'+product.sale_product_id+'">'+product.product_name+'</td>';
                            html+='<td>'+product.quantity+'</td>';
                            html+='<td>'+product.price+'</td>';
                            html+='<td>'+product.price_iva+'</td>';
                            if(product.status==0){
                            html+='<td><select class="form-control" name="product['+i+'][status]">';
                            html+='<option value="0">Por processar</option>';
                            html+='<option value="1">Processado</option>';
                            html+='</select></td>';
                            }else{
                                html+='<td>Processado</td>';
                            }
                            html+='</tr>';
                            
                            i++;
                            
                        });

                        if(status > 1) {
                            $('#update_status_button').hide();
                        }else{
                            $('#update_status_button').show();
                        }

                        //se for admin pode colocar como enviado
                        <?php if($this->session->userdata('role_id')==3){ ?>
                        if(status==1){
                            $('#delivery_button_modal').show();
                            $('#delivery_button_modal').attr('onclick','update_sent_status('+sale_id+')');
                        }else{
                            $('#delivery_button_modal').hide();
                        }
                        <?php } ?>

                        $('#input_hidden_product_id').val(sale_id);
                        $('#statusModalLabel').text('Venda #'+sale_id);
                        $('#product_status').html(html);
                        $('#form_product_status').attr('action','<?php echo base_url('admin/sales/edit/'); ?>'+sale_id); 
                        $('#statusModal').modal('show');
                    }
                }
            }
        })

    }
    function update_sent_status(sale_id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/sales/update_send_status/'); ?>"+sale_id,
            data: "",
            success: function (response) {
                if(response=='success'){
                    alert('O estado da venda foi atualizado para enviado');
                    table.ajax.reload();
                }else{
                    console.log(response);
                }
            }
        });
    }



</script>