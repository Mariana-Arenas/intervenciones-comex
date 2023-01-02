<?php

require_once('../../config.php');
require_once('../../model/mailing.php');


$mailing_model= new Model\mailing;
$mailing['nombre'] = trim($_POST['nombre']);
$mailing['apellido'] = trim($_POST['apellido']);
$mailing['email'] = trim($_POST['email']);
$mailing['mensaje'] = trim($_POST['mensaje']);


//$mailing['imagen_perfil'] = trim($_POST['imagen_perfil']);
$validacion_mailing = 0;
foreach ($mailing as $key => $value) {
if ($value == '') {
$validacion_mailing++;
}
}
if ($validacion_mailing > 0) {
    //print_r($mailing);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos  con * son obligatorios'));
    die();
}


$mailing['celular'] = trim($_POST['celular']);

$mailingresult=$mailing_model->EnviarMailContacto($mailing['nombre'],$mailing['apellido'],$mailing['email'],$mailing['celular'],$mailing['mensaje']);
			
if ($mailingresult)
{
    echo json_encode(array('status' => 'success'));
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$mailingresult));
    die();
}



?>
