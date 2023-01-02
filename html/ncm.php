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
                                <h5 class="m-0 font-weight-bold text-primary">Ncm</h5>
                            </div>
                        	<div class="col-sm-4">
                                <form id="filtros"><input type="text" id="nombre" name="nombre" placeholder="Buscar" class="form-control"></form>
                            </div>
                            <div class="col-sm-3">
                                <a href='<?php echo SITEROOT.'ncm/ADD' ?>' class="btn btn btn-primary btn-block">Nuevo NCM</a>
                            </div> 
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th>Ncm</th>
                                    <th>Descripción</th>
                                    <th>Fob</th>
                                    <th>Unidad Medida</th>
                                    <th>Grupo Pais</th>
                                    <th>Norma</th>
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
{ title:"Ncm" },
{ title:"Descripción" },
{ title:"Fob" },
{ title:"Unidad Medida" },
{ title:"Grupo País" },
{ title:"Norma" },
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
url:'<?php echo SITEROOT ?>resources/middleware/filtrar_ncm.php',
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

function Eliminar(id)
 {
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/eliminar_ncm.php', 
    type: 'POST', 
    dataType: 'JSON', 
    data: {'id':id  
        },
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
