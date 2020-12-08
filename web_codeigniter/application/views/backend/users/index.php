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
                                    <th>Nome do produto</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Preço sem iva</th>
                                    <th>Valor do iva</th>
                                    <th>Data criado</th>

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
                url : "",
                type : 'POST',
            },
            stateSave: false,
/*             "columnDefs": [ 
                {
                searchPanes:{
                    show: false, },
                    targets: [0,2,3,4,5,7,8], // Index of columns (starting at 0) that you want show/hide
                }
                
            ], */
            "order": [[2,"asc"]],
            responsive: false,
            "autoWidth": false,
            //plugins

            fixedHeader: true,
            select: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', text: 'Exportar excel',title:'Produtos_<?php echo date('Y-m-d');?>'},
                { extend: 'pdf', text: 'Exportar pdf' ,title:'Produtos_<?php echo date('Y-m-d');?>'},
                'searchPanes',
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
                searchPanes: {
                    collapse: 'Filtros de pesquisa',
                    title:{
                        _: 'Filtros Selecionados - %d',
                        0: 'Nenhum filtro selecionado',
                        1: '1 filtro selecionado',

                    }
                    
                    
                }
            },
            "pageLength": 25,

        });
    });
</script>