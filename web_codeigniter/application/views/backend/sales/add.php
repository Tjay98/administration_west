<style>
    .hidden-client{
        display:none;
    }
    .box-header{
        padding:10px;
    }
    .text-bold{
        font-weight:bold;
    }
    .accordion_header{
        cursor:pointer;
    }
    .create_addresses{
        position:absolute;
        right:10px;
        top:5px;
    }
</style>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>

			</div>
		</div>
        <div class="row">
            <?php if(!empty($this->session->flashdata('error'))){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
        </div>

	</div>
	<!-- /.container-fluid -->
</section>
<!--Body section -->
<section class="content">
    <form id="form-sales" action="<?php echo base_url('admin/sales/add') ?>" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-bold">
                                Cliente
                                <div style="position:absolute;right:15px;top:10px;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="show_user_modal()">
                                        Procurar <i class="fa fa-search"></i>
                                    </button>

                                </div>
                            </h4>
                                <!-- /.box-tools -->
                        </div>
                        <div class="card-body">
                            
                            <div class="hidden-client">
                                    
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h4 >Informações</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Nome do cliente</label>
                                            <input type="hidden" class="form-control" id="client_id" name="sale[user_info][client_id]" readonly>
                                            <input type="text" class="form-control" id="client_name" name="sale[user_info][client_name]" readonly>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="client_email" name="sale[user_info][client_email]" readonly>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Telemóvel</label>
                                            <input type="text" class="form-control" id="client_phone" name="sale[user_info][client_phone]" readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top:10px;">
                                        <div id="accordion2">
                                            <div class="card">
                                                <div class="card-header " >
                                                    <h5 class="mb-0 accordion_header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Morada de envio 
                                                        
                                                    </h5>
                                                    <!-- <button type="button" class="btn btn-warning btn-sm create_addresses" onclick="copy_billing_address()">Copiar morada de faturação</button> -->
                                                    <!-- <button type="button" class="btn btn-info btn-sm create_addresses" onclick="create_address_shipping()">Criar</button> -->
                                                </div>
                                                
                                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Nome do cliente</label>
                                                            <!-- <input type="hidden" id="shipping_address_id" name="sale[shipping_address][id]" value="">
                                                            <input type="hidden" id="shipping_address_user_id" name="sale[shipping_address][user_id]" value=""> -->
                                                            <input type="text" class="form-control" id="shipping_address_name"  name="sale[shipping_address][name]" value="">
                                                            <small class="text-danger" id="shipping_address_name_error"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIF</label>
                                                            <input type="text" class="form-control" id="shipping_address_nif"  name="sale[shipping_address][nif]" value="">
                                                            <small class="text-danger" id="shipping_address_nif_error"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nº de telemóvel</label>
                                                            <input type="text" class="form-control" id="shipping_address_contact_number" name="sale[shipping_address][contact_number]" value="">
                                                            <small class="text-danger" id="shipping_address_contact_number_error"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cidade</label>
                                                            <input type="text" class="form-control" id="shipping_address_city" name="sale[shipping_address][city]" value="">
                                                            <small class="text-danger" id="shipping_address_city_error"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Morada</label>
                                                            <input type="text" class="form-control" id="shipping_address_address" name="sale[shipping_address][address]" value="">
                                                            <small class="text-danger" id="shipping_address_address_error"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Código postal</label>
                                                            <input type="text" class="form-control" id="shipping_address_zip_code"  name="sale[shipping_address][zip_code]" value="">
                                                            <small class="text-danger" id="shipping_address_zip_code_error"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </Div>
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" >
                                                    <h5 class="mb-0 accordion_header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Morada de faturação
                                                    </h5>

                                                    <!-- <div class="btn-group btn-sm create_addresses" role="group"> -->
                                                        <button type="button" class="btn btn-warning btn-sm create_addresses" onclick="copy_shipping_address()">Copiar morada de envio</button>
    <!--                                                     <button type="button" class="btn btn-info btn-sm" onclick="create_address_billing()">Criar morada</button>
                                                    </div> -->
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Nome do cliente</label>
                                                            <!-- <input type="hidden"  id="billing_address_id" name="sale[billing_address][id]" value="">
                                                            <input type="hidden" id="billing_address_user_id" name="sale[billing_address][user_id]" value=""> -->
                                                            <input type="text" class="form-control" id="billing_address_name"  name="sale[billing_address][name]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIF</label>
                                                            <input type="text" class="form-control" id="billing_address_nif"  name="sale[billing_address][nif]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nº de telemóvel</label>
                                                            <input type="text" class="form-control" id="billing_address_contact_number"  name="sale[billing_address][contact_number]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cidade</label>
                                                            <input type="text" class="form-control" id="billing_address_city"  name="sale[billing_address][city]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Morada</label>
                                                            <input type="text" class="form-control" id="billing_address_address"  name="sale[billing_address][address]" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Código postal</label>
                                                            <input type="text" class="form-control" id="billing_address_zip_code"  name="sale[billing_address][zip_code]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header" >
                                <?php if(!empty($payment_methods)){ ?>
                                    <small class="text-danger" id="payment_method_error"></small>
                                    <h4 class="mb-3"  style="font-weight:bold;">Método de pagamento</h4>
                                    <div class="d-block my-3">
                                        <?php foreach($payment_methods as $payment){ ?>
                                            <div class="custom-control custom-radio">
                                                <input id="<?php echo "method_".strtolower($payment['name']); ?>" name="sale[payment_method][payment_method_id]" type="radio" class="custom-control-input payment_methods" value="<?php echo $payment['id'] ?>" required="">
                                                <label class="custom-control-label" for="method_<?php echo strtolower($payment['name']); ?>"><?php echo $payment['name'] ?></label>
                                            </div>
                                        <?php }?>
                                    </div>
                                <?php }?>
                                <hr class="mb-4">
                                <h4 class="text-bold">Totais</h4>
                                
                            </div>
                            <div class="row" style="padding-top:10px;">
                            
                                <div class="col-lg-6 col-md-6 col-lg-12">
                                    <h4>Total <span id="total_price" style="font-weight:bold;">0.00</span>€</h4>
                                </div>
                                <div class="col-lg-6 col-md-6 col-lg-12">
                                    <h4>Total IVA <span id="total_price_iva" style="font-weight:bold;">0.00</span>€</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                
                                <button type="button" class="btn btn-md btn-success" style="width:100%" onclick="submit_sale()">Criar venda</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                
                    <div class="info-box">
                        <div class="box-body table-responsive" >
                            <table class="table table-bordered table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço</th>
                                        <th>Valor do IVA</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="product_table_body">

                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td ><button type="button" onclick="search_product();" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</section>

<script>

    var row=0;

    //user modal related
    function show_user_modal(){
       $('#clientModal').modal('show');
    }
    function select_user(user_id){

        id=$('#client_modal_id_'+user_id).text();
        username=$('#client_modal_username_'+user_id).text();
        phone_number=$('#client_modal_phone_number_'+user_id).text();
        email=$('#client_modal_email_'+user_id).text();
        $('#client_id').val(id);
        $('#client_name').val(username);
        $('#client_phone').val(phone_number);
        $('#client_email').val(email);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/sales/client_address') ?>",
            data: {'user_id':id},
            success: function (response) {
                //alert(response);
                if(response){
                    obj=JSON.parse(response);

                    if(obj){
                        if(obj.shipping_address){
                            shipping_address=obj.shipping_address;
/*                             $('#shipping_address_id').val(shipping_address.id);
                            $('#shipping_address_user_id').val(shipping_address.user_id); */
                            $('#shipping_address_name').val(shipping_address.name);
                            $('#shipping_address_nif').val(shipping_address.nif);
                            $('#shipping_address_contact_number').val(shipping_address.contact_number);
                            $('#shipping_address_city').val(shipping_address.city);
                            $('#shipping_address_address').val(shipping_address.address);
                            $('#shipping_address_zip_code').val(shipping_address.zip_code);

                        }
                        if(obj.billing_address){
                            
                            billing_address=obj.billing_address;
                            /* $('#billing_address_id').val(billing_address.id);
                            $('#billing_address_user_id').val(billing_address.user_id); */
                            $('#billing_address_name').val(billing_address.name);
                            $('#billing_address_nif').val(billing_address.nif);
                            $('#billing_address_contact_number').val(billing_address.contact_number);
                            $('#billing_address_city').val(billing_address.city);
                            $('#billing_address_address').val(billing_address.address);
                            $('#billing_address_zip_code').val(billing_address.zip_code);
                        }
                    }

                    
                    $('#clientModal').modal('hide');
                }

            }
        });
        $('.hidden-client').show();
    }

    //product modal related
    function search_product(){

        $('#productModal').modal('show');
    }

    function select_product(product_id){
        $('#productModal').modal('hide');
        var has_product=false;

        id=$('#product_modal_id_'+product_id).text();
        product=$('#product_modal_name_'+product_id).text();
        quantity=$('#product_modal_quantity_'+product_id).text();
        price=$('#product_modal_price_'+product_id).text();
        price_iva=$('#product_modal_price_iva_'+product_id).text();

        

        $('.product_row').each(function(){
            this_id=$(this).attr('id');
            this_id=this_id.replace('product_row','');
            
            this_product_id=$('#product_id_'+this_id).val();
            
            if(this_product_id == product_id){
                has_product=true;
                quantity=$('#product_quantity_'+this_id).val();

                new_quantity=parseInt(quantity)+1;
                $('#product_quantity_'+this_id).val(new_quantity);
            }

        })

        if(has_product!=true){

            html  = '<tr id="product_row' + row + '" class="product_row">';
            html +=     '<td><input type="hidden" id="product_id_'+row+'" name="sale[product]['+row+'][id]" value="'+id+'"><input type="text" class="form-control" id="product_name_'+row+'" name="sale[product]['+row+'][product_name]" value="'+product+'" readonly></td>';
            html +=     '<td><input type="number" class="form-control"  min="1" id="product_quantity_'+row+'" onchange="change_quantity('+row+')" name="sale[product]['+row+'][quantity]" value="1" ></td>';
            html +=     '<td><input type="hidden" id="original_price_'+row+'" value="'+price+'"><input type="text" class="form-control" id="product_price_'+row+'" name="sale[product]['+row+'][price]" value="'+price+'" readonly></td>';
            html +=     '<td><input type="hidden" id="original_price_iva_'+row+'" value="'+price_iva+'"><input type="text" class="form-control" id="product_price_iva_'+row+'" name="sale[product]['+row+'][iva]" value="'+price_iva+'" readonly></td>';
            html +=     '<td><button type="button" onclick="remove_row('+row+')" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#product_table_body').append(html);
            row++;
        }


        
        
        refresh_prices(price,price_iva,'add');
        
    }

    function remove_row(row){
        old_value=$('#product_price_'+row).val();
        old_value_iva=$('#product_price_iva_'+row).val();
        refresh_prices(old_value,old_value_iva, 'remove');
        $('#product_row'+row).remove();
        
    }

    function change_quantity(row){
        //get values
        quantity=$('#product_quantity_'+row).val();
        original_price=$('#original_price_'+row).val();
        original_price_iva=$('#original_price_iva_'+row).val();

        //calculate
        new_value_price=parseFloat(original_price)*parseFloat(quantity);
        new_value_price_iva=parseFloat(original_price_iva)*parseFloat(quantity);


        //change values
        old_value=$('#product_price_'+row).val();
        old_value_iva=$('#product_price_iva_'+row).val();
        if(old_value < new_value_price){
            action='add';
        }else{
            action='remove';
        }
        $('#product_price_'+row).val(new_value_price.toFixed(2));
        $('#product_price_iva_'+row).val(new_value_price_iva.toFixed(2));
        refresh_prices(original_price,original_price_iva, action);
    }

    function refresh_prices(price,price_iva,action){
        total=$('#total_price').text();
        total_iva=$('#total_price_iva').text();

        if(action =='add'){
            new_value=parseFloat(total)+parseFloat(price);
            new_value_iva=parseFloat(total_iva)+parseFloat(price_iva);
        }else if(action=='remove'){
            new_value=parseFloat(total)-parseFloat(price);
            new_value_iva=parseFloat(total_iva)-parseFloat(price_iva);
        }

        $('#total_price').text(new_value.toFixed(2));
        $('#total_price_iva').text(new_value_iva.toFixed(2));

    }

    function submit_sale(){
        clear_errors();
        flag=true;
        shipping_message_error=false;

        message_error='';
        

        //validate client
        client_id=$('#client_id').val();
        
        if(!client_id){
            flag=false;
			message_error+='<p>Selecione um cliente</p>';
        }

        //validate product
        if (!$('.product_row')[0]){
			/* alert('Adicione um produto à venda'); */
			flag=false;
            message_error+='<p>Adicione um produto à venda</p>';
        }


        /* shipping_user_id=$('#shipping_address_user_id').val();*/
        shipping_user_name= $('#shipping_address_name').val(); 
        shipping_user_nif=$('#shipping_address_nif').val();
        shipping_user_contact_number=$('#shipping_address_contact_number').val();
        shipping_user_city=$('#shipping_address_city').val();
        shipping_user_address=$('#shipping_address_address').val();
        shipping_user_zip_code =$('#shipping_address_zip_code').val();         
        
        payment_method=$('input[name="sale[payment_method][payment_method_id]"]:checked').val();
                           
                            
        /* if( !(shipping_user_id && shipping_user_name && shipping_user_nif && shipping_user_contact_number && shipping_user_city && shipping_user_address && shipping_user_zip_code) ){
            alert('Preencha a morada de envio');
            flag=false;
        } */

        if(shipping_user_name.length <= 0){
            $('#shipping_address_name_error').text('Preencha o campo');
            shipping_message_error=true;

            flag=false;
        }
        if(shipping_user_nif.length !=9){
            $('#shipping_address_nif_error').text('Preencha o campo (9 digitos)');
            shipping_message_error=true;

            flag=false;
        }
        if(shipping_user_contact_number.length !=9){
            $('#shipping_address_contact_number_error').text('Preencha o campo (9 digitos)');
            shipping_message_error=true;

            flag=false;
        }
        if(shipping_user_city.length <= 0){
            $('#shipping_address_city_error').text('Preencha o campo');
            shipping_message_error=true;

            flag=false;
        }
        if(shipping_user_address.length <= 0){
            $('#shipping_address_address_error').text('Preencha o campo');
            shipping_message_error=true;

            flag=false;
        }
        if(shipping_user_zip_code.length <= 0){
            $('#shipping_address_zip_code_error').text('Preencha o campo');
            shipping_message_error=true;

            flag=false;
        }

        if(payment_method =='undefined' || !payment_method){
            flag=false;
            message_error+='<p>Selecione um metodo de pagamento</p>';
            $('#payment_method_error').text('Selecione uma opção');
        }


                            
         /*billing_user_id=$('#billing_address_user_id').val();
        billing_user_name= $('#billing_address_name').val();
        billing_user_nif=$('#billing_address_nif').val();
        billing_user_contact_number=$('#billing_address_contact_number').val();
        billing_user_city=$('#billing_city').val();
        billing_user_address=$('#billing_address').val();
        billing_user_zip_code =$('#billing_zip_code').val();          
                           
                            
        if( !(billing_user_id && billing_user_name && billing_user_nif && billing_user_contact_number && billing_user_city && billing_user_address && billing_user_zip_code) ){
            alert('Preencha a morada de faturação ou copie a morada de envio');
            flag=false;
        }    */             
                    

        if(shipping_message_error){
            message_error+='<p>Algum dos campos da morada está por preencher</p>';
        }

        if(flag==false){
            Swal.fire({
                
                icon: 'error',
                title: 'Erro',
                html:message_error,
            
            })

            return null;
        }else{
            $('#form-sales').submit();
        }
    }

    function clear_errors(){
        $('.text-danger').text('');
    }

    function copy_shipping_address(){
        shipping_user_id=$('#shipping_address_user_id').val();
        shipping_user_name= $('#shipping_address_name').val();
        shipping_user_nif=$('#shipping_address_nif').val();
        shipping_user_contact_number=$('#shipping_address_contact_number').val();
        shipping_user_city=$('#shipping_address_city').val();
        shipping_user_address=$('#shipping_address_address').val();
        shipping_user_zip_code =$('#shipping_address_zip_code').val(); 
        
        
        $('#billing_address_user_id').val(shipping_user_id);
        $('#billing_address_name').val(shipping_user_name);
        $('#billing_address_nif').val(shipping_user_nif);
        $('#billing_address_contact_number').val(shipping_user_contact_number);
        $('#billing_address_city').val(shipping_user_city);
        $('#billing_address_address').val(shipping_user_address);
        $('#billing_address_zip_code').val(shipping_user_zip_code);

    }
    function copy_billing_address(){
        
    }


    $(document).ready(function() {  

        //datatable
        var table=$('.table_datatable').DataTable({
            stateSave: false,
            "order": [[0,"desc"]],
            responsive: false,
            "lengthChange": false,
            "autoWidth": false,

            //plugins
            fixedHeader: true,
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
            "pageLength": 5,

        });
    });
    
