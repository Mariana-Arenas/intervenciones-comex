<?php require_once('resources/html/head.php'); ?>

<body class="bg-gradient-primary">



  <div class="container">



    <!-- Outer Row -->

    <div class="row justify-content-center">



      <div class="col-xl-5 col-lg-5 col-md-5 text-center">

		<!--<img src="/img/logo.png" style="max-width:250px!important; margin-top:40px;">-->

        <div class="card o-hidden border-0 shadow-lg my-5">

          

		  <div class="card-body p-0">

			

            <!-- Nested Row within Card Body -->

            <div class="row">

              <div class="col-lg-12">

                <div class="p-5">

                  <div class="text-center">

					<h1 class="h4 text-gray-900 mb-4"><a href="main"><img style="width: 120px;" src="../images/logo.jpg"></a></h1>
      
   				  </div>

                  <form  id="form" class="user">

                    <div class="form-group">

                      <input type="email" class="form-control form-control-user" name="email" required="required" aria-describedby="emailHelp" placeholder="Ingresar Email">

                    </div>

                    <div class="form-group">

                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password">

                    </div>  

                    <div class="form-group" id="new_pass" style="block">

                      <input type="password" class="form-control form-control-user" name="passwordnew" placeholder="Nueva Password">

                    </div>                   

                    <div  class="btn btn-primary btn-block btn-md enviar" style="border-radius: 15px">

					<i class="load-indicator">

					<div class="v-spinner" style="display: none;">

					<div class="v-clip" style="height: 20px; width: 20px; border-width: 2px; border-style: solid; border-color: rgb(255, 255, 255) rgb(255, 255, 255) transparent; border-radius: 100%; background: transparent;"></div></div></i> Entrar</div>

                  </form>

                  <hr>

                  <div class="text-center">

                    <a class="small" href="#" onclick="AbrirRecuperarClave();">Olvidé mi clave</a>

                  </div>
                  <div class="text-center">

                    <a class="small" href="registrarse">Crear cuenta</a>

                  </div>

                </div>

                <?php 
                  if (isset($_SESSION['comex']['usuario']['multipleconexion']))
                  {
                   ?>
                     <div class="alert alert-danger ajax-msg" name="ajax-msg" role="alert"><?php echo $_SESSION['comex']['usuario']['multipleconexion'] ?></div>
                   <?php 
                  }else{
                    ?>
                    <div class="alert alert-danger ajax-msg" name="ajax-msg" role="alert" style="display:none"></div>
                    <?php
                  }
                  ?>
               

              </div>

            </div>

          </div>

        </div>



      </div>



    </div>



  </div>




  <?php require_once('resources/html/footer.php'); ?>

<?php require_once('resources/html/script.php'); ?>

<script type="text/javascript">
   $('#new_pass').hide();
		$("#form .enviar").on('click',function(){    

			enviar_form();

		});

		$("#form input").keypress('click',function(e){

			if (e.which == 13) {

				enviar_form();

			}

		});

    function AbrirRecuperarClave(){
      $("#miModalRecuperarClave").modal("show");
    }
    function EnviarMailNotificacionRecuperar(){
     var email= $('input[name="recuperaremail"]').val();
     if (email=='')
     {
            $(".ajax-msg").html('Falta ingresar el mail');
            $("#miModal").modal("show");
            return;
     }
     $("#enviarmail").hide();
      $.ajax({
            url: '<?php echo SITEROOT ?>resources/middleware/recuperar_clave.php',
            type: 'POST',
            dataType: 'JSON',
            data: {email:email},
            success: function(data){
            if (data.status == 'success'){
            //location.href = data.url; 
            $('input[name="recuperaremail"]').val('');
              $("#miModalRecuperarClave").modal("hide");
              $(".ajax-msg").html("Si el email esta vinculado a algun usuario, se enviara un email a su correo");
              $("#miModal").modal("show");
              $("#enviarmail").show();
            }else{
              $(".ajax-msg").html(data.mensaje);
              $("#miModal").modal("show");
            }; 
            },
            error: function(data){
            }
            }); 

    }
    
		function enviar_form(){

           // alert(1);
        //   $('#new_pass').hide();
			$.ajax({

				url:'<?php echo SITEROOT ?>resources/middleware/login.php',

				type:'POST',

				dataType:'JSON',

				data:$("#form").serialize(),

			}).done(function(data){



				if (data.status == 'success') {

                    $('[name=ajax-msg]').hide();

					location.href = data.url;

				}else if(data.status == 'error'){

                    $('[name=ajax-msg]').show();

					$(".ajax-msg").html(data.mensaje);
        }else if(data.status == 'temporal'){
          $('[name=ajax-msg]').show();

          $(".ajax-msg").html(data.mensaje);
          $('#new_pass').show();
				}else if(data.status == 'first'){

                    $('[name=ajax-msg]').show();

                    $(".ajax-msg").html('Se ha producido un error inesperado');

					

				}

			});

        }

    function CerrarSesion()
    {
      $.ajax({
            url: '<?php echo SITEROOT ?>resources/middleware/liberar_sesion.php',
            type: 'POST',
            dataType: 'JSON',
            data:{valor:1},
            success: function(data){
            if (data.status == 'success'){
            //location.href = data.url; 
            $(".ajax-msg").html('Sesion eliminada,vuelva a intentarlo.');
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

