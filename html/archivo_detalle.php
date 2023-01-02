<?php require_once('resources/html/head.php'); ?>
	<title>Archivo Detalle Con Problemas</title>
	
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
                <form id="filtros">
                <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5 class="m-0 font-weight-bold text-primary">Archivo Detalle con Problemas</h5>
                            </div>
                            
                        	<div class="col-sm-4">
                               
                                    <input type="text" id="nombre" name="nombre" placeholder="Buscar" class="form-control">
                                   
                            </div>
                            <div class="col-sm-4">
                                            <!-- <label class="btn btn-sm "><input type="radio" id="obligatorio" name="opcion_filtro" value="T" checked> Todos</label> 
                                            <label class="btn btn-sm "><input type="radio" id="obligatorio" name="opcion_filtro" value="P"> Pendientes</label> -->
                                            <!-- <label class="btn btn-sm "><input type="radio" id="obligatorio" name="opcion_filtro" value="C"> Corregidos</label> -->
                                        </div>
                                       
                            
                        </div>
                    </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Fila</th>
                                    <th>Ncm</th>
                                    <th>Origen</th>
                                    <th>Fob</th>
                                    <th>Cantidad</th>
                                    <th>Artículo</th>
                                    <th>Descripción</th>
                                    <th>Peso</th>
                                    <th>Error</th>
                                    <th>Resuelve</th>
                                    <th class="td-btn text-right"></th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- fin editar -->
            </div> 
        </div>
      <!-- End of Main Content -->

     </div>
     <!-- End of Page Wrapper -->

</div>	
<!-- End of Page Wrapper -->


<?php require_once('resources/html/footer.php'); ?>
<?php require_once('resources/html/script.php'); ?>
<script type="text/javascript">
var itemseleccionado;
$("#filtros input").keypress('click',function(e){
if (e.which == 13) {
 filtrar();
return false;
}
});
$(function(){
$('#table').DataTable( {
columns: [
{ title:"Fila" },
{ title:"Ncm" },
{ title:"Origen" },
{ title:"Fob" },
{ title:"Cantidad" },
{ title:"Artículo" },
{ title:"Descripción" },
{ title:"Peso" },
{ title:"Error" },
{ title:"Resuelve" },
{ title: "" ,width:'10%'}
],
"language": {
"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
},
searching: false,
} );
filtrar();
});
$("#filtros").on('change',function(){
filtrar();
})
function filtrar(){
$.ajax({
url:'<?php echo SITEROOT ?>resources/middleware/filtrar_archivo_detalle.php',
type:'POST',
dataType:'JSON',
data:$("#filtros").serialize(),
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


</script>
</body>
</html>
