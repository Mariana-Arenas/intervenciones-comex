<?php require_once('resources/html/head.php'); ?>
<!-- <link href="../css/style.css" rel="stylesheet"> -->
<style>
    @media screen {  
.profile {
    border-radius: 50%;
  bottom: -56%;
  left: -65%;
  max-width: 105px;
  opacity: 1;
  box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
  border: 2px solid rgba(255, 255, 255, 1);
  -webkit-transform: translate(-50%, 0%);
  transform: translate(-50%, 0%);
  z-index:99999;gba(255, 255, 255, 1);
}
}  
@media only screen and (max-width: 600px) { 
.profile {
    margin-left: 50%;
    border-radius: 50%;
  bottom: -56%;
  left: -65%;
  max-width: 105px;
  opacity: 1;
  box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
  border: 2px solid rgba(255, 255, 255, 1);
  -webkit-transform: translate(-50%, 0%);
  transform: translate(-50%, 0%);
  z-index:99999;gba(255, 255, 255, 1);
}
}  

  .required:after {
    content:" *";
    color: red;
  }


</style>
<body id="page-top">
<div id="wrapper">
     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column" style="padding: 1.5rem">
         <!-- Main Content -->
        <div id="content">
            <div class="container" >   
                <!-- Page Heading -->
                    
                <!-- fin Page Heading -->
                <!--editar-->
                <div class="card shadow mb-4">
                     <div class="card-header py-3">
			            <div class="row">
                            <div class="col-sm-3">
                                <h5 class="m-0 font-weight-bold text-primary">Crear Cuenta </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
<form id="form1" style="" enctype="multipart/form-data">
<div class="form-group">
<div class="row">
<div class="col-sm-1">

</div>
<div class="col-sm-1">
<img id="myImage" src="images/logo.jpg" style="width:100px;Height:100px" class="profile">
</div>
<div class="col-sm-3" style="margin-top:10%">
    <input id="image" type="file" accept="image/*" name="image" />
</div>
<div class="col-sm-2">
<label for="apellido" style="
    margin-left: -267px;
    margin-top: 60px;
" class="control-label"><b>Dimensiones Recomendadas: 100 x 100</b></label>
</div>
</div>
</div>

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
<div class="form-group" >
    <div class="row">
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-9" >
            <label for="terminos y condiciones" class="control-label">Términos y Condiciones</label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-8" >
        <textarea name="textarea" rows="10" cols="60" class="form-control" readonly >"Usuarios, obligaciones, responsabilidad y condiciones
El Usuario deberá respetar estos Términos y Condiciones de Uso del sitio web. Las infracciones por acción u omisión de los presentes Términos y Condiciones de Uso generarán el derecho a favor del Administrador de suspender al Usuario que las haya realizado.

El Usuario se obliga a usar los Servicios Digitales de conformidad con estos Términos y Condiciones, en forma correcta y lícita. En caso contrario, el Administrador podrá suspender la cuenta del Usuario, por considerarlo: violatorio de estos Términos y Condiciones y/o de la Política de Privacidad de estos Servicios Digitales, ofensivo, ilegal, violatorio de derechos de terceros, contrario a la moral y buenas costumbres y amenaza la seguridad de otros Usuarios.

Sin embargo, esta posibilidad no implica necesariamente que el contenido de toda la información disponible en los Servicios Digitales haya sido revisado.

El Usuario se compromete a:

No acceder a datos restringidos o a intentar violar las barreras de seguridad para llegar a ellos.

No realizar búsquedas de vulnerabilidades o explotación de las mismas para cualquier fin.

No divulgar información acerca de la detección de vulnerabilidades encontradas en los Servicios Digitales.

Comunicar al Administrador toda información a la que tenga acceso que pudiera implicar un compromiso a la seguridad de la información o los servicios digitales.

"</textarea>
        </div>
    </div>
    <div class="row" >
        <div class="col-sm-10" style="margin-left:auto">
             <input type="checkbox" id="CheckTerminos" name="CheckTerminos" value="S">
             <label for="terminos y condiciones" class="control-label">Acepto los Términos y Condiciones</label>
        </div>
    </div>
</div>


</div>
    <br />
<div class="form-group text-center"><button type="button" class="btn btn-primary edit"><i class="load-indicator"><div class="v-spinner" style="display: none;"><div class="v-clip" style="height: 20px; width:20px; border-width: 2px; border-style: solid; border-color: rgb(255,255, 255) rgb(255, 255,255) transparent; border-radius: 100%; background:transparent;"></div></div></i>Registrar <i class="fas fa-save"></i></button>
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
<!-- End of Page Wrapper -->
<?php require_once('resources/html/footer.php'); ?> 
<?php require_once('resources/html/script.php'); ?>


<script> 


$('input[name=image]').change(function(ev) {
    var formData = new FormData(form1);
    $.ajax({
        url: '<?php echo SITEROOT ?>resources/middleware/recortar_imagen.php', 
        type: 'POST', 
        dataType: 'JSON',
        data: formData,
        contentType: false, 
        processData: false,
        success: function(data){
            if (data.status == 'success') {
                document.getElementById('myImage').src=data.mensaje;

            }else{
                $(".ajax-msg").html(data.mensaje);
                $("#miModal").modal("show");
            }; 
        },
        error: function(data){
        }
        }); 
}); 

    var url = "";
$(".edit").on('click',function(){

    var formData = new FormData(form1);
// if ($("input[name=password]").val()!=$("input[name=repetirpassword]").val())
// {
//     $(".ajax-msg").html("No coincide el password ingresado");
//     $("#miModal").modal("show");
//     return;
// }
$.ajax({
url: '<?php echo SITEROOT ?>resources/middleware/registrarse.php', 
type: 'POST', 
dataType: 'JSON',
data: formData,
contentType: false, 
processData: false,
success: function(data){
    if (data.status == 'success') {
        url = data.url;
        setTimeout(salir, 2000);
        $(".ajax-msg").html(data.mensaje);
        $("#miModal").modal("show");

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

function salir()
{
    location.href = url; 
}

    var date_input=$('input[name="fecha_nacimiento"]');

  var options={
            format: 'dd/mm/yyyy',
           // container: container,
            todayHighlight: true,
            autoclose: true,
             language:'es'
          };
   
     date_input.datepicker(options);
</script> 
</body> 
</html> 
