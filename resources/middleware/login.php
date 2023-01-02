<?php

   ini_set('display_errors', 'On');
	ini_set('display_errors', 1);
	error_reporting(E_ALL | E_STRICT);
	require_once('../../config.php');

	require_once('../../model/usuario.php');

	$usuarios = new Model\usuario;


$ipconexion=session_id();
	$email =$_POST['email'];
	$pas_noencriptado=$_POST['password'];
	//$password =md5($_POST['password']);
	$password=md5($_POST['password']);
// echo $password;
// die();
	if ($_POST['passwordnew']!=null)
	{
		checkPassword($_POST['passwordnew'],$errors);

			if ($errors!="")
			{
				echo json_encode(array('status' => 'error','mensaje'=>$errors));
				die();
			}

			$password_new=md5($_POST['passwordnew']);

	}else{
		$password_new=null;
	}
	

   $usuario = $usuarios->login($email,$password);
   //print_r($usuario);

	$status = 'error';
	$mensaje = 'Email y/o Contraseña Incorrectas';

	$url = '';

	if (isset($usuario['usuarioID'])) {
		$status = "error";
		
		if ($usuario['idestado'] == "1") {
			if ($usuario['temporal'] == "1") {
				if (strlen($password_new)>0)
				{
					$usuario_response = $usuarios->pasarpermanente($usuario['usuarioID'],$password_new,$ipconexion);
					if ($usuario_response==null)
					{
						$status = 'success';
						$mensaje = "";
						$url = SITEROOT.'dashboard';
					}else{
						$status = 'error';
						$mensaje = $usuario_response;
					}
				}else{
					$status = 'temporal';
					$mensaje = 'Ingrese su nueva clave';

				}
				
			}else{
				if ($usuario['ipconexion']==null )
				{
					$usuario_response = $usuarios->actualizaripconexion($usuario['usuarioID'],$ipconexion);
					$status = 'success';
					$mensaje = "";
					$url = SITEROOT.'dashboard';
				}else{
					if  ($usuario['ipconexion']!=$ipconexion)
					{
						$_SESSION['comex']['usuario']['IDtemporal']=$usuario['usuarioID'];
						$status = 'error';
						$mensaje = 'Se ha encontrado una sesion activa en otro dispositivo<br> <a href="#" onclick="CerrarSesion();">Cerrar</a>';
					}else{
						$status = 'success';
						$mensaje = "";
						$url = SITEROOT.'dashboard';
					}
				}
				
			}
		}
		if ($usuario['idestado'] == "2") {
				 $status = 'error';
				 $mensaje = 'Su usuario se encuentra en Revisión';
		}

		if ($status!='error')
		{
			
			$_SESSION['comex']['usuario']['ID'] = $usuario['usuarioID'];
			$_SESSION['comex']['usuario']['nombre'] = $usuario['nombre']." ".$usuario['apellido'];
			$_SESSION['comex']['usuario']['email'] = $usuario['email'];
			$_SESSION['comex']['usuario']['estadoID'] = $usuario['idestado'];
			$_SESSION['comex']['usuario']['perfilID']=$usuario['idroles'];
			$_SESSION['comex']['usuario']['perfilnombre']=$usuario['nombre_rol'];
			
			$_SESSION['comex']['usuario']['perfilfoto']='no-profile-img.png';	
			
			//die();
		}

		
        
	
	}
	//echo "ok";
	echo json_encode(array('status' => $status,'mensaje' => $mensaje, 'url' => $url));


	function checkPassword($pwd, &$errors) {
		$errors_init = $errors;
	
		if (strlen($pwd) < 8) {
			$errors[] = "La clave debe tener minimo 8 caracteres!<br>";
		}
	
		if (!preg_match("#[0-9]+#", $pwd)) {
			$errors[] = "Por lo menos debe contener 1 numero!<br>";
		}
	
		if (!preg_match("#[a-zA-Z]+#", $pwd)) {
			$errors[] = "Por lo menos debe contener una letra!<br>";
		}     
	
		return ($errors == $errors_init);
	}
?>