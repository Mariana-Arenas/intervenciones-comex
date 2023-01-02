<?php require_once('resources/html/head.php'); ?>
	<title>Valor Criterio</title>
   	

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
                                <h5 class="m-0 font-weight-bold text-primary">Seleccionar Valor Criterio</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form1" style="">
                            <input type="hidden" name="idncm" value='<?php echo $this->id?>'>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">NCM</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" id="obligatorio" name="ncm"  readonly placeholder="" value='<?php echo $this->detalle['ncm'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">Origen</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="obligatorio" name="origen"  readonly placeholder="" value='<?php echo $this->detalle['origen'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                                <div class="col-sm-1">
                                    <label  class="control-label required">fob</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="obligatorio" name="fob"  readonly placeholder="" value='<?php echo $this->detalle['fob'] ?>'' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                                <div class="col-sm-1">
                                    <label  class="control-label required">Peso</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="obligatorio" name="peso"  readonly placeholder="" value='<?php echo $this->detalle['peso'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label  class="control-label required">Articulo</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="obligatorio" name="articulo"  readonly placeholder="" value='<?php echo $this->detalle['codigo_articulo'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                                <div class="col-sm-2">
                                    <label  class="control-label required">descripcion</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" id="obligatorio" name="descripcion"  readonly placeholder="" value='<?php echo $this->detalle['descripcion_articulo'] ?>' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                                </div> 
                            </div>
                            <hr>
                            <div class="card shadow mb-4">
                                 <div class="card-header py-3">
                                     <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" id="nombrebuscar" name="nombrebuscar" placeholder="Buscar" class="form-control">
                                        </div> 
                                         
                                     </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                <th>Fob</th>
                                                <th>Descripción</th>
                                                <th>Unidad de Medida</th>
                                                <th class="td-btn text-right"></th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br />
                           
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

<script type="text/javascript">
var itemseleccionado;
$("#form1 input").keypress('click',function(e){
if (e.which == 13) {
 filtrar();
return false;
}
});
$(function(){
$('#table').DataTable( {
columns: [
    { title:"Fob" ,width:'10%'},
{ title:"Descripción" },
{ title:"Unidad Medida",width:'10%' },
{ title: "" ,width:'10%'}
],
"language": {
"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
},
searching: false,
} );
filtrar();
});
$("#form1").on('change',function(){
filtrar();
})
function filtrar(){
$.ajax({
url:'<?php echo SITEROOT ?>resources/middleware/filtrar_archivo_detalle_multiple.php',
type:'POST',
dataType:'JSON',
data:$("#form1").serialize(),
success:function(data){
console.log('h'+data);
var table = $('#table').DataTable();
table.clear();
table.rows.add(data.json).draw();
},
error:function(data){
console.log(data);
}
});
}


$(".edit").on('click',function(){
    var formData = new FormData(form1);
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/ver_ncm_faltantes.php', 
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

function seleccionar(idvalorcritico)
{
    ncm=$('input[name="ncm"]').val()  ;
    idncm=$('input[name="idncm"]').val()  ;
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/seleccionar_detalle_valorcritico.php', 
    type: 'POST', 
    dataType: 'JSON', 
    data: {valorcritico:idvalorcritico,
           ncm:ncm,
           idncm:idncm},
   
    success: function(data){
    if (data.status == 'success'){
    location.href = data.url; 
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


