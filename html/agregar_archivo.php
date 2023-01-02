<?php require_once('resources/html/head.php'); ?>
	<title>Archivo</title>
   	
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
                                <h5 class="m-0 font-weight-bold text-primary">Subir Nuevo Archivo</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                      
                        <form id="form1" style=""  enctype="multipart/form-data">
                        <input type="hidden" id="gravamenes_seleccionados" name="gravamenes_seleccionados" value="">
                            <div class="form-group row">
                                <div class="col-sm-10">                        
                                    <label  class="control-label required">Los valores de su archivo deberán comenzar en la fila 2. Indique en los campos,  las letras de las columnas.
</label>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2">
                                    <label  class="control-label required">Indicar letra de las columnas</label>
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Ncm</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="ncm" placeholder="" value='<?php echo $this->archivo["ncm"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Origen</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="origen" placeholder="" value='<?php echo $this->archivo["origen"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Fob</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="fob" placeholder="" value='<?php echo $this->archivo["fob"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Cantidad</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="cantidad" placeholder="" value='<?php echo $this->archivo["cantidad"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Peso Neto</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="peso_neto" placeholder="" value='<?php echo $this->archivo["pesoneto"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2">
                                    <label  class="control-label required"></label>
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Codigo Articulo</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="codigo_articulo" placeholder="" value='<?php echo $this->archivo["codigo_articulo"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="col-sm-1">
                                    <label  class="control-label required">Descripcion Articulo</label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" id="obligatorio" name="descripcion_articulo" placeholder="" value='<?php echo $this->archivo["descripcion_articulo"]?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label  class="control-label required">En caso de NCM Duplicados seleccionar VC:</label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="btn btn-sm "><input type="radio" id="obligatorio" name="fob_buscar" onchange="mostrar(1);" value="1" checked> Automatico</label> 
                                    <label class="btn btn-sm "><input type="radio" id="obligatorio" name="fob_buscar" onchange="mostrar(0);" value="0"> Manual</label>
                                </div>
                                
                            </div>
                            <div class="form-group row"  name="div_manual" id="div_manual">
                                
                                <div class="col-sm-5">
                                    <label  class="control-label required">En caso de seleccion automatica, indique opcion deseada: </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="btn btn-sm "><input type="radio" id="obligatorio" name="fob_buscar_maximo" value="1" checked> Mayor Valor</label> 
                                    <label class="btn btn-sm "><input type="radio" id="obligatorio" name="fob_buscar_maximo" value="0"> Menor Valor</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                        <input id="image"  name="image" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                                </div>
                            </div>

                            <div class="form-group">
                            <div class="row">
                            <div class="col-sm-3">
                            <label for="monedacotizacion" class="control-label required">Moneda</label>
                            </div>
                            <div class="col-sm-8">
                            <div>
                            <select class="form-control" id="obligatorio" name="codigomoneda">
                            <option value=''>Seleccione una moneda</option>
                            <?php foreach ($this->monedacotizacion as $key => $value): ?>
                            <option value="<?php echo $value['moneda']?>"><?php echo $value['cotizacion']?></option>
                            <?php endforeach ?>
                            </select>
                            </div>
                            </div>
                            </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="monedacotizacion" class="control-label required">Intervenciones</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="btn btn-sm "><input type="radio" id="obligatorio" name="intervencion_mostrar" value="1" checked> Mostrar Intervenciones </label> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="btn btn-sm "><input type="radio" id="obligatorio" name="intervencion_mostrar" value="0" > No Mostrar Intervencioes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="monedacotizacion" class="control-label required">Gravamenes</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="btn btn-sm "><input type="radio" id="obligatorio" name="gravamenes_todos" onchange="mostrar_gravamen(0);" value="0" checked> Seleccionar Gravamenes </label> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="btn btn-sm "><input type="radio" id="obligatorio" name="gravamenes_todos" onchange="mostrar_gravamen(1);" value="1" > Todos los Gravamenes</label>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="form-group" name="div_gravamen" id="div_gravamen">
                            <div class="row">
                            
                            <div class="col-sm-8">
                            <div>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
                            <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
                            
                                <div class="col-sm-12"> <select id="choices-multiple-remove-button" name="choices-multiple-remove-button" placeholder="Seleccione los gravamenes que desee" multiple>
                                        <option value="10">Derecho Importación(Extrazona)</option>
                                        <option value="11">Estadística(Extrazona)</option>
                                        <option value="13">Derecho Exportación(Extrazona)</option>
                                        <option value="14">Reintegro(Extrazona)</option>
                                        <option value="16">Derecho Importación(Intrazona)</option>
                                        <option value="17">Derecho Exportación(Intrazona)</option>
                                        <option value="18">Reintegro Brasil(Intrazona)</option>
                                        <option value="19">Reintegro Uruguay(Intrazona)</option>
                                        <option value="20">Reintegro Paraguay(Intrazona)</option>
                                        
                                    </select> </div>
                           
                            </div>
                            </div>
                            </div>
                            </div>
                            <br />

                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary edit">Procesar <i class="fas fa-save"></i></button>
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
$(document).ready(function(){
    
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
       removeItemButton: true,
       maxItemCount:9,
       searchResultLimit:9,
       renderChoiceLimit:9,       
     }); 
    
  
    
});

 $('#div_manual').show();
$(".edit").on('click',function(){
    $(".ajax-msg").html("Aguarde un instante");
    $("#miModal").modal("show");
    var options = document.getElementById('choices-multiple-remove-button').selectedOptions;
    var values = Array.from(options).map(({ value }) => value);
    $('#gravamenes_seleccionados').val(values);
    
    var formData = new FormData(form1);

    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/agregar_archivo.php', 
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


function mostrar(valor)
{
    if (valor==1){
        $('#div_manual').show();
    }else{
        $('#div_manual').hide();
    }
}
 
function mostrar_gravamen(valor)
{
    if (valor==0){
        $('#div_gravamen').show();
    }else{
        $('#div_gravamen').hide();
    }
}
</script>
</body> 
</html> 
