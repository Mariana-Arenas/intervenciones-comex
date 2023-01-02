<?php require_once('resources/html/head.php'); ?>
	<title>Archivos Maestros</title>
   	
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
                                <h5 class="m-0 font-weight-bold text-primary">Actualización de Parametría</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form1" style=""  enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label  class="control-label required">los valores deberán comenzar en la fila 2</label>
                                </div>
                                <div class="col-sm-2">
                                    <label  class="control-label required">Templates</label>
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" onclick="DescargarGrupoPais();" >Grupo Pais</a>
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" onclick="DescargarNcm();" >NCM</a>
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" onclick="DescargarGravamen();" >Gravamen</a>
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" onclick="DescargarIntervencion();" >Intevencion</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label  class="control-label required">Tipo de Archivo</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="obligatorio" name="tipo_archivo">
                                        <option value=''>Seleccione una opción</option>
                                        <option value="NC">NCM</option>
                                        <option value="GP">Grupo Paises</option>
                                        <option value="GV">Gravamenes</option>
                                        <option value="IV">Intervenciones</option>
                                    </select>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <div class="col-sm-3">
                                        <input id="image"  name="image" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
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
    url: '<?php echo SITEROOT ?>resources/middleware/agregar_archivo_maestro.php', 
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

function DescargarIntervencion()
{
    $(".ajax-msg").html('Estamos procesando su pedido. Esto puede tardar.');
    $("#miModal").modal("show");
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/descargar_intervencion.php', 
    type:'POST',
    dataType:'JSON',
    data:$("#filtros").serialize(),

    success: function(data){
    if (data.status == 'success'){
        $("#miModal").modal("hide");
       // alert(1);
       window.open("uploads/intervencion/intervencion_actual.xlsx");
    }else{
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
}

function DescargarGravamen()
{
    $(".ajax-msg").html('Estamos procesando su pedido. Esto puede tardar.');
    $("#miModal").modal("show");
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/descargar_gravamen.php', 
    type:'POST',
    dataType:'JSON',
    data:$("#filtros").serialize(),

    success: function(data){
    if (data.status == 'success'){
        $("#miModal").modal("hide");
       // alert(1);
       window.open("uploads/gravamen/gravamen_actual.xlsx");
    }else{
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
}

function DescargarNcm()
{
    $(".ajax-msg").html('Estamos procesando su pedido. Esto puede tardar.');
    $("#miModal").modal("show");
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/descargar_ncm.php', 
    type:'POST',
    dataType:'JSON',
    data:$("#filtros").serialize(),

    success: function(data){
    if (data.status == 'success'){
        $("#miModal").modal("hide");
       // alert(1);
       window.open("uploads/ncm/ncm_actual.xlsx");
    }else{
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
}


function DescargarGrupoPais()
{
    $(".ajax-msg").html('Estamos procesando su pedido. Esto puede tardar.');
    $("#miModal").modal("show");
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/descargar_grupo_pais.php', 
    type:'POST',
    dataType:'JSON',
    data:$("#filtros").serialize(),
    success: function(data){
    if (data.status == 'success'){
        $("#miModal").modal("hide");
       // alert(1);
       window.open("uploads/grupopais/GrupoPais_actual.xlsx");
    }else{
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
}
 
</script>
</body> 
</html> 
