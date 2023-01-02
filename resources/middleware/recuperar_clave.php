<?php

    // ini_set('display_errors', 'On');
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL | E_STRICT);
	require_once('../../config.php');
	require_once('../../model/usuario.php');
	require_once('../../model/mailing.php');


	$mailing = new Model\mailing;
	$usuario_model = new Model\usuario;

	$email =$_POST['email'];


	$tokenenviarmail=md5($email.rand(1000,1000000));
$tokenaccesotemporal=md5($tokenenviarmail);
	//$usuario_result = $usuario_model->cambiarclaveTemporalRecupero($email,$tokenaccesotemporal );

   $envio = $mailing->EnviarMailRecuperoClave($email,$tokenenviarmail);
  // echo "el estado es ".$envio;
	$status = '';
	$mensaje = 'No se ha encontrado el email ingresado';

	$url = '';

	if ($envio==false) {
		$status = "error";
        
	}else{
		$mensaje = '';
		$status = "success";
	}

	echo json_encode(array('status' => $status,'mensaje' => $mensaje, 'url' => $url));
?>