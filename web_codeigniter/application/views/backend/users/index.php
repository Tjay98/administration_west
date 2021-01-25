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
                        <table class="table table-striped table-bordered table-hover" id="table-products" style="width:100%;">
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
<script type="text/javascript">
    $(document).ready(function() {  

        //datatable
        var table=$('#table-products').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/user_table') ?>",
                type : 'POST',
            },
            stateSave: false,
            "order": [[0,"asc"]],
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
    });
</script>