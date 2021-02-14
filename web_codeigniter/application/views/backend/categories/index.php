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
                                <?php if($admin){ ?>
                                <a class="dropdown-item" href="#" onclick="create_new_category()"><i class="fa fa-plus"></i> Criar categoria</a>
                                <?php }?>
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
                        <table class="table table-striped table-bordered table-hover" id="table-categories" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome da categoria</th>
                                    <th>Valor do IVA</th>
                                    <th>Ação</th>
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


<!-- Modal edit -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="categoryModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nome da categoria</label>
                            <input type="text" class="form-control" id="category_name" >
                            <small class="text-danger" id="category_name_error"></small>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>IVA</label>
                            <input type="number"  min="0" class="form-control" id="category_iva" >
                            <small class="text-danger" id="category_iva_error"></small>
                        </div>
                    </div>               
                </div>
                
            </div>
            <div class="modal-footer">
            <?php if($this->session->userdata('role_id')==3){ ?>
                <button class="btn btn-success btn-md" id="categoryModalButton" style="width:100%;">Editar</button>
            <?php }?>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {  

        //datatable
        var table=$('#table-categories').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/categories/categories_table') ?>",
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
                { extend: 'excel', text: 'Exportar excel', title:'Categorias_<?php echo date('Y-m-d');?>', attr: { id: 'excelButton'} },
                { extend: 'pdf', text: 'Exportar pdf', title:'Categorias_<?php echo date('Y-m-d');?>', attr: { id: 'pdfButton'} },
                
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

        $( "#category_iva" ).keypress(function() {
            if($(this).val < 0){
                $('#category_iva').val('0');
            }
        });
    });

    function create_new_category(){
        clear_errors();
        $('#category_name').val('');
        $('#category_iva').val('');
        $('#categoryModalLabel').text('Criar venda');
        $('#categoryModalButton').attr('onclick','submit_create_category()');
        $('#categoryModalButton').text('Criar');
        $('#categoryModal').modal('show');
    }

    function submit_create_category(){
        clear_errors();
        category_name=$('#category_name').val();
        category_iva=$('#category_iva').val();
        flag=true;

        if(category_name.length <= 0){
            flag=false;

            $('#category_name_error').text('Preencha o campo');
        }
        if(category_iva.length <= 0){
            flag=false;
            
            $('#category_iva_error').text('Preencha o campo');
        }

        if(flag==true){

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/categories/add/'); ?>",
                data: {'category_name':category_name,'category_iva':category_iva},
                success: function (response) {
                    if(response=="success"){
                        alert('Categoria criada');
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                }
            });
        }
    }

    function edit_category(category_id){
        clear_errors();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/categories/edit/'); ?>"+category_id,
            data: "",
            success: function (response) {
                obj=JSON.parse(response);
                if(obj){
                    $('#category_name').val(obj.category_name);
                    $('#category_iva').val(obj.iva);
                }
            }
        });

        $('#categoryModalLabel').text('Editar venda #'+category_id);
        $('#categoryModalButton').attr('onclick','submit_edit_category('+category_id+')');
        $('#categoryModalButton').text('Editar');
        $('#categoryModal').modal('show');
    }

    function submit_edit_category(category_id){
        clear_errors();
        category_name=$('#category_name').val();
        category_iva=$('#category_iva').val();
        flag=true;

        if(category_name.length <= 0){
            flag=false;
            $('#category_name_error').text('Preencha o campo');
        }
        if(category_iva.length <= 0){
            flag=false;
            
            $('#category_iva_error').text('Preencha o campo');
        }

        if(flag==true){

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/categories/edit/'); ?>"+category_id,
                data: {'category_name':category_name,'category_iva':category_iva},
                success: function (response) {
                    if(response=='success'){
                        alert('Categoria editada');
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                }
            });
        }

    }

    function clear_errors(){
        $('#category_name_error').text('');
        $('#category_iva_error').text('');
    }

</script>