</script>


<!-- Modal Clients -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="clientModalLabel">Clientes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y:scroll;">
                <table class="table table-bordered table-hover table_datatable" style="width:100%;">
                    <thead>
                        <tr>   
                            <th>#</th>
                            <th>Nome do cliente</th>
                            <th>Telemóvel</th>
                            <th>Email</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($clients)){
                            foreach($clients as $client){?>
                                <tr>
                                    <td id="client_modal_id_<?php echo $client['id']; ?>"><?php echo $client['id']; ?></td>
                                    <td id="client_modal_username_<?php echo $client['id']; ?>"><?php echo $client['username']; ?></td>
                                    <td id="client_modal_phone_number_<?php echo $client['id']; ?>"><?php echo $client['phone_number']; ?></td>
                                    <td id="client_modal_email_<?php echo $client['id']; ?>"><?php echo $client['email']; ?></td>
                                    <td><button class="btn btn-sm btn-info" onclick="select_user(<?php echo $client['id']; ?>)">Selecionar</button></td>
                                </tr>
                            <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Modal Products -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productModalLabel">Produtos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y:scroll;">
                <table class="table table-bordered table-hover table_datatable" style="width:100%;">
                    <thead>
                        <tr>   
                            <th>#</th>
                            <th>Produto</th>
                            <th>Quantidade em stock</th>
                            <th>Preço</th>
                            <th>Valor do iva</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($products)){
                            foreach($products as $product){?>
                                <tr>
                                    <td id="product_modal_id_<?php echo $product['id']; ?>"><?php echo $product['id']; ?></td>
                                    <td id="product_modal_name_<?php echo $product['id']; ?>"><?php echo $product['product_name']; ?></td>
                                    <td id="product_modal_quantity_<?php echo $product['id']; ?>"><?php echo $product['quantity_in_stock']; ?></td>
                                    <td id="product_modal_price_<?php echo $product['id']; ?>"><?php echo $product['price']; ?></td>
                                    <td id="product_modal_price_iva_<?php echo $product['id']; ?>"><?php echo $product['price_iva']; ?></td>
                                    <?php if($product['quantity_in_stock'] <=0){ ?>
                                        <td>SEM STOCK</td>
                                    <?php }else{?>
                                        <td><button class="btn btn-sm btn-info" onclick="select_product(<?php echo $product['id']; ?>)">Selecionar</button></td>
                                    <?php } ?>
                                    
                                </tr>
                            <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>