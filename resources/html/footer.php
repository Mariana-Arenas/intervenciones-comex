

<div  id="miModal" class="modal animated" tabindex="-1" data-toggle="modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Validacion del Sistema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="ajax-msg" name="ajax-msg" role="alert" ></div>
      </div>
      <div class="modal-footer">
                                           
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div  id="miModalRecuperarClave" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <span aria-hidden="true">Ingrese su Email y recibira a la brevedad un correo  con las instrucciones</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                       
                        <div class="col-sm-10">
                        <input type="email" class="form-control form-control-user" name="recuperaremail"  aria-describedby="emailHelp" placeholder="Ingresar Email">

                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " name="enviarmail" id="enviarmail" onclick="EnviarMailNotificacionRecuperar()" > Recuperar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div  id="configuracionModalcambiarclave" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <span aria-hidden="true">Ingrese su nueva Clave</span>
            </div>
            <div class="modal-body">
                <form id="formcambiarclave">
                <div class="form-group">
                    <div class="row">
                       
                        <div class="col-sm-10">
                        <input type="password" class="form-control form-control-user" name="cambiarclave" >

                        </div> 
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " name="cambiarclave" id="cambiarclave" onclick="RealizarCambioClave()" > Modificar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div  id="miModalAplicarFiltros" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aplicar Filtros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <br>
          <form id="filtrosmas">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label  class="control-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" id="obligatorio" name="email_buscar" placeholder="Ingrese el Email" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                    </div> 
                </div>   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label  class="control-label">Rol</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" id="obligatorio" name="rol_buscar" placeholder="Ingrese el Rol" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                    </div> 
                </div>   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label  class="control-label">Accion</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" id="obligatorio" name="accion_buscar" placeholder="Ingrese la Accion" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                    </div> 
                </div>   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label  class="control-label">fecha Desde</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" id="obligatorio" name="fechadesde_buscar" placeholder="dd/mm/yyyy" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                    </div> 
                </div>   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label  class="control-label">fecha Hasta</label>
                    </div>
                    <div class="col-sm-6">
                    <input type="text" id="obligatorio" name="fechahasta_buscar" placeholder="dd/mm/yyyy" value='' class="form-control " data-vv-id="1" aria-required="false" aria-invalid="false">
                    </div> 
                </div>   
            </div>
          </form>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-primary " onclick="AplicarFiltro();" >Aplicar</button>                                    
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




<!-- Logout Modal-->
<div class="modal fade" id="configuracionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $_SESSION['comex']['usuario']['perfilnombre']?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
               
                  <a class="dropdown-item" href="#" onclick="modificarClave();">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    cambiar contraseña
                  </a>
                  <!-- <?php
              if ( $_SESSION['comex']['usuario']['perfilID']==4 )
              {
              ?>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuracion
                  </a>
              <?php 
              }
              ?> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="salir"  >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesion
                  </a>

        </div>
        
      </div>
    </div>
  </div>



</body>
</html>


<script>
function modificarClave()
{
  $('input[name="cambiarclave"]').val("");  
  $("#configuracionModal").modal("hide");
  $("#configuracionModalcambiarclave").modal("show");
}

function RealizarCambioClave()
{
    var formData = new FormData(formcambiarclave);
    $.ajax({
    url: '<?php echo SITEROOT ?>resources/middleware/actualizarclave.php', 
    type: 'POST', 
    dataType: 'JSON', 
    data: formData,
    contentType: false, 
    processData: false,
    success: function(data){
    if (data.status == 'success'){
      $("#configuracionModalcambiarclave").modal("hide");
    }else{
      $("#configuracionModalcambiarclave").modal("hide");
    $(".ajax-msg").html(data.mensaje);
    $("#miModal").modal("show");
    }; 
    },
    error: function(data){
    }
    }); 
} 



</script>