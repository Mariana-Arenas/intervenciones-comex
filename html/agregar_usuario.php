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
                                <h5 class="m-0 font-weight-bold text-primary">Agregar Usuario</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <form id="form1" style="">


<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="nombre" class="control-label required">Nombre</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="nombre" placeholder="Ingrese el Nombre" class="form-control " >
</div>
</div>
</div>
</div>
<div class="row">
</div>
<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="apellido" class="control-label required">Apellido</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="apellido" placeholder="Ingrese el Apellido" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>
<div class="row">
</div>
<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="email" class="control-label required">Email</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="email" placeholder="Ingrese el Email" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>



<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="celular" class="control-label required">Celular</label>
</div>
<div class="col-sm-4">
<div>
<input type="text" id="" name="celular" placeholder="Ingrese su Celular" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>


<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="numero_tributario" class="control-label required">Cuit de la empresa</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="cuit" placeholder="Ingrese el cuit de la empresa" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="direccion" class="control-label required">Cargo</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="cargo" placeholder="Ingrese su Cargo" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<div class="col-sm-3">
<label for="direccion" class="control-label required">Razón Social</label>
</div>
<div class="col-sm-8">
<div>
<input type="text" id="obligatorio" name="razon_social" placeholder="Ingrese la Razón Social" class="form-control" data-vv-id="1" aria-required="false" aria-invalid="false">
</div>
</div>
</div>
</div>

</div>
    <br />
<div class="form-group text-center"><button type="button" class="btn btn-primary edit"><i class="load-indicator"><div class="v-spinner" style="display: none;"><div class="v-clip" style="height: 20px; width:20px; border-width: 2px; border-style: solid; border-color: rgb(255,255, 255) rgb(255, 255,255) transparent; border-radius: 100%; background:transparent;"></div></div></i>Guardar <i class="fas fa-save"></i></button>
</div>
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
    url: '<?php echo SITEROOT ?>resources/middleware/agregar_usuario.php', 
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
