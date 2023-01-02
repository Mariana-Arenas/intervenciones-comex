<?php require_once('resources/html/head.php'); ?>
	<title>Cotizacion</title>
   	
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
                                <h5 class="m-0 font-weight-bold text-primary">Editar Cotizacion y Moneda</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form1" style="" >
                        <input type="hidden" name="idcodigopais" value=<?php echo $this->cotizacion['codigopais'] ?>>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">Código País</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="codigopais" placeholder="" value='<?php echo $this->cotizacion['codigopais'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">País</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="obligatorio" name="pais" placeholder="" value='<?php echo $this->cotizacion['pais'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label  class="control-label required">cotización</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="obligatorio" name="cotizacion" placeholder="" value='<?php echo $this->cotizacion['cotizaciondolar'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-2">
                                    <label  class="control-label required">Actualización </label>
                                </div>
                                <div class="col-sm-3">
                                <label class="btn btn-sm "><input type="radio" id="obligatorio" name="automatico" value="1" <?php if ( $this->cotizacion['automatico']=='1')echo 'checked'; ?> > Automática</label> 
                                    <label class="btn btn-sm "><input type="radio" id="obligatorio" name="automatico" value="0" <?php if ( $this->cotizacion['automatico']=='0')echo 'checked'; ?>> Manual</label>
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                        <label for="monedacotizacion" class="control-label required">Moneda</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" id="obligatorio" name="moneda">
                                        <option value=''>Seleccione una moneda</option>
                                             <?php foreach ($this->moneda as $key => $value): ?>
                                                <?php  if  ($this->cotizacion['moneda'] == $value['moneda']) { ?>
                                                    <option value="<?php echo $value['moneda']?>" selected><?php echo $value['moneda']?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php echo $value['moneda']?>"><?php echo $value['moneda']?></option>
                                                <?php } ?>
                                                
                                            <?php endforeach ?>
                                     </select>
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
    url: '<?php echo SITEROOT ?>resources/middleware/ver_cotizacion.php', 
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
