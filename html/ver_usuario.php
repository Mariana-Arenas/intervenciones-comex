<?php require_once('resources/html/head.php'); ?>
	<title>Usuario</title>
   	
<body id="page-top">
    
<!-- Page Wrapper -->
<div id="wrapper">
    <?php require_once('resources/html/nav.php'); ?>

     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">
         <!-- Main Content --> 
        <div id="content">
        <?php require_once('resources/html/navtop.php'); ?>
            <div class="container-fluid">   
                <!-- Page Heading -->
                    
                <!-- fin Page Heading -->
                <!--editar-->
                <div class="card shadow mb-4">
                     <div class="card-header py-3">
			            <div class="row">
                            <div class="col-sm-3">
                                <h5 class="m-0 font-weight-bold text-primary">Editar Usuario</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form1" style="" >
                        <input type="hidden" name="idusuario" value=<?php echo $this->usuario['usuarioID'] ?>>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Nombre</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="nombre" placeholder="Ingrese el Nombre" value='<?php echo $this->usuario['nombre'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Apellido</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="apellido" placeholder="Ingrese el Apellido" value='<?php echo $this->usuario['apellido'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Email</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="email" placeholder="Ingrese el Email" value='<?php echo $this->usuario['email'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Celular</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="celular" placeholder="Ingrese el Celular" value='<?php echo $this->usuario['celular'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Cuit de la empresa</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="cuit" placeholder="Ingrese el Cuit de la Empresa" value='<?php echo $this->usuario['cuit'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Cargo</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="cargo" placeholder="Ingrese el Cargo" value='<?php echo $this->usuario['cargo'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Razón Social</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="razon_social" placeholder="Ingrese la Razón Social" value='<?php echo $this->usuario['razon_social'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            
                        </div>
                            
                            <br />
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary edit">Guardar <i class="fas fa-save"></i></button>
                            </div>
                                        <!--<input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>-->
                        </form>               
                    </div>
                </div>
                
                <!-- fin editar -->
            </div> 
        </div>
      <!-- End of Main Content -->

     </div>
     <!-- End of Page Wrapper -->

</div>
<?php require_once('resources/html/footer.php'); ?>
<?php require_once('resources/html/script.php'); ?> 
<script>

$(".edit").on('click',function(){
    var formData = new FormData(form1);
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/ver_usuario.php', 
    type: 'POST', 
    dataType: 'JSON', 
    data: formData,
    contentType: false, 
    processData: false,
    success: function(data){
    if (data.status == 'success'){
    location.href = data.url; 
    }else{
    $('[id=obligatorio]').css('border', '1px solid #1fadf2'); 
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
}); 

 
</script>
</body> 
</html> 
