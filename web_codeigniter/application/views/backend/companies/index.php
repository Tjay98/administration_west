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
                                <a class="dropdown-item" href="<?php echo base_url('admin/companies/add'); ?>"><i class="fa fa-plus"></i> Criar empresa</a>
                                <a class="dropdown-item"  id="export_pdf_button" href="#"><i class="fa fa-file-pdf-o"></i> Exportar PDF</a>
                                <a class="dropdown-item" id="export_excel_button" href="#"><i class="fa fa-file-excel-o"></i> Exportar Excel da tabela</a>
                            </div>
                        </div>
                    </div>  
                    <?php }?>
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
            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('')">
					<span class="info-box-icon bg-info elevation-1"><i class="fa fa-building-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total</span>
						<span class="info-box-number"><?php if(!empty($count_total)){echo $count_total;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('Inativa')" id="status_button_pending">
					<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-power-off"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Inativas</span>
						<span class="info-box-number"><?php if(!empty($count_inactive)){echo $count_inactive;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('Ativa')">
					<span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Ativas</span>
						<span class="info-box-number"><?php if(!empty($count_active)){echo $count_active;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="info-box">
                    <div class="box-body table-responsive" >
                        <table class="table table-striped table-bordered table-hover" id="table-companies" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Data criada</th>
                                    <th>Estado</th>
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
    var table

    $(document).ready(function() {  

        //datatable
       table=$('#table-companies').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/companies/companies_table') ?>",
                type : 'POST',
            },
            stateSave: false,
            "order": [[0,"desc"]],
            "columnDefs": [
                {
                    "targets": [ 1 , 5],
                    "orderable": false
                }
            ],
            responsive: false,
            "autoWidth": false,
            //plugins

            fixedHeader: true,
            select: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', text: 'Exportar excel',title:'Empresas_<?php echo date('Y-m-d');?>'},
                { extend: 'pdf', text: 'Exportar pdf' ,title:'Empresas_<?php echo date('Y-m-d');?>'},

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

    function enable_company(company_id){
        var confirmation = confirm('Deseja ativar a empresa?');
        new_status=1;
        if(confirmation){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/companies/delete/'); ?>"+company_id+"/"+new_status,
                data: "",
                success: function (response) {
                    table.ajax.reload();
                }
            });
        }
    }
    function disable_company(company_id){
        var confirmation = confirm('Deseja desativar a empresa?');
        new_status=0;
        if(confirmation){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/companies/delete/'); ?>"+company_id+"/"+new_status,
                data: "",
                success: function (response) {
                   /*  alert(response); */
                    table.ajax.reload();
                }
            });
        }
    }

    function change_table_status(status){
        table
            .column(4)
            .search(status)
            .draw()
    }
    
   
</script>