<?php require_once('resources/html/head.php'); ?>
	<title>NCM</title>
   	
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
                                <h5 class="m-0 font-weight-bold text-primary">Agregar NCM</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form1" style="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">NCM</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" id="obligatorio" name="ncm" placeholder="" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">Descripción</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" id="obligatorio" name="descripcion" placeholder="" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">FOB</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" id="obligatorio" name="fob" placeholder="" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">Norma</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="obligatorio" name="norma" placeholder="" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="monedacotizacion" class="control-label required">Unidad Medida</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="obligatorio" name="unidadmedida">
                                            <option value=''>Seleccione una unidad</option>
                                            <?php foreach ($this->unidad_medida as $key => $value): ?>
                                                <option value="<?php echo $value['unidad_medida']?>"><?php echo $value['unidad_medida']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="monedacotizacion" class="control-label required">Origen</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="obligatorio" name="pais">
                                            <option value=''>Seleccione una opción</option>
                                            <?php foreach ($this->grupo_pais as $key => $value): ?>
                                                <option value="<?php echo $value['Pais']?>"><?php echo $value['Pais']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary edit">Guardar <i class="fas fa-save"></i></button>
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
    url: '<?php echo SITEROOT ?>resources/middleware/agregar_ncm.php', 
    type: 'POST', 
    dataType: 'JSON', 
    data: formData,
    contentType: false, 
    processData: false,
    success: function(data){
    if (data.status == 'success'){
    location.href = data.url; 
    }else{
    $('[id=obligatorio]').css('border', '1px solid #df4e68fa'); 
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
