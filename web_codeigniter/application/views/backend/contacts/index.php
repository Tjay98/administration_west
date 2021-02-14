<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: transparent;
        
    }
</style>
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
            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('')">
					<span class="info-box-icon bg-info elevation-1"><i class="fa fa-envelope-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total</span>
						<span class="info-box-number"><?php if(!empty($total_count)){echo $total_count;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('Recebido')" id="status_button_pending">
					<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-reply"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Recebidos</span>
						<span class="info-box-number"><?php if(!empty($count_pending)){echo $count_pending;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">

                <div class="info-box status_button" onclick="change_table_status('Resolvido')">
					<span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Resolvidos</span>
						<span class="info-box-number"><?php if(!empty($count_done)){echo $count_done;}else{echo 0;}  ?></span>
					</div>
					<!-- /.info-box-content -->
				</div>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="info-box">
                    
                    <div class="box-body table-responsive" >
                        <table class="table table-striped table-bordered table-hover" id="table-contacts" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Título</th>
                                    <th>Estado</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
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


<!-- Modal product -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="contactModalLabel">
                    <span id="contact_title">TITULO</span>
                    <span id="contact_status">ESTADO</span>
                    <span id="contact_type">TIPO</span>
                    <button class="btn btn-sm btn-info" id="contact_date" disabled="">Data</button>
                </h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="fill_this_contact">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="contact_name" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="contact_email" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" class="form-control" id="contact_subject" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Mensagem</label>
                            <textarea class="form-control" id="contact_message" readonly></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer" style="border-color:transparent;">

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var table;
    $(document).ready(function() {  
        //datatable
        table=$('#table-contacts').DataTable({
            "ajax": {
                url : "<?php echo base_url('admin/contacts/contact_table') ?>",
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
                { extend: 'excel', text: 'Exportar excel', title:'Contactos_<?php echo date('Y-m-d');?>', attr: { id: 'excelButton'} },
                { extend: 'pdf', text: 'Exportar pdf', title:'Contactos_<?php echo date('Y-m-d');?>', attr: { id: 'pdfButton'} },
                
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

    function change_table_status(status){
        
        table
            .column(4)
            .search( status )
            .draw();
    }

    function edit_contact(contact_id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/contacts/edit/');?>"+contact_id,
            data: "",
            success: function (response) {
                contact_obj=JSON.parse(response);

                if(contact_obj){
                    name=contact_obj.name;
                    email=contact_obj.email;
                    subject=contact_obj.subject;
                    message=contact_obj.message;
                    status=contact_obj.status;
                    type=contact_obj.type;
                    created_date=contact_obj.created_date;

                    /* alert(status); */

/*                     switch(status){
                        case 0:
                            status='<button class="btn btn-sm btn-warning" disabled>Recebido</button>';
                            
                            break;

                        case 1:
                            status='<button class="btn btn-sm btn-success" disabled>Resolvido</button>';
                            break;

                        default:
                            status=contact_obj.status;
                            alert(status);
                            break;
                    }

                    switch(type){
                        case 1:
                            type='<button class="btn btn-sm btn-info" disabled>Utilizador</button>';
                            break;
                        
                        case 2:
                            type='<button class="btn btn-sm btn-info" disabled>Empresa</button>';
                            break;

                        default:
                            type=contact_obj.type;
                            break;
                    } */

                    if(status==1){
                        status='<button class="btn btn-sm btn-warning" disabled>Recebido</button>';
                    }else if(status == 2){
                        status='<button class="btn btn-sm btn-success" disabled>Resolvido</button>';
                    }

                    if(type == 1){
                        type='<button class="btn btn-sm btn-info" disabled>Utilizador</button>';
                    }else if(type == 2){
                        type='<button class="btn btn-sm btn-info" disabled>Empresa</button>';
                    }

    

                    $('#contact_name').val(name);
                    $('#contact_email').val(email);
                    $('#contact_subject').val(subject);
                    $('#contact_message').val(message);

                    $('#contact_status').html(status);
                    $('#contact_type').html(type);
                    $('#contact_date').text(created_date);


                    $('#contact_title').text('Contacto #'+contact_id);
                    /* $('#fill_this_contact').text(response); */
                    $('#contactModal').modal('show');
                }
            }
        });
    }

    function delete_contact(contact_id){
        Swal.fire({
            title: 'Deseja apagar o contacto?',
            
            showCancelButton: true,
            confirmButtonText: 'Apagar',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/contacts/delete/');?>"+contact_id,
                    data: "",
                    success: function (response) {
                        if(response=='success'){
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Contacto apagado',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            table.ajax.reload();
                        }else{
                            console.log(response);
                        }
                    }
                });
            } 
        })

    }

    
</script>