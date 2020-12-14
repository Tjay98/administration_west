<?php 
    if($this->session->userdata('role_id')==3){
        $admin=true;
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
                                <a class="dropdown-item"  href="<?php echo base_url('admin/products/add') ?>"><i class="fa fa-plus"></i> Adicionar produto</a>
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
                    <?php print_R($companies); ?>
                        <table class="table table-striped table-bordered table-hover" id="table-products" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Nome do produto</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <?php if($admin){  ?>
                                        <th>Empresa</th>
                                    <?php }?>
                                    <th>Preço</th>
                                    <th>Preço sem iva</th>
                                    <th>Valor do iva</th>
                                    <th>Data criado</th>
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="editModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="<?php echo base_url('admin/products/add') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Nome do produto</label>
                                <input type="text" name="product_name" id="product_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" name="product_image" id="product_image" accept="image/*" style="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="product_category" id="product_category" class="form-control">
                                    <option value="">Selecione uma opção</option>
                                    <?php foreach($categories as $category){ ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="number" name="product_price" id="product_price" class="form-control">
                            </div>
                        </div>  
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="product_quantity" id="product_quantity" class="form-control">
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Empresa</label>
                                <select name="product_company" id="product_company" class="form-control">
                                    <option value="">Selecione uma opção</option>
                                    
                                    <?php foreach($companies as $company){ ?>
                                        <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
                                    <?php }?>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="width:100%">Editar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {  

        //datatable
        var table=$('#table-products').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/product_table') ?>",
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
                { extend: 'excel', text: 'Exportar excel', title:'Produtos_<?php echo date('Y-m-d');?>', attr: { id: 'excelButton'} },
                { extend: 'pdf', text: 'Exportar pdf', title:'Produtos_<?php echo date('Y-m-d');?>', attr: { id: 'pdfButton'} },
                
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

    function show_edit_product(product_id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/products/show/');?>"+product_id,
            data: "",
            success: function (response) {
                if(response){
                    var obj = JSON.parse(response);
                    $('#editModalLabel').text("Editar "+obj.product_name);
                    $('#product_name').val(obj.product_name);
                    $('#product_price').val(obj.product_name);
                    $('#product_name').val(obj.product_name);
                    $('#product_name').val(obj.product_name);
                    $('#product_name').val(obj.product_name);

                }
            }
        });
        $('#editModal').modal('show');
    }
</script>