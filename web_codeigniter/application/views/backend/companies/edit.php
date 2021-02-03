<style>
#show_image_div, #upload_image{
  display: none;
  text-align: center;
  cursor: pointer;
}

#show_image_here {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
            <div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>

			</div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
    <form id="form-companies" action="<?php echo base_url('admin/companies/add') ?>" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-bold">
                                Informação da empresa

                            </h4>
                                <!-- /.box-tools -->
                        </div>
                        <div class="card-body" >
                            <div class="form-group">
                                <label>Nome da empresa</label>
                                <input type="text" class="form-control" id="company_name" name="company_name">
                                <small class="text-danger" id="company_name_error"></small>
                            </div>
                            <div class="form-group">
                                <label>Nome da empresa</label>
                                <textarea class="form-control" id="company_description" name="description" rows=3></textarea>
                                <small class="text-danger" id="company_description_error"></small>
                            </div>

                        </div>
                        <div class="card-footer">
                        <div class="pull-right">
                                <button class="btn btn-md btn-info" type="submit">Criar empresa</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body" >
                            <div class="card-header" >
                                <div class="file-upload">
                                    <small class="text-danger" id="upload_image_error"></small>
                                    <center><button class="btn btn-md btn-info" type="button" style="width:100%" onclick="click_image_upload()">Adicionar imagem</button></center>
                                    <div id="fill_image_upload">
                                        <input  id="upload_image" name="company_image" type='file' onchange="show_image(this)" accept="image/*" />
                                    </div>
                                    <div id="show_image_div" >
                                        <img id="show_image_here" src="#" alt="Imagem empresa" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</section>


<script>
    function show_image(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('#show_image_here').attr('src', e.target.result);
                $('#show_image_div').show();
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }
    function click_image_upload(){
        $('#upload_image').click();
    }
    
    function removeUpload() {
       
        $('#show_image_here').attr('src','#');
        $('#show_image_div').hide();
    }

    $('#form-companies').on('submit',function(){
        event.preventDefault();
        clear_error_messages();

        var flag=true;
        var message='';

        company_name=$('#company_name').val();
        company_description=$('#company_description').val();

        if(company_name.length <= 0){
            flag=false;
            $('#company_name_error').text('Preencha o campo');
            $('#company_name').focus();

            message+='<p>Preencha o nome da empresa</p>';
        
        }

        if(company_description.length <=0){
            flag=false;
            $('#company_description_error').text('Preencha o campo');
            $('#company_description').focus();

            message+='<p>Preencha a descrição da empresa</p>';
        }


        if ($('#upload_image').get(0).files.length === 0) {
            message+='<p>Adicione uma imagem<p>';

            $('#upload_image_error').text('Adicione uma imagem');
            flag=false;
        }

        if(flag){
            this.submit();
        }else{
            Swal.fire({
                
                icon: 'error',
                title: 'Erro',
                /* text: , */
                html:message,
            
            })
        }
    })

    function clear_error_messages(){
        $('#company_name_error').text('');
        $('#company_description_error').text('');
        $('#upload_image_error').text('');
    }

</script>