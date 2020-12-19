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
		<!-- Info boxes -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="info-box">
                    
                    <div class="box-body table-responsive" >
                        <table class="table table-striped table-bordered table-hover" id="table-sales" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Cliente</th>
                                    <?php if($admin){  ?>
                                        <th>Empresa</th>
                                    <?php }?>
                                    <th>Morada</th>
                                    <th>Estado</th>
                                    <th>Método de pagamento</th>
                                    <th>Total</th>
                                    <th>Data pedido</th>
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


<!-- Modal product -->
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
                 <form id="sale_shipping_form" action="<?php echo base_url('admin/sales/add') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">

                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="button_shipping_submit"style="width:100%">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {  

        //datatable
        var table=$('#table-products').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/sales_table') ?>",
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


       
    });


</script>