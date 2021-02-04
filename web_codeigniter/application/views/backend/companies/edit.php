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

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
            <div class="col-sm-6">
				<h1><?php if(!empty($page_title)){ echo $page_title;} ?></h1>

			</div>
        </div>
        <?php if($this->session->userdata('role_id')==3){ $admin=true; }else{ $admin=false;} ?>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
    <form id="form-companies" action="<?php echo base_url('admin/companies/edit/'.$company['id']);  ?>" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                    
                            <div class="card-header">
                            
                                <h4 class="text-bold">
                                    <?php if($admin){ ?>
                                    Informação da empresa
                                    <?php }else{
                                        echo $company['company_name'];     
                                    }?>

                                </h4>
                                    <!-- /.box-tools -->
                            </div>
                            <div class="card-body" >
                                <?php if($admin){ ?>
                                <div class="form-group">
                                    <label>Nome da empresa</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php if(!empty($company['company_name'])){ echo $company['company_name'];  } ?>">
                                    <small class="text-danger" id="company_name_error"></small>
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea class="form-control" id="company_description" name="description" rows=3><?php if(!empty($company['description'])){ echo $company['description'];  } ?></textarea>
                                    <small class="text-danger" id="company_description_error"></small>
                                </div>
                            </div>
                            <div class="card-footer">
                            <div class="pull-right">
                                    <button class="btn btn-md btn-info" type="submit">Editar empresa</button>
                                </div>
                            </div>
                            <?php /* print_r($company); */?>
                                
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body" >
                            <div class="card-header" >
                                <div class="file-upload">
                                    <small class="text-danger" id="upload_image_error"></small>
                                    <center><button class="btn btn-md btn-info" type="button" style="width:100%" onclick="click_image_upload()">Editar imagem</button></center>
                                    <div id="fill_image_upload">
                                        <input  id="upload_image" name="company_image" type='file' onchange="show_image(this)" accept="image/*" />
                                    </div>
                                    
                                    <div id="show_image_div" >
                                        <img id="show_image_here" src="<?php if(!empty($company['image'])){ echo base_url('/uploads/companies/'.$company['image']);}else{echo "#"; } ?>" alt="Imagem empresa" />
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
    $(document).ready(function(){
        <?php if(!empty($company['image'])){?>
            $('#show_image_div').show();
        <?php } ?>
    })

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

        <?php if($admin){ ?>
        if(company_name.length <= 0){
            flag=false;
            $('#company_name_error').text('Preencha o campo');
            $('#company_name').focus();

            message+='<p>Preencha o nome da empresa</p>';
        
        }
        <?php }?>

        if(company_description.length <=0){
            flag=false;
            $('#company_description_error').text('Preencha o campo');
            $('#company_description').focus();

            message+='<p>Preencha a descrição da empresa</p>';
        }


        if(flag){
            this.submit();
        }else{
            Swal.fire({
                
                icon: 'error',
                title: 'Erro',
